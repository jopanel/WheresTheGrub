<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Search_model', '', TRUE);
    }

	public function index()
	{
		$this->load->view('search/map_view');
	}

	protected function loadmap() {

		if ($this->input->get()) {
			$data = $this->input->get();
		}

	}


}
