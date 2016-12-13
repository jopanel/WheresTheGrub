<?php

class Vendor_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

    }

    public function listAllPPC() {

    }

    public function createPPC() {

    }

    public function editPPC() {

    }

    public function deletePPC() {

    }

    public function addPPCkeyword() {

    }

    public function addCredit() {

    }

    public function getBizReviewStats() {
    
    }

    public function getBizStats() {

    }

    public function getPPCStats() {

    }

    public function getBizRatingStats() {

    }

    public function getBizMobileStats() {

    }

    public function getBizWebStats() {

    }

    public function getBizInformation() {

    }

    public function editBizInformation() {

    }

    public function addBizInformation() {

    }

    public function removeBizInformation() {

    }

    public function addPhotos() {

    }

    public function deletePhotos() {

    }

    public function addMenuItems() {

    }

    public function deleteMenuItems() {

    }

    public function editMenuItems() {

    }

    public function listMenuItems() {

    }

    public function getVendorUsers() {

    }

    public function deleteVendorUsers() {

    }

    public function addVendorUser() {

    }

    public function editVendorUser() {

    }

    public function getMarketingTools() {

    }

    public function addListing() {

    }

    public function getPremiumStatus() {

    }

    public function getBizDetails() {

    }

    public function getBizReviews() {

    }

    public function respondToReview() {

    }

    public function requestReviewDelete() {

    }

    public function getAllPromos() {

    }

    public function deletePromo() {

    }

    public function addPromo() {

    }

    public function editPromo() {

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

    public function getMyBusinesses() {
        $sql = "SELECT l.*, COALESCE(vu.premium, 0) as 'premium' FROM vendorusers v 
        LEFT JOIN leads l ON v.rid = l.id
        LEFT JOIN vendors vu ON v.rid = vu.rid
        WHERE v.active = '1'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
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

    public function verifyUser() {
        $destroy = 0;
        //var_dump($this->session->userdata());
        if ($this->session->userdata("vendortoken")) { $sessiontoken = strip_tags($this->session->userdata("vendortoken")); } else { $destroy = 1;}
        if ($this->session->userdata("vendoremail")) {$email = strip_tags($this->session->userdata("vendoremail"));} else {$destroy = 1;}
        if ($this->session->userdata("vendorloggedin")) {$islogged = strip_tags($this->session->userdata("vendorloggedin"));} else {$destroy = 1;}
        $ip = $this->getIP(); 
        if ($destroy == 0) {
            if ($islogged == 1) {
                $sql = "SELECT * FROM vendorusers WHERE email = ".$this->db->escape($email)."";
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
            $this->session->unset_userdata('vendortoken');
            $this->session->unset_userdata('vendoremail');
            $this->session->unset_userdata('vendorloggedin');
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


}