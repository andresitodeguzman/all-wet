<?php
/**
 * All Wet
 * 2018
 * 
 * API
 * Admin
 * update
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
if(empty($_REQUEST['admin_name'])) throwError("Empty name");
if(empty($_REQUEST['admin_username'])) throwError("Empty username");
if(empty($_REQUEST['admin_password'])) throwError("Empty password");
if(empty($_REQUEST['admin_image'])) throwError("Empty image");

$admin_id = $_REQUEST['admin_id'];
$admin_name = $_REQUEST['admin_name'];
$admin_username = $_REQUEST['admin_username'];
$admin_password = $_REQUEST['admin_password'];
$admin_image = $_REQUEST['admin_image'];

$array = array(
	"admin_id" => $admin_id,
	"admin_name" => $admin_name,
	"admin_username" => $admin_username,
	"admin_password" => $admin_password,
	"admin_image" => $admin_image
);

$result = $obj->update($array);

if($result){
	$res = array(
		"code" => "200",
		"message" => "Successfully updated"
	);
} else {
	$res = array(
		"code" => "400",
		"message" => "Fail to update"
	);
}

echo(json_encode($res));

?>