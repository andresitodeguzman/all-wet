<?php
/**
 * All Wet
 * 2018
 * 
 * Autoloader
 */

spl_autoload_register(function($class_name){
    include('../class/'.$class_name.'.class.php');
});

$time_zone = "Asia/Manila";
date_default_timezone_set($time_zone);

$mysqli = new mysqli($sql_host,$sql_username,$sql_password,$sql_database);
?>