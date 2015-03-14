<?php
include("connect.php");
//将注册信息写入数据库
$register = $_POST['register'];
if($register == "注册")
{
$user_ID = $_POST['user_ID'];
$user_passwd = $_POST['user_passwd'];
$user_repasswd = $_POST['user_repasswd'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$sex = $_POST['sex'];
$email = $_POST['email'];
$tel_num = $_POST['tel_num'];
$college = $_POST['college'];
$major = $_POST['major'];
$degree = $_POST['degree'];
$address = $_POST['address'];

if(strlen($user_ID)=="8")
{
  if($degree == '学生')
  {
  $sql = "select * from $Student where student_ID='$user_ID'";
  $count = mysql_query($sql);
  $num = mysql_num_rows($count);
  if($num==0)
  {
    echo "<script>alert('此用户不存在,请检查！');history.back();</script>";
    exit();
  }//if
  else
  {
  $sql = "select * from $Student where student_ID='$user_ID' and sex='$sex'";
  $count = mysql_query($sql);
  $num = mysql_num_rows($count);
  if($num==0)
  {
    echo "<script>alert('性别不符,请检查！');history.back();</script>";
    exit();
  }//if

  $sql = "select * from $Student where student_ID='$user_ID' and college='$college' and major='$major'";
  $count = mysql_query($sql);
  $num = mysql_num_rows($count);
  if($num==0)
  {
    echo "<script>alert('所在学院或所学专业不符,请检查！');history.back();</script>";
    exit();
  }//if 
  }//else
  }//if

  if($degree == '教师')
  {
  $sql = "select * from $Teacher where teacher_ID='$user_ID'";
  $count = mysql_query($sql);
  $num = mysql_num_rows($count);
  if($num==0)
  {
    echo "<script>alert('此用户不存在,请检查！');history.back();</script>";
    exit();
  }//if
  else
  {
  $sql = "select * from $Teacher where teacher_ID='$user_ID' and sex='$sex'";
  $count = mysql_query($sql);
  $num = mysql_num_rows($count);
  if($num==0)
  {
    echo "<script>alert('性别不符,请检查！');history.back();</script>";
    exit();
  }//if

  $sql = "select * from $Teacher where teacher_ID='$user_ID' and college='$college' and major='$major'";
  $count = mysql_query($sql);
  $num = mysql_num_rows($count);
  if($num==0)
  {
    echo "<script>alert('所在学院或专业不符,请检查！');history.back();</script>";
    exit();
  }//if
  }//else
  }//if

  $sql = "select * from $User where user_ID='$user_ID'";
  $count = mysql_query($sql);
  $num = mysql_num_rows($count);
  if($num!=0)
  {
    echo "<script>alert('此用户已经注册,请检查！');history.back();</script>";
    exit();
  }//if
  else
    if($user_ID!="" && $user_passwd!="" && $sex!="" && $email!="" && $tel_num!="" && $degree!="" && $address!="")
    {
      $QUERY = mysql_query("INSERT INTO $User VALUES ('$user_ID','$user_passwd','$question','$answer','$sex','$email','$tel_num','$college','$major','$degree','$address')");

      if($QUERY)       //注意！！！！！！！！！！！！！！！
      {
        if($degree == '学生')
        {
        $SQL = "SELECT student_name FROM $Student WHERE student_ID='$user_ID'";
        $QUERY = mysql_query($SQL);
        $row = mysql_fetch_array($QUERY);
        $student_name = $row['student_name'];
        echo "<p align=\"center\"><b><big>学生: $student_name 感谢您的注册！<br><font color='red'><a href='index.php'>点此返回登录</a></font></big></b></p>";
        }//if'学生'
        else
        {
        $SQL = "SELECT * FROM $Teacher WHERE teacher_ID='$user_ID'";
        $QUERY = mysql_query($SQL);
        $row = mysql_fetch_array($QUERY);
        $teacher_name = $row['teacher_name'];
        echo "<p align=\"center\"><b><big>教师：$teacher_name 感谢您的注册！<br><font color='red'><a href='index.php'>点此返回登录</a></font></big></b></p>";
        }//else'教师'
      }//if
    }//if
    else
    {
       echo "<script>history.back();</script>";
    }//else
}//if
else
{
  echo "<script>history.back();</script>";
}//else
}//if
?>
