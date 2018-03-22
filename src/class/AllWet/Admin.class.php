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
    public $mysqli;

    public $admin_id;
    public $admin_name;
    public $admin_username;
    public $admin_password;
    public $admin_image;

    // Methods
 
     /**
     * __construct
     * @param: 
     * @return: void
     */
    function __construct($mysqli){
      $this->mysqli = $mysqli;
    }
   
   final public function getAll(){
     $stmt = $this->mysqli->prepare("SELECT `admin_id`, `admin_name`, `admin_username`, `admin_image` FROM `admin`");
     $stmt->execute();
     
     $result = $stmt->get_result();
     return $result->fetch_array();
   }
   
   final public function get($admin_id){
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
   
   final public function getByUsername($admin_username){
     $this->username = $admin_username;
     
     $stmt = $this->mysqli->prepare("SELECT `admin_id`, `admin_name`, `admin_username`, `admin_image` FROM `admin` WHERE `admin_username` = ? LIMIT 1");
     $stmt->bind_param("s", $this->admin_username);
     $stmt->execute();
     
     $result = $stmt->get_result();
     return $result->fetch_assoc();
   }
   
   final public function delete($admin_id){
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