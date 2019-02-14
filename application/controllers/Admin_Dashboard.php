<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends MY_Controller {   

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
        
        // Redirect when admin not logged-in
		if(!$this->session->has_userdata('admin_logged_in')) {
			redirect($this->data['home_url']);
		}
	}

    /**
	 * Dashboard
	 */
	public function index() {
		$data = $this->data;		
		$this->layout->show($this->controller, 'index', $data, true, true);
	}

	/**
	 * Create new user account view
	 */
	public function create_new_user() {
		$data = $this->data;
		//$data[] = '';
		$this->layout->show($this->controller, 'create_new_user', $data, true, true);
	}

	/**
	 * Create new user account
	 */
	public function create() {
		$this->form_validation->set_error_delimiters('', '<br/>');	
		$this->form_validation->set_rules('username','Username','required|is_unique[user.username]');
		$this->form_validation->set_rules('email','Email Address','required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password', 'required');
		$this->form_validation->set_rules('cpassword','Confirm Password', 'required');
		$this->form_validation->set_rules('first_name','First Name', 'required');
		$this->form_validation->set_rules('last_name','Last Name', 'required');
		$this->form_validation->set_rules('mobile','Mobile', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode(array('error'=>true,'type'=>'register','message'=>validation_errors()));
		} else {
			$insert = false;

			$data_person['first_name']=$this->input->post('first_name');
			$data_person['last_name']=$this->input->post('last_name');
			$data_person['mobile']=$this->input->post('mobile');
			$data_person['store_num']=$this->input->post('store_num');

			$data_user['username'] = $this->input->post('username');
			$data_user['email'] = $this->input->post('email');
			$data_user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			
			if($person_id = $this->persons->insert($data_person)) {
				$data_user['person_id'] = $person_id;
				if($this->users->insert($data_user)) {					
					$insert = true;
					echo json_encode(array('error'=>false,'type'=>'create','message'=>$this->data['home_url'].'dashboard/retail-data'));
				}
			}

			if(!$insert) {
				echo json_encode(array('error'=>true));
			}
		}

        /*if ($this->input->post('description')) {
            $data['description'] = $this->input->post('description');
            $this->brand->insert($data);

            redirect('/admin/brands', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "brands_create";
        $this->load->view($this->_container, $data);*/
	}

	/**
	 * Retail Data
	 */
	public function retail_data() {
		$data = $this->data;
		$records = $this->users->get_all('user.id as user_id, user.person_id as person_id, user.username as username, user.email as email, person.first_name as first_name, person.last_name as last_name, person.mobile as mobile, person.store_num as store_num, person.image as image, person.date_created as date_created',array('user.type !=' => 0),'',array('person'=>'user'),'','user.id','DESC');
		
		$data = array_merge($this->data, array('records'=>$records));
		$this->layout->show($this->controller, 'retail_data', $data, true, true);
	}
}