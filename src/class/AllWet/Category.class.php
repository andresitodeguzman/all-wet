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

    public $category_array;

    public $category_id;
    public $category_name;
    public $category_description;
    public $category_code;

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
     * getCategories
     * @param: none
     * @return: array
     */
    public function getCategories(){
        $cats = $this->mysqli->query("SELECT * FROM category");
        $this->category_array = array();
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
            array_push($this->category_array,$prep_arr);
        }
        return $this->category_array;
    }

 }
?>