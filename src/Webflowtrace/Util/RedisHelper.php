<?php
/**
 * Created by PhpStorm.
 * User: xuyifei
 * Date: 14-2-14
 * Time: 下午1:30
 */
namespace Webflowtrace\Util;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RedisHelper
{
    private static  $redishost;
    private static  $redisport;
    private static  $redispasswd;
    private static  $redis;
    private static  $config;

    /**
     * @param mixed $config
     */
    public static function setConfig($config)
    {
        self::$config = $config;
        self::$redishost = $config->get("redis","redishostname");
        self::$redisport = $config->get("redis","redisport");
        self::$redispasswd = $config->get("redis","redispassd");
    }

    public static function connect_redis(){
        $redis = new \Redis();
        $redis->connect(self::$redishost, self::$redisport);
        $redis->auth(self::$redispasswd);
        $redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);
        return $redis;
    }
}
