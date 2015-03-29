<?php
/**
 * Created by PhpStorm.
 * User: xuyifei01
 * Date: 2015/3/29
 * Time: 11:13
 */

namespace Webflowtrace\Controller;

use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Webflowtrace\configuration;
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
        return $route;
    }
}