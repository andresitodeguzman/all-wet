<?php
/**
 * All Wet
 * 2018
 * 
 * Class
 * Product
 */

namespace AllWet;

class Product {

    // Properties
    private $mysqli;

    private $product_id;
    private $product_code;
    private $product_name;
    private $product_description;
    private $category_id;
    private $product_price;
    private $product_available;
    private $product_image;

    // Methods

    /**
     * __construct
     * @param: 
     * @return: void
     */
    function __construct($mysqli){
        $this->mysqli = $mysqli;
    }

    /**
     * codeExists
     * @param: $product_code
     * @return: Bool
     */
    final private function codeExists($product_code){
        // Handle Param
        $this->product_code = $product_code;

        // Query in DB
        $stmt = $this->mysqli->prepare("SELECT product_id FROM `product` WHERE `product_id` = ? LIMIT 1");
        $stmt->bind_param("s",$this->product_id);
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
     * 
     * @param: none
     * @return: Array
     */
    final private function getAll(){
        // Query in DB
        $stmt = $this->mysqli->prepare("SELECT * FROM `product`");
        $stmt->execute();
        $result = $stmt->get_result();

        // Create array placeholder
        $this->product_array = array();

        // Loop along results
        while($prod = $result->fetch_array()){
            $product_id = $prod['product_id'];
            $product_code = $prod['product_code'];
            $product_name = $prod['product_name'];
            $product_description = $prod['product_description'];

            $prep_arr = array(
                "product_id" => $product_id,
                "product_code" => $product_code,
                "product_name" => $product_name,
                "product_description" => $product_description
            );

            array_push($this->product_array, $prep_arr);
            
        }

        // Return Array
        return $this->product_array;
    }

    /**
     * get
     * 
     * @param: $product_id
     * @return: array
     */
    final private function get($product_id){
        // Handle Param
        $this->product_id = $product_id;

        // Query in DB
        $stmt = $this->mysqli->prepare("SELECT * FROM `product` WHERE `product_id` = ?");
        $stmt->bind_param("s",$this->product_id);
        $stmt->execute();
        $result = $this->get_result();

        if($result->fetch_assoc()){
            return $result->fetch_assoc();
        } else {
            return False;
        }
    }

    /**
     * delete
     * 
     * @param: $product_id
     * @return: Bool
     */
    final private function delete($product_id){
        // Handle Params
        $this->product_id = $product_id;

        // Delete in DB
        $stmt = $this->mysqli->prepare("DELETE FROM `product` WHERE `product_id` = ?");
        $stmt->bind_param("s",$this->product_id);
        $stmt->execute();

        // Check if deleted
        $stmt = $this->mysqli->prepare("SELECT product_id FROM `product` WHERE product_id = ? LIMIT 1");
        $stmt->bind_param("s",$this->product_id);
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
     * add
     * 
     * @param: $product_code, $product_name, $product_description, $category_id, $product_price, $product_available, $product_image
     * @return: Bool
     */
    final private function add(String $product_code, String $product_name, String $product_description, $category_id, String $product_price, String $product_available, String $product_image){
        // Handle Params
        $this->product_code = $product_code;
        $this->product_name = $product_name;
        $this->product_description = $product_description;
        $this->category_id = $category_id;
        $this->product_price = $product_price;
        $this->product_available = $product_available;
        $this->product_image = $product_image;

        // Check if code exists
        if($this->codeExists($this->product_code)){
            return False;
        } else {
            // Insert in DB
            $stmt = $this->mysqli->prepare("INSERT INTO `product` (product_code, product_name, product_description, category_id, product_price, product_available, product_image) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", $this->product_code, $this->product_name, $this->product_description, $this->category_id, $this->product_price, $this->product_available, $this->product_image);
            $stmt->execute();

            return True;
        }
    }

    /**
     * update
     * 
     * @param: $product_id, $product_code, $product_name, $product_description, $category_id, $product_price, $product_available, $product_image
     * @return: Bool
     */
    final private function update($product_id, String $product_code, String $product_name, String $product_description, $category_id, String $product_price, String $product_available, String $product_image){
        // Handle Params
        $this->product_id = $product_id;
        $this->product_code = $product_code;
        $this->product_name = $product_name;
        $this->product_description = $product_description;
        $this->category_id = $category_id;
        $this->product_price = $product_price;
        $this->product_available = $product_available;
        $this->product_image = $product_image;

        // Check if in DB
        if($this->get($this->product_id)){
            // Update entry
            $stmt = $this->mysqli->prepare("UPDATE `product` SET `product_code` = ?, `product_name` = ?, `product_description` = ?, `category_id` = ?, `product_price` = ?, `product_available` = ?, `product_image` = ? WHERE `product_id` = ?");
            $stmt->bind_param("ssssssss", $this->product_code, $this->product_name, $this->product_description, $this->category_id, $this->product_price, $this->product_available, $this->product_image, $this->product_id);
            $stmt->execute();

            return True;

        } else {

            return False;

        }
    }

}
?>