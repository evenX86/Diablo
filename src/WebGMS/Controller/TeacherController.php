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

class TeacherController implements ControllerProviderInterface
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
                if ($user['type'] != "teacher") {
                    return $app->redirect('/');
                }
            });
        /**
         * 课题申报页面
         * */
        $route->get(
            "/teacher/apply", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/teacher/apply.html',
                ['config' => $config, 'user' => $user]);
        });
        /**
         * 处理课题申报的控制器
         *
         */
        $route->post("/teacher/apply-deal", function (Request $request) use ($app, $config) {
            $user = $app['session']->get('user');
            if ($user['type'] != "teacher" || $user == null) {
                return new Response("非教师用户不能申报课题", 200);
            }
            $subject_title = $request->get("subject-title");
            $subject_content = $request->get("subject-content");
            $major = $request->get("major");
            $teacher = $user['username'];
            $teacherid = $user['id'];
            $flag = $app['db']->insert("shenfei_subject", [
                'subject_title' => $subject_title,
                'subject_descripe' => $subject_content,
                'teacher_id' => $teacherid,
                'teacher_name' => $teacher,
                'major' => $major,
                'create_time' => date('Y-m-d', time()),
                'update_time' => date('Y-m-d', time())
            ]);
            if ($flag) {
                return $app->redirect('/dashboard');
            } else {
                return new Response("申请失败");
            }
        });
        /**
         * 获取教师名下的课题列表
         */
        $route->get("/restful/subject-list", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<QUERY
                select * from shenfei_subject where teacher_id=?
QUERY;
            $result = $app['db']->fetchAll($query, [$user['id']]);
            return $app->json($result);
        });


        /**
         * 指导教师确认学生选题
         */
        $route->get("/teacher/ensure/subject", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/teacher/ensure-subject.html',
                ['config' => $config, 'user' => $user]);

        });
        /**
         * 指导教师填写实习任务书
         */
        $route->get("/teacher/practise/task", function () use ($app, $config) {
            $user = $app['session']->get('user');
            return $app['twig']->render(
                '/teacher/practice-task.html',
                ['config' => $config, 'user' => $user]);

        });

        /**
         * 获取教师名下的待确认课题列表
         */
        $route->get("/restful/teacher/ensure/list", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $query = <<<QUERY
                select * from shenfei_subject where teacher_id=? and `select` ="true" and ensure_teacher = "false"
QUERY;
            $result = $app['db']->fetchAll($query, [$user['id']]);
            return $app->json($result);
        });


        /**
         * 处理课题确认的接口
         * /teacher/ensure/select
         */
        $route->post("/teacher/ensure/select", function (Request $request) use ($app, $config) {
            $id = $request->get("subject-id");
            $agree = $request->get("agree");
            if ($agree == "false") {
                return $app->redirect("/teacher/ensure/subject");
            }
            $sql = <<<QUERY
                update shenfei_subject set `ensure_teacher` = ? where id = ?
QUERY;

            $flag = $app['db']->executeUpdate($sql, array("true", $id));
            if ($flag) {
                return $app->redirect("/teacher/ensure/subject");
            } else {
                return new Response("操作失败", 200);
            }
        });


        /**
         * 处理实习任务书填写的接口
         * /teacher/apply/practice-task
         */
        $route->post("/teacher/ensure/select", function (Request $request) use ($app, $config) {
            $id = $request->get("subject-id");
            $agree = $request->get("agree");
            if ($agree == "false") {
                return $app->redirect("/teacher/ensure/subject");
            }
            $sql = <<<QUERY
                update shenfei_subject set `ensure_teacher` = ? where id = ?
QUERY;

            $flag = $app['db']->executeUpdate($sql, array("true", $id));
            if ($flag) {
                return $app->redirect("/teacher/ensure/subject");
            } else {
                return new Response("操作失败", 200);
            }
        });
            $route->get("/restful/show/taskdetail/{id}/",function($id) use($app,$config){
            $id = intval($id);
            $query = <<<QUERY
                select * from shenfei_student_task where student_id = ?
QUERY;
            $result = $app['db']->fetchall($query,[$id]);
            return $app->json($result);

        });

        $route->get("/restful/teacher/student-list", function () use ($app, $config) {
            $user = $app['session']->get('user');
            $id = $user['id'];
            $info = <<<INFO
                select * from shenfei_user where user_id = ?
INFO;
            $m = $app['db']->fetchAll($info, [$id]);
            $major = $m[0]['major'];

            $info = <<<INFO
                select * from shenfei_user
INFO;
            $m = $app['db']->fetchAll($info, [$id]);

            $name = [];

            foreach ($m as $row) {
                $name[$row['user_id']] = $row['user_name'];
            }
            $query = <<<QUERY
                select * from shenfei_subject where teacher_id=? and major = ? and student_id != "null"
QUERY;
            $result = $app['db']->fetchAll($query, [$user['id'], $major]);

            $final = [];
            foreach ($result as $row) {
                array_push($final, ['id' => $row['student_id'], 'name' => $name[$row['student_id']], 'major' => $row['major'], 'title' => $row['subject_title'], 'task' => $row['task']]);
            }
            return $app->json($final);
        });

        $route->post("/teacher/apply/practice-task", function (Request $request) use ($app, $config) {
            $user = $app['session']->get('user');
            if ($user['type'] != "teacher" || $user == null) {
                return new Response("非教师用户不能申报课题", 200);
            }
            $id = $request->get("student-id");
            $name = $request->get("student-name");
            $content = $request->get("content");
            $title = $request->get("student-task");
            $major = $request->get("student-major");
            $college = $request->get("student-college");

            $sql = <<<QUERY
                update shenfei_subject set `task` = ? where student_id = ?
QUERY;

            $flag = $app['db']->executeUpdate($sql, array("true", $id));

            $flag = $app['db']->insert("shenfei_student_task", [
                'student_name' => $name,
                'student_id' => $id,
                'student_major' => $major,
                'student_task_name' => $title,
                'student_task_content' => $content,
                'college_name' => $college
            ]);
            if ($flag) {
                return $app->redirect('/teacher/practise/task');
            } else {
                return new Response("申请失败");
            }
        });

        return $route;
    }
}