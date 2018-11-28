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
        <div class="container-fluid" ng-init="student_edit.student_id='<?php echo $student_id; ?>'">
            <div class=" row" ng-init="parent_add.student_id='<?php echo $student_id; ?>'">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">MANAGE STUDENTS</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        <div class="box-top-content pull-right">
                            <a href="<?php echo base_url(); ?>view-student/<?php echo $student_id; ?>" class="btn link-text theme-btn">View</a>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='parents'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li><a class="btn" href="edit-student/<?php echo $student_id; ?>" >Profile</a></li>
                                   <li class="active"><a class="btn disabled" href="edit-student/parent/<?php echo $student_id; ?>" >Parents Details</a></li>
                                   <li><a class="btn" href="edit-student/previous/<?php echo $student_id; ?>" >Previous Details</a></li>
                                   <li><a class="btn" href="edit-student/doc/<?php echo $student_id; ?>" >Documents</a></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                            <div ng-show="isLoading" class="text-center row loader big"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
                            <div class="tabs in show" ng-hide="isLoading">
                                <div class="row form-box m-0" >
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Parent's Details</h5>
                                    </div>
                                    <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                    </div>
                                    <table class="table-list table-striped table m-b-none" >
                                        <thead>
                                        <tr>
                                            <th>#</th><th>Name</th><th>Relation</th><th>Mobile</th><th>Email</th><th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="parent in ParentService.assigned_parent_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ parent.first_name +' '+ parentlast_name }}</td>
                                              <td>{{ parent.relationship }}</td>
                                              <td>{{ parent.mobile }}</td>
                                              <td>{{ parent.email }}</td>
                                              <td>
                                                   <a href="/users/edit_user/{{parent.id}}" class="btn action-btn btn-edit"><i class="fa fa-pencil"></i></a>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteAssignedID(parent.assingned_id)" title="Delete this Assigned List"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Assign Parents</h5>
                                    </div>
                                    
                                    <div class="w-100 d-inline-block">
                                        <form class="col-12 row" id="SetTypeForm" name="SetTypeForm" role="form" novalidate>
                                        <div class="form-group radio radio-info d-inline-block ">
                                            <input type="radio" id="parent_adding_type_new" name="parent_adding_type" value="new" ng-model="parent_add.parent_adding_type" >
                                            <label for="parent_adding_type_new">New Parent</label>
                                        </div>
                                        <div class="form-group radio radio-info d-inline-block ml-2">
                                            <input type="radio" id="parent_adding_type_existing" name="parent_adding_type" value="existing" ng-model="parent_add.parent_adding_type" >
                                            <label for="parent_adding_type_existing">Already Exisitng</label>
                                        </div>
                                        </form>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" data-ng-show="parent_add.parent_adding_type == 'existing'">
                                        <div class="col-sm-12">
                                           <h5 class="title theme-color">Search By</h5>
                                        </div>
                                        <form class="col-12 row" id="searchByParentForm" name="searchByParentForm" role="form" novalidate>
                                        <div class="col-4 col-md-3 form-group m-b">
                                            <label class="label-role info pos-rlt">Sibiling</label>
                                            <ui-select ng-model="parent_search.sibiling.selected" ng-change="selecetedSibiling()" theme="bootstrap" ng-disabled="disabled" reset-search-input="false" style="width: 300px;">
                                              <ui-select-match class="ui-select-match" placeholder="Enter a Sibiling...">{{ $select.selected.first_name }} ({{ $select.selected.roll_number }})</ui-select-match>
                                              <ui-select-choices class="ui-select-choices" repeat="students in student_name track by $index" refresh="refreshSibilings($select.search)" refresh-delay="0">
                                                <div ng-bind-html="(students.first_name | highlight: $select.search) + ' ' + (students.last_name | highlight: $select.search)"></div>
                                                <small>
                                                    Roll No.: {{students.roll_number}}
                                                 </small>
                                              </ui-select-choices>
                                            </ui-select>
                                        </div>
                             
                                        <div class="col-4 col-md-3 form-group m-b">
                                            <label class="label-role info pos-rlt">Name</label>
                                            <ui-select ng-model="parent_search.name.selected" ng-change="selecetedParentName()" theme="bootstrap" ng-disabled="disabled" reset-search-input="false" style="width: 300px;">
                                              <ui-select-match class="ui-select-match" placeholder="Enter a Parent Name...">{{ $select.selected.first_name }} {{ $select.selected.last_name }}</ui-select-match>
                                              <ui-select-choices class="ui-select-choices" repeat="parent in parent_name track by $index" refresh="refreshParentName($select.search)" refresh-delay="0">
                                                <div ng-bind-html="(parent.first_name | highlight: $select.search) + ' ' + (parent.last_name | highlight: $select.search) | highlight: $select.search"></div>
                                              </ui-select-choices>
                                            </ui-select>
                                        </div>
                                        
                                        <div class="col-4 col-md-3 form-group m-b">
                                            <label class="label-role info pos-rlt">Mobile</label>
                                            <ui-select ng-model="parent_search.mobile.selected" ng-change="selecetedParentMobile()" theme="bootstrap" ng-disabled="disabled" reset-search-input="false" style="width: 300px;">
                                              <ui-select-match class="ui-select-match" placeholder="Enter a Mobile...">{{ $select.selected.mobile }}</ui-select-match>
                                              <ui-select-choices class="ui-select-choices" repeat="parent in parent_mobile track by $index" refresh="refreshParentMobile($select.search)" refresh-delay="0">
                                                <div ng-bind-html="parent.mobile | highlight: $select.search"></div>
                                              </ui-select-choices>
                                            </ui-select>
                                        </div>
                                        
                                        <div class="col-4 col-md-3 form-group m-b">
                                            <label class="label-role info pos-rlt">Email</label>
                                            <ui-select ng-model="parent_search.email.selected" ng-change="selecetedParentEmail()" theme="bootstrap" ng-disabled="disabled" reset-search-input="false" style="width: 300px;">
                                              <ui-select-match class="ui-select-match" placeholder="Enter an Email...">{{ $select.selected.email }}</ui-select-match>
                                              <ui-select-choices class="ui-select-choices" repeat="parent in parent_email track by $index" refresh="refreshParentEmail($select.search)" refresh-delay="0">
                                                <div ng-bind-html="parent.email | highlight: $select.search"></div>
                                              </ui-select-choices>
                                            </ui-select>
                                        </div>
                                        <div ng-show="isSearchLoading" class="text-center col-12 row loader small"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
                                        <div ng-hide="isSearchLoading" class="col-12 p-0" >
                                            <button type="search" class="btn btn-info" >Search</button>
                                        </div>
                                        </form>
                                        
                                        <div class="row" ng-show="AjaxRequestCodeAssign != '' && AjaxRequestStatusAssign != ''">
                                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusAssign" ng-hide="AjaxRequestCodeAssign == 200"><strong>{{ AjaxRequestStatusAssign }}</strong></div>
                                        </div>
                                        
                                        <div class="row form-box m-0" ng-show="search_parent_list.length > 0 && !isSearchLoading" >
                                            <div class="col-sm-12 p-0">
                                               <h5 class="title header">Existing Parent(s)</h5>
                                            </div>
                                            <form class="col-12 row" id="AssignParentForm" name="AssignParentForm" role="form" novalidate>
                                            <table class="table-list table-striped table m-b-none">
                                                <thead>
                                                <tr>
                                                    <th>All <input type="checkbox" class="ml-1" ng-click="toggleAllParent()" name="select_all" ng-model="parent_assign.select_all" /></th><th>Name</th><th>Relation</th><th>Mobile</th><th>Email</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="parent in search_parent_list">
                                                      <td><input type="checkbox" name="parent_id" ng-model="parent.selected" value="{{parent.id}}" ng-change="optionToggledParent()" /></td>
                                                      <td>{{parent.first_name}} {{parent.last_name}}</td>
                                                      <td>{{parent.relationship}}</td>
                                                      <td>{{parent.mobile}}</td>
                                                      <td>{{parent.email}}</td>
                                                 </tr>
                                              </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-info" ng-click="assignParentsToStudent()" >Assign</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" data-ng-show="parent_add.parent_adding_type == 'new'">
                                    <form id="AddParentForm" name="AddParentForm" class="col-12 row" method="post" role="form" novalidate ng-submit="addNewParentSubmission()">
                                        <div class="row form-box">
                                        <div class="col-sm-12">
                                           <h5 class="title theme-color">Personal Details</h5>
                                        </div>
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">First Name (Parent)<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="first_name" ng-model="parent_add.first_name" placeholder="First Name" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Last Name<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="last_name" ng-model="parent_add.last_name" placeholder="Last Name" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Relationship<span class="required theme-color">*</span></label>
                                            <select class="form-control c-select m-b" name="relationship" ng-model="parent_add.relationship" required>
                                				<option value="">Choose Relationship</option>
                                				<option ng-repeat="relation in form.relation" value="{{relation}}">{{relation}}</option>
                                			  </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Date Of Birth</label>
                                            <md-datepicker class="form-control inline w-100" name="dob" ng-model="parent_add.dob" md-max-date="today" md-hide-icons="calendar"
                                            md-placeholder="Date Of Birth" md-open-on-focus md-current-view="year" ></md-datepicker>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                          <label class="label-role info pos-rlt">Gender</label>
                            			  <select class="form-control c-select m-b" name="gender" ng-model="parent_add.gender" >
                            				<option value="">Choose Gender</option>
                            				<option value="Male">Male</option>
                            				<option value="Female">Female</option>
                            				<option value="Others">Others</option>
                            			  </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Education</label>
                                            <input type="text" class="form-control inline" name="education" ng-model="parent_add.education" placeholder="Education" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Occupation</label>
                                            <input type="text" class="form-control inline" name="occupation" ng-model="parent_add.occupation" placeholder="Occupation" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Income</label>
                                            <input type="text" class="form-control inline" name="income" ng-model="parent_add.income" placeholder="Income" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b" >
                                            <label class="label-role info pos-rlt">Password<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="password" ng-model="parent_add.password" placeholder="Password" value="Welcome@123" required >
                                        </div>
                                        <div class="col-sm-12">
                                           <h5 class="title theme-color">Contact Details</h5>
                                        </div>
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Email<span class="required theme-color">*</span></label>
                                            <input type="email" class="form-control inline" name="email" ng-model="parent_add.email" placeholder="Email" required >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Mobile<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="mobile" ng-model="parent_add.mobile" placeholder="Mobile" required ng-minlength="10" ng-maxlength="10">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Office Phone 1</label>
                                            <input type="text" class="form-control inline" name="office_phone" ng-model="parent_add.office_phone" placeholder="Office Phone 1" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Address<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="address" ng-model="parent_add.address" placeholder="Address" required ng-minlength="10" ng-maxlength="255">
                                        </div>
                                        
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Country<span class="required theme-color">*</span></label>
                                            <select class="form-control c-select m-b" name="country" ng-model="parent_add.country" required ng-change="getPStates()">
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
                                            <select class="form-control c-select m-b" name="state" ng-model="parent_add.state" required ng-change="getPCities()">
                                				<option value="">Choose State</option>
                                				<option ng-repeat="state in form.states" value="{{state.id}}">{{state.name}}</option>
                                			</select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">City<span class="required theme-color">*</span></label>
                                            <select class="form-control c-select m-b" name="city" ng-model="parent_add.city" >
                                				<option value="">Choose City</option>
                                				<option ng-repeat="city in form.cities" value="{{city.id}}">{{city.name}}</option>
                                			</select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Pincode/Postal Code<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="pincode" ng-model="parent_add.pincode" placeholder="Pincode/Postal Code" ng-pattern="/^\d{6}$/" required>
                                        </div>
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddParentForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddParentForm.first_name.$error.required">First name is mandatory</li>
                                            <li ng-show="AddParentForm.last_name.$error.required">Last name is mandatory</li>
                                            <li ng-show="AddParentForm.relationship.$error.required">Relationship is mandatory</li>
                                            <li ng-show="AddParentForm.address.$error.required">Address is mandatory.</li>
                                            <li ng-show="AddParentForm.address.$error.minlength">Address should be min 10 chars</li>
                                            <li ng-show="AddParentForm.address.$error.maxlength">Address should be max 255 chars</li>
                                            <li ng-show="AddParentForm.country.$error.required">Country is mandatory.</li>
                                            <li ng-show="AddParentForm.state.$error.required">State is mandatory.</li>
                                            <li ng-show="AddParentForm.city.$error.required">City is mandatory.</li>
                                            <li ng-show="AddParentForm.pincode.$error.required">Pincode/Postal Code is mandatory.</li>
                                            <li ng-show="AddParentForm.pincode.$error.pattern">Pincode code should be 5 or 6 digits Number</li>
                                            <li ng-show="AddParentForm.mobile.$error.required">Mobile is mandatory.</li>
                                            <li ng-show="AddParentForm.mobile.$error.minlength">Mobile Number should be 10 Digits Number</li>
                                            <li ng-show="AddParentForm.mobile.$error.maxlength">Mobile Number should be 10 Digits Number</li>
                                            <li ng-show="AddParentForm.mobile.$error.pattern">Mobile Number should be 10 Digits Number</li>
                                            <li ng-show="AddParentForm.email.$error.required">Email is mandatory.</li>
                                            <li ng-show="AddParentForm.email.$error.email">Email should be correct format.</li>
                                            <li ng-show="AddParentForm.password.$error.required">Password is mandatory</li>
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
                                            <button type="submit" class="btn bg-theme" >Add Parent</button>
                                            <button type="reset" class="btn btn-info">Clear</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
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
                <p>Are you sure to delete this Item?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deleteAssignedIDCancel()">No</button>
                <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteAssignedID()">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div>
        </div>
</div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>

<script src="<?php echo base_url(); ?>assets/angular/lib/angular-ui-select/dist/select.min.js"></script>
<script>
function ParentService(){
    var dataObj = {
        edit_student_details : {},
        assigned_parent_list : [],
        assigned_previous_list : [],
        assigned_student_doc_list : [],
    };
    <?php
    $row_count = 1;
    if(isset($getParentDetails) and is_array($getParentDetails)){
    foreach($getParentDetails as $value){ ?>
    dataObj.assigned_parent_list.push({'id':<?php echo $value['id']; ?>,'first_name':'<?php echo $value['first_name']; ?>','last_name':'<?php echo $value['last_name']; ?>',
    'email':'<?php echo $value['email']; ?>','relationship':'<?php echo $value['relationship']; ?>','mobile':'<?php echo $value['mobile']; ?>','assingned_id':'<?php echo $value['assingned_id']; ?>'});
    <?php }} ?>
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/student-edit.js"></script>
</body>
</html>