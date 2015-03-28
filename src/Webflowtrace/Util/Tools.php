<?php
/**
 * Created by JetBrains PhpStorm.
 * User: yuhuitao
 * Date: 13-3-4
 * Time: 下午5:14
 * To change this template use File | Settings | File Templates.
 */
namespace Webflowtrace\Util;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Tools
{
    public static function Unique_array($arr)
    {
        $out = array();
        foreach ($arr as $row) {
            if (in_array($row, $out)) {
                array_push($out, $row);
            }
        }
        return $out;
    }

    public static function print_array($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

}
