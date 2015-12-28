<?php

use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;
use WebGMS\Config;
use WebGMS\Controller\MainController;
use WebGMS\Controller\TreeController;
use WebGMS\Controller\DBjsonController;
use Silex\Provider\TwigServiceProvider;

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);
try {
    /**读取配置文件*/
    $config = new Config("config.ini");
    
} catch (Exception $e) {
    echo $e->getMessage();
}
$app = new Silex\Application();
$app['debug'] = $config->get('global', 'debug');
$app->register(new TwigServiceProvider(), array(
    'twig.path' => $baseDir . '/html/'
));
$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => __DIR__.'/cache/',
));

$app->register(new Silex\Provider\SessionServiceProvider(), array(
    'session.storage.options' => array('cookie_lifetime' => (60 * 60 * 0.5)), // 12 hours
));
$app->register(new Silex\Provider\SessionServiceProvider());
/*实例化DB操作类*/
$app->register(new DoctrineServiceProvider(),
               array(
                   'db.options' => array(
                       'driver' => $config->get("mysql", "driver"),
                       'host' => $config->get("mysql", "host"),
                       'user' => $config->get("mysql", 'username'),
                       'password' => $config->get("mysql", 'password'),
                       'charset' => $config->get('mysql', 'charset'),
                       'dbname' => $config->get("mysql", 'dbname'),
                       PDO::ATTR_PERSISTENT => true
                   ),
               )
);

/**映射控制器*/
//$app->mount('', new \WebGMS\Controller\AuthController());
/*使控制器的数据不会被缓存*/
if (! headers_sent()) {
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}
$app->mount('', new \WebGMS\Controller\AdminController());
$app->mount('', new \WebGMS\Controller\ContentController());
$app->mount('', new \WebGMS\Controller\RouteController());
$app->mount('', new \WebGMS\Controller\StudentController());
$app->mount('', new \WebGMS\Controller\TeacherController());
$app->mount('', new \WebGMS\Controller\MainController());
$app->mount('', new \WebGMS\Controller\UserController());
$app->mount('', new \WebGMS\Controller\CollegeController());
$app->mount('', new \WebGMS\Controller\DeanController());
$app->mount('', new \WebGMS\Controller\ProfController());

//$app['session.storage.handler'] = null;
return $app;

?>
