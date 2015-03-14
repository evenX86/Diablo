<?php
//学生用户注销
include("connect.php");
include("student_test.php");
setcookie("cookie_user_ID","");
//if(empty($_COOKIE['cookie_user_ID']))
//{
echo "<script>alert ('学生用户成功注销！');</script>";
echo "<html><meta http-equiv=\"refresh\" content=\"0; url=http://localhost/gms/index.php\"></html>";
//exit();
//}
?>
