<?php
include("connect.php");
include("admin_test.php");
include("sys_header.php");
?>
<br>

<html>
<head>
<meta http-equiv="content-type" content="html/text; charset=utf-8">
<link ref="stylesheet" href="style.css" type="text/css">
<title>浙江树人大学毕业设计系统</title>
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
<?php echo "".$_COOKIE['cookie_user_ID']."";?>
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
<input type="submit" name="modify" value="确定">
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

if($modify == "确定")
{
  if(empty($user_passwd)&&empty($passwd)&&empty($again_passwd))
  {
    echo "<script>alert ('请修改！');history.back();</script>";
    exit;
  }//if
  else
  {
    $Admin_ID = $_COOKIE['cookie_user_ID'];
    $sql = "select Admin_passwd from $Admin where Admin_ID='$Admin_ID'";
    $query = $DB->query($sql);
    $row = $query->fetchAll();
    if($user_passwd != $row['Admin_passwd'])
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
      $sql = "update table $Admin set Admin_passwd='$passwd' where Admin_ID='$Admin_ID'";
      $query = $DB->prepare($sql);
      $query = $query->execute();
      if($query)
      {
        echo "<script>alert ('密码修改成功！');</script>";
        exit();
      }//if
    }//else
  }//else
}//if
?>


<br>
<br>
<?php include("foot.php") ?>
