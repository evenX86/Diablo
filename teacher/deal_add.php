<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 2015/3/15
 * Time: 14:59
 */
//论文信息添加
include("connect.php");
include("sys_header.php");
include("teacher_test.php");
$submit = $_POST['submit'];
$subject_ID = $_POST['subject_ID'];
$subject_title = $_POST['subject_title'];
$teacher_ID = $_COOKIE['cookie_user_ID'];
if($submit)
{
    if(empty($subject_ID) || empty($subject_title))
    {
        echo "<script>alert ('请输入论文编号和题目！');</script>";
        exit();
    }//if
    else
    {
        $sql = "insert into $Subject (subject_ID,subject_title,teacher_ID,status) values ('$subject_ID','$subject_title','$teacher_ID','未选')";
        $query = $DB->prepare($sql);
        $query = $query->execute();

        if($query)
        {
            echo "<script>alert ('论文添加成功！');history.go(-1);</script>";
            exit();
        }//if
        else {
            echo "<script>alert ('论文添加失败！');history.go(-1);</script>";
        }
    }//else
}//if
