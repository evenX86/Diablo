<?php
/**
 * Created by PhpStorm.
 * User: xuyifei01
 * Date: 2015/3/29
 * Time: 11:14
 */

namespace WebGMS\Controller;

use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use WebGMS\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CollegeController implements ControllerProviderInterface
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
                if (null === $user = $app['session']->get('user')) {
                    return $app->redirect('/login');
                }
            });

        $route->get("/college/subject-audit", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/college/subject-audit.html',
                ['config' => $config, 'user' => $user]);

        });

        /**
         * 审核开题报告
         */
        $route->get("/college/ensure/startr", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/college/ensure-startr.html',
                ['config' => $config, 'user' => $user]);

        });
        /**
         * 审核论文
         */
        $route->get("/college/ensure/paper", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/college/ensure-paper.html',
                ['config' => $config, 'user' => $user]);

        });

        $route->get("/college/ensure/excellent", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/college/ensure-advise.html',
                ['config' => $config, 'user' => $user]);

        });

        /**
         * /restful/college/advise/list
         */
        $route->get("/restful/college/advise/list",function() use($app,$config){
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from shenfei_user where user_id = ?
Q;
            $userInfo = $app['db']->fetchAll($query,[$user['id']]);
            $major = $userInfo[0]['college'];
            $sql = <<<QU
                SELECT
                    shenfei_subject.subject_title,shenfei_subject.major,shenfei_xiaoyou.ensure_prof,shenfei_xiaoyou.suggest_prof,shenfei_xiaoyou.ensure_college,shenfei_xiaoyou.student_id,shenfei_xiaoyou.id,shenfei_xiaoyou.suggest_college
                FROM
                    shenfei_subject

                right JOIN shenfei_xiaoyou ON shenfei_subject.student_id = shenfei_xiaoyou.student_id

                WHERE
                    shenfei_subject.start_report = "true"
                AND shenfei_subject.college = ?
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
                array_push($final,[
                    'id'=>$row['id'],
                    'title'=>$row['subject_title'],
                    'student'=>$name[$row['student_id']],
                    'student_id'=>$row['student_id'],
                    'suggest_prof'=>$row['suggest_prof'],
                    'ensure_college'=>$row['ensure_college']
                ]);
            }

            return $app->json($final);

        });

        $route->post("/college/ensure/advise",function(Request $request) use($app,$config){
            $id = $request->get("id");
            $agree = $request->get("agree");
            $suggest = $request->get("suggest");

            $sql = <<<QUERY
                update shenfei_xiaoyou set `ensure_college` = ? where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql, array($agree, $id));

            $sql = <<<QUERY
                update shenfei_xiaoyou set `suggest_college` = ? where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql, array($suggest, $id));

            if ($flag)
                return $app->redirect("/college/ensure/advise");
            else {
                return new Response("审核失败，请联系管理员");
            }
        });


        $route->get("/restful/college/paper/list",function() use($app,$config){
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from shenfei_user where user_id = ?
Q;
            $userInfo = $app['db']->fetchAll($query,[$user['id']]);
            $major = $userInfo[0]['college'];
            $sql = <<<QU
                SELECT
                    shenfei_subject.subject_title,shenfei_subject.major,shenfei_paper.ensure_teacher,shenfei_paper.ensure_prof,shenfei_paper.level_college,shenfei_paper.student_id,shenfei_paper.id,shenfei_paper.paper_addr
                FROM
                    shenfei_subject

                right JOIN shenfei_paper ON shenfei_subject.student_id = shenfei_paper.student_id

                WHERE
                    shenfei_subject.start_report = "true"
                AND shenfei_subject.college = ?
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
                if ($flag != 1) continue;
                array_push($final,[
                    'id'=>$row['id'],
                    'addr'=>$addr,
                    'title'=>$row['subject_title'],
                    'student'=>$name[$row['student_id']],
                    'major'=>$row['major'],
                    'level'=>$row['level_college'],
                    'flag'=>$flag
                ]);
            }

            return $app->json($final);
        });

        $route->post("/college/ensure/paper",function(Request $request) use($app,$config){
            $id = $request->get("id");
            $agree = $request->get("agree");
            $sql = <<<QUERY
                update shenfei_paper set `level_college` = ? where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql, array($agree, $id));
            if ($flag)
                return $app->redirect("/college/ensure/paper");
            else {
                return new Response("审核失败，请联系管理员");
            }
        });
        $route->get("/restful/college/startr/list",function() use($app,$config){
            $user = $app['session']->get('user');
            $query = <<<Q
                select * from shenfei_user where user_id = ?
Q;
            $userInfo = $app['db']->fetchAll($query,[$user['id']]);
            $major = $userInfo[0]['college'];
            $sql = <<<QU
                SELECT
                    shenfei_subject.subject_title,shenfei_subject.major,shenfei_start_report.ensure_teacher,shenfei_start_report.ensure_prof,shenfei_start_report.level_college,shenfei_start_report.student_id,shenfei_start_report.id,shenfei_start_report.report_addr
                FROM
                    shenfei_subject

                right JOIN shenfei_start_report ON shenfei_subject.student_id = shenfei_start_report.student_id

                WHERE
                    shenfei_subject.start_report = "true"
                AND shenfei_subject.college = ?
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
                if ($flag != 1) continue;
                array_push($final,[
                    'id'=>$row['id'],
                    'addr'=>$addr,
                    'title'=>$row['subject_title'],
                    'student'=>$name[$row['student_id']],
                    'major'=>$row['major'],
                    'level'=>$row['level_college'],
                    'flag'=>$flag
                ]);
            }

            return $app->json($final);
        });

        $route->get("/college/task-ensure", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/college/task-ensure.html',
                ['config' => $config, 'user' => $user]);

        });

        $route->get("/restful/college/task-list", function () use ($app, $config) {
            $user = $app['session']->get("user");
            $query = <<<QUERY
                select * from shenfei_user where user_id = ?
QUERY;
            $res = $app['db']->fetchAll($query, [$user['id']]);
            $q = <<<Q
                select * from shenfei_student_task where college_ensure = "false" and college_name = ?
Q;
            $result = $app['db']->fetchAll($q, [$res[0]['college']]);
            return $app->json($result);
        });

        $route->post("/restful/college/task-ensure", function (Request $request) use ($app, $config) {

            $id = $request->get("student-id");
            $sql = <<<QUERY
                update shenfei_student_task set `college_ensure` = "true" where student_id = ?
QUERY;

            $result = $app['db']->fetchAll($sql, [$id]);
            if ($result) {
                return $app->redirect("/dashboard");
            } else {
                return new Response("操作失败", 200);
            }
        });

        $route->get("/restful/college/subject-audit-list", function () use ($app, $config) {
            $userid = $app['session']->get('user')['id'];
            $majorQuery = "select major from shenfei_user where user_id = ?";
            $res = $app['db']->fetchAll($majorQuery, [$userid]);
            $major = $res[0]['major'];
            $query = <<<QUERY
                select * from shenfei_subject where major = ? and prof_audit="true" and ISNULL(college_audit) or college_audit = "false"
QUERY;
            $result = $app['db']->fetchAll($query, [$major]);
            return $app->json($result);
        });
        $route->post("/college/subject-audit-deal", function (Request $request) use ($app, $config) {
            $subjectTitle = $request->get("subject-title");
            $teacherID = $request->get("subject-teacherid");
            $agree = $request->get("agree");
            $comment = $request->get("audit-comment");
            $date = date('Y-m-d', time());
            $sql1 = "update shenfei_subject set college_audit = ? where subject_title = ? and teacher_id = ?";
            $sql2 = "update shenfei_subject set update_time = ?  where subject_title = ? and teacher_id = ?";
            $sql3 = "update shenfei_subject set college_comment = ? where subject_title = ? and teacher_id = ?";
            $flag = $app['db']->executeUpdate($sql1, array($agree, $subjectTitle, $teacherID));
            $flag = $app['db']->executeUpdate($sql2, array($date, $subjectTitle, $teacherID));
            $flag = $app['db']->executeUpdate($sql3, array($comment, $subjectTitle, $teacherID));
            if ($flag) {
                return $app->redirect("/college/subject-audit");
            } else {
                return new Response("操作失败", 200);
            }
        });

        $route->post("/college/ensure/startr",function(Request $request) use($app,$config){
            $id = $request->get("id");
            $agree = $request->get("agree");
            $sql = <<<QUERY
                update shenfei_start_report set `level_college` = ? where id = ?
QUERY;
            $flag = $app['db']->executeUpdate($sql, array($agree, $id));
            if ($flag)
                return $app->redirect("/college/ensure/startr");
            else {
                return new Response("审核失败，请联系管理员");
            }
        });

        return $route;
    }
}