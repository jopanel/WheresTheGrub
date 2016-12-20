<?php

class Vendor_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

    }

    /*
    SESSION DATA:

                    $this->session->set_userdata('uid', $query->row()->id);
                    $this->session->set_userdata('fullname', $query->row()->fullname);
                    $this->session->set_userdata('vendoremail', $email);
                    $this->session->set_userdata('vendortoken', $sessiontoken);
                    $this->session->set_userdata('vendorloggedin', '1');
    */
    public function addHistoryPPC($rid,$uid,$campaignid,$action=null) {
        $sql = "INSERT INTO ppc_history (rid,action,created,user,campaignid) VALUES (".$this->db->escape($rid).",".$this->db->escape($action).", NOW() ,".$this->db->escape($uid).",".$this->db->escape($campaignid).")";
        $this->db->query($sql);
        return TRUE;
    }

    public function listAllPPC($rid) {
        if (!isset($rid) || empty($rid)) { return false; }
        $sql = "SELECT * FROM ppc_campaigns WHERE rid = ".$this->db->escape((int)$rid);
        $query = $this->db->query($sql);
        if ($query) {
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }
    }

    public function createPPC($rid,$data) { 
        if ($this->session->userdata("uid")) { $uid = strip_tags($this->session->userdata("uid")); } else { return FALSE; }
        if (!isset($data["budget"]) || empty($data["budget"])) { return FALSE; } else { $budget = $data["budget"]; }
        if (!isset($data["name"]) || empty($data["name"])) { return FALSE; } else { $name = $data["name"]; }
        $sql = "INSERT INTO ppc_campaigns (rid,budget,name,created,active) VALUES (".$this->db->escape($rid).",".$this->db->escape($budget).",".$this->db->escape($name).", NOW(), '0')";
        $this->db->query($sql);
        $sql2 = "SELECT MAX(id) as 'id' FROM ppc_campaigns WHERE rid = ".$this->db->escape($rid);
        $query = $this->db->query($sql2);
        if ($this->addHistoryPPC($rid,$uid,$query->row()->id,"New campaign created") == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
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
        /*
            Review Stats:
            - how many reviews total
            - how many reviews last 30 days
            - how many reviews 1y
            - average review rating
            - average review power 
        */
    }

    public function getBizStats($rid) {
        /*
            foreach vendorstats_type get last 30 days, 1 year, and total
        */
    }

    public function getPPCStats() {

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