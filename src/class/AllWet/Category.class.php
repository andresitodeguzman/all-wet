<?php
/**
 * All Wet
 * 2018
 * 
 * Class
 * Category
 */

 namespace AllWet;

 class Category {

    // Properties
    private $mysqli;

    private $category_array;

    private $category_id;
    private $category_name;
    private $category_description;
    private $category_code;

    // Method

    /**
     * __construct
     * @param: $mysqli
     * @return: void
     */
    function __construct($mysqli){
        $this->mysqli = $mysqli;
    }

    /**
     * codeExists
     * 
     * @param: $category_code
     * @return: Bool
     */
    final private function codeExists($category_code){
        // Handle Params
        $this->category_code = $category_code;

        // Query if Category Code already exists
        $stmt = $this->mysqli->prepare("SELECT category_id FROM `category` WHERE category_code = ? LIMIT 1");
        $stmt->bind_param("s", $this->category_code);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->fetch_assoc()){
            return True;
        } else {
            return False;
        }

    }

    /**
     * getAll
     * @param: none
     * @return: array
     */
    final private function getAll(){

        // Query
        $stmt = $this->mysqli->prepare("SELECT * FROM category");
        $stmt->execute();
        $cats = $stmt->get_result();

        // Create placeholder array
        $this->category_array = array();

        // Loop along results
        while($cat = $cats->fetch_array()){

            $category_id = $cat['category_id'];
            $category_name = $cat['category_name'];
            $category_description = $cat['category_description'];
            $category_code = $cat['category_code'];

            $prep_arr = array(
                "category_id"=>$category_id,
                "category_name"=>$category_name,
                "category_description"=>$category_description,
                "category_code"=>$category_code
            );

            // Push to placeholder array
            array_push($this->category_array,$prep_arr);
        }

        // Return Result
        return $this->category_array;
    }

    /**
     * get
     * @param: $category_id
     * @return: array
    */
    final private function get($category_id){
        // Handle Param
        $this->category_id = $category_id;

        // Prepare Statement
        $stmt = $this->mysqli->prepare("SELECT * FROM `category` WHERE `category_id` = ?");
        // Bind and execute
        $stmt->bind_param("s",$this->category_id);
        $stmt->execute();

        // Handle Result
        $result = $stmt->get_result();

        // Return Result
        return $result->fetch_assoc();
    }

    /**
     * add
     * @param: $category_name, $category_description, $category_code
     * @return: Bool
     */
    final private function add(String $category_name, String $category_description, String $category_code){
        // Handle Params
        $this->category_name = $category_name;
        $this->category_description = $category_description;
        $this->category_code = $category_code;
        
        // Check if code already exists
        if($this->codeExists($this->category_code)){
            return False;
        } else {
            // Insert into DB
            $stmt = $this->mysqli->prepare("INSERT INTO `category`(category_name, category_description, category_code) VALUES (?,?,?)");
            $stmt->bind_param("sss",$this->category_name, $this->category_description, $this->category_code);
            $stmt->execute();

            // Return true
            return True;
        }
    }

    /**
     * delete
     * 
     * @param: $category_id
     * @return: Bool
     */
    final private function delete($category_id){
        // Handle Params
        $this->category_id = $category_id;

        // Delete from DB
        $stmt = $this->mysqli->prepare("DELETE FROM `category` WHERE category_id = ?");
        $stmt->bind_param("s",$this->category_id);
        $stmt->execute();

        // Check if deleted
        $stmt = $this->mysqli->prepare("SELECT category_id FROM `category` WHERE category_id = ? LIMIT 1");
        $stmt->bind_param("s",$this->category_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $result = $result->fetch_assoc();

        if(empty($result)){
            return True;
        } else {
            return False;
        }

    }

    /**
     * update
     * 
     * @param: $category_id, $category_name, $category_description, $category_code
     * @return: Bool
     */
    final private function update($category_id, String $category_name, String $category_description, String $category_code){
        // Handle Params
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->category_description = $category_description;
        $this->category_code = $category_code;

        // Check if Category Entry Exists
        if($this->get($this->category_id)){

            // Update Entry
            $stmt = $this->mysqli->prepare("UPDATE `category` SET `category_name` = ?, `category_description` = ?, `category_code` = ? WHERE `category_id` = ?");
            $stmt->bind_param("ssss", $this->category_name, $this->category_description, $this->category_code, $this->category_id);
            $stmt->execute();

            return True;

        } else {

            return False;

        }

    }
    

 }
?>