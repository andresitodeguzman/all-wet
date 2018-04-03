<?php
/**
 * All Wet
 * 2018
 * 
 * API
 * Product
 * update
 */

require_once("../../_system/keys.php");
require_once("../_secure.php");
require_once("../_boot.php");

$obj = new AllWet\Product($mysqli);

function throwError($msg){
	if(empty($msg)) $msg = "An error happened";
	$error = array(
		"code"=>"500",
		"message"=>$msg
	);
	die(json_encode($error));
}
if(empty($_REQUEST['product_id'])) throwError("Empty id");
if(empty($_REQUEST['product_code'])) throwError("Empty code");
if(empty($_REQUEST['product_name'])) throwError("Empty name");
if(empty($_REQUEST['product_description'])) throwError("Empty description");
if(empty($_REQUEST['category_id'])) throwError("Empty Category");
if(empty($_REQUEST['product_price'])) throwError("Empty price");
if(empty($_REQUEST['product_available'])) throwError("Empty availability");
if(empty($_REQUEST['product_image'])) throwError("Empty image");

$product_id = $_REQUEST['product_id'];
$product_code = $_REQUEST['product_code'];
$product_name = $_REQUEST['product_name'];
$product_description = $_REQUEST['product_description'];
$category_id = $_REQUEST['category_id'];
$product_price = $_REQUEST['product_price'];
$product_available = $_REQUEST['product_available'];
$product_image = $_REQUEST['product_image'];

$array = array(
	"product_id" => $product_id,
	"product_code" => $product_code,
	"product_name" => $product_name,
	"product_description" => $product_description,
	"category_id" => $category_id,
	"product_price" => $product_price,
	"product_available" => $product_available,
	"product_image" => $product_image
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