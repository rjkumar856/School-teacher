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
        <div class="container-fluid" ng-init="teacher_edit.id=<?php echo $teacher_id; ?>">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">MANAGE TEACHER</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        <div class="box-top-content pull-right">
                            <a href="<?php echo base_url(); ?>view-teacher/<?php echo $teacher_id; ?>" class="btn link-text theme-btn">View</a>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='profile'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li class="active"><a class="btn disabled" href="edit-teacher/<?php echo $teacher_id; ?>" >Profile</a></li>
                                   <li><a class="btn " href="edit-teacher/doc/<?php echo $teacher_id; ?>" >Documents</a></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                               <div class="tabs" ng-hide="isLoading">
                                   <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    </div>
                                <form id="EditTeacherForm" enctype="multipart/form-data" method="post" name="EditTeacherForm" novalidate class="form-validation col-12 p-0" role="form" ng-submit="UpdateTeacherSubmission()">
                                <div class="row form-box" >
                        			<div class="form-group col-6 col-md-4 m-b" >
                                        <label class="label-role info pos-rlt">Teacher ID<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="teacher_id" ng-model="teacher_edit.teacher_id" placeholder="Teacher ID" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Joining Date<span class="required theme-color">*</span></label>
                                        <md-datepicker class="form-control inline w-100" md-hide-icons="calendar" name="doj" ng-model="teacher_edit.doj" 
                                        md-placeholder="Admission Date" md-open-on-focus ></md-datepicker>
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">General Details</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">First Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="first_name" ng-model="teacher_edit.first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Last Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="last_name" ng-model="teacher_edit.last_name" placeholder="Last Name" required >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Department<span class="required theme-color">*</span></label>
                        			  <select class="form-control c-select m-b" name="department_id" ng-model="teacher_edit.department_id" required >
                        				<option value="">Choose Department</option>
                        				<?php
                        				if(isset($getAllDepartments) and is_array($getAllDepartments)){
                        				foreach($getAllDepartments as $value){?>
                        				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Class Teacher</label>
                        			    <ui-select multiple ng-model="teacher_edit.teacher_class_id" title="Choose a Class Teacher" >
                                            <ui-select-match class="ui-select-match" placeholder="Select Role...">{{$item.course +'-'+ $item.name}}</ui-select-match>
                                            <ui-select-choices class="ui-select-choices" repeat="color in form.teacher_class_list | filter:$select.search">{{color.course +'-'+ color.name }}</ui-select-choices>
                                        </ui-select>
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Date Of Birth<span class="required theme-color">*</span></label>
                                        <md-datepicker required class="form-control inline w-100" name="dob" ng-model="teacher_edit.dob" md-max-date="today" md-hide-icons="calendar"
                                        md-placeholder="Admission Date" md-open-on-focus md-current-view="year" ></md-datepicker>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Teacher Category</label>
                        			  <select class="form-control c-select m-b" name="category_id" ng-model="teacher_edit.category_id" >
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
                        			  <select class="form-control c-select m-b" name="gender" ng-model="teacher_edit.gender" required >
                        				<option value="">Choose Gender</option>
                        				<option value="Male">Male</option>
                        				<option value="Female">Female</option>
                        				<option value="Others">Others</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Teacher Position</label>
                                        <input type="text" class="form-control inline" name="nationality" ng-model="teacher_edit.position" placeholder="Teacher Position" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Teacher Grade</label>
                                        <input type="text" class="form-control inline" name="grade" ng-model="teacher_edit.grade" placeholder="Teacher Grade" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Job Title</label>
                                        <input type="text" class="form-control inline" name="job_title" ng-model="teacher_edit.job_title" placeholder="Job Title" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Qualification<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="qualification" ng-model="teacher_edit.qualification" placeholder="Qualification" required>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Total Experience<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="experience" ng-model="teacher_edit.experience" placeholder="Total Experience" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Experience Details</label>
                                        <textarea rows="1" class="form-control inline" name="teacher_edit.experience_details" ng-model="teacher_edit.experience_details" placeholder="Experience Details" ></textarea>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" >
                                        <label class="label-role info pos-rlt">Password<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="password" ng-model="teacher_edit.password" placeholder="Password" value="Welcome@123" required >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Personal Details</h5>
                                    </div>
                                    
                        			<div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Marital Status</label>
                        			  <select class="form-control c-select m-b" name="marital_status" ng-model="teacher_edit.marital_status" >
                        				<option value="">Choose a Marital Status</option>
                        				<option value="Married">Married</option>
                        				<option value="Unmarried">Unmarried</option>
                        				<option value="Divorced">Divorced</option>
                        				<option value="Widow">Widow</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Blood Group</label>
                        			  <select class="form-control c-select m-b" name="blood_group" ng-model="teacher_edit.blood_group" >
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
                        			  <select class="form-control c-select m-b" name="is_handicapped" ng-model="teacher_edit.is_handicapped" >
                        				<option value="No">No</option>
                        				<option value="Yes">Yes</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Handicap Details(If any)</label>
                                        <textarea rows="1" class="form-control inline" name="teacher_edit.handicap_details" ng-model="teacher_edit.handicap_details" placeholder="Handicap Details" ></textarea>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Father Name</label>
                                        <input type="text" class="form-control inline" name="father_name" ng-model="teacher_edit.father_name" placeholder="Father Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Mother Name</label>
                                        <input type="text" class="form-control inline" name="mother_name" ng-model="teacher_edit.mother_name" placeholder="Mother Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Spouse Name</label>
                                        <input type="text" class="form-control inline" name="spouse_name" ng-model="teacher_edit.spouse_name" placeholder="Spouse Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Nationality</label>
                                        <input type="text" class="form-control inline" name="nationality" ng-model="teacher_edit.nationality" placeholder="Nationality" >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Other Details</h5>
                                    </div>
                                    <?php
                        				if(isset($getTeacherCustomFields) and is_array($getTeacherCustomFields)){
                        				foreach($getTeacherCustomFields as $value){?>
                            			<div class="form-group col-6 col-md-4 m-b" >
                                            <label class="label-role info pos-rlt"><?php echo $value->name; ?> <?php if(strtolower($value->required) == 'true'){ ?><span class="required theme-color">*</span><?php } ?></label>
                                           <?php if(strtolower($value->type) == 'textarea'){ ?>
                                                <textarea rows="1" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="teacher_edit.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> ></textarea>
                                           <?php }else{ ?>
                                                <input type="<?php echo strtolower($value->type); ?>" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="teacher_edit.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> >
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
                                        <input type="text" class="form-control inline" name="address" ng-model="teacher_edit.address" placeholder="Address" required ng-minlength="10" ng-maxlength="255">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Country<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="country_id" ng-model="teacher_edit.country_id" required ng-change="getStates()">
                        				<option value="">Choose Country</option>
                        				<?php
                        				if(isset($getAllCountries) and is_array($getAllCountries)){
                        				foreach($getAllCountries as $value){?>
                        				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" ng-init="getStatesForStdEdit()">
                                        <label class="label-role info pos-rlt">State<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="state_id" ng-model="teacher_edit.state_id" required ng-change="getCities()">
                            				<option value="">Choose State</option>
                            				<option ng-repeat="state in form.states" value="{{state.id}}">{{state.name}}</option>
                            			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" ng-init="getCitiesForStdEdit()">
                                        <label class="label-role info pos-rlt">City<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="city_id" ng-model="teacher_edit.city_id" >
                            				<option value="">Choose City</option>
                            				<option ng-repeat="city in form.cities" value="{{city.id}}">{{city.name}}</option>
                            			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Pincode/Postal Code<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="pincode" ng-model="teacher_edit.pincode" placeholder="Pincode/Postal Code" ng-pattern="/^\d{5,6}$/" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Email<span class="required theme-color">*</span></label>
                                        <input type="email" class="form-control inline" name="email" ng-model="teacher_edit.email" placeholder="Email" required value="">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Mobile<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="mobile" ng-model="teacher_edit.mobile" placeholder="Mobile" required ng-pattern="/^\d{10}$/" ng-minlength="10" ng-maxlength="10" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Home Phone(Tel:)</label>
                                        <input type="text" class="form-control inline" name="home_phone" ng-model="teacher_edit.home_phone" placeholder="Home Phone" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Emergency Contact<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="emergency_contact" ng-model="teacher_edit.emergency_contact" placeholder="Emergency Contact" required >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Profile Photo</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Photo</label>
                                        
                                        <div class="box-details1 box-profile text-center" ng-show="teacher_edit.photo != ''">
                                            <div class="inner">
                                                <span class="btn action-btn btn-delete bg-theme delete-btn" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="bounce" ui-target="#animate" title="Delete this Photo"><i class="fa fa-trash"></i></span>
                                                <img src="assets/files/teacher/{{ teacher_edit.photo }}" width="64" alt="" titl="" class="image" >
                                            </div>
                                        </div>
                                        <div class="w-100" ng-hide="teacher_edit.photo != ''">
                                            <input type="file" class="form-control inline" file-upload="teacherPhoto" name="photo" ng-model="teacher_edit.photo" placeholder="Photo" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row error alert alert-danger" ng-show="formValidation && addTeacherForm.$invalid" >
                                    <ul class="m-0 mt-0 ">
                                        <li ng-show="addTeacherForm.teacherId.$error.required">Teacher ID is mandatory.</li>
                                        <li ng-show="teacher_edit.doj == ''">Joining Date is mandatory.</li>
                                        <li ng-show="addTeacherForm.first_name.$error.required">First name is mandatory</li>
                                        <li ng-show="addTeacherForm.last_name.$error.required">Last name is mandatory</li>
                                        <li ng-show="addTeacherForm.department_id.$error.required">Department is mandatory</li>
                                        <li ng-show="addTeacherForm.dob.$error.required">Date Of Birth is mandatory</li>
                                        <li ng-show="teacher_edit.dob == ''">Date Of Birth is mandatory.</li>
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
                        				<li ng-show="teacher_edit.customs.<?php echo $value->title; ?> == ''"><?php echo $value->name; ?> is mandatory.</li>
                        				<?php } } } ?>
                                    </ul>
                                </div>
                                <div class="col-12 p-0" >
                                    <button type="submit" class="btn bg-theme" >Update Teacher</button>
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
            <div id="m-a-a" class="modal fade animate" data-backdrop="true">
              <div class="modal-dialog" id="animate">
                <div class="modal-content">
                  <div class="modal-body text-center p-lg pt-5">
                    <p>Are you sure to delete this Photo?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary " data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteTeacherPhoto()">Yes</button>
                  </div>
                </div><!-- /.modal-content -->
              </div>
            </div>
        </div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url(); ?>assets/angular/lib/angular-ui-select/dist/select.min.js"></script>
<script>
function DetailsService($http, $rootScope){
    var dataObj = {
        edit_teacher_details : {},
        teacher_class_list : [],
        assigned_teacher_doc_list : [],
    };
    
    <?php
    $row_count = 1;
    if(isset($getTeacherDetails) and is_object($getTeacherDetails)){ ?>
        dataObj.edit_teacher_details = {'id':<?php echo $getTeacherDetails->Tid; ?>,'teacher_id':'<?php echo addslashes($getTeacherDetails->teacherId); ?>','first_name':'<?php echo addslashes($getTeacherDetails->first_name); ?>',
                'last_name':'<?php echo $getTeacherDetails->last_name; ?>','mobile':'<?php echo addslashes($getTeacherDetails->mobile); ?>','email':'<?php echo addslashes($getTeacherDetails->email); ?>','password':'<?php echo addslashes($this->encrypt->decode($getTeacherDetails->password)); ?>',
                'photo':'<?php echo $getTeacherDetails->photo; ?>','dob': new Date('<?php echo addslashes($getTeacherDetails->dob); ?>'),'gender':'<?php echo ($getTeacherDetails->gender)?addslashes($getTeacherDetails->gender):''; ?>','blood_group':'<?php echo addslashes($getTeacherDetails->blood_group); ?>',
                'doj':new Date('<?php echo $getTeacherDetails->doj; ?>'),'address':'<?php echo addslashes($getTeacherDetails->address); ?>','city_id':'<?php echo addslashes($getTeacherDetails->city_id); ?>','state_id':'<?php echo addslashes($getTeacherDetails->state_id); ?>',
                'country_id':'<?php echo $getTeacherDetails->country_id; ?>','pincode':'<?php echo addslashes($getTeacherDetails->pincode); ?>','nationality':'<?php echo addslashes($getTeacherDetails->nationality); ?>', 'department_id':'<?php echo addslashes($getTeacherDetails->department_id); ?>',
                'category_id':'<?php echo ($getTeacherDetails->category_id != '0')?$getTeacherDetails->category_id:''; ?>','is_handicapped':'<?php echo addslashes($getTeacherDetails->is_handicapped); ?>','handicap_details':'<?php echo addslashes($getTeacherDetails->handicap_details); ?>',
                'position':'<?php echo $getTeacherDetails->position; ?>','grade':'<?php echo $getTeacherDetails->grade; ?>','qualification':'<?php echo $getTeacherDetails->qualification; ?>','experience':'<?php echo $getTeacherDetails->experience; ?>',
                'experience_details':'<?php echo $getTeacherDetails->experience_details; ?>','home_phone':'<?php echo $getTeacherDetails->home_phone; ?>','emergency_contact':'<?php echo $getTeacherDetails->emergency_contact; ?>','job_title':'<?php echo $getTeacherDetails->job_title; ?>',
                'marital_status':'<?php echo $getTeacherDetails->marital_status; ?>','father_name':'<?php echo $getTeacherDetails->father_name; ?>','mother_name':'<?php echo $getTeacherDetails->mother_name; ?>','spouse_name':'<?php echo $getTeacherDetails->spouse_name; ?>',
                'class_id':'<?php echo $getTeacherDetails->class_id; ?>',
        };
    dataObj.edit_teacher_details.teacher_class_id = [];
    <?php
    if(isset($getTeacherDetails->class_id)){
        $temp_class_id = explode(',',$getTeacherDetails->class_id);
        foreach($getAllClasses as $value){
        if(in_array($value['id'],$temp_class_id)){ ?>
        dataObj.edit_teacher_details.teacher_class_id.push({'id':<?php echo $value['id']; ?>,'name':'<?php echo addslashes($value['name']); ?>','course':'<?php echo addslashes($value['Course']); ?>'});
    <?php } } } ?>
        
    dataObj.edit_teacher_details.customs = {};
    <?php } 
    if(isset($getTeacherDetails->customs) and !empty($getTeacherDetails->customs)){
        foreach($getTeacherDetails->customs as $value){
        ?>
        dataObj.edit_teacher_details.customs.<?php echo $value->field_name; ?> = '<?php echo $value->value; ?>';
    <?php } } ?>
    
     <?php
    if(isset($getAllClasses) and (is_object($getAllClasses) || is_array($getAllClasses))){ 
        foreach($getAllClasses as $value){?>
        dataObj.teacher_class_list.push({'id':<?php echo $value['id']; ?>,'name':'<?php echo addslashes($value['name']); ?>','course':'<?php echo addslashes($value['Course']); ?>'});
    <?php } } ?>
    
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/teacher/teacher-edit.js"></script>
</body>
</html>