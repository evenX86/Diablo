<?php
/**
 * Created by PhpStorm.
 * User: xuyifei
 * Date: 14-1-14
 * Time: 上午9:45
 */

namespace Webflowtrace\Controller;

use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Webflowtrace\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $route = $app['controllers_factory'];
        $config = new configuration();
        $date = new \DateTime(date("Y-m-d"));
        $route->before(
            function () use ($app, $config) {

            });

        /**
         * 添加用户用
         */
        $route->get('/regist/{username}/', function ($username) use ($app) {

            $username = str_replace("_","\\",$username);

            $query = <<<QUERY
                select t1.username,t1.usersite,t1.level,t1.zhname from snda_user t1 where username=?
QUERY;
            $result = $app['db']->fetchAll($query, array($username));
            return $app->json($result, 200);

        });
        /**
         * 删除用户
         */
        $route->get('/deluser/{username}', function ($username) use ($app) {
            $username = str_replace("_","\\",$username);
            $name = $app['session']->get("uaminfo");
            $arr = get_object_vars($name);
            $admin = $arr['DomainAccount'];
            $query1 = <<<QUERY
                SELECT t1.username,t1.level FROM snda_user t1
                WHERE t1.username=?
QUERY;
            $result = $app['db']->fetchAssoc($query1, array($admin));
            if ($result['level'] == 'admin') {
                $app['db']->delete('snda_user', array(
                    'username' => $username,
                ));
                try {
                    file_put_contents("modifyUser.log", sprintf("[%s] 当前用户:%s,执行了删除用户的操作,删除了%s的权限\n", date("Y-m-d H:i:m"), $admin, $username), FILE_APPEND);
                } catch (Exception $e) {

                }
                return $app->redirect("/");
                //    return new Response('删除成功', 201);
            } else {
                return new Response('NOT FOUND', 404);
            }
        });
        /**
         *
         */
        $route->get('/restful/usertable', function () use ($app) {
            $name = $app['session']->get("uaminfo");
            $arr = get_object_vars($name);
            $username = $arr['DomainAccount'];
            $query1 = <<<QUERY
                SELECT t1.username,t1.level FROM snda_user t1
                WHERE t1.username=?
QUERY;
            $result = $app['db']->fetchAssoc($query1, array($username));
            if ($result['level'] == 'admin') {
                $query = <<<QUERY
            select * from snda_user
QUERY;
                $result = $app['db']->fetchAll($query);
                return $app->json($result, 200);
            } else {
                return new Response('NOT FOUND', 404);
            }
        });
        /**
         * 将用户资料插入数据库
         */
        $app->post(
            "/restful/regist", function (Request $request) use ($app) {
            $name = $app['session']->get("uaminfo");
            $arr = get_object_vars($name);
            $admin = $arr['DomainAccount'];
            $query1 = <<<QUERY
                SELECT t1.username,t1.level FROM snda_user t1
                WHERE t1.username=?
QUERY;
            $result = $app['db']->fetchAssoc($query1, array($admin));
            if ($result['level'] == 'admin') {
                $username = $request->get('username');
                $query = <<<QUERY
                    select t1.username,t1.level,t1.usersite from snda_user t1 where username=?
QUERY;
                $result = $app['db']->fetchAll($query, array($username));
                if (isset($result[0])) return new Response('不能重复提交!', 300);;

                $password = $request->get('password');
                if ($password != "") {
                    $password = md5($password);
                }
                $usersite = $request->get('usersite');
                $zhname = $request->get('zhname');
                $siteArr = explode(",", $usersite);
                $final = "";
                for ($i = 0; $i < count($siteArr); $i++) {
                    $arr = explode(":", $siteArr[$i]);
                    if ($final == "") {
                        $final = $arr[0];
                    } else {
                        $final .= "," . $arr[0];
                    }
                }
                $level = $request->get('level');

                $app['db']->insert('snda_user', array(
                    'username' => $username,
                    'zhname' => $zhname,
                    'password' => $password,
                    'usersite' => $final,
                    'level' => $level));
                try {
                    file_put_contents("modifyUser.log", sprintf("[%s] 当前用户:%s,执行了新增用户的操作,增加了%s的权限\n", date("Y-m-d H:i:m"), $admin, $username), FILE_APPEND);
                } catch (Exception $e) {

                }
                return $app->redirect("/modify");
            } else {
                return new Response('权限错误', 500);

            }
        });
        /**
         * 修改用户资料
         */
        $app->post(
            "/restful/modify", function (Request $request) use ($app) {
            $name = $app['session']->get("uaminfo");
            $arr = get_object_vars($name);
            $admin = $arr['DomainAccount'];
            $query1 = <<<QUERY
                SELECT t1.username,t1.level FROM snda_user t1
                WHERE t1.username=?
QUERY;
            $result = $app['db']->fetchAssoc($query1, array($admin));
            if ($result['level'] == 'admin') {
                $username = $request->get('username');
                $usersite = $request->get('usersite');
                $zhname = $request->get('zhname');
                $level = $request->get('level');

                $siteArr = explode(",", $usersite);
                $final = "";
                for ($i = 0; $i < count($siteArr); $i++) {
                    $arr = explode(":", $siteArr[$i]);
                    if ($final == "") {
                        $final = $arr[0];
                    } else {
                        $final .= "," . $arr[0];
                    }
                }
                $level = $request->get('level');

                $app['db']->update('snda_user', array(
                        'usersite' => $final,
                        'zhname' => $zhname,
                        'level' => $level),
                    array(
                        'username' => $username,
                    )
                );
                /*记入日志*/
                try {
                    file_put_contents("modifyUser.log", sprintf("[%s] 当前用户:%s,执行了修改用户的操作,修改了%s的权限\n", date("Y-m-d H:i:m"), $admin, $username), FILE_APPEND);
                } catch (Exception $e) {

                }
                return $app->redirect("/modify");
            } else {
                return new Response('权限错误', 500);
            }
        });

        /**
         * 返回所有站点
         */
        $route->get("/restful/sndasite/", function () use ($app) {
            $query = <<<QUERY
                select t1.*
                from snda_siteid t1
QUERY;
            $result = $app['db']->fetchAll($query);
            return $app->json($result, 201);
        });

        /**
         * 新增站点
         */
        $app->post("/restful/addsite", function (Request $request) use ($app) {
            $name = $app['session']->get("uaminfo");
            $arr = get_object_vars($name);
            $admin = $arr['DomainAccount'];
            $query1 = <<<QUERY
                SELECT t1.username,t1.level FROM snda_user t1
                WHERE t1.username=?
QUERY;
            $result = $app['db']->fetchAssoc($query1, array($admin));
            if ($result['level'] == 'admin') {
                $url = $request->get('url');
                $domain = $request->get('domain');
                $userid = $request->get('userid');
                $appid = $request->get('appid');
                $title = $request->get('title');
                $app['db']->insert('snda_siteid', array(
                    'url' => $url,
                    'domain' => $domain,
                    'userid' => $userid,
                    'appid' => $appid,
                    'title' => $title,
                    'nodename' => 'hz'
                ));
                try {
                    file_put_contents("modifyUser.log", sprintf("[%s] 当前用户:%s,执行了新增站点的操作,增加了%s\n", date("Y-m-d H:i:m"), $admin, $title), FILE_APPEND);
                } catch (Exception $e) {

                }
                return $app->redirect("/addsite");
            } else {
                return new Response('权限错误', 500);
            }
        });
        /**
         * 删除站点
         */
        $app->post("/restful/deletesite", function (Request $request) use ($app) {
            $name = $app['session']->get("uaminfo");
            $arr = get_object_vars($name);
            $admin = $arr['DomainAccount'];
            $query1 = <<<QUERY
                SELECT t1.username,t1.level FROM snda_user t1
                WHERE t1.username=?
QUERY;
            $result = $app['db']->fetchAssoc($query1, array($admin));
            if ($result['level'] == 'admin') {
                $appid = $request->get('siteid');
                $app['db']->delete('snda_siteid', array(
                    'appid' => $appid,
                ));
                try {
                    file_put_contents("modifyUser.log", sprintf("[%s] 当前用户:%s,执行了删除站点的操作,删除了%s\n", date("Y-m-d H:i:m"), $admin, $appid), FILE_APPEND);
                } catch (Exception $e) {
                }
                return $app->redirect("/addsite");
            } else {
                return new Response('权限错误', 500);
            }
        });

        return $route;
    }
}