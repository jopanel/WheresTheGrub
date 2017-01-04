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

    /*
    Model Functions Needing Developed:
    - Manage Users
    -- getVendorUsers
    -- deleteVendorUser
    -- addVendorUser
    -- editVendorUser

    - Marketing Tools
    -- getMarketingTools

    - Add Listing 
    - addListing

    - Manage Business
    -- getPremiumStatus
    -- getBizDetails 
    
    - Manage Reviews 
    -- getBizReviews
    -- respondToReview
    -- requestReviewDelete

    - Manage Promos
    -- getAllPromos
    -- deletePromo
    -- addPromo
    -- editPromo

    - PPC (Pay Per Click)
    -- listAllPPC
    -- createPPC
    -- editPPC
    -- deletePPC
    -- addPPCkeyword
    -- disablePPCkeyword
    -- addCredit

    - Reports
    - getBizReviewStats
    - getBizStats
    - getPPCStats
    - getBizRatingStats
    - getBizMobileStats
    - getBizWebStats

    - Business Information
    -- getBizInformation
    -- editBizInformation
    -- addBizInformation
    -- removeBizInformation
    -- addPhotos
    -- deletePhotos

    - Menu
    -- addMenuItems
    -- deleteMenuItems
    -- editMenuItems
    -- listMenuItems
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

	public function manageusers($action=null, $uid=0) {
		if ($this->Vendor_model->verifyUser()) {
			$this->load->view('landingheader');
			if ($action == "add") {
				if ($this->input->post()) {
					$postData = $this->input->post(); 
					$return = $this->Vendor_model->editVendorUser(0,$postData, 1); 
					if ($return == TRUE) {
						$data["res"] = $this->Vendor_model->getVendorUsers();
						$this->load->view('vendormanageusers', $data);
					} else {
						$data["problem"] = $return;
						$data["res"] = $this->Vendor_model->getRestaurantsByMaster();
						$this->load->view('vendormanageusers_add', $data);
					}
				} else {
					$data["problem"] = 0;
					$data["res"] = $this->Vendor_model->getRestaurantsByMaster();
					$this->load->view('vendormanageusers_add', $data);
				}
			} 
			if ($action == "delete") {
				$this->Vendor_model->editVendorUser(0, array("id"=>$uid), 2);
				$data["res"] = $this->Vendor_model->getVendorUsers();
				$this->load->view('vendormanageusers', $data);
			} 
			if ($action == "edit") {
				if ($this->input->post()) {
					$postData = $this->input->post();
					$return = $this->Vendor_model->editVendorUser($uid, $postData, 3);
					if ($return == TRUE) {
						$data["userperm"] = $this->Vendor_model->getUserPermissions($uid);
						$data["problem"] = 0;
						$data["userinfo"] = $this->Vendor_model->getVendorUser($uid);
						$data["res"] = $this->Vendor_model->getRestaurantsByMaster();
						$data["id"] = $uid;
						$this->load->view('vendormanageusers_edit', $data);
					} else {
						$data["userperm"] = $this->Vendor_model->getUserPermissions($uid);
						$data["problem"] = $return;
						$data["userinfo"] = $this->Vendor_model->getVendorUser($uid);
						$data["res"] = $this->Vendor_model->getRestaurantsByMaster();
						$data["id"] = $uid;
						$this->load->view('vendormanageusers_edit', $data);
					}

				} else {
					$data["userperm"] = $this->Vendor_model->getUserPermissions($uid);
					$data["problem"] = 0;
					$data["userinfo"] = $this->Vendor_model->getVendorUser($uid);
					$data["res"] = $this->Vendor_model->getRestaurantsByMaster();
					$data["id"] = $uid;
					$this->load->view('vendormanageusers_edit', $data);
				}
				
			} 
			if ($action === null) {
				$data["res"] = $this->Vendor_model->getVendorUsers();
				$this->load->view('vendormanageusers', $data);
			}
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

	public function managebusiness($rid=null) {
		if ($rid == null) { return; }
		if ($this->Vendor_model->verifyUser($rid)) {
			$data["rid"] = $rid;
			$this->load->view('landingheader'); 
			$this->load->view('vendormanagebusiness', $data);
			$this->load->view('landingfooter');
		}
	}

	public function managereviews($rid=null) {
		if ($rid == null) { return; }
		if ($this->Vendor_model->verifyUser($rid)) {
			$data["rid"] = $rid;
			$this->load->view('landingheader');
				$this->load->view('vendormanagereviews', $data);
			$this->load->view('landingfooter');
		}
	}

	public function managepromos($rid=null) {
		if ($rid == null) { return; }
		if ($this->Vendor_model->verifyUser($rid)) {
			$data["rid"] = $rid;
			$this->load->view('landingheader');
			$this->load->view('vendormanagepromos', $data);
			$this->load->view('landingfooter');
		}
	}

	public function ppc($rid=null) {
		if ($rid == null) { return; }
		if ($this->Vendor_model->verifyUser($rid)) {
			$data["rid"] = $rid;
			//$data[""] = $this->Vendor_model->userFeed();
			$this->load->view('landingheader');
			$this->load->view('vendorppc', $data);
			$this->load->view('landingfooter');
		}
	}

	public function reports($rid=null) {
		if ($rid == null) { return; }
		if ($this->Vendor_model->verifyUser($rid)) {
			$data["rid"] = $rid;
			$this->load->view('landingheader');
				$this->load->view('vendorreports', $data);
			$this->load->view('landingfooter');
		}
	}

	public function businessinformation($rid=null) {
		if ($rid == null) { return; }
		if ($this->Vendor_model->verifyUser($rid)) {
			$data["rid"] = $rid;
			$l = $this->Vendor_model->getBizInformation($rid);
			$data["l"] = $l[0];
			$this->load->view('landingheader');
			if ($this->input->post()) {
				$this->load->view('vendorbusinessinformation', $data);
			} else {
				$this->load->view('vendorbusinessinformation', $data);
			}
			
			$this->load->view('landingfooter');
		} 
	}

	public function managemenu($rid=null) {
		if ($rid == null) { return; }
		if ($this->Vendor_model->verifyUser($rid)) {
			$data["rid"] = $rid;
			$this->load->view('landingheader');
			$this->load->view('vendormenu', $data);
			$this->load->view('landingfooter');
		} 
	}


	public function index($userid=0){
			if ($this->Vendor_model->verifyUser()) {
				$data["biz"] = $this->Vendor_model->getMyBusinesses();
				$this->load->view('landingheader');
				$this->load->view('vendorlist', $data);
				$this->load->view('landingfooter');
			}
	}


}
