<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/4/18
 * Time: 21:52
 */
session_start();
require_once '../include/autoload.php';


echo 'welcome ' . $_SESSION['username'];