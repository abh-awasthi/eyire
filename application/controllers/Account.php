<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model('account_model');
        $this->load->library('ion_auth');
        $this->load->helper(array('form','url', 'array'));
        $this->load->library('form_validation');
        
        $this->load->model('master_model');
        $this->load->model('account_model');
     
    }
    
    function addNewAccountType(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $this->load->view('include/header', array('title' => "Chart of Account"));
        $this->load->view('account/addAccountType', array('branch' => $branchDeatils));
        $this->load->view('include/footer');
    }
    
    function processAddAccount(){
        //log_message('info', __METHOD__. json_encode($_POST));
        $this->form_validation->set_rules('account_no', 'Sub Ledger A/C No', 'trim|required');
        $this->form_validation->set_rules('account_name', 'Sub Ledger A/C Name', 'trim|required');
        $this->form_validation->set_rules('account_no', 'Sub Ledger A/C No', 'callback_checkUniqueAccountNo');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => false, 'message' => validation_errors()));
        } else {
            $post = $this->input->post();
            $data = array('parent_id' => $post['parent_id'], 'account_no' => trim($post['account_no']),
                'account_name' => ucwords(trim($post['account_name'])));
            if($post['account_type'] == 1 || $post['account_type'] == 2){
                $data['account_type'] = $post['account_type'];
                $data['branch_id'] = $post['branch_id'];
            }
            $this->master_model->insert_row('account_type', $data);
            echo json_encode(array('status' => true, 'message' => "New Account Added Successfully"));
        }
    }
    
    function checkUniqueAccountNo(){
        $account = $this->master_model->get_matser('account_type', '*', array('parent_id' => $this->input->post('parent_id'), 'account_no' => $this->input->post('account_no')), array('account_name', 'asc'));
        if(!empty($account)){
            if($account[0]['active'] ==0){
                $this->form_validation->set_message('checkUniqueAccountNo', 'This Account No is De-actived');
                return false;
            } else {
               $this->form_validation->set_message('checkUniqueAccountNo', 'This Account No has already exist');
                return false; 
            }
        } else {
            return true;
        }
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
               $html .= '<li style="color:#e47297">'.$treeView[$i]['account_name']. ' - '.$treeView[$i]['account_no'].' </li>';
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
    
    function addJournalvoucher(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $account = $this->master_model->get_matser('account_type', '*', array('active' => 1, 'parent_id != 0 '=> NULL), array('account_name', 'asc'));
        
        $is_admin = $this->ion_auth->is_admin();
                
        $this->load->view('include/header', array('title' => "Journal Voucher"));
        $this->load->view('account/addJournalVoucher', array('branchDeatils' => $branchDeatils, 'account' => $account, 'is_admin' =>$is_admin));
        $this->load->view('include/footer');
    }
    
    function processAddJournalVoucher(){
        //log_message('info', __METHOD__. json_encode($_POST));
//        $str = '{"voucher_type_id":"1","narration":"NNNNNN","voucher_date":"2020-09-10","cheque_number":"","branch_id":"1","transaction_id":"987788877777777","debit_account_id":"6","transaction_date":"","credit_account_id":"3","amount":"5000","label":"WEBUPLOAD"}';
//        $_POST = json_decode($str, true);
        $this->form_validation->set_rules('voucher_date', 'Voucher Date', 'trim|required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'trim|required');
        $this->form_validation->set_rules('narration', 'Narration', 'trim|required');
        $this->form_validation->set_rules('credit_account_id', 'Credit Account', 'trim|required');
        $this->form_validation->set_rules('debit_account_id', 'Debit Entry', 'trim|required');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => false, 'message' => validation_errors()));
        } else {
            $post = $this->input->post();
            $voucherDetails = array('voucher_date' => date('Y-m-d', strtotime($post['voucher_date'])), 'cr_branch_id' => $post['branch_id'],
                'dr_branch_id' => $post['branch_id'],
                'narration' => ucwords(trim($post['narration'])), 
                'type_id' => $post['voucher_type_id'],
                'created_by' => $this->session->userdata('user_id'), 
                'approved_by' => NULL, 'approved_date' => NULL);
            
            $drReceipt = array('cr_account_id' => $post['credit_account_id'],
                'dr_account_id' => $post['debit_account_id'], 'is_same_branch' => 1);
            
            $transction_details =array(
                'amount' => $post['amount']
                
            );
            
            if(!empty($post['transaction_date'])){
                $transction_details['transaction_date'] = date('Y-m-d', strtotime($post['transaction_date']));
            }
            if(!empty($post['cheque_no'])){
                $transction_details['cheque_no'] = $post['cheque_number'];
            }
            if(!empty($post['transaction_id'])){
                $transction_details['transaction_id'] = $post['transaction_id'];
            }
            
            $status = $this->account_model->insert_voucher($voucherDetails, $drReceipt, $transction_details);
            if($status){
                echo json_encode(array('status' => true, 'message' => "New Voucher Added Successfully"));
            } else {
                echo json_encode(array('status' => false, 'message' => "New Voucher Insertion Failed"));
            }
        }
    }
    
    function voucherDetails(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $account = $this->master_model->get_matser('account_type', '*', array('active' => 1, 'parent_id != 0 '=> NULL), array('account_name', 'asc'));
        $this->load->view('include/header', array('title' => "Journal Voucher"));
        $this->load->view('account/voucherDetails', array('branchDeatils' => $branchDeatils, 'account' => $account));
        $this->load->view('include/footer');
    }
    
    function getVoucherDetails(){
        //log_message('info', __METHOD__. " ". json_encode($_POST, true));
       //$str = '{"draw":"1","columns":[{"data":"0","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"1","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"2","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"3","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"4","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"5","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"6","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"7","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"8","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"9","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"10","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}],"order":[{"column":"0","dir":"asc"}],"start":"0","length":"10","search":{"value":"","regex":"false"},"getBranch":"getBranch"}';
       //$_POST = json_decode($str, true);
        $post = $this->_getDatatableData();
        $post['select'] = "voucher_details.*, concat(approved.first_name,approved.last_name) as approved_user,concat(created.first_name,created.last_name) as created_user, voucher_receipt_entry.receipt_id, cr.account_no as cr_account_no, cr.account_name as cr_account_name, dr.account_no,"
                . "voucher_transaction_details.transaction_id as txnid, voucher_transaction_details.transaction_date as tnx_date, voucher_transaction_details.cheque_no, voucher_transaction_details.amount, dr.account_name as dr_account_name,dr_branch.name as branch_name";
        $post['column_order'] = array('voucher_details.id', 'dr_branch.name');
        $post['column_search'] = array('voucher_details.id', 'dr_branch.name', 'cr.account_no','cr.account_name', 'dr.account_no', 'dr.account_name' );
       
        $list = $this->account_model->getVocuherDetails($post);
        $data = array();
        $sn =0;
        foreach ($list as $voucherDetails) {
            $sn++;
            $row = $this->voucher_list_table_data($voucherDetails, $sn);
            $data[] = $row;
        }

        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->account_model->count_voucher_list($post),
            "recordsFiltered" => $this->account_model->count_voucher_list_filtered($post),
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
        
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $branch_id =$this->input->post('branch_id');
        $voucher_id = $this->input->post('voucher_id');
        $credit_account_id = $this->input->post('credit_account_id');
        $debit_account_id = $this->input->post('debit_account_id');
        if(!empty($from_date)){
            $post['where']['voucher_details.voucher_date >= "'.date('Y-m-d', strtotime($from_date)).'"'] = NULL;
        }
        
        if(!empty($to_date)){
            $post['where']['voucher_details.voucher_date <= "'.date('Y-m-d', strtotime($to_date)).'"'] = NULL;
        }
        
        if(!empty($branch_id)){
            $post['where']['dr_branch_id'] = $branch_id;
        }
        
        if(!empty($voucher_id)){
            $post['where']['voucher_details.id'] = $voucher_id;
        }
        if(!empty($credit_account_id)){
            $post['where']['credit_account_id'] = $credit_account_id;
        }
        
        if(!empty($credit_account_id)){
            $post['where']['debit_account_id'] = $debit_account_id;
        }
        
        if($this->input->post('type') ==1){
            $post['where']['approved_by IS NULL'] = NULL;
        }
        
        
        return $post;
    }
    
    function voucher_list_table_data($data, $no){
        $row = array();
        $row[] = "";
        $row[] = $data->id;
        $row[] = $data->branch_name;
        $row[] = $data->dr_account_name;
        $row[] = $data->cr_account_name;
        $row[] = ($data->type_id = 1 )? 'Journal Voucher': 'Payment Voucher';
        $row[] = $data->amount;
        $row[] = date('Y-m-d', strtotime($data->voucher_date));
        if($this->input->post('type') ==1){
            $row[] = "<button class='btn btn-md btn-primary' onclick ='approve_voucher(".$data->id.")'>Approve </button>";
        }
        $row[] = $data->cheque_no;
        $row[] = (!empty($data->transaction_date)) ? $data->txnid. " <br/><br/> <strong> ". date('Y-m-d', strtotime($data->tnx_date)). "</strong>": $data->transaction_id;
        $row[] = $data->narration;
        $row[] = $data->created_user;
        $row[] = $data->create_date;
        $row[] = $data->approved_user;
        $row[] = $data->approved_date;

        return $row;
    }
    
    function approveVoucher(){
       $this->load->view('include/header', array('title' => "Approve Voucher"));
       $this->load->view('account/approve_voucher');
       $this->load->view('include/footer');
    }
    
    function approvedVoucher($voucherID){
        if(!empty($voucherID)){
            $this->master_model->update_row('voucher_details', array('approved_by' => $this->session->userdata('user_id'), 'approved_date' => date('Y-m-d H:i:s')), 
                    array('id' => $voucherID));
            echo json_encode(array('status' => true, 'message' => "Updated Successfully"));
        }
    }
    
    function paymentVoucher(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $account = $this->master_model->get_matser('account_type', '*', array('active' => 1, 'parent_id != 0 '=> NULL), array('account_name', 'asc'));
        
       // $is_admin = $this->ion_auth->is_admin();
                
        $this->load->view('include/header', array('title' => "Payment Voucher"));
        $this->load->view('account/addPaymentVoucher', array('branchDeatils' => $branchDeatils, 'account' => $account));
        $this->load->view('include/footer');
    }
}

