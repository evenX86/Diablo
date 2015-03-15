<?php
//收件内容
include("student_test.php");
include("sys_header.php");
include("connect.php");

$M_ID = $_GET['M_ID'];
$M_from = $_GET['M_from'];

$sql = "select M_title,M_time,M_to,M_content from $Message where M_ID='$M_ID'";
$query = mysql_query($sql);
$row = mysql_fetch_array($query);
?>

<html>
<head>
<meta http-equiv="content-type" type="text/html; charset=utf-8">
<link ref="stylesheet" href="style.css" type="text/css">
<title>浙江树人大学毕业设计管理系统</title>
</head>

<body bgcolor="#e3f3ff">
<table width="860" align="center" border="0">
<tr>
<td class="text" align="left">
主题：<?php echo "".$row['M_title']."";?>
</td>
</tr>

<tr>
<td>
<font color="#394e55" size="2">
发件人：<?php echo "".$M_from."";?>
</font>
</td>
</tr>

<tr>
<td>
<font color="#394e55" size="2">
时&nbsp;&nbsp;&nbsp;间：<?php echo "".$row['M_time']."";?>
</font>
</td>
</tr>

<tr>
<td>
<font color="#394e55" size="2">
收件人：<?php echo "".$row['M_to']."";?>
</font>
</td>
</tr>

<tr>
<td bgcolor="#FFFFFF">
<?php echo "".$row['M_content']."";?>
</td>
</tr>

</table>
</body>
</html>

<br>
<?php include("foot.php");?>
