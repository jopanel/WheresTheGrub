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
            $sql = "SELECT * FROM leads WHERE id = ".$this->db->escape((int)$rid);
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

    public function getMenuGroups($rid=0) {
        if ($rid == 0) { return FALSE; }
        $rid = (int)$rid;
        $sql = "SELECT * FROM vendor_menu_groups WHERE rid = ".$this->db->escape(strip_tags($rid));
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function editMenuItems($rid=0, $data, $action=0) { 
        
        if ($action == "edit") { 
            echo 1;
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
                echo 3;
                $sql = "INSERT INTO vendor_menu_groups (rid, name) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape(strip_tags($data["name"])).")";
                $this->db->query($sql);
                return TRUE;
            } elseif ($data["type"] == "item") {
                $image = "''"; // needs work
                if (!isset($data["description"]) || empty($data["description"])) { $data["description"] = ""; }
                $sql = "INSERT INTO vendor_menu_items (rid, groupid, name, description, cost, image) VALUES (".$this->db->escape((int)$rid).", ".$this->db->escape((int)$data["groupid"]).", ".$this->db->escape(strip_tags($data["name"])).", ".$this->db->escape(strip_tags($data["description"])).", ".$this->db->escape((float)$data["cost"]).", ".$image.")";
                $this->db->query($sql);
                return TRUE;
            }
        }
    }

    public function listMenuItem($rid=0, $menuitemid=0) {
        $buildarray = [];

        $sql = "SELECT * FROM vendor_menu_groups WHERE rid = ".$this->db->escape((int)$rid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $q = $query->result_array();
            foreach ($q as $v) {
               $sql2 = "SELECT * FROM vendor_menu_items WHERE id = ".$this->db->escape(strip_tags((int)$menuitemid))." AND rid = ".$this->db->escape((int)$rid)." AND groupid = ".$this->db->escape($v["id"]);
                $query2 = $this->db->query($sql2);
                if ($query2->num_rows() > 0) {
                    $buildarray[] = array("id"=>$v["id"], "name"=>$v["name"],"items"=>$query2->result_array());
                } else {
                    $buildarray[] = array("id"=>$v["id"], "name"=>$v["name"], "items"=>array());
                } 
            }
        } else {
            return $buildarray;
        }
        return $buildarray;
    }

    public function listMenuItems($rid=0) {
        $buildarray = [];
        $sql = "SELECT * FROM vendor_menu_groups WHERE rid = ".$this->db->escape((int)$rid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $q = $query->result_array();
            foreach ($q as $v) {
               $sql2 = "SELECT * FROM vendor_menu_items WHERE rid = ".$this->db->escape((int)$rid)." AND groupid = ".$this->db->escape($v["id"]);
                $query2 = $this->db->query($sql2);
                if ($query2->num_rows() > 0) {
                    $buildarray[] = array("id"=>$v["id"], "name"=>$v["name"],"items"=>$query2->result_array());
                } else {
                    $buildarray[] = array("id"=>$v["id"], "name"=>$v["name"], "items"=>array());
                } 
            }
        } else {
            return $buildarray;
        }
        return $buildarray;
    }

    public function getVendorUsers() { 
        // get all rid that user is master of, then get all the user accounts that have that permission access, sort in array
        $buildarray = [];
        $sql = "SELECT GROUP_CONCAT(rid) as 'rid' FROM vendor_userpermissions WHERE uid = ".$this->db->escape((int)$this->session->userdata("uid"))." AND master = '1'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rids = $query->row()->rid;
            $sql2 = "SELECT vu.* FROM vendor_userpermissions vup 
            LEFT JOIN vendorusers vu ON vup.uid = vu.id 
            WHERE vup.rid IN (".$rids.") GROUP BY vup.uid";
            $query2 = $this->db->query($sql2);
            if ($query2->num_rows() > 0) {
                $buildarray = $query2->result_array();
            } else {
                return $buildarray;
            }
        } else {
            return $buildarray;
        }
        return $buildarray;
    }

    public function getRestaurantsByMaster($uid=false) {
        if ($uid == false) { $uid = $this->session->userdata("uid"); }
        $sql = "SELECT vup.rid as 'rid', l.name as 'name' FROM vendor_userpermissions vup
         LEFT JOIN leads l ON vup.rid = l.id 
         WHERE vup.uid = ".$this->db->escape((int)$uid)." AND vup.master = '1'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getVendorUser($uid=false) { 
        if ($uid == false) { $uid = $this->session->userdata("uid"); }
        $sql = "SELECT vu.*, GROUP_CONCAT(vup.rid) as 'rid' FROM vendorusers vu
         LEFT JOIN vendor_userpermissions vup ON vu.id = vup.uid  
         WHERE vu.id = ".$this->db->escape((int)$uid)." 
         GROUP BY vu.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getUserPermissions($uid=false) {
        if ($uid == false) {return array();}
        $sql = "SELECT rid, master FROM vendor_userpermissions WHERE uid = ".$this->db->escape((int)$uid);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function editVendorUser($uid=0,$data, $action=0) {  
        if ($action == 0) { return FALSE; } 
        if ($action == 1) {   
            $mobilecode = $this->randomString(8);
            $verification = $this->randomString();
            $sessiontoken = $this->randomString();
            $ip = $this->getIP();
            $problem = 0;
            if ($data["password"] != $data["password2"]) { $problem = 2; }
            if (empty($data["password"]) || empty($data["password2"])) { $problem = 3; }
            if (!isset($data["email"]) || empty($data["email"])) { $problem = 4; }
            if (!isset($data["fullname"]) || empty($data["fullname"])) { $problem = 5; }
            if (!isset($data["master"]) || empty($data["master"])) { $problem = 6;}
            if (!isset($data["phone"]) || empty($data["phone"])) { $phone = "";} else { $phone = $data["phone"]; }
            if ($problem == 0) { 
                $sql = "SELECT * FROM vendorusers WHERE email = ".$this->db->escape(strip_tags($data["email"]))." AND active = '1'";
                $query = $this->db->query($sql);
                if ($query->num_rows() == 0) {
                    $sql2 = "INSERT INTO vendorusers (`sessiontoken`, `verification_key`, email, password, level, active, created, ip, fullname, phone) VALUES (".$this->db->escape($sessiontoken).",".$this->db->escape($verification).",".$this->db->escape(strip_tags($data["email"])).",".$this->db->escape(strip_tags(md5($data["password"]))).",'notactive','1',NOW(),".$this->db->escape($ip).",".$this->db->escape(strip_tags($data["fullname"])).", ".$this->db->escape((int)$phone).")";
                    $this->db->query($sql2);
                    $sql3 = "SELECT id FROM vendorusers WHERE sessiontoken = ".$this->db->escape($sessiontoken)." AND email = ".$this->db->escape(strip_tags($data["email"]));
                    $query2 = $this->db->query($sql3);
                    $uid = $query2->row()->id;
                    foreach ($data["master"] as $v) {
                        $dat = explode("-",$v);
                        $rid = $dat[0];
                        $master = $dat[1];
                        $sql4 = "INSERT INTO vendor_userpermissions (uid,rid,master,created) VALUES (".$this->db->escape((int)$uid).",".$this->db->escape((int)$rid).",".$this->db->escape((int)$master).", NOW())";
                        $this->db->query($sql4);
                    }
                } else {
                    $problem = 7;
                }
            }
            if ($problem > 0) {
                return $problem;
            } else {
                return TRUE;
            }
        }
        // 
        if ($action == 2) { 
            // check if the users only restaurants assigned are of deletors master assign
            // if all restaurants are all users access then mark user inactive. if not leave be
            $uid = $this->session->userdata("uid");
            if ($data["id"] == $uid) { return FALSE; } 
            $arr = $this->getRestaurantsByMaster();
            $userarr = $this->getRestaurantsByMaster($data["id"]); 
            $totalleft = 0;
            foreach ($userarr as $v) {
                $counter = 0;
                foreach($arr as $vr) {
                    if ($v["rid"] == $vr["rid"]) {
                        $counter = 1;
                    }
                }
                if ($counter == 0) { $totalleft += 1; }
            }
            foreach ($arr as $v) {
                $sql = "DELETE FROM vendor_userpermissions WHERE uid = ".$this->db->escape((int)$data["id"])." AND rid = ".$this->db->escape((int)$v["rid"]);
                $this->db->query($sql);
            }
            if ($totalleft == 0) {
                $sql2 = "UPDATE vendorusers SET active = '0' WHERE id = ".$this->db->escape((int)$data["id"]);
                $this->db->query($sql2);
            }
            return TRUE;
        }
        //
        if ($action == 3) {  
            $problem = 0;
            if (!isset($data["email"]) || empty($data["email"])) { $problem = 3; }
            if (!isset($data["fullname"]) || empty($data["fullname"])) { $problem = 4; } 
            if (!isset($data["phone"]) || empty($data["phone"])) { $problem = 8; } 
            if ($problem == 0) {
                $sql = "SELECT email FROM vendorusers WHERE id = ".$this->db->escape((int)$uid);
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
                            $sql3 = "UPDATE vendorusers SET password = ".$this->db->escape(strip_tags(md5($data["password"])))." WHERE id = ".$this->db->escape((int)$uid);
                            $this->db->query($sql3);
                        } else {
                            return 7;
                        }
                    }
                    if ($problem == 0) {
                        $sql4 = "UPDATE vendorusers SET fullname = ".$this->db->escape(strip_tags($data["fullname"])).", email = ".$this->db->escape(strip_tags($email)).", phone = ".$this->db->escape(strip_tags($data["phone"]))." WHERE id = ".$this->db->escape((int)$uid);
                        $this->db->query($sql4);
                        foreach ($data["master"] as $v) {
                            $dat = explode("-",$v);
                            $rid = $dat[0];
                            $master = $dat[1];
                            $check = $this->getUserPermissions($this->session->userdata("uid")); 
                            $go = 0;
                            foreach ($check as $validate) { 
                                if ($validate["rid"] == $rid && $validate["master"] == 1) {
                                    $go = 1;
                                }
                            }
                            if ($go == 1) {
                                if ($master == 00) {
                                    $sql5 = "DELETE FROM vendor_userpermissions WHERE uid = ".$this->db->escape((int)$uid)." AND rid = ".$this->db->escape((int)$rid);
                                    $this->db->query($sql5);
                                } else {
                                    $sql5 = "UPDATE vendor_userpermissions SET master = ".$this->db->escape((int)$master)." WHERE uid = ".$this->db->escape((int)$uid)." AND rid = ".$this->db->escape((int)$rid);
                                    $this->db->query($sql5);
                                } 
                            }
                        }
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
        LEFT JOIN leads l ON vup.rid = l.id 
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

    public function verifyUser($rid=false) {
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
        if ($rid != FALSE) {
            $userinfo = $this->getVendorUser();
            if (!isset($userinfo[0])) { $destroy = 1; } else {
                $ridcheck = explode(",", $userinfo[0]["rid"]);
                $advance = 0;
                foreach ($ridcheck as $v) {
                    if ($v == $rid) { $advance = 1;}
                }
                if ($advance == 0) { $destroy = 1; }
            }
        }
        if ($destroy == 1) {
            $this->session->unset_userdata('vendortoken');
            $this->session->unset_userdata('vendoremail');
            $this->session->unset_userdata('vendorloggedin');
            $this->session->unset_userdata('uid');
            $this->session->unset_userdata('fullname');
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