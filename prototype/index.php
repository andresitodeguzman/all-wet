<?php
session_start();

/*
is_loggedin()
Checks if user is logged-in
*/
function is_loggedin(){
  // Set values
  $ret = False;

  // Get Status
  $status = $_SESSION['allwet_globe_code'];
 
  // Check if contains code
  if(!empty($status)) $ret = True;
  
  // Return result
  return $ret;
}

function getAccessToken(){
  $atoken = "";
}

if(is_loggedin()){
 header("Location: app");
} else {
  header("Location: https://developer.globelabs.com.ph/dialog/oauth?app_id=xxqjsRBXAzhMoT6k6ziXMKh75xXrskMG");
}
?>
