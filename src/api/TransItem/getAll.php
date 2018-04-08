<?php
/**
 * All Wet
 * 2018
 * 
 * API
 * Transitem
 * getAll
 */

require_once("../../_system/keys.php");
require_once("../_secure.php");
require_once("../_boot.php");

$obj = new AllWet\TransItem($mysqli);

$data = $obj->getAll();


if(empty($data)){
    $data = json_encode(array());
} else {
    $data = json_encode($data);
}

echo $data;

?>