<?php
//论文信息添加
include("connect.php");
include("sys_header.php");
include("teacher_test.php");
?>
<body bgcolor="#e3f3ff">
<table width="600" height="100" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000"
       class="text">
    <form name="myform" method="post" action="deal_add.php">
        <tr bgcolor="#FFFFFF">
            <td colspan="4" align="center" height="30">
                <font size="4"><b>添加论文</b></font>
            </td>
        </tr>

        <tr>
            <td width="150" bgcolor="#aadeff" align="center">论文编号</td>
            <td width="262" bgcolor="#aadeff" height="30" colspan="2">
                <div align="center">
                    <input type="text" name="subject_ID" size="25">
                </div>
            </td>
        </tr>

        <tr>
            <td width="30%" bgcolor="#FFFFFF" align="center">论文题目</td>
            <td width="70%" bgcolor="#FFFFFF" height="30" colspan="2">
                <div align="center">
                    <input type="text" name="subject_title" size="25">
                </div>
            </td>
        </tr>

        <tr>
            <td width="125" bgcolor="#aadeff" align="center">教师编号</td>
            <td width="262" bgcolor="#aadeff" height="30" colspan="2">
                <div align="center">
                    <?php echo "" . $_COOKIE['cookie_user_ID'] . ""; ?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="125" bgcolor="#FFFFFF" align="center">论文状态</td>
            <td width="262" bgcolor="#FFFFFF" height="30" colspan="2">
                <div align="center">
                    <?php echo "未选"; ?>
                </div>
            </td>
        </tr>

        <tr bgcolor="#aadeff">
            <td height="22" colspan="4" align="center">
                <input type="hidden" name="submit" value="1">
                <input type="submit" name="submit" value="确定">
            </td>
        </tr>
    </form>
</table>
</body>
</html>


<br>
<br>
<?php include("../foot.php"); ?>

