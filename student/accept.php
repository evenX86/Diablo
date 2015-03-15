<?php
include("student_test.php");
include("connect.php");
include("sys_header.php");
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>浙江树人大学毕业设计管理系统</title>
</head>

<body bgcolor="#e3f3ff">
<table width="860" align="center" cellspacing="1" cellpadding="0" border="0">
<tr>
<td colspan="4" class="text" align="center">
<font size="5">收件箱</font>
</td>
</tr>

<tr>
<td width="20%"><div class="text">发件人</div></td>
<td width="40%"><div class="text">主题</div></td>
<td width="15%"><div class="text">时间</div></td>
<td><div align="right" class="text">删除</div></td>

<?php
$n = 1;

$to = $_COOKIE['cookie_user_ID'];
$sql_one = "select count(*) as num from $Message where M_to='$to'";
$query_one = $DB->query($sql_one);
$row_one = $query_one->fetchAll();
$count = count($row_one[0]);

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
$sql = "select M_from,M_title,M_time from $Message where M_to='$to' order by M_time desc limit $offset,$PAGE_NUM";
$query = $DB->query($sql) or die ('连接错误！');
$res = $query->fetchAll()[0];
foreach($res as $row)
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
  <td width="30%"><div class="title"><?php echo "".$row['M_from'].""; ?></div></td>
<?php
  $M_title = $row['M_title'];
  $sql_two = "select M_ID from $Message where M_to='$to' and M_title='$M_title'";
  $query_two = $DB->query($sql_two);
  $row_two = $query_two->fetchAll();
?>
  <td width="35%"><div class="title"><?php echo "<a href=accept_content.php?M_from=".$row['M_from']."&M_ID=".$row_two['M_ID']."><font color=\"#000000\">".$row['M_title']."</font></a>"; ?></div></td>

  <td width="20%"><div class="title"><?php echo "".$row['M_time'].""; ?></div></td>
  <td width="15%"><div align="right" class="title"><?php echo "<a href=accept_del.php?M_from=".$row['M_from']."&M_time=".$row['M_time']."><font color=\"#bc0000\" size=\"3\">删除</font></a>"; ?></div></td>
</tr>
<?php
  $n++;
}//while
?>
</table>

<br>
<table width="860" border="0" cellspacing="0" cellpadding="0" align="center" class="text">
<tbody>
<tr>
<td width="159">
<font color="#FF0000"><?php echo "目前共有".$count."条记录"?></font>
</td>
<td width="205"><?php echo"共有".$pages."页";?></td>

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
  echo "<a href='accept.php?page=".$first."'>首页</a>";
?>
</td>
<td width="132">
<?php
  echo "<a href='accept.php?page=".$prev."'>上一页</a>";
?>
</td>
<?php
}//if
if($page < $pages)
{
?>
<td width="132">
<?php
  echo "<a href='accept.php?page=".$next."'>下一页</a>";
?>
</td>
<td width="132">
<?php
  echo "<a href='accept.php?page=".$last."'>尾页</a>";
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
<?php include("foot.php");?>
