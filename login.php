<?php
//<meta http-equiv="content-type" content="text/html"; charset="utf-8">
//用户登录并建立cookie
include("connect.php");
$Button = $_POST["Button"];
if($Button == "登录")
{
  $user_ID = $_POST["user_ID"];
  $user_passwd = $_POST["user_passwd"];
  $RadioButton = $_POST["RadioButton"];

  if(empty($user_ID))
  {
    echo "<script>alert('用户名不可为空！');history.back();</script>";
    exit();
  }//if

  if(empty($user_passwd))
  {
    echo "<script>alert('密码不可为空！');history.back();</script>";
    exit();
  }//if

  //if(empty($RadioButton))
  //{
   // echo "<script>alert('请选择登录类别！');history.back();</script>";
    //exit();
  //}//if

  if($RadioButton == '学生')
  {
    $sql = "select * from $User where user_ID='$user_ID' and user_passwd='$user_passwd'";
    $query = mysql_query($sql) or die (mysql_error());;
    $num = mysql_num_rows($query);
    if( $num != 0)
    {
      $expire = 60*60*24*1 +time();
      setcookie("cookie_user_passwd","$user_passwd",$expire,"/");
      setcookie("cookie_user_ID","$user_ID",$expire,"/");
    //  $student_ID = $_COOKIE['cookie_user_ID'];
      $sql = "select student_name from $Student where student_ID='$user_ID'";
      $query = mysql_query($sql);
      $row = mysql_fetch_array($query);
      $student_name = $row['student_name'];
      echo"<p align=\"center\"><b><big>$student_name 学生登录成功！</big></b></p>";
      echo"<html><meta http-equiv=\"refresh\" content=\"0; url=student/system.php\"></html>";
    }//if
    else
    {
      echo "<script>alert('学生帐号或密码错误，请检查！');history.back();</script>";
      exit();
    }//else
  }//if

  if($RadioButton == '教师')
  {
    $sql = "select * from $User where user_ID='$user_ID' and user_passwd='$user_passwd'";
    $query = mysql_query($sql) or die (mysql_error());;
    $num = mysql_num_rows($query);
    if( $num != 0)
    {
      $expire = 60*60*24*1 +time();
      setcookie("cookie_user_passwd","$user_passwd",$expire,"/");
      setcookie("cookie_user_ID","$user_ID",$expire,"/");
      $sql = "select Teacher_name from $Teacher where Teacher_ID='$user_ID'";
      $query = mysql_query($sql);
      $row = mysql_fetch_array($query);
      $Teacher_name = $row['Teacher_name'];
      echo"<p align=\"center\"><b><big>$Teacher_name 教师登录成功！</big></b></p>";
      echo"<html><meta http-equiv=\"refresh\" content=\"0; url=teacher/system.php\"></html>";
    }//if
    else
    {
      echo "<script>alert('教师帐号或密码错误，请检查！');history.back();</script>";
      exit();
    }//else
  }//if

  if($RadioButton == '管理员')
  {
    $sql = "select * from $Admin where Admin_ID='$user_ID' and Admin_passwd='$user_passwd'";
    $query = mysql_query($sql) or die (mysql_error());;
    $num = mysql_num_rows($query);
    if( $num != 0)
    {
      $expire = 60*60*24*1 +time();
      setcookie("cookie_user_passwd","$user_passwd",$expire,"/");
      setcookie("cookie_user_ID","$user_ID",$expire,"/");
      $sql = "select Teacher_name from $Teacher where Teacher_ID='$user_ID'";
      $query = mysql_query($sql);
      $row = mysql_fetch_array($query);
      $Admin_name = $row['Teacher_name'];
      echo"<p align=\"center\"><b><big>$Admin_name 管理员登录成功！</big></b></p>";
      echo"<html><meta http-equiv=\"refresh\" content=\"0; url=admin/system.php\"></html>";
    }//if
    else
    {
      echo "<script>alert('管理员帐号或密码错误，请检查！');history.back();</script>";
      exit();
    }//else
  }//if
}//if
?>
