<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {   

	public function __construct() {
        parent::__construct();       

		// Custom library
		$this->load->library('layout',array('type'=>'frontend'));		
		// Common data variables
		$this->data = array_merge(
						array(
							'home_url'=>base_url()
						),
						$this->data
					);
        
        // Redirect when user not logged-in
		if(!$this->session->has_userdata('logged_in')) {
			redirect($this->data['home_url']);
		}
	}

    /**
	 * Dashboard
	 */
	public function index() {
		$data = $this->data;		
		$this->layout->show('dashboard', 'index', $data, true, true);
	}
}