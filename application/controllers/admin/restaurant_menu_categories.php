<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurant_menu_categories extends CI_Controller {

   function __construct() {
        parent::__construct();
        if (!$this->session->userdata("admin_login")) {
            redirect(site_url("admin/login"));
        }
        $this->load->model('menu_categories');
    }

	public function index()
	{
		$this->load->view('admin/menu_categories/view');
	}
        
        public function add()
	{       $data['restaurant_id'] = $_GET['id'];
                $data['title'] = "Add Menu Category";
		$this->load->view('admin/menu_categories/add', $data);
	}
        
        public function addSuccess()
	{   
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<span style="color:red;">Please fill form again carefully.</span>');
            redirect('admin/menu_categories/add');
        } else {
            
            $data['name'] = $this->input->post('title');
            $data['restaurant_id'] = $this->input->post('restaurant_id');
            $data['status'] = $this->input->post('status');
            $insert_id = $this->common_model->insert('restaurant_menu_categories', $data);
            if($insert_id){
            $this->session->set_flashdata('error', '<span style="color:green;">Congratulations..! You have added the new Menu Category Successfully!</span>');
        }
        }
            redirect('admin/restaurants/view');
	}
        
        
        public function viewCategories(){
            $data['title'] = "All Menu Categories";
            $id = $_GET['id'];
            $data['categories'] = $this->menu_categories->getMenuCategoryByID($id);
            $this->load->view('admin/menu_categories/view', $data);
        }
        
        public function edit()
	{
                $data['title'] = "Edit Menu Category";
                $id = $_GET['id'];
                $restaurant_id = $_GET['restaurant_id'];
		$data['categories'] = $this->menu_categories->getCategoryByMenuAndRestaurantID($id,$restaurant_id)->row();
		$this->load->view('admin/menu_categories/edit', $data);
	}
        
        public function editSuccess()
	{
                $cat_id= $this->input->post('cat_id');
                $data['name'] = $this->input->post('title');
                $data['status'] = $this->input->post('status');
                 $this->common_model->editRecord('id', $cat_id,'restaurant_menu_categories',$data);
                $this->session->set_flashdata('error', '<span style="color:green;">Congratulations..! You have Edited the Category Successfully!</span>');
		 redirect('admin/restaurants/view');
	}
        
         public function delete(){
            $id = $_GET['id'];
       
            $this->common_model->delete('id', $id, 'categories');
             redirect('admin/categories/viewCategories');
    }
}
