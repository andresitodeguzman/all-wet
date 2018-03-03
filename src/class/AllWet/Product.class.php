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
    function __construct(){

    }

}
?>