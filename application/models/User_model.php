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

    public function verifyUser() {
        $destroy = 0;
        if ($this->session->userdata("usertoken")) { $sessiontoken = strip_tags($this->session->userdata("usertoken")); } else { $destroy = 1;}
        if ($this->session->userdata("email")) {$email = strip_tags($this->session->userdata("email"));} else {$destroy = 1;}
        if ($this->session->userdata("loggedin")) {$islogged strip_tags($this->session->userdata("loggedin"));} else {$destroy = 1;}
        $ip = $this->getIP();
        if ($destroy == 0) {
            if ($islogged == 1) {
                $sql = "SELECT * FROM users WHERE email = '".$email."'";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $res) {
                        if ($res["sessiontoken"] != $sessiontoken) { $destroy = 1; }
                        if ($res["ip"] != $ip) {$destroy = 1;}
                    }
                } else {
                    $destroy = 1;
                }
            } else {
                $destroy = 1;
            }
        }
        if ($destroy == 1) {
            $this->session->unset_userdata('usertoken');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('loggedin');
            return FALSE;
        } else {
            return TRUE;
        }
        
    }

    public function logout() {
            $this->session->unset_userdata('usertoken');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('loggedin');
            return TRUE;
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

    public function userLogin($post=0) {
        if (!empty($post)) {
            $sessiontoken = $this->randomString();
            $ip = $this->getIP();
            $problem = 0;
            if (!isset($post["email"]) || empty($post["email"])) { $problem = 1; } 
            if (!isset($post["password"]) || empty($post["password"])) { $problem = 2; }
            if ($problem == 0) {
                $email = strip_tags($post["email"]);
                $password = strip_tags($post["password"]);
                $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".md5($password)."'";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    $sql2 = "UPDATE users SET `sessiontoken` = '".$sessiontoken."', ip = '".$ip."', `last login` = NOW() WHERE email = '".$email."'";
                    $this->db->query($sql2);
                    $this->session->set_userdata('email', $email);
                    $this->session->set_userdata('usertoken', $sessiontoken);
                    $this->session->set_userdata('loggedin', '1');
                    return "SUCCESS";
                } else {
                    $problem = 3;
                }
            } else {
                return $problem;
            }
        }
    }

    public function Register($post=0) {
    	if (!empty($post)) {
    		$mobilecode = $this->randomString(8);
            $verification = $this->randomString();
            $sessiontoken = $this->randomString();
            $ip = $this->getIP();
            $problem = 0;
            if ($post["password"] != $post["password2"]) { $problem = 1; }
            if (isset($post["optin"]) && $post["optin"] == "on") { $newsletter = 1; } else { $newsletter = 0; }
            if (empty($post["password"]) || empty($post["password2"])) { $problem = 2; }
            if (!isset($post["email"]) || empty($post["email"])) { $problem = 3; }
            if (!isset($post["fullname"]) || empty($post["fullname"])) { $problem = 4; }
            if ($problem == 0) {
                // check if email exists
                $sql = "SELECT * FROM users WHERE email = '".strip_tags($post["email"])."'";
                $query = $this->db->query($sql);
                if ($query->num_rows() == 0) {
                    $sql2 = "INSERT INTO users (`sessiontoken`, `verification key`, mobilecode, email, password, level, newsletter, active, created, ip, fullname) VALUES ('".$sessiontoken."','".$verification."','".$mobilecode."','".strip_tags($post["email"])."','".strip_tags(md5($post["password"]))."','notactive',".$newsletter.",1,NOW(),'".$ip."','".strip_tags($post["fullname"])."') ";
                    $this->db->query($sql2);
                    $this->session->set_userdata('email', strip_tags($post["email"]));
                    $this->session->set_userdata('usertoken', $sessiontoken);
                    $this->session->set_userdata('loggedin', '1');
                    return "SUCCESS";
                } else {
                    $problem = 5;
                }
                
            }
            return $problem;
    	}
    }

}