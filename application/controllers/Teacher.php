<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('home_model');
        $this->load->model('teacher_model');
        $this->load->helper('function');
        $this->load->library('settings');
	}
	 
	public function index(){
	    redirect(base_url()."view-teachers");
	}
	
	public function view_teachers(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="teacher";
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	   $this->load->view('teacher/view',$this->data);
	}
	
	public function view_teacher($id){
	    try{
	        if(empty($id)){ redirect(base_url()."view-teachers"); }
	        $this->data['id'] = $id;
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="teacher";
    	    
    	    if($this->teacher_model->checkTeacherByID($id)){
    	        
    	        $this->data['getTeacherDetails'] = $this->teacher_model->getTeacherDetails($id);
    	        $this->data['getTeacherDocuments'] = $this->teacher_model->getTeacherDocuments($id);
    	        $this->load->view('teacher/view-details',$this->data);
    	    }else{
    	        redirect(base_url()."view-teachers");
    	    }
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
	}
	
	public function add_teacher(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="teacher";
    	    $this->data['getTeacherCustomFields'] = $this->teacher_model->getTeacherCustomFields();
    	    
    	    $this->data['getTeacherCustomSettings'] = [];
    	    $getTeacherCustomSettings = $this->teacher_model->getTeacherCustomSettings();
    	    foreach($getTeacherCustomSettings as $value){
    	        $this->data['getTeacherCustomSettings'][$value->options] = $value->value;
    	    }
    	    
    	    $this->data['getTeacherCategories'] = $this->teacher_model->getTeacherCategories();
    	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
    	    $this->data['getAllDepartments'] = $this->teacher_model->getAllDepartments();
    	    $this->data['getAllCountries'] = $this->home_model->getAllCountries();
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	$this->load->view('teacher/add-teacher',$this->data);
	}
	
	public function edit_teacher($id){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="teacher";
    	    $this->data['teacher_id'] = $id;
    	    $CheckTeacherByID = $this->teacher_model->CheckTeacherByID($id);
    	    if($CheckTeacherByID){
        	    $this->data['teacher_id'] = $id;
        	        $teacher_edit = array(
                                'name'   => 'teacher_id',
                                'value'  => $id,
                                'expire' => '300000'
                            );
                $this->input->set_cookie($teacher_edit);
        	    $this->data['getTeacherCustomFields'] = $this->teacher_model->getTeacherCustomFields();
        	    $this->data['getTeacherCategories'] = $this->teacher_model->getTeacherCategories();
        	    $this->data['getAllDepartments'] = $this->teacher_model->getAllDepartments();
        	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
        	    $this->data['getAllCountries'] = $this->home_model->getAllCountries();
        	    $this->data['getTeacherDetails'] = $this->teacher_model->getTeacherDetails($id);
        	    $this->data['getStatesByCountry'] = $this->home_model->getStatesByCountry($this->data['getTeacherDetails']);
        	    $this->data['getCitiesByState'] = $this->home_model->getCitiesByState($this->data['getTeacherDetails']);
        	    
    	    }else{
    	        redirect(base_url()."view-teachers");
    	        exit();
    	    }
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	$this->load->view('teacher/edit-teacher',$this->data);
	}
	
	public function edit_teacher_doc($id){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="teacher";
    	    $CheckTeacherByID = $this->teacher_model->CheckTeacherByID($id);
    	    if($CheckTeacherByID){
    	        $this->data['teacher_id'] = $id;
    	        $teacher_edit = array(
                            'name'   => 'teacher_id',
                            'value'  => $id,
                            'expire' => '300000'
                        );
                $this->input->set_cookie($teacher_edit);
    	        $this->data['getTeacherDocuments'] = $this->teacher_model->getTeacherDocuments($id);
    	    }else{
    	        redirect(base_url()."view-teachers");
    	        exit();
    	    }
    	}catch(Exception $ex){
            if(!isset($error_message)){ $error_message = array(); }
            $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
	   }
    	$this->load->view('teacher/edit_teacher_doc',$this->data);
	}
	
	public function customs_settings(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="teacher";
    	    
    	    $this->data['getTeacherCategories'] = $this->teacher_model->getTeacherCategories();
    	    $this->data['getTeacherCustomFields'] = $this->teacher_model->getTeacherCustomFields();
    	    $this->data['getTeacherCustomSettings'] = $this->teacher_model->getTeacherCustomSettings();
    	    
    	}catch(Exception $ex){
            if(!isset($error_message)){ $error_message = array(); }
            $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
	   }
    	   
    	$this->load->view('teacher/customs_settings',$this->data);
	}
	
	public function manage_department(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="teacher";
    	    
    	    $this->data['getAllDepartments'] = $this->teacher_model->getAllDepartmentList();
    	    
    	}catch(Exception $ex){
            if(!isset($error_message)){ $error_message = array(); }
            $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
	   }
    	   
    	$this->load->view('teacher/manage_department',$this->data);
	}

}