<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function checkTeacherByID($id){
        try {
            $sql = "SELECT * FROM teachers WHERE id='$id'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function CheckTeacherWithDetails($data){
        try {
            $sql = "SELECT * FROM teachers WHERE teacher_id='$data->teacher_id' OR email='$data->email' OR mobile='$date->mobile'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if($query->num_rows() > 0){
                return $query->row();
            }else{
                return false;
            }
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getTeacherDetails($id){
        try {
            $sql = "SELECT *,te.id AS Tid,te.teacher_id AS teacherId,de.name AS department,tc.name AS category,zci.name AS city,zc.name AS country,zs.name AS state FROM teachers te LEFT JOIN teacher_details sd ON sd.teacher_id=te.id 
            LEFT JOIN department de ON de.id=te.department_id LEFT JOIN ze_city zci ON zci.id=te.city_id LEFT JOIN ze_country zc ON zc.id=te.country_id 
            LEFT JOIN ze_state zs ON zs.id=te.state_id LEFT JOIN teacher_category tc ON tc.id=te.category_id WHERE te.id='$id'";
            $query = $this->db->query($sql);
            $row = $query->row();
            
            $sql = "SELECT field_name,value,name FROM teacher_custom_fields sc INNER JOIN custom_fields cf ON cf.title=sc.field_name WHERE sc.teacher_id='$id' AND cf.used_for='Teacher'";
            $query = $this->db->query($sql);
            $row->customs = $query->result_object();
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $row;
            
        }catch (Exception $e) {
            return [];
        }
    }
    
    public function getTeacherList($request){
        try{
            $flag = 0;
            $page = $request->page - 1;
            $start = $page * $request->limit;
            
            $sql = "SELECT te.*,de.name AS department FROM teachers te LEFT JOIN teacher_details td ON td.teacher_id=te.id LEFT JOIN department de ON de.id=te.department_id ";
            
            if(isset($request->name) and !empty($request->name)){
                $sql .=" WHERE (te.first_name LIKE '%$request->name%' OR te.last_name LIKE '%$request->name%')";
                $flag++;
            }
            
            if(isset($request->teacher_id) and !empty($request->teacher_id)){
                if($flag == 0){
                    $sql .=" WHERE te.teacher_id='$request->teacher_id' ";
                }else{
                    $sql .=" AND te.teacher_id='$request->teacher_id' ";
                }
                $flag++;
            }
            
            if(isset($request->position) and !empty($request->position)){
                if($flag == 0){
                    $sql .=" WHERE te.position='$request->position' ";
                }else{
                    $sql .=" AND te.position='$request->position' ";
                }
                $flag++;
            }
            
            if(isset($request->grade) and !empty($request->grade)){
                if($flag == 0){
                    $sql .=" WHERE te.grade='$request->grade' ";
                }else{
                    $sql .=" AND te.grade='$request->grade' ";
                }
                $flag++;
            }
            
            if(isset($request->gender) and !empty($request->gender)){
                if($flag == 0){
                    $sql .=" WHERE te.gender='$request->gender' ";
                }else{
                    $sql .=" AND te.gender='$request->gender' ";
                }
                $flag++;
            }
            
            if(isset($request->blood_group) and !empty($request->blood_group)){
                if($flag == 0){
                    $sql .=" WHERE te.blood_group='$request->blood_group' ";
                }else{
                    $sql .=" AND te.blood_group='$request->blood_group' ";
                }
                $flag++;
            }
            
            if(isset($request->status) and !empty($request->status)){
                if($flag == 0){
                    $sql .=" WHERE te.status='$request->status' ";
                }else{
                    $sql .=" AND te.status='$request->status' ";
                }
                $flag++;
            }
            
            if(isset($request->department_id) and !empty($request->department_id)){
                if($flag == 0){
                    $sql .=" WHERE te.department_id='$request->department_id' ";
                }else{
                    $sql .=" AND te.department_id='$request->department_id' ";
                }
                $flag++;
            }
            
            if(isset($request->category_id) and !empty($request->category_id)){
                if($flag == 0){
                    $sql .=" WHERE te.category_id='$request->category_id' ";
                }else{
                    $sql .=" AND te.category_id='$request->category_id' ";
                }
                $flag++;
            }
            
            if(isset($request->marital_status) and !empty($request->marital_status)){
                if($flag == 0){
                    $sql .=" WHERE td.marital_status='$request->marital_status' ";
                }else{
                    $sql .=" AND td.marital_status='$request->marital_status' ";
                }
                $flag++;
            }
         
            $sql .=" ORDER BY te.first_name ASC LIMIT $start, $request->limit";
            
            $query = $this->db->query($sql);        
            return $query->result_array();
        }catch(Exception $ex){
	        return $ex->getMessage();
	   }
    }
    
    public function getTeacherPagination($request = []){
        try{
            $flag = 0;
            $sql = "SELECT COUNT(te.id) as Pages FROM teachers te LEFT JOIN teacher_details td ON td.teacher_id=te.id LEFT JOIN department de ON de.id=te.department_id ";
            
            if(isset($request->name) and !empty($request->name)){
                $sql .=" WHERE (te.first_name LIKE '%$request->name%' OR te.last_name LIKE '%$request->name%')";
                $flag++;
            }
            
            if(isset($request->teacher_id) and !empty($request->teacher_id)){
                if($flag == 0){
                    $sql .=" WHERE te.teacher_id='$request->teacher_id' ";
                }else{
                    $sql .=" AND te.teacher_id='$request->teacher_id' ";
                }
                $flag++;
            }
            
            if(isset($request->position) and !empty($request->position)){
                if($flag == 0){
                    $sql .=" WHERE te.position='$request->position' ";
                }else{
                    $sql .=" AND te.position='$request->position' ";
                }
                $flag++;
            }
            
            if(isset($request->grade) and !empty($request->grade)){
                if($flag == 0){
                    $sql .=" WHERE te.grade='$request->grade' ";
                }else{
                    $sql .=" AND te.grade='$request->grade' ";
                }
                $flag++;
            }
            
            if(isset($request->gender) and !empty($request->gender)){
                if($flag == 0){
                    $sql .=" WHERE te.gender='$request->gender' ";
                }else{
                    $sql .=" AND te.gender='$request->gender' ";
                }
                $flag++;
            }
            
            if(isset($request->blood_group) and !empty($request->blood_group)){
                if($flag == 0){
                    $sql .=" WHERE te.blood_group='$request->blood_group' ";
                }else{
                    $sql .=" AND te.blood_group='$request->blood_group' ";
                }
                $flag++;
            }
            
            if(isset($request->status) and !empty($request->status)){
                if($flag == 0){
                    $sql .=" WHERE te.status='$request->status' ";
                }else{
                    $sql .=" AND te.status='$request->status' ";
                }
                $flag++;
            }
            
            if(isset($request->department_id) and !empty($request->department_id)){
                if($flag == 0){
                    $sql .=" WHERE te.department_id='$request->department_id' ";
                }else{
                    $sql .=" AND te.department_id='$request->department_id' ";
                }
                $flag++;
            }
            
            if(isset($request->category_id) and !empty($request->category_id)){
                if($flag == 0){
                    $sql .=" WHERE te.category_id='$request->category_id' ";
                }else{
                    $sql .=" AND te.category_id='$request->category_id' ";
                }
                $flag++;
            }
            
            if(isset($request->marital_status) and !empty($request->marital_status)){
                if($flag == 0){
                    $sql .=" WHERE td.marital_status='$request->marital_status' ";
                }else{
                    $sql .=" AND td.marital_status='$request->marital_status' ";
                }
                $flag++;
            }
            
            $query = $this->db->query($sql);        
            return $query->row();
        }catch(Exception $ex){
	        return false;
	   }
    }
    
    public function UpdateTeacherStataus($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE teachers SET status='$data[status]' WHERE id='$data[id]'";
            $query = $this->db->query($sql);
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return true;
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function deleteTeacherDetails($id){
        try{
            $this->db->trans_begin();
            $sql = "DELETE FROM teachers WHERE id='$id'";
            $this->db->query($sql);
            
            $sql = "DELETE FROM teacher_details WHERE teacher_id='$id'";
            $this->db->query($sql);
            
            //$sql = "DELETE FROM teacher_to_parent_assignment WHERE teacher_id='$id'";
            //$this->db->query($sql);
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return true;
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function checkTeacherDetailExist($req){
        try{
            $sql = "SELECT * FROM teachers WHERE id!='$req->id' AND (teacher_id='$req->teacher_id' OR email='$req->email' OR mobile='$req->mobile')";
            $query = $this->db->query($sql);        
            return $query->row();
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function AddNewTeacher($data){
        try{
            //$this->db->trans_start();
            $this->db->trans_begin();
            $sql = "INSERT INTO teachers(teacher_id,first_name,last_name,mobile,email,password,photo,access_key,dob,doj,address,city_id,state_id,country_id,pincode,gender,department_id,class_id,
                position,category_id,grade,qualification,experience,experience_details,blood_group,home_phone,emergency_contact,created_by,status)
            VALUES('$data[teacher_id]','$data[first_name]','$data[last_name]','$data[mobile]','$data[email]','$data[password]','$data[photo]','$data[access_key]','$data[dob]','$data[doj]','$data[address]',
                '$data[city_id]','$data[state_id]','$data[country_id]','$data[pincode]','$data[gender]','$data[department_id]','$data[class_id]','$data[position]','$data[category_id]','$data[grade]',
                '$data[qualification]','$data[experience]','$data[experience_details]','$data[blood_group]','$data[home_phone]','$data[emergency_contact]','$data[created_by]','$data[status]')";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                $this->db->trans_rollback();
                return false;
            }
            
            $insert_id = $this->db->insert_id();
            $sql = "INSERT INTO teacher_details(teacher_id,job_title,marital_status,father_name,mother_name,spouse_name,nationality,is_handicapped,handicap_details)
                    VALUES('$insert_id','$data[job_title]','$data[marital_status]','$data[father_name]','$data[mother_name]','$data[spouse_name]','$data[nationality]','$data[is_handicapped]','$data[handicap_details]')";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                $this->db->trans_rollback();
                return false;
            }
            
            if(isset($data['customs']) and (is_array($data['customs']) or is_object($data['customs']))){
                    $request_data['customs'] = [];
                    foreach($data['customs'] as $key=>$value){
                        $sql_check = "SELECT * FROM teacher_custom_fields WHERE teacher_id='$insert_id' AND field_name='$key'";
                        $query_check = $this->db->query($sql_check);
                        if($query_check->num_rows() == 0){
                            $sql = "INSERT INTO teacher_custom_fields(teacher_id,field_name,value)
                                    VALUES('$insert_id','$key','$value')";
                            $query = $this->db->query($sql);
                        }else{
                            $sql = "UPDATE teacher_custom_fields SET value='$value' WHERE teacher_id='$insert_id' AND field_name='$key'";
                            $query = $this->db->query($sql);
                        }
                    }
                }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                $this->db->trans_rollback();
                return false;
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $insert_id;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function UpdateTeacher($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE teachers SET teacher_id='$data[teacher_id]',first_name='$data[first_name]',last_name='$data[last_name]',mobile='$data[mobile]',email='$data[email]',department_id='$data[department_id]',
                    password='$data[password]',dob='$data[dob]',gender='$data[gender]',blood_group='$data[blood_group]',doj='$data[doj]',address='$data[address]',city_id='$data[city_id]',state_id='$data[state_id]',
                    country_id='$data[country_id]',pincode='$data[pincode]',class_id='$data[class_id]',position='$data[position]',category_id='$data[category_id]',grade='$data[grade]',qualification='$data[qualification]',experience='$data[experience]',
                    experience_details='$data[experience_details]',home_phone='$data[home_phone]',emergency_contact='$data[emergency_contact]' WHERE id='$data[id]'";
            $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                $this->db->trans_rollback();
                return false;
            }
            
            if(isset($data['file_url']) and !empty($data['file_url'])){
                $sql = "UPDATE teachers SET photo='$data[file_url]' WHERE id='$data[id]'";
                $this->db->query($sql);
                $db_error = $this->db->error();
                if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                    $this->config->message = 'Database error! ' . $db_error['message'];
                    $this->db->trans_rollback();
                    return false;
                }
            }
            
            if(isset($data['customs']) and (is_array($data['customs']) or is_object($data['customs']))){
                    $request_data['customs'] = [];
                    foreach($data['customs'] as $key=>$value){
                        $sql_check = "SELECT * FROM teacher_custom_fields WHERE teacher_id='$data[id]' AND field_name='$key'";
                        $query_check = $this->db->query($sql_check);
                        if($query_check->num_rows() == 0){
                            $sql = "INSERT INTO teacher_custom_fields(teacher_id,field_name,value)
                                    VALUES('$data[id]','$key','$value')";
                            $query = $this->db->query($sql);
                        }else{
                            $sql = "UPDATE teacher_custom_fields SET value='$value' WHERE teacher_id='$data[id]' AND field_name='$key'";
                            $query = $this->db->query($sql);
                        }
                    }
                }
                
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                $this->db->trans_rollback();
                return false;
            }
            
            $sql = "UPDATE teacher_details SET job_title='$data[job_title]',marital_status='$data[marital_status]',father_name='$data[father_name]',mother_name='$data[mother_name]',spouse_name='$data[spouse_name]',is_handicapped='$data[is_handicapped]',handicap_details='$data[handicap_details]', nationality='$data[nationality]' WHERE teacher_id='$data[id]'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                $this->db->trans_rollback();
                return false;
            }
            
            $sql = "SELECT st.*,sd.job_title,sd.marital_status,sd.father_name,sd.mother_name,sd.spouse_name,sd.is_handicapped,sd.handicap_details,sd.nationality FROM teachers st LEFT JOIN teacher_details sd ON sd.teacher_id=st.id WHERE st.id='$data[id]'";
            $query = $this->db->query($sql);
            $row = $query->row();
            $sql = "SELECT field_name,value FROM teacher_custom_fields sc WHERE sc.teacher_id='$data[id]'";
            $query = $this->db->query($sql);
            $row->customs = [];
            foreach($query->result() as $value){
                $row->customs[$value->field_name] = $value->value;
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                return false;
            }
            
            return $row;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function AddTeacherDocuments($data){
        try{
            $this->db->trans_begin();
            $this->db->insert('teachers_documents',$data);
            $insert_id = $this->db->insert_id();
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                $this->config->message = 'Database error! ' . $db_error['message'];
                $this->db->trans_rollback();
                return false;
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $insert_id;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function UpdateTeacherDocument($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE teachers_documents SET doc_name='$data[doc_name]' WHERE id='$data[id]'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function UpdateTeacherDocumentStataus($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE teachers_documents SET status='$data[status]' WHERE id='$data[id]'";
            $query = $this->db->query($sql);
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function deleteDocumentID($id){
        try{
            $this->db->trans_begin();
            $sql = "SELECT url FROM teachers_documents WHERE id='$id'";
            $query = $this->db->query($sql);
            $row = $query->row();
            
            $sql = "DELETE FROM teachers_documents WHERE id='$id'";
            $query = $this->db->query($sql);
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                if(isset($row->url)){
                    $file = "./assets/files/teacher-documents/".$row->url;
                    if(is_file($file)){
                        unlink($file); // delete file
                    }
                }
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function UpdateTeacherCustomSettings($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE settings SET value='$data[teacher_id_prefix]' WHERE options='teacher_id_prefix'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            $sql = "UPDATE settings SET value='$data[default_teacher_password]' WHERE options='default_teacher_password'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function getParentsByTeacher($request){
        try{
            $sql = "SELECT * FROM parents pr ";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return $query->result_array();
        }catch(Exception $ex){
	        return false;
	   }
    }
    
    public function CheckParentWithDetails($req){
        try{
            $sql = "SELECT * FROM parents WHERE mobile='$req->mobile' OR email='$req->email'";
            $query = $this->db->query($sql);        
            return $query->row();
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function deleteTeacherPhoto($id){
        try{
            $this->db->trans_begin();
            $sql = "SELECT photo FROM teachers WHERE id='$id'";
            $query = $this->db->query($sql);
            $row = $query->row();
            
            $sql = "UPDATE teachers SET photo='' WHERE id='$id'";
            $query = $this->db->query($sql);
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                if(isset($row->photo)){
                    $file = "./assets/files/teacher/".$row->photo;
                    if(is_file($file)){
                        unlink($file); // delete file
                    }
                }
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function getTeacherDocuments($id){
        try {
            $sql = "SELECT * FROM teachers_documents sd WHERE sd.teacher_id='$id' ORDER BY sd.date_added DESC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            $this->config->message = $ex->getMessage();
            return [];
        }
    }
    
     public function getTeacherCustomFields(){
        try {
            $sql = "SELECT * FROM custom_fields cf WHERE cf.status='Active' AND cf.used_for='Teacher' ORDER BY cf.date_added ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            $this->config->message = $ex->getMessage();
            return false;
        }
    }
    
     public function getTeacherCustomSettings(){
        try {
            $sql = "SELECT * FROM settings WHERE options IN ('teacher_id_prefix','default_teacher_password')";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            $this->config->message = $ex->getMessage();
            return false;
        }
    }
    
    public function getTeacherCategories(){
        try {
            $sql = "SELECT * FROM teacher_category sc WHERE sc.status='Active' ORDER BY sc.date_added ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            $this->config->message = $ex->getMessage();
            return false;
        }
    }
    
    public function getAllDepartments(){
        try {
            $sql = "SELECT * FROM department sc WHERE sc.status='Active' ORDER BY sc.date_added ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            $this->config->message = $ex->getMessage();
            return false;
        }
    }
    
    public function getAllDepartmentList(){
        try {
            $sql = "SELECT * FROM department sc ORDER BY sc.date_added ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            $this->config->message = $ex->getMessage();
            return false;
        }
    }
    
    public function CheckTeacherTitleInCustom($title){
        try {
            $sql = "SELECT title FROM custom_fields WHERE title='$title'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
            
        }catch (Exception $e) {
            $this->config->message = $ex->getMessage();
            return false;
        }
    }
    
    public function AddTeacherCustomFields($data){
        try{
            $this->db->trans_begin();
            $this->db->insert('custom_fields',$data);
            $insert_id = $this->db->insert_id();
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $insert_id;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function UpdateTeacherCustomFields($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE custom_fields SET name='$data[name]',type='$data[type]',required='$data[required]' WHERE id='$data[id]'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $query;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function deleteTeacherCustomField($id){
        try{
            $this->db->trans_begin();
            $sql = "SELECT title FROM custom_fields WHERE id='$id'";
            $query = $this->db->query($sql);
            $row = $query->row();
            $sql = "DELETE FROM teacher_custom_fields WHERE field_name='$row->title'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            $sql = "DELETE FROM custom_fields WHERE id='$id'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function AddTeacherCategory($data){
        try{
            $this->db->trans_begin();
            $this->db->insert('teacher_category',$data);
            $insert_id = $this->db->insert_id();
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $insert_id;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function UpdateTeacherCategory($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE teacher_category SET name='$data[name]' WHERE id='$data[id]'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $query;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function deleteTeacherCategory($id){
        try{
            $this->db->trans_begin();
            $sql = "DELETE FROM teacher_category WHERE id='$id'";
            $query = $this->db->query($sql);
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function AddTeacherDepartment($data){
        try{
            $this->db->trans_begin();
            $this->db->insert('department',$data);
            $insert_id = $this->db->insert_id();
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $insert_id;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function UpdateTeacherDepartment($data){
        try{
            $this->db->trans_begin();
            $sql = "UPDATE department SET name='$data[name]',code='$data[code]',status='$data[status]' WHERE id='$data[id]'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            return $query;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    public function deleteTeacherDepartment($id){
        try{
            $this->db->trans_begin();
            $sql = "DELETE FROM department WHERE id='$id'";
            $query = $this->db->query($sql);
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
            
            return true;
        }catch(Exception $ex){
            $this->config->message = $ex->getMessage();
            $this->db->trans_rollback();
	        return false;
	    }
    }
    
    
}