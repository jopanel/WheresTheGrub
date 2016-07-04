<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('General_model');
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
		//var_dump($this->session->userdata());
		$data["recommended"] = $this->General_model->getRecommended(6);
		$data["phrase"] = $this->General_model->getStatePhrase();
		$data["bestrated"] = $this->General_model->getBestRated(8);
		$this->load->view('landingheader');
		$this->load->view('landing', $data);
		$this->load->view('landingfooter');
	}

	protected function extract_zipcode($address, $remove_statecode = false) {
   		$zipcode = preg_match("/\b[A-Z]{2}\s+\d{5}(-\d{4})?\b/", $address, $matches);
    	return $remove_statecode ? preg_replace("/[^\d\-]/", "", extract_zipcode($matches[0])) : $matches[0];
	}

	public function search() {
		/*
			Steps to complete:

			1. get authentication
			2. check user lat/lon/postcode exist
			3. check if user has new location or same location
			4. start creation of sql
			5. create additional where clauses based on filter data
			6. output query
			7. form data in array properly
			8. echo json
		*/
		if ($this->input->post()) {

			$post = $this->input->post();
			$buildarray = [];
			var_dump($post);

			if (isset($this->session->userdata("userdata_zip_code_id")) && isset($this->session->userdata("userdata_lat")) && isset($this->session->userdata("userdata_lon"))) {
				if ($this->session->userdata("location") != $post("location")) {
					// user posted new location to view
					$geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($post("location")));
					$output= json_decode($geocode);
					if ($output->status == "OK") {
						$this->session->set_userdata("location") = $output->results[0]->formatted_address;
						$zipdata = $this->General_model->getZipDetails($output->results[0]->address_components[6]->short_name);
						foreach($zipdata as $key => $value){
							$this->session->set_userdata("userdata_".$key,$value);
						}
						$this->session->set_userdata("userdata_lat") = $output->results[0]->geometry->location->lat;
						$this->session->set_userdata("userdata_lon") = $output->results[0]->geometry->location->lng;
					} 
				}
				// start getting information
				$sql = "SELECT * FROM leads WHERE ";
				if (isset($post("distance")) && !empty($post("distance"))) {
					$sql .= " AND `distance` = '".."'";
				} else {
					$sql .= "";
				}

				if (isset($post("accessible_wheelchair")) && !empty($post("accessible_wheelchair"))) {
					$sql .= " AND `accessible_wheelchair` = '".."'";
				}
				if (isset($post("kids_goodfor")) && !empty($post("kids_goodfor"))) {
					$sql .= " AND `kids_goodfor` = '".."'";
				}
				if (isset($post("meal_breakfast")) && !empty($post("meal_breakfast"))) {
					$sql .= " AND `meal_breakfast`  = '".."'";
				}
				if (isset($post("meal_dinner")) && !empty($post("meal_dinner"))) {
					$sql .= " AND `meal_dinner` = '".."'";
				}
				if (isset($post("meal_lunch")) && !empty($post("meal_lunch"))) {
					$sql .= " AND `meal_lunch` = '".."'";
				}
				if (isset($post("open_24hrs")) && !empty($post("open_24hrs"))) {
					$sql .= " AND `open_24hrs` = '".."'";
				}
				if (isset($post("options_healthy")) && !empty($post("options_healthy"))) {
					$sql .= " AND `options_healthy` = '".."'";
				}
				if (isset($post("wifi")) && !empty($post("wifi"))) {
					$sql .= " AND `wifi` = '".."'";
				}
				if (isset($post("options_vegetarian")) && !empty($post("options_vegetarian"))) {
					$sql .= " AND `options_vegetarian` = '".."'";
				}
				if (isset($post("alcohol")) && !empty($post("alcohol"))) {
					$sql .= " AND `alcohol` = '".."'";
				}
				if (isset($post("alcohol_beer")) && !empty($post("alcohol_beer"))) {
					$sql .= " AND `alcohol_beer` = '".."'";
				}
				if (isset($post("alcohol_beer_wine")) && !empty($post("alcohol_beer_wine"))) {
					$sql .= " AND `alcohol_beer_wine` = '".."'";
				}
				if (isset($post("deliverypickup")) && !empty($post("deliverypickup"))) {
					$sql .= " AND `` = '".."'";
				}
				if (isset($post("ratingpopularity")) && !empty($post("ratingpopularity"))) {
					$sql .= " AND `` = '".."'";
				}
				if (isset($post("opennow")) && !empty($post("opennow"))) {
					$sql .= " AND `` = '".."'";
				}
				
				

			}


			/*
		"data": [
        {
            "id": 1,
            "category": "bar_restaurant",
            "title": "Steak House Restaurant",
            "location": "63 Birch Street",
            "latitude": 51.541599,
            "longitude": -0.112588,
            "url": "restaurant-item-detail.html",
            "type": "Restaurant",
            "type_icon": "assets/icons/restaurants-bars/restaurants/restaurant.png",
            "rating": 4,
            "gallery":
                [
                    "resources/img/items/1.jpg",
                    "resources/img/items/5.jpg",
                    "resources/img/items/4.jpg"
                ],
            "features":
                [
                    "Free Parking",
                    "Cards Accepted",
                    "Wi-Fi",
                    "Air Condition",
                    "Reservations",
                    "Teambuildings",
                    "Places to seat"
                ],
            "date_created": "2014-11-03",
            "featured": 0,
            "color": "",
            "person_id": 1,
            "year": 1980,
            "special_offer": 0,
            "item_specific":
                {
                    "menu": "$6.50",
                    "offer1": "Chicken wings",
                    "offer1_price": "4.50",
                    "offer2": "Mushroom ragout",
                    "offer2_price": "3.60",
                    "offer3": "Nice salad with tuna, beans and hard-boiled egg",
                    "offer3_price": "1.20"
                },
            "description": "Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.",
            "last_review": "Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet",
            "last_review_rating": 5
        }
		*/

		//echo json_encode($data);
		} else {
			echo "You require more pylons.";
		}
	}

}
