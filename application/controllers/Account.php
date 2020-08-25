<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model('account_model');
        $this->load->library('ion_auth');
        $this->load->helper(array('form','url', 'array'));
        $this->load->library('form_validation');
        
        $this->load->model('master_model');
     
    }
    
    function addNewAccountType(){
        $this->load->view('include/header', array('title' => "Chart of Account"));
        $this->load->view('account/addAccountType');
        $this->load->view('include/footer');
    }
    
    function processAddAccount(){
//        $this->form_validation->set_rules('parent_id', 'General Ledger A/C No', 'trim|required');
//        $this->form_validation->set_rules('account_no', 'Sub Ledger A/C No', 'trim|required');
//        $this->form_validation->set_rules('account_name', 'Sub Ledger A/C Name', 'trim|required');
        $post = $this->input->post();
        $this->master_model->insert_row('account_type', array('parent_id' => $post['parent_id'], 'account_no' => $post['account_no'],
                'account_name' => ucwords(trim($post['account_name']))));
        
    }
    
    
    function getAccountOption(){
        $account = $this->master_model->get_matser('account_type', '*', array('active' => 1), array('account_name', 'asc'));
        $html ='<option value="0" selected>Select Parent Account</option>';
        foreach ($account as $value) {
            $html .= '<option value="'.$value['id'].'">'.$value['account_name'].' - '.$value['account_no'].'</option>';
        }
        echo $html;
    }
    function getTreeviewAccountTest(){
       $parent_id = 0;
       $account = $this->master_model->get_matser('account_type', '*', array('active' => 1), array('account_name', 'asc'));
       foreach ($account as $row) {
           $data = $this->getNodeData($parent_id);
       }
       echo json_encode(array_values($data));
    }
    
    function getTreeviewAccount(){
       $parent_id = 0;
       $account = $this->master_model->get_matser('account_type', '*', array('active' => 1), array('account_name', 'asc'));
       foreach ($account as $row) {
           $data = $this->getNodeData($parent_id);
       }
       $treeView =array_values($data);
       $html = '<ul id="myUL">';
       for($i =0; $i < count($treeView); $i++){
           
           if(!empty($treeView[$i]['nodes'])){
              $html .= $this->printNodes($treeView[$i], $i);
           } else {
               $html .= '<li style="color:#e47297">'.$treeView[$i]['account_name']. ' - '.$treeView[$i]['account_no'].'</li>';
           }
           
       }
       $html .= '</ul>';
      echo $html;
    }
    
    function printNodes($subNodes, $i){

       if(!empty($subNodes['nodes'])){
               $html = '<li><span class="caret">'.$subNodes['account_name'].' - '.$subNodes['account_no'].'</span>';
               $html .= '<ul class="nested">';
               for($j =0; $j < count($subNodes['nodes']); $j++){
                   $html .= $this->printNodes($subNodes['nodes'][$j], $j);
               }
               $html .='</ul>';
               $html .='</li>';
           } else {
               $html = '<li style="color:#e47297">'.$subNodes['account_name'].' - '.$subNodes['account_no'].'</li>';
           }
           
           return $html;
    }

    
    function getNodeData($parent_id){
        $account = $this->master_model->get_matser('account_type', '*', array('active' => 1, 'parent_id' => $parent_id), array('account_name', 'asc'));
        $output = array();
        foreach ($account as $row) {
            $sub_array = array();
            $sub_array['account_name'] = $row['account_name'];
            $sub_array['account_no'] = $row['account_no'];
            $sub_array['nodes'] = array_values($this->getNodeData($row['id']));
            $output[] = $sub_array;
        }
        
        return $output;
    }
}

