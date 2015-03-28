<?php
/**
 * Created by PhpStorm.
 * User: xuyifei
 * Date: 14-1-14
 * Time: 上午9:45
 */

namespace Webflowtrace\Controller;

use Doctrine\Common\Annotations\Reader;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Webflowtrace\configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController implements ControllerProviderInterface
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
        $route->before(
            function () use ($app, $config) {
                if (null === $user = $app[ 'session' ] ->get('user' )) {
                    return $app->redirect('/login' );
                }
            });

        return $route;
    }
}