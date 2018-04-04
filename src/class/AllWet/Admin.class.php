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
      $this->mysqli = $mysqli;0
    }
  
   final public function add(Array $admin_array){
    if($admin_array['admin_name']) $this->admin_name = $admin_array['admin_name'];
    if($admin_array['admin_username']) $this->admin_username = $admin_array['admin_username'];
    if($admin_array['admin_password']) $this->admin_password = $admin_array['admin_password'];
    if($admin_array['admin_image']) $this->admin_image = $admin_array['admin_image'];

    if($this->usernameExists($this->username)){
     return "Username already exists";
    } else {
     if(strlen($this->admin_password)<8){
       return "Password less than 8 characters";
      } else {
        $this->admin_password = password_hash($this->admin_password, PASSWORD_DEFAULT);
        
        $stmt = $this->mysqli->prepare("INSERT INTO `admin` (admin_name,admin_username,admin_password,admin_image) VALUES (?,?,?,?)");
        $stmt->bind_param("s,s,s,s",$this->admin_name, $this->admin_username, $this->admin_password, $this->admin_image);
        $stmt->execute();

        return True;

     }
    }
   }
  
   final public function usernameExists(String $admin_username){
    $this->admin_username = $admin_username;
    $stmt = $this->mysqli->prepare("SELECT `admin_id` FROM `admin` WHERE `admin_username` = ? LIMIT 1");
    $stmt->bind_param("s", $this->admin_username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    if($result){
     return True;
    } else {
     return False;
    }
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
