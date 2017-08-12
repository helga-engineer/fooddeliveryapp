<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller {

   function __construct() {
        parent::__construct();
        if (!$this->session->userdata("admin_login")) {
            redirect(site_url("admin/login"));
        }
        $this->load->model('menu_model');
    }

	public function index()
	{
		$this->load->view('admin/restaurant_categories/view');
	}
        
        public function add()
	{
                $data['title'] = "Add Menu";
                $data['restaurant_id'] = $_GET['id'];
                $data['categories'] = $this->menu_model->getMenuCategoryByID($_GET['id']);
		$this->load->view('admin/menus/add', $data);
	}
        
        public function addnewItem(){
		$data['Counter'] = $this->input->post('seasonalcounter');
		return $this->load->view('admin/menus/addNewItem', $data);
	}
        
       /* public function addSuccess()
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
	} */
        
        public function addSuccess()
    {
		
                $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<span style="color:red;">Please fill form again carefully.</span>');
            redirect( $_SERVER['HTTP_REFERER']);
        } else {
            
            $data['menu_title'] = $this->input->post('title');
            $data['restaurant_id'] = $this->input->post('restaurant_id');
            $data['categories'] = json_encode($this->input->post('categories'));
            $insert_id = $this->common_model->insert('menus', $data);
            if($insert_id){
           
            
            foreach($_POST['item_name'] as $key=>$val){
			
			$data1['menu_id'] = $insert_id;
			$data1['item_name'] = $_POST['item_name'][$key];
			$data1['item_price'] = $_POST['item_price'][$key];
                        $data1['item_description'] = $_POST['description'][$key];
			$item_insert_id = $this->common_model->insert('menu_items', $data1);
                            
		}
                 
        
            
            }
             $this->session->set_flashdata('error', '<span style="color:green;">Congratulations..! You have created the new Menu Successfully!</span>');
        
             redirect( $_SERVER['HTTP_REFERER']);
            }
                    
	
    }
        
        
        public function viewMenus(){
            $data['title'] = "All Menus";
            $restaurant_id  = $_GET['id'];
            $data['menus'] = $this->menu_model->getAllMenus($restaurant_id);
            $this->load->view('admin/menus/view', $data);
        }
        
        public function edit()
	{
                $data['title'] = "Edit Menu";
                $id = $_GET['id'];
                $restaurant_id = $_GET['restaurant_id'];
                 $data['categories'] = $this->menu_model->getMenuCategoryByID($restaurant_id);
		$data['menu'] = $this->menu_model->getAllMenusByRestaurantID($id,$restaurant_id)->row();
                $data['menu_id'] = $_GET['id'];
                $data['restaurant_id'] = $_GET['restaurant_id'];
                $data['items'] = $this->menu_model->getMenuItems($data['menu_id']);
                
		$this->load->view('admin/menus/edit', $data);
	}
        
        public function editSuccess()
	{
            
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<span style="color:red;">Please fill form again carefully.</span>');
            redirect( $_SERVER['HTTP_REFERER']);
        } else {
            
            $data['menu_title'] = $this->input->post('title');
            $data['restaurant_id'] = $this->input->post('restaurant_id');
            $data['categories'] = json_encode($this->input->post('categories'));
            $menu_id = $this->input->post('menu_id');
            
            $this->common_model->editRecord('id', $menu_id,'menus',$data);
            if($menu_id){
           
                $this->common_model->delete('menu_id', $menu_id, 'menu_items');
            
            foreach($_POST['item_name'] as $key=>$val){
			
			$data1['menu_id'] = $menu_id;
			$data1['item_name'] = $_POST['item_name'][$key];
			$data1['item_price'] = $_POST['item_price'][$key];
                        $data1['item_description'] = $_POST['description'][$key];
			$item_insert_id = $this->common_model->insert('menu_items', $data1);
                            
		}
                 
        
            
            }
             $this->session->set_flashdata('error', '<span style="color:green;">Congratulations..! You have edit the Menu Successfully!</span>');
        
             redirect( $_SERVER['HTTP_REFERER']);
            }
            
            
                
	}
        
         public function delete(){
            $id = $_GET['id'];
            
            $this->common_model->delete('id', $id, 'menus');
            $this->common_model->delete('menu_id', $id, 'menu_items');
              redirect( $_SERVER['HTTP_REFERER']);
    }
}
