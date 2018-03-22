<?php
/**
 * All wet
 * 2018
 * 
 * _secure
 */

 
if(!$_SESSION['logged_in']){
    $ret = array("code"=>"400", "Not Logged In");
    die($ret);
}
?>