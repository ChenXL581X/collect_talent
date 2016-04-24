<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/4/18
 * Time: 20:53
 */

class DB
{
    private $config_path = '../config/db.xml';
    private $config = array();
    private $result;
    private $_db;
    public function __construct()
    {
        $this->getConfig();
        $dsn = "mysql:host={$this->config['hostname']};dbname={$this->config['dbname']}";
//        echo $dsn;
        try
        {
            $this->_db = new PDO($dsn, $this->config['username'], $this->config['password']);
            $this->_db->exec("SET NAMES UTF-8");
//            echo "db connect success";
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public function query($sql_pre, $param = array()) {
//        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        try
        {
            $this->result = $this->_db->prepare($sql_pre);
            foreach ($param as $key => $value) {
                $this->result->bindParam($key,$value);
            }
            $this->result->execute();
        } catch (PDOException $e)
        {
            die($e->getMessage());
        }
        if ($this->result->rowCount() == 0)
        {
            return false;
        }
        return $this->result;
    }

    public function exec($sql_pre, $param=array()) {
        try
        {
            $this->result = $this->_db->prepare($sql_pre);
            foreach ($param as $key => $value) {
                $this->result->bindParam($key,$value);
            }
            $this->result->execute();
        } catch(PDOException $e)
        {
            die($e->getMessage());
        }

        return $this->result->rowCount();
    }

    private function getConfig()
    {
        $configDoc = new DOMDocument();
        $configDoc->load($this->config_path);
        $db = $configDoc->documentElement;
        foreach ($db->childNodes as $item)
        {
            $this->config[$item->nodeName] = $item->nodeValue;
        }
    }
}