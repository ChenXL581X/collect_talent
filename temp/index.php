<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
<?php
if($_POST["submit"]){

$_SESSION['member']=$_POST['member_user'];
$sql="insert into member values('','".$_POST['member_user']."','".md5($_POST['member_password'])."','".$_POST['member_name']."','".$_POST['member_sex']."','".$_POST['member_qq']."','".$_POST['member_phone']."','".$_POST['member_email']."')";
$result=mysql_query($sql)or die(mysql_error());
if($result)
{
	echo "<script>alert('注册成功');location='member.php';</script>";
	echo "<script>alert('注册失败');location='index.php';</script>";
	mysql_close();
}

}
?>
</head>

<body>
<?php if($_GET['oprate'] == 'register'){ ?>
<form id="theForm" name="theForm" method="post" action="" onSubmit="return chk(this)" runat="server" style="margin-bottom:0px;">
<br>会员注册&nbsp;&nbsp;以下打“*”为必填项<br>
账&nbsp;&nbsp;&nbsp;号:<br>
<input name="member_user" type="text" id="member_user" size="20" maxlength="20" />*</font>(由数字或字母组成)<br><br>
密&nbsp;&nbsp;&nbsp;码:<br>
<input name="member_password" type="password" id="member_password" size="20" maxlength="20" />*</font>(由数字或字母组成)<br><br>
确认密码:<br>
<input name="pass" type="password" id="pass" size="20" />*</font>(再次输入密码)<br><br>
真实姓名:<br>
<input name="member_name" type="text" id="member_name" size="20" /><br><br>
性&nbsp;&nbsp;&nbsp;别:<br>
<input name="member_sex" type="radio" id="0" value="1" checked="checked" />
男<input type="radio" name="member_sex" value="0" id="1" />
女&nbsp;<br><br>
Q&nbsp;&nbsp;&nbsp;Q:<br>
<input name="member_qq" type="text" id="member_qq" size="20"/><br><br>
联系方式:<br>
<input name="member_phone" type="text" id="member_phone" size="20"/><br><br>
电子邮箱:<br>
<input name="member_email" type="text" id="member_email" size="20"/><br><br>
<input type="reset" name="button" id="button" value="重置" />
<input type="submit" name="submit" id="submit" value="确定注册" /><br>
</form>
<?php
} 
	if($_GET['oprate']== ''){
?>
<?php
if($_POST["submit2"]){
$name=$_POST['name'];
$pw=md5($_POST['password']);
$sql="select * from member where member_user='".$name."'"; 
$result=mysql_query($sql) or die("登陆错误");
$num=mysql_num_rows($result);
if($num==0){
	echo "<script>alert('帐号不存在');location='index.php';</script>";
	}
while($rs=mysql_fetch_object($result))
{
	if($rs->member_password!=$pw)
	{
		echo "<script>alert('密码错误');location='index.php';</script>";
		mysql_close();
	}
	else 
	{
		$_SESSION['member']=$_POST['name'];
		header("Location:member.php");
		mysql_close();
		}
	}
}
?>
<form action="" method="post" name="regform" onSubmit="return Checklogin();" style="margin-bottom:0px;">
登陆<br><br>
用户名:<br>
<input name="name" type="text" id="name"><br><br>
密&nbsp;码:<br>
<input name="password" type="password" id="name"><br><br>
<input name="submit2" type="submit" value="会员登录"/>
<a href='index.php?oprate=register'>注册...<br><br>
</form>
<?php } ?>

</body>
</html>