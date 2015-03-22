<?php
//检查教师用户是否登录
include("connect.php");
if(empty($_COOKIE['cookie_ID']))
{
  echo "<script>alert'对不起，您尚未登录，请先登录！';history.back()</script>";
}//if

