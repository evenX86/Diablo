<?php
//教师用户注销
include("connect.php");
include("teacher_test.php");
setcookie("cookie_ID","");
//if(empty($_COOKIE['cookie_ID']))
//{
echo "<script>alert ('教师用户成功注销！');</script>";
echo "<html><meta http-equiv=\"refresh\" content=\"0; url=http://localhost/gms/index.php\"></html>";
//exit;
//}
?>
