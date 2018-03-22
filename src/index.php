<?php
/**
 * All Wet
 * 2018
 * 
 * Index
 */

session_start();
require_once("_system/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$app_name?></title>
    <?php require_once("_system/head.php"); ?>
    <style>
        html,body{
            height: 100%;
        }
        .parallax-container {
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="parallax-container">
        <div class="parallax">
            <img src="/assets/images/heroimg.jpg">
        </div>
        <div class="container"><br><br>
            <h2 class="white-text"><b>All Wet</b></h2>
            <h5 class="white-text">
                Purified Drinking <a href="/manage" class="white-text">Water</a>
            </h5><br><br>
            <div id="button"></div>
        </div>
    </div>
</body>
</html>
<script>
  $(document).ready(()=>{
    $('.parallax').parallax();
    
    setButton();
    $(".btn").hide();
    $(".btn").fadeIn();
  });

  checkLoginStatus = ()=>{
      return localStorage.getItem('all-wet-login');
  };

  var setButton = ()=>{

    let status = checkLoginStatus();

    let loginButton = `
        <a class="btn btn-large blue darken-4 waves-effect waves-light" href="/authenticate">
            Sign-In with Your Mobile Number
        </a>`;
    
    let appButton = `
        <a class="btn btn-large blue darken-4 waves-effect waves-light" href="/app">
            Open App
        </a>`;

    if(status == "true"){
        $("#button").html(appButton);
    } else {
        $("#button").html(loginButton);
    }
    

  };

</script>