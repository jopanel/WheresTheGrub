<?php

class General_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

    }

    public function Register($post=0) {
    	if (!empty($post)) {
    		//["fullname"]=> string(4) "asdf" ["email"]=> string(13) "asdf@asdf.com" ["password"]=> string(4) "asdf" ["password2"]=> string(4) "asdf" ["optin"]=> string(2) "on"
    		
    	}
    }

}