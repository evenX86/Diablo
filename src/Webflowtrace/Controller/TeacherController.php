<?php
/**
 * Created by PhpStorm.
 * User: xuyifei01
 * Date: 2015/3/28
 * Time: 10:14
 */

namespace Webflowtrace\Controller;
use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Constraints\Date;
use Webflowtrace\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherController implements ControllerProviderInterface{

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
                if (null === $user = $app['session']->get('user')) {
                    return $app->redirect('/login');
                }
            });
        /**
         * 课题申报页面
         * */
        $route->get(
            "/teacher/apply", function () use ($app, $config) {
            $user = $app[ 'session' ] ->get('user' );
            return $app['twig']->render(
                '/teacher/apply.html',
                ['config' => $config,'name'=>$user['username']]);
        });
        /**
         * 处理课题申报的控制器
         *
         */
        $route->post("/teacher/apply-deal",function(Request $request) use ($app,$config){
            $user = $app['session']->get('user');
            if ($user['type']!="teacher"||$user==null) {
                return new Response("非教师用户不能申报课题",200);
            }
            $subject_title = $request->get("subject-title");
            $subject_content  = $request->get("subject-content");
            $teacher = $user['username'];
            echo date('Y-m-d', time());
            $flag = $app['db']->insert("shenfei_subject",[
                'subject_title'=>$subject_title,
                'subject_descripe'=>$subject_content,
                'teacher_id'=>$teacher,
                'create_time'=>date('Y-m-d', time())
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
        $route->get("/restful/subject-list",function()use ($app,$config){
            $user = $app['session']->get('user');

        });
        return $route;
    }
}