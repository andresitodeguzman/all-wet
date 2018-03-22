<?php
/**
 * All Wet
 * 2018
 * 
 * API
 * Admin
 * get
 */

require_once("../../_system/keys.php");
require_once("../_secure.php");
require_once("../_boot.php");

if(empty($_REQUEST['id'])){
    $ret =  json_encode(array("code"=>"400","message"=>"Empty ID"));
    die($ret);
} else {
    $id = $_REQUEST['id'];
}

$obj = new AllWet\Admin($mysqli);

$data = $obj->get($id);


if(empty($data)){
    $data = json_encode(array());
} else {
    $data = json_encode($data);
}

echo $data;

?>