<?php
include("connect.php");
include("teacher_test.php");
include("sys_header.php");
?>
<br>

<html>
<head>
<meta http-equiv="content-type" content="html/text; charset=utf-8">
<link ref="stylesheet" href="style.css" type="text/css">
<title>鑫湘毕业设计系统</title>
</head>

<body bgcolor="#e3f3ff">
<table align="center" width="600" border="1" cellpadding="0" cellspacing="0">
<form name="myform" action="passwd_modify.php" method="post">
<tr>
<td width="600" height="30" bgcolor="#FFFFFF" colspan="2">
<div align="center" class="text">密码修改</div>
</td>
</tr>

<tr bgcolor="#aadeff">
<td width="35%" height="20">
<div align="center" class="text">用户名</div>
</td>
<td align="center" class="text">
<? echo "".$_COOKIE['cookie_user_ID']."";?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width="35%" height="20">
<div align="center" class="text">旧密码</div>
</td>
<td align="center">
<input name="user_passwd" type="password" size="25">
</td>
</tr>

<tr bgcolor="#aadeff">
<td width="35%" height="20">
<div align="center" class="text">新密码</div>
</td>
<td align="center">
<input name="passwd" type="password" size="25">
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width="35%" height="20">
<div align="center" class="text">确认新密码</div>
</td>
<td align="center">
<input name="again_passwd" type="password" size="25">
</td>
</tr>

<tr bgcolor="#aadeff">
<td width="600" height="25" align="center" colspan="2">
<input type="submit" name="modify" value="确认">
</td>
</tr>
</form>
</table>
</body>
</html>

<?php
$user_passwd = $_POST['user_passwd'];
$passwd = $_POST['passwd'];
$again_passwd = $_POST['again_passwd'];
$modify = $_POST['modify'];

if($modify == "确认")
{
  if(empty($user_passwd)&&empty($passwd)&&empty($again_passwd))
  {
    echo "<script>alert ('请修改！');history.back();</script>";
    exit;
  }//if
  else
  {
    $sql = "select user_passwd from $User where user_ID='$student_ID'";
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    if($user_passwd != $row['user_passwd'])
    {
      echo "<script>alert ('旧密码错误，请检查！');</script>";
      exit;
    }//if

    if($passwd != $again_passwd)
    {
      echo "<script>alert ('新密码输入不一致，请检查！');</script>";
      exit;
    }//if
    else
    {
      $sql = "update table $User set user_passwd='$passwd' where user_ID='$student'";
      $query = mysql_query($sql);
    }//else
  }//else
}//if
?>


<br>
<br>
<? include("foot.php") ?>
