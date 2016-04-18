<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/4/18
 * Time: 20:41
 */
session_start();
require_once '../class/User.php';




//自动登录
if (isset($_COOKIE['username']) && isset($_COOKIE['password']))
{
    $user = new User();
    $flag = $user->login($_COOKIE['username'], $_COOKIE['password']);
    if ($flag['state'] == true)
    {
        echo '<script>location.href="index.php"</script>';
    }
}

if (isset($_POST['loginSubmit']))
{
//    echo "submit success";
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = new User();
        $flag = $user->login($_POST['username'], $_POST['password']);
        if ($flag['state'] == true)
        {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['authentic'] = true;
            if (isset($_POST['remember']) && $_POST['remember'] == 'on')
            { //设置记住密码
                setcookie("username", $_POST['username'], time()+3600);
                setcookie("password", $_POST['password'], time()+3600);
            }
            echo '<script>location.href="index.php"</script>';
        }
        else
        {
            echo '<script>alert("账号或密码错误");</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>登录</title>
</head>
<body>
<div>登录</div>
<form action="<?php  echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    账号: <input type="text" name="username" ><br />
    密码: <input type="password" name="password"><br />
    记住密码? <input type="checkbox" name="remember" value="on"><br />
    <input type="submit" name="loginSubmit" value="登录">
</form>
</body>
</html>




