<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    function insert_voucher($postData1, $crData) {

        $this->db->trans_start();
        $this->db->insert('voucher_details', $postData1);

        $id = $this->db->insert_id();
        $crData['voucher_id'] = $id;
        $this->db->insert('voucher_receipt_entry', $crData);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }
    
    function getVocuherDetails($post){
        $this->_getVocuherDetails($post);
        if ($post['length'] != -1) {
            $this->db->limit($post['length'], $post['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }
    
    function _getVocuherDetails($post) {
        $this->db->select($post['select'], FALSE);
        $this->db->from('voucher_details');
        $this->db->join('voucher_receipt_entry', 'voucher_receipt_entry.voucher_id = voucher_details.id');
        $this->db->join('branch_details as dr_branch', 'dr_branch.branch_id = branch_id');
        $this->db->join('account_type as cr', 'cr.id = cr_account_id');
        $this->db->join('account_type as dr', 'dr.id = dr_account_id');

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
        $this->db->group_by('voucher_details.id');
        if (!empty($post['order'])) { // here order processing
            $this->db->order_by($post['column_order'][$post['order'][0]['column']], $post['order'][0]['dir']);
        } else if (isset($this->order)) {
//            $order = $this->order;
//            $this->db->order_by(key($order), $order[key($order)]);
            $this->db->order_by('voucher_details.id', 'DESC');
        }
        
        
    }

    public function count_voucher_list($post) {
        $this->db->select($post['select'], FALSE);
        $this->db->from('voucher_details');
        $this->db->join('voucher_receipt_entry', 'voucher_receipt_entry.voucher_id = voucher_details.id');
        $this->db->join('branch_details as dr_branch', 'dr_branch.branch_id = branch_id');
        $this->db->join('account_type as cr', 'cr.id = cr_account_id');
        $this->db->join('account_type as dr', 'dr.id = dr_account_id');
        if (isset($post['where'])) {
            $this->db->where($post['where']);
        }
        $this->db->group_by('voucher_details.id');
        $query = $this->db->count_all_results();

        return $query;
    }

    function count_voucher_list_filtered($post) {
        $this->_getVocuherDetails($post);

        $query = $this->db->get();
        return $query->num_rows();
    }

}
