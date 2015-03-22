<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Content-type: text/html; charset=utf-8");
//数据库的连接
global $Hostname,$DBname,$DBuser,$DBpassword,$User,$Student,$Teacher,$Admin,$Information,$Message,$Subject,$Docunment,$Config,$Mark;

$Hostname = "localhost";
$DBname = "gmsdb";
$DBuser = "root";
$DBpassword = "123456";
$DB = new PDO("mysql:host=localhost;dbname=$DBname",$DBuser,$DBpassword);
$query = $DB->prepare("set names utf8");
$query->execute();
$User = "user";
$Student = "student";
$Teacher = "teacher";
$Admin = "admin";
$Information = "information";
$Message = "message";
$Subject = "subject";
$Docunment = "docunment";
$Config = "config";
$Mark = "mark";

$PAGE_NUM = 15;
$MAX_NUM = 4;
$MAX_DATE = 30;
?>
