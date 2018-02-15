<?php

class Account {

  public $code;

  public function isLoggedIn(){
    // Set values
    $ret = False;

    // Get Status
    $status = $_SESSION['allwet_globe_code'];

    // Check if contains code
    if(!empty($status)) $ret = True;

    // Return result
    return $ret;
  }

  public function getAccessToken($code){
    // Input checking
    if(empty($code)) return array("code"=>"400","message"=>"Code Empty");
    if(!empty($code)) $this->code = $code;

    //get access token from Globe
  }

}

?>