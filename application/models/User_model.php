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

    public function changePassword($post=0) {
        if (!empty($post)) {
            if ($post["newpassword"] != $post["confirmpassword"]) { return 2; }
            $sql = "SELECT password FROM users WHERE email = ".$this->db->escape(strip_tags($this->session->userdata("email")))." AND password = ".$this->db->escape(strip_tags(md5($post["currentpassword"])))."";
            $query = $this->db->query($sql);
            if ($query->result_array() > 0) {
                $sql = "UPDATE users SET password = ".$this->db->escape(md5($post["newpassword"]))." WHERE email = ".$this->db->escape(strip_tags($this->session->userdata("email")))."";
                $this->db->query($sql);
                return TRUE; 
            } else {
                return 3;
            }
        } else {
            return FALSE;
        }
    }

    public function uploadAvatar($post=0) {
        
    }

    public function updateProfile($post=0) {
        // fullname, email, phone, state, city, address, about, newsletter, zip
        if (!empty($post)) { 
            if (!isset($post["newsletter"]) || empty($post["newsletter"])) { $newsletter = 0; } else {$newsletter = 1;}
            // change user information no email verification required
            if ($this->session->userdata("email") == $post["email"]) {
                $sql2 = "UPDATE users SET fullname = ".$this->db->escape(strip_tags($post["fullname"])).",phone = ".$this->db->escape(strip_tags($post["phone"])).",state = ".$this->db->escape(strip_tags($post["state"])).",city = ".$this->db->escape(strip_tags($post["city"])).",address = ".$this->db->escape(strip_tags($post["address"])).",about = ".$this->db->escape(strip_tags($post["about"])).",newsletter = ".$this->db->escape(strip_tags($newsletter)).",zip = ".$this->db->escape(strip_tags($post["zip"]))." WHERE email = ".$this->db->escape(strip_tags($this->session->userdata("email")))."";
                $this->db->query($sql2);
                return TRUE;
            } else {
                // check if current email is validated
                $validatedemail = 0;
                $sql3 = "SELECT level FROM users WHERE email = ".$this->db->escape(strip_tags($post["email"]));
                $query = $this->db->query($sql3);
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $res) {
                        if ($res["level"] == "normal") {
                            $validatedemail = 1;
                        }
                    }
                }
                if ($validatedemail == 1) {
                    // validate email

                    // send email change request


                    // update rest of information
                    $sql2 = "UPDATE users SET fullname = ".$this->db->escape(strip_tags($post["fullname"])).",phone = ".$this->db->escape(strip_tags($post["phone"])).",state = ".$this->db->escape(strip_tags($post["state"])).",city = ".$this->db->escape(strip_tags($post["city"])).",address = ".$this->db->escape(strip_tags($post["address"])).",about = ".$this->db->escape(strip_tags($post["about"])).",newsletter = ".$this->db->escape(strip_tags($newsletter)).",zip = ".$this->db->escape(strip_tags($post["zip"]))." WHERE email = ".$this->db->escape(strip_tags($this->session->userdata("email")))."";
                    $this->db->query($sql2);
                    return 2;
                } else {
                $sql2 = "UPDATE users SET email = ".$this->db->escape(strip_tags($post["email"])).", fullname = ".$this->db->escape(strip_tags($post["fullname"])).",phone = ".$this->db->escape(strip_tags($post["phone"])).",state = ".$this->db->escape(strip_tags($post["state"])).",city = ".$this->db->escape(strip_tags($post["city"])).",address = ".$this->db->escape(strip_tags($post["address"])).",about = ".$this->db->escape(strip_tags($post["about"])).",newsletter = ".$this->db->escape(strip_tags($newsletter)).",zip = ".$this->db->escape(strip_tags($post["zip"]))." WHERE email = ".$this->db->escape(strip_tags($this->session->userdata("email")))."";
                $this->db->query($sql2);
                $this->session->set_userdata("email", strip_tags($post["email"]));
                return TRUE;
                }
            }    
        } else {
            return FALSE;
        }
    }

    public function getUserProfileInfo($user=0) {
        $buildarray = [];
        if ($user == 0) { 
            $user = "WHERE u.email = ".$this->db->escape(strip_tags($this->session->userdata("email")));
             } else {
                $user = "WHERE u.id = ".$this->db->escape(strip_tags($user)); 
            }
        //[profilepic],fullname,email,phone,state,city,address,zip, aboutme,
        $sql = "SELECT u.fullname, u.email, u.phone, u.state, u.address, u.zip, u.about, a.href, u.newsletter, u.city FROM users u 
        LEFT JOIN avatars a ON u.id = a.uid ".$user;
        $result = $this->db->query($sql);
        if ($result) {
            foreach ($result->result_array() as $res) {
                if ($res["newsletter"] == 1) { $newsletter = "checked"; } else { $newsletter = ""; }
                $buildarray = array(
                    "fullname"=>$res["fullname"],
                    "email"=>$res["email"],
                    "phone"=>$res["phone"],
                    "state"=>$res["state"],
                    "address"=>$res["address"],
                    "city"=>$res["city"],
                    "zip"=>$res["zip"],
                    "about"=>$res["about"],
                    "href"=>$res["href"],
                    "newsletter" =>$newsletter
                    );
            }
            return $buildarray;
        } else {
            return FALSE;
        }
    }

    public function verifyUser() {
        $destroy = 0;
        if ($this->session->userdata("usertoken")) { $sessiontoken = strip_tags($this->session->userdata("usertoken")); } else { $destroy = 1;}
        if ($this->session->userdata("email")) {$email = strip_tags($this->session->userdata("email"));} else {$destroy = 1;}
        if ($this->session->userdata("loggedin")) {$islogged = strip_tags($this->session->userdata("loggedin"));} else {$destroy = 1;}
        $ip = $this->getIP();
        if ($destroy == 0) {
            if ($islogged == 1) {
                $sql = "SELECT * FROM users WHERE email = ".$this->db->escape($email)."";
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
                $sql = "SELECT * FROM users WHERE email = ".$this->db->escape($email)." AND password = ".$this->db->escape(md5($password));
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    $sql2 = "UPDATE users SET `sessiontoken` = ".$this->db->escape($sessiontoken).", ip = ".$this->db->escape($ip).", `last login` = NOW() WHERE email = ".$this->db->escape($email);
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
                $sql = "SELECT * FROM users WHERE email = ".$this->db->escape(strip_tags($post["email"]));
                $query = $this->db->query($sql);
                if ($query->num_rows() == 0) {
                    $sql2 = "INSERT INTO users (`sessiontoken`, `verification key`, mobilecode, email, password, level, newsletter, active, created, ip, fullname) VALUES (".$this->db->escape($sessiontoken).",".$this->db->escape($verification).",".$this->db->escape($mobilecode).",".$this->db->escape(strip_tags($post["email"])).",".$this->db->escape(strip_tags(md5($post["password"]))).",".'notactive'.",".$this->db->escape($newsletter).",1,NOW(),".$this->db->escape($ip).",".$this->db->escape(strip_tags($post["fullname"])).")";
                    $this->db->query($sql2);
                    $this->session->set_userdata('email', strip_tags($post["email"]));
                    $this->session->set_userdata('usertoken', $sessiontoken);
                    $this->session->set_userdata('loggedin', '1');

                    $url = 'https://api.sendgrid.com/';
                    $user = 'frontendkey';
                    $pass = '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';
                    $json_string = array(

                      'to' => array(
                        $email
                      ),
                      'category' => "register"
                    );
                    $params = array(
                        'api_user'  => $user,
                        'api_key'   => $pass,
                        'x-smtpapi' => json_encode($json_string),
                        'to'        => $email,
                        'subject'   => 'Wheres The Grub E-Mail Verification',
                        'html'      => $body,
                        'text'      => 'Wheres The Grub',
                        'from'      => 'nereply@wheresthegrub.com',
                      );
                    $request =  $url.'api/mail.send.json';
                    // Generate curl request
                    $session = curl_init($request);
                    // Tell curl to use HTTP POST
                    curl_setopt ($session, CURLOPT_POST, true);
                    // Tell curl that this is the body of the POST
                    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
                    // Tell curl not to return headers, but do return the response
                    curl_setopt($session, CURLOPT_HEADER, false);
                    // Tell PHP not to use SSLv3 (instead opting for TLS)
                    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
                    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
                    // obtain response
                    $response = curl_exec($session);
                    curl_close($session);
                    
                    return "SUCCESS";
                } else {
                    $problem = 5;
                }
                
            }
            return $problem;
    	}
    }

}