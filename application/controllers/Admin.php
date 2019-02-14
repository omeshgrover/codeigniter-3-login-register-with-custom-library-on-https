<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {   

	public function __construct() {
        parent::__construct();       

		// Custom library
        $this->load->library('layout',array('type'=>'backend'));
        // Common data variables
		$this->data = array_merge(
						array(
							'home_url'=>base_url().'admin/'
						),
						$this->data
					);
	}

    /**
	 * Dashboard
	 */
	public function index() {
        // Redirect when already logged-in
		if($this->session->has_userdata('admin_logged_in')) {
			redirect($this->data['home_url'].'dashboard');
        }
        
		$data = $this->data;		
		$this->layout->show($this->controller, 'index', $data, true, true);
    }

     /**
	 * Dashboard
	 */
	public function forgot_password() {
        // Redirect when already logged-in
		if($this->session->has_userdata('admin_logged_in')) {
			redirect($this->data['home_url'].'dashboard');
        }

		$data = $this->data;		
		$this->layout->show($this->controller, 'forgot_password', $data, true, true);
    }
    
    /**
	 * Admin login
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
			} elseif($data_user['type'] != 0) {
                echo json_encode(array('error'=>true,'type'=>'login','message'=>'Users are not allowed to login in Admin! <a href="'.base_url().'">Click here</a> to login.'));
            } else {
				$session_data = array(
					'admin_logged_in' => true,
					'admin_username' => $data_user['username'],
					'admin_email' => $data_user['email']
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
		$session_data = array('admin_logged_in','admin_username','admin_email');
		$this->session->unset_userdata($session_data);

		redirect($this->data['home_url']);
	}
}