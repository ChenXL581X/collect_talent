<?php
$confirm = rand(100000,999999);
echo "��֤���ѷ����������䣺".$_POST["member_email"];
exec('C:\xampp\htdocs\server\mail_sender.py '.$confirm.' '.$_POST["member_email"]);
?>