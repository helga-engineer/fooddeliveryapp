<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller {

   function __construct() {
        parent::__construct();
        if (!$this->session->userdata("admin_login")) {
            redirect(site_url("admin/login"));
        }
    }

	public function index()
	{
		$this->load->view('admin/restaurant_categories/view');
	}
        
        public function add()
	{
                $data['title'] = "Add Category";
		$this->load->view('admin/restaurant_categories/add', $data);
	}
        
        public function addSuccess()
	{
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<span style="color:red;">Please fill form again carefully.</span>');
            redirect('admin/categories/add');
        } else {
            
            $data['name'] = $this->input->post('title');
            $data['active'] = $this->input->post('status');
            $insert_id = $this->common_model->insert('categories', $data);
            if($insert_id){
            $this->session->set_flashdata('error', '<span style="color:green;">Congratulations..! You have added the new Category Successfully!</span>');
        }
        }
            $this->load->view('admin/restaurant_categories/view');
	}
        
        
        public function viewCategories(){
            $data['title'] = "All Categories";
            $data['categories'] = $this->common_model->getAllCategories();
            $this->load->view('admin/restaurant_categories/view', $data);
        }
        
        public function edit()
	{
                $data['title'] = "Edit Category";
                $id = $_GET['id'];
		$data['categories'] = $this->common_model->getCategoryByID($id)->row();
		$this->load->view('admin/restaurant_categories/edit', $data);
	}
        
        public function editSuccess()
	{
                $cat_id= $this->input->post('cat_id');
                $data['name'] = $this->input->post('title');
                $data['active'] = $this->input->post('status');
                 $this->common_model->editRecord('id', $cat_id,'categories',$data);
                $this->session->set_flashdata('error', '<span style="color:green;">Congratulations..! You have Edited the Category Successfully!</span>');
		 redirect('admin/categories/viewCategories');
	}
        
         public function delete(){
            $id = $_GET['id'];
       
            $this->common_model->delete('id', $id, 'categories');
             redirect('admin/categories/viewCategories');
    }
}
