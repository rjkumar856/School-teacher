<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
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
		$this->load->library('session');
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->library('email');
        $this->load->model('home_model');
        $this->load->helper('function');
        $data['activepage']="";
	}
	 
	public function index(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $data['activepage']="home";
    	    $data['getAllBirthDay'] = $this->home_model->getAllBirthDay();
    	    $data['getAllStudentsWithAttendance'] = $this->home_model->getAllStudentsWithAttendance();
    	    $data['getAllTeacherssWithAttendance'] = $this->home_model->getAllTeacherssWithAttendance();
    	    $data['getAllNews'] = $this->home_model->getAllNews();
    	    $data['getAllEventsToday'] = $this->home_model->getAllEventsToday();
    	    $data['getAllEventsWeek'] = $this->home_model->getAllEventsWeek();
    	    $data['getAllEventsMonth'] = $this->home_model->getAllEventsMonth();
    	    $data['getAllEventsNextMonth'] = $this->home_model->getAllEventsNextMonth();
    	    $data['getAllHolidays'] = $this->home_model->getAllHolidays();
    	    
    		$this->load->view('home_page',$data);
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
	}
	

}