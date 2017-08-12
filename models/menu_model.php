<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
     function getMenuCategoryByID($id){
        $this->db->select('*');
        $this->db->from('restaurant_menu_categories');
        $this->db->where('restaurant_id',$id);
        $this->db->where('status','Active');
        $query = $this->db->get();
        return $query;
    }
    
    function getCategoryByMenuAndRestaurantID($id,$restaurant_id){
        $this->db->select('*');
        $this->db->from('restaurant_menu_categories');
        $this->db->where('id',$id);
        $this->db->where('restaurant_id',$restaurant_id);
        $query = $this->db->get();
        return $query;
    }
    
    function getMenuItems($menu_id){
        $this->db->select('*');
        $this->db->from('menu_items');
        $this->db->where('menu_id',$menu_id);
        $query = $this->db->get();
        return $query;
    }
    
    function getAllMenus($restaurant_id){
        $this->db->select('*');
        $this->db->from('menus');
        $this->db->where('restaurant_id',$restaurant_id);
        $query = $this->db->get();
        return $query;
    }
    
    function getAllMenusByRestaurantID($id,$restaurant_id){
        $this->db->select('*');
        $this->db->from('menus');
        $this->db->where('id',$id);
        $this->db->where('restaurant_id',$restaurant_id);
        $query = $this->db->get();
        return $query;
    }
    
    
}
