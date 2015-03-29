<?php
/**
 * Created by PhpStorm.
 * User: xuyifei01
 * Date: 2015/3/28
 * Time: 10:16
 */

namespace Webflowtrace\Controller;

use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Webflowtrace\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController implements ControllerProviderInterface
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
        // TODO: Implement connect() method.
        $route = $app['controllers_factory'];
        $config = new configuration();
        /**
         *  用户权限验证
         */
        $route->before(
            function (Request $request) use ($app, $config) {

            });
        /**
         * 登录页
         * */
        $route->get(
            "/login", function () use ($app, $config) {
            $user = $app['session']->get('user');
            if (null != $user) {
                return $app->redirect('/');
            }
            return $app['twig']->render(
                '/login.html',
                ['config' => $config, 'name' => null]);
        });
        /**
         * 处理登录页
         */
        $route->post(
            "/account", function (Request $request) use ($app, $config) {
            $username = $request->get("username");
            $passwd = $request->get("password");
            $type = $request->get("type");
            $md5passwd = md5($passwd);
            $query = <<<QUERY
                select * from shenfei_user where user_name= ? and user_passwd = ? and degree = ?
QUERY;
            $result = $app['db']->fetchall($query, [$username, $md5passwd, $type]);


            $flag = false;
            if (count($result)) {
                $flag = true;
            }
            if (!$flag) {
                return new Response("登录失败", 200);

            }
            $id = $result[0]['user_id'];
            //验证成功,跳转
            $app['session']->set('user', array('username' => $username, 'type' => $type, 'id' => $id));
            return $app->redirect('/');

        });
        /**
         * 处理登录页
         */
        $route->post(
            "/regist-user", function (Request $request) use ($app, $config) {
            $username = $request->get("username");
            $userid = $request->get("userid");
            $passwd = $request->get("password");
            $type = $request->get("type");
            $md5passwd = md5($passwd);
            $flag = $app['db']->insert('shenfei_user',
                [
                    'user_name' => $username,
                    'user_id' => $userid,
                    'user_passwd' => $md5passwd,
                    'degree' => $type
                ]);
            if ($flag) {
                //验证成功,跳转
                $app['session']->set('user', array('username' => $username, 'type' => $type, 'id' => $userid));
                return $app->redirect('/');
            } else {
                return new Response("注册失败", 200);
            }
        });

        /**
         * 退出登录页
         * */
        $route->get(
            "/logout", function () use ($app, $config) {
            $app['session']->set('user', null);
            return $app->redirect('/');
        });

        return $route;
    }
}