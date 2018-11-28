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
        <div class="container-fluid" ng-init="parent_edit.parent_id=<?php echo $parent_id; ?>">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">MANAGE PARENTS</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        <div class="box-top-content pull-right">
                            <a href="<?php echo base_url(); ?>view-parent/<?php echo $parent_id; ?>" class="btn link-text theme-btn">View</a>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='profile'">
                           <div class="tab-content">
                               <div class="tabs" ng-hide="isLoading">
                                <form id="EditParentForm" name="EditParentForm" class="col-12 row" method="post" role="form" novalidate ng-submit="EditParentFormSubmission()">
                                        <div class="row form-box">
                                        <div class="col-sm-12">
                                           <h5 class="title theme-color">Personal Details</h5>
                                        </div>
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">First Name (Parent)<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="first_name" ng-model="parent_edit.first_name" placeholder="First Name" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Last Name<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="last_name" ng-model="parent_edit.last_name" placeholder="Last Name" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Relationship<span class="required theme-color">*</span></label>
                                            <select class="form-control c-select m-b" name="relationship" ng-model="parent_edit.relationship" required>
                                				<option value="">Choose Relationship</option>
                                				<option ng-repeat="relation in form.relation" value="{{relation}}">{{relation}}</option>
                                			  </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Date Of Birth</label>
                                            <md-datepicker class="form-control inline w-100" name="dob" ng-model="parent_edit.dob" md-max-date="today" md-hide-icons="calendar"
                                            md-placeholder="Date Of Birth" md-open-on-focus md-current-view="year" ></md-datepicker>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                          <label class="label-role info pos-rlt">Gender</label>
                            			  <select class="form-control c-select m-b" name="gender" ng-model="parent_edit.gender" >
                            				<option value="">Choose Gender</option>
                            				<option value="Male">Male</option>
                            				<option value="Female">Female</option>
                            				<option value="Others">Others</option>
                            			  </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Education</label>
                                            <input type="text" class="form-control inline" name="education" ng-model="parent_edit.education" placeholder="Education" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Occupation</label>
                                            <input type="text" class="form-control inline" name="occupation" ng-model="parent_edit.occupation" placeholder="Occupation" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Income</label>
                                            <input type="text" class="form-control inline" name="income" ng-model="parent_edit.income" placeholder="Income" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b" >
                                            <label class="label-role info pos-rlt">Password<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="password" ng-model="parent_edit.password" placeholder="Password" value="Welcome@123" required >
                                        </div>
                                        <div class="col-sm-12">
                                           <h5 class="title theme-color">Contact Details</h5>
                                        </div>
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Email<span class="required theme-color">*</span></label>
                                            <input type="email" class="form-control inline" name="email" ng-model="parent_edit.email" placeholder="Email" required >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Mobile<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="mobile" ng-model="parent_edit.mobile" placeholder="Mobile" required ng-minlength="10" ng-maxlength="10">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Office Phone 1</label>
                                            <input type="text" class="form-control inline" name="office_phone" ng-model="parent_edit.office_phone" placeholder="Office Phone 1" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Address<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="address" ng-model="parent_edit.address" placeholder="Address" required ng-minlength="10" ng-maxlength="255">
                                        </div>
                                        
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Country<span class="required theme-color">*</span></label>
                                            <select class="form-control c-select m-b" name="country_id" ng-model="parent_edit.country_id" required ng-change="getPStates()">
                                				<option value="">Choose Country</option>
                                				<?php
                                				if(isset($getAllCountries) and is_array($getAllCountries)){
                                				foreach($getAllCountries as $value){?>
                                				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                				<?php } } ?>
                            			  </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b" ng-init="getStatesForStdEdit()" ng-init="getStatesForStdEdit()">
                                            <label class="label-role info pos-rlt">State<span class="required theme-color">*</span></label>
                                            <select class="form-control c-select m-b" name="state_id" ng-model="parent_edit.state_id" required ng-change="getCities()">
                                				<option value="">Choose State</option>
                                				<option ng-repeat="state in form.states" value="{{state.id}}">{{state.name}}</option>
                                			  </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b" ng-init="getCitiesForStdEdit()" ng-init="getCitiesForStdEdit()">
                                            <label class="label-role info pos-rlt">City<span class="required theme-color">*</span></label>
                                            <select class="form-control c-select m-b" name="city_id" ng-model="parent_edit.city_id" >
                                				<option value="">Choose City</option>
                                				<option ng-repeat="city in form.cities" value="{{city.id}}">{{city.name}}</option>
                                			  </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Pincode/Postal Code<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="pincode" ng-model="parent_edit.pincode" placeholder="Pincode/Postal Code" ng-pattern="/^\d{6}$/" required>
                                        </div>
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && EditParentForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="EditParentForm.first_name.$error.required">First name is mandatory</li>
                                            <li ng-show="EditParentForm.last_name.$error.required">Last name is mandatory</li>
                                            <li ng-show="EditParentForm.relationship.$error.required">Relationship is mandatory</li>
                                            <li ng-show="EditParentForm.address.$error.required">Address is mandatory.</li>
                                            <li ng-show="EditParentForm.address.$error.minlength">Address should be min 10 chars</li>
                                            <li ng-show="EditParentForm.address.$error.maxlength">Address should be max 255 chars</li>
                                            <li ng-show="EditParentForm.country_id.$error.required">Country is mandatory.</li>
                                            <li ng-show="EditParentForm.state_id.$error.required">State is mandatory.</li>
                                            <li ng-show="EditParentForm.city_id.$error.required">City is mandatory.</li>
                                            <li ng-show="EditParentForm.pincode.$error.required">Pincode/Postal Code is mandatory.</li>
                                            <li ng-show="EditParentForm.pincode.$error.pattern">Pincode code should be 5 or 6 digits Number</li>
                                            <li ng-show="EditParentForm.mobile.$error.required">Mobile is mandatory.</li>
                                            <li ng-show="EditParentForm.mobile.$error.minlength">Mobile Number should be 10 Digits Number</li>
                                            <li ng-show="EditParentForm.mobile.$error.maxlength">Mobile Number should be 10 Digits Number</li>
                                            <li ng-show="EditParentForm.mobile.$error.pattern">Mobile Number should be 10 Digits Number</li>
                                            <li ng-show="EditParentForm.email.$error.required">Email is mandatory.</li>
                                            <li ng-show="EditParentForm.email.$error.email">Email should be correct format.</li>
                                            <li ng-show="EditParentForm.password.$error.required">Password is mandatory</li>
                                        </ul>
                                    </div>
                                
                                    <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    </div>
                                <div class="col-12 p-0" >
                                    <button type="submit" class="btn bg-theme" >Update Parent</button>
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
function ParentService($http, $rootScope){
    var dataObj = {
        edit_parent_details : {},
    };
    <?php
    if(isset($getParentFullDetails) and is_object($getParentFullDetails)){ ?>
        dataObj.edit_parent_details = {'id':<?php echo $getParentFullDetails->id; ?>,'first_name':'<?php echo addslashes($getParentFullDetails->first_name); ?>','last_name':'<?php echo $getParentFullDetails->last_name; ?>',
        'mobile':'<?php echo addslashes($getParentFullDetails->mobile); ?>','email':'<?php echo addslashes($getParentFullDetails->email); ?>','relationship':'<?php echo addslashes($getParentFullDetails->relationship); ?>',
        'password':'<?php echo addslashes($this->encrypt->decode($getParentFullDetails->password)); ?>','dob': new Date('<?php echo addslashes($getParentFullDetails->dob); ?>'),'gender':'<?php echo addslashes($getParentFullDetails->gender); ?>',
        'address':'<?php echo addslashes($getParentFullDetails->address); ?>','office_phone':'<?php echo addslashes($getParentFullDetails->office_phone); ?>','city_id':'<?php echo addslashes($getParentFullDetails->city_id); ?>',
        'state_id':'<?php echo addslashes($getParentFullDetails->state_id); ?>','country_id':'<?php echo $getParentFullDetails->country_id; ?>','pincode':'<?php echo addslashes($getParentFullDetails->pincode); ?>',
        
        'education':'<?php echo addslashes($getParentFullDetails->education); ?>','occupation':'<?php echo $getParentFullDetails->occupation; ?>','income':'<?php echo addslashes($getParentFullDetails->income); ?>',
        
        };
    <?php } ?>
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/parent-edit.js"></script>
</body>
</html>