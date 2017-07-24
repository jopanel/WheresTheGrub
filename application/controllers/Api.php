<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct() {
		parent::__construct(); 
		date_default_timezone_set('America/Los_Angeles'); 
	}

	private function _bot_detected() {
	  if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
	    return TRUE;
	  }
	  else {
	    return FALSE;
	  }
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

	public function quickview() {
		 if($this->input->is_ajax_request()) {
		 	if ($this->input->post()) {
		 		$post = $this->input->post();
		 		if (is_int((int)$post["id"])) {
		 			$buildarray = [];
		 			$sql = "SELECT * FROM leads WHERE id = ".$this->db->escape(strip_tags((int)$post["id"]));
		 			$query = $this->db->query($sql);
		 			if ($query->num_rows() > 0) {
		 				foreach ($query->result_array() as $res) {
		 					foreach ($res as $key=>$value) {
		 						$buildarray[$key] = $value;
		 					}
		 				}
		 				$reviewsarray = [];
			            $sql3 = "SELECT COALESCE(p.url,0) as 'photo', COALESCE(r.rating,0) as 'rating', COALESCE(r.review,0) as 'review', u.fullname, COALESCE(a.href,0) as 'avatar', r.created FROM reviews r
			            LEFT JOIN photos p ON r.id = p.rid 
			            LEFT JOIN users u ON r.uid = u.id
			            LEFT JOIN avatars a ON u.id = a.uid 
			            WHERE r.active = '1' AND u.active = '1' AND r.rid = ".$this->db->escape((int)$post["id"])." ORDER BY r.created DESC LIMIT 1";
			            $query3 = $this->db->query($sql3);
			            if ($query3) {
			                foreach ($query3->result_array() as $res) {
			                    $reviewsarray = array(
			                        "user" => $res["fullname"],
			                        "avatar" => $res["avatar"],
			                        "rating" => $res["rating"],
			                        "review" => $res["review"],
			                        "photo" => $res["photo"],
			                        "date" => $res["created"]
			                        );
			                }
			            }
			            $sql4 = "SELECT COALESCE(premium, 0) as 'premium' FROM vendors WHERE rid = ".$this->db->escape($buildarray["id"]); 
			            $query4 = $this->db->query($sql4);
			            if (isset($query4->row()->premium)) {
			            	$ispremium = $query4->row()->premium;
			            } else { $ispremium = 0;}
			            
			            $ip = $this->getIP();
			            $now = time();
			            if ($ispremium == 1) {
			            	$sql5 = "INSERT INTO vendorstats (rid,ip,date,type) VALUES (".$this->db->escape($buildarray["id"]).", ".$this->db->escape($ip).", ".$this->db->escape($now).", ".$this->db->escape(PPCMapClick).")";
			            } else {
			            	$sql5 = "INSERT INTO vendorstats (rid,ip,date,type) VALUES (".$this->db->escape($buildarray["id"]).", ".$this->db->escape($ip).", ".$this->db->escape($now).", ".$this->db->escape(MapClick).")";
			            }
			            $this->db->query($sql5);

			            $data["premium"] = $ispremium;
			            $buildarray["review"] = $reviewsarray;
		 				$data["arraydata"] = $buildarray; 
		 				$this->load->view('quickview', $data);
		 			} else {
		 				return FALSE;
		 			}
		 		}
		 	}
		 }
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
			//echo $post("location");
			$buildarray = []; 
			if ($this->session->userdata("userdata_zip_code_id") && $this->session->userdata("userdata_lat") && $this->session->userdata("userdata_lon") && $post["location"] && $this->session->userdata("location")) {
				if ($this->session->userdata("location") != $post["location"]) {
					// user posted new location to view
					$geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($post["location"]));
					$output= json_decode($geocode);
					if ($output->status == "OK") {
						$this->session->set_userdata("location", $output->results[0]->formatted_address);
						//var_dump($output); 
						$addressComponents = $output->results[0]->address_components;
						$haszip = 0;
			            foreach($addressComponents as $addrComp){
			                if($addrComp->types[0] == 'postal_code'){
			                	$haszip = 1;
			                    $theirzip = $addrComp->short_name;
			                }
			            }
			            if (!isset($theirzip) || empty($theirzip)) {
			            	$theirzip = $this->General_model->getZipByCoord($output->results[0]->geometry->location->lat, $output->results[0]->geometry->location->lng);
			            	if ($theirzip == FALSE) {
			            		// bad input
			            	} else {
			            		$zipdata = $this->General_model->getZipDetails($theirzip);
								foreach($zipdata as $key => $value){
									$this->session->set_userdata("userdata_".$key,$value);
								}
								$this->session->set_userdata("zipcode", $theirzip);
								$this->session->set_userdata("userdata_lat",$output->results[0]->geometry->location->lat);
								$this->session->set_userdata("userdata_lon",$output->results[0]->geometry->location->lng);
			            	}
			            } else {
			            	$zipdata = $this->General_model->getZipDetails($theirzip);
							foreach($zipdata as $key => $value){
								$this->session->set_userdata("userdata_".$key,$value);
							}
							$this->session->set_userdata("zipcode", $theirzip);
							$this->session->set_userdata("userdata_lat",$output->results[0]->geometry->location->lat);
							$this->session->set_userdata("userdata_lon",$output->results[0]->geometry->location->lng);
			            }
						
					} 
				}
				// start getting information
				$latitude = $this->session->userdata("userdata_lat");
				$longitude = $this->session->userdata("userdata_lon");
				$sql = "SELECT COALESCE(v.premium,0) as 'premium', rl.hours, rl.category_labels, rl.cuisine, rl.id, rl.name, rl.address, rl.latitude, rl.longitude, rl.rating,rl.url,( 3959 * acos( cos( radians(".$this->db->escape($latitude).") ) 
		              * cos( radians( rl.latitude ) ) 
		              * cos( radians( rl.longitude ) - radians(".$this->db->escape($longitude).") ) 
		              + sin( radians(".$this->db->escape($latitude).") ) 
		              * sin( radians( rl.latitude ) ) ) ) AS distance FROM restaurantlist rl
		              LEFT JOIN vendors v ON rl.id = v.rid
		               WHERE rl.active = '1'";
				$yes = 1;
				if (isset($post["accessible_wheelchair"])) {
					$sql .= " AND rl.accessible_wheelchair = '".$yes."'";
				}
				if (isset($post["kids_goodfor"])) {
					$sql .= " AND rl.kids_goodfor = '".$yes."'";
				}
				if (isset($post["meal_breakfast"])) {
					$sql .= " AND rl.meal_breakfast  = '".$yes."'";
				}
				if (isset($post["meal_dinner"])) {
					$sql .= " AND rl.meal_dinner = '".$yes."'";
				}
				if (isset($post["meal_lunch"])) {
					$sql .= " AND rl.meal_lunch = '".$yes."'";
				}
				if (isset($post["open_24hrs"])) {
					$sql .= " AND rl.open_24hrs = '".$yes."'";
				}
				if (isset($post["options_healthy"])) {
					$sql .= " AND rl.options_healthy = '".$yes."'";
				}
				if (isset($post["wifi"])) {
					$sql .= " AND rl.wifi = '".$yes."'";
				}
				if (isset($post["options_vegetarian"])) {
					$sql .= " AND rl.options_vegetarian = '".$yes."'";
				}
				if (isset($post["alcohol"])) {
					$sql .= " AND rl.alcohol = '".$yes."'";
				}
				if (isset($post["alcohol_beer"])) {
					$sql .= " AND rl.alcohol_beer = '".$yes."'";
				}
				if (isset($post["alcohol_beer_wine"])) {
					$sql .= " AND rl.alcohol_beer_wine = '".$yes."'";
				}
				if (isset($post["deliverypickup"])) {
					if ($post["deliverypickup"] == 1) {
						$sql .= " AND rl.meal_deliver = '".$yes."'";
					} else {
						$sql .= " AND rl.meal_takeout = '".$yes."'";
					}
				}
				if (isset($post["ratingpopularity"])) {
					if ($post["ratingpopularity"] == 1) {
						$sql .= " AND rl.rating >= '4'";
					} else {
						// needs updating for popularity after the restaurant page is made
					}
				}
				if (isset($post["opennow"])) { 
					$sql .= " AND rl.hours IS NOT NULL";
				}
				if (isset($post["keyword"])) {
					// needs updating for keyword searching, this part should probably be pretty advanced.
					// im thinking create another function that builds a large where clause for different keyword specifics
					$keyword = $this->db->escape("%".strip_tags($post["keyword"])."%");
					$sql .= " AND (rl.name LIKE ".$keyword." OR rl.category_labels LIKE ".$keyword." OR rl.cuisine LIKE ".$keyword." OR rl.description LIKE ".$keyword.")";
				}
				if (isset($post["distance"])) {
					if ($post["distance"] == 1) {
						$sql .= " HAVING distance < 1";
					} elseif ($post["distance"] == 5) {
						$sql .= " HAVING distance < 5";
					} elseif ($post["distance"] == 10) {
						$sql .= " HAVING distance < 10";
					} else {
						// somebody modified the site and maybe we should ban them for trying? nah lets just do default
						$sql .= " HAVING distance < 2";
					}
				} else {
					$sql .= " HAVING distance < 2";
				}

				//$sql .= " LIMIT 300";
				/*
				SELECT hours, category_labels, cuisine, id, name, address, latitude, longitude, rating,url,( 3959 * acos( cos( radians(33.8477257) ) 
		              * cos( radians( latitude ) ) 
		              * cos( radians( longitude ) - radians(-118.1181199) ) 
		              + sin( radians(33.8477257) ) 
		              * sin( radians( latitude ) ) ) ) AS distance FROM restaurantlist WHERE active = '1' AND (name LIKE '%%' OR category_labels LIKE '%%' OR cuisine LIKE '%%' OR description LIKE '%%') HAVING distance < 2
		        */
		        $ip = $this->getIP();
				$result = $this->db->query($sql);
				if ($result) {
					$resultset = $result->result_array();
					$result = null;
					if (isset($post["opennow"])) {
						foreach ($resultset as $firstkey => $value) {
							 $hoursarray = json_decode($value["hours"], true);
                             $day = date("l");
                             $day = strtolower($day);
                             $now = date("H:s");
                             $open = 0;
                             foreach ($hoursarray as $theday => $thetimes) {
                                 if ($theday == $day) {
                                     foreach ($thetimes as $times) {
                                         if (strtotime($times[0]) < strtotime($now) && strtotime($now) < strtotime($times[1])) {
                                             $open = 1;
                                         }
                                     }
                                 }
                             }
                             if ($open == 0) {
                             	unset($resultset[$firstkey]);
                             }
                        }   
					}
					$count = 0;
					foreach ($resultset as $resarr) {
						// build the data translation
						if (isset($resarr["id"]) && !empty($resarr["id"])) {
							//category
							$label = "";
							if ($resarr["category_labels"]) {
								$categoryarray = json_decode($resarr["category_labels"], true);
	                            foreach ($categoryarray[0] as $labels) {
	                                $label .= $labels." ";
	                            }
	                            $categoryarray = null;
							}

							$type = "Place";
							if ($resarr["cuisine"]) {
								$categoryarray = json_decode($resarr["cuisine"], true);
	                            $type = $categoryarray[0][0];
							} 
							$now = time();
							if ($resarr["premium"] == 1) {
								$sql5 = "INSERT INTO vendorstats (rid,ip,date,type) VALUES (".$this->db->escape($resarr["id"]).", ".$this->db->escape($ip).", ".$this->db->escape($now).", ".$this->db->escape(PPCMap).")";
							} else {
								$sql5 = "INSERT INTO vendorstats (rid,ip,date,type) VALUES (".$this->db->escape($resarr["id"]).", ".$this->db->escape($ip).", ".$this->db->escape($now).", ".$this->db->escape(Map).")";
							}
							$this->db->query($sql5);
							$today = date("Y-m-d");
							$buildarray["data"][] = array(
								"id" => $resarr["id"],
								"category" =>$label,
								"title" =>$resarr["name"],
								"location" =>$resarr["address"],
								"latitude" =>$resarr["latitude"],
								"longitude" =>$resarr["longitude"],
								"url" =>$resarr["url"],
								"type" =>$type,
								"type_icon" =>"resources/icons/restaurants-bars/restaurants/restaurant.png",
								"rating" =>$resarr["rating"],
								"gallery" =>array("resources/img/items/4.jpg"),
								"features" =>array("Free parking?"),
								"date_created" =>$today,
								"featured" =>0,
								"color" =>"",
								"person_id" =>$resarr["id"],
								"year" => "",
								"special_offer" =>0,
								"item_specific" => array(
									"menu" => 0,
									"offer1" =>0,
									"offer1_price" =>0
									),
								"description" =>0,
								"last_review" =>0,
								"last_review_rating" =>0,
								"premium" => $resarr["premium"]
								);
						} else {
							$buildarray["data"] = array();
						} 
					}
				} else {
					$buildarray["data"] = array();
				}
				

			} // end of requests that have session data


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

		echo json_encode($buildarray);
		} else {
			echo "You require more pylons.";
		}
	}

	protected function keywordAnalysis($keyword = null) {
		if ($keyword == null) {
			return FALSE;
		}

		//possible keywords
	}

}
