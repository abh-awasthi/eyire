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
       $html = "";
       if(!empty($data)){
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
        }
       
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
                'approved_by' => NULL, 
                'approved_date' => NULL,
                'is_approved' => 0);
            
            $drReceipt = array('cr_account_id' => $post['credit_account_id'],
                'dr_account_id' => $post['debit_account_id'], 'is_same_branch' => 1, 'amount' => $post['amount']);
            
            
            if(!empty($post['transaction_date'])){
                $transction_details['transaction_date'] = date('Y-m-d', strtotime($post['transaction_date']));
            }
            if(!empty($post['cheque_number'])){
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
    
    function dayBook(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $this->load->view('include/header', array('title' => "Day Book"));
        $this->load->view('account/daybook', array('branchDeatils' => $branchDeatils));
        $this->load->view('include/footer');
    }
    
    function getVoucherDetails(){
        //log_message('info', __METHOD__. " ". json_encode($_POST, true));
       //$str = '{"draw":"1","columns":[{"data":"0","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"1","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"2","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"3","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"4","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"5","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"6","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"7","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"8","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"9","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"10","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}],"order":[{"column":"0","dir":"asc"}],"start":"0","length":"10","search":{"value":"","regex":"false"},"getBranch":"getBranch"}';
       //$_POST = json_decode($str, true);
        $post = $this->_getDatatableData();
        $branch_id =$this->input->post('branch_id');
        if(!empty($branch_id)){
            $post['where']['dr_branch_id'] = $branch_id;
        }
        $post['select'] = "voucher_details.*, concat(approved.first_name,approved.last_name) as approved_user,concat(created.first_name,created.last_name) as created_user, voucher_receipt_entry.receipt_id, cr.account_no as cr_account_no, cr.account_name as cr_account_name, dr.account_no,"
                . "transaction_id,transaction_date,cheque_no,amount, dr.account_name as dr_account_name,dr_branch.name as branch_name";
        $post['column_order'] = array('voucher_details.id', 'dr_branch.name');
        $post['column_search'] = array('voucher_details.id', 'dr_branch.name', 'cr.account_no','cr.account_name', 'dr.account_no', 'dr.account_name' );
       
        $list = $this->account_model->getVocuherDetails($post);
        $data = array();
       // $sn =0;
        $amount_sum = 0;
        foreach ($list as $voucherDetails) {
           // $sn++;
            $row = $this->voucher_list_table_data($voucherDetails);
            $amount_sum += $voucherDetails->amount;
            $data[] = $row;
        }
        if(!empty($list)){
            $data[] = $this->addSumAmount($amount_sum);
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
        
        if(!empty($from_date)){
            $post['where']['voucher_details.voucher_date >= "'.date('Y-m-d', strtotime($from_date)).'"'] = NULL;
        }
        
        if(!empty($to_date)){
            $post['where']['voucher_details.voucher_date <= "'.date('Y-m-d', strtotime($to_date)).'"'] = NULL;
        }
        
        
        $post['where']['is_approved'] = 1;
        
        
        return $post;
    }
    
    function voucher_list_table_data($data){
        $row = array();
        $row[] = "";
        $row[] = date('d/m/Y', strtotime($data->voucher_date));
        $row[] = $data->branch_name;
        $row[] = $data->id;
        if($data->type_id == 1){
            $row[] = "Journal";
        } else if($data->type_id == 2){
            $row[] = "Payment";
        } else if($data->type_id == 3){
            $row[] = "Received";
        }
        
        $row[] = $data->dr_account_name;
        $row[] = $data->cr_account_name;
        
        $row[] = $data->amount;
        
        $row[] = $data->narration;
        $row[] = $data->created_user;
        $row[] = date('d/m/Y H:i:s', strtotime($data->create_date));
        $row[] = $data->approved_user;
        $row[] = $data->approved_date;
        $row[] = $data->cheque_no;
        $row[] = (!empty($data->transaction_date)) ? date('d/m/Y', strtotime($data->transaction_date)):"";
        $row[] = $data->transaction_id;
        
        return $row;
    }
    
    function addSumAmount($amount){
        $row = array();
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] ="";
        
        $row[] = "";
        $row[] = "<strong>Total Amount</strong>";
        
        $row[] = "<strong>".$amount."</strong>";
        
        if($this->input->post('type') ==1){
            $row[] = "";
        }
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        
        return $row;
    }
    
    function approveVoucher(){
       $this->load->view('include/header', array('title' => "Approve Voucher"));
       $this->load->view('account/approve_voucher');
       $this->load->view('include/footer');
    }
    
    function approvedVoucher($voucherID){
        if(!empty($voucherID)){
            $data = array('approved_by' => $this->session->userdata('user_id'), 'approved_date' => date('Y-m-d H:i:s'), 'is_approved' => 1);
            $status =$this->account_model->approve_voucher_details($data,$voucherID );
            
            if($status){
                echo json_encode(array('status' => true, 'message' => "Updated Successfully"));
            } else {
                echo json_encode(array('status' => false, 'message' => "Update Failed"));
            }
            
        }
    }
    
    function paymentVoucher(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $account = $this->master_model->get_matser('account_type', '*', array('active' => 1, 'parent_id != 0 '=> NULL), array('account_name', 'asc'));
                
        $this->load->view('include/header', array('title' => "Payment Voucher"));
        $this->load->view('account/addPaymentVoucher', array('branchDeatils' => $branchDeatils, 'account' => $account));
        $this->load->view('include/footer');
    }
    
    function cashBook(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $this->load->view('include/header', array('title' => "Cash Book"));
        $this->load->view('account/cashBook', array('branchDeatils' => $branchDeatils));
        $this->load->view('include/footer');
    }
    
    function getCashBookReports(){
       // log_message('info', __METHOD__. " ". json_encode($_POST, true)); exit();
        //$str = '{"draw":"1","columns":[{"data":"0","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"1","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"2","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"3","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"4","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"5","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"6","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"7","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"8","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"9","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"10","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"11","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"12","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"13","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"14","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}],"order":[{"column":"0","dir":"asc"}],"start":"0","length":"50","search":{"value":"","regex":"false"},"from_date":"16-09-2020","to_date":"17-09-2020","branch_id":"1","type":"3","account_type":"2"}';
        //$_POST = json_decode($str, true);
        $post = $this->_getDatatableData();
        $at = $this->input->post('account_type');
        $branch_id = $this->input->post('branch_id');
        $post['where']['dr_branch_id ='.$branch_id.''] = NULL;
        $post['where'][' ((dr.branch_id = '.$branch_id.' AND dr.account_type  = '.$this->input->post('account_type').') OR  (cr.branch_id = '.$branch_id.' AND cr.account_type  = '.$this->input->post('account_type').') ) '] =NULL;
        
        $post['select'] = "voucher_details.*, concat(approved.first_name,approved.last_name) as approved_user,concat(created.first_name,created.last_name) as created_user, voucher_receipt_entry.receipt_id, cr.account_no as cr_account_no, cr.account_name as cr_account_name, dr.account_no,"
                . "transaction_id,transaction_date,cheque_no,amount, dr.account_name as dr_account_name, cr.account_type as cr_account_type, dr.account_type as dr_account_type, dr_branch.name as branch_name";
        $post['column_order'] = array('voucher_details.id', 'dr_branch.name');
        $post['column_search'] = array('voucher_details.id', 'dr_branch.name', 'cr.account_no','cr.account_name', 'dr.account_no', 'dr.account_name' );
       
        $list = $this->account_model->getVocuherDetails($post);
        $data = array();
        $credit_amount =0;
        $debit_amount =0;
        foreach ($list as $voucherDetails) {
           // $sn++;
            $row = $this->voucher_cashbook_table_data($voucherDetails);
            
            $data[] = $row['row'];
            $credit_amount += $row['credit_amount'];
            $debit_amount += $row['debit_amount'];
        }
        
        $op_balance = $this->get_opening_balance($this->input->post('from_date'), $branch_id, $at);
        $data[] = $this->get_footer_op_balance("Opening Balance", $op_balance, "");
        $data[] = $this->get_footer_op_balance("Current Total", $debit_amount, $credit_amount);
        $data[] = $this->get_footer_op_balance("Closing Balance", ($op_balance + $debit_amount -$credit_amount), "");
        
        
        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->account_model->count_voucher_list($post),
            "recordsFiltered" => $this->account_model->count_voucher_list_filtered($post),
            "data" => $data,
            
        );
        
        echo json_encode($output);
    }
    
    function voucher_cashbook_table_data($data){
        $account_type = $this->input->post('account_type');
        $row = array();
        $debit_amount =0;
        $credit_amount =0;
        $row[] = "";
        $row[] = date('d/m/Y', strtotime($data->voucher_date));
        $row[] = $data->id;
        if($data->type_id == 1){
            $row[] = "Journal";
        } else if($data->type_id == 2){
            $row[] = "Payment";
        } else if($data->type_id == 3){
            $row[] = "Received";
        }
        
        if($data->dr_account_type == $account_type){
            $row[] = $data->cr_account_name;
        } else if($data->cr_account_type == $account_type){
            $row[] = $data->dr_account_name;
        }
        
        if($data->cr_account_type == $account_type){
            $row[] = $data->amount;
            $debit_amount = $data->amount;
        } else {
            $row[] = 0;
        }
        
        if($data->dr_account_type == $account_type){
            $row[] = $data->amount;
            $credit_amount = $data->amount;
        } else {
            $row[] = 0;
        }
        
        $row[] = $data->narration;
        $row[] = $data->created_user;
        $row[] = date('d/m/Y H:i:s', strtotime($data->create_date));
        $row[] = $data->approved_user;
        $row[] = $data->approved_date;
        $row[] = $data->cheque_no;
        $row[] = (!empty($data->transaction_date)) ? date('d/m/Y', strtotime($data->transaction_date)):"";
        $row[] = $data->transaction_id;
        
        return array('row' => $row, 'debit_amount' => $debit_amount, 'credit_amount' => $credit_amount);
    }
    
    function get_opening_balance($date_tmp, $branch_id, $at){
        $date =date('Y-m-d', strtotime($date_tmp));
        $r['length'] = -1;
        $r['where'] = array('voucher_details.dr_branch_id' => $branch_id, 'dr.account_type' => $at, 'dr.branch_id' => $branch_id, 'voucher_date < "'.$date.'" '=> NULL);
        $dr_data = $this->account_model->get_opening_balance($r);
        
        $cr['length'] = -1;
        $cr['where'] = array('voucher_details.cr_branch_id' => $branch_id, 'cr.account_type' => $at, 'cr.branch_id' => $branch_id, 'voucher_date < "'.$date.'" '=> NULL);
        $cr_data = $this->account_model->get_opening_balance($cr);

        $op_balance = $dr_data[0]->amount- $cr_data[0]->amount;
        
        return $op_balance;
    }
    
    function get_footer_op_balance($b_type, $debit, $credit){
        $row = array();
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] =  "<strong>".$b_type."</strong>";
        $row[] =  "<strong>".$debit."</strong>";
        $row[] =  "<strong>".$credit."</strong>";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        $row[] = "";
        
        return $row;
    }
    
    function bankBook(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $this->load->view('include/header', array('title' => "Bank Book"));
        $this->load->view('account/bankBook', array('branchDeatils' => $branchDeatils));
        $this->load->view('include/footer');
    }
    
    function receivedVoucher(){
        $branchDeatils = $this->master_model->get_matser('branch_details', '*', array(), array('name','desc'));
        $account = $this->master_model->get_matser('account_type', '*', array('active' => 1, 'parent_id != 0 '=> NULL), array('account_name', 'asc'));
                
        $this->load->view('include/header', array('title' => "Payment Voucher"));
        $this->load->view('account/addReceivedVoucher', array('branchDeatils' => $branchDeatils, 'account' => $account));
        $this->load->view('include/footer');
    }
    
    function getUnApprovedVoucherDetails(){
       // log_message('info', __METHOD__. " ". json_encode($_POST, true)); exit();
//        $str = '{"draw":"1","columns":[{"data":"0","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"1","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"2","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"3","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"4","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"5","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},{"data":"6","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"7","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"8","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"9","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"10","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"11","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"12","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"13","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"14","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"15","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},{"data":"16","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}],"order":[{"column":"0","dir":"asc"}],"start":"0","length":"50","search":{"value":"","regex":"false"},"type":"1"}';
//        $_POST = json_decode($str, true);
        $post = $this->_getUnApprovedDatatableData();
        $branch_id =$this->input->post('branch_id');
        if(!empty($branch_id)){
            $post['where']['dr_branch_id'] = $branch_id;
        }
        $post['select'] = "voucher_details_unapproved.*, concat(approved.first_name,approved.last_name) as approved_user,concat(created.first_name,created.last_name) as created_user,"
                . " voucher_receipt_entry_unapproved.receipt_id, cr.account_no as cr_account_no, cr.account_name as cr_account_name, dr.account_no,"
                . "transaction_id,transaction_date,cheque_no,amount, dr.account_name as dr_account_name,dr_branch.name as branch_name";
        $post['column_order'] = array('voucher_details_unapproved.is_approved', 'dr_branch.name');
        $post['column_search'] = array('voucher_details_unapproved.id', 'dr_branch.name', 'cr.account_no','cr.account_name', 'dr.account_no', 'dr.account_name' );
       
        $list = $this->account_model->getUnApprovedVocuherDetails($post);
        $data = array();
       // $sn =0;
        $amount_sum = 0;
        foreach ($list as $voucherDetails) {
           // $sn++;
            $row = $this->unApproved_voucher_list_table_data($voucherDetails);
            $amount_sum += $voucherDetails->amount;
            $data[] = $row;
        }
        

        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->account_model->count_unapproved_voucher_list($post),
            "recordsFiltered" => $this->account_model->count_unapproved_voucher_list_filtered($post),
            "data" => $data,
            
        );
        
        echo json_encode($output);
    }
    
    function unApproved_voucher_list_table_data($data){
        $row = array();
        $row[] = "";
        $row[] = date('d/m/Y', strtotime($data->voucher_date));
        $row[] = $data->branch_name;
        $row[] = $data->id;
        if($data->type_id == 1){
            $row[] = "Journal";
        } else if($data->type_id == 2){
            $row[] = "Payment";
        } else if($data->type_id == 3){
            $row[] = "Received";
        }
        
        $row[] = $data->dr_account_name;
        $row[] = $data->cr_account_name;
        
        $row[] = $data->amount;
        
        if($data->is_approved == 0){
            $row[] = "<button class='btn btn-sm btn-primary' onclick ='approve_voucher(".$data->id.")'>Approve</button><button class='btn btn-sm btn-danger' onclick ='reject_voucher(".$data->id.")'>Reject</button>";
        } else if($data->is_approved ==1){
            $row[] = "Approved";
        } else if($data->is_approved ==2){
            $row[] = "Cancelled";
        }
        $row[] = $data->narration;
        $row[] = $data->created_user;
        $row[] = date('d/m/Y H:i:s', strtotime($data->create_date));
        $row[] = $data->approved_user;
        $row[] = $data->approved_date;
        $row[] = $data->cheque_no;
        $row[] = (!empty($data->transaction_date)) ? date('d/m/Y', strtotime($data->transaction_date)):"";
        $row[] = $data->transaction_id;
        $row[] = $data->actual_voucher_id;
        
        return $row;
    }
    
    function _getUnApprovedDatatableData(){
        $post['length'] = $this->input->post('length');
        $post['start'] = $this->input->post('start');
        $search = $this->input->post('search');
        $post['search']['value'] = $search['value'];
        
        $post['draw'] = $this->input->post('draw');
        $post['type'] = $this->input->post('type');
        $post['order'] = $this->input->post('order');
        
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        
        if(!empty($from_date)){
            $post['where']['voucher_details_unapproved.voucher_date >= "'.date('Y-m-d', strtotime($from_date)).'"'] = NULL;
        }
        
        if(!empty($to_date)){
            $post['where']['voucher_details_unapproved.voucher_date <= "'.date('Y-m-d', strtotime($to_date)).'"'] = NULL;
        }
        
        
        //$post['where']['is_approved'] = 0;
        
        
        return $post;
    }
    
    function rejectVoucher($voucher_id){
        if(!empty($voucher_id)){
            $data = array('approved_by' => $this->session->userdata('user_id'), 'approved_date' => date('Y-m-d H:i:s'), 'is_approved' => 2);
            $status =$this->master_model->update_row('voucher_details_unapproved', $data ,array('id' => $voucher_id, 'is_approved' => 0));
            if($status){
                echo json_encode(array('status' => TRUE, 'message' => 'Update Failed'));
            } else {
               echo json_encode(array('status' => false, 'message' => 'Update Failed')); 
            }
            
        } else {
            echo json_encode(array('status' => false, 'message' => 'Update Failed'));
        }
    }
}

