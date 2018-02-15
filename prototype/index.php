<?php
session_start();

require_once("_class/Account.class.php");

$account = new Account();

if($account->isLoggedIn()){
 header("Location: app");
} else {
  header("Location: authentication");
}
?>
