<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restaurants extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("admin_login")) {
            redirect(site_url("admin/login"));
        }
    }

    public function index() {
        $data['title'] = "Add Restaurant";
        $data['countries'] = $this->common_model->getCountries();
        $data['categories'] = $this->common_model->getCategories();
        $this->load->view('admin/restaurants/add', $data);
    }
    
    public function view() {
        $data['title'] = "View Restaurants";
        $UserData = $this->session->userdata("admin_login");
        $user_id = $UserData->id;
         $data['restaurants'] = $this->common_model->getRestaurants($user_id);
        $this->load->view('admin/restaurants/view', $data);
    }
    
    public function delete(){
        $id = $_GET['id'];
       
        $this->common_model->delete('id', $id, 'restaurants');
        redirect(site_url("admin/restaurants/view"));
    }
    
    public function edit(){
        $id = $_GET['id'];
          $data['title'] = "Edit Restaurant";
          $data['countries'] = $this->common_model->getCountries();
        $data['categories'] = $this->common_model->getCategories();
        $data['restaurants'] = $this->common_model->getById($id)->row();
       $this->load->view('admin/restaurants/edit', $data);
    }
    
    public function editSuccess(){
         //print_r($_FILES["logo"]); exit;
            $UserData = $this->session->userdata("admin_login");
            $user_id = $UserData->id;
            $restaurant_id = $this->input->post('restaurant_id');
            $data['user_id'] = $user_id;
            $data['title'] = $this->input->post('title');
            $data['address'] = $this->input->post('address');
            $data['address_2'] = $this->input->post('address2');
            $data['mobile'] = $this->input->post('mobile');
            $data['fax'] = $this->input->post('fax');
            $data['country'] = $this->input->post('country');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
            $data['zipcode'] = $this->input->post('zipcode');
            $data['categories'] = json_encode($this->input->post('categories'));
            $data['notified_choice'] = $this->input->post('notified_via');
            $data['email'] = $this->input->post('email');
            foreach ($this->input->post('counter') as $key => $val) {
				$request = $this->input->post('day');
				$request1 = $this->input->post('from');
				$request2 = $this->input->post('to');
            $vals[] = $request[$val][0] . '&nbsp;&nbsp;&nbsp;' . $request1[$val][0] . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $request2[$val][0];
        }
            $data['hours_of_operations'] = json_encode($vals);
             $data['hours_of_operations_to'] =  $this->input->post('toHours');
            $data['phone'] = $this->input->post('phone');
            $data['status'] = $this->input->post('status');

             $this->common_model->editRecord('id', $restaurant_id,'restaurants',$data); 
           
            if ($_FILES["logo"] !='') {
              
                $this->common_model->delete('module_id', $restaurant_id, 'media');
                
               
                 $name = $_FILES["logo"]['name'];
                 $tmp_name = $_FILES["logo"]["tmp_name"];
                $fname = time() . '_' . basename($name);
                $fname = str_replace(" ", "_", $fname);
                $fname = str_replace("%", "_", $fname);
                $name_ext = end(explode(".", basename($name)));
                $name = str_replace('.' . $name_ext, '', basename($name));
                 $uploaddir = "./uploads/";
                $uploaddir2 = "./uploads/";
                $uploadfile = $uploaddir . $fname;
				//print_r($tmp_name); exit;
                if (move_uploaded_file($tmp_name, $uploadfile)) {
					//print_r('test inside'); exit;
                    $result["module_type"] = "restaurants";
                    $result["module_id"] = $restaurant_id;
                    $result["name"] = $name;
                    $result["image"] = $fname;
                    $result["type"] = $_FILES['logo']['type'];
                    $result["size"] = $_FILES['logo']['size'];
                    $return_id = $this->common_model->insert('media', $result);
                     
                }
            }
        redirect(site_url("admin/restaurants/view"));
    }

    public function getCities() {

        $country_id = $this->input->post('country_id');
        
        $data['cities'] = $this->common_model->getCitiesByCountryId($country_id);

        foreach ($data['cities']->result() as $row) {
            echo '<option value="' . $row->id . '"> ' . $row->name . ' </option>';
        }
    }

    public function addSuccess() {


        $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        $this->form_validation->set_rules('country', 'Country', 'required|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'required|xss_clean');
        //$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<span style="color:red;">Please fill form again carefully.</span>');
            redirect('admin/restaurants/index');
        } else {
			$request = $_POST ; 
            $UserData = $this->session->userdata("admin_login");
            $user_id = $UserData->id;
            $data['user_id'] = $user_id;
            $data['title'] = $this->input->post('title');
            $data['address'] = $this->input->post('address');
             $data['address_2'] = $this->input->post('address2');
            $data['mobile'] = $this->input->post('mobile');
            $data['fax'] = $this->input->post('fax');
            $data['country'] = $this->input->post('country');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
            $data['zipcode'] = $this->input->post('zipcode');
            $data['categories'] = json_encode($this->input->post('categories'));
            $data['notified_choice'] = $this->input->post('notified_via');
            $data['email'] = $this->input->post('email');
			foreach ($this->input->post('counter') as $key => $val) {
				$request = $this->input->post('day');
				$request1 = $this->input->post('from');
				$request2 = $this->input->post('to');
            $vals[] = $request[$val][0] . '&nbsp;&nbsp;&nbsp;' . $request1[$val][0] . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $request2[$val][0];
        }
            $data['hours_of_operations'] = json_encode($vals);
            $data['hours_of_operations_to'] =  $this->input->post('toHours');
            $data['phone'] = $this->input->post('phone');
            $data['status'] = $this->input->post('status');

            $insert_id = $this->common_model->insert('restaurants', $data);
            if (isset($_FILES["logo"]) && $_FILES["logo"]) {
              
               
                 $name = $_FILES["logo"]['name'];
                 $tmp_name = $_FILES["logo"]["tmp_name"];
                $fname = time() . '_' . basename($name);
                $fname = str_replace(" ", "_", $fname);
                $fname = str_replace("%", "_", $fname);
                $name_ext = end(explode(".", basename($name)));
                $name = str_replace('.' . $name_ext, '', basename($name));
                 $uploaddir = "./uploads/";
                $uploaddir2 = "./uploads/";
                $uploadfile = $uploaddir . $fname;
                if (move_uploaded_file($tmp_name, $uploadfile)) {
                    $result["module_type"] = "restaurants";
                    $result["module_id"] = $insert_id;
                    $result["name"] = $name;
                    $result["image"] = $fname;
                    $result["type"] = $_FILES['logo']['type'];
                    $result["size"] = $_FILES['logo']['size'];
                    $return_id = $this->common_model->insert('media', $result);
                     
                }
            }

            $this->session->set_flashdata('error', '<span style="color:green;">Congratulations..! You have added the Restaurant Successfully!</span>');
            redirect('admin/restaurants/index');
        }
    }

    public function uploads($module_id = NULL, $category) {

        $images = $_FILES[$category];

        for ($i = 0; $i < count($images["name"]); $i++) {
            $name = $images["name"][$i];
            $tmp_name = $images["tmp_name"][$i];
            $org_name = $name;
            $type = $images["type"][$i];
            $size = $images["size"][$i];
            //print_r($tmp_name) ; exit;
            if (strlen($name)) {
                $fname = time() . '_' . basename($name);
                $fname = str_replace(" ", "_", $fname);
                $fname = str_replace("%", "_", $fname);
                $name_ext = end(explode(".", basename($name)));
                $name = str_replace('.' . $name_ext, '', basename($name));
                $uploaddir = "./uploads/";
                $uploaddir2 = "./uploads/";
                $uploadfile = $uploaddir . $fname;

                if (move_uploaded_file($tmp_name, $uploadfile)) {

                    $result["module_type"] = "restaurants";
                    $result["module_id"] = $module_id;
                    $result["category"] = $category;
                    $result["name"] = $org_name;
                    $result["image"] = $fname;
                    $result["type"] = $type;
                    $result["size"] = $size;

                    $return_id = $this->common_model->insert('media', $result);

                    print_r($return_id);
                    exit;
                    return $return_id;
                }
            }
        }
    }

}
