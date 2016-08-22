<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

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
		$data["bgstyle"] = 'style="background-image: url(resources/img/signinbg.jpg); background-position: center top; background-size: 100% auto; background-repeat: no-repeat;"';
		$this->load->view('landingheader', $data);
		if ($this->session->userdata("email")) {
			// do nothing
		} else {
			$this->load->view('signin');
		}
		

		// good array(6) { ["fullname"]=> string(4) "asdf" ["email"]=> string(13) "asdf@asdf.com" ["password"]=> string(4) "asdf" ["password2"]=> string(4) "asdf" ["optin"]=> string(2) "on" ["g-recaptcha-response"]=> string(1252) "03AHJ_VutbEjcAcKnd0Dr2txuDDUEXPdYncqS0jB5XiTOuYJ3QwNkk7tpThLXFY1UaFavyDeh1k-pfvLXwXx1WN-c4ditInzA3IaI8amblZeDzk6usKg5lCZOAs6odLv1dj0BVW3siMtSTSiEtzOFAbRW-LjlWTRHPck63x6ixkqMJtIyyXXHnb2mxyt5N23Umv-GSHcuWZi_oWi1qIkKBHP5WfVTt2qrb4PXjSVkV-uANs_kEsETdL4D-vjXJEy3-DCne3_lk7v03mmeYeXhSjA4kAWq5eIhIbDSnpxxSjkJN0-xwHcqxG4gyzj8bklFT4aXo5gdZH2wcGLlkD25Q833O5VxjOqprs-ce2CPPqYUWKVrQPd4YxExnSNtkAk7XmdXmQr5V6VEXm3wj66u9_C3eTcgrqGEFybmF8etsPTF8e5p5H9NFIp3dictVkCFv55PlQL-lXY56LAY9XGasqBiQ-5NvyUURmARoNYVOdFaFYX1uzKzCffmE5Lli9g4hQKDwcw8BrmERXk_hHOwwdDuuLhI50TsS933LBZQah5ZeyxpoYGTezakg2RWGCmFoZGVtXrhwaaqcqIianhYDlW2pCnZnoa2Hjc7YNToS-eps0WoriJz6JLR171sqO5w-ESH4W8d9n8ykKBxXOs4RdouXjY021AuJYnQaNsZhMMVhP035xJLbQEKN1c6MADsDCg8mhQsVj7-59-TWLz0mbreJ4zAJnyextCKhZemqv_ygB8K6RCNucbClhdk6PIDFQiaX0ooVngVawCIxt-pYxToxIUslAo0lKhFeW1UQHy6MXnAOLhPAeqZIws17WLfnRpVN-pgIvjXz53CTBjw-s5tiSyFILvQF7TYFDjqL7fdoZY0zckXJvsFDDtc5i30BgiXGaPb1HwvIlQcBqq39UwBHFvUsnatRGTXisXTFJUPDa2y2poPnbf5HV1OR3wKTTqgEoM-7YqfNagC2khe6eHLFS2JknC5L8MXPkaLG6Lxt30Xbxdha2eGjnPYZAsALdPS2-OjHks6k5mFQF7SPL6NdATBzCGy_iAwkSxKgo1b-NorqxBgoLEPJCbQXISIyeS73RU1SYT4rFjq15JU8AcVV3hMVlz47gsE2_JUxNARScK0YsnnIHvmyopWkcXxl1qYutzEjx5Hh2cfZj92M-ohv7QhyTEPTjo34R6f6FfU05ThN4kvN2DanekqksgZsJ5i0zHHBm0tO83sWNbS44RdtgR6qIXaDFA" }
		if ($this->input->post()) {
			$post = $this->input->post();
			// check if they are a bot
			

		}

		$this->load->view('landingfooter');
	}


}
