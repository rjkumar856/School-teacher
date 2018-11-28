<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/menu');
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page" ng-controller="TeacherDetails">
    <!-- Start content -->
    <div class="content ">
        <div class="container-fluid">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">Create New Teacher</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        <div class="box-content" ng-init="tabs='profile'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li class="active"><a class="btn disabled" >Profile</a></li>
                                   <li><a class="btn disabled" >Documents</a></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                               <div class="tabs in show" ng-hide="isLoading">
                               <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                    <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                </div>
                                   
                                   
                                <form id="addTeacherForm" enctype="multipart/form-data" method="post" name="addTeacherForm" novalidate class="form-validation col-12 p-0" role="form" ng-submit="addNewTeacherSubmission()">
                                <div class="row form-box" >
                        			<div class="form-group col-6 col-md-4 m-b" ng-init="teacher_add.teacher_id='<?php if(isset($getTeacherCustomSettings['teacher_id_prefix'])){ echo $getTeacherCustomSettings['teacher_id_prefix']; } ?>'">
                                        <label class="label-role info pos-rlt">Teacher ID<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="teacher_id" ng-model="teacher_add.teacher_id" placeholder="Teacher ID" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Joining Date<span class="required theme-color">*</span></label>
                                        <md-datepicker class="form-control inline w-100" md-hide-icons="calendar" name="doj" ng-model="teacher_add.doj" 
                                        md-placeholder="Admission Date" md-open-on-focus ></md-datepicker>
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">General Details</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">First Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="first_name" ng-model="teacher_add.first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Last Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="last_name" ng-model="teacher_add.last_name" placeholder="Last Name" required >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Department<span class="required theme-color">*</span></label>
                        			  <select class="form-control c-select m-b" name="department" ng-model="teacher_add.department" required >
                        				<option value="">Choose Department</option>
                        				<?php
                        				if(isset($getAllDepartments) and is_array($getAllDepartments)){
                        				foreach($getAllDepartments as $value){?>
                        				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b ">
                                        <label class="label-role info pos-rlt">Class Teacher</label>
                        			    <ui-select multiple ng-model="teacher_add.teacher_class_id" theme="bootstrap" title="Choose a Class Teacher" ng-disabled="disabled">
                                            <ui-select-match class="ui-select-match" placeholder="Select Role...">{{$item.course +'-'+ $item.name}}</ui-select-match>
                                            <ui-select-choices class="ui-select-choices" repeat="color in form.teacher_class_list | filter:$select.search">{{color.course +'-'+ color.name }}</ui-select-choices>
                                        </ui-select>
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Date Of Birth<span class="required theme-color">*</span></label>
                                        <md-datepicker required class="form-control inline w-100" name="dob" ng-model="teacher_add.dob" md-max-date="today" md-hide-icons="calendar"
                                        md-placeholder="Admission Date" md-open-on-focus md-current-view="year" ></md-datepicker>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Teacher Category</label>
                        			  <select class="form-control c-select m-b" name="category_id" ng-model="teacher_add.category_id" >
                        			    <option value="">Choose Teacher Category</option>
                        				<?php
                        				if(isset($getTeacherCategories) and is_array($getTeacherCategories)){
                        				foreach($getTeacherCategories as $value){?>
                        				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Gender<span class="required theme-color">*</span></label>
                        			  <select class="form-control c-select m-b" name="gender" ng-model="teacher_add.gender" required >
                        				<option value="">Choose Gender</option>
                        				<option value="Male">Male</option>
                        				<option value="Female">Female</option>
                        				<option value="Others">Others</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Teacher Position</label>
                                        <input type="text" class="form-control inline" name="nationality" ng-model="teacher_add.position" placeholder="Teacher Position" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Teacher Grade</label>
                                        <input type="text" class="form-control inline" name="grade" ng-model="teacher_add.grade" placeholder="Teacher Grade" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Job Title</label>
                                        <input type="text" class="form-control inline" name="job_title" ng-model="teacher_add.job_title" placeholder="Job Title" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Qualification<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="qualification" ng-model="teacher_add.qualification" placeholder="Qualification" required>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Total Experience<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="experience" ng-model="teacher_add.experience" placeholder="Total Experience" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Experience Details</label>
                                        <textarea rows="1" class="form-control inline" name="teacher_add.experience_details" ng-model="teacher_add.experience_details" placeholder="Experience Details" ></textarea>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" ng-init="teacher_add.password='<?php if(isset($getTeacherCustomSettings['default_teacher_password'])){ echo $getTeacherCustomSettings['default_teacher_password']; } ?>'">
                                        <label class="label-role info pos-rlt">Password<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="password" ng-model="teacher_add.password" placeholder="Password" value="Welcome@123" required >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Personal Details</h5>
                                    </div>
                                    
                        			<div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Marital Status</label>
                        			  <select class="form-control c-select m-b" name="marital_status" ng-model="teacher_add.marital_status" >
                        				<option value="">Choose a Marital Status</option>
                        				<option value="Married">Married</option>
                        				<option value="Unmarried">Unmarried</option>
                        				<option value="Divorced">Divorced</option>
                        				<option value="Widow">Widow</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Blood Group</label>
                        			  <select class="form-control c-select m-b" name="blood_group" ng-model="teacher_add.blood_group" >
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
                                      <label class="label-role info pos-rlt">Is Handicapped</label>
                        			  <select class="form-control c-select m-b" name="is_handicapped" ng-model="teacher_add.is_handicapped" >
                        				<option value="No">No</option>
                        				<option value="Yes">Yes</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Handicap Details(If any)</label>
                                        <textarea rows="1" class="form-control inline" name="teacher_add.handicap_details" ng-model="teacher_add.handicap_details" placeholder="Handicap Details" ></textarea>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Father Name</label>
                                        <input type="text" class="form-control inline" name="father_name" ng-model="teacher_add.father_name" placeholder="Father Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Mother Name</label>
                                        <input type="text" class="form-control inline" name="mother_name" ng-model="teacher_add.mother_name" placeholder="Mother Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Spouse Name</label>
                                        <input type="text" class="form-control inline" name="spouse_name" ng-model="teacher_add.spouse_name" placeholder="Spouse Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Nationality</label>
                                        <input type="text" class="form-control inline" name="nationality" ng-model="teacher_add.nationality" placeholder="Nationality" >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Other Details</h5>
                                    </div>
                                    <?php
                        				if(isset($getTeacherCustomFields) and is_array($getTeacherCustomFields)){
                        				foreach($getTeacherCustomFields as $value){?>
                            			<div class="form-group col-6 col-md-4 m-b" ng-init="teacher_add.customs.<?php echo $value->title; ?> = ''">
                                            <label class="label-role info pos-rlt"><?php echo $value->name; ?> <?php if(strtolower($value->required) == 'true'){ ?><span class="required theme-color">*</span><?php } ?></label>
                                           <?php if(strtolower($value->type) == 'textarea'){ ?>
                                                <textarea rows="1" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="teacher_add.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> ></textarea>
                                           <?php }else{ ?>
                                                <input type="<?php echo strtolower($value->type); ?>" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="teacher_add.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> >
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
                                        <input type="text" class="form-control inline" name="address" ng-model="teacher_add.address" placeholder="Address" required ng-minlength="10" ng-maxlength="255">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Country<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="country_id" ng-model="teacher_add.country_id" required ng-change="getStates()">
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
                                        <select class="form-control c-select m-b" name="state_id" ng-model="teacher_add.state_id" required ng-change="getCities()">
                            				<option value="">Choose State</option>
                            				<option ng-repeat="state in form.states" value="{{state.id}}">{{state.name}}</option>
                            			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">City<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="city_id" ng-model="teacher_add.city_id" >
                            				<option value="">Choose City</option>
                            				<option ng-repeat="city in form.cities" value="{{city.id}}">{{city.name}}</option>
                            			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Pincode/Postal Code<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="pincode" ng-model="teacher_add.pincode" placeholder="Pincode/Postal Code" ng-pattern="/^\d{5,6}$/" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Email<span class="required theme-color">*</span></label>
                                        <input type="email" class="form-control inline" name="email" ng-model="teacher_add.email" placeholder="Email" required value="">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Mobile<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="mobile" ng-model="teacher_add.mobile" placeholder="Mobile" required ng-pattern="/^\d{10}$/" ng-minlength="10" ng-maxlength="10" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Home Phone(Tel:)</label>
                                        <input type="text" class="form-control inline" name="home_phone" ng-model="teacher_add.home_phone" placeholder="Home Phone" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Emergency Contact<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="emergency_contact" ng-model="teacher_add.emergency_contact" placeholder="Emergency Contact" required >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Profile Photo</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Choose Photo</label>
                                        <input type="file" class="form-control inline" file-upload="teacherPhoto" accept=".png,.jpg,.jpeg,.gif,.psd" name="photo" ng-model="teacher_add.photo" placeholder="Photo" >
                                    </div>
                                </div>
                                
                                <div class="row error alert alert-danger" ng-show="formValidation && addTeacherForm.$invalid" >
                                    <ul class="m-0 mt-0 ">
                                        <li ng-show="addTeacherForm.teacher_id.$error.required">Teacher ID is mandatory.</li>
                                        <li ng-show="teacher_add.doj == ''">Joining Date is mandatory.</li>
                                        <li ng-show="addTeacherForm.first_name.$error.required">First name is mandatory</li>
                                        <li ng-show="addTeacherForm.last_name.$error.required">Last name is mandatory</li>
                                        <li ng-show="addTeacherForm.department.$error.required">Department is mandatory</li>
                                        <li ng-show="addTeacherForm.dob.$error.required">Date Of Birth is mandatory</li>
                                        <li ng-show="teacher_add.dob == ''">Date Of Birth is mandatory.</li>
                                        <li ng-show="addTeacherForm.gender.$error.required">Gender is mandatory</li>
                                        <li ng-show="addTeacherForm.qualification.$error.required">Qualification is mandatory</li>
                                        <li ng-show="addTeacherForm.experience.$error.required">Experience is mandatory</li>
                                        <li ng-show="addTeacherForm.emergency_contact.$error.required">Emergency Contact is mandatory</li>
                                        <li ng-show="addTeacherForm.address.$error.required">Address is mandatory.</li>
                                        <li ng-show="addTeacherForm.address.$error.minlength">Address should be min 10 chars</li>
                                        <li ng-show="addTeacherForm.address.$error.maxlength">Address should be max 255 chars</li>
                                        <li ng-show="addTeacherForm.country_id.$error.required">Country is mandatory.</li>
                                        <li ng-show="addTeacherForm.state_id.$error.required">State is mandatory.</li>
                                        <li ng-show="addTeacherForm.city_id.$error.required">City is mandatory.</li>
                                        <li ng-show="addTeacherForm.pincode.$error.required">Pincode/Postal Code is mandatory.</li>
                                        <li ng-show="addTeacherForm.pincode.$error.pattern">Pincode code should be 5 or 6 digits Number</li>
                                        <li ng-show="addTeacherForm.mobile.$error.required">Mobile is mandatory.</li>
                                        <li ng-show="addTeacherForm.mobile.$error.minlength">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="addTeacherForm.mobile.$error.maxlength">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="addTeacherForm.mobile.$error.pattern">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="addTeacherForm.email.$error.required">Email is mandatory.</li>
                                        <li ng-show="addTeacherForm.email.$error.email">Email should be correct format.</li>
                                        <li ng-show="addTeacherForm.password.$error.required">Password is mandatory</li> 
                                        
                                        <?php
                        				if(isset($getTeacherCustomFields) and is_array($getTeacherCustomFields)){
                        				foreach($getTeacherCustomFields as $value){
                        				if(strtolower($value->required) == 'true'){ ?>
                        				<li ng-show="teacher_add.customs.<?php echo $value->title; ?> == ''"><?php echo $value->name; ?> is mandatory.</li>
                        				<?php } } } ?>
                                    </ul>
                                </div>
                                <div class="col-12 p-0" >
                                    <button type="submit" class="btn bg-theme" >Add Teacher</button>
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
<script>
function ClassService($http, $rootScope){
    var dataObj = {
        teacher_class_list : [],
    };
    
    <?php
    if(isset($getAllClasses) and (is_object($getAllClasses) || is_array($getAllClasses))){ 
        foreach($getAllClasses as $value){?>
        dataObj.teacher_class_list.push({'id':<?php echo $value['id']; ?>,'name':'<?php echo addslashes($value['name']); ?>','course':'<?php echo addslashes($value['Course']); ?>'});
    <?php } } ?>
    
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/teacher/teacher-add.js"></script>
</body>
</html>