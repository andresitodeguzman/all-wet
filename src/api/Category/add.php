<?php
/**
 * All Wet
 * 2018
 * 
 * API
 * Cathegory
 * add
 */

require_once("../../_system/keys.php");
require_once("../_secure.php");
require_once("../_boot.php");

$obj = new AllWet\Cathegory($mysqli);

function throwError($msg){
	if(empty($msg)) $msg = "An error happened";
	$error = array(
		"code"=>"500",
		"message"=>$msg
	);
	die(json_encode($error));
}


if(empty($_REQUEST['cathegory_name'])) throwError("Empty name");
if(empty($_REQUEST['cathegory_description'])) throwError("Empty description");
if(empty($_REQUEST['cathegory_code'])) throwError("Empty code");

$cathegory_name = $_REQUEST['cathegory_name'];
$cathegory_description = $_REQUEST['cathegory_description'];
$cathegory_code = $_REQUEST['cathegory_code'];

$array = array(
	
	"cathegory_name" => $cathegory_name,
	"cathegory_description" => $cathegory_description,
	"cathegory_code" => $cathegory_code
);

$result = $obj->add($array);

if($result){
	$res = array(
		"code" => "200",
		"message" => "Successfully Added"
	);
} else {
	$res = array(
		"code" => "400",
		"message" => "Fail to add"
	);
}

echo(json_encode($res));

?>