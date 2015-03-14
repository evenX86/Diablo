<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Content-type: text/html; charset=utf-8");

//数据库的连接
global $Hostname,$DBname,$DBuser,$DBpassword,$User,$Student,$Teacher,$Admin,$Information,$Massage,$Subject,$Docunment,$Config,$Mark;

$Hostname = "localhost";
$DBname = "gmsdb";
$DBuser = "root";
$DBpassword = "123456";
$DB = new PDO("mysql:host=localhost;dbname=$DBname",$DBuser,$DBpassword);

$User = "user";
$Student = "student";
$Teacher = "teacher";
$Admin = "admin";
$Information = "Information";
$Massage = "message";
$Subject = "subject";
$Docunment = "Docunment";
$Config = "config";
$Mark = "mark";

$PAGE_NUM = 10;
$MAX_NUM = 4;
$MAX_DATE = 30;
?>
