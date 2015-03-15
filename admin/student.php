<?php
//学生信息添加
include("connect.php");
include("sys_header.php");
include("admin_test.php");
?>
<br>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css">
<title>浙江树人大学毕业设计管理系统</title>
</head>

<body bgcolor="#e3f3ff">
<table width="600" height="100" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000" class="text">
<form name="myform" method="post" action="student.php">
<tr bgcolor="#FFFFFF">
<td colspan="4" align="center" height="30">
<font size="4"><b>添加学生信息</b></font>
</td>
</tr>

<tr>
<td width="150" bgcolor="#aadeff" align="center">学生学号</td>
<td width="262" bgcolor="#aadeff" height="30" colspan="2">
<div align="left">
<input type="text" name="student_ID" size="30">
</div>
</td>
</tr>

<tr>
<td width="30%" bgcolor="#FFFFFF" align="center">学生姓名</td>
<td width="70%" bgcolor="#FFFFFF" height="30" colspan="2">
<div align="left">
<input type="text" name="student_name" size="30">
</div>
</td>
</tr>

<tr>
<td width="125" bgcolor="#aadeff" align="center">学生性别</td>
<td width="262" bgcolor="#aadeff" height="30" colspan="2" align="center">
<input checked="checked" type="radio" name="sex" value="男" />男&nbsp;
<input type="radio" name="sex" value="女" />女
</td>
</tr>

<tr>
<td width="125" bgcolor="#FFFFFF" align="center">所在学院</td>
<td width="300" bgcolor="#FFFFFF" height="30" colspan="2" align="center">
<select name="college">
<option>电子信息工程学院</option>
<option>法学院</option>
<option>管理学院</option>
<option>化学与材料科学学院</option>
<option>计算机科学学院</option>
<option>经济学院</option>
<option>美术学院</option>
<option>民族学与社会学学院</option>
<option>生命科学学院</option>
<option>外语学院</option>
<option>文学与新闻传播学院</option>
</select>
</td>
</tr>

<tr>
<td width="125" bgcolor="#aadeff" align="center">所在专业</td>
<td width="300" bgcolor="#aadeff" height="30" colspan="2" align="center">
<select name="major">
<option>电子信息工程专业</option>
<option>通信工程专业</option>
<option>生物医学工程专业</option>
<option>光信息科学与技术专业</option>
<option>法学专业</option>
<option>汉语言文学专业</option>
<option>对外汉语专业</option>
<option>新闻学专业</option>
<option>广播电视新闻学专业</option>
<option>广告学专业</option>
<option>民族学专业</option>
<option>社会工作专业</option>
<option>社会学专业</option>
<option>历史学专业</option>
<option>政治学与行政学专业</option>
<option>思想政治教育专业</option>
<option>英语专业</option>
<option>日语专业</option>
<option>艺术设计专业</option>
<option>美术学专业</option>
<option>动画专业</option>
<option>信息管理与信息系统专业</option>
<option>电子商务专业</option>
<option>旅游管理专业</option>
<option>工商管理专业</option>
<option>市场营销专业</option>
<option>会计学专业</option>
<option>财务管理专业</option>
<option>人力资源管理专业</option>
<option>行政管理专业</option>
<option>公共事业管理专业</option>
<option>劳动与社会保障专业</option>
<option>应用心理学专业</option>
<option>教育学专业</option>
<option>经济学专业</option>
<option>国际经济与贸易专业</option>
<option>金融学专业</option>
<option>保险学专业</option>
<option>金融工程专业</option>
<option>计算机科学与技术专业</option>
<option>软件工程专业</option>
<option>网络工程专业</option>
<option>自动化专业</option>
<option>信息与计算科学专业</option>
<option>数学与应用数学专业</option>
<option>统计学专业</option>
<option>应用化学专业</option>
<option>材料化学专业</option>
<option>化学工程与工艺专业</option>
<option>环境科学专业</option>
<option>环境工程专业</option>
<option>生物工程专业</option>
<option>生物技术专业</option>
<option>药学专业</option>
<option>药物制剂专业</option>
<option>化学生物学专业</option>
</select>
</td>
</tr>

<tr>
<td width="30%" bgcolor="#FFFFFF" align="center">所在班级</td>
<td width="70%" bgcolor="#FFFFFF" height="30" colspan="2">
<div align="left">
<input type="text" name="class" size="30">
</div>
</td>
</tr>

<tr>
<td class="text" colspan="4" align="center" bgcolor="#aadeff">
<input type="submit" name="submit" value="确定">
</td>
</tr>

</form>
</table>
</body>
</html>

<?php
$submit = $_POST['submit'];
$student_ID = $_POST['student_ID'];
$student_name = $_POST['student_name'];
$sex = $_POST['sex'];
$college = $_POST['college'];
$major = $_POST['major'];
$class = $_POST['class'];

if($submit)
{
  if(empty($student_ID) && empty($student_name) && empty($sex) && empty($college) && empty($major) && empty($class))
  {
    echo "<script>alert ('请完善学生信息！');history.back();</script>";
    exit();
  }//if
  else
  {
    $sql = "insert into $Student (student_ID,student_name,sex,college,major,class) values ('$student_ID','$student_name','$sex','$college','$major','$class')";
    $query = $DB->prepare($sql);
    $flag = $query->execute();

    if($flag)
    {
      echo "<script>alert ('学生信息添加成功！');</script>";
      echo "<html><meta http-equiv=\"refresh\" content=\"0; url=student.php \"></html>";
      exit();
    }//if
     else {
       echo "<script>alert ('学生信息添加失败！');</script>";
       echo "<html><meta http-equiv=\"refresh\" content=\"0; url=student.php \"></html>";
       exit();
     }
  }//else
}//if
?>
<br>
<br>
<?php include("foot.php");?>

