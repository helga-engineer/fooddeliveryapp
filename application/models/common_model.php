<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /////******************** login function 
    function login($username, $password) {
       
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $username);
        $this->db->where('password', MD5($password));
        $this->db->where("user_type",'user');
        $this->db->where('active', '1');
        $this->db->limit(1);

        $query = $this->db->get();
        /* echo $this->db->last_query();
          exit; */
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    ////*************
    function query($query) {
        return $this->db->query($query);
    }

    /////******************** admin login function 
    function admin_login($email, $password) {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        //$this -> db -> where('password', MD5($password));
        $this->db->where('password', $password);
        $this->db->where('user_type', 'admin');
        

        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

/////***************** Get user type 	
    function get_user_type($id) {


        $this->db->select('user_type');
        $this->db->from('users');
        $this->db->where('id', $id);


        $query = $this->db->get();
        /* echo $this->db->last_query();
          exit; */
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->user_role;
        } else {
            return false;
        }
    }

/////*************
/////*************
    function get_where($tablename, $column, $id = NULL) {
        $WHERE = "";
        if ($id != NULL) {
            $WHERE = "WHERE `$column` = $id";
        }
        $result = $this->db->query("
			SELECT *
			FROM $tablename
			$WHERE
		");
        return $result;
    }

/////***************** Edit Record Function 	
    function editRecord($columName, $where, $tbl_name, $data) {
        $this->db->where($columName, $where);
        $this->db->update($tbl_name, $data);
    }

////*********************** get record of user table 
    function user_result($tablename, $id = NULL) {
        $WHERE = "";
        if ($id != NULL) {
            $WHERE = "WHERE user_id = $id";
        }
        $result = $this->db->query("
			SELECT *
			FROM $tablename
			$WHERE
		");
        return $result;
    }

////*********************** get record of table 
    function result($tablename, $id = NULL) {
        $WHERE = "";
        if ($id != NULL) {
            $WHERE = "WHERE id = $id";
        }
        $result = $this->db->query("
			SELECT *
			FROM $tablename
			$WHERE
		");
        return $result;
    }

/////************************ insert into
    function insert($tbl_name, $data) {
        $this->db->insert($tbl_name, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /////************************ update into
    function update($tbl_name, $data) {
        $this->db->update($tbl_name, $data);
    }

/////************************ email exists
    function email_exit($email) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);

        $query = $this->db->get();

        return $query;
    }

/////************************ delete
    function delete($column, $id, $table) {
        $this->db->where($column, $id);
        $this->db->delete($table);

        //$query = $this -> db -> get();

        return $query;
    }


    ////*********** user max id
    function user_max_id() {
        $this->db->select('max(id) as id');
        $this->db->from('users');
        $user_id = $this->db->get();
        $user_id = $user_id->row();
        $user_id = $user_id->id;
        return $user_id + 1;
    }

    ///////******** delete where where
    function deleteWhereWhere($column, $id, $column1, $id1, $column2, $id2, $table) {
        $this->db->where($column, $id);
        $this->db->where($column1, $id1);
        $this->db->where($column2, $id2);
        $this->db->delete($table);

        //$query = $this -> db -> get();

        return $query;
    }

    /////////// Get All Countries////////
    function getCountries(){
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where('active','1');
        $query = $this->db->get();
        return $query;
    }
    
    /////////Get Cities By Country ID/////////
    function getCitiesByCountryId($country_id){
        $this->db->select('*');
        $this->db->from('country_zones');
        $this->db->where('country_id',$country_id);
        $this->db->where('active','1');
        $query = $this->db->get();
        return $query;
    }
  
    function getCategories(){
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('active','Active');
        $query = $this->db->get();
        return $query;
    }
    
    function getRestaurants($userID){
        $this->db->select('*');
        $this->db->from('restaurants');
        $this->db->where('user_id',$userID);
        $query = $this->db->get();
        return $query;
    }
    function getById($id){
        $this->db->select('*');
        $this->db->from('restaurants');
        $this->db->join('media', 'media.module_id = restaurants.id', 'left');
        $this->db->where('restaurants.id',$id);
        $query = $this->db->get();
        return $query;
    }
   

}
