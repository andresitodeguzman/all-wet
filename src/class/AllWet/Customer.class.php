<?php
/**
 * All Wet
 * 2018
 * 
 * Class
 * Customer
 */

namespace AllWet;

class Customer {

    // Properties
    private $mysqli;

    private $customer_id;
    private $customer_number;
    private $customer_name;
    private $customer_longitude;
    private $customer_latitude;
    private $customer_address;
    private $customer_image;
    private $customer_access_token;

    // Methods

    /**
     * __construct
     * @param: 
     * @return: void
     */
    function __construct($mysqli){
        $this->mysqli = $mysqli;
    }

    final private function numberExists($customer_number){
        $this->customer_number = $customer_number;

        $stmt = $this->mysqli->prepare("SELECT * FROM `customer` WHERE `customer_number` = ?");
        $stmt->bind_param("s", $this->customer_number);
        $stmt->execute();

        $result = $stmt->get_result();
        if($result->fetch_assoc()){
            return True;
        } else {
            return False;
        }
    }

    final private function getAll(){
        $stmt = $this->mysqli->prepare("SELECT `customer_id`, `customer_number`, `customer_name`, `customer_longitude`, `customer_latitude`, `customer_address`, `customer_image` FROM `customer`");
        $stmt->execute();
        $result = $this->get_result();

        return $result->fetch_array();
    }

    final private function get($customer_id){
        $this->customer_id = $customer_id;
        $stmt = $this->mysqli->prepare("SELECT `customer_id`, `customer_number`, `customer_name`, `customer_longitude`, `customer_latitude`, `customer_address`, `customer_image` FROM `customer` WHERE `customer_id` = ? LIMIT 1");
        $stmt->bind_param("s", $this->customer_id);
        $stmt->execute();
        $result = $this->get_result();

        return $result->fetch_assoc();
    }

    final private function getByCustomerNumber($customer_number){
        $this->customer_number = $customer_number;
        $stmt = $this->mysqli->prepare("SELECT `customer_id`, `customer_number`, `customer_name`, `customer_longitude`, `customer_latitude`, `customer_address`, `customer_image` FROM `customer` WHERE `customer_number` = ? LIMIT 1");
        $stmt->bind_param("s", $this->customer_number);
        $stmt->execute();
        $result = $this->get_result();

        return $result->fetch_assoc();
    }

    final private function delete($customer_id){
        $this->customer_id = $customer_id;
        $stmt = $this->mysqli->prepare("DELETE FROM `customer` WHERE `customer_id` = ?");
        $stmt->bind_param("s", $this->customer_id);
        $stmt->execute();

        if($this->get($this->customer_id)){
            return True;
        } else {
            return False;
        }

    }

    final private function add($c_array){
        if($c_array['customer_number']) $this->customer_number = $c_array['customer_number'];
        if($c_array['customer_name']) $this->customer_name = $c_array['customer_name'];
        if($c_array['customer_longitude']) $this->customer_longitude = $c_array['customer_longitude'];
        if($c_array['customer_latitude']) $this->customer_latitude = $c_array['customer_latitude'];
        if($c_array['customer_address']) $this->customer_address = $c_array['customer_address'];
        if($c_array['customer_image']) $this->customer_image = $c_array['customer_image'];
        if($c_array['customer_access_token']) $this->customer_access_token = $c_array['customer_access_token'];

        if($this->numberExists($this->customer_number)){
            return False;
        } else {
            $stmt = $this->mysqli->prepare("INSERT INTO `customer` (customer_number, customer_name, customer_longitude, customer_latitude, customer_address, customer_image, customer_access_token) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", $this->customer_number, $this->customer_name, $this->customer_longitude, $this->customer_latitude, $this->customer_address, $this->customer_image, $this->customer_access_token);
            $stmt->execute();

            return True;
        }
    }

    final private function update($c_array){
        if($c_array['customer_id']) $this->customer_id = $c_array['customer_id'];
        if($c_array['customer_number']) $this->customer_number = $c_array['customer_number'];
        if($c_array['customer_name']) $this->customer_name = $c_array['customer_name'];
        if($c_array['customer_longitude']) $this->customer_longitude = $c_array['customer_longitude'];
        if($c_array['customer_latitude']) $this->customer_latitude = $c_array['customer_latitude'];
        if($c_array['customer_address']) $this->customer_address = $c_array['customer_address'];
        if($c_array['customer_image']) $this->customer_image = $c_array['customer_image'];

        if($this->get($this->customer_id)){
            $stmt = $this->mysqli->prepare("UPDATE `customer_number` = ?, `customer_name` = ?, `customer_longitude` = ?, `customer_latitude` = ?, `customer_address` = ?, `customer_image` = ? FROM `customer` WHERE `customer_id` = ?");
            $stmt->bind_param("ssssss", $this->customer_number, $this->customer_name, $this->customer_longitude, $this->customer_latitude, $this->customer_latitude, $this->customer_address, $this->customer_image, $this->customer_id);
            $stmt->execute();

            return True;
        } else {
            return False;
        }
    }
}
?>