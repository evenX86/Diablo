<?php include("header.php"); ?>
<body bgcolor="#e3f3ff">
<div style="text-align:center"><img src="images/head.jpg" alt="系统图标"/></div>

<table width=970 align="center" bgcolor="#e3f3ff">
    <tr>
        <td align="right" class="title" width="64%"><a href="index.php">系统首页</a></td>
        <td align="right" class="title" width="12%"><a href="register.php">用户注册</a></td>
        <td align="right" class="title" width="12%"><a href="help.php">帮助信息</a></td>
        <td align="right" class="title" width="12%"><a href="contact.php">联系反馈</a></td>
    </tr>
</table>

<hr style="border-style: dotted;" size="5" width="970" color="#40cf79">

<table height="400" width="970" align="center" bgcolor="#E3F3FF">
    <tr height="10">
    </tr>

    <tr>
        <td width="10">
        </td>
        <td height="342" width="290" align="left" style="background-image:url(images/login.jpg)">
            <form id="myform" method="post" action="login.php">
                <ul>
                    <br>
                    <br>
                    <br>
                    <br>
                    <li>
                        <label><font color="#dbeefd">用户名:</font></label><input style="height:25px" size="10"
                                                                               name="user_ID" type="text" id="user_ID"/>
                    </li>
                    <br>
                    <li>
                        <label><font color="dbeefd">密&nbsp;&nbsp;码:</font></label><input style="height:26px" size="10"
                                                                                         name="user_passwd"
                                                                                         type="password"
                                                                                         id="user_passwd"/>
                    </li>

                    <li>
                        <table width="100%" border="0">
                            <tr height="10"></tr>
                            <tr>
                                <td align="left" style="font-size:12px">
                                    <input checked="checked" type="radio" name="RadioButton" id="RadioButton1"
                                           value="学生"/>
                                    <label for="RadioButton1">学生</label>
                                    <input type="radio" name="RadioButton" id="RadioButton2" value="教师"/>
                                    <label for="RadioButton2">教师</label>
                                    <input type="radio" name="RadioButton" id="RadioButton3" value="管理员"/>
                                    <label for="RadioButton2">管理员</label>
                                </td>
                            </tr>
                        </table>
                    </li>

                    <li>
                        <table width="100%">
                            <tr height="10"></tr>
                            <tr>
                                <td width="35px"></td>
                                <td align="left">

                                    <input type="submit" name="Button" id="Button1" value="登录"/>
                                    <input type="reset" name="reset" id="Button2" value="重置" onclik="history.back();"/>
                                </td>
                            </tr>
                        </table>
                    </li>
                </ul>
            </form>
        </td>

        <td align="left" class="text">
            <div align="center"><font color="red">使用须知</font></div>
            <ol>
                <li>1.本网站只对本校师生开放！</li>
                <br>
                <li>2.本站详细内容须登陆后方可查阅，未登陆用户只能查看首页的相关内容！</li>
                <br>
                <li>3.本校师生可在特定的开放时间内注册，经管理员验证后方可进行登陆使用！</li>
                <br>
                <li>4.本校的师生注册时，用户名请使用自己的编号或学号！</li>
                <br>
                <li>5.如若忘记密码请到教务处查询！</li>
            </ol>
        </td>
    </tr>
    <tr>
    </tr>
</table>
<?php include("foot.php"); ?>
