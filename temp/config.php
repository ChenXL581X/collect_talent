<?php
if (!isset ($_SESSION)) {
	ob_start();
	session_start();
}
 $hostname="localhost";
 $basename="test";
 $basepass="test";
 $database="test";

 $conn=mysql_connect($hostname,$basename,$basepass)or die("error!");       
 mysql_select_db($database,$conn);
 mysql_query("set names 'utf8'");
?>