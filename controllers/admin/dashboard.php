<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct(){
		parent::__construct();
		if(!$this->session->userdata("admin_login")){
			redirect(site_url("admin/login"));	
		}
	}

	public function index()
	{
		$this->load->view('admin/index');
	}
}
