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
    private $stmt;
    private $_db;
    public function __construct()
    {
        $this->getConfig();

        $dsn = "mysql:host={$this->config['hostname']};dbname={$this->config['dbname']}";
        try
        {
            $this->_db = new PDO($dsn, $this->config['username'], $this->config['password']);
            $this->_db->exec("SET NAMES UTF-8");
            echo "db connect success";
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public function query($sql_pre, $param = array()) {
        $this->stmt = $this->_db->prepare($sql_pre);
        foreach ($param as $key => $value) {
            $this->stmt->bindParam($key,$value);
        }
//        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        $this->stmt->execute();
        if ($this->stmt->rowCount() == 0)
        {
            return false;
        }
        return $this->stmt;
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