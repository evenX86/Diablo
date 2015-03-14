<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>鑫湘毕业设计管理系统</title>
</head>

<?
include("connect.php");
include("checkout.js")
?>
<body>
<div style="text-align:center"><img src="images/head.jpg" alt="系统图标" /></div>

<table align="center" width="860" height="10" bgcolor="#000000" cellspacing="0">
<tr height="10" width="100%">
<td align="center" bgcolor="#3AA9F0" class="text">
<font color="e8f2f8">注&nbsp;册</font><font class="title">(注＊必填！)</font>
</td>
</tr>
</table>

<table align="center" width="860" border="1">
<form name="myform" method="post" action="SQL.php">
<tr height="10" width="100%">
<td align="right" class="text" width="40%">用户名</td>
<td align="left">
<input type="text" name="user_ID" />*
</td>
</tr>

<tr height="10" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">密码</td>
<td align="left">
<input type="password" name="user_passwd" />*
</td>
</tr>

<tr height="15" width="100%">
<td align="right" class="text" width="40%">密码确认</td>
<td align="left">
<input type="password" name="user_repasswd" />*
</td>
</tr>

<tr height="15" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">密码提示问题</td>
<td align="left">
<input type="text" name="question" />
</td>
</tr>

<tr height="15" width="100%">
<td align="right" class="text" width="40%">密码提示回答</td>
<td align="left">
<input type="text" name="answer" />
</td>
</tr>

<tr height="15" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">性别</td>
<td align="left">
<input checked="checked" type="radio" name="sex" id="sex_m" value="男"/>男&nbsp;
<input type="radio" name="sex" id="sex_f" value="女"/>女
</td>
</tr>

<tr height="15" width="100%">
<td align="right" class="text" width="40%">电子邮箱</td>
<td align="left">
<input type="text" name="email" />*
</td>
</tr>

<tr height="15" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">手机号码</td>
<td align="left">
<input type="text" name="tel_num" />*
</td>
</tr>

<tr height="15" width="100%">
<td align="right" class="text" width="40%">所在学院</td>
<td align="left">
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

<tr height="15" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">所学专业</td>
<td align="left">
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

<tr height="15" width="100%">
<td align="right" class="text" width="40%">等级权限</td>
<td align="left">
<input checked="checked" type="radio" name="degree"  value="学生"/>学生&nbsp;
<input type="radio" name="degree"  value="教师"/>教师
</td>
</tr>

<tr height="15" width="100%" bgcolor="#b4dffb">
<td align="right" class="text" width="40%">联系地址</td>
<td align="left">
<input type="text" name="address" />*
</td>
</tr>

<tr height="15" width="100%">
<td valign="top" class="text" colspan="4">
<div align="center">
<input type="submit" name="register" onclick=checkuser(this.form)  value="注册">
</div>
</td>
</tr>
</form>
</table>

</body>
</html>
<br>
<br>
<?include("foot.php")?>

