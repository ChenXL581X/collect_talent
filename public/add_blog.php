<?php
/**
 * Created by PhpStorm.
 * User: chenxiaolei
 * Date: 2016/5/2
 * Time: 12:11
 */
session_start();




?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>博客</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../application/simditor-2.3.6/styles/simditor.css" />

<script type="text/javascript" src="../js/jquery/jquery.js"></script>
<script type="text/javascript" src="../js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../application/simditor-2.3.6/scripts/module.js"></script>
<script type="text/javascript" src="../application/simditor-2.3.6/scripts/hotkeys.js"></script>
<script type="text/javascript" src="../application/simditor-2.3.6/scripts/uploader.js"></script>
<script type="text/javascript" src="../application/simditor-2.3.6/scripts/simditor.js"></script>

<fieldset>
    <legend>发表博客</legend>
    <form id="blogFrom" name="blogFrom" action="<?= $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        标题：<input type="text" name="title" autofocus><br />
        内容：<textarea id="editor" placeholder="输入内容"></textarea><br>
        <input type="submit" name="blogSubmit" value="发表">
    </form>
</fieldset>

<script type="text/javascript" src="../js/add_blog.js"></script>
</body>
</html>