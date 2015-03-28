<?php
/**
 * Created by PhpStorm.
 * User: xuyifei01
 * Date: 2015/3/26
 * Time: 22:57
 */

namespace Webflowtrace\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webflowtrace\configuration;

class RouteController implements ControllerProviderInterface {
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

        /* type view
         * */
        $route->get(
            "/student/", function () use ($app, $config) {
            return $app['twig']->render(
                '/student/index.html',
                ['config' => $config]);
        });
        /* type view
         * */
        $route->get(
            "/register", function () use ($app, $config) {
            return $app['twig']->render(
                '/register.html',
                ['config' => $config]);
        });
        /* type view
         * */
        $route->get(
            "/help", function () use ($app, $config) {
            return $app['twig']->render(
                '/help.html',
                ['config' => $config]);
        });
        /* type view
         * */
        $route->get(
            "/contact", function () use ($app, $config) {
            return $app['twig']->render(
                '/contact.html',
                ['config' => $config]);
        });

        return $route;
    }
}