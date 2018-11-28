<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/Settings
	 *	- or -
	 * 		http://example.com/index.php/Settings/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		$CI =& get_instance();
	}
	
	public function load_settings(){
	    try{
	        
	        set_error_handler("errorHandlerCatchUndefinedIndex");
	        set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	        $CI =& get_instance();
    	    $CI->data['activepage']="home";
    	    
    	    $CI->load->model('home_model');
    	    
    	    if(!isset($CI->session->academic_year)){
    	        if($AcademicYear = $CI->home_model->getCurrentAcademicYear()){
    	            $CI->session->academic_year = $AcademicYear->id;
    	        }else{
    	            $CI->session->academic_year = 1;
    	        }
    	     }
    	    
    	    $CI->data['getAllAcademicYear'] = $CI->home_model->getAllAcademicYear();
    	    
    	}catch(Exception $ex){
            if(!isset($error_message)){ $error_message = array(); }
            $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
	   }
	}

}