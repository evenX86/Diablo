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
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Webflowtrace\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController implements ControllerProviderInterface{
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

            });


        /**
         * 首页
         */
        $route->get(
            "/", function () use ($app, $config) {
            /*判断session中是否存在user，如果不存在则跳到登录页面*/
            if (null === $user = $app[ 'session' ] ->get('user' )) {
                return $app->redirect('/login' );
            }
            return $app['twig']->render(
                '/index.html',
                ['config' => $config,'name'=>$user['username']]);
        });
        /**
         * 登录页
         * */
        $route->get(
            "/login", function () use ($app, $config) {
            $user = $app[ 'session' ] ->get('user' );
            if (null !=$user) {
                return $app->redirect('/' );
            }
            return $app['twig']->render(
                '/login.html',
                ['config' => $config,'name'=>null]);
        });
        /**
         * 处理登录页
         */
        $route->post(
            "/account",function(Request $request) use($app,$config) {
            $username = $request->get("username");
            $passwd = $request->get("password");
            $type = $request->get("type");
            $md5passwd = md5($passwd);
            $query = <<<QUERY
                select count(*) as len from shenfei_user where user_name= ? and user_passwd = ? and degree = ?
QUERY;
            $result = $app['db']->fetchall($query,[$username,$md5passwd,$type]);
            $flag = $result[0]['len'];

            if ($flag) {
                //验证成功,跳转
                $app[ 'session' ] ->set('user' , array('username' => $username));
                return $app->redirect('/');
            } else {
                return new Response("登录失败",200);
            }
        });
        return $route;
    }
}