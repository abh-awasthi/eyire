<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model {

    function get_matser($table, $select, $where = array(), $order_by = array()) {
        $this->db->select($select, false);
        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function insert_row($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update_row($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    function get_userDetails($select, $where = array(), $order_by = array()) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from('users');
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        if (!empty($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_matser_interest_plan($select, $where = array(), $order_by = array()) {

        $this->db->distinct();
        $this->db->select($select);
        $this->db->from('interest_types');
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->join('plan_duration_interest', 'plan_duration_interest.interest_type = interest_types.id');
        if (!empty($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function getBranchList($post) {
        $this->_getBranchList($post);
        if ($post['length'] != -1) {
            $this->db->limit($post['length'], $post['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function _getBranchList($post) {
        $this->db->from('branch_details');
        $this->db->select($post['select'], FALSE);

        $this->db->join('users', 'users.id = contact_person');

        if (!empty($post['where'])) {
            $this->db->where($post['where'], FALSE);
        }
        if (isset($post['where_in'])) {
            foreach ($post['where_in'] as $index => $value) {

                $this->db->where_in($index, $value);
            }
        }

        if (!empty($post['search']['value'])) {
            $like = "";
            if (array_key_exists("column_search", $post)) {
                foreach ($post['column_search'] as $key => $item) { // loop column 
                    // if datatable send POST for search
                    if ($key === 0) { // first loop
                        $like .= "( " . $item . " LIKE '%" . $post['search']['value'] . "%' ";
                    } else {
                        $like .= " OR " . $item . " LIKE '%" . $post['search']['value'] . "%' ";
                    }
                }
                $like .= ") ";
            }

            $this->db->where($like, null, false);
        }

        if (!empty($post['order'])) { // here order processing
            $this->db->order_by($post['column_order'][$post['order'][0]['column']], $post['order'][0]['dir']);
        } else if (isset($this->order)) {
//            $order = $this->order;
//            $this->db->order_by(key($order), $order[key($order)]);
            $this->db->order_by('branch_details.id', 'ASC');
        }
    }

    public function count_branch_list($post) {
        $this->db->select($post['select'], FALSE);
        $this->db->from('branch_details');
        $this->db->join('users', 'users.id = contact_person');
        if (isset($post['where'])) {
            $this->db->where($post['where']);
        }

        $query = $this->db->count_all_results();

        return $query;
    }

    function count_branch_list_filtered($post) {
        $this->_getBranchList($post);

        $query = $this->db->get();
        return $query->num_rows();
    }

}
