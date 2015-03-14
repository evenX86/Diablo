<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Content-type: text/html; charset=utf-8");header("Content-type: text/html; charset=utf-8");
//数据库的连接
global $Hostname,$DBname,$DBuser,$DBpassword,$User,$Student,$Teacher,$Admin,$Information,$Message,$Subject,$Docunment,$Config,$Mark;

$Hostname = "localhost";
$DBname = "gmsdb";
$DBuser = "root";
$DBpassword = "123456";
$DB = new PDO("mysql:host=localhost;dbname=$DBname",$DBuser,$DBpassword);
$User = "User";
$Student = "student";
$Teacher = "Teacher"; 
$Admin = "Admin";
$Information = "Information";
$Message = "Message";
$Subject = "Subject";
$Docunment = "Docunment";
$Config = "Config";
$Mark = "Mark";

$PAGE_NUM = 15;
$MAX_NUM = 4;
$MAX_DATE = 30;
?>
