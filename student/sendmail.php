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
<form name="form1" action="sendmail.php" method="post" ENCTYPE="multipart/form-data">
<tr>
<td class="text" align="center">
<font size="5">发件箱</font>
</td>
</tr>

<tr>
<td align="left" class="text">
发件人：&nbsp;<?echo "".$_COOKIE['cookie_user_ID']."";?><br>
</td>
</tr>

<tr>
<td class="text">
收件人：&nbsp;<input type="text" name="to"><br>
</td>
</tr>

<tr>
<td class="text">
主&nbsp;&nbsp;&nbsp;题：
<input type="text" name="subject">
</td>
</tr>

<tr>
<td class="text">
附&nbsp;&nbsp;&nbsp;件：
<input name="upload_file" type="file">
</td>
</tr>

<tr>
<td class="text">
内&nbsp;&nbsp;&nbsp;容：<br>
<textarea rows="15" cols="60" name="body"></textarea><br>
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
$from = $_COOKIE['cookie_user_ID'];
$to = $_POST['to'];
$subject = $_POST['subject'];
$body = $_POST['body'];
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
    $query = mysql_query($sql);
    $count = mysql_num_rows($query);
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

  //定义分界线
  $boundary = "345894369383";   //分界线是一串无规律的字符
  //设置header
  $header = "Content-type:multipart/mixed; boundary= $boundary\r\n";
  $header .= "From:$from\r\n";
  //获得上传文件的文件内容
  $file = $_FILES['upload_file']['tmp_name'];
  //确定上传文件的MIME类型
  $mimeType = $_FILES['upload_file']['type'];
  //获得上传文件的文件名
  $filename = $_FILES['upload_file']['name'];
  //读取上传文件
  $fp = fopen($file,"r");    //打开文件
  $read = fread($fp,filesize($file));     //读入文件
  $read = base64_encode($read);           //base64编码
  $read = chunk_split($read);             //切割字符串
  //建立邮件主体，分为邮件和附件两部分
  $body = "--$boundary
    Content-type:text/plain; charset=iso-8859-1
    Content-transfer-encoding:8bit
    $body
    --$boundary
    Content-type:$mimeType; name=$fileName
    Content-dispostion:attachment;filename=$fileName
    Content-transfer-encoding:base64
    $read
    --$boundary";
  //发送邮件，并输出是否发送成功信息
  if(mail($to,$subject,$body,$header))
  {
    $time = date("Y-m-d");
    $sql = "insert into $Message (M_title,M_content,M_from,M_to,M_time,M_upfilename) value ('$subject','$body','$from','$to','$time','$fileName')";
    $query = mysql_query($sql);
    if($query)
    {
      echo "<script>alert ('发送成功！');</script>";
      exit();
    }//if
  }//if
  else
  {
    echo "<script>alert ('发送失败！');</script>";
    exit();
  }//else
}//if
?>

