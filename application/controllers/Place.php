<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Los_Angeles');
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

	public function claim($confirm=0, $rid=0, $code=0) {
		$data["problem"] = 0;
		if (empty($confirm)) {
			$data["data"] = 4;
			if ($this->input->post()) {
				$post = $this->input->post();

				if ($post["action"] == "postclaim") {
					$data["rid"] = (int)$post["rid"];
					$this->load->model('User_model');
					$data["data"] = $this->User_model->claimListing($post);
				} elseif ($post["action"] == "claim") {
					$data["rid"] = $post["rid"];
				}
			$this->load->view('landingheader');
			$this->load->view('claimlisting', $data);
			$this->load->view('landingfooter');
			} else {
				$data["data"] = 4;
			}
			
		} else {
			$this->load->model('User_model'); 
			$data["data"] = $this->User_model->claimConfirmListing($rid,$code);
			$this->load->view('landingheader');
			$this->load->view('claimconfirm', $data);
			$this->load->view('landingfooter');
		}
		
	}

	public function request($rid=0, $action=0) {
		if($this->input->is_ajax_request()) {
			if ($this->input->post()) {
			 	if (!empty($rid) || !empty($action)) {
			 		$this->load->model('User_model');
			 		if ($action == "updatefollow") {
			 			if ($rid == $post["rid"]) {
			 				$this->User_model->updateFollow($post);
			 			}
			 		} elseif ($action == "review") {
			 			$this->User_model->addReview($post);
			 		}

			 	}
			}
		}
	}

	public function openListing($rid=null, $type=null) {
		if ($rid == null) { return FALSE; }
		if ($type == null) { return FALSE; }
		if ($this->input->is_ajax_request()) {
			return $this->General_model->addVendorStats((int)$rid,(int)$type);
		} else {
			return FALSE;
		}
	}

	public function openCompetitor($rid=null) {
		if ($rid == null) { return FALSE; }
		if ($this->input->is_ajax_request()) {
			return $this->General_model->addVendorStats((int)$rid,CompetitorClick);
		} else {
			return FALSE;
		}
	}

	public function openCompetitorPPC($rid=null) {
		if ($rid == null) { return FALSE; }
		if ($this->input->is_ajax_request()) {
			return $this->General_model->addVendorStats((int)$rid,PPCCompetitorClick);
		} else {
			return FALSE;
		}
	}

	public function index($restaurant=0)
	{

		if ($this->input->post()) {
			$this->load->model('User_model');
			$post = $this->input->post();
			if ($post["action"] == "review") {
				$this->User_model->addReview($post);
			} elseif ($post["action"] == "contact") {
				$this->User_model->contactRestaurant($post);
			} elseif ($post["action"] == "updatefollow") {
				
			}
		}

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
		if ($this->session->userdata("loggedin") && $this->session->userdata("uid")) {
			$this->load->model('User_model');
			$data["isfollowing"] = $this->User_model->isFollowing($basicinfo["id"]);
		}
		if (isset($_SERVER["HTTP_REFERER"]) && !empty($_SERVER["HTTP_REFERER"])) {
			$this->General_model->addVendorStats($restaurant,ReferralOpen);
		}
		$this->load->view('landingheader');
		$this->load->view('restaurant', $data);
		$this->load->view('landingfooter');
	}


}
