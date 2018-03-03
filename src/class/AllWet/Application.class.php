<?php
/**
 * All Wet
 * 2018
 * 
 * Class
 * Application
 */

namespace AllWet;

class Application {
    // Properties
    private $mysqli;

    public $application_id;
    public $application_name;
    public $application_description;
    public $application_key;
    public $application_secret;
    public $application_scope;

    // Methods

    /**
     * __construct
     * @param: $mysqli
     * @return: void
     */
    function __construct($mysqli){
        $this->mysqli = $mysqli;
    }

    /**
     * isValid
     * @param: String $application_key; String $application_secret;
     * @return:  bool
     */
    public function isValid(String $application_key, String $application_secret){
        $results = $this->mysqli->query("SELECT `application_secret` FROM application WHERE `application_key`=`$application_key` LIMIT 1");
        $arr = $results->fetch_array();

        if(empty($arr)) return False;

        if(!empty($arr)){
            $secret = $arr['application_secret'];
            if($application_secret == $secret){
                return True;
            } else {
                return False;
            }
        }

    }
}
?>