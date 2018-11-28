<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_form extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check_login($data){
        $sql = "SELECT * FROM user WHERE userid='$data' OR email='$data' OR phone='$data' ";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function get_login_details($data){
        $sql = "SELECT * FROM user WHERE userid='$data' OR email='$data' OR phone='$data' ";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function get_login_details_by_id($data){
        $sql = "SELECT * FROM user WHERE id='$data' ";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function post_forgot_password($data){
        $this->db->insert('forgot_password_request',$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function check_mobile($id,$mobile){
        $sql = "SELECT * FROM user WHERE id!='$id' AND phone='$mobile' ";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function check_email($id,$email){
        $sql = "SELECT * FROM user WHERE id!='$id' AND email='$email' ";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    public function update_userDetails($id,$data){
        $sql = "UPDATE user SET full_name='$data[full_name]',phone='$data[phone]',city='$data[city]',address='$data[address]',ip='$data[ip]' WHERE id='$id'";
        return $this->db->query($sql);
    }
    
    public function Reset_Password($data){
        $password = md5($data['password']);
        $sql = "UPDATE user SET password='$password' WHERE id='$data[id]'";
        return $this->db->query($sql);
    }
    
    public function submit_signup($data){
        $this->db->insert('user',$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function get_ongoing_order($data){
        $sql = "SELECT *,od.status as orderStatus FROM orders od LEFT JOIN be_category bc ON bc.id=od.id WHERE od.user_id='$data' GROUP BY od.id";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function get_order_history($data,$start=1){
        $sql = "SELECT * FROM orders WHERE user_id='$data' LIMIT $start, 10";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
}