<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_model extends CI_Model {
    
    function get_matser($table, $select, $where = array()){
        $this->db->select($select);
        if(!empty($where)){
            $this->db->where($where);
        }
        
        $query = $this->db->get($table);
        return $query->result_array();
        
    }
	
	
	function get_master_mebers_users($select){
		$this->db->select($select);
		$this->db->join('users','members.member_user_id=users.id');
        $query = $this->db->get('members');
        return $query->result();
		
	}
	
    
    function insert_row($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
}
