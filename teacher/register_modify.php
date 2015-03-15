<?
include("sys_header.php");
include("connect.php");
include("teacher_test.php");
?>
<br>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>浙江树人大学毕业设计管理系统</title>
</head>

<body bgcolor="#e3f3ff">
<table align="center" width="700" height="10" bgcolor="#000000" cellspacing="0">
<tr height="10" width="100%">
<td align="center" bgcolor="#3AA9F0" class="text">
<font color="e8f2f8">注册信息修改</font>
</td>
</tr>
</table>

<table align="center" width="700" border="1">
<form name="myform" method="post" action="register_modify.php">

<tr height="15" width="100%" bgcolor="#FFFFFF">
<td align="right" class="text" width="40%">密码提示问题</td>
<td align="left">
<input type="text" name="question" />
</td>
</tr>

<tr height="15" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">密码提示回答</td>
<td align="left">
<input type="text" name="answer" />
</td>
</tr>

<tr height="15" width="100%">
<td align="right" class="text" width="40%">电子邮箱</td>
<td align="left">
<input type="text" name="email" />
</td>
</tr>

<tr height="15" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">手机号码</td>
<td align="left">
<input type="text" name="tel_num" />
</td>
</tr>

<tr height="15" width="100%" bgcolor="#FFFFFF">
<td align="right" class="text" width="40%">联系地址</td>
<td align="left">
<input type="text" name="address" />
</td>
</tr>

<tr height="15" width="100%" bgcolor="#b4dffb">
<td valign="top" class="text" colspan="4">
<div align="center">
<input type="submit" name="modify" onclick=checkuser(this.form)  value="修改">
</div>
</td>
</tr>

<tr height="15" width="100%">
<td valign="top" class="text" colspan="4">
<div align="center">
<font color="#c3000000">*请选择任一项或多项进行修改</font>
</div>
</td>
</tr>
</form>
</table>
</body>
</html>
<br>

<?php
$question = $_POST['question'];
$answer = $_POST['answer'];
$email = $_POST['email'];
$tel_num = $_POST['tel_num'];
$address = $_POST['address'];
$modify = $_POST['modify'];

if($modify == "修改")
{
  if(empty($question)&&empty($answer)&&empty($tel_num)&&empty($address)&&empty($email))
  {
    echo "<script>alert ('请选择任一项或多项进行修改！');history.back();</script>";
    exit;
  }//if
  else
  {
    if($question)
    {
      $sql = "update table $User set question='$question' where user_ID='$student_ID'";
      $query = $DB->prepare($sql);
      $query->execute();
    }//if

    if($answer)
    {
      $sql = "update table $User set answer='$answer' where user_ID='$student_ID'";
      $query = $DB->prepare($sql);
      $query->execute();
    }//if

    if($email)
    {
      if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$email))
      {
       echo "<script>alert ('E-mail格式不对！');history.back();</script>"; 
       exit;
      }//if
      else
      {
        $sql = "update table $User set email='$email' where user_ID='$student_ID'";
        $query = $DB->prepare($sql);
        $query->execute();
      }//else
    }//if

    if($tel_num)
    {
      if(strlen($tel_num)=='11')
      {
      $sql = "update table $User set tel_num='$tel_num' where user_ID='$student_ID'";
        $query = $DB->prepare($sql);
        $query->execute();
      }
    }//if

    if($address)
    {
      $sql = "update table $User set address='$address' where user_ID='$student_ID'";
      $query = $DB->prepare($sql);
      $query->execute();
    }//if

    echo "<script>alert ('修改成功！');</script>";
  }//else
}//if

?>

<?php  include("foot.php")?>

