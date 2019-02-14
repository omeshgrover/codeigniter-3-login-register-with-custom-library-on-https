<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $data;
	protected $controller;

	public function __construct() {
		parent::__construct();

		$this->controller = strtolower($this->router->fetch_class());
		// Library
        //$this->load->library(array());
        // Model
		$this->load->model(array('users','persons'));
		// Common data variables
		$this->data = array('current_url'=>base_url(uri_string()),'controller'=>$this->controller);
    }
}