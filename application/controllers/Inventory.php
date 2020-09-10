<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model('account_model');
        $this->load->library('ion_auth');
        $this->load->helper(array('form','url', 'array'));
        $this->load->library('form_validation');
        
        $this->load->model('master_model');
        $this->load->model('account_model');
     
    }
    
    function stockReceived(){
        $category = $this->master_model->get_matser('category', 'distinct category_name');
        $this->load->view('include/header', array('title' => "Stock Received"));
        $this->load->view('inventory/stockReceived', array('category' => $category));
        $this->load->view('include/footer');
    }
}