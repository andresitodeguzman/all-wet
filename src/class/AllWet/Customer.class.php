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
    public $customer_id;
    public $customer_number;
    public $customer_name;
    public $customer_longitude;
    public $customer_latitude;
    public $customer_address;
    public $customer_image;
    public $customer_access_token;

    // Methods

    /**
     * __construct
     * @param: 
     * @return: void
     */
    function __construct(String $customer_name){
        $this->customer_name = $customer_name;
    }

    function sample(){
        return "Hello ".$this->customer_name;
    }

}
?>