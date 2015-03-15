<?php
//管理员功能
include("connect.php");
include("sys_header.php");
include("admin_test.php");
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
        <div align="center" class="text"><font size="4">课题审核</font></div>
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
            <div align="center" class="text">审核</div>
        </td>
    </tr>

    <?php
    $n = 1;
    $sql = "select count(*) as num from $Subject where audit='审核'";
    $query = $DB->query($sql);
    $row = $query->rowCount();
    $count = $row-1;

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
    //$teacher_ID = $_COOKIE['cookie_user_ID'];
    $sql = "select * from $Subject where audit='审核' order by teacher_ID desc";
    $query = $DB->query($sql);
    $result =$query->fetchAll();
    foreach ($result as $row)
    {
    var_dump($row);
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

        ?>
        <td width="3%" height="15">
            <div align="center" class="text"><?php echo "" . $n . "";?></div>
        </td>

        <td width="3%" height="15">
            <div align="center" class="text"><?php echo "" . $row['subject_ID'] . "";?></div>
        </td>

        <td width="15%" height="15">
            <div align="center" class="text"><?php echo "" . $row['subject_title'] . "";?></div>
        </td>

        <td width="3%" height="15">
            <div align="center" class="text"><?php echo "" . $row['teacher_ID'] . "";?></div>
        </td>

        <?php
        $teacher_ID = $row['teacher_ID'];
        $sql_one = "select teacher_name,degree from $Teacher where teacher_ID='$teacher_ID'";
        $query_one = mysql_query($sql_one) or die('连接错误..........！');
        $row_one = mysql_fetch_array($query_one);
        ?>

        <td width="5%" height="15">
            <div align="center" class="text"><?php echo "" . $row_one['teacher_name'] . "";?></div>
        </td>

        <td width="5%" height="15">
            <div align="center" class="text"><?php echo "" . $row_one['degree'] . "";?></div>
        </td>

        <td width="4%" height="15">
            <div align="center" class="text">
                <?php
                $audit = $row['audit'];
                if ($audit == '审核') {
                    echo "<a href=audit.php?subject_ID=" . $row['subject_ID'] . "><font color=\"#bc0000\" size=\"4\">通过</font></a>";
                }//if
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
        <td width="200"><font color="#ff0000"><?php echo "目前共有" . $count . "条记录." ?></font></td>
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
</body>
</html>

<br>
<br>
<?php include("foot.php") ?>
