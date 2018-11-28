<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
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
        $this->load->model('mailsend');
        $this->load->helper('string');
	}
	
	public function not_found(){
	   //header('Content-type: application/json');
	     try{
            echo json_encode(array("code"=>'404',"status"=>"error","message"=>'Page not found','items'=>[]));
            return true;
            exit();
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'404',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function get_all_student(){
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
            
            $getUserList = $this->home_model->getAllStudentList($request);
            if((is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Listed Successfully!','items'=>$getUserList));
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
	
	public function get_student(){
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
            
            $getUserList = $this->home_model->getStudentList($request);
            if((is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Listed Successfully!','items'=>$getUserList));
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
	
	public function get_student_pagination(){
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
            $getUserList = $this->home_model->getStudentPagination($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Total Student has been gets Successfully!','items'=>$getUserList));
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
	
	public function get_parents_list(){
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
                $request->page = 1;
                $request->limit = 50;
            }
            
            $getUserList = $this->home_model->getParentList($request);
            if((is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Parents Listed Successfully!','items'=>$getUserList));
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
	
	public function get_parent_pagination(){
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
            $getUserList = $this->home_model->getParentPagination($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Total Parent has been gets Successfully!','items'=>$getUserList));
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
	
	public function get_states_by_country(){
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
            
    	    if(!isset($request->country_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Country ID!",'items'=> []));
                return true;
            }
            
            $getUserList = $this->home_model->getStatesByCountry($request);
            if((is_object($getUserList) || is_array($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'States Listed Successfully!','items'=>$getUserList));
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
	
	public function get_cities_by_state(){
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
            
    	    if(!isset($request->state_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the State ID!",'items'=> []));
                return true;
            }
            
            $getUserList = $this->home_model->getCitiesByState($request);
            if((is_object($getUserList) || is_array($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'City Listed Successfully!','items'=>$getUserList));
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
	
	public function add_student(){
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
            
    	    if(!isset($request->admission_number) || !isset($request->admission_date) || !isset($request->first_name) || !isset($request->last_name) || !isset($request->middle_name)
    	    || !isset($request->roll_number) || !isset($request->class) || !isset($request->dob) || !isset($request->gender) || !isset($request->address) 
    	    || !isset($request->city) || !isset($request->country) || !isset($request->email) || !isset($request->mobile) || !isset($request->is_handicapped)
    	    || !isset($request->password) || !isset($request->pincode) || !isset($request->state) || !isset($request->student_category)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>$request));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            
            $this->form_validation->set_rules("roll_number", "Roll Number", "trim|required|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("admission_number", "Admission Number", "trim|required|xss_clean|numeric|max_length[255]");
            $this->form_validation->set_rules("admission_date", "Admission Date", "trim|required|xss_clean");
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            
            $this->form_validation->set_rules("city", "City", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid City"));
            $this->form_validation->set_rules("state", "State", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid State"));
            $this->form_validation->set_rules("country", "Country", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            
            $this->form_validation->set_rules("middle_name", "Middle Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("birth_place", "Birth Place", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("blood_group", "Blood Group", "trim|xss_clean|in_list[A+,A-,B+,B-,O+,O-,AB+,AB-]");
            $this->form_validation->set_rules("is_handicapped", "Is handicapped", "trim|xss_clean|in_list[No,Yes]");
            $this->form_validation->set_rules("language", "Language", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("religion", "Religion", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("class", "Class/Batch", "trim|xss_clean|numeric|max_length[11]",array("Select valid Class/Batch"));
            $this->form_validation->set_rules("student_category", "Student Category", "trim|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }
            
            $CheckUser = $this->home_model->CheckStudentWithDetails($request);
            if(!$CheckUser){
                $request_data = array(
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "roll_number" => $this->security->xss_clean($request->roll_number),
                    "admission_number" => $this->security->xss_clean($request->admission_number),
                    "doj" => $this->security->xss_clean($request->admission_date),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "middle_name" => $this->security->xss_clean($request->middle_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "access_key"=> strtolower(uniqid('key_').random_string('alnum',9)),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city),
                    "state_id" => $this->security->xss_clean($request->state),
                    "dob" => $this->security->xss_clean($request->dob),
                    "country_id" => $this->security->xss_clean($request->country),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    "birth_place" => $this->security->xss_clean($request->birth_place),
                    "blood_group" => $this->security->xss_clean($request->blood_group),
                    "is_handicapped" => $this->security->xss_clean($request->is_handicapped),
                    "handicap_details" => (isset($request->handicap_details))?$this->security->xss_clean($request->handicap_details):'',
                    "nationality" => (isset($request->nationality))?$this->security->xss_clean($request->nationality):'',
                    "language" => $this->security->xss_clean($request->language),
                    "religion" => $this->security->xss_clean($request->religion),
                    "student_category" => $this->security->xss_clean($request->student_category),
                    "class_id" => $this->security->xss_clean($request->class),
                    "created_by"=>'',
                    "status" => "Active",
                );
                
                if(isset($request->customs) and (is_array($request->customs) or is_object($request->customs))){
                    $request_data['customs'] = [];
                    foreach($request->customs as $key=>$value){
                        $request_data['customs'][$key] = $value;
                    }
                }
                
                $url_title = url_title($request->roll_number, "dash", TRUE);
                $file_url = '';
                
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/student/';
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
                
                $request_data['photo'] = $file_url;
                
                $AddNewStudent = $this->home_model->AddNewStudent($request_data);
                if($AddNewStudent){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New Student Added successfully!','items'=>$AddNewStudent));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                if(isset($CheckUser->roll_number) and $CheckUser->roll_number == $request->roll_number){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Roll number is already used in other user!','items'=>$CheckUser));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'217',"status"=>"error","message"=>'This Admission Number is already used in other user!','items'=>$CheckUser));
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
	
	public function update_student(){
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
            
            if(!isset($request->student_id)){
                echo json_encode(array("code"=>'230',"status"=>"error","message"=>"Enter a Student ID",'items'=>[]));
                return true;
            }
            
    	    if(!isset($request->admission_number) || !isset($request->doj) || !isset($request->first_name) || !isset($request->last_name) || !isset($request->middle_name)
    	    || !isset($request->roll_number) || !isset($request->class_id) || !isset($request->dob) || !isset($request->gender) || !isset($request->address) 
    	    || !isset($request->city_id) || !isset($request->country_id) || !isset($request->email) || !isset($request->mobile) || !isset($request->is_handicapped)
    	    || !isset($request->password) || !isset($request->pincode) || !isset($request->state_id) || !isset($request->student_category)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>$request));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            
            $this->form_validation->set_rules("roll_number", "Roll Number", "trim|required|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("admission_number", "Admission Number", "trim|required|xss_clean|numeric|max_length[255]");
            $this->form_validation->set_rules("doj", "Admission Date", "trim|required|xss_clean");
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            
            $this->form_validation->set_rules("city_id", "City", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid City"));
            $this->form_validation->set_rules("state_id", "State", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid State"));
            $this->form_validation->set_rules("country_id", "Country", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            
            $this->form_validation->set_rules("middle_name", "Middle Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("birth_place", "Birth Place", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("blood_group", "Blood Group", "trim|xss_clean|in_list[A+,A-,B+,B-,O+,O-,AB+,AB-]");
            $this->form_validation->set_rules("is_handicapped", "Is handicapped", "trim|xss_clean|in_list[No,Yes]");
            $this->form_validation->set_rules("language", "Language", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("religion", "Religion", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("class_id", "Class/Batch", "trim|xss_clean|numeric|max_length[11]",array("Select valid Class/Batch"));
            $this->form_validation->set_rules("student_category", "Student Category", "trim|xss_clean|max_length[255]");
            
            $this->form_validation->set_rules("student_id", "Student", "trim|required|xss_clean|numeric",array("Selected Student Does not Exist"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }
             
            $checkStudentDetailExist = $this->home_model->checkStudentDetailExist($request);
            if($checkStudentDetailExist){
                if(isset($checkStudentDetailExist->roll_number) and $checkStudentDetailExist->roll_number == $request->roll_number){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Roll number is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'217',"status"=>"error","message"=>'This Admission Number is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }
            }
            
            $CheckUser = $this->home_model->checkStudentByID($request->student_id);
            if($CheckUser){
                $request_data = array(
                    "student_id" => $this->security->xss_clean($request->student_id),
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "roll_number" => $this->security->xss_clean($request->roll_number),
                    "admission_number" => $this->security->xss_clean($request->admission_number),
                    "doj" => date('Y-m-d',strtotime($request->doj)),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "middle_name" => $this->security->xss_clean($request->middle_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "access_key"=> strtolower(uniqid('key_').random_string('alnum',9)),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city_id),
                    "state_id" => $this->security->xss_clean($request->state_id),
                    "dob" => date('Y-m-d',strtotime($request->dob)),
                    "country_id" => $this->security->xss_clean($request->country_id),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    "birth_place" => $this->security->xss_clean($request->birth_place),
                    "blood_group" => $this->security->xss_clean($request->blood_group),
                    "is_handicapped" => $this->security->xss_clean($request->is_handicapped),
                    "handicap_details" => (isset($request->handicap_details))?$this->security->xss_clean($request->handicap_details):'',
                    "nationality" => (isset($request->nationality))?$this->security->xss_clean($request->nationality):'',
                    "language" => $this->security->xss_clean($request->language),
                    "religion" => $this->security->xss_clean($request->religion),
                    "student_category" => $this->security->xss_clean($request->student_category),
                    "class_id" => $this->security->xss_clean($request->class_id),
                    "created_by"=>'',
                );
                
                if(isset($request->customs) and (is_array($request->customs) or is_object($request->customs))){
                    $request_data['customs'] = [];
                    foreach($request->customs as $key=>$value){
                        $request_data['customs'][$key] = $value;
                    }
                }
                
                $url_title = url_title($request->roll_number, "dash", TRUE);
                $file_url = '';
                
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/student/';
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
                
                $AddNewStudent = $this->home_model->UpdateStudent($request_data);
                if($AddNewStudent){
                    if(isset($AddNewStudent->password)){
                        $AddNewStudent->password = $this->encrypt->decode($AddNewStudent->password);
                    }
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Details Updated successfully!','items'=>$AddNewStudent));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'Selected Student Does not Exist','items'=>[]));
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
	
	public function add_student_document(){
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
            
    	    if(!isset($request->student_id) || !isset($request->doc_name)){
    	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Student ID and Doc Name",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("doc_name", "Document name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("student_id", "Student", "trim|required|xss_clean|numeric",array("Selected Student Does not Exist"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
            
            $CheckUser = $this->home_model->checkStudentByID($request->student_id);
            if($CheckUser){
                $request_data = array(
                    "student_id" => $this->security->xss_clean($request->student_id),
                    "doc_name" => $this->security->xss_clean($request->doc_name),
                    "status" => (isset($request->status))?$this->security->xss_clean($request->status):"Waiting",
                );
                
                $url_title = url_title($request->doc_name, "dash", TRUE);
                $url_title = $request->student_id.'_'.$url_title.'_'.time();
                
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
                
                $AddStudentDocuments = $this->home_model->AddStudentDocuments($request_data);
                if($AddStudentDocuments){
                    $request_data['id'] = $AddStudentDocuments;
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Document Added successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'Selected Student Does not Exist','items'=>[]));
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
	
	public function add_parent(){
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
            
    	    if(!isset($request->first_name) || !isset($request->last_name) || !isset($request->relationship)
    	    || !isset($request->education) || !isset($request->occupation) || !isset($request->dob) || !isset($request->gender) || !isset($request->address) 
    	    || !isset($request->city) || !isset($request->country) || !isset($request->email) || !isset($request->mobile) || !isset($request->income)
    	    || !isset($request->password) || !isset($request->pincode) || !isset($request->state) || !isset($request->office_phone)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            $this->form_validation->set_rules("relationship", "Relation", "trim|required|xss_clean|in_list[Father,Mother,Others]");
            
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            $this->form_validation->set_rules("city", "City", "trim|required|xss_clean|numeric",array("Select valid City"));
            $this->form_validation->set_rules("state", "State", "trim|required|xss_clean|numeric",array("Select valid State"));
            $this->form_validation->set_rules("country", "Country", "trim|required|xss_clean|numeric",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            
            $this->form_validation->set_rules("education", "Education", "trim|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("occupation", "Occupation", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("income", "Income", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("office_phone", "Office phone", "trim|xss_clean|alpha_dash|max_length[20]");
            
            $this->form_validation->set_rules("student_id", "Student", "trim|required|xss_clean|numeric",array("Selected Student Does not Exist"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }
            
            $CheckUser = $this->home_model->CheckParentWithDetails($request);
            if(!$CheckUser){
                $request_data = array(
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "student_id" => $this->security->xss_clean($request->student_id),
                    "office_phone" => $this->security->xss_clean($request->office_phone),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "access_key"=> strtolower(uniqid('key_').random_string('alnum',9)),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city),
                    "state_id" => $this->security->xss_clean($request->state),
                    "dob" => $this->security->xss_clean($request->dob),
                    "country_id" => $this->security->xss_clean($request->country),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    
                    "relationship" => $this->security->xss_clean($request->relationship),
                    "education" => $this->security->xss_clean($request->education),
                    "occupation" => $this->security->xss_clean($request->occupation),
                    "income" => $this->security->xss_clean($request->income),
                    "role" => "All",
                    "created_by"=>"1",
                    "status" => "Active",
                );
                
                $AddNewStudent = $this->home_model->AddNewParent($request_data);
                if($AddNewStudent){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New Parent Added successfully!','items'=>$AddNewStudent));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                if(isset($CheckUser->mobile) and $CheckUser->mobile == $request->mobile){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Mobile number is already used in other parent!','items'=>$CheckUser));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'217',"status"=>"error","message"=>'This Email is already used in other parent!','items'=>$CheckUser));
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
	
	public function add_student_previous(){
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
            
    	    if(!isset($request->student_id) || !isset($request->institue_name) || !isset($request->institue_address)
    	    || !isset($request->course) || !isset($request->year) || !isset($request->total_mark) || !isset($request->reason_for_change)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            
            $this->form_validation->set_rules("institue_name", "institue_name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("institue_address", "Address", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("course", "course", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("year", "year", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("total_mark", "total_mark", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("reason_for_change", "reason_for_change", "trim|xss_clean");
            $this->form_validation->set_rules("student_id", "Student", "trim|required|xss_clean|numeric",array("Selected Student Does not Exist"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }
            
            $CheckUser = $this->home_model->checkStudentByID($request->student_id);
            if($CheckUser){
                $request_data = array(
                    "student_id" => $this->security->xss_clean($request->student_id),
                    "institue_name" => $this->security->xss_clean($request->institue_name),
                    "institue_address" => $this->security->xss_clean($request->institue_address),
                    "course" => $this->security->xss_clean($request->course),
                    "year" => $this->security->xss_clean($request->year),
                    "total_mark" => $this->security->xss_clean($request->total_mark),
                    "reason_for_change" => $this->security->xss_clean($request->reason_for_change),
                );
                
                $AddStudentPrevious = $this->home_model->AddStudentPrevious($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New Student Previous Details Added successfully!','items'=>$AddStudentPrevious));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'211',"status"=>"error","message"=>'Selected Student Does not Exist','items'=>[]));
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
	
	public function update_student_previous(){
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
            
    	    if(!isset($request->student_id) || !isset($request->institue_name) || !isset($request->institue_address)
    	    || !isset($request->course) || !isset($request->year) || !isset($request->total_mark) || !isset($request->reason_for_change)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            
            $this->form_validation->set_rules("institue_name", "Institue name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("institue_address", "Address", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("course", "Course", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("year", "Year", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("total_mark", "Total mark", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("reason_for_change", "Reason for change", "trim|xss_clean");
            $this->form_validation->set_rules("student_id", "Student", "trim|required|xss_clean|numeric",array("Selected Student Does not Exist"));
            $this->form_validation->set_rules("id", "Item", "trim|required|xss_clean|numeric",array("Select a valid Item!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
            
            $CheckUser = $this->home_model->checkStudentByID($request->student_id);
            if($CheckUser){
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "student_id" => $this->security->xss_clean($request->student_id),
                    "institue_name" => $this->security->xss_clean($request->institue_name),
                    "institue_address" => $this->security->xss_clean($request->institue_address),
                    "course" => $this->security->xss_clean($request->course),
                    "year" => $this->security->xss_clean($request->year),
                    "total_mark" => $this->security->xss_clean($request->total_mark),
                    "reason_for_change" => $this->security->xss_clean($request->reason_for_change),
                );
                
                $AddStudentPrevious = $this->home_model->UpdateStudentPrevious($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Previous Details Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'211',"status"=>"error","message"=>'Selected Student Does not Exist','items'=>[]));
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
	
	
	public function update_student_custom_settings(){
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
            
    	    if(!isset($request->student_roll_number_prefix) || !isset($request->default_student_password) || !isset($request->default_parent_password)){
                echo json_encode(array("code"=>'232',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("student_roll_number_prefix", "Institue name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("default_student_password", "Address", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("default_parent_password", "Course", "trim|required|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
            
                $request_data = array(
                    "student_roll_number_prefix" => $this->security->xss_clean($request->student_roll_number_prefix),
                    "default_student_password" => $this->security->xss_clean($request->default_student_password),
                    "default_parent_password" => $this->security->xss_clean($request->default_parent_password),
                );
                
                $AddStudentPrevious = $this->home_model->UpdateStudentCustomSettings($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Settings Updated successfully!','items'=>$request_data));
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
	
	public function add_student_custom_fields(){
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
             while($this->home_model->CheckStudentTitleInCustom($temp_title)){
                 $temp_title = $title."_".$count;
                 $count++;
             }
             
                $request_data = array(
                    "name" => $this->security->xss_clean($request->name),
                    "type" => $this->security->xss_clean($request->type),
                    "required" => $this->security->xss_clean($request->required),
                    "title" => $temp_title,
                    "status" => "Active"
                );
                
                $AddStudentPrevious = $this->home_model->AddStudentCustomFields($request_data);
                if($AddStudentPrevious){
                    $request_data['id'] = $AddStudentPrevious;
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Custom Field Added successfully!','items'=>$request_data));
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
	
	public function update_student_custom_fields(){
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
                
                $AddStudentPrevious = $this->home_model->UpdateStudentCustomFields($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Custom Field Updated successfully!','items'=>$request_data));
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
	
	public function delete_student_custom_fields(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Field From List!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->home_model->deleteStudentCustomField($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Custom Field Deleted Successfully!','items'=>$getUserList));
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
	
	public function add_student_category(){
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
                
                $AddStudentPrevious = $this->home_model->AddStudentCategory($request_data);
                if($AddStudentPrevious){
                    $request_data['id'] = $AddStudentPrevious;
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Category Added successfully!','items'=>$request_data));
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
	
	public function update_student_category(){
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
                
                $AddStudentPrevious = $this->home_model->UpdateStudentCategory($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Category Updated successfully!','items'=>$request_data));
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
	
	public function delete_student_category(){
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
            
            $getUserList = $this->home_model->deleteStudentCategory($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Category Deleted Successfully!','items'=>$getUserList));
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
	
	public function update_parent(){
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
            
    	    if(!isset($request->first_name) || !isset($request->last_name) || !isset($request->relationship)
    	    || !isset($request->education) || !isset($request->occupation) || !isset($request->dob) || !isset($request->gender) || !isset($request->address) 
    	    || !isset($request->city_id) || !isset($request->country_id) || !isset($request->email) || !isset($request->mobile) || !isset($request->income)
    	    || !isset($request->password) || !isset($request->pincode) || !isset($request->state_id) || !isset($request->office_phone)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            $this->form_validation->set_rules("relationship", "Relation", "trim|required|xss_clean|in_list[Father,Mother,Others]");
            
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            $this->form_validation->set_rules("city_id", "City", "trim|required|xss_clean|numeric",array("Select valid City"));
            $this->form_validation->set_rules("state_id", "State", "trim|required|xss_clean|numeric",array("Select valid State"));
            $this->form_validation->set_rules("country_id", "Country", "trim|required|xss_clean|numeric",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            
            $this->form_validation->set_rules("education", "Education", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("occupation", "Occupation", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("income", "Income", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("office_phone", "Office phone", "trim|xss_clean|alpha_dash|max_length[20]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
             }
            
            $CheckUser = $this->home_model->CheckParentByID($request->id);
            if($CheckUser){
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "office_phone" => $this->security->xss_clean($request->office_phone),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city_id),
                    "state_id" => $this->security->xss_clean($request->state_id),
                    "dob" => $this->security->xss_clean($request->dob),
                    "country_id" => $this->security->xss_clean($request->country_id),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    "relationship" => $this->security->xss_clean($request->relationship),
                    "education" => $this->security->xss_clean($request->education),
                    "occupation" => $this->security->xss_clean($request->occupation),
                    "income" => $this->security->xss_clean($request->income),
                );
                
                $AddStudentPrevious = $this->home_model->UpdateParentDetails($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Parent Details Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'211',"status"=>"error","message"=>'Selected Parent Does not Exist','items'=>[]));
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
	
	public function delete_student(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Parent ID!",'items'=>[]));
            return true;
        }else{
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter Student!",'items'=>[]));
                return true;
            }
            $CheckUser = $this->home_model->checkStudentByID($request->id);
            if(!$CheckUser){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Selected Student Does not Exist",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->home_model->deleteStudentDetails($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Details Deleted Successfully!','items'=>[]));
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
	
	public function delete_parent(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Parent ID!",'items'=>[]));
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
            $CheckUser = $this->home_model->CheckParentByID($request->id);
            if(!$CheckUser){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Selected Parent Does not Exist",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->home_model->deleteParentDetails($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Parent Details Deleted Successfully!','items'=>[]));
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
	
	public function update_student_document(){
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
            
    	    if(!isset($request->student_id) || !isset($request->doc_name)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            
            $this->form_validation->set_rules("doc_name", "Document name", "trim|required|xss_clean|max_length[255]");
            $this->form_validation->set_rules("student_id", "Student", "trim|required|xss_clean|numeric",array("Selected Student Does not Exist"));
            $this->form_validation->set_rules("id", "Item", "trim|required|xss_clean|numeric",array("Select a valid Item!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }
            
            $CheckUser = $this->home_model->checkStudentByID($request->student_id);
            if($CheckUser){
                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "student_id" => $this->security->xss_clean($request->student_id),
                    "doc_name" => $this->security->xss_clean($request->doc_name),
                );
                
                $AddStudentPrevious = $this->home_model->UpdateStudentDocument($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Document Details Updated successfully!','items'=>$request_data));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'211',"status"=>"error","message"=>'Selected Student Does not Exist','items'=>[]));
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
	
	public function update_student_status(){
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
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select a valid Student!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("id", "Student", "trim|required|xss_clean|numeric",array("Select a valid Student!"));
            $this->form_validation->set_rules("status", "Status", "trim|required|xss_clean",array("Select a valid Status!"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }

                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "status" => $this->security->xss_clean($request->status)
                );
                
                $CheckUser = $this->home_model->checkStudentByID($request->id);
                if(!$CheckUser){
                    echo json_encode(array("code"=>'211',"status"=>"error","message"=>'Selected Student Does not Exist','items'=>[]));
                    return true;
                    exit();
                }
                
                $AddStudentPrevious = $this->home_model->UpdateStudentStataus($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Status has been Updated successfully!','items'=>$request_data));
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
	
	public function update_student_document_status_approved(){
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
                
                $AddStudentPrevious = $this->home_model->UpdateStudentDocumentStataus($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Document has been Approved!','items'=>$request_data));
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
	
	public function update_student_document_status_disapproved(){
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
                
                $AddStudentPrevious = $this->home_model->UpdateStudentDocumentStataus($request_data);
                if($AddStudentPrevious){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Document has been Disapproved!','items'=>$request_data));
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
	
	public function get_parent_from_student(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->home_model->getParentDetails($request->id);
            if((is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Parents Listed Successfully!','items'=>$getUserList));
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
	
	public function delete_asssigned_id(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
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
            
            $getUserList = $this->home_model->deleteAssignedID($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Assigned List Deleted Successfully!','items'=>$getUserList));
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
	
	public function delete_previous_id(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
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
            
            $getUserList = $this->home_model->deletePreviousID($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Previous Details Deleted Successfully!','items'=>$getUserList));
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
	
	public function delete_document_id(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
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
            
            $getUserList = $this->home_model->deleteDocumentID($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Document Deleted Successfully!','items'=>$getUserList));
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
	
	public function delete_student_photo(){
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter a Student ID",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->home_model->deleteStudentPhoto($request->id);
            if($getUserList){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Photo Deleted Successfully!','items'=>$getUserList));
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
            
    	    if(!isset($request->student_id) || !isset($request->parent_id) || empty($request->parent_id)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the required Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("student_id", "student_id", "trim|required|xss_clean|numeric",array("Select a valid Student"));
            $this->form_validation->set_rules("parent_id[]", "Parent", "trim|required|xss_clean|numeric",array("Select a valid Parent"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>[]));
                return true;
            }
            //CheckParentByID();
            //checkStudentByID();
            
            $CheckUser = $this->home_model->checkStudentByID($request->student_id);
            if($CheckUser){
                foreach($request->parent_id as $value){
                    $CheckParent = $this->home_model->CheckParentByID($value);
                    if($CheckParent){
                        $assignParent = $this->home_model->assignParent($value,$request->student_id);
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
                echo json_encode(array("code"=>'217',"status"=>"error","message"=>'Select a valid Student','items'=>[]));
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
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Enter Student ID!",'items'=>[]));
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
            
            $CheckParent = $this->home_model->CheckParentByID($request->id);
            if(!$CheckParent){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter Valid Parent ID!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->home_model->getParentDetailsByID($request->id);
            if(i(is_array($getUserList) || is_object($getUserList)) && !empty($getUserList)){
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