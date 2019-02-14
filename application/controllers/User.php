<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {	

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
	}

	/**
	 * Login
	 */
	public function index() {
		// Redirect when already logged-in
		if($this->session->has_userdata('logged_in')) {
			redirect($this->data['home_url'].'dashboard');
		}

		$data = $this->data;
		//$data['new_acc'] = $this->input->get('new_acc',true);
		$this->layout->show($this->controller, 'index', $data, true, true);
	}

	/**
	 * Register
	 */
	public function forgot_password() {
		// Redirect when already logged-in
		if($this->session->has_userdata('logged_in')) {
			redirect($this->data['home_url'].'dashboard');
		}

		$data = $this->data;
		//$data[] = '';
		$this->layout->show($this->controller, 'forgot_password', $data, true, true);
	}
	
	/**
	 * User login
	 */
	public function login() {
		$this->form_validation->set_error_delimiters('', '<br/>');		
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode(array('error'=>true,'type'=>'login','message'=>validation_errors()));
		} else {
			$username = $this->input->post('username');    
			$password = $this->input->post('password');

			$data_user = $this->users->login($username,$password);
			if(!$data_user) {
				echo json_encode(array('error'=>true,'type'=>'login','message'=>'Either username or password not correct!'));
			}  elseif($data_user['type'] != 1) {
                echo json_encode(array('error'=>true,'type'=>'login','message'=>'As a Admin, <a href="'.$this->data['home_url'].'admin/">Click here</a> to login.'));
            } else {
				$session_data = array(
					'logged_in' => true,
					'username' => $data_user['username'],
					'email' => $data_user['email']
				);
				// Add user data in session
				$this->session->set_userdata($session_data);
				echo json_encode(array('error'=>false,'type'=>'login','message'=>$this->data['home_url'].'dashboard'));
			}
		}
	}

	/**
	 * Logout
	 */
	public function logout() {
		// Removing session data
		$session_data = array('logged_in','username','email');
		$this->session->unset_userdata($session_data);

		redirect($this->data['home_url']);
	}
}
