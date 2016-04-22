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
        $sql_pre = 'SELECT password FROM user WHERE username = :username';
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

    public function register($param = array())
    {
        if (!empty($param))
        {
            $sql_pre = "INSERT INTO user(username, password) VALUES (:username, :password)";
            $res = $this->_db->exec($sql_pre, $param);
            if ($res > 0)
            {
                return array(
                    'state' => true,
                    'message' => '成功注册'
                );
            }
            else if ($res == 0)
            {
                return array(
                    'state' => false,
                    'message' => '注册失败'
                );
            }
        }
        return array(
            'state' => false,
            'message' => '注册失败'
        );

    }

}