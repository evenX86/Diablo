<?php
//学生信息查询
include("connect.php");
include("sys_header.php");
include("teacher_test.php");
?>
<br>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css">
<title>鑫湘毕业设计管理系统</title>
</head>

<body bgcolor="#e3f3ff">
<table  width="600" heigth="100" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000" class="text">
<!--DWLayoutTable-->
<form name="myform" method="post" action="student_query.php">
<tr bgcolor="#FFFFFF">
<td colspan="4" align="center" height="30">
<font size="4"><b>学生信息查询</b></font>
</td>
</tr>

<tr>
<td width="125" bgcolor="#aadeff" align="center">学号:</td>
<td width="262" bgcolor="#aadeff" height="30" colspan="2">
<div align="center">
<input type="text" name="student_ID" size="25">
</div>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td height="22" colspan="4" align="center">
<input checked="checked" type="radio" name="select" value="student">学生信息
<input type="radio" name="select" value="subject">选题信息
</td>
</tr>

<tr bgcolor="#aadeff">
<td height="22" colspan="4" align="center">
<input type="hidden" name="query" value="1">
<input type="submit" name="submit" value="查询">
</td>
</tr>

</form>
</table>
</body>
</html>

<?php
//条件判断
$query = $_POST['query'];
if($query)
{
  switch($_POST['select'])
  {
    case "student":
      include("student_squery.php");
      break;
    case "subject": 
      include("subject_squery.php");
      break;
  }
}//if
?>
<br>
<br>
  <?include("foot.php");?>
