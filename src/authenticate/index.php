<?php
session_start();
require_once("../_system/keys.php");

if($_SESSION['logged_in']){
    $at = "customer";
    if($_SESSION['account_type']) $at = $_SESSION['account_type'];

    switch($at){
        case("admin"):
            header("Location: ../admin");
            break;
        case("employee"):
            header("Location: ../employee");
            break;
        case("customer"):
            header("Location: ../app");
            break;
        default:
            header("Location: ../app");
            break;
    }
    
} else {
    if(empty($_REQUEST['account_type'])){
        header("Location: $glb_login_redirect");
    } else {
        switch($_REQUEST['account_type']){
            case("admin"):
                header("Location: admin.php");
                break;
            case("employee"):
                header("Location: employee.php");
                break;
            case("customer"):
                header("Location: $glb_login_redirect");
                break;
            default:
                header("Location: $glb_login_redirect");
                break;
        }
    }
}
?>