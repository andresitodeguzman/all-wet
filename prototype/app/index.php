<?php
session_start();

require_once("../_class/Account.class.php");
require_once("../_system/config.php");

$account = new Account();

if($account->isLoggedIn() == False) header("Location:../authenticate");

$subscriber_number = $_SESSION['globe_subscriber_number'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$site_title?></title>
    <?php
        require_once("../_system/styles.php");
    ?>
    <style>
        .nav-wrapper{
            padding-left:25px;
            padding-right: 20px;
        }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="blue darken-3">
        <div class="nav-wrapper">
            <a class="brand-logo" href="#"><b>All Wet</b></a>
            <a class="right" href="../authentication/logout.php">Log-out</a>
        </div>
    </nav>

    <div class="container">
        <br><br>
        <h3 class="blue-text text-darken-2">
            My Orders
        </h3>
        <div class="card">
            <div class="card-content">
                Sample Content
            </div>
        </div>
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large blue darken-3 waves-effect waves-light" href="order.php">
            <i class="material-icons">add</i>
        </a>
    </div>
</body>
</html>