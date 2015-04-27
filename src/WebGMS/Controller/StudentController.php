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
use Symfony\Component\Validator\Constraints\Date;
use WebGMS\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
         * 学生申报课题模块渲染
         * /student/subject/apply
         */
        $route->get("/student/subject/apply", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<QUERY
                select * from shenfei_subject where `select` = "true" and student_id = ?
QUERY;
            $result = $app['db']->fetchAll($query,[$user['id']]);
            if (count($result)>0) {


                $title  = $result[0]['subject_title'];
                return $app['twig']->render(
                    '/student/apply.html',
                    ['config' => $config, 'user' => $user,'subjecttitle'=>$title]);
            } else {
                return $app['twig']->render(
                    '/student/select.html',
                    ['config' => $config, 'user' => $user]);
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
                $teacherEnsuer = $result[0]['ensure_teacher'];
                $profEnsure = $result[0]['ensure_prof'];
                $title  = $result[0]['subject_title'];
                if ($teacherEnsuer !="true") {
                    $teacherEnsuer=null;
                }
                if ($profEnsure != "true") {
                    $profEnsure = null;
                }
                return $app['twig']->render(
                    '/student/unvalid.html',
                    ['config' => $config, 'user' => $user,'subjecttitle'=>$title,'t'=>$teacherEnsuer,'p'=>$profEnsure]);
            } else {
                return $app['twig']->render(
                    '/student/select.html',
                    ['config' => $config, 'user' => $user]);
            }
        });


            /**
             * 学生提交实习进程安排
             */
        $route->get("/student/practice/process", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from   shenfei_subject where student_id = ?
Q;
            $result = $app['db']->fetchAll($query,[$user['id']]);
            if ($result[0]['practice_process'] =="true"||$result[0]['practice_process'] ==true) {
                return $app['twig']->render(
                    '/student/practice-process-already.html',
                    ['config' => $config, 'user' => $user]);
            }

            return $app['twig']->render(
                '/student/practice-process.html',
                ['config' => $config, 'user' => $user]);

        });
        /**
         * 处理实习进程表安排的提交
         */
        $route->post("/student/practice/process/deal/",function(Request $request) use($app,$config){
            $file = $request->files->get("uploadfile");
            $id = $request->get("subject-id");
            $uploaddir = "D:\\bishe\\Diablo\\resources\\upload\\startr";
            if ($file ==null) {
                return new Response("上传失败",500);
            }
            $file->move($uploaddir,$file->getClientOriginalName());
            $sql = <<<QUERY
                update shenfei_subject set `practice_process` = "true" where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql,[$id]);

            $query = <<<QUERY
                select * from  shenfei_subject where id = ?
QUERY;
            $result = $app['db']->fetchAll($query,[$id]);

            $flag = $app['db']->insert("shenfei_practice_process", [
                'student_id' => $result[0]['student_id'],
                'teacher_id' => $result[0]['teacher_id'],
                'report_name' => $result[0]['subject_title'],
                'report_addr' => $uploaddir."\\".$file->getClientOriginalName(),
                'insert_date' =>  date('Y-m-d', time()),
            ]);

            return $app->redirect("/student/practice/process");
        });


        /**
         * 学生提交开题报告
         */
        $route->get("/student/start/report", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from   shenfei_subject where student_id = ?
Q;
            $result = $app['db']->fetchAll($query,[$user['id']]);
            if ($result[0]['start_report'] =="true"||$result[0]['start_report'] ==true) {
                return $app['twig']->render(
                    '/student/start-report-already.html',
                    ['config' => $config, 'user' => $user]);
            }

            return $app['twig']->render(
                '/student/start-report.html',
                ['config' => $config, 'user' => $user]);

        });

        $route->get("/restful/student/startr/info",function() use($app,$config){
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from shenfei_subject where student_id = ? and `select` = "true"
Q;
            $result = $app['db']->fetchAll($query,[$user['id']]);
            return $app->json($result);
        });
        $route->post("/student/start/report/deal/",function(Request $request) use($app,$config){
            $file = $request->files->get("uploadfile");
            $id = $request->get("subject-id");
            $uploaddir = "D:\\bishe\\Diablo\\resources\\upload\\startr";
            if ($file ==null) {
                return new Response("上传失败",500);
            }
            $file->move($uploaddir,$file->getClientOriginalName());
            $sql = <<<QUERY
                update shenfei_subject set `start_report` = "true" where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql,[$id]);

            $query = <<<QUERY
                select * from  shenfei_subject where id = ?
QUERY;
            $result = $app['db']->fetchAll($query,[$id]);

            $flag = $app['db']->insert("shenfei_start_report", [
                'student_id' => $result[0]['student_id'],
                'teacher_id' => $result[0]['teacher_id'],
                'report_name' => $result[0]['subject_title'],
                'report_addr' => $uploaddir."\\".$file->getClientOriginalName(),
                'insert_date' =>  date('Y-m-d', time()),
            ]);

            return $app->redirect("/student/start/report");
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
































