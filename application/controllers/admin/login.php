<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("admin_login")) {
            redirect(site_url("admin/dashboard"));
        }
    }
	public function index()
	{
		$this->load->view('admin/login');
	}
        
        public function auth(){
            $email = $this->input->post('user_email');
            $password = $this->input->post('user_password');
       

        $result = $this->common_model->admin_login($email, $password);
       
        if ($result) {
            $data['userdata'] = $result;

            $this->session->set_userdata("admin_login", $data['userdata']);
            
            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', '<span style="color:red;">Incorrect Email or password!</span>');
            
            redirect('admin/login');
        }
        }
}
