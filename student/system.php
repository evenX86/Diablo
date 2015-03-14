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
    $n = 1;
    $sql = "select count(*) as num from $Subject where audit='通过'";
    $query = $DB->prepare($sql);
    $result = $query->execute();
    $row = count($result);

    if (empty($offset)) {
        $offset = 0;
    }//if

    $pages = ceil($count / $PAGE_NUM);
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    }//if
    else {
        $page = 1;
    }

    $offset = $PAGE_NUM * ($page - 1);
    $sql = "select * from $Subject where audit='通过' order by teacher_ID desc";
    $n =1;
    foreach ($DB->query($sql) as $row) {
    //    print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
    if (($n % 2) != 0)
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
        $query_three = $DB->query($sql_three);
        $row_three = $query_three->fetchAll();
        $row_three = $row_three[0];
        $student_ID = $_COOKIE['cookie_user_ID'];
        $sql_four = "select major from $Student where student_ID='$student_ID'";
        $query_four = $DB->query($sql_four);
        $row_four = $query_four->fetchAll();
        $row_four = $row_four[0];

        //echo $row_three['major'].$row_four['major']."<br>";
        if ($row_three['major'] == $row_four['major']) {
            ?>
            <td width="3%" height="15">
                <div align="center" class="text"><?php echo "" . $n . ""; ?></div>
            </td>

            <td width="3%" height="15">
                <div align="center" class="text"><?php echo "" . $row['subject_ID'] . ""; ?></div>
            </td>

            <td width="15%" height="15">
                <div align="center" class="text"><?php echo "" . $row['subject_title'] . ""; ?></div>
            </td>

            <td width="3%" height="15">
                <div align="center" class="text"><?php echo "" . $row['teacher_ID'] . ""; ?></div>
            </td>

            <?php
            $teacher_ID = $row['teacher_ID'];
            $sql_one = "select teacher_name,degree from $Teacher where teacher_ID='$teacher_ID'";
            $query_one = $DB->query($sql_one) or die('连接错误..........！');
            $row_one = $query_one->fetchAll();
            $row_one = $row_one[0];
            ?>

            <td width="5%" height="15">
                <div align="center" class="text"><?php echo "" . $row_one['teacher_name'] . ""; ?></div>
            </td>

            <td width="5%" height="15">
                <div align="center" class="text"><?php echo "" . $row_one['degree'] . ""; ?></div>
            </td>

            <td width="4%" height="15">
                <div align="center" class="text">
                    <?php
                    $status = $row['status'];
                    if ($status == '已选') {
                        echo "<font color=\"#c8b8b8\">" . $status . "</font>";
                    }//if
                    else {
                        echo "<a href=subject.php?subject_ID=" . $row['subject_ID'] . "&student_ID=" . $_COOKIE['cookie_user_ID'] . "><font color=\"#bc0000\" size=\"4\">未选</font></a>";
                    }//else
                    ?>
                </div>
            </td>

            <?php
            $n++;
        }//if
        else {
            echo "???";
        }
        }//while
        ?>
</table>

<table width="860" border="0" cellspacing="0" cellpadding="0" align="center" class='text'>
    <tbody>
    <tr>
        <td width="200"><font color="#ff0000"><? $n--;
                echo "目前共有" . $n . "条记录." ?></font></td>
        <td width="200"><? echo "共" . $pages . "页"; ?></td>

        <?php
        $first = 1;
        $prev = $page - 1;
        $next = $page + 1;
        $last = $pages;

        if ($page > 1) {
            ?>
            <td width="140">
                <?php
                echo "<a href='system.php:page=" . $first . "'>首页</a>";
                ?>
            </td>
            <td width="140">
                <?php
                echo "<a href='system.php:page=" . $prev . "'>上一页</a>";
                ?>
            </td>

        <?php
        }//if

        if ($page < $pages) {
            ?>
            <td width="140">
                <?php
                echo "<a href='system.php:page=" . $next . "'>下一页</a>";
                ?>
            </td>
            <td width="140">
                <?php
                echo "<a href='system.php:page=" . $last . "'>尾页</a>";
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
$query = $DB->query($sql);
$count = count($query->fetchAll()[0]);
if ($count != 0)
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
    $query = $DB->query($sql);
    $row_one = $query->fetchAll();
    $row_one = $row_one[0];
    $teacher_ID = $row_one['teacher_ID'];
    $sql = "select teacher_name from $Teacher where teacher_ID='$teacher_ID'";
    $query = $DB->query($sql);
    $row_two = $query->fetchAll();
    $row_two =$row_two[0];

    $student_ID = $row_one['student_ID'];
    $sql = "select student_name from $Student where student_ID='$student_ID'";
    $query = $DB->query($sql);
    $row_three = $query->fetchAll();
    $row_three =$row_three[0];
    ?>
    <tr bgcolor="#FFFFFF" class="text">
        <td width="3%" align="center"><?php echo "" . $row_one['subject_ID'] . "";?></td>
        <td width="15%" align="center"><?php echo "" . $row_one['subject_title'] . "";?></td>
        <td width="3%" align="center"><?php echo "" . $row_one['teacher_ID'] . "";?></td>
        <td width="5%" align="center"><?php echo "" . $row_two['teacher_name'] . "";?></td>
        <td width="3%" align="center"><?php echo "" . $row_one['student_ID'] . "";?></td>
        <td width="5%" align="center"><?php echo "" . $row_three['student_name'] . "";?></td>
        <td width="5%" align="center"><?php echo "" . $row_one['status'] . "";?></td>
        <td width="5%"
            align="center"><?php echo "<a href=subject_modify.php?subject_ID=" . $row_one['subject_ID'] . "><font color=\"#bc0000\" size=\"4\">删除</a>";?></td>
    </tr>

    <?php
    } ?>
</table>
</body>
</html>
<br>
<br>
<? include("foot.php") ?>
