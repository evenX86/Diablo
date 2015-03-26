<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require "src/Webflowtrace/boot.php";

$app['session.storage.handler'] = null;
$app['http_cache']->run();


?>
