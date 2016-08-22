<?php

class Restaurant_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

    }

    public function getRestaurantInfo($restaurant=0) {
    	$buildarray = [];
    	if (!empty($restaurant)) {
    		$sql = "SELECT * FROM leads WHERE url = '".$restaurant."'";
    		$query = $this->db->query($sql);
    		if ($query) {
    			foreach ($query->result_array() as $res) {
    				foreach ($res as $key=>$value) {
    					$buildarray[$key] = $value;
    				}
    			}
    		}
    		return $buildarray;
    	} else {
    		return $buildarray;
    	}
    }
	

}