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
        $sql = "SELECT * FROM ppc_campaigns WHERE rid = ".$this->db->escape((int)$rid)." AND deleted = '0'";
        $query = $this->db->query($sql);
        if ($query) {
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }
    }
    

    public function editPPC($rid=0, $campaignid=0, $data=null, $action=0) {
        if ($rid == 0 || $campaignid == 0 || $action == 0) {return FALSE;}
        if ($action == "add") {
            if ($this->session->userdata("uid")) { $uid = strip_tags($this->session->userdata("uid")); } else { return FALSE; }
            if (!isset($data["budget"]) || empty($data["budget"])) { return FALSE; } else { $budget = $data["budget"]; }
            if (!isset($data["name"]) || empty($data["name"])) { return FALSE; } else { $name = $data["name"]; }
            $sql = "INSERT INTO ppc_campaigns (rid,budget,name,created,active) VALUES (".$this->db->escape($rid).",".$this->db->escape($budget).",".$this->db->escape($name).", NOW(), '0')";
            $this->db->query($sql);
            $sql2 = "SELECT MAX(id) as 'id' FROM ppc_campaigns WHERE rid = ".$this->db->escape($rid);
            $query = $this->db->query($sql2);
            if ($this->addHistoryPPC($rid,$uid,$query->row()->id,"Campaign Created") == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        if ($action == "delete") {
            if ($this->session->userdata("uid")) { $uid = strip_tags($this->session->userdata("uid")); } else { return FALSE; }
            $sql = "UPDATE ppc_campaigns SET active = '0' AND deleted = '1' WHERE id = ".$this->db->escape((int)$campaignid);
            $this->db->query($sql);
            if ($this->addHistoryPPC($rid,$uid,$campaignid,"Campaign Deleted") == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        if ($action == "edit") {

        }
    }


    public function PPCkeyword($campaignid=0, $keyword, $type="add", $data=null) {
        if ($campaignid == 0) { return FALSE; }

        if ($type == "add") {
            if ($data["cost"] == 0 || $data["cost"] <= 0) { return FALSE; }
            $sql = "INSERT INTO ppc_keywords (campaignid, user, keyword, cost, created) VALUES (".$this->db->escape((int)$campaignid).", ".$this->db->escape(strip_tags($keyword)).", ".$this->db->escape((float)$data["cost"]).", NOW())";
            $this->db->query($sql);
            return TRUE;
        }

        if ($type == "delete") {
            $sql = "DELETE FROM ppc_keywords WHERE campaignid = ".$this->db->escape((int)$campaignid)." AND id = ".$this->db->escape((int)$data["id"]);
            $this->db->query($sql);
            return TRUE;
        }

        if ($type == "edit") {
            if ($data["cost"] == 0 || $data["cost"] <= 0) { return FALSE; }
            $sql = "UPDATE ppc_keywords SET user = ".$this->db->escape((int)$this->session->userdata("uid")).", keyword = ".$this->db->escape(strip_tags($data["keyword"])).", cost = ".$this->db->escape((float)$data["cost"])." WHERE id = ".$this->db->escape((int)$data["id"])." AND campaignid = ".$this->db->escape((int)$campaignid);
            $this->db->query($sql);
            return TRUE;
        }

    }

    public function verifyPPC($campaignid=0, $rid=0) { 
        // verify PPC ownership before PPC queries. ??? needed?
        if ($campaignid == 0 || $rid == 0) { return FALSE; }
        $sql = "SELECT id FROM ppc_campaigns WHERE ";
    }

    public function addCredit() {
        // needs work
    }

    public function getBizReviewStats($rid) { 
        $data = [];
        $sql = "SELECT COALESCE(count(re.id),0) as 'total', COALESCE(AVG(r.rating),0) as 'avgrating', COALESCE(AVG(r.power),0) as 'avgreviewpower' 
                FROM reviews re
                JOIN ratings r 
                WHERE re.rid = ".$this->db->escape((int)$rid)." AND r.rid = ".$this->db->escape((int)$rid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data["reviews_total"] = $query->row()->total;
            $data["rating_total"] = $query->row()->avgrating;
            $data["rating_powertotal"] = $query->row()->avgreviewpower;
        }
        $sql = null; $query = null;
        $sql = "SELECT COALESCE(count(re.id),0) as 'total', COALESCE(AVG(r.rating),0) as 'avgrating', COALESCE(AVG(r.power),0) as 'avgreviewpower' 
                FROM reviews re
                JOIN ratings r 
                WHERE re.rid = ".$this->db->escape((int)$rid)." 
                AND r.rid = ".$this->db->escape((int)$rid)." 
                AND r.created >= DATE_ADD(CURDATE(), INTERVAL -30 DAY) 
                AND re.created >= DATE_ADD(CURDATE(), INTERVAL -30 DAY)";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data["reviews_30"] = $query->row()->total;
            $data["rating_30"] = $query->row()->avgrating;
            $data["rating_power30"] = $query->row()->avgreviewpower;
        }
        $sql = null; $query = null;
        $sql = "SELECT COALESCE(count(re.id),0) as 'total', COALESCE(AVG(r.rating),0) as 'avgrating', COALESCE(AVG(r.power),0) as 'avgreviewpower' 
                FROM reviews re
                JOIN ratings r 
                WHERE re.rid = ".$this->db->escape((int)$rid)." 
                AND r.rid = ".$this->db->escape((int)$rid)." 
                AND r.created >= DATE_ADD(CURDATE(), INTERVAL -365 DAY) 
                AND re.created >= DATE_ADD(CURDATE(), INTERVAL -365 DAY)";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data["reviews_1y"] = $query->row()->total;
            $data["rating_1y"] = $query->row()->avgrating;
            $data["rating_power1y"] = $query->row()->avgreviewpower;
        }
        $sql = null; $query = null;

        return $data;
    }

    public function getBizStats($rid) {
        $data = [];
        $sql = "SELECT COALESCE(count(vs.id),0) as 'count', vst.name as 'typename', vst.id as 'typeid' 
            FROM vendorstats vs 
            LEFT JOIN vendorstats_type vst ON vs.type = vst.id 
            WHERE vs.rid = ".$this->db->escape((int)$rid)." 
            GROUP BY vs.type";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data["total"] = array("typename" => $query->row()->typename, "typeid" => $query->row()->typeid, "count" => $query->row()->count);
        }
        $sql = null; $query = null;
        $sql = "SELECT COALESCE(count(vs.id),0) as 'count', vst.name as 'typename', vst.id as 'typeid' 
            FROM vendorstats vs 
            LEFT JOIN vendorstats_type vst ON vs.type = vst.id 
            WHERE vs.rid = ".$this->db->escape((int)$rid)."
            AND vs.date >= DATE_ADD(CURDATE(), INTERVAL -30 DAY) 
            GROUP BY vs.type";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data["30"] = array("typename" => $query->row()->typename, "typeid" => $query->row()->typeid, "count" => $query->row()->count);
        }
        $sql = null; $query = null;
        $sql = "SELECT COALESCE(count(vs.id),0) as 'count', vst.name as 'typename', vst.id as 'typeid' 
            FROM vendorstats vs 
            LEFT JOIN vendorstats_type vst ON vs.type = vst.id 
            WHERE vs.rid = ".$this->db->escape((int)$rid)."
            AND vs.date >= DATE_ADD(CURDATE(), INTERVAL -365 DAY) 
            GROUP BY vs.type";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data["1y"] = array("typename" => $query->row()->typename, "typeid" => $query->row()->typeid, "count" => $query->row()->count);
        }
        $sql = null; $query = null;
        
    }


    public function getBizInformation($rid=0) {
            if ($rid == 0) { return FALSE; }
            $sql = "SELECT * FROM leads WHERE rid = ".$this->db->escape((int)$rid);
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
    }

    public function editBizInformation() {
        // needs work
    }

    public function addPhotos() {
        // needs work
    }

    public function deletePhotos() {
        // needs work
    }

    public function editMenuItems($rid=0, $data, $action=0) {
        if ($rid == 0) { return FALSE; }
        if ($action == 0) { return FALSE; }
        if ($action == "edit") { 
            if (!isset($data["id"]) || empty($data["id"])) { return FALSE; }
            if ($data["type"] == "group") {
                if (!isset($data["name"]) || empty($data["name"]) || !isset($data["id"]) || empty($data["id"])) { return FALSE; }
                $sql = "UPDATE vendor_menu_groups SET name = ".$this->db->escape(strip_tags($data["name"]))." WHERE id = ".$this->db->escape((int)$data["id"])." AND ".$this->db->escape((int)$rid);
                $this->db->query($sql);
                return TRUE;
            } elseif ($data["type"] == "item") {
                if (!isset($data["name"]) || empty($data["name"]) || !isset($data["id"]) || empty($data["id"])) { return FALSE; }
                if (isset($data["description"]) || !empty($data["description"])) { $description = $data["description"]; } else { $description = ""; }
                if (isset($data["cost"]) || !empty($data["cost"])) { (float)$cost = $data["cost"]; } else { (float)$cost = 0.00; }
                // needs work for image upload
                $image = "";
                $sql = "UPDATE vendor_menu_items SET name = ".$this->db->escape(strip_tags($data["name"])).", description = ".$this->db->escape(strip_tags($description)).", cost = ".$this->db->escape((float)$cost).", image = ".$this->db->escape($image)." WHERE id = ".$this->db->escape((int)$data["id"])." AND rid = ".$this->db->escape((int)$rid);
                $this->db->query($sql);
                return TRUE;

            }
        }
        ///
        if ($action == "delete") {
            if ($data["type"] == "group") {
                $sql = "DELETE FROM vendor_menu_groups WHERE id = ".$this->db->escape((int)$data["id"])." AND rid = ".$this->db->escape((int)$rid);
                $this->db->query($sql);
            } elseif ($data["type"] == "item") {
                $sql = "DELETE FROM vendor_menu_items WHERE id = ".$this->db->escape((int)$data["id"])." AND rid = ".$this->db->escape((int)$rid);
                $this->db->query($sql);
                return TRUE;
            }
        }
        ///
        if ($action == "add") {
            if ($data["type"] == "group") {
                $sql = "INSERT INTO vendor_menu_groups (rid, name) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape(strip_tags($data["name"])).")";
                $this->db->query($sql);
                return TRUE;
            } elseif ($data["type"] == "item") {
                $image = ""; // needs work
                $sql = "INSERT INTO vendor_menu_items (rid, groupid, name, description, cost, image) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$data["groupid"]).", ".$this->db->escape(strip_tags($data["name"])).", ".$this->db->escape(strip_tags($data["description"])).", ".$this->db->escape((float)$data["cost"]).", ".$image.")";
                $this->db->query($sql);
                return TRUE;
            }
        }
    }

    public function listMenuItems($rid=0) {
        $buildarray = [];
        $sql = "SELECT * FROM vendor_menu_groups WHERE rid = ".$this->db->escape((int)$rid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $sql2 = "SELECT * FROM vendor_menu_items WHERE rid = ".$this->db->escape((int)$rid)." AND groupid = ".$this->db->escape($query->row()->id);
            $query2 = $this->db->query($sql2);
            if ($query2->num_rows() > 0) {
                $buildarray[] = array("id"=>$query->row()->id, "name"=>$query->row()->name,"items"=>$query2->result_array());
            } else {
                $buildarray[] = array("id"=>$query->row()->id, "name"=>$query->row()->name, "items"=>array());
            }
        } else {
            return $buildarray;
        }
        return $buildarray;
    }

    public function getVendorUsers() {
        if ($rid == 0) { return array(); }
        $sql = "SELECT vu.*, vup.rid FROM vendorusers vu
         LEFT JOIN vendor_userpermissions vup ON vu.id = vup.uid  
         WHERE vu.id = ".$this->db->escape((int)$this->session->userdata("uid"));
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function editVendorUser($rid=0,$data, $action=0) {
        if ($rid == 0) {return FALSE; }
        if ($action == 0) { return FALSE; }
        if ($action == "add") {
            $mobilecode = $this->randomString(8);
            $verification = $this->randomString();
            $sessiontoken = $this->randomString();
            $ip = $this->getIP();
            $problem = 0;
            if ($data["password"] != $data["password2"]) { $problem = 1; }
            if (empty($data["password"]) || empty($data["password2"])) { $problem = 2; }
            if (!isset($data["email"]) || empty($data["email"])) { $problem = 3; }
            if (!isset($data["fullname"]) || empty($data["fullname"])) { $problem = 4; }
            if ($problem == 0) {
                // check if email exists
                $sql = "SELECT * FROM vendorusers WHERE email = ".$this->db->escape(strip_tags($data["email"]));
                $query = $this->db->query($sql);
                if ($query->num_rows() == 0) {
                    $sql2 = "INSERT INTO vendorusers (`sessiontoken`, `verification key`, email, password, level, active, created, ip, fullname) VALUES (".$this->db->escape($sessiontoken).",".$this->db->escape($verification).",".$this->db->escape(strip_tags($data["email"])).",".$this->db->escape(strip_tags(md5($data["password"]))).",".'notactive'.",1,NOW(),".$this->db->escape($ip).",".$this->db->escape(strip_tags($data["fullname"])).")";
                    $this->db->query($sql2);
                } else {
                    $problem = 5;
                }
            }
            if ($problem > 0) {
                return $problem;
            } else {
                return TRUE;
            }
        }
        // 
        if ($action == "delete") {
            $uid = $this->session->userdata("uid");
            if ($data["id"] == $uid) { return FALSE; }
            $sql = "DELETE FROM vendorusers WHERE id = ".$this->db->escape((int)$data["id"])." AND rid = ".$this->db->escape((int)$rid);
            $this->db->query($sql);
        }
        //
        if ($action == "edit") {
            /*
            Problem Codes:
            1 - passwords do not match
            3 - email empty
            4 - name of user is empty
            5 - internal error (no user id)
            6 - email already exists 
            7 - passwords dont match
            8 - no phone number
            9 - active account not specified.
            */
            $problem = 0;
            if (!isset($data["email"]) || empty($data["email"])) { $problem = 3; }
            if (!isset($data["fullname"]) || empty($data["fullname"])) { $problem = 4; }
            if (!isset($data["id"]) || empty($data["id"])) { $problem = 5; }
            if (!isset($data["phone"]) || empty($data["phone"])) { $problem = 8; }
            if (!isset($data["active"]) || empty($data["active"])) { $problem = 9; }
            if ($problem == 0) {
                $sql = "SELECT email FROM vendorusers WHERE id = ".$this->db->escape((int)$data["id"]);
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    $email = $query->row()->email;
                    if ($email == $data["email"]) {

                    } else {
                        $sql2 = "SELECT id FROM vendorusers WHERE email = ".$this->db->escape(strip_tags($data["email"]));
                        $query2 = $this->db->query($sql2);
                        if ($query2->num_rows() > 0) {
                            return 6;
                        } else {
                            $email = $data["email"];
                        }
                    }
                    if (isset($data["password"]) && isset($data["password2"]) && !empty($data["password"]) && !empty($data["password2"])) {
                        if ($data["password"] == $data["password2"]) {
                            $sql3 = "UPDATE vendorusers SET password = ".$this->db->escape(strip_tags(md5($data["password"])))." WHERE id = ".$this->db->escape((int)$data["id"]);
                            $this->db->query($sql3);
                        } else {
                            return 7;
                        }
                    }
                    if ($problem == 0) {
                        $sql4 = "UPDATE vendorusers SET fullname = ".$this->db->escape(strip_tags($data["fullname"])).", email = ".$this->db->escape(strip_tags($email)).", phone = ".$this->db->escape(strip_tags($data["phone"])).", active = ".$this->db->escape((int)$data["active"])." WHERE id = ".$this->db->escape((int)$data["id"]);
                        $this->db->query($sql4);
                        return TRUE;
                    }
                    
                } else {
                    $problem = 5;
                }
            }
        }

    }

    public function getMarketingTools() {

    }

    public function addListing() {

    }

    public function getPremiumStatus($rid=0) {
        if ($rid == 0) {return array();}
        $sql = "SELECT COALESCE(v.premium, 0), COALESCE(vs.sponsoredads,0), COALESCE(vs.reviews,0), COALESCE(vs.ppc,0) FROM vendors v 
        LEFT JOIN vendorprivileges vs ON v.rid = vs.rid
        WHERE v.rid = ".$this->db->escape((int)$rid);
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getBizReviews($rid=0) {
        if ($rid == 0) {return array(); }
        $sql = "SELECT * FROM reviews WHERE rid = ".$this->db->escape((int)$rid)." AND active = '1' ORDER BY id DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function respondToReview($rid=0,$reviewid=0, $response) {
        if ($rid == 0 || $reviewid == 0) { return FALSE; }
        $sql = "SELECT id FROM review_responses WHERE rid = ".$this->db->escape((int)$rid)." AND reviewid = ".$this->db->escape((int)$reviewid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $sql2 = "UPDATE review_responses SET response = ".$this->db->escape(strip_tags($response))." WHERE rid = ".$this->db->escape((int)$rid)." AND reviewid = ".$this->db->escape((int)$reviewid);
            $this->db->query($sql2);
            $sql3 = "INSERT INTO review_history (rid, reviewid, action, details, created, vendoruid) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$reviewid).", 'Response Updated', ".$this->db->escape($response).", NOW(), ".$this->db->escape((int)$this->session->userdata("uid"));
            $this->db->query($sql3);
            return TRUE;
        } else {
            $sql2 = "INSERT INTO review_responses (rid, reviewid, response, created) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$reviewid).", ".$this->db->escape(strip_tags($response)).", NOW())";
            $this->db->query($sql2);
            $sql3 = "INSERT INTO review_history (rid, reviewid, action, details, created, vendoruid) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$reviewid).", 'Responded', ".$this->db->escape($response).", NOW(), ".$this->db->escape((int)$this->session->userdata("uid"));
            $this->db->query($sql3);
            return TRUE;
        }

    }

    public function deleteReview($rid=0, $reviewid=0) {
        if ($rid == 0 || $reviewid == 0) { return FALSE; }
        // check if the user level is normal, notactivated, or not a user
        $sql = "SELECT r.uid, u.level FROM reviews r 
        LEFT JOIN users u ON r.uid = u.id
        WHERE r.rid = ".$this->db->escape((int)$rid)." AND r.id = ".$this->db->escape((int)$reviewid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            if ($query->row()->level == "normal") {
                return FALSE;
            } else {
                $sql2 = "SELECT id FROM review_history WHERE action = 'Deleted Review' AND rid = ".$this->db->escape((int)$rid)." AND notactivateduser = '1' AND created >= DATE_ADD(CURDATE(), INTERVAL -30 DAY)";
                $query2 = $this->db->query($sql2);
                if ($query2->num_rows() > 0) {
                    return FALSE;
                } else {
                    $sql3 = "INSERT INTO review_history (rid, reviewid, action, created, vendoruid, notactivateduser) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$reviewid).", 'Deleted Review', NOW(), ".$this->db->escape((int)$this->session->userdata("uid")).", '1')";
                    $this->db->query($sql3);
                    return TRUE;
                }
            }
        } else {
            $sql2 = "UPDATE reviews SET active = '0' WHERE rid = ".$this->db->escape((int)$rid)." AND uid = ".$this->db->escape((int)$reviewid);
            $this->db->query($sql2);
            $sql3 = "INSERT INTO review_history (rid, reviewid, action, created, vendoruid) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$reviewid).", 'Deleted Review', NOW(), ".$this->db->escape((int)$this->session->userdata("uid")).")";
            $this->db->query($sql3);
            return TRUE;
        }

    }

    public function requestReviewDelete($rid=0, $data) {
        if ($rid == 0) { return FALSE; }
        // check if the user level is normal, notactivated, or not a user
        $sql2 = "INSERT INTO requests (rid, uid, type, data, created) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$this->session->userdata("uid")).", '1', ".$this->db->escape(strip_tags($data)).", NOW())";
        $this->db->query($sql2);
        return TRUE;
    }

    public function getAllPromos($rid=0) {
        if ($rid == 0) { return array(); }
        $sql = "SELECT * FROM coupons WHERE rid = ".$this->db->escape((int)$rid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function editPromo($rid=0, $data, $action=0) {
        if ($rid == 0 || $action == 0) { return FALSE; }
        if ($action == "add") {
            $sql = "INSERT INTO coupons (rid, starting, ending, discount, subject, body, created) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape(strip_tags($data["starting"])).", ".$this->db->escape(strip_tags($data["ending"])).", ".$this->db->escape(strip_tags($data["discount"])).", ".$this->db->escape(strip_tags($data["subject"])).", ".$this->db->escape(strip_tags($data["body"])).", NOW())";
            $this->db->query($sql);
            return TRUE;
        }
        if ($action == "delete") {
            $sql = "DELETE FROM coupons WHERE id = ".$this->db->escape((int)$data["id"])." AND rid = ".$this->db->escape((int)$rid);
            $this->db->query($sql);
            return TRUE;
        }
        if ($action == "edit") {

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

    public function getMyBusinesses() {
        $sql = "SELECT l.*, COALESCE(vu.premium, 0) as 'premium' FROM vendor_userpermissions vup  
        LEFT JOIN vendors vu ON vup.rid = vu.rid 
        LEFT JOIN leads l ON vu.rid = l.id 
        WHERE vup.uid = ".$this->db->escape((int)$this->session->userdata("uid"));
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