<?php
//学生功能
include("connect.php");
include("sys_header.php");
include("teacher_test.php");
?>

<html>
<head>
<title>浙江树人大学毕业设计管理系统</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
</html>

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
<div align="center" class="text">选题状态</div>
</td>
</tr>

<?php
$n=1;
$teacher_ID = $_COOKIE['cookie_user_ID'];
$sql = "select count(*) as num from $Subject where teacher_ID='$teacher_ID'";
$query = $DB->query($sql) or die ("连接错误！!!!!!!!!!!!!!!!!!");
$row = $query->fetchAll()[0];
$count = count($row)-1;;

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
//$teacher_ID = $_COOKIE['cookie_user_ID'];
$sql = "select * from $Subject where teacher_ID='$teacher_ID' order by teacher_ID desc limit $offset,$PAGE_NUM";
$query = $DB->query($sql) or die("连接错误！~~~~~~~~~~~~~~");

foreach($query->fetchAll()[0] as $row)
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

?>
<td width="3%" height="15">
<div align="center" class="text"><?php echo "".$n."";?></div>
</td>

<td width="3%" height="15">
<div align="center" class="text"><?php echo "".$row['subject_ID']."";?></div>
</td>

<td width="15%" height="15">
<div align="center" class="text"><?php echo "".$row['subject_title']."";?></div>
</td>

<td width="3%" height="15">
<div align="center" class="text"><?php echo "".$row['teacher_ID']."";?></div>
</td>

<?php
  $teacher_ID = $row['teacher_ID'];
  $sql_one = "select teacher_name,degree from $Teacher where teacher_ID='$teacher_ID'";
  $query_one = $DB->query($sql_one) or die('连接错误..........！');
  $row_one = $query_one->fetchAll()[0];
?>

<td width="5%" height="15">
<div align="center" class="text"><?php echo "".$row_one['teacher_name']."";?></div>
</td>

<td width="5%" height="15">
<div align="center" class="text"><?php echo "".$row_one['degree']."";?></div>
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
  echo "<font color=\"#bc0000\" size=\"4\">未选</font>"; 
  }//else
?>
</div>
</td>

<?php
  $n++;
}//while
?>
</table>

<table width="860" border="0" cellspacing="0" cellpadding="0" align="center" class='text'>
<tbody>
<tr>
<td width="200"><font color="#ff0000"><?php echo"目前共有".$count."条记录."?></font></td>
<td width="200"><?php echo"共".$pages."页";?></td>

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
</body>
</html>

<br>
<br>
<?include("foot.php")?>
