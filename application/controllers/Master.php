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
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
        $this->load->library('form_validation');

     
    }
    
    function addDistrict(){
        $states = $this->master_model->get_matser('states', '*', array('country_id' => 105));
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
        log_message('info', __METHOD__. " ". json_encode($_POST)); 
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
            $this->master_model->insert_row('district', array('district' => $this->input->post('district'), 'state_id' =>$this->input->post("state") ));
            echo json_encode(array('status' => true, 'message' => "New District Added Successfully"));
        } else {
            echo json_encode(array('status' => false, 'message' => validation_errors()));
        }
    }
    
    function addBranchEntry(){
        $district = $this->master_model->get_matser('district', '*');
        $this->load->view('include/header', array('title' => "Branch Entry"));
        $this->load->view('master/addBranch', array('district' => $district));
        $this->load->view('include/footer');
    }
}