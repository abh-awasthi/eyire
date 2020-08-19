<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin

 */
class Master extends CI_Controller {

    public $data = [];

    public function __construct() {
        parent::__construct();
        $this->load->model('master_model');
        $this->load->library('ion_auth');
        $this->load->helper(array('form','url', 'array'));
        $this->load->library('form_validation');
        

     
    }
    
    function addDistrict(){
        $states = $this->master_model->get_matser('states', '*', array('country_id' => 105), array('name', 'asc'));
        $this->load->view('include/header', array('title' => "District Master"));
        $this->load->view('master/addDistrict', array('states' => $states));
        $this->load->view('include/footer');
    }
    
    function checkDistrictValidation() {
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('district', 'District', 'callback_checkUniqueDistrict');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return true;
        }
    }
    
    function checkUniqueDistrict(){ 
        $state_id = $this->input->post("state");
        $district = $this->input->post("district");
        
        if(empty($district)){
            $this->form_validation->set_message('checkUniqueDistrict', 'The District Field is required');
            return false;  
        }
        
        if(!empty($district)){
            $district = $this->master_model->get_matser('district', '*', array('district' => ucwords($district), 'state_id' => $state_id));
            if(!empty($district)){
                $this->form_validation->set_message('checkUniqueDistrict', 'This District already exist');
                return false;  
            }
        }
        
        return true;
    }
    
    function processAddDistrict(){
         $checkValidation = $this->checkDistrictValidation();
       
        if($checkValidation){
            $this->master_model->insert_row('district', array('district' => ucwords($this->input->post('district')), 'state_id' =>$this->input->post("state") ));
            echo json_encode(array('status' => true, 'message' => "New District Added Successfully"));
        } else {
            echo json_encode(array('status' => false, 'message' => validation_errors()));
        }
    }
    
    function addBranchEntry(){
        $district = $this->master_model->get_matser('district', '*', array(),  array('district', 'asc'));
        $agent = $this->master_model->get_userDetails('users.id, users.first_name, users.last_name', array('group_id' => BRANCH_HANDLER_GROUP),  array('users.first_name', 'asc'));
        $this->load->view('include/header', array('title' => "Branch Entry"));
        $this->load->view('master/addBranch', array('district' => $district, 'agent' => $agent));
        $this->load->view('include/footer');
    }
    
    function processAddBranch(){
        
        $this->form_validation->set_rules('district', 'District', 'trim|required');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'callback_checkUniqueBranch');
        $this->form_validation->set_rules('contact_person', 'Contact Person', 'trim|required');
        $this->form_validation->set_rules('credit_limit_amount', 'Credit Card Limit Amount', 'trim|required');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
             echo json_encode(array('status' => false, 'message' => validation_errors()));
        } else {
            $post = $this->input->post();
            $this->master_model->insert_row('branch_details', array('district' => $post['district'], 'name' => ucwords(trim($post["branch_name"])),
                'address' => ucwords(trim($post['branch_address'])), 'contact_person' => $post['contact_person'],
                'credit_limit_amount' => $post['credit_limit_amount']));
            echo json_encode(array('status' => true, 'message' => "New Branch Added Successfully"));
        }
        
    }
    
    function updateBranchEntry($branchID){
        log_message('info', print_r($_POST, true));
        $this->form_validation->set_rules('district', 'District', 'trim|required');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'callback_checkUniqueBranch');
        $this->form_validation->set_rules('contact_person', 'Contact Person', 'trim|required');
        $this->form_validation->set_rules('credit_limit_amount', 'Credit Card Limit Amount', 'trim|required');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
             echo json_encode(array('status' => false, 'message' => validation_errors()));
        } else {
            $post = $this->input->post();
            $this->master_model->update_row('branch_details', array('district' => $post['district'], 'name' => ucwords(trim($post["branch_name"])),
                'address' => ucwords(trim($post['branch_address'])), 'contact_person' => $post['contact_person'],
                'credit_limit_amount' => $post['credit_limit_amount']), array('branch_id' => $branchID));
            echo json_encode(array('status' => true, 'message' => "Branch Updated Successfully"));
        }
    }
    
    function processUpdateBranch($branchID){
        if(!empty($branchID)){
            $branchDeatils = $this->master_model->get_matser('branch_details', '*', array('branch_id' => $branchID));
            if(!empty($branchDeatils)){
                $district = $this->master_model->get_matser('district', '*', array(),  array('district', 'asc'));
                $agent = $this->master_model->get_userDetails('users.id, users.first_name, users.last_name', array('group_id' => BRANCH_HANDLER_GROUP),  array('users.first_name', 'asc'));

                $this->load->view('include/header', array('title' => "Update Branch"));
                $this->load->view('master/updateBranchMaster', array('district' => $district, 'agent' => $agent, 'branch_id' => $branchID, 'branch_details' => $branchDeatils));
                $this->load->view('include/footer');
            } else {
                $this->addBranchEntry();
            }
        }  
    }
    
    function checkUniqueBranch(){
        $branch = $this->input->post('branch_name');
        $where['name'] = ucwords($branch);
        $branchID = $this->input->post('branch_id');
        if(!empty($branchID)){
            $where['branch_id != '.$branchID] = NULL; 
        }
        if(!empty($branch)){
            $is_exit = $this->master_model->get_matser('branch_details', '*', $where);
            log_message('info', $this->db->last_query());
            if(!empty($is_exit)){
                $this->form_validation->set_message('checkUniqueBranch', 'This Branch already exist');
                return false;  
            }
        }
        
        return true;
    }
    
    function getCurrentBranchList(){
       // log_message('info', __METHOD__. " ". json_encode($_POST, true));
       $post = $this->_getDatatableData();
       $post['select'] = "branch_details.*, users.first_name, users.last_name, users.phone, users.email";
       $post['column_order'] = array('branch_details.branch_id', 'branch_details.name', 'branch_details.address', 'users.first_name', 'users.phone', 'users.email', 'branch_details.credit_limit_amount');
       $post['column_search'] = array('branch_details.branch_id', 'branch_details.name', 'branch_details.address', 'users.first_name', 'users.phone', 'users.email', 'branch_details.credit_limit_amount');
       
       $list = $this->master_model->getBranchList($post);
      // $no = $post['start'];
       $data = array();
       foreach ($list as $branch_list) {
 
            $row = $this->branch_list_table_data($branch_list);
            $data[] = $row;
        }


        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->master_model->count_branch_list($post),
            "recordsFiltered" => $this->master_model->count_branch_list_filtered($post),
            "data" => $data,
            
        );
        
        echo json_encode($output);
    }
    
    function _getDatatableData(){
        $post['length'] = $this->input->post('length');
        $post['start'] = $this->input->post('start');
        $search = $this->input->post('search');
        $post['search']['value'] = $search['value'];
        
        $post['draw'] = $this->input->post('draw');
        $post['type'] = $this->input->post('type');
        $post['order'] = $this->input->post('order');
        return $post;
    }
    
    function branch_list_table_data($branch_list) {
        $row = array();
        $row[] = $branch_list->branch_id;
        $row[] = $branch_list->name;
        $row[] = $branch_list->address;
        $row[] = $branch_list->first_name. " ". $branch_list->last_name;
        $row[] = $branch_list->phone;
        $row[] = $branch_list->email;
        $row[] = $branch_list->credit_limit_amount;
        $row[] = "<a href='". base_url()."master/processUpdateBranch/".$branch_list->branch_id."' class='btn btn-success btn-md'>Edit</a>";
       

       
        return $row;
    }
    
}