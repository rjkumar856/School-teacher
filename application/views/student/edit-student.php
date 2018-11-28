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
        <div class="container-fluid" ng-init="student_edit.student_id=<?php echo $student_id; ?>">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">MANAGE STUDENTS</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        <div class="box-top-content pull-right">
                            <a href="<?php echo base_url(); ?>view-student/<?php echo $student_id; ?>" class="btn link-text theme-btn">View</a>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='profile'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li class="active"><a class="btn disabled" href="edit-student/<?php echo $student_id; ?>" >Profile</a></li>
                                   <li><a class="btn " href="edit-student/parent/<?php echo $student_id; ?>" >Parents Details</a></li>
                                   <li ><a class="btn " href="edit-student/previous/<?php echo $student_id; ?>" >Previous Details</a></li>
                                   <li><a class="btn " href="edit-student/doc/<?php echo $student_id; ?>" >Documents</a></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                               <div class="tabs" ng-hide="isLoading">
                                <form id="EditStudentForm" enctype="multipart/form-data" method="post" name="EditStudentForm" novalidate class="form-validation col-12 p-0" role="form" ng-submit="UpdateStudentSubmission()">
                                <div class="row form-box">
                        			<div class="form-group col-6 col-md-4 m-b" >
                                        <label class="label-role info pos-rlt">Admission No.<span class="required theme-color">*</span></label>
                                        <input type="number" class="form-control inline" name="admission_number" ng-model="student_edit.admission_number" placeholder="Admission No." required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Admission Date<span class="required theme-color">*</span></label>
                                        <md-datepicker class="form-control inline w-100" md-hide-icons="calendar" name="doj" ng-model="student_edit.doj" 
                                        md-placeholder="Admission Date" md-open-on-focus ></md-datepicker>
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Personal Details</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">First Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="first_name" ng-model="student_edit.first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Middle Name</label>
                                        <input type="text" class="form-control inline" name="middle_name" ng-model="student_edit.middle_name" placeholder="Middle Name" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Last Name<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="last_name" ng-model="student_edit.last_name" placeholder="Last Name" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Roll Number/Student ID<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="roll_number" ng-model="student_edit.roll_number" placeholder="Roll Number/Student ID" required >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Class/Batch</label>
                        			  <select class="form-control c-select m-b" name="class_id" ng-model="student_edit.class_id" >
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
                                        <md-datepicker required class="form-control inline w-100" name="dob" ng-model="student_edit.dob" md-max-date="today" md-hide-icons="calendar"
                                        md-placeholder="Admission Date" md-open-on-focus md-current-view="year" ></md-datepicker>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Gender<span class="required theme-color">*</span></label>
                        			  <select class="form-control c-select m-b" name="gender" ng-model="student_edit.gender" >
                        				<option value="">Choose Gender</option>
                        				<option value="Male">Male</option>
                        				<option value="Female">Female</option>
                        				<option value="Others">Others</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Blood Group</label>
                        			  <select class="form-control c-select m-b" name="blood_group" ng-model="student_edit.blood_group" >
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
                                        <input type="text" class="form-control inline" name="birth_place" ng-model="student_edit.birth_place" placeholder="Birth Place" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Language</label>
                                        <input type="text" class="form-control inline" name="language" ng-model="student_edit.language" placeholder="Language" >
                                    </div>
                                    
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Nationality</label>
                                        <input type="text" class="form-control inline" name="nationality" ng-model="student_edit.nationality" placeholder="Nationality" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Religion</label>
                                        <input type="text" class="form-control inline" name="religion" ng-model="student_edit.religion" placeholder="Religion" >
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Student Category</label>
                        			  <select class="form-control c-select m-b" name="student_category" ng-model="student_edit.student_category" >
                        				<?php
                        				if(isset($getStudentCategories) and is_array($getStudentCategories)){
                        				foreach($getStudentCategories as $value){?>
                        				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        				<?php } } ?>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                      <label class="label-role info pos-rlt">Is Handicapped</label>
                        			  <select class="form-control c-select m-b" name="is_handicapped" ng-model="student_edit.is_handicapped" >
                        				<option value="No">No</option>
                        				<option value="Yes">Yes</option>
                        			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" >
                                        <label class="label-role info pos-rlt">Password<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="password" ng-model="student_edit.password" placeholder="Password" value="Welcome@123" required >
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Other Details</h5>
                                    </div>
                                    <?php
                        				if(isset($getStudentCustomFields) and is_array($getStudentCustomFields)){
                        				foreach($getStudentCustomFields as $value){?>
                            			<div class="form-group col-6 col-md-4 m-b" >
                                            <label class="label-role info pos-rlt"><?php echo $value->name; ?> <?php if(strtolower($value->required) == 'true'){ ?><span class="required theme-color">*</span><?php } ?></label>
                                           <?php if(strtolower($value->type) == 'textarea'){ ?>
                                                <textarea rows="1" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="student_edit.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> ></textarea>
                                           <?php }else{ ?>
                                                <input type="<?php echo strtolower($value->type); ?>" class="form-control inline" name="customs.<?php echo $value->title; ?>" ng-model="student_edit.customs.<?php echo $value->title; ?>" placeholder="<?php echo $value->name; ?>" <?php if(strtolower($value->required) == 'true'){echo "required"; } ?> >
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
                                        <input type="text" class="form-control inline" name="address" ng-model="student_edit.address" placeholder="Address" required ng-minlength="10" ng-maxlength="255">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Country<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="country_id" ng-model="student_edit.country_id" required ng-change="getStates()">
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
                                        <select class="form-control c-select m-b" name="state_id" ng-model="student_edit.state_id" required ng-change="getCities()">
                            				<option value="">Choose State</option>
                            				<option ng-repeat="state in form.states" value="{{state.id}}">{{state.name}}</option>
                            			</select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b" ng-init="getCitiesForStdEdit()">
                                        <label class="label-role info pos-rlt">City<span class="required theme-color">*</span></label>
                                        <select class="form-control c-select m-b" name="city_id" ng-model="student_edit.city_id" >
                            				<option value="">Choose City</option>
                            				<option ng-repeat="city in form.cities" value="{{city.id}}">{{city.name}}</option>
                            			  </select>
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Pincode/Postal Code<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="pincode" ng-model="student_edit.pincode" placeholder="Pincode/Postal Code" ng-pattern="/^\d{5,6}$/" required value="">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Mobile<span class="required theme-color">*</span></label>
                                        <input type="text" class="form-control inline" name="mobile" ng-model="student_edit.mobile" placeholder="Mobile" required ng-pattern="/^\d{10}$/" ng-minlength="10" ng-maxlength="10" value="">
                                    </div>
                                    <div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Email<span class="required theme-color">*</span></label>
                                        <input type="email" class="form-control inline" name="email" ng-model="student_edit.email" placeholder="Email" required value="">
                                    </div>
                                </div>
                                
                                <div class="row form-box">
                                    <div class="col-sm-12">
                                       <h5 class="title header">Profile Picture</h5>
                                    </div>
                        			<div class="form-group col-6 col-md-4 m-b">
                                        <label class="label-role info pos-rlt">Photo</label>
                                        
                                        <div class="box-details1 box-profile text-center" ng-show="student_edit.photo != ''">
                                            <div class="inner">
                                                <span class="btn action-btn btn-delete bg-theme delete-btn" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="bounce" ui-target="#animate" title="Delete this Photo"><i class="fa fa-trash"></i></span>
                                                <img src="assets/files/student/{{ student_edit.photo }}" width="64" alt="" titl="" class="image" >
                                            </div>
                                        </div>
                                        <div class="w-100" ng-hide="student_edit.photo != ''">
                                            <input type="file" class="form-control inline" file-upload="studentPhoto" name="photo" ng-model="student_edit.photo" placeholder="Photo" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row error alert alert-danger" ng-show="formValidation && EditStudentForm.$invalid" >
                                    <ul class="m-0 mt-0 ">
                                        <li ng-show="EditStudentForm.admission_number.$error.required">Admission Number is mandatory.</li>
                                        <li ng-show="student_edit.doj == ''">Admission Date is mandatory.</li>
                                        <li ng-show="EditStudentForm.first_name.$error.required">First name is mandatory</li>
                                        <li ng-show="EditStudentForm.last_name.$error.required">Last name is mandatory</li>
                                        <li ng-show="EditStudentForm.roll_number.$error.required">Roll Number/Student ID is mandatory</li>
                                        <li ng-show="EditStudentForm.dob.$error.required">Date Of Birth is mandatory</li>
                                        <li ng-show="EditStudentForm.address.$error.required">Address is mandatory.</li>
                                        <li ng-show="EditStudentForm.address.$error.minlength">Address should be min 10 chars</li>
                                        <li ng-show="EditStudentForm.address.$error.maxlength">Address should be max 255 chars</li>
                                        <li ng-show="EditStudentForm.country_id.$error.required">Country is mandatory.</li>
                                        <li ng-show="EditStudentForm.state_id.$error.required">State is mandatory.</li>
                                        <li ng-show="EditStudentForm.city_id.$error.required">City is mandatory.</li>
                                        <li ng-show="EditStudentForm.pincode.$error.required">Pincode/Postal Code is mandatory.</li>
                                        <li ng-show="EditStudentForm.pincode.$error.pattern">Pincode code should be 5 or 6 digits Number</li>
                                        <li ng-show="EditStudentForm.mobile.$error.required">Mobile is mandatory.</li>
                                        <li ng-show="EditStudentForm.mobile.$error.minlength">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="EditStudentForm.mobile.$error.maxlength">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="EditStudentForm.mobile.$error.pattern">Mobile Number should be 10 Digits Number</li>
                                        <li ng-show="EditStudentForm.email.$error.required">Email is mandatory.</li>
                                        <li ng-show="EditStudentForm.email.$error.email">Email should be correct format.</li>
                                        <li ng-show="EditStudentForm.password.$error.required">Password is mandatory</li>
                                        <li ng-show="EditStudentForm.gender.$error.required">Gender is mandatory</li>
                                        <?php
                        				if(isset($getStudentCustomFields) and is_array($getStudentCustomFields)){
                        				foreach($getStudentCustomFields as $value){
                        				if(strtolower($value->required) == 'true'){ ?>
                        				<li ng-show="student_edit.customs.<?php echo $value->title; ?> == ''"><?php echo $value->name; ?> is mandatory.</li>
                        				<?php } } } ?>
                                    </ul>
                                </div>
                                
                                <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                    <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                </div>
                                <div class="col-12 p-0" >
                                    <button type="submit" class="btn bg-theme" >Update Student</button>
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
                    <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteStudentPhoto()">Yes</button>
                  </div>
                </div><!-- /.modal-content -->
              </div>
            </div>
        </div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url(); ?>assets/angular/lib/angular-ui-select/dist/select.min.js"></script>
<script>
function ParentService($http, $rootScope){
    var dataObj = {
        edit_student_details : {},
        assigned_parent_list : [],
        assigned_previous_list : [],
        assigned_student_doc_list : [],
    };
    
    <?php
    $row_count = 1;
    if(isset($getStudentDetails) and is_object($getStudentDetails)){ ?>
        dataObj.edit_student_details = {'id':<?php echo $getStudentDetails->student_id; ?>,'roll_number':'<?php echo addslashes($getStudentDetails->roll_number); ?>','first_name':'<?php echo addslashes($getStudentDetails->first_name); ?>','middle_name':'<?php echo addslashes($getStudentDetails->middle_name); ?>',
                'last_name':'<?php echo $getStudentDetails->last_name; ?>','mobile':'<?php echo addslashes($getStudentDetails->mobile); ?>','email':'<?php echo addslashes($getStudentDetails->email); ?>','password':'<?php echo addslashes($this->encrypt->decode($getStudentDetails->password)); ?>',
                'photo':'<?php echo $getStudentDetails->photo; ?>','dob': new Date('<?php echo addslashes($getStudentDetails->dob); ?>'),'gender':'<?php echo addslashes($getStudentDetails->gender); ?>','blood_group':'<?php echo addslashes($getStudentDetails->blood_group); ?>',
                'doj':new Date('<?php echo $getStudentDetails->doj; ?>'),'address':'<?php echo addslashes($getStudentDetails->address); ?>','city_id':'<?php echo addslashes($getStudentDetails->city_id); ?>','state_id':'<?php echo addslashes($getStudentDetails->state_id); ?>',
                'country_id':'<?php echo $getStudentDetails->country_id; ?>','pincode':'<?php echo addslashes($getStudentDetails->pincode); ?>','admission_number':<?php echo addslashes($getStudentDetails->admission_number); ?>,
                'birth_place':'<?php echo $getStudentDetails->birth_place; ?>','nationality':'<?php echo addslashes($getStudentDetails->nationality); ?>','language':'<?php echo addslashes($getStudentDetails->language); ?>','religion':'<?php echo addslashes($getStudentDetails->religion); ?>',
                'student_category':'<?php echo $getStudentDetails->student_category; ?>','is_handicapped':'<?php echo addslashes($getStudentDetails->is_handicapped); ?>','handicap_details':'<?php echo addslashes($getStudentDetails->handicap_details); ?>','class_id':'<?php echo addslashes($getStudentDetails->class_id); ?>'
        };
        
    dataObj.edit_student_details.customs = {};
    <?php } 
    if(isset($getStudentDetails->customs) and !empty($getStudentDetails->customs)){
        foreach($getStudentDetails->customs as $value){
        ?>
        dataObj.edit_student_details.customs.<?php echo $value->field_name; ?> = '<?php echo $value->value; ?>';
    <?php } } ?>
    
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/student-edit.js"></script>
</body>
</html>