<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model {
    
    function get_banks_names(){
        $this->db->distinct();
        $this->db->select('BANK');
        $query = $this->db->get('banks');
        return $query->result_array();
        
    }
    
  
}
