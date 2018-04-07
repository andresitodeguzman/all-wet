<?php
/**
 * All Wet
 * 2018
 * 
 * Class
 * TransItem
 */

class TransItem {

    private $mysqli;

    /**
     * __construct
     * 
     * @param: $mysqli
     * @return: None
     */
    function __construct($mysqli){
        $this->mysqli = $mysqli;
    }

    /**
     * add
     * 
     * @param: @t_array
     * @return: mixed
     */
    final public function add(Array $t_array){
        return True;
    }

}

?>