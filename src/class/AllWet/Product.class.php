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
    public $mysqli;

    public $product_id;
    public $product_code;
    public $product_name;
    public $product_description;
    public $category_id;
    public $product_price;
    public $product_available;
    public $product_image;

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
     * add
     * 
     * @param: $product_code, $product_name, $product_description, $category_id, $product_price, $product_available, $product_image
     * @return: Bool
     */
    final public function add(String $product_code, String $product_name, String $product_description, $category_id, String $product_price, String $product_available, String $product_image){
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
     * codeExists
     * @param: $product_code
     * @return: Bool
     */
    final public function codeExists($product_code){
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
  
    final public function delete($product_id){
      $this->product_id = $product_id;
      
      $stmt = $this->mysqli->prepare("DELETE FROM `product` WHERE `product_id` = ?");
      $stmt->bind_param("s", $this->product_id);
      $stmt->execute();
      
      return True;
    }
  
    /**
     * getAll
     * 
     * @param: none
     * @return: Array
     */
    final public function getAll(){
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
            $product_available = $prod['product_available'];
            $category_id = $prod['category_id'];
            $product_price = $prod['product_price'];
            $product_image = $prod['product_image'];

            $prep_arr = array(
                "product_id" => $product_id,
                "product_code" => $product_code,
                "product_name" => $product_name,
                "product_description" => $product_description,
                "product_available" => $product_available,
                "category_id" => $category_id,
                "product_price" => $product_price,
                "product_image" => $product_image
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
    final public function get($product_id){
        // Handle Param
        $this->product_id = $product_id;

        // Query in DB
        $stmt = $this->mysqli->prepare("SELECT * FROM `product` WHERE `product_id` = ?");
        $stmt->bind_param("s",$this->product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
        
    }


    /**
     * update
     * 
     * @param: $product_id, $product_code, $product_name, $product_description, $category_id, $product_price, $product_available, $product_image
     * @return: Bool
     */
    final public function update($product_id, String $product_code, String $product_name, String $product_description, $category_id, String $product_price, String $product_available, String $product_image){
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
