<meta http-equiv="content-type" type="text/html; charset=utf-8">
<?php
include("admin_test.php");
include("connect.php");

$teacher_ID = $_GET['teacher_ID'];
$sql = "delete $Teacher where teacher_ID='$teacher_ID'";
$query = mysql_query($sql);
if($query)
{
  echo "<script>alert ('此教师用户删除成功！');</script>";
  echo "<html><meta http-equiv=\"refresh\" content=\"0;url=teacher_query.php \"></html>";
}//if
?>
