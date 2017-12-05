<?php

class Restaurant_model extends CI_Model {

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

    public function getRestaurantInfo($restaurant=0) {
    	$buildarray = [];
    	if (!empty($restaurant)) {
            // retrieve all basic data
    		$sql = "SELECT * FROM leads WHERE url = ".$this->db->escape($restaurant);
    		$query = $this->db->query($sql);
    		if ($query) {
    			foreach ($query->result_array() as $res) {
    				foreach ($res as $key=>$value) {
    					$buildarray[$key] = $value;
    				}
    			}
    		}
            if (count($buildarray) == 0) { return $buildarray; }
            // retrieve photos
            $photoarray = [];
            $rid = $buildarray["id"];
            $sql2 = "SELECT url FROM photos WHERE active = '1' AND rid = '".$rid."'";
            $query2 = $this->db->query($sql2);
            if ($query2) {
                foreach ($query2->result_array() as $res) {
                    $photoarray[] = $res["url"];
                }
            }
            $buildarray["photos"] = $photoarray;
            // retrieve all reviews
            $reviewsarray = [];
            $sql3 = "SELECT COALESCE(p.url,0) as 'photo', COALESCE(r.rating,0) as 'rating', COALESCE(r.review,0) as 'review', u.fullname, COALESCE(a.href,0) as 'avatar', r.created FROM reviews r
            LEFT JOIN photos p ON r.id = p.rid 
            LEFT JOIN users u ON r.uid = u.id
            LEFT JOIN avatars a ON u.id = a.uid 
            WHERE r.active = '1' AND u.active = '1' AND r.rid = '".$rid."'";
            $query3 = $this->db->query($sql3);
            if ($query3) {
                foreach ($query3->result_array() as $res) {
                    $reviewsarray[] = array(
                        "user" => $res["fullname"],
                        "avatar" => $res["avatar"],
                        "rating" => $res["rating"],
                        "review" => $res["review"],
                        "photo" => $res["photo"],
                        "date" => $res["created"]
                        );
                }
            }
            $buildarray["reviews"] = $reviewsarray;
            // if they aren't a vendor retrieve all competitors
            // get possible data affiliated with said place
            $category = "";
            $cuisine = "";
            if (isset($buildarray["cuisine"]) && !empty($buildarray["cuisine"])) {
                $categoryarray = json_decode($buildarray["cuisine"], true);
                $cuisine = ' OR rl.cuisine LIKE "%'.$categoryarray[0][0].'%"';
            }
            $categoryarray = null;
            if (isset($buildarray["category_labels"]) && !empty($buildarray["category_labels"])) {
                $categoryarray = json_decode($buildarray["category_labels"], true);
                $category = ' AND rl.cuisine LIKE "%'.$categoryarray[0][2].'%"';
            }
            $ip = $this->getIP();
            $now = time();
            $competitors = []; 
            $sql4 = "SELECT COALESCE(v.premium,0) as 'premium', rl.hours, rl.category_labels, rl.cuisine, rl.id, rl.name, rl.address, rl.latitude, rl.longitude, rl.rating, rl.url, ( 3959 * acos( cos( radians(".$buildarray["latitude"].") ) 
                      * cos( radians( rl.latitude ) ) 
                      * cos( radians( rl.longitude ) - radians('".$buildarray["longitude"]."') ) 
                      + sin( radians('".$buildarray["latitude"]."') ) 
                      * sin( radians( rl.latitude ) ) ) ) AS distance FROM leads rl
                      LEFT JOIN vendors v ON rl.id = v.rid
                      WHERE rl.active = '1'".$category.$cuisine."  HAVING distance < 10 ORDER BY rl.rating DESC LIMIT 6";
            $query4 = $this->db->query($sql4);
            if ($query4) {
                foreach ($query4->result_array() as $res) {
                    $competitors[] = $res; 
                    if ($res["premium"] == 1) { 
                        $sql5 = "INSERT INTO vendorstats (rid,ip,date,type) VALUES (".$this->db->escape($res["id"]).", ".$this->db->escape($ip).", ".$this->db->escape($now).", ".$this->db->escape(PPCCompetitor).")";
                    } else {
                        $sql5 = "INSERT INTO vendorstats (rid,ip,date,type) VALUES (".$this->db->escape($res["id"]).", ".$this->db->escape($ip).", ".$this->db->escape($now).", ".$this->db->escape(Competitor).")";
                    }
                    $this->db->query($sql5); 
                }
            }
            $buildarray["competitors"] = $competitors;
    		return $buildarray;
    	} else {
    		return $buildarray;
    	}
    }
	

}