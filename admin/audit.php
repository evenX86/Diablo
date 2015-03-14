<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
include("connect.php");
include("admin_test.php");

$subject_ID = $_GET['subject_ID'];

$sql = "UPDATE $Subject SET audit='通过' where subject_ID='$subject_ID'";
$query = mysql_query($sql) or die('连接错误！');

if($query)
{
  echo "<script> alert ('此论文审核通过！');</script>";
  echo "<html><meta http-equiv=\"refresh\" content=\"0; url=system.php \"></html>";
  exit();
}//if
else
{
  echo "<script> alert ('没通过！');history.back();</script>";
}//else
?>
