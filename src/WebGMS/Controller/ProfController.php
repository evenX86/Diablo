<?php
/**
 * Created by PhpStorm.
 * User: xuyifei01
 * Date: 2015/3/29
 * Time: 11:13
 */

namespace WebGMS\Controller;

use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use WebGMS\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfController implements ControllerProviderInterface
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
        /*
         *  用户权限验证
         */
        $route->before(
            function (Request $request) use ($app, $config) {
                $user = $app['session']->get('user');
                if (null === $user) {
                    return $app->redirect('/login');
                }
                if ("prof"!=$user['type']) {
                    return $app->redirect('/');
                }
            });

        $route->get("/prof/audit-subject", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/prof/audit_subject.html',
                ['config' => $config, 'user' => $user]);
        });

        /**
         * 校优推荐
         */
        $route->get("/prof/advise", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/prof/advise.html',
                ['config' => $config, 'user' => $user]);
        });

        $route->get("/prof/ensure-paper", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/prof/ensure-paper.html',
                ['config' => $config, 'user' => $user]);
        });
        /**
         * 获取教师名下的优秀学生列表
         */
        $route->get("/restful/prof/student/list", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from shenfei_user where user_id = ?
Q;
            $userInfo = $app['db']->fetchAll($query,[$user['id']]);
            $major = $userInfo[0]['major'];
            $sql = <<<QU
                SELECT
                    subject_title,shenfei_paper.ensure_teacher,shenfei_paper.ensure_prof,shenfei_paper.student_id,shenfei_paper.id,shenfei_paper.paper_addr
                FROM
                    shenfei_subject

                right JOIN shenfei_paper ON shenfei_subject.student_id = shenfei_paper.student_id

                WHERE
                    shenfei_paper.level_college = "优"
                AND shenfei_subject.major = ?
QU;
            $result = $app['db']->fetchAll($sql,[$major]);

            $info = <<<INFO
                select * from shenfei_user
INFO;
            $m = $app['db']->fetchAll($info);

            $name = [];

            foreach ($m as $row) {
                $name[$row['user_id']] = $row['user_name'];
            }

            $final = [];

            foreach($result as $row){
                $flag = 0;
                $addr = $row['paper_addr'];
                $arr = explode("\\",$addr);
                $addr = "http://localhost:/resources/upload/startr/".$arr[count($arr)-1];

                array_push($final,[
                    'id'=>$row['id'],
                    'addr'=>$addr,
                    'title'=>$row['subject_title'],
                    'student'=>$row['student_id'],
                    'flag'=>$flag
                ]);
            }

            return $app->json($final);

        });

        /**
         * 校优推荐
         * //pradvise/student
         */

        $route->post("/prof/advise/student",function(Request $request) use($app,$config){
            $id = $request->get("id");
            $agree = $request->get("agree");
            $suggest = $request->get("suggest");

            $query = <<<Q
                select * from   shenfei_xiaoyou where student_id = ?
Q;
            $result = $app['db']->fetchAll($query,[$id]);

            if (count($result)<=0) {
                $query = <<<QUERY
                    select * from shenfei_subject where student_id = ?
QUERY;
                $result = $app['db']->fetchAll($query,[$id]);
                $flag = $app['db']->insert("shenfei_xiaoyou", [
                    'student_id' => $result[0]['student_id'],
                    'teacher_id' => $result[0]['teacher_id'],
                    'paper_name' => $result[0]['subject_title'],
                    'ensure_prof' => "true",
                    'suggest_prof'=>$suggest,
                    'insert_date' =>  date('Y-m-d', time()),
                ]);
                if ($flag)
                    return $app->redirect("/dashboard");
                else {
                    return new Response("审核失败，请联系管理员");
                }

            } else {
                $sql = <<<QUERY
                update shenfei_xiaoyou set `ensure_prof` = ? where student_id = ?
QUERY;
                $flag = $app['db']->executeUpdate($sql, array($agree, $id));
                $sql = <<<QUERY
                update shenfei_xiaoyou set `suggest_prof` = ? where student_id = ?
QUERY;
                $flag = $app['db']->executeUpdate($sql, array($suggest, $id));

                if ($flag)
                    return $app->redirect("/dashboard");
                else {
                    return new Response("审核失败，请联系管理员");
                }
            }
        });

        /**
         * 获取教师名下的待确认课题列表
         */
        $route->get("/restful/prof/paper/list", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from shenfei_user where user_id = ?
Q;
            $userInfo = $app['db']->fetchAll($query,[$user['id']]);
            $major = $userInfo[0]['major'];
            $sql = <<<QU
                SELECT
                    subject_title,shenfei_paper.ensure_teacher,shenfei_paper.ensure_prof,shenfei_paper.student_id,shenfei_paper.id,shenfei_paper.paper_addr
                FROM
                    shenfei_subject

                right JOIN shenfei_paper ON shenfei_subject.student_id = shenfei_paper.student_id

                WHERE
                    shenfei_subject.paper = "true"
                AND shenfei_subject.major = ?
QU;
            $result = $app['db']->fetchAll($sql,[$major]);

            $info = <<<INFO
                select * from shenfei_user
INFO;
            $m = $app['db']->fetchAll($info);

            $name = [];

            foreach ($m as $row) {
                $name[$row['user_id']] = $row['user_name'];
            }

            $final = [];
            foreach($result as $row){
                $flag = 0;
                $addr = $row['paper_addr'];
                $arr = explode("\\",$addr);
                $addr = "http://localhost:/resources/upload/startr/".$arr[count($arr)-1];
                if ($row['ensure_teacher'] =="true"&&$row['ensure_prof'] =="true") {$flag = 1;}
                else if($row['ensure_teacher'] =="true") {
                    $flag = 2;
                }
                array_push($final,[
                    'id'=>$row['id'],
                    'addr'=>$addr,
                    'title'=>$row['subject_title'],
                    'student'=>$name[$row['student_id']],
                    'flag'=>$flag
                ]);
            }

            return $app->json($final);

        });
        /**
         * /prof/ensure/paper
         */

        $route->post("/prof/ensure/paper",function(Request $request) use($app,$config){
            $id = $request->get("id");
            $agree = $request->get("agree");
            $sql = <<<QUERY
                update shenfei_paper set `ensure_prof` = ? where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql, array($agree, $id));
            if ($flag)
                return $app->redirect("/prof/ensure-paper");
            else {
                return new Response("审核失败，请联系管理员");
            }
        });

        $route->get("/prof/ensure-subject", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/prof/ensure-subject.html',
                ['config' => $config, 'user' => $user]);
        });
        /**
         * 审核开题报告
         */
        $route->get("/prof/ensure-startr", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/prof/ensure-startr.html',
                ['config' => $config, 'user' => $user]);
        });


        $route->get("/restful/audit-list", function () use ($app, $config) {
            $query = <<<QUERY
                SELECT * FROM `shenfei_subject` WHERE ISNULL(prof_audit) OR prof_audit = "false"
QUERY;
            $result = $app['db']->fetchAll($query);
            return $app->json($result);
        });

        $route->post("/prof/subject-audit-deal", function (Request $request) use ($app, $config) {
            $subjectTitle = $request->get("subject-title");
            $teacherID = $request->get("subject-teacherid");
            $agree = $request->get("agree");
            $comment = $request->get("audit-comment");
            $date =  date('Y-m-d', time());
            $sql1 = "update shenfei_subject set prof_audit = ? where subject_title = ? and teacher_id = ?";
            $sql2 = "update shenfei_subject set update_time = ?  where subject_title = ? and teacher_id = ?";
            $sql3 = "update shenfei_subject set prof_comment = ? where subject_title = ? and teacher_id = ?";
            $flag = $app['db']->executeUpdate($sql1,array($agree,$subjectTitle,$teacherID));
            $flag = $app['db']->executeUpdate($sql2,array($date,$subjectTitle,$teacherID));
            $flag = $app['db']->executeUpdate($sql3,array($comment,$subjectTitle,$teacherID));
            if ($flag) {
                return $app->redirect("/prof/audit-subject");
            } else {
                return new Response("操作失败",200);
            }


        });

        /**
         * 获取教师名下的待确认课题列表
         */
        $route->get("/restful/prof/ensure/list",function()use ($app,$config){
            $user = $app['session']->get('user');
            $query = <<<QUERY
                select major from shenfei_user where user_id=?
QUERY;
            $result = $app['db']->fetchAll($query,[$user['id']]);
            $major = $result[0]['major'];
            $query = <<<QUERY
                select * from shenfei_subject where major = ? and ensure_teacher = 'true' and `select` = 'true' and ensure_prof = 'false'
QUERY;
            $result = $app['db']->fetchAll($query,[$major]);
            return $app->json($result);
        });
        /**
         * 处理课题确认的接口
         * /prof/ensure/select
         */
        $route->post("/prof/ensure/select",function(Request $request)use ($app,$config){
            $id = $request->get("subject-id");
            $agree = $request->get("agree");
            if ($agree == "false") {
                return $app->redirect("/prof/ensure-subject");
            }
            $sql = <<<QUERY
                update shenfei_subject set `ensure_prof` = ? where id = ?
QUERY;

            $flag = $app['db']->executeUpdate($sql,array("true",$id));
            if ($flag) {
                return $app->redirect("/prof/ensure-subject");
            } else {
                return new Response("操作失败",200);
            }
        });

        $route->get("/restful/prof/startr/list",function() use($app,$config){
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from shenfei_user where user_id = ?
Q;
            $userInfo = $app['db']->fetchAll($query,[$user['id']]);
            $major = $userInfo[0]['major'];
            $sql = <<<QU
                SELECT
                    subject_title,shenfei_start_report.ensure_teacher,shenfei_start_report.ensure_prof,shenfei_start_report.student_id,shenfei_start_report.id,shenfei_start_report.report_addr
                FROM
                    shenfei_subject

                right JOIN shenfei_start_report ON shenfei_subject.student_id = shenfei_start_report.student_id

                WHERE
                    shenfei_subject.start_report = "true"
                AND shenfei_subject.major = ?
QU;
            $result = $app['db']->fetchAll($sql,[$major]);

            $info = <<<INFO
                select * from shenfei_user
INFO;
            $m = $app['db']->fetchAll($info);

            $name = [];

            foreach ($m as $row) {
                $name[$row['user_id']] = $row['user_name'];
            }

            $final = [];
            foreach($result as $row){
                $flag = 0;
                $addr = $row['report_addr'];
                $arr = explode("\\",$addr);
                $addr = "http://localhost:/resources/upload/startr/".$arr[count($arr)-1];
                if ($row['ensure_teacher'] =="true"&&$row['ensure_prof'] =="true") {$flag = 1;}
                else if($row['ensure_teacher'] =="true") {
                    $flag = 2;
                }
                array_push($final,[
                    'id'=>$row['id'],
                    'addr'=>$addr,
                    'title'=>$row['subject_title'],
                    'student'=>$name[$row['student_id']],
                    'flag'=>$flag
                ]);
            }

            return $app->json($final);
        });

        $route->post("/prof/ensure/startr",function(Request $request) use($app,$config){
            $id = $request->get("id");
            $agree = $request->get("agree");
            $sql = <<<QUERY
                update shenfei_start_report set `ensure_prof` = ? where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql, array($agree, $id));
            if ($flag)
                return $app->redirect("/prof/ensure-startr");
            else {
                return new Response("审核失败，请联系管理员");
            }
        });

        return $route;
    }
}





























