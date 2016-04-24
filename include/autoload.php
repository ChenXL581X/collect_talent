<?php
/**
 * Created by PhpStorm.
 * User: chenxiaolei
 * Date: 2016/4/24
 * Time: 21:59
 */

function __autoLoad($classname) {
    $path = dirname(dirname(__FILE__));
    $filename = $path . '/class/' . $classname .".php";
    require_once($filename);
}