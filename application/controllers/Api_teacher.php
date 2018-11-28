<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_teacher extends CI_Controller {
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
        $this->load->model('teacher_model');
        $this->load->model('mailsend');
        $this->load->helper('string');
	}
	
	public function get_all_teacher(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	        if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            $getUserList = $this->teacher_model->getAllTeacherList($request);
            if((is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function get_teacher_list(){
	   //header('Content-type: application/json');
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
    	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
    	     if(empty($postdata)){
                echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
                return true;
            }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=> []));
                return true;
            }
            
            $getUserList = $this->teacher_model->getTeacherList($request);
            if((is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_teacher_pagination(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
            $getUserList = $this->teacher_model->getTeacherPagination($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Total Teachers has been gets Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}

	public function add_teacher(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    if(!isset($request->teacher_id) || !isset($request->doj) || !isset($request->first_name) || !isset($request->last_name) || !isset($request->class_id) || !isset($request->mother_name) 
    || !isset($request->dob) || !isset($request->category_id) || !isset($request->gender) || !isset($request->position) || !isset($request->grade) || !isset($request->father_name) || !isset($request->emergency_contact) 
    || !isset($request->job_title) || !isset($request->qualification) || !isset($request->experience) || !isset($request->experience_details) || !isset($request->password) || !isset($request->nationality) 
    || !isset($request->marital_status) || !isset($request->blood_group) || !isset($request->is_handicapped) || !isset($request->handicap_details) || !isset($request->spouse_name) || !isset($request->email) 
    || !isset($request->address) || !isset($request->country_id) || !isset($request->state_id) || !isset($request->city_id) || !isset($request->pincode) || !isset($request->mobile) || !isset($request->home_phone)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            $this->form_validation->set_rules("teacher_id", "Teacher ID", "trim|required|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("doj", "Joining Date", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            $this->form_validation->set_rules("emergency_contact", "Emergency Contact", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("qualification", "Qualification", "trim|required|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("experience", "Experience", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("city_id", "City", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid City"));
            $this->form_validation->set_rules("state_id", "State", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid State"));
            $this->form_validation->set_rules("country_id", "Country", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            $this->form_validation->set_rules("mother_name", "Mother Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("position", "Position", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("blood_group", "Blood Group", "trim|xss_clean|in_list[A+,A-,B+,B-,O+,O-,AB+,AB-]");
            $this->form_validation->set_rules("is_handicapped", "Is handicapped", "trim|xss_clean|in_list[No,Yes]");
            $this->form_validation->set_rules("grade", "Grade", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("class_id", "Class/Batch", "trim|xss_clean",array("Select valid Class/Batch"));
            $this->form_validation->set_rules("category_id", "Teacher Category", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("father_name", "Father Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("spouse_name", "Spouse Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("home_phone", "Home Phone", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("experience_details", "Experience details", "trim|xss_clean");
            $this->form_validation->set_rules("nationality", "Nationality", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("marital_status", "Marital status", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("job_title", "Job Title", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("handicap_details", "Handicap Details", "trim|xss_clean");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
            
            $CheckUser = $this->teacher_model->CheckTeacherWithDetails($request);
            if(!$CheckUser){
                $request_data = array(
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "teacher_id" => $this->security->xss_clean($request->teacher_id),
                    "doj" => $this->security->xss_clean($request->doj),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "access_key"=> strtolower(uniqid('key_').random_string('alnum',9)),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "department_id"=> $this->security->xss_clean($request->department),
                    "city_id" => $this->security->xss_clean($request->city_id),
                    "state_id" => $this->security->xss_clean($request->state_id),
                    "dob" => $this->security->xss_clean($request->dob),
                    "country_id" => $this->security->xss_clean($request->country_id),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    "blood_group" => $this->security->xss_clean($request->blood_group),
                    "is_handicapped" => $this->security->xss_clean($request->is_handicapped),
                    "handicap_details" => (isset($request->handicap_details))?$this->security->xss_clean($request->handicap_details):'',
                    "nationality" => (isset($request->nationality))?$this->security->xss_clean($request->nationality):'',
                    "category_id" => $this->security->xss_clean($request->category_id),
                    "class_id" => $this->security->xss_clean($request->class_id),
                    "emergency_contact" => $this->security->xss_clean($request->emergency_contact),
                    "qualification" => $this->security->xss_clean($request->qualification),
                    "experience" => $this->security->xss_clean($request->experience),
                    "mother_name" => $this->security->xss_clean($request->mother_name),
                    "position" => $this->security->xss_clean($request->position),
                    "grade" => $this->security->xss_clean($request->grade),
                    "father_name" => $this->security->xss_clean($request->father_name),
                    "spouse_name" => $this->security->xss_clean($request->spouse_name),
                    "home_phone" => $this->security->xss_clean($request->home_phone),
                    "experience_details" => $this->security->xss_clean($request->experience_details),
                    "marital_status" => $this->security->xss_clean($request->marital_status),
                    "job_title" => $this->security->xss_clean($request->job_title),
                    "created_by"=>'1',
                    "status" => "Active",
                );
                
                if(isset($request->customs) and (is_array($request->customs) or is_object($request->customs))){
                    $request_data['customs'] = [];
                    foreach($request->customs as $key=>$value){
                        $request_data['customs'][$key] = $value;
                    }
                }
                
                $url_title = url_title($request->teacher_id, "dash", TRUE);
                $file_url = '';
                
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/teacher/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg|psd';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                    if(!$this->upload->do_upload('file')){
            	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors(),'items'=>[]));
            	         return true;
            	         exit();
        	         }else{
        	             $upload_data = $this->upload->data();
        	             $file_url = $upload_data['file_name'];
        	       }
                }
                
                $request_data['photo'] = $file_url;
                
                $AddNewTeacher = $this->teacher_model->AddNewTeacher($request_data);
                if($AddNewTeacher){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New Teacher Added successfully!','items'=>$AddNewTeacher));
                    return true;
                    exit();
                }else{
                    
                    $db_error = $this->db->error();
                    if (isset($this->config->message)) {
                        echo json_encode(array("code"=>'216',"status"=>"error","message"=>$this->config->message,'items'=>[]));
                        return true;
                        exit();
                    }else{
                        echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                        return true;
                        exit();
                    }
                }
            }else{
                if(isset($CheckUser->teacher_id) and $CheckUser->teacher_id == $request->teacher_id){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Teacher ID is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else if(isset($CheckUser->email) and $CheckUser->email == $request->email){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Email Address is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'217',"status"=>"error","message"=>'This Mobile Number is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_teacher(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id) || empty($request->id)){
                echo json_encode(array("code"=>'230',"status"=>"error","message"=>"Enter a Valid Teacher",'items'=>[]));
                return true;
            }
            
    	    if(!isset($request->id) || !isset($request->teacher_id) || !isset($request->doj) || !isset($request->first_name) || !isset($request->last_name) || !isset($request->class_id) || !isset($request->mother_name) 
    || !isset($request->dob) || !isset($request->category_id) || !isset($request->gender) || !isset($request->position) || !isset($request->grade) || !isset($request->father_name) || !isset($request->emergency_contact) 
    || !isset($request->job_title) || !isset($request->qualification) || !isset($request->experience) || !isset($request->experience_details) || !isset($request->password) || !isset($request->nationality) 
    || !isset($request->marital_status) || !isset($request->blood_group) || !isset($request->is_handicapped) || !isset($request->handicap_details) || !isset($request->spouse_name) || !isset($request->email) 
    || !isset($request->address) || !isset($request->country_id) || !isset($request->state_id) || !isset($request->city_id) || !isset($request->pincode) || !isset($request->mobile) || !isset($request->home_phone)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            $this->form_validation->set_rules("teacher_id", "Teacher ID", "trim|required|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("doj", "Joining Date", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            $this->form_validation->set_rules("emergency_contact", "Emergency Contact", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("qualification", "Qualification", "trim|required|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("experience", "Experience", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("city_id", "City", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid City"));
            $this->form_validation->set_rules("state_id", "State", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid State"));
            $this->form_validation->set_rules("country_id", "Country", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            $this->form_validation->set_rules("mother_name", "Mother Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("position", "Position", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("blood_group", "Blood Group", "trim|xss_clean|in_list[A+,A-,B+,B-,O+,O-,AB+,AB-]");
            $this->form_validation->set_rules("is_handicapped", "Is handicapped", "trim|xss_clean|in_list[No,Yes]");
            $this->form_validation->set_rules("grade", "Grade", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("class_id", "Class/Batch", "trim|xss_clean",array("Select valid Class/Batch"));
            $this->form_validation->set_rules("category_id", "Teacher Category", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("father_name", "Father Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("spouse_name", "Spouse Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("home_phone", "Home Phone", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("experience_details", "Experience details", "trim|xss_clean");
            $this->form_validation->set_rules("nationality", "Nationality", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("marital_status", "Marital status", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("job_title", "Job Title", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("handicap_details", "Handicap Details", "trim|xss_clean");
            $this->form_validation->set_rules("id", "Teacher", "trim|required|xss_clean|numeric",array('Enter a Valid Teacher'));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
             
            $checkTeacherDetailExist = $this->teacher_model->checkTeacherDetailExist($request);
            if($checkTeacherDetailExist){
                if(isset($checkTeacherDetailExist->teacher_id) and $checkTeacherDetailExist->teacher_id == $request->teacher_id){
                    echo json_encode(array("code"=>'218',"status"=>"error","message"=>'This Teacher ID is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else if(isset($checkTeacherDetailExist->email) and $checkTeacherDetailExist->email == $request->email){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Email is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'217',"status"=>"error","message"=>'This Mobile Number is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }
            }
            
            $CheckUser = $this->teacher_model->checkTeacherByID($request->id);
            if($CheckUser){
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "teacher_id" => $this->security->xss_clean($request->teacher_id),
                    "doj" => $this->security->xss_clean($request->doj),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "access_key"=> strtolower(uniqid('key_').random_string('alnum',9)),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "department_id"=> $this->security->xss_clean($request->department_id),
                    "city_id" => $this->security->xss_clean($request->city_id),
                    "state_id" => $this->security->xss_clean($request->state_id),
                    "dob" => $this->security->xss_clean($request->dob),
                    "country_id" => $this->security->xss_clean($request->country_id),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    "blood_group" => $this->security->xss_clean($request->blood_group),
                    "is_handicapped" => $this->security->xss_clean($request->is_handicapped),
                    "handicap_details" => (isset($request->handicap_details))?$this->security->xss_clean($request->handicap_details):'',
                    "nationality" => (isset($request->nationality))?$this->security->xss_clean($request->nationality):'',
                    "category_id" => $this->security->xss_clean($request->category_id),
                    "class_id" => $this->security->xss_clean($request->class_id),
                    "emergency_contact" => $this->security->xss_clean($request->emergency_contact),
                    "qualification" => $this->security->xss_clean($request->qualification),
                    "experience" => $this->security->xss_clean($request->experience),
                    "mother_name" => $this->security->xss_clean($request->mother_name),
                    "position" => $this->security->xss_clean($request->position),
                    "grade" => $this->security->xss_clean($request->grade),
                    "father_name" => $this->security->xss_clean($request->father_name),
                    "spouse_name" => $this->security->xss_clean($request->spouse_name),
                    "home_phone" => $this->security->xss_clean($request->home_phone),
                    "experience_details" => $this->security->xss_clean($request->experience_details),
                    "marital_status" => $this->security->xss_clean($request->marital_status),
                    "job_title" => $this->security->xss_clean($request->job_title),
                    "created_by"=>'1',
                    "status" => "Active",
                );
                
                if(isset($request->customs) and (is_array($request->customs) or is_object($request->customs))){
                    $request_data['customs'] = [];
                    foreach($request->customs as $key=>$value){
                        $request_data['customs'][$key] = $value;
                    }
                }
                
                $url_title = url_title($request->teacher_id, "dash", TRUE);
                $file_url = '';
                
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/teacher/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg|psd';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                    if(!$this->upload->do_upload('file')){
            	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors(),'items'=>$request));
            	         return true;
            	         exit();
        	         }else{
        	             $upload_data = $this->upload->data();
        	             $file_url = $upload_data['file_name'];
        	       }
                }
                
                $request_data['file_url'] = $file_url;
                
                $UpdateTeacher = $this->teacher_model->UpdateTeacher($request_data);
                if($UpdateTeacher){
                    if(isset($UpdateTeacher->password)){
                        $UpdateTeacher->password = $this->encrypt->decode($UpdateTeacher->password);
                    }
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Details Updated successfully!','items'=>$UpdateTeacher));
                    return true;
                    exit();
                }else{
                    $db_error = $this->db->error();
                    if (isset($this->config->message)) {
                        echo json_encode(array("code"=>'216',"status"=>"error","message"=>$this->config->message,'items'=>[]));
                        return true;
                        exit();
                    }else{
                        echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                        return true;
                        exit();
                    }
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'Selected Teacher Does not Exist','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>$request));
            return true;
            exit();
	   }
	}
	
	public function add_teacher_document(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->teacher_id) || !isset($request->doc_name)){
    	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Teacher ID and Doc Name",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("doc_name", "Document name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("teacher_id", "Teacher", "trim|required|xss_clean|numeric",array("Selected Teacher Does not Exist"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
            
            $CheckUser = $this->teacher_model->checkTeacherByID($request->teacher_id);
            if($CheckUser){
                $request_data = array(
                    "teacher_id" => $this->security->xss_clean($request->teacher_id),
                    "doc_name" => $this->security->xss_clean($request->doc_name),
                    "status" => (isset($request->status))?$this->security->xss_clean($request->status):"Waiting",
                );
                
                $url_title = url_title($request->doc_name, "dash", TRUE);
                $url_title = $request->teacher_id.'_'.$url_title.'_'.time();
                
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/documents/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                    if(!$this->upload->do_upload('file')){
            	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors(),'items'=>[]));
            	         return true;
            	         exit();
        	         }else{
        	             $upload_data = $this->upload->data();
        	             $file_url = $upload_data['file_name'];
        	       }
                }else{
                    echo json_encode(array("code"=>'211',"status"=>"error","message"=>"Please Select a Valid Document",'items'=>[]));
                    return true;
                }
                
                $request_data['url'] = $file_url;
                
                $AddTeacherDocuments = $this->teacher_model->AddTeacherDocuments($request_data);
                if($AddTeacherDocuments){
                    $request_data['id'] = $AddTeacherDocuments;
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Document Added successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'Selected Teacher Does not Exist','items'=>[]));
                return true;
                exit();
                
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_teacher_document(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
                echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
                exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
                echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
                exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Item!",'items'=>[]));
                return true;
            }
            
    	    if(!isset($request->teacher_id) || !isset($request->doc_name)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            
            $this->form_validation->set_rules("doc_name", "Document name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("teacher_id", "Student", "trim|required|xss_clean|numeric",array("Selected Teacher Does not Exist"));
            $this->form_validation->set_rules("id", "Item", "trim|required|xss_clean|numeric",array("Select a valid Item!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }
            
            $CheckUser = $this->teacher_model->checkTeacherByID($request->teacher_id);
            if($CheckUser){
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "teacher_id" => $this->security->xss_clean($request->teacher_id),
                    "doc_name" => $this->security->xss_clean($request->doc_name),
                );
                
                $AddStudentPrevious = $this->teacher_model->UpdateTeacherDocument($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Document Details Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'211',"status"=>"error","message"=>'Selected Teacher Does not Exist','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_teacher_custom_settings(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->teacher_id_prefix) || !isset($request->default_teacher_password)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("teacher_id_prefix", "Teacher ID prefix", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("default_teacher_password", "Teacher Password", "trim|required|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
            
                $request_data = array(
                    "teacher_id_prefix" => $this->security->xss_clean($request->teacher_id_prefix),
                    "default_teacher_password" => $this->security->xss_clean($request->default_teacher_password),
                );
                
                $AddTeacherPrevious = $this->teacher_model->UpdateTeacherCustomSettings($request_data);
                if($AddTeacherPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Settings Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function add_teacher_custom_fields(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->name) || !isset($request->type) || !isset($request->required)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("name", "Field Name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("type", "Field Type", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("required", "Required Field", "trim|required|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
             
             $title = str_replace('-','_',url_title($request->name, "dash", TRUE));
             $count = 1;
             $temp_title = $title;
             while($this->teacher_model->CheckTeacherTitleInCustom($temp_title)){
                 $temp_title = $title."_".$count;
                 $count++;
             }
             
                $request_data = array(
                    "name" => $this->security->xss_clean($request->name),
                    "type" => $this->security->xss_clean($request->type),
                    "required" => $this->security->xss_clean($request->required),
                    "title" => $temp_title,
                    "used_for" => "Teacher",
                    "status" => "Active"
                );
                
                $AddTeacherPrevious = $this->teacher_model->AddTeacherCustomFields($request_data);
                if($AddTeacherPrevious){
                    $request_data['id'] = $AddTeacherPrevious;
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Custom Field Added successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_teacher_custom_fields(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Select valid Custom Field!",'items'=>[]));
                return true;
            }
            
    	    if(!isset($request->name) || !isset($request->type) || !isset($request->required) || !isset($request->title) || !isset($request->status)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("name", "Name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("type", "Type", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("required", "Required", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("id", "Custom Field", "trim|required|xss_clean|numeric|max_length[255]",array("Select valid Custom Field!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
             
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "name" => $this->security->xss_clean($request->name),
                    "type" => $this->security->xss_clean($request->type),
                    "required" => $this->security->xss_clean($request->required),
                    "title" => $this->security->xss_clean($request->title),
                    "status" => $this->security->xss_clean($request->status),
                );
                
                $AddTeacherPrevious = $this->teacher_model->UpdateTeacherCustomFields($request_data);
                if($AddTeacherPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Custom Field Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_teacher_custom_fields(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Teacher ID!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id) || empty($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Field From List!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->teacher_model->deleteTeacherCustomField($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Custom Field Deleted Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Error Occured','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function add_teacher_category(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter a Category Name!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->name)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Enter a Category Name",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("name", "Category name", "trim|required|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
             
                $request_data = array(
                    "name" => $this->security->xss_clean($request->name),
                    "status" => "Active"
                );
                
                $AddTeacherPrevious = $this->teacher_model->AddTeacherCategory($request_data);
                if($AddTeacherPrevious){
                    $request_data['id'] = $AddTeacherPrevious;
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Category Added successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_teacher_category(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Select valid Category!",'items'=>[]));
                return true;
            }
            
    	    if(!isset($request->name) || !isset($request->status)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Select valid Category",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("name", "Name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("id", "Custom Field", "trim|required|xss_clean|numeric|max_length[255]",array("Select valid Category!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
             
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "name" => $this->security->xss_clean($request->name),
                    "status" => $this->security->xss_clean($request->status),
                );
                
                $AddTeacherPrevious = $this->teacher_model->UpdateTeacherCategory($request_data);
                if($AddTeacherPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Category Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_teacher_category(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Select a valid Caetgory!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Caetgory",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->teacher_model->deleteTeacherCategory($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Category Deleted Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Error Occured','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function add_teacher_department(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter a Department Name!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->name) || !isset($request->code)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Enter a Department Name and Code",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("name", "Department name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("code", "Department Code", "trim|required|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
             
                $request_data = array(
                    "name" => $this->security->xss_clean($request->name),
                    "code" => $this->security->xss_clean($request->code),
                    "status" => "Active"
                );
                
                $AddTeacherPrevious = $this->teacher_model->AddTeacherDepartment($request_data);
                if($AddTeacherPrevious){
                    $request_data['id'] = $AddTeacherPrevious;
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Department Added successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_teacher_department(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	        function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
            function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Select valid Department!",'items'=>[]));
                return true;
            }
            
    	    if(!isset($request->name) || !isset($request->status) || !isset($request->code)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Fill all the Required Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("name", "Name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("id", "Custom Field", "trim|required|xss_clean|numeric|max_length[255]",array("Select valid Department!"));
            $this->form_validation->set_rules("code", "Department Code", "trim|required|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
             
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "name" => $this->security->xss_clean($request->name),
                    "code" => $this->security->xss_clean($request->code),
                    "status" => $this->security->xss_clean($request->status),
                );
                
                $AddTeacherPrevious = $this->teacher_model->UpdateTeacherDepartment($request_data);
                if($AddTeacherPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Department Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_teacher_department(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Select a valid Department!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Department",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->teacher_model->deleteTeacherDepartment($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Department Deleted Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Error Occured','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_teacher_status(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Teacher!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("id", "Teacher", "trim|required|xss_clean|numeric",array("Select a valid Teacher!"));
            $this->form_validation->set_rules("status", "Status", "trim|required|xss_clean",array("Select a valid Status!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }

                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "status" => $this->security->xss_clean($request->status)
                );
                
                $CheckUser = $this->teacher_model->checkTeacherByID($request->id);
                if(!$CheckUser){
                    echo json_encode(array("code"=>'211',"status"=>"error","message"=>'Selected Teacher Does not Exist','items'=>[]));
                    return true;
                    exit();
                }
                
                $AddTeacherPrevious = $this->teacher_model->UpdateTeacherStataus($request_data);
                if($AddTeacherPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Status has been Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_teacher(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Select a Valid Teacher!",'items'=>[]));
            return true;
        }else{
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a Valid Teacher!",'items'=>[]));
                return true;
            }
            $CheckUser = $this->teacher_model->checkTeacherByID($request->id);
            if(!$CheckUser){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Selected Teacher Does not Exist",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->teacher_model->deleteTeacherDetails($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Details Deleted Successfully!','items'=>[]));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Error Occured','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_teacher_document_status_approved(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a correct Document!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("id", "Item", "trim|required|xss_clean|numeric",array("Select a correct Document!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }

                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "status" => 'Approved'
                );
                
                $AddTeacherPrevious = $this->teacher_model->UpdateTeacherDocumentStataus($request_data);
                if($AddTeacherPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Document has been Approved!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_teacher_document_status_disapproved(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a correct Document!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("id", "Item", "trim|required|xss_clean|numeric",array("Select a correct Document!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }

                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "status" => 'Disapproved'
                );
                
                $AddTeacherPrevious = $this->teacher_model->UpdateTeacherDocumentStataus($request_data);
                if($AddTeacherPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Document has been Disapproved!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_teacher_document(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Teacher ID!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Item From List!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->teacher_model->deleteDocumentID($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Document Deleted Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Error Occured','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function delete_teacher_photo(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Select a Valid Teacher!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a Valid Teacher",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->teacher_model->deleteTeacherPhoto($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Teacher Photo has been Deleted Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Error Occured','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function assign_parent(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->teacher_id) || !isset($request->parent_id) || empty($request->parent_id)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the required Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("teacher_id", "teacher_id", "trim|required|xss_clean|numeric",array("Select a valid Teacher"));
            $this->form_validation->set_rules("parent_id[]", "Parent", "trim|required|xss_clean|numeric",array("Select a valid Parent"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
            }
            //CheckParentByID();
            //checkTeacherByID();
            
            $CheckUser = $this->teacher_model->checkTeacherByID($request->teacher_id);
            if($CheckUser){
                foreach($request->parent_id as $value){
                    $CheckParent = $this->teacher_model->CheckParentByID($value);
                    if($CheckParent){
                        $assignParent = $this->teacher_model->assignParent($value,$request->teacher_id);
                        if(!$assignParent){
                            echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                            return true;
                            exit();
                        }
                    }else{
                        echo json_encode(array("code"=>'217',"status"=>"error","message"=>'Select a valid Parent','items'=>[]));
                        return true;
                        exit();
                    }
                }
                
                if($assignParent){
                        echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Parent Assigned successfully!','items'=>[]));
                        return true;
                        exit();
                    }else{
                        echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                        return true;
                        exit();
                    }
                
            }else{
                echo json_encode(array("code"=>'217',"status"=>"error","message"=>'Select a valid Teacher','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function get_parents_details(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Teacher ID!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter Parent ID!",'items'=>[]));
                return true;
            }
            
            $CheckParent = $this->teacher_model->CheckParentByID($request->id);
            if(!$CheckParent){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter Valid Parent ID!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->teacher_model->getParentDetailsByID($request->id);
            if((is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Parents Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>$getUserList));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	

}