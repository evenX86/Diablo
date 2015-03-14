<?php
//导师信息查询
include("connect.php");
include("sys_header.php");
include("student_test.php");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link ref="stylesheet" href="style.css" type="text/css">
</head>

<body bgcolor="#e3f3ff">
<table width="770" border="0" cellspacing="1" cellpadding="0" class="text" align="center" bgcolor="#000000">
<form method="post" name="myfrorm" action="teacher_query.php">
<tr bgcolor="#FFFFFF">
<td width="770" height="30" colspan="5" class="text">
<div align="center">导师信息查询</div>
</td>
</tr>

<tr bgcolor="#aadeff">
<td class="text" width="116"><div align="center">导师编号</div></td>
<td width="297" height="30"><input type="text" name="teacher_ID"></td>
<td class="text" width="116"><div align="center">导师姓名</div></td>
<td width="297" height="30"><input type="text" name="teacher_name"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td class="text" width="116"><div align="center">所在学院</div></td>
<td width="297" height="30"><input type="text" name="college"></td>
<td class="text" width="116"><div align="center">所在专业</div></td>
<td width="297" height="30"><input type="text" name="major"></td>
</tr>

<tr bgcolor="aadeff">
<td height="25" colspan="4" valign="top" align="center">
<input type="hidden" name="query" value="查询">
<input type="submit" value="查询" class="text">
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td height="17" colspan="4" valign="top">
<div align="center"><font color="#FF0000">*请选择以上任一种或多种条件进行查询</font></div>
</td>
</tr>
</form>
</table>

<?php
$query = $_POST["query"];
$teacher_ID = $_POST["teacher_ID"];
$teacher_name = $_POST["teacher_name"];
$college = $_POST["college"];
$major = $_POST["major"];

if($query)
{
  if(empty($teacher_ID)&&empty($teacher_name)&&empty($college)&&empty($major))
  {
    echo "<script>alert ('请输入查询条件！');history.back();</script>";
    exit;
  }//if

  $sql = "select * from $Teacher where 1=1 "; //注意此处空格！！！
  if($teacher_ID)
  {
    $sql = $sql."and teacher_ID='$teacher_ID'";
  }//if

  if($teacher_name)
  {
    $sql = $sql."and teacher_name='$teacher_name'";
  }//if

  if($college)
  {
    $sql = $sql."and college like '%$college'";
  }//if

  if($major)
  {
    $sql = $sql."and major like '%$major'";
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
<td bgcolor="#FFFF"><div class="text" align="center">导师编号</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">姓名</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">性别</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">职称</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">E-mail</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">电话</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">学院</div></td>
<td bgcolor="#FFFF"><div class="text" align="center">专业</div></td>

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
  $query = mysql_query($sql_one) or die("连接错误！");;
//  $row_one = mysql_fetch_array($query);
  while($row_one = mysql_fetch_array($query))
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

  <td width="5%"><div align="center" class="text"><? echo "".$row_one['teacher_ID'].""; ?></div></td>
  <td width="5%"><div align="center" class="text"><? echo "".$row_one['teacher_name'].""; ?></div></td>
  <td width="5%"><div align="center" class="text"><? echo "".$row_one['sex'].""; ?></div></td>
  <td width="5%"><div align="center" class="text"><? echo "".$row_one['degree'].""; ?></div></td>

<?php
    $teacher_ID = $row_one['teacher_ID'];
    $sql_two = "select email,tel_num from $User where user_ID='$teacher_ID'";
    $query = mysql_query($sql_two);
    $row_two = mysql_fetch_array($query);
?>

  <td width="10%"><div align="center" class="text"><? echo "".$row_two['email'].""; ?></div></td>
  <td width="10%"><div align="center" class="text"><? echo "".$row_two['tel_num'].""; ?></div></td>


  <td width="13%"><div align="center" class="text"><? echo "".$row_one['college'].""; ?></div></td>
  <td width="17%"><div align="center" class="text"><? echo "".$row_one['major'].""; ?></div></td>
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
<font color="#FF0000"><? echo "目前共有".$count."条记录"?></font>
</td>
<td width="205"><? echo "共".$pages."页"; ?></td>

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
</body>
</html>
<br>
<br>
<?include("foot.php")?>
