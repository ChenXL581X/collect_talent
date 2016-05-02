<?php
/**
 * Created by PhpStorm.
 * User: chenxiaolei
 * Date: 2016/5/2
 * Time: 14:56
 */
session_start();
require_once '../include/header.php';

$blog = new Blog();
$res = $blog->add_blog(array(
    'title' => $_POST['title'],
    'context' => $_POST['context'],
    'user_id' => $_POST['user_id']
));
//var_dump($res);
if ($res['state'] === true) {
    echo json_encode(array(
        'state' => true,
    ));
}
else {
    echo json_encode(array(
        'state' => false,
    ));
}
