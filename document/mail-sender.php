<?php
$confirm = rand(100000,999999);
echo "验证码已发到您的邮箱：".$_POST["member_email"];
exec('C:\xampp\htdocs\server\mail_sender.py '.$confirm.' '.$_POST["member_email"]);
?>
