<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin
 
 */
class Admin extends CI_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
 
	}

 
	public function index()
	{

		 
			$this->_render_page('include' . DIRECTORY_SEPARATOR . 'header');
			$this->_render_page('admin' . DIRECTORY_SEPARATOR . 'dashboard');
			$this->_render_page('include' . DIRECTORY_SEPARATOR . 'footer');
		 
	}
	
	
	 

}
