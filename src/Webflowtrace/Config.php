<?php
/**
 * Created by JetBrains PhpStorm.
 * User: yuhuitao
 * Date: 13-2-18
 * Time: 下午5:32
 * To change this template use File | Settings | File Templates.
 */
namespace Webflowtrace;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
/**
 * 读取配置文件config.ini
 * mysql  网站的路径等信息
 */
class Config {
    protected $data;

    public function  __construct($file) {
        if (!file_exists($file)) {
            throw new FileNotFoundException("config.ini文件没有找到，请确实文件是否存在");
        }
        try {
            $this->data = parse_ini_file($file, true);
            $this->validateOptions();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function get($section, $option) {
        if (!array_key_exists($section, $this->data)) {
            return false;
        }
        if (!array_key_exists($option, $this->data[$section])) {
            return false;
        }
        return $this->data[$section][$option];
    }

    public function getSection($section) {
        if (!array_key_exists($section, $this->data)) {
            return false;
        }
        return $this->data[$section];
    }

    protected function validateOptions() {
        if (!$this->getSection('mysql')) {
            throw new \Exception("config.ini的数据异常");
        }
    }

}
?>