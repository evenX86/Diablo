<meta http-equiv="content-type" type="text/html; charset=utf-8">
<?php
include("teacher_test.php");
include("connect.php");

$M_from = $_GET['M_from'];
$M_time = $_GET['M_time'];
$sql = "delete from $Message where M_from='$M_from' and M_time='$M_time'";
$query = mysql_query($sql) or die ('连接错误！');
if($query)
{
  echo "<script>alert ('信息删除成功！');</script>";
  echo "<html><meta http-equiv=\"refresh\" content=\"0; url=accept.php \"></html>";
}//if
else
{
  echo "<script>alert ('信息删除不成功！');history.back();</script>";
}//else
?>
