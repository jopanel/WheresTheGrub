<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('General_model');
		$this->load->model('Restaurant_model');
		if ( !$this->session->userdata('zipcode') ) {
			if ($this->_bot_detected() == TRUE) {
				$this->session->set_userdata("zipcode", "90713");
			} else {
			$ip = $this->General_model->getIP();	
			}
			if ($ip) {
				if ($ip == "127.0.0.1" || $this->_bot_detected()) {
					$this->session->set_userdata('zipcode', '90713');
				} else {
					$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
					$this->session->set_userdata('zipcode', $details->postal);
				}
			} else {
				if ($this->uri->segment(1)."/".$this->uri->segment(2) != "start/location") {
					redirect("start/location");
				}
			}
		}
		if ($this->session->userdata("zipcode")) {
				$zipdata = $this->General_model->getZipDetails($this->session->userdata("zipcode"));
				foreach($zipdata as $key => $value){
					$this->session->set_userdata("userdata_".$key,$value);
				}
				$this->session->set_userdata("location", $this->session->userdata("userdata_city").", ".$this->session->userdata("userdata_state_name")." ".$this->session->userdata("zipcode"));
			}
			//var_dump($this->session->userdata());
		date_default_timezone_set($this->session->userdata("userdata_time_zone"));
	}

	protected function _bot_detected() {
	  if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
	    return TRUE;
	  }
	  else {
	    return FALSE;
	  }
	}

	public function _bot_detected() {

	  if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
	    return TRUE;
	  }
	  else {
	    return FALSE;
	  }

	}
	public function index($restaurant=0)
	{
		if (!empty($restaurant)) {
			$data["problem"] = 0;
			$basicinfo = $this->Restaurant_model->getRestaurantInfo($restaurant);
			if (count($basicinfo) == 0) {
				$data["problem"] = 1;
			}
			$data["res"] = $basicinfo;
		} else {
			$data["problem"] = 1;
		}
		
		$this->load->view('landingheader');
		$this->load->view('restaurant', $data);
		$this->load->view('landingfooter');
	}


}