<?php

class User_model extends CI_Model {

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

    public function randomString($length=10) {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
         $string = '';
         $max = strlen($characters) - 1;
         for ($i = 0; $i < $length; $i++) {
              $string .= $characters[mt_rand(0, $max)];
         }
         return $string;
    }
    public function Register($post=0) {
    	if (!empty($post)) {
    		//["fullname"]=> string(4) "asdf" ["email"]=> string(13) "asdf@asdf.com" ["password"]=> string(4) "asdf" ["password2"]=> string(4) "asdf" ["optin"]=> string(2) "on"
    		$mobilecode = $this->randomString(8);
            $verification = $this->randomString();
            $ip = $this->getIP();
            $problem = 0;
            if ($post["password"] != $post["password2"]) { $problem = 1; }
            if (isset($post["optin"]) && $post["optin"] == "on") { $newsletter = 1; } else { $newsletter = 0; }
            if (empty($post["password"]) || empty($post["password2"])) { $problem = 2; }
            if (!isset($post["email"]) || empty($post["email"])) { $problem = 3; }
            if (!isset($post["fullname"]) || empty($post["fullname"])) { $problem = 4; }
            if ($problem == 0) {
                // check if email exists
                $sql = "SELECT * FROM users WHERE email = '".$post["email"]."'";
                $query = $this->db->query($sql);
                if ($query->num_rows() == 0) {
                    $sql2 = "INSERT INTO users (`verification key`, mobilecode, email, password, level, newsletter, active, created, ip, fullname) VALUES (".$verification.",".$mobilecode.",'".$post["email"]."','".md5($post["password"])."','notactive',".$newsletter.",1,NOW(),".$ip.",'".$post["fullname"]."') ";
                    $this->db->query($sql2);
                    return "SUCCESS";
                } else {
                    $problem = 5;
                }
                
            }
            return $problem;
    	}
    }

}