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
		$sql = "SELECT * FROM leads WHERE `latitude` between ($latitude-((15+5)/69)) and ($latitude+((15+5)/69)) and `longitude` between ($longitude-(((15+5)/69)*cos(15/69))) and ($longitude+(((15+5)/69)*cos(15/69))) and ACOS(SIN(RADIANS(latitude)) * SIN(RADIANS($latitude)) + COS(RADIANS(latitude)) * COS(RADIANS($latitude)) * COS(RADIANS(longitude) - RADIANS($longitude))) * 3959 <= 25 ORDER BY RAND() LIMIT ".$limit;
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
		$sql = "SELECT * FROM leads WHERE `latitude` between ($latitude-((15+5)/69)) and ($latitude+((15+5)/69)) and `longitude` between ($longitude-(((15+5)/69)*cos(15/69))) and ($longitude+(((15+5)/69)*cos(15/69))) and ACOS(SIN(RADIANS(latitude)) * SIN(RADIANS($latitude)) + COS(RADIANS(latitude)) * COS(RADIANS($latitude)) * COS(RADIANS(longitude) - RADIANS($longitude))) * 3959 <= 25 ORDER BY rating DESC LIMIT ".$limit;
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