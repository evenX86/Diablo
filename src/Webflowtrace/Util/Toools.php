<?php
/**
 * Created by JetBrains PhpStorm.
 * User: yuhuitao
 * Date: 13-3-4
 * Time: 下午5:14
 * To change this template use File | Settings | File Templates.
 */
namespace Webflowtrace\Util;
class Toools {
    public static function Unique_array($arr) {


        $out = array();
        foreach ($arr as $row) {
            if (in_array($row, $out)) {
                array_push($out, $row);
            }
        }
        return $out;
    }
}
