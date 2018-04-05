<?php
/**
 * All Wet
 * 2018
 * 
 * API
 * Admin
 * delete
 */

require_once("../../_system/keys.php");
require_once("../_secure.php");
require_once("../_boot.php");

$obj = new AllWet\Admin($mysqli);

function throwError($msg){
	if(empty($msg)) $msg = "An error happened";
	$error = array(
		"code"=>"500",
		"message"=>$msg
	);
	die(json_encode($error));
}
if(empty($_REQUEST['admin_id'])) throwError("Empty id");

$admin_id = $_REQUEST['admin_id'];

$result = $obj->delete($array);

if($result){
	$res = array(
		"code" => "200",
		"message" => "Successfully deleted"
	);
} else {
	$res = array(
		"code" => "400",
		"message" => "Fail to delete"
	);
}

echo(json_encode($res));

?>