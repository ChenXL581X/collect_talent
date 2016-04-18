<?php 
require_once ('config.php'); 

if(empty($_SESSION['member'])){
	echo "<script>alert('请进行登陆或注册');location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; chauseret=utf-8" />

<title>信息页面</title>
</head>
<body>
<?php
//注销操作
if($_GET["oprate"]=="destroy"){
session_destroy();
echo "<script>alert('注销成功');location='index.php';</script>";}
?>
<?php
//用户修改
if($_GET["oprate"]=="modify") {
if($_POST["submit"]){
	mysql_query($sql="update member set member_name='".$_POST['member_name']."',member_qq='".$_POST['member_qq']."',member_phone='".$_POST['member_phone']."',member_email='".$_POST['member_email']."' where member_user='".$_SESSION['member']."'");
	echo "<script>alert('修改成功');location='member.php';</script>";
} ?>
<?php
$sql="select * from member where member_user='".$_SESSION['member']."'";
$user=mysql_fetch_array(mysql_query($sql));
?>
修改信息&nbsp;&nbsp;<a href="member.php"> 进入主页面</a><br><br>
账号：<br>
<?php echo $user['member_user'];?><br><br>
姓名:<br>
<input name="member_name" type="text" id="member_name" maxlength="20" value="<?php echo $user['member_name'];?>"/><br><br>
性别：<br>
<?php 
if($user['member_sex']==1)
echo "男";
else
echo "女";?><br><br>
qq：<br>
<input name="member_qq" type="text" id="member_qq" value="<?php echo $user['member_qq'];?>" maxlength="20"/><br><br>
手机号：<br>
<input name="member_phone" type="text" id="member_phone" value="<?php echo $user['member_phone'];?>" maxlength="20"/><br><br>
电子邮箱：<br>
<input name="member_email" type="text" id="member_email" value="<?php echo $user['member_email'];?>" maxlength="30"/><br><br>
<input type="reset" name="button" id="button" value="重置" />
<input type="submit" name="submit" id="submit" value="提交" /><br><br>
</form>
<?php } ?>
<?php
if($_SESSION['member']&&$_GET['oprate']!="modify")             
{?>
<a href='?oprate=destroy'>注销本次登录</a>&nbsp;&nbsp;<?php echo "<a href='?oprate=modify'>修改个人信息</a>";?><br><br>
<?php
$result=mysql_query("select * from member where member_user='".$_SESSION['member']."'"); 
while($user=mysql_fetch_array($result)){
?>
账号:<br>
<?php echo htmlspecialchars($user['member_user']); ?><br><br>
姓名<br>
<?php echo htmlspecialchars($user['member_name']); ?><br><br>
性别<br>
<?php echo htmlspecialchars($user['member_sex']); ?><br><br>
q q<br>
<?php echo htmlspecialchars($user['member_qq']); ?><br><br>
手机号码<br>
<?php echo htmlspecialchars($user['member_phone']); ?><br><br>
电子邮箱<br>
<?php echo htmlspecialchars($user['member_email']); ?><br><br>
<?php } 
}
?>
</body>
</html>