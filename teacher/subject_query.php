<?php
//论文信息查询
include("connect.php");
include("sys_header.php");
include("teacher_test.php");
?>
<br>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link ref="stylesheet" href="style.css" type="text/css">
</head>
</html>

<body bgcolor="#e3f3ff">
<table width="770" border="0" cellspacing="1" cellpadding="0" class="text" align="center" bgcolor="#000000">
<form method="post" name="myfrorm" action="subject_query.php">
<tr bgcolor="#FFFFFF">
<td width="770" height="30" colspan="5" class="text">
<div align="center">论文信息查询</div>
</td>
</tr>

<tr bgcolor="#aadeff">
<td class="text" width="116"><div align="center">论文编号</div></td>
<td width="297" height="30"><input type="text" name="subject_ID"></td>
<td class="text" width="116"><div align="center">论文题目</div></td>
<td width="297" height="30"><input type="text" name="subject_title"></td>
</tr>

<tr bgcolor="FFFFFF">
<td height="25" colspan="4" valign="top" align="center">
<input type="hidden" name="query" value="查询">
<input type="submit" value="查询" class="text">
</td>
</tr>

<tr bgcolor="#aadeff">
<td height="17" colspan="4" valign="top">
<div align="center"><font color="#FF0000">*请选择以上任一种或多种条件进行查询</font></div>
</td>
</tr>
</form>
</table>
</body>
</html>

<?php
$query = $_POST["query"];
$subject_ID = $_POST["subject_ID"];
$subject_title = $_POST["subject_title"];

if($query)
{
  if(empty($subject_ID)&&empty($subject_title))
  {
    echo "<script>alert ('请输入查询条件！');history.back();</script>";
    exit;
  }//if

  $sql = "select * from $Subject where 1=1 "; //注意此处空格！！！
  if($subject_ID)
  {
    $sql = $sql."and subject_ID='$subject_ID'";
  }//if

  if($subject_title)
  {
    $sql = $sql."and subject_title like '%$subject_title'";
  }//if

$query = mysql_query($sql);
$count = mysql_num_rows($query);
if(empty($count))
{
  echo "<script>alert ('无相关记录,请检查！');history.back();</script>";
  exit;
}//if
else
{
  if(empty($offset))
  {
    $offset = 0;
  }//if
?>
<br>
<table width="860" border="0" cellspacing="1" cellpadding="0" bgcolor="#000000" align="center">
<tr>
<td bgcolor="#FFFF"><div class="text" align="center">论文编号</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">论文题目</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">导师编号</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">导师姓名</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">学生学号</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">学生姓名</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">论文状态</div></td>

<?php
  $n = 1;
  $pages = ceil($count/$PAGE_NUM);
  if(isset($_GET['page']))
  {
    $page = intval($_GET['page']);
  }//if
  else
  {
    $page = 1;
  }//else
  $offset = $PAGE_NUM*($page - 1);

  $sql_one = $sql."order by teacher_ID desc limit $offset,$PAGE_NUM";
  $query_one = mysql_query($sql_one) or die("连接错误！");;
//  $row_one = mysql_fetch_array($query);
  while($row_one = mysql_fetch_array($query_one))
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

  <td width="5%"><div align="center" class="text"><?php echo "".$row_one['subject_ID'].""; ?></div></td>
  <td width="20%"><div align="center" class="text"><?php echo "".$row_one['subject_title'].""; ?></div></td>
  <td width="5%"><div align="center" class="text"><?php echo "".$row_one['teacher_ID'].""; ?></div></td>

<?php
    $teacher_ID = $row_one['teacher_ID'];
    $sql_two = "select teacher_name from $Teacher where teacher_ID='$teacher_ID'";
    $query_two = $DB->query($sql_two);
    $row_two = $query_two->fetchAll()[0];
?>

  <td width="7%"><div align="center" class="text"><?php echo "".$row_two['teacher_name'].""; ?></div></td>
  <td width="5%"><div align="center" class="text"><?php echo "".$row_one['student_ID'].""; ?></div></td>

<?php
    $student_ID = $row_one['student_ID'];
    $sql_three = "select student_name from $Student where student_ID='$student_ID'";
    $query_three = $DB->query($sql_three);
    $row_three = $query_three->fetchAll()[0];
?>

  <td width="7%"><div align="center" class="text"><?php echo "".$row_three['student_name'].""; ?></div></td>
  <td width="7%"><div align="center" class="text"><?php echo "".$row_one['status'].""; ?></div></td>
</tr>
<?php
  $n++;
  }//while
?>
</table>

<table width="860" border="0" cellspacing="0" cellpadding="0" align="center" class="text">
<tbody>
<tr>
<td width="159">
<font color="#FF0000"><?php echo "目前共有".$count."条记录"?></font>
</td>
<td width="205"><?php echo "共".$pages."页"; ?></td>

<?php
  $first = 1;
  $prev = $page - 1;
  $next = $page + 1;
  $last = $pages;

  if($page > 1)
  {
?>
<td width="132">
<?php
    echo "<a href='teacher_query.php?page=".$first."'>首页</a>";
?>
</td>
<td width="132">
<?php
    echo "<a href='teacher_query.php?page=".$prev."'>上一页</a>";
?>
</td>
<?php
  }//if
  if($page < $pages)
  {
?>
<td width="132">
<?php
    echo "<a href='teacher_query.php?pag=".$next."'>下一页</a>";
?>
</td>
<td width="132">
<?php
    echo "<a href='teacher_query.php?pag=".$last."'>尾页</a>";
?> 
 </td> 
<?php
  }//if
?>
</tr>
</tbody>
</table>

<?php
}//else
}//if
?>
<br>
<br>
<?include("foot.php")?>
