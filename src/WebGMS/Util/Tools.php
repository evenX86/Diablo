<?php
namespace WebGMS\Util;

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
