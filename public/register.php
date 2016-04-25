<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/4/19
 * Time: 13:59
 */
session_start();
require_once '../include/header.php';
if (isset($_POST['regSubmit']))
{
    if ($_POST['password'] == $_POST['confirm']) {

        $validator = new Validator();
        $validator->addRule($_POST['username'], array(
            'type' => 'username',
            'length' => array('min'=>4, 'max'=>20),
            'empty' => false
        ));
        $validator->addRule($_POST['password'], array(
            'type' => 'password',
            'length' => array('min'=>4, 'max'=>20),
            'empty' => false
        ));
        if ($validator->validate())
        {
            $user = new User();
            $param = array(
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            );
            $flag = $user->register($param);
            if ($flag['state'] == true)
            {
                echo '<script>alert("注册成功")</script>';
                echo '<script>location.href="login.php"</script>';
            }
            else
            {
                echo '<script>alert("注册失败")</script>';
            }
        }
        else
        {
            echo $validator->error();
        }

    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form id="register" name="register" method="post" action="<?= $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data">
    <div>用户注册</div>
    账号:
    <input id="username" name="username" type="text"><br />
    密码:
    <input id="password" name="password" type="password" ><br />
    确认密码:
    <input id="confirm" name="confirm" type="password" ><br />
    <input type="reset" name="regSet"  value="重置" />
    <input type="submit" name="regSubmit"  value="确定注册" /><br />
</form>

<script type="text/javascript" src="../js/jquery/jquery.js"></script>
<script type="text/javascript" src="../js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../js/validator/jquery.validate.min.js"></script>
<script type="text/javascript" src="../js/validator/localization/messages_zh.js"></script>
<script type="text/javascript" src="../js/register.js"></script>

</body>
</html>
