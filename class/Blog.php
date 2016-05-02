<?php
/**
 * Created by PhpStorm.
 * User: chenxiaolei
 * Date: 2016/5/2
 * Time: 13:17
 */

class Blog{
    private $_db;
    public function __construct() {
        $this->_db = new DB();
    }
    public function add_blog($param) {
        $sql_pre = 'INSERT INTO blog(user_id,title,context) VALUES (:user_id, :title, :context)';
//        return $param;
//        var_dump($param);
        $res = $this->_db->exec($sql_pre, $param);
        if ($res > 0)
        {
            return array(
                'state' => true,
                'message' => '发表成功'
            );
        }
        else if ($res == 0)
        {
            return array(
                'state' => false,
                'message' => '发表失败'
            );
        }
    }

    public function blog_list($user_id) {
        $sql_pre = 'SELECT id, title, timestamp FROM blog WHERE user_id = :user_id';
        $res = $this->_db->query($sql_pre, array('user_id' => $user_id));
        if ($res == false)
        { //没有博客
            return array('state' => false,
                'message' => '没有博客');
        }
        else
        {
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
            return array(
                'state' => true,
                'data' => $result
            );
        }
    }

    public function blog_detail($id) {
        $sql_pre = 'SELECT * FROM blog WHERE id = :id';
        $res = $this->_db->query($sql_pre, array('id' => $id));
        if ($res == false)
        { //没有博客
            return array('state' => false,
                'message' => '没有博客');
        }
        else
        {
            $result = $res->fetch(PDO::FETCH_ASSOC);
            return array(
                'state' => true,
                'message' => '查找成功',
                'data' => $result
            );
        }
    }
}