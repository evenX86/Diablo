<meta http-equiv="http-type" type="text/html; charset=utf-8">
<?php
include("admin_test.php");
include("connect.php");

$subject_ID = $_GET["subject_ID"];
//echo "$student_ID";
$sql = "delete from $Subject where subject_ID='$subject_ID'";
$query = mysql_query($sql);
if($query)
{
  echo "<script>alert('论文删除成功！');</script>";
  echo "<html><meta http-equiv=\"refresh\" content=\"0;url=subject_query.php \"></html>";
  exit;
}//if
?>
