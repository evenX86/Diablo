<?php
/**
 * Created by PhpStorm.
 * User: xuyifei01
 * Date: 2015/3/28
 * Time: 10:14
 */

namespace WebGMS\Controller;


use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use WebGMS\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController implements ControllerProviderInterface
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
                $user = $app['session']->get('user');
                if (null === $user) {
                    return $app->redirect('/login');
                }
                if ($user['type'] != "student") {
                    return $app->redirect('/');
                }
            });
        /**
         * 学生选择课题模块
         */
        $route->get("/student/subject/select", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<QUERY
                select * from shenfei_subject where `select` = "true" and student_id = ?
QUERY;
            $result = $app['db']->fetchAll($query,[$user['id']]);
            if (count($result)>0) {


                $title  = $result[0]['subject_title'];
                return $app['twig']->render(
                    '/student/unvalid.html',
                    ['config' => $config, 'user' => $user,'subjecttitle'=>$title]);
            } else {
                return $app['twig']->render(
                    '/student/select.html',
                    ['config' => $config, 'user' => $user]);
            }
        });

        /**
         * 学生可选择课题接口
         */
        $route->get("/student/subject/list", function () use ($app, $config) {
            $user = $app['session']->get('user');

            $query = "select major from shenfei_user WHERE user_id = ?";

            $result = $app['db']->fetchAll($query,[$user['id']]);

            $major = $result[0]['major'];

            $subjectSql = <<<QUERY
                select * from shenfei_subject WHERE  major = ? and prof_audit = "true" AND  college_audit = "true" and `select` = "false"
QUERY;
            $result = $app['db']->fetchAll($subjectSql,[$major]);

            return $app->json(['data'=>$result,'name'=>$user['id']]);
        });

        $route->post("/student/apply",function(Request $request) use($app,$config) {
            $id = $request->get("subject-id");
            $stu = $request->get("subject-teacherid");
            $sql = <<<QUERY
                update shenfei_subject set `select` = ? where id = ?
QUERY;
            $sql1 = <<<QUERY
                update shenfei_subject set `student_id` = ? where id = ?
QUERY;

            $flag = $app['db']->executeUpdate($sql,array("true",$id));
            $flag = $app['db']->executeUpdate($sql1,array($stu,$id));
            if ($flag) {
                return $app->redirect("/student/subject/select");
            } else {
                return new Response("操作失败",200);
            }
        });
        return $route;
    }
}
































