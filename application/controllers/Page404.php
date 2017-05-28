<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class page404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->library('session');
        date_default_timezone_set('America/Los_Angeles');
    } 

    public function index() 
    { 
        $this->output->set_status_header('404'); 
        $this->load->view('landingheader');
        $this->load->view('404');
        $this->load->view('landingfooter');
    } 
}
