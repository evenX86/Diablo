<?php
//学生功能
include("connect.php");
include("sys_header.php");
include("student_test.php");
?>
<html>
<head>
<title>浙江树人大学毕业设计管理系统</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body bgcolor="#e3f3ff">
<table width="860" border="1" cellspacing="0" cellpadding="0" align="center">
<tr>
<div align="center" class="text"><font size="4">课题列表</font></div>
</tr>

<tr>
<td width="50" bgcolor="#FFFF">
<div align="center" class="text">序号</div>
</td>

<td width="70" bgcolor="#FFFF">
<div align="center" class="text">课题编号</div>
</td>

<td width="200" bgcolor="#FFFF">
<div align="center" class="text">论文题目</div>
</td>

<td width="70" bgcolor="#FFFF">
<div align="center" class="text">导师编号</div>
</td>

<td width="70" bgcolor="#FFFF">
<div align="center" class="text">导师姓名</div>
</td>

<td width="70" bgcolor="#FFFF">
<div align="center" class="text">职称</div>
</td>


<td width="70" bgcolor="#FFFF">
<div align="center" class="text">请选题</div>
</td>
</tr>

<?php
$n=1;
$sql = "select count(*) as num from $Subject where audit='通过'";
$query = mysql_query($sql) or die ("连接错误！!!!!!!!!!!!!!!!!!");
$row = mysql_fetch_array($query);
$count = $row[num];

if(empty($offset))
{
  $offset = 0;
}//if

$pages = ceil($count/$PAGE_NUM);
if( isset($_GET['page']))
{
  $page = intval($_GET['page']);
}//if
else
{
  $page = 1;
}

$offset = $PAGE_NUM*($page - 1);
$sql = "select * from $Subject where audit='通过' order by teacher_ID desc limit $offset,$PAGE_NUM";
//$sql = "select * order by teacher_ID desc limit $offset,$PAGE_NUM";
$query = mysql_query($sql) or die("连接错误！~~~~~~~~~~~~~~");

while($row=mysql_fetch_array($query))
{
  if(($n%2)!=0)
  {
?>
<tr bgcolor="#FFFFFF">
<?php
  }//if
  else
  {
?>
    <tr bgcolor="#aadeff">
<?php
  }//else


  $teacher_ID = $row['teacher_ID'];
  $sql_three = "select major from $Teacher where teacher_ID='$teacher_ID'";
  $query_three = mysql_query($sql_three);
  $row_three = mysql_fetch_array($query_three);

  $student_ID = $_COOKIE['cookie_user_ID'];
  $sql_four = "select major from $Student where student_ID='$student_ID'";
  $query_four = mysql_query($sql_four);
  $row_four = mysql_fetch_array($query_four);

  if($row_three['major']==$row_four['major'])
  {
?>
<td width="3%" height="15">
<div align="center" class="text"><? echo "".$n."";?></div>
</td>

<td width="3%" height="15">
<div align="center" class="text"><? echo "".$row['subject_ID']."";?></div>
</td>

<td width="15%" height="15">
<div align="center" class="text"><? echo "".$row['subject_title']."";?></div>
</td>

<td width="3%" height="15">
<div align="center" class="text"><? echo "".$row['teacher_ID']."";?></div>
</td>

<?php
  $teacher_ID = $row['teacher_ID'];
  $sql_one = "select teacher_name,degree from $Teacher where teacher_ID='$teacher_ID'";
  $query_one = mysql_query($sql_one) or die('连接错误..........！');
  $row_one = mysql_fetch_array($query_one);
?>

<td width="5%" height="15">
<div align="center" class="text"><? echo "".$row_one['teacher_name']."";?></div>
</td>

<td width="5%" height="15">
<div align="center" class="text"><? echo "".$row_one['degree']."";?></div>
</td>

<td width="4%" height="15">
<div align="center" class="text">
<?php
  $status = $row['status'];
  if($status == '已选')
  {
    echo "<font color=\"#c8b8b8\">".$status."</font>";
  }//if
  else
  {
  echo "<a href=subject.php?subject_ID=".$row['subject_ID']."&student_ID=".$_COOKIE['cookie_user_ID']."><font color=\"#bc0000\" size=\"4\">未选</font></a>"; 
  }//else
?>
</div>
</td>

<?php
  $n++;
  }//if
}//while
?>
</table>

<table width="860" border="0" cellspacing="0" cellpadding="0" align="center" class='text'>
<tbody>
<tr>
<td width="200"><font color="#ff0000"><? $n--;echo"目前共有".$n."条记录."?></font></td>
<td width="200"><? echo"共".$pages."页";?></td>

<?php
$first = 1;
$prev = $page - 1;
$next = $page + 1;
$last = $pages;

if($page > 1)
{
?>
<td width="140">
<?php
  echo "<a href='system.php:page=".$first."'>首页</a>";
?>
</td>
<td width="140">
<?php
  echo "<a href='system.php:page=".$prev."'>上一页</a>";
?>
</td> 

<?php
}//if

if( $page < $pages)
{
?>
<td width="140">
<?php
  echo "<a href='system.php:page=".$next."'>下一页</a>";
?>
</td>
<td width="140">
<?php
  echo "<a href='system.php:page=".$last."'>尾页</a>";
?>
</td>
<?php
}//if
?>
</tr>
</tbody>
</table>

<?php
$student_ID = $_COOKIE['cookie_user_ID'];
$sql = "select * from $Subject where student_ID='$student_ID'";
$query = mysql_query($sql);
$count = mysql_num_rows($query);
if($count != 0)
{
?>
<br>
<hr width="860" color="#40cf79">
<table width="860" border="0" align="center" cellspacing="1" cellpadding="0" bgcolor="#000000">
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

<td bgcolor="#FFFF">
<div align="center" class="text">论文改选</div>
</td>
</tr>

<?php
//}//if

$sql = "select * from $Subject where student_ID='$student_ID'";
$query = mysql_query($sql);
$row_one = mysql_fetch_array($query);

$teacher_ID = $row_one['teacher_ID'];
$sql = "select teacher_name from $Teacher where teacher_ID='$teacher_ID'";
$query = mysql_query($sql);
$row_two = mysql_fetch_array($query);

$student_ID = $row_one['student_ID'];
$sql = "select student_name from $Student where student_ID='$student_ID'";
$query = mysql_query($sql);
$row_three = mysql_fetch_array($query);
?>
<tr bgcolor="#FFFFFF" class="text">
<td width="3%" align="center"><?echo "".$row_one['subject_ID']."";?></td>
<td width="15%" align="center"><?echo "".$row_one['subject_title']."";?></td>
<td width="3%" align="center"><?echo "".$row_one['teacher_ID']."";?></td>
<td width="5%" align="center"><?echo "".$row_two['teacher_name']."";?></td>
<td width="3%" align="center"><?echo "".$row_one['student_ID']."";?></td>
<td width="5%" align="center"><?echo "".$row_three['student_name']."";?></td>
<td width="5%" align="center"><?echo "".$row_one['status']."";?></td>
<td width="5%" align="center"><?echo "<a href=subject_modify.php?subject_ID=".$row_one['subject_ID']."><font color=\"#bc0000\" size=\"4\">删除</a>";?></td>
</tr>

<?php
}?>
</table>
</body>
</html>
<br>
<br>
<?include("foot.php")?>
