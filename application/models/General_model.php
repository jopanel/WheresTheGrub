<?php

class General_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

    }

	public function getIP() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

	public function getZipDetails($zipcode=null) {
		if ($zipcode) {
			$query = $this->db->query("SELECT * FROM zip_code WHERE zip_code = '".$zipcode."'");
			if ($query) {
				return $query->result_array()[0];
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function getStatePhrase() {
		if ($this->session->userdata("userdata_state_name")) {
			$state = $this->session->userdata("userdata_state_name");
			$query = $this->db->query("SELECT phrase FROM phrases WHERE state = '".$state."' LIMIT 1");
			if ($query) {
				return $query->row()->phrase;
			} else {
				return "We know you don't want to cook!";
			}
		} else {
			return "We know you don't want to cook!";
		}
	}

	public function getRecentReviewsFooter() {

	}

	public function getRecommended($limit=25) {
		$latitude = $this->session->userdata("userdata_lat");
		$longitude = $this->session->userdata("userdata_lon");
		//echo $latitude." ".$longitude;
		$sql = "SELECT *, ( 3959 * acos( cos( radians(".$latitude.") ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians(".$longitude.") ) 
              + sin( radians(".$latitude.") ) 
              * sin( radians( latitude ) ) ) ) AS distance  FROM leads WHERE category_labels NOT LIKE '%fast food%' AND category_labels NOT LIKE '%COFFEE AND TEA HOUSES%' HAVING distance < 10 ORDER BY distance LIMIT ".$limit;
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result) {
			return $result->result_array();
		} else {
			return FALSE;
		}

	}

	public function getBestRated($limit=25) {
		$latitude = $this->session->userdata("userdata_lat");
		$longitude = $this->session->userdata("userdata_lon");
		$sql = "SELECT *, ( 3959 * acos( cos( radians(".$latitude.") ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians(".$longitude.") ) 
              + sin( radians(".$latitude.") ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM leads HAVING distance < 10 ORDER BY rating DESC LIMIT ".$limit;
		$result = $this->db->query($sql);
		if ($result) {
			return $result->result_array();
		} else {
			return FALSE;
		}

	}

	public function getCorporateDetails() {

	}

	public function getStaff() {

	}

	public function getPricingTiers() {

	}

	public function getTOS() {

	}

	public function getFAQ() {

	}

	public function searchFAQ() {

	}

	public function dateFriendly($date=null) {
		if (empty($date)) {
			$date = date("D, M jS g:i a");
			return $date;
		} else {
			$date = date("D, M jS g:i a", strtotime($date));
			return $date;
		}
	}

}