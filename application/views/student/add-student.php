<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/menu');
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page" ng-controller="StudentDetails">
    <!-- Start content -->
    <div class="content ">
        <div class="container-fluid">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">Create New Student</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        <div class="box-content" ng-init="tabs='profile'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li class="active"><a class="btn disabled" >Profile</a></li>
                                   <li><a class="btn disabled" >Parents Details</a></li>
                                   <li><a class="btn disabled" >Previous Details</a></li>
                                   <li><a class="btn disabled" >Documents</a></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                               <div class="tabs in show" ng-hide="isLoading">
                                <form id="addStudentForm" enctype="multipart/form-data" method="post" name="addStudentForm" novalidate class="form-validation col-12 p-0" role="form" ng-submit="addNewStudentSubmission()">
                                <div class="row form-box">
                        			<div class="form-group col-6 col-md-4 m-b" ng-init="student_add.admission_number=<?php if(isset($getNewAdmisssionNumber) and is_object($getNewAdmisssionNumber)){ echo $getNewAdmisssionNumber->Auto_increment; } ?>">
                                        <label class="label-role info pos-rlt">Admission No.<span class="required theme-color">*</span></label>
                                        <input type="number" class="form-control inline" name="admission_number" ng-model="student_add.admission_number" placeholder="Admission No." required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Admission Date<span class="required theme-color">*</span></label>
                                        <md-datepicker class="form-control inline w-100" md-hide-icons="calendar" name="admission_date" ng-model="student_add.admission_date" 
                                        md-placeholder="Admission Date" md-open-on-focus ></md-datepicker>
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Personal Details</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">First Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="first_name" ng-model="student_add.first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Middle Name</label>
                                        <input type="text" class="form-control inline" name="middle_name" ng-model="student_add.middle_name" placeholder="Middle Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Last Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="last_name" ng-model="student_add.last_name" placeholder="Last Name" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" ng-init="student_add.roll_number='<?php if(isset($getStudentCustomSettings['student_roll_number_prefix'])){ echo $getStudentCustomSettings['student_roll_number_prefix']; } ?>'">
                                        <label class="label-role info pos-rlt">Roll Number/Student ID<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="roll_number" ng-model="student_add.roll_number" placeholder="Roll Number/Student ID" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Class/Batch</label>
                        			  <select class="form-control c-select m-b" name="class" ng-model="student_add.class" >
                        				<option value="">Choose Class/Batch</option>
                        				<?php
                        				if(isset($getAllClasses) and is_array($getAllClasses)){
                        				foreach($getAllClasses as $value){?>
                        				<option value="<?php echo $value['id'] ?>"><?php echo $value['Course']." - ".$value['name'] ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Date Of Birth<span class="required theme-color">*</span></label>
                                        <md-datepicker required class="form-control inline w-100" name="dob" ng-model="student_add.dob" md-max-date="today" md-hide-icons="calendar"
                                        md-placeholder="Admission Date" md-open-on-focus md-current-view="year" ></md-datepicker>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Gender<span class="required theme-color">*</span></label>
                        			  <select class="form-control c-select m-b" name="gender" ng-model="student_add.gender" >
                        				<option value="">Choose Gender</option>
                        				<option value="Male">Male</option>
                        				<option value="Female">Female</option>
                        				<option value="Others">Others</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Blood Group</label>
                        			  <select class="form-control c-select m-b" name="blood_group" ng-model="student_add.blood_group" >
                        				<option value="">Choose Blood Group</option>
                        				<option value="A+">A+</option>
                        				<option value="A-">A-</option>
                        				<option value="B+">B+</option>
                        				<option value="B-">B-</option>
                        				<option value="O+">O+</option>
                        				<option value="O-">O-</option>
                        				<option value="AB+">AB+</option>
                        				<option value="AB-">AB-</option>
                        			  </select>
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Birth Place</label>
                                        <input type="text" class="form-control inline" name="birth_place" ng-model="student_add.birth_place" placeholder="Birth Place" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Language</label>
                                        <input type="text" class="form-control inline" name="language" ng-model="student_add.language" placeholder="Language" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Nationality</label>
                                        <input type="text" class="form-control inline" name="nationality" ng-model="student_add.nationality" placeholder="Nationality" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Religion</label>
                                        <input type="text" class="form-control inline" name="religion" ng-model="student_add.religion" placeholder="Religion" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Student Category</label>
                        			  <select class="form-control c-select m-b" name="student_category" ng-model="student_add.student_category" >
                        				<?php
                        				if(isset($getStudentCategories) and is_array($getStudentCategories)){
                        				foreach($getStudentCategories as $value){?>
                        				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Is Handicapped</label>
                        			  <select class="form-control c-select m-b" name="is_handicapped" ng-model="student_add.is_handicapped" >
                        				<option value="No">No</option>
                        				<option value="Yes">Yes</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" ng-init="student_add.password='<?php if(isset($getStudentCustomSettings['default_student_password'])){ echo $getStudentCustomSettings['default_student_password']; } ?>'">
                                        <label class="label-role info pos-rlt">Password<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="password" ng-model="student_add.password" placeholder="Password" value="Welcome@123" required >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Other Details</h5>
                                    </div>
                                    <?php
                        				if(isset($getStudentCustomFields) and is_array($getStudentCustomFields)){
                        				foreach($getStudentCustomFields as $value){?>
                            			<div class="form-group col-6 col-md-4 m-b" ng-init="student_add.customs.<?php echo $value->title; ?> = ''">
                                            <label class="label-role info pos-rlt"><?php echo $value->name; ?> <?php if(strtolower($value->required) == 'true'){ ?><span class="required theme-color">*</span><?php } ?></label>
                                           <?php if(strtolower($value->type) == 'textarea'){ ?>
                                                <textarea rows="1" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="student_add.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> ></textarea>
                                           <?php }else{ ?>
                                                <input type="<?php echo strtolower($value->type); ?>" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="student_add.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> >
                                            <?php } ?>
                                        </div>
                                    <?php } } ?>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Contact Details</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Address<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="address" ng-model="student_add.address" placeholder="Address" required ng-minlength="10" ng-maxlength="255">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Country<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="country" ng-model="student_add.country" required ng-change="getStates()">
                        				<option value="">Choose Country</option>
                        				<?php
                        				if(isset($getAllCountries) and is_array($getAllCountries)){
                        				foreach($getAllCountries as $value){?>
                        				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">State<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="state" ng-model="student_add.state" required ng-change="getCities()">
                            				<option value="">Choose State</option>
                            				<option ng-repeat="state in form.states" value="{{state.id}}">{{state.name}}</option>
                            			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">City<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="city" ng-model="student_add.city" >
                            				<option value="">Choose City</option>
                            				<option ng-repeat="city in form.cities" value="{{city.id}}">{{city.name}}</option>
                            			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Pincode/Postal Code<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="pincode" ng-model="student_add.pincode" placeholder="Pincode/Postal Code" ng-pattern="/^\d{5,6}$/" required value="">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Mobile<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="mobile" ng-model="student_add.mobile" placeholder="Mobile" required ng-pattern="/^\d{10}$/" ng-minlength="10" ng-maxlength="10" value="">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Email<span class="required theme-color">*</span></label>
                                        <input type="email" class="form-control inline" name="email" ng-model="student_add.email" placeholder="Email" required value="">
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Profile Picture</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Photo</label>
                                        <input type="file" class="form-control inline" file-upload="studentPhoto" accept=".png,.jpg,.jpeg,.gif,.psd" name="photo" ng-model="student_add.photo" placeholder="Photo" >
                                    </div>
                                </div>
                                
                                <div class="row error alert alert-danger" ng-show="formValidation && addStudentForm.$invalid" >
                                    <ul class="m-0 mt-0 ">
                                        <li ng-show="addStudentForm.admission_number.$error.required">Admission Number is mandatory.</li>
                                        <li ng-show="student_add.admission_date == ''">Admission Date is mandatory.</li>
                                        <li ng-show="addStudentForm.first_name.$error.required">First name is mandatory</li>
                                        <li ng-show="addStudentForm.last_name.$error.required">Last name is mandatory</li>
                                        <li ng-show="addStudentForm.roll_number.$error.required">Roll Number/Student ID is mandatory</li>
                                        <li ng-show="addStudentForm.dob.$error.required">Date Of Birth is mandatory</li>
                                        <li ng-show="addStudentForm.address.$error.required">Address is mandatory.</li>
                                        <li ng-show="addStudentForm.address.$error.minlength">Address should be min 10 chars</li>
                                        <li ng-show="addStudentForm.address.$error.maxlength">Address should be max 255 chars</li>
                                        <li ng-show="addStudentForm.country.$error.required">Country is mandatory.</li>
                                        <li ng-show="addStudentForm.state.$error.required">State is mandatory.</li>
                                        <li ng-show="addStudentForm.city.$error.required">City is mandatory.</li>
                                        <li ng-show="addStudentForm.pincode.$error.required">Pincode/Postal Code is mandatory.</li>
                                        <li ng-show="addStudentForm.pincode.$error.pattern">Pincode code should be 5 or 6 digits Number</li>
                                        <li ng-show="addStudentForm.mobile.$error.required">Mobile is mandatory.</li>
                                        <li ng-show="addStudentForm.mobile.$error.minlength">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="addStudentForm.mobile.$error.maxlength">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="addStudentForm.mobile.$error.pattern">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="addStudentForm.email.$error.required">Email is mandatory.</li>
                                        <li ng-show="addStudentForm.email.$error.email">Email should be correct format.</li>
                                        <li ng-show="addStudentForm.password.$error.required">Password is mandatory</li>
                                        <li ng-show="addStudentForm.gender.$error.required">Gender is mandatory</li>
                                        <?php
                        				if(isset($getStudentCustomFields) and is_array($getStudentCustomFields)){
                        				foreach($getStudentCustomFields as $value){
                        				if(strtolower($value->required) == 'true'){ ?>
                        				<li ng-show="student_add.customs.<?php echo $value->title; ?> == ''"><?php echo $value->name; ?> is mandatory.</li>
                        				<?php } } } ?>
                                    </ul>
                                </div>
                                
                                <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                    <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                </div>
                                <div class="col-12 p-0" >
                                    <button type="submit" class="btn bg-theme" >Add Student</button>
                                    <button type="reset" class="btn btn-info">Clear</button>
                                </div>
                                </form>
                            </div>
                            <div ng-show="isLoading" class="text-center row loader big"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
                            
                            
                            
                        </div>
                    </div>
                  </div>
            </div>
                    </div> <!-- container -->
                </div> <!-- content -->
                <?php $this->load->view('common/content-footer'); ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <?php $this->load->view('common/right-side-bar'); ?>
        </div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>

<script src="<?php echo base_url(); ?>assets/angular/lib/angular-ui-select/dist/select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/student-add.js"></script>
</body>
</html>