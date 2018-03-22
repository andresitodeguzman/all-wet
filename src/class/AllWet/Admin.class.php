<?php
/**
 * All Wet
 * 2018
 * 
 * Class
 * Admin
 */

 namespace AllWet;

 class Admin {

    // Properties
    private $mysqli;

    private $admin_id;
    private $admin_name;
    private $admin_username;
    private $admin_password;
    private $admin_image;

    // Methods
 
     /**
     * __construct
     * @param: 
     * @return: void
     */
    function __construct($mysqli){
      $this->mysqli = $mysqli;
    }
   
   final private function getAll(){
     $stmt = $this->mysqli->prepare("SELECT `admin_id`, `admin_name`, `admin_username`, `admin_image` FROM `admin`");
     $stmt->execute();
     
     $result = $stmt->get_result();
     return $result->fetch_array();
   }
   
   final private function get($admin_id){
     $this->admin_id = $admin_id;
     
     $stmt = $this->mysqli->prepare("SELECT `admin_id`, `admin_name`, `admin_username`, `admin_image` FROM `admin` WHERE `admin_id` = ? LIMIT 1");
     $stmt->bind_param("s", $this->admin_id);
     $stmt->execute();
     
     $result = $stmt->get_result();
     if($result->fetch_assoc()){
       return $result->fetch_assoc();       
     } else {
       return False;
     }

   }
   
   final private function getByUsername($admin_username){
     $this->username = $admin_username;
     
     $stmt = $this->mysqli->prepare("SELECT `admin_id`, `admin_name`, `admin_username`, `admin_image` FROM `admin` WHERE `admin_username` = ? LIMIT 1");
     $stmt->bind_param("s", $this->admin_username);
     $stmt->execute();
     
     $result = $stmt->get_result();
     return $result->fetch_assoc();
   }
   
   final private function delete($admin_id){
     $this->admin_id = $admin_id;
     
     $stmt = $this->mysqli->prepare("DELETE FROM `admin` WHERE `admin_username` = ?");
     $stmt->bind_param("s", $this->admin_id);
     $stmt->execute();
     
     if($this->get($this->admin_id)){
       return False;
     } else {
       return True;       
     }
   }

}
?>