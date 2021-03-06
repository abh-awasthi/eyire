<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin

 */
class Member extends CI_Controller {

    public $data = [];

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('master_model');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('notify');
        $this->load->helper(['url', 'language']);
        $this->load->model('Bank_model');
        $this->load->model('Member_model');
        $this->load->model('Master_model');


        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    }

    public function index() {


        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'header');
        $this->_render_page('member' . DIRECTORY_SEPARATOR . 'dashboard');
        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'footer');
    }

    /**
     * @param string     $view
     * @param array|null $data
     * @param bool       $returnhtml
     *
     * @return mixed
     */
    public function create() {

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->data['message'] = '';
        $this->data['banks'] = $this->Bank_model->get_banks_names();
        $this->data['states'] = $this->master_model->get_matser('states', '*', array('country_id' => 105));
        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'header');
        $this->_render_page('member' . DIRECTORY_SEPARATOR . 'create');
        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'footer');
    }

    function getStateDistrict($state_id) {

        $districts = $this->master_model->get_matser('district', '*', array('state_id' => $state_id));

        $options = '';
        foreach ($districts as $district) {
            $options = $options . '<option value="' . $district['id'] . '" >' . $district['district'] . '</option>';
        }
        echo $options;
    }

    function processCreateMember() {

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $data_user_table = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'phone' => $this->input->post('phone'),
            'gender' => $this->input->post('gender'),
            'dob' => $this->input->post('dob'),
            'age' => $this->input->post('dob'),
            'is_member' => 1
        );
        $identity = $this->input->post('identity');
        $email = $identity;
        $password = $this->input->post('phone');
        $user_id = $this->ion_auth->register($identity, $password, $email, $data_user_table);

        if ($user_id) {
            if ($this->input->post('reg_date')) {
                $reg_date = $this->input->post('reg_date');
            } else {
                $reg_date = date('Y-m-d');
            }

            $member_data = array(
                'member_user_id' => $user_id,
                'form_no' => $this->input->post('phone'),
                'reg_date' => $reg_date,
                'gurdian_type' => $this->input->post('gurdian_type'),
                'gurdian_name' => $this->input->post('gurdian'),
                'address' => $this->input->post('address'),
                'state' => $this->input->post('state'),
                'district' => $this->input->post('district'),
                'city' => $this->input->post('city'),
                'village' => $this->input->post('village'),
                'pincode' => $this->input->post('pincode'),
                'alt_number' => $this->input->post('alt_number'),
                'idproof' => $this->input->post('idproof'),
                'id_number' => $this->input->post('id_number'),
                'address_proof' => $this->input->post('address_proof'),
                'add_id_number' => $this->input->post('add_id_number'),
                'n_name' => $this->input->post('n_name'),
                'n_relation' => $this->input->post('n_relation'),
                'n_gender' => $this->input->post('n_gender'),
                'ndob' => $this->input->post('ndob'),
                'n_age' => $this->input->post('n_age'),
                'n_address' => $this->input->post('n_address'),
                'bank_name' => $this->input->post('bank_name'),
                'ifsc' => $this->input->post('ifsc'),
                'account_no' => $this->input->post('account_no'),
                'pan_no' => $this->input->post('pan_no'),
                'branch' => $this->input->post('branch'),
                'branch_address' => $this->input->post('branch_address'),
                'member_type' => $this->input->post('member_type'),
                'num_share' => $this->input->post('num_share'),
                'applicant_charge' => $this->input->post('applicant_charge'),
                'total_payable' => $this->input->post('total_payable'),
            );

            $member_table_id = $this->Member_model->insert_row('members', $member_data);
            if ($member_table_id) {
                $sms_data['phone_no'] = $this->input->post('phone');
                $sms_data['tag'] = MEMBER_CREATE_SMS;
                $sms_data['smsData']['name'] = $this->input->post('first_name');
                $sms_data['smsData']['member_id'] = $user_id;
                $sms_data['smsData']['amount'] = $this->input->post('total_payable');
                $sms_data['smsData']['branch'] = $this->input->post('branch');

                $this->notify->send_sms($sms_data);
                echo json_encode(array('status' => TRUE, 'message' => 'Member Added Succesfully !', 'data' => array('member_id' => $user_id)));
            } else {

                echo json_encode(array('status' => FALSE, 'message' => 'Member Not Added!. Network problem', 'data' => array('member_id' => 0)));
            }
        } else {
            echo json_encode(array('status' => FALSE, 'message' => 'Member Not Added. Please check email address must Be uniquue !', 'data' => array('member_id' => 0)));
        }
    }

    private function get_post_data() {
        $post['length'] = $this->input->post('length');
        $post['start'] = $this->input->post('start');
        $search = $this->input->post('search');
        $post['search_value'] = $search['value'];
        $post['order'] = $this->input->post('order');
        $post['draw'] = $this->input->post('draw');
        return $post;
    }

    function memberslist() {
        $this->data['title'] = 'Members List';
        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'header', $this->data);
        $this->_render_page('member' . DIRECTORY_SEPARATOR . 'memberslist', $this->data);
        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'footer', $this->data);
    }

    function get_member_list() {

        $post = $this->get_post_data();
        $post['column_order'] = array();
        $post['column_search'] = array('first_name', 'last_name', 'email');
        $select = "members.*,users.first_name,users.last_name,users.phone,users.dob,users.age,users.email";
        $members = $this->Member_model->get_master_mebers_users($select);

        $data = array();
        $no = $post['start'];

        foreach ($members as $member) {
            $no++;
            $row = $this->get_members_table($member, $no);
            $data[] = $row;
        }

        $post['length'] = -1;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => 500,
            "recordsFiltered" => 50,
            "data" => $data,
        );

        echo json_encode($output);
    }

    function get_members_table($member, $no) {

        $row[] = $member->member_user_id;
        $row[] = $member->first_name;
        $row[] = $member->last_name;
        $row[] = $member->email;
        $row[] = $member->phone;
        $row[] = $member->reg_date;
        $row[] = $member->gurdian_name;
        $row[] = '<button>Action</button>';

        return $row;
    }

    /**
     * @param string     $view
     * @param array|null $data
     * @param bool       $returnhtml
     *
     * @return mixed
     */
    public function _render_page($view, $data = NULL, $returnhtml = FALSE) {//I think this makes more sense
        $viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $viewdata, $returnhtml);

        // This will return html on 3rd argument being true
        if ($returnhtml) {
            return $view_html;
        }
    }

}
