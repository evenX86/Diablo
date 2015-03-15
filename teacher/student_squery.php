<?php
//学生信息资料查询
include("connect.php");
include("teacher_test.php");
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
  
  if(strlen($student_ID)!=8)
  {
    echo "<script>alert ('输入有误，请检查！');history.back();</script>";
    exit;
  }//if

  $sql = "select * from $User where user_ID=$student_ID";
  $query = $DB->query($sql);
  $count = count($query->fetchAll()[0]);
  if($count == 0)
  {
    echo "<script>alert ('无此相关记录，请检查！');history.back();</script>";
    exit;
  }//if
?>

<table width="870" border="0" align="center" cellspacing="1" cellpadding="0" bgcolor="#000000">
<tr>
<td bgcolor="#FFFF" width="5%">
<div align="center" class="text">学号</div>
</td>

<td bgcolor="#FFFF" width="3%">
<div align="center" class="text">姓名</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">性别</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">学院</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">专业</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">班级</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">E-mail</div>
</td>

<td bgcolor="#FFFF">
<div align="center" class="text">联系方式</div>
</td>
</tr>
<?php
}//if
$sql = "select * from $Student where student_ID='$student_ID'";
$query = $DB->query($sql);
$row = $query->fetchAll()[0];
?>
  <tr bgcolor="#FFFFFF" class="text">
  <td width="5%" align="center"><?php echo"".$row['student_ID']."";?></td>
  <td width="5%" align="center"><?php echo"".$row['student_name']."";?></td>
  <td width="5%" align="center"><?php echo"".$row['sex']."";?></td>
  <td width="15%" align="center"><?php echo"".$row['college']."";?></td>
  <td width="20%" align="center"><?php echo"".$row['major']."";?></td>
  <td width="10%" align="center"><?php echo"".$row['class']."";?></td>
<?php
$sql = "select email,tel_num from $User where user_ID='$student_ID'";
$query = $DB->query($sql);
$row = $query->fetchAll()[0];
?>
  <td width="10%" align="center"><?php echo"".$row['email']."";?></td>
  <td width="10%" align="center"><?php echo"".$row['tel_num']."";?></td>
</tr>
</table>

<?php
?>
