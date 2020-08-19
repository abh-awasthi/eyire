<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin

 */
class Member extends CI_Controller {

    public $data = [];

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
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


        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'header');
        $this->_render_page('member' . DIRECTORY_SEPARATOR . 'create');
        $this->_render_page('include' . DIRECTORY_SEPARATOR . 'footer');
    }
    
    
    
    function processCreateMember(){
        
        
        
        
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
