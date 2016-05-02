<?php
/**
 * Created by PhpStorm.
 * User: chenxiaolei
 * Date: 2016/5/2
 * Time: 16:56
 */
session_start();
require_once '../include/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>博客详细信息</title>
</head>
<body>
<?php
$blog = new Blog();
$res = $blog->blog_detail($_GET['id']);
//var_dump($detail);
if ($res['state'] == true) {
    $detail = $res['data'];
    ?>
<div>
    <h1><?= $detail['title'];?></h1>
    <div><?= $detail['context']?></div>
    <p><?= $detail['timestamp']?></p>
</div>
<?php
}
?>

</body>
</html>
