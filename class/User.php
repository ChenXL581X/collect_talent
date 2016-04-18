<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/4/18
 * Time: 20:52
 */

require_once 'DB.php';

class User
{
    private $_db;
    public function __construct()
    {
        $this->_db = new DB();
    }

    public function login($username, $password)
    {
        $sql_pre = 'select password from user where username = :username';
        $res = $this->_db->query($sql_pre, array('username' => $username));
        if ($res == false)
        { //没有此账号
            return array('state' => false,
                'message' => '没有此账号');
        }
        else
        {
            $result = $res->fetch(PDO::FETCH_ASSOC);
            if ($password == $result['password'])
            {//密码匹配
                return array('state' => true,
                    'message' => '登录成功');
            }
            else 
            {//密码不匹配
                return array('state' => false,
                    'message' => '密码不匹配');
            }
        }
    }

    public function register()
    {
        ;
    }
    
}