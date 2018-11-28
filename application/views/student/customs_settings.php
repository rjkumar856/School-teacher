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
        <div class="container-fluid" >
            <div class=" row" >
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">STUDENT'S Custom Setting</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        
                        <div class="box-content" ng-init="tabs='settings'">
                            <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li ng-class="{ active: tabs=='settings'}"><button class="btn" tab-click="settings" >Custom Settings</button></li>
                                   <li ng-class="{ active: tabs=='fields'}"><button class="btn " tab-click="fields">Custom Fields</button></li>
                                   <li ng-class="{ active: tabs=='category'}"><button class="btn " tab-click="category">Student Category</button></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                            <div ng-show="isLoading" class="text-center row loader big"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
                            <div class="tabs in show" ng-hide="isLoading || tabs!='settings'">
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Custom Settings</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="CustomSettingForm" name="CustomSettingForm" class=" w-100" method="post" role="form" novalidate ng-submit="CustomSettingFormSubmission()">
                                        <div class="row w-100 form-box m-0">
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Roll Number Prefix<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="student_roll_number_prefix" ng-model="custom_settings.student_roll_number_prefix" placeholder="Roll Number Prefix" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Default Password for Student<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="default_student_password" ng-model="custom_settings.default_student_password" placeholder="Default Password for Student" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Default Password for Parent<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="default_parent_password" ng-model="custom_settings.default_parent_password" placeholder="Default Password for Parent" required ng-maxlength="255">
                                        </div>
                                        </div>
                                        <div class="row w-100 error alert alert-danger m-0 mb-2" ng-show="formValidation && CustomSettingForm.$invalid" >
                                            <ul class="m-0 mt-0 m-0">
                                                <li ng-show="CustomSettingForm.student_roll_number_prefix.$error.required">Roll Number Prefix is mandatory</li>
                                                <li ng-show="CustomSettingForm.student_roll_number_prefix.$error.maxlength">Roll Number Prefix should be max 255chars</li>
                                                <li ng-show="CustomSettingForm.default_student_password.$error.required">Default Password for Student Address is mandatory</li>
                                                <li ng-show="CustomSettingForm.default_parent_password.$error.required">Default Password for Parent is mandatory</li>
                                            </ul>
                                        </div>
                                
                                    <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    </div>
                                    <div class="col-12 p-0" >
                                        <button type="submit" class="btn bg-theme" >Update Details</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            
                            <div class="tabs in show" ng-hide="isLoading || tabs!='fields'">
                                <div class="row form-box m-0" >
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Student Custom Fields</h5>
                                    </div>
                                    <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                    </div>
                                    <table class="table-list table-striped table m-b-none" >
                                        <thead>
                                        <tr>
                                            <th>#</th><th>Name</th><th>Type</th><th>Required</th><th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="previous in CustomService.custom_fields_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ previous.name }}</td>
                                              <td>{{ previous.type }}</td>
                                              <td>{{ previous.required }}</td>
                                              <td>
                                                   <button class="btn action-btn btn-edit" data-toggle="modal" data-target="#UpdateModalFields" ui-toggle-class="bounce" ui-target="#animateModal" ng-click="SetEditFieldID(previous.id)" title="Update this Details"><i class="fa fa-pencil"></i></button>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#deleteModalFields" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteFieldID(previous.id)" title="Delete this Fields"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Add Student CUSTOM FIELDS</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="AddStudentCustomFieldForm" name="AddStudentCustomFieldForm" class="col-12 row" method="post" role="form" novalidate ng-submit="AddStudentCustomFieldFormSubmission()">
                                        <div class="row form-box w-100">
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Field Name<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="name" ng-model="custom_field.name" placeholder="Field Name" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Type<span class="required theme-color">*</span></label>
                                            <select name="type" class="form-control inline" ng-model="custom_field.type" required>
                                                <option value="">Select a Field Type</option>
                                                <option ng-repeat="value in form.types" value="{{value}}">{{ value }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Required<span class="required theme-color">*</span></label>
                                            <select name="required" class="form-control inline" ng-model="custom_field.required" required>
                                                <option value="">Required</option>
                                                <option ng-repeat="value in form.requires" value="{{value}}">{{ value }}</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddStudentCustomFieldForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddStudentCustomFieldForm.name.$error.required">Field Name is mandatory</li>
                                            <li ng-show="AddStudentCustomFieldForm.name.$error.maxlength">Field Name should be max 255chars</li>
                                            <li ng-show="AddStudentCustomFieldForm.type.$error.required">Field Type Address is mandatory</li>
                                            <li ng-show="AddStudentCustomFieldForm.required.$error.required">Required is mandatory</li>
                                        </ul>
                                    </div>
                                
                                    <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    </div>
                                        <div class="col-12 p-0" >
                                            <button type="submit" class="btn bg-theme" >Add Details</button>
                                            <button type="reset" class="btn btn-info">Clear</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            
                            <div class="tabs in show" ng-hide="isLoading || tabs!='category'">
                                <div class="row form-box m-0" >
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Student Category</h5>
                                    </div>
                                    <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                    </div>
                                    <table class="table-list table-striped table m-b-none" >
                                        <thead>
                                        <tr>
                                            <th>#</th><th>Name</th><th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="previous in CustomService.category_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ previous.name }}</td>
                                              <td>
                                                   <button class="btn action-btn btn-edit" data-toggle="modal" data-target="#UpdateModalCategory" ui-toggle-class="bounce" ui-target="#animateModal" ng-click="SetEditCategoryID(previous.id)" title="Update this Category"><i class="fa fa-pencil"></i></button>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#deleteModalCategory" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteCategoryID(previous.id)" title="Delete this Category"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Add Student Category</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="AddStudentCategoryForm" name="AddStudentCategoryForm" class="col-12 row" method="post" role="form" novalidate ng-submit="AddStudentCategoryFormSubmission()">
                                        <div class="row form-box w-100">
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Category Name<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="name" ng-model="student_category.name" placeholder="Category Name" required ng-maxlength="255">
                                        </div>
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddStudentCategoryForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddStudentCategoryForm.name.$error.required">Field Name is mandatory</li>
                                            <li ng-show="AddStudentCategoryForm.name.$error.maxlength">Field Name should be max 255chars</li>
                                        </ul>
                                    </div>
                                
                                    <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    </div>
                                        <div class="col-12 p-0" >
                                            <button type="submit" class="btn bg-theme" >Add Details</button>
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
        
        <div id="deleteModalFields" class="modal fade animate" data-backdrop="true">
          <div class="modal-dialog" id="animate">
            <div class="modal-content">
              <div class="modal-body text-center p-lg pt-5">
                <p class="questions">Are you sure to delete this Fields?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deleteCustomFieldsIDCancel()">No</button>
                <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteCustomFieldsID()">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div>
        </div>
        
        <div id="UpdateModalFields" class="modal fade animate with-form" data-backdrop="true">
          <div class="modal-dialog" id="animateModal">
            <div class="modal-content">
            <div ng-show="isLoadingEdit" class="text-center row loader small"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
            <form ng-hide="isLoadingEdit" id="EditStudentCustomFieldForm" name="EditStudentCustomFieldForm" class="w-100" method="post" role="form" novalidate ng-submit="EditStudentCustomFieldFormSubmission()">
              <div class="modal-header text-left p-lg pt-0 pb-1">
                <h3 class="theme-color title">Update Student CUSTOM FIELDS</h3>
              </div>
              <div class="modal-body p-lg pt-3 w-100">
                    <div class="row form-box w-100 m-0" >
                            <div class="row form-box w-100">
                    			<div class="form-group col-6 m-b">
                                    <label class="label-role info pos-rlt">Field Name<span class="required theme-color">*</span></label>
                                    <input type="text" class="form-control inline" name="name" ng-model="custom_field_edit.name" placeholder="Field Name" required ng-maxlength="255">
                                </div>
                                <div class="form-group col-6 m-b">
                                    <label class="label-role info pos-rlt">Type<span class="required theme-color">*</span></label>
                                    <select name="type" class="form-control inline" ng-model="custom_field_edit.type" required>
                                        <option value="">Select a Field Type</option>
                                        <option ng-repeat="value in form.types" value="{{value}}">{{ value }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 m-b">
                                    <label class="label-role info pos-rlt">Required<span class="required theme-color">*</span></label>
                                    <select name="required" class="form-control inline" ng-model="custom_field_edit.required" required>
                                        <option value="">Required</option>
                                        <option ng-repeat="value in form.requires" value="{{value}}">{{ value }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row error alert alert-danger m-0 mb-2" ng-show="EditStudentCustomFieldForm.$invalid" >
                            <ul class="m-0 mt-0 ">
                                <li ng-show="EditStudentCustomFieldForm.name.$error.required">Field Name is mandatory</li>
                                <li ng-show="EditStudentCustomFieldForm.name.$error.maxlength">Field Name should be max 255chars</li>
                                <li ng-show="EditStudentCustomFieldForm.type.$error.required">Field Type Address is mandatory</li>
                                <li ng-show="EditStudentCustomFieldForm.required.$error.required">Required is mandatory</li>
                            </ul>
                        </div>
                    
                        <div class="row" ng-show="AjaxRequestCodeEdit != '' && AjaxRequestStatusEdit != ''">
                            <div class="alert alert-success" ng-bind-html="AjaxRequestStatusEdit" ng-show="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusEdit" ng-hide="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary " data-dismiss="modal" data-ng-click="SetEditFieldIDCancel()" >Close</button>
                <button type="submit" class="btn btn-success" >Update</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div>
        </div>
        
        <div id="deleteModalCategory" class="modal fade animate" data-backdrop="true">
          <div class="modal-dialog" id="animate">
            <div class="modal-content">
              <div class="modal-body text-center p-lg pt-5">
                <p class="questions">Are you sure to delete this Category?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deleteCustomCategoryIDCancel()">No</button>
                <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteStudentCategoryID()">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div>
        </div>
        
        <div id="UpdateModalCategory" class="modal fade animate with-form" data-backdrop="true">
          <div class="modal-dialog" id="animateModal">
            <div class="modal-content">
            <div ng-show="isLoadingEdit" class="text-center row loader small"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
            <form ng-hide="isLoadingEdit" id="EditStudentCategoryForm" name="EditStudentCategoryForm" class="w-100" method="post" role="form" novalidate ng-submit="EditStudentCategoryFormSubmission()">
              <div class="modal-header text-left p-lg pt-0 pb-1">
                <h3 class="theme-color title">Update Student Category</h3>
              </div>
              <div class="modal-body p-lg pt-3 w-100">
                    <div class="row form-box w-100 m-0" >
                            <div class="row form-box w-100">
                    			<div class="form-group col-6 m-b">
                                    <label class="label-role info pos-rlt">Name<span class="required theme-color">*</span></label>
                                    <input type="text" class="form-control inline" name="name" ng-model="edit_category.name" placeholder="Category Name" required ng-maxlength="255">
                                </div>
                            </div>
                            <div class="row error alert alert-danger m-0 mb-2" ng-show="EditStudentCategoryForm.$invalid" >
                            <ul class="m-0 mt-0 ">
                                <li ng-show="EditStudentCategoryForm.name.$error.required">Category Name is mandatory</li>
                                <li ng-show="EditStudentCategoryForm.name.$error.maxlength">Category Name should be max 255chars</li>
                            </ul>
                        </div>
                    
                        <div class="row" ng-show="AjaxRequestCodeEdit != '' && AjaxRequestStatusEdit != ''">
                            <div class="alert alert-success" ng-bind-html="AjaxRequestStatusEdit" ng-show="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusEdit" ng-hide="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary " data-dismiss="modal" data-ng-click="SetEditCategoryIDCancel()" >Close</button>
                <button type="submit" class="btn btn-success" >Update</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div>
        </div>
</div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url(); ?>assets/angular/lib/angular-ui-select/dist/select.min.js"></script>
<script>
function CustomService(){
    var dataObj = {
        custom_settings : {},
        custom_fields_list : [],
        category_list : [],
    };
    <?php
    if(isset($getStudentCustomSettings) and is_array($getStudentCustomSettings)){
    foreach($getStudentCustomSettings as $value){ ?>
    dataObj.custom_settings['<?php echo $value->options; ?>'] = '<?php echo $value->value; ?>';
    <?php }} ?>
    
    <?php
    if(isset($getStudentCustomFields) and is_array($getStudentCustomFields)){
    foreach($getStudentCustomFields as $value){ ?>
    dataObj.custom_fields_list.push({'id': '<?php echo $value->id; ?>','name':'<?php echo $value->name; ?>','title':'<?php echo $value->title; ?>',
    'type':'<?php echo $value->type; ?>','used_for':'<?php echo $value->used_for; ?>','required':'<?php echo $value->required; ?>','status':'<?php echo $value->status; ?>' });
    <?php }} ?>
    
    <?php
    if(isset($getStudentCategories) and is_array($getStudentCategories)){
    foreach($getStudentCategories as $value){ ?>
    dataObj.category_list.push({'id': '<?php echo $value->id; ?>','name':'<?php echo $value->name; ?>','status':'<?php echo $value->status; ?>' });
    <?php }} ?>
    
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/custom_settings.js"></script>
</body>
</html>