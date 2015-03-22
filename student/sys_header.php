<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <title>浙江树人大学毕业设计管理系统</title>
    <link href="../resources/css/bootstrap-theme.css">
    <link href="../resources/css/bootstrap.css">
    <script type="text/javascript" src="../resources/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        <!--
        (document.getElementById ? DOMCapable = true : COMCapable = false);
        function hide(menuName) {
            if (DOMCapable) {//仅对DOM浏览器隐藏菜单
                var theMenu = document.getElementById(menuName + "choices");
                try{
                    theMenu.style.visibility = 'hidden';
                }catch (e){
                    console.log(menuName + "choices : " + e);
                }
            }//if
        }//hide

        function show(menuName) {
            if (DOMCapable) {
                var theMenu = document.getElementById(menuName + "choices");
                theMenu.style.visibility = 'visible';
            }//if
        }//show
        //-->
    </script>
</head>

<body>
<div style="text-align:center">
    <img src="images/head.jpg" alt="系统图标"/>
</div>

<div>

    <div id="menu3" onmouseover="show('menu3');" onmouseout="hide('menu3');">
        <div class="menuHead"><a href="system.php">系统首页</a></div>
    </div>

    <div id="menu4" onmouseover="show('menu4');" onmouseout="hide('menu4');">
        <div class="menuHead">信息查询</div>
        <div id="menu4choices" class="menuChoices">
            <a href="student_query.php">学生信息</a><br>
            <a href="teacher_query.php">导师信息</a><br>
            <a href="subject_query.php">论文信息</a><br>
        </div>
    </div>

    <div id="menu5" class="menu" onmouseover="show('menu5');" onmouseout="hide('menu5');">
        <div class="menuHead">信息修改</div>
        <div id="menu5choices" class="menuChoices">
            <a href="register_modify.php">注册信息</a><br>
            <a href="passwd_modify.php">密码修改</a><br>
        </div>
    </div>

    <div id="menu6" onmouseover="show('menu6');" onmouseout="hide('menu6');">
        <div class="menuHead">信息传递</div>
        <div id="menu6choices" class="menuChoices">
            <a href="sendmail.php">信息发送</a><br>
            <a href="accept.php">信息接收</a><br>
        </div>
    </div>

    <div id="menu7" class="menu" onmouseover="show('menu7');" onmouseout="hide('menu7');">
        <div class="menuHead"><a href="student_clear_cookie.php">退出登录</a></div>
    </div>
</div>
<script type="text/javascript">
    <!--
    if (DOMCapable) {
        hide('menu3');
        hide('menu4');
        hide('menu5');
        hide('menu6');
    }//if
    //-->
</script>

<br>
<hr style="BORDER-BOTTOM-STYLE:dotted;BORDER-LEFT-STYLE:dotted; BORDER-BIGHT-STYLE:dotted; BORDER-TOP-STYLE:dotted"
    size="5" width="970" color="#40cf79">
