<?php
/*

--> Vendors
->Add/Edit Vendor Users
->Marketing Tools
->Add Business Listing
->Manage Business
-Edit Business Information
-Manage Reviews
-Manage Coupons/Deals
-Manage PPC/Adwords
-Stats/Reports
-Add/Edit Menu Items

*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('General_model');
		$this->load->model('Restaurant_model');
		$this->load->model('Vendor_model');
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

	public function logout() {
		if ($this->Vendor_model->verifyUser()) {
			$this->Vendor_model->logout();
			redirect("../../signin");
		} else {
			redirect("../../signin");
		}
	}

	public function manageusers() {
		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader');
				$this->load->view('vendormanageusers');
			$this->load->view('landingfooter');
		}
	}

	public function marketingtools() {
		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader');
				$this->load->view('vendormarketingtools');
			$this->load->view('landingfooter');
		}
	}

	public function addlisting() {
		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader');
				$this->load->view('vendoraddlisting');
			$this->load->view('landingfooter');
		}
	}

	public function managebusiness() {
		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader'); 
				$this->load->view('vendorlist');
			$this->load->view('landingfooter');
		}
	}

	public function managereviews() {
		if ($this->Vendor_model->verifyUser()) { 
			$this->load->view('landingheader');
				$this->load->view('vendormanagereviews');
			$this->load->view('landingfooter');
		}
	}

	public function managepromos() {
		if ($this->Vendor_model->verifyUser()) { 
			$this->load->view('landingheader');
				$this->load->view('vendormanagepromos');
			$this->load->view('landingfooter');
		}
	}

	public function ppc() {
		if ($this->Vendor_model->verifyUser()) {
			$data[""] = $this->Vendor_model->userFeed();
			$this->load->view('landingheader');
				$this->load->view('vendorppc');
			$this->load->view('landingfooter');
		}
	}

	public function reports() {
		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader');
				$this->load->view('vendorreports');
			$this->load->view('landingfooter');
		}
	}

	public function businessinformation() {
		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader');
				$this->load->view('vendorbusinessinformation');
			$this->load->view('landingfooter');
		} 
	}

	public function menu() {

		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader');
			$this->load->view('vendormenu');
			$this->load->view('landingfooter');
		} 
	}


	public function index($userid=0){
			if ($this->Vendor_model->verifyUser()) {
				$this->load->view('landingheader');
				$this->load->view('vendorlist');
				$this->load->view('landingfooter');
			}
	}


}
