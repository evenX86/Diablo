<?php
//信息发送
include("connect.php");
include("sys_header.php");
include("student_test.php");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css">
<title>带附件的邮件发送</title>
</head> 

<body bgcolor="#e3f3ff">
<table width="860" align="center" border="0">
<form name="form1" action="send.php" method="post">
<tr>
<td class="text" align="center">
<font size="5">发件箱</font>
</td>
</tr>

<tr>
<td align="left" class="text">
发件人：<?echo "".$_COOKIE['cookie_user_ID']."";?><br>
</td>
</tr>

<tr>
<td class="text">
收件人：<input type="text" name="to"><br>
</td>
</tr>

<tr>
<td class="text">
主&nbsp;&nbsp;&nbsp;题：<input type="text" name="subject"><br>

附&nbsp;&nbsp;&nbsp;件：
<form name="form2" enctype="multipart/form-data" action="upload.php" method="post">
<input type="hidden" name="max_file_size" value="100000">
<input name="upload_file" type="file">
<input type="submit" name="upload" value="上传">
</form>
<br>

内&nbsp;&nbsp;&nbsp;容：<br>
<textarea rows="15" cols="60" name="content"></textarea><br>
</td>
</tr>

<tr>
<td>
<input type="submit" name="send" value="发送">
</td>
</tr>
</form>
</table>
</body>
</html>

<?php
include("foot.php");
?>

<?php
//$from = $_POST['from'];
$to = $_POST['to'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$send = $_POST['send'];

if($send == '发送')
{
  if(empty($to))
  {
    echo "<script>alert ('收件人不可为空！');</script>";
    exit();
  }//if
  else
  {
    $sql = "select * from $User where user_ID='$to'";
    $query = $DB->query($sql);
    $count = count($query->fetchAll()[0]);
    if($count == 0)
    {
      echo "<script>alert ('收件人不存在，请检查！');</script>";
      exit();
    }//if
  }//else

  if(empty($subject))
  {
    echo "<script>alert ('主题不可为空！');</script>";
    exit();
  }//if
 
  $from = $_COOKIE['cookie_user_ID'];
  $time = date("Y-m-d");
 $sql = "insert into $Message (M_title,M_content,M_from,M_to,M_time) value ('$subject','$content','$from','$to','$time')";
  $query = mysql_query($sql);
  if($query)
  {
    echo "<script>alert ('发送成功！');</script>";
    exit();
  }//if
}//if
?>

