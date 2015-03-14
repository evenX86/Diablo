<?php
//论文信息查询
include("connect.php");
include("student_test.php");
?>
<br>
<br>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css">

<?php
$student_ID = $_POST["student_ID"];

if($query)
{
  if(empty($student_ID))
  {
    echo "<script>alert ('请输入要查询的学号！');history.back();</script>";
    exit;
  }//if


  $sql = "select * from $User where user_ID='$student_ID'";
  $query = $DB->query($sql);
  $count = $query->fetchAll()[0];
  if(count($count) == 0)
  {
    echo "<script>alert ('无此相关记录，请检查！');history.back();</script>";
    exit;
  }//if
?>

<table width="870" border="0" align="center" cellspacing="1" cellpadding="0" bgcolor="#000000">
<tr>
<td bgcolor="#FFFF">
<div align="center" class="text">论文编号</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">论文题目</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">导师编号</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">导师姓名</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">学生学号</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">学生姓名</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">论文状态</div>
</td>
</tr>

<?php
}//if
$sql = "select * from $Subject where student_ID='$student_ID'";
$query = $DB->query($sql);
$row_one = $query->fetchAll()[0];

$teacher_ID = $row_one['teacher_ID'];
$sql = "select teacher_name from $Teacher where teacher_ID='$teacher_ID'";
$query = $DB->query($sql);
$row_two =  $query->fetchAll()[0];

$student_ID = $row_one['student_ID'];
$sql = "select student_name from $Student where student_ID='$student_ID'";
$query = $DB->query($sql);
$row_three =  $query->fetchAll()[0];
?>
  <tr bgcolor="#FFFFFF" class="text">
  <td width="5%" align="center"><?php echo"".$row_one['subject_ID']."";?></td>
  <td width="15%" align="center"><?php echo"".$row_one['subject_title']."";?></td>
  <td width="5%" align="center"><?php echo"".$row_one['teacher_ID']."";?></td>
  <td width="5%" align="center"><?php echo"".$row_two['teacher_name']."";?></td>
  <td width="5%" align="center"><?php echo"".$row_one['student_ID']."";?></td>
  <td width="5%" align="center"><?php echo"".$row_three['student_name']."";?></td>
  <td width="5%" align="center"><?php echo"".$row_one['status']."";?></td>
</tr>
</table>

<?php
?>
