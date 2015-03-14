<?php
function checkuser()
{
  $user_ID = $_POST['user_ID'];
  $user_passwd = $_POST['user_passwd'];
  $user_repasswd = $_POST['user_repasswd'];
  $question = $_POST['question'];
  $answer = $_POST['answer'];
  $email = $_POST['email'];
  $sex = $_POST['sex'];
  $tel_num = $_POST['tel_num'];
  $college = $_POST['college'];
  $degree = $_POST['degree'];
  $major = $_POST['major'];
  $address = $_POST['address'];

  if(empty($user_ID))
  {
    echo "<p align=\"center\"><b><big>用户名不能为空，请检查！</big></b></p>\n";
    echo "<p align=\"center\"><font color=\"#FF0000\"><b><big><a href=\"javascript:history.back();\">点此返回</a></big></b></font></p>";
    exit;
  }//if

  if(strlen($user_ID)<>8)
  {
    echo "<p align=\"center\"><b><big>用户名位数不对，请检查！</big></b></p>\n";
    echo "<p align=\"center\"><font color=\"#FF0000\"><b><big><a href=\"javascript:history.back();\">点此返回</a></big></b></font></p>";
    exit;
  }//if

  if(empty($user_passwd))
  {
    echo "<p align=\"center\"><b><big>密码不能为空，请检查！</big></b></p>\n";
    echo "<p align=\"center\"><font color=\"#FF0000\"><b><big><a href=\"javascript:history.back();\">点此返回</a></big></b></font></p>";
    exit;
  }//if

  if(strlen($user_passwd)<8)
  {
    echo "<p align=\"center\"><b><big>密码少于8位，请修改！</big></b></p>\n";
    echo "<p align=\"center\"><font color=\"#FF0000\"><b><big><a href=\"javascript:history.back();\">点此返回</a></big></b></font></p>";
    exit;
  }//if

  if(strlen($user_passwd)>20)
  {
    echo "<p align=\"center\"><b><big>密码超过20位，请修改！</big></b></p>\n";
    echo "<p align=\"center\"><font color=\"#FF0000\"><b><big><a href=\"javascript:history.back();\">点此返回</a></big></b></font></p>";
    exit;
  }//if

  if(empty($user_repasswd) || strcmp($user_passwd,$user_repasswd))
  {
    echo "<p align=\"center\"><b><big>确认密码有误，请检查！</big></b></p>\n";
    echo "<p align=\"center\"><font color=\"#FF0000\"><b><big><a href=\"javascript:history.back();\">点此返回</a></big></b></font></p>";
    exit;
  }//if

  if(empty($email))
  {
    echo "<p align=\"center\"><b><big>E-mail不能为空，请检查！</big></b></p>\n";
    echo "<p align=\"center\"><font color=\"#FF0000\"><b><big><a href=\"javascript:history.back();\">点此返回</a></big></b></font></p>";
    exit;
  }//if

}//checkuser
?>
