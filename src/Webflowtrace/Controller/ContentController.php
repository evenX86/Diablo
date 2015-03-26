<?php
namespace Webflowtrace\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webflowtrace\Util\UAM;
use Webflowtrace\configuration;

class ContentController implements ControllerProviderInterface
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

            });

        /* type view
         * */
        $route->get(
            "/", function () use ($app, $config) {
            return $app['twig']->render(
                '/index.html',
                ['config' => $config]);
        });

        return $route;
    }
}