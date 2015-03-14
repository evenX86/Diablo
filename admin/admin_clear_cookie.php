<?php
//<meta http-equiv="content/html"; type="text/html; charset=utf-8">
//<?php
//管理员用户注销
include("connect.php");
include("admin_test.php");
setcookie("cookie_user_ID","");
//if(empty($_COOKIE['cookie_user_ID']))
//{
echo "<script>alert ('管理员成功注销！');</script>";
echo "<html><meta http-equiv=\"refresh\" content=\"0; url=http://localhost/gms/index.php\"></html>";
//exit();
//}
?>
