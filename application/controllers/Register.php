<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('General_model');
			if ( !$this->session->userdata('zipcode') ) {
				if ($this->_bot_detected() == TRUE) {
					$this->session->set_userdata("zipcode", "90713");
				} else {
				$ip = $this->General_model->getIP();	
				}
				if ($ip) {
					if ($ip == "127.0.0.1") {
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
	

	private function _bot_detected() {
	  if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
	    return TRUE;
	  }
	  else {
	    return FALSE;
	  }
	}
	public function index()
	{
		$data["bgstyle"] = 'style="background-image: url(resources/img/registerbg.jpg); background-position: center top; background-size: 100% auto; background-repeat: no-repeat;"';
		$this->load->view('landingheader', $data);
		$data["problem"] = 0;
		if ($this->input->post()) {
			$post = $this->input->post();
			// check if they are a bot
			$data = array(
            'secret' => "6Lc9jCcTAAAAAJFxIm_L4KmZJnpanMTWFdeGy5uD",
            'response' => $post["g-recaptcha-response"]
        	);

			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($verify);
			//var_dump($response);
			$response = json_decode($response, true);
			if ($response == TRUE) {
				$this->load->model('User_model');
				$createlogin = $this->User_model->Register($post);
				if ($createlogin == "SUCCESS") {
					redirect("../../user/profile");
				} else {
					$data["problem"] = $createlogin;
				}
			} else {
				$data["problem"] = 6;
			}
			

		}

		if ($this->session->userdata("email")) {
			// do nothing
		} else {
			$this->load->view('register');
		}

		$this->load->view('landingfooter');
	}


}
