<meta http-equiv="content-type" type="text/html; charset=utf-8">
<?php
include("admin_test.php");
include("connect.php");

$student_ID = $_GET["student_ID"];
//echo "$student_ID";
$sql = "delete from $Student where student_ID='$student_ID'";
$query = mysql_query($sql);
if($query)
{
  echo "<script>alert('学生用户删除成功！');</script>";
  echo "<html><meta http-equiv=\"refresh\" content=\"0;url=student_query.php \"></html>";
  exit;
}//if
?>
