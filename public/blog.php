<?php
/**
 * Created by PhpStorm.
 * User: chenxiaolei
 * Date: 2016/5/2
 * Time: 12:04
 */
session_start();
require_once '../include/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>博客</title>
</head>
<body>
<a href="add_blog.php" >添加博客</a>

<ul>
    <span>博客列表</span>
</ul>
<ul>
    <?php
    $blog = new Blog();
    $list = $blog->blog_list($_SESSION['user_id']);
    if ($list['state'] === true) {
//        var_dump($list['data']);
        foreach ($list['data'] as $item) {
            $id = $item['id'];
            $title = $item['title'];
            if (strlen($title) > 15) {
                $tit = substr($title, 15);
            }
            else {
                $tit = $title;
            }

            $date = $item['timestamp'];
            echo "<li>";
            echo "<a href='blog_detail.php?id={$id}' title='{$title}'>{$tit}</a>";
            echo "<span>$date</span>";
            echo "</li>";
        }
    }
//    var_dump($list);

    ?>
    <li>
        <a href="" title=""></a>
        <span></span>
    </li>
</ul>

<script type="text/javascript" src="../js/jquery/jquery.js"></script>
<script type="text/javascript" src="../js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../js/validator/jquery.validate.min.js"></script>
<script type="text/javascript" src="../js/validator/localization/messages_zh.js"></script>
</body>
</html>