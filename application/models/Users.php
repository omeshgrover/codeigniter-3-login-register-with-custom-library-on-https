<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Users extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    // Validate login credentials
    public function login($username, $password) {
        // fetch by username first
        $this->db->where('username', $username);
        $this->db->or_where('email', $username);
		$query = $this->db->get($this->table_name);
        $result = $query->row_array(); // get the row first
		
		if (!empty($result) && password_verify($password, $result['password'])) {
			// if this username exists, and the input password is verified using password_verify
			return $result;
		} else {
			return false;
		}
    }
}