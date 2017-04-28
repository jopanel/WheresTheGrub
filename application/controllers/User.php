<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('General_model');
		$this->load->model('Restaurant_model');
		$this->load->model('User_model');
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
		if ($this->User_model->verifyUser()) {
			$this->User_model->logout();
			redirect("http://".$_SERVER["SERVER_NAME"]);
		} else {
			redirect("http://".$_SERVER["SERVER_NAME"]);
		}
	}

	public function feed() {
		if ($this->User_model->verifyUser()) {
			$data["feed"] = $this->User_model->userFeed();
			$this->load->view('landingheader');
			$this->load->view('userfeed', $data);
			$this->load->view('landingfooter');
		}
	}

	public function following() {
		if ($this->User_model->verifyUser()) {
			$data["following"] = $this->User_model->getFollowers();
			$this->load->view('landingheader');
			$this->load->view('userfollowing', $data);
			$this->load->view('landingfooter');
		}
	}

	public function reviews() {
		if ($this->User_model->verifyUser()) {
			$data["reviews"] = $this->User_model->getUserReviews();
			$this->load->view('landingheader');
			$this->load->view('userreviews', $data);
			$this->load->view('landingfooter');
		}
	}

	public function index($userid=0){
		if (!empty($userid)){ 
			$this->load->view('landingheader');
			
			$this->load->view('landingfooter');
		} else {
			if ($this->User_model->verifyUser()) {
				$this->load->view('landingheader');
			
				$this->load->view('landingfooter');
			}
		}
	}

	public function profile()
	{
		if ($this->User_model->verifyUser()) {
			$problem = 1;
			if ($this->input->post()) {
				$post = $this->input->post();
				if ($post["type"] == "changepassword") { 
					$problem = $this->User_model->changePassword($post); 
					if ($problem == 0) { 
						$problem = "There was a problem with your request";
					} elseif ($problem == 2) {
						$problem = "Password Does Not Match";
					} elseif ($problem == 3) {
						$problem = "Invalid Current Password";
					}
				}
				if ($post["type"] == "uploadpic") { 
					$problem = $this->User_model->uploadAvatar($post); 
				}
				if ($post["type"] == "updateprofile") {
					$problem = $this->User_model->updateProfile($post); 
					if ($problem == 0) {
						$problem = "There was a problem with your request";
					} elseif ($problem == 2) {
						$problem = "We have sent a verification request email to the email you previously provided.";
					}
				}
			}

			// build page and data
			$userinfo = $this->User_model->getUserProfileInfo();
			if ($userinfo == FALSE) {
				redirect("../404");
			}
			$data["problem"] = $problem;
			$data["userinfo"] = $userinfo;
			$this->load->view('landingheader');
			$this->load->view('usersettings', $data);
			$this->load->view('landingfooter');
		}
		
	}


}
