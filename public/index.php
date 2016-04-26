<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/4/18
 * Time: 21:52
 */
session_start();
require_once '../include/autoload.php';

if (isset($_POST['quitSubmit']))
{
    $_SESSION = array();
    if(isset($_COOKIE[session_name()]))
    {
        setCookie(session_name(),'',time()-3600,'/');
    }
    session_destroy();
    setcookie("username", time()-3600);
    setcookie("password", time()-3600);
    echo '<script>location.href="login.php"</script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>主页</title>
</head>
<body>
<?php
if(isset($_SESSION['authentic']) && $_SESSION['authentic'] == true) {
    echo 'welcome ' . $_SESSION['username'];
    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <input type="submit" name="quitSubmit" value="注销">
    </form>
    <?php
}
else {
    ?>
    <a href="login.php">登录</a>
    <a href="register.php">注册</a>
    <?php
}
?>


</body>
</html>


