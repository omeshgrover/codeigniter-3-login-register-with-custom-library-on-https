<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    protected $table_name = '';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('inflector');

        if (!$this->table_name) {
            $this->table_name = strtolower(singular(get_class($this)));
        }
    }

    /**
     * Get single record
     */
    public function get($id) {
        return $this->db->get_where($this->table_name, array($this->primary_key => $id))->row();
    }

    /**
     * Get multiple record(s)
     */
    public function get_n_entries($nums) {
        return $this->db->get($this->table_name, $nums)->result();
    }

    /**
     * Get selected record(s).
     */
    public function get_all($fields='', $where=array(), $table='', $join=array(), $limit='', $order_by='', $order_type='ASC', $group_by='') {
        $data = array();
        
        if ($fields != '') {
            $this->db->select($fields);
        }

        if (count($where)) {
            $this->db->where($where);
        }

        if ($table != '') {
            $this->table_name = $table;
        }

        if(count($join)) {
            foreach($join as $key => $val) {
                $this->db->join($key, "{$key}.id = {$val}.{$key}_id");
            }
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }

        if ($order_by != '') {
            $this->db->order_by($order_by,$order_type);
        }

        if ($group_by != '') {
            $this->db->group_by($group_by);
        }

        $Q = $this->db->get($this->table_name);
        
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();

        return $data;
    }

    /**
     * Insert new record
     */
    public function insert($data) {
        $data['date_created'] = $data['date_updated'] = date('Y-m-d H:i:s');

        // Skip fo table(s)
        if($this->table_name != 'user') {
            $data['created_by_host'] = $data['updated_by_host'] = $this->input->ip_address();
        }

        $success = $this->db->insert($this->table_name, $data);
        if ($success) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    /**
     * Update record
     */
    public function update($data, $id) {
        $data['date_updated'] = date('Y-m-d H:i:s');
        // Skip fo table(s)
        if($this->table_name != 'user') {
            $data['updated_by_host'] = $this->input->ip_address();
        }

        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table_name, $data);
    }

    /**
     * Delete record
     */
    public function delete($id) {
        $this->db->where($this->primary_key, $id);

        return $this->db->delete($this->table_name);
    }
}