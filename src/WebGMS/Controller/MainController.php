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
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use WebGMS\configuration;
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
                ['config' => $config,'user'=>$user]);
        });



        return $route;
    }
}