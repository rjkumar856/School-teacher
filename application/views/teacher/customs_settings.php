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
        <div class="container-fluid" >
            <div class=" row" >
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">Teacher'S Custom Setting</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        
                        <div class="box-content" ng-init="tabs='settings'">
                            <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li ng-class="{ active: tabs=='settings'}"><button class="btn" tab-click="settings" >Custom Settings</button></li>
                                   <li ng-class="{ active: tabs=='fields'}"><button class="btn " tab-click="fields">Custom Fields</button></li>
                                   <li ng-class="{ active: tabs=='category'}"><button class="btn " tab-click="category">Teacher Category</button></li>
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
                                            <label class="label-role info pos-rlt">Teacher ID Prefix<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="teacher_id_prefix" ng-model="custom_settings.teacher_id_prefix" placeholder="Teacher ID" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Default Password for Teacher<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="default_teacher_password" ng-model="custom_settings.default_teacher_password" placeholder="Default Password for Teacher" required ng-maxlength="255">
                                        </div>
                                        </div>
                                        <div class="row w-100 error alert alert-danger m-0 mb-2" ng-show="formValidation && CustomSettingForm.$invalid" >
                                            <ul class="m-0 mt-0 m-0">
                                                <li ng-show="CustomSettingForm.teacher_id_prefix.$error.required">Teacher ID Prefix is mandatory</li>
                                                <li ng-show="CustomSettingForm.teacher_id_prefix.$error.maxlength">Teacher ID Prefix should be max 255chars</li>
                                                <li ng-show="CustomSettingForm.default_teacher_password.$error.required">Default Password for Teacher Address is mandatory</li>
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
                                       <h5 class="title header">Teacher Custom Fields</h5>
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
                                        <tr ng-repeat="custom_fields in CustomService.custom_fields_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ custom_fields.name }}</td>
                                              <td>{{ custom_fields.type }}</td>
                                              <td>{{ custom_fields.required }}</td>
                                              <td>
                                                   <button class="btn action-btn btn-edit" data-toggle="modal" data-target="#UpdateModalFields" ui-toggle-class="bounce" ui-target="#animateModal" ng-click="SetEditFieldID(custom_fields.id)" title="Update this Details"><i class="fa fa-pencil"></i></button>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#deleteModalFields" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteFieldID(custom_fields.id)" title="Delete this Fields"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Add Teacher CUSTOM FIELDS</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="AddTeacherCustomFieldForm" name="AddTeacherCustomFieldForm" class="col-12 row" method="post" role="form" novalidate ng-submit="AddTeacherCustomFieldFormSubmission()">
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
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddTeacherCustomFieldForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddTeacherCustomFieldForm.name.$error.required">Field Name is mandatory</li>
                                            <li ng-show="AddTeacherCustomFieldForm.name.$error.maxlength">Field Name should be max 255chars</li>
                                            <li ng-show="AddTeacherCustomFieldForm.type.$error.required">Field Type Address is mandatory</li>
                                            <li ng-show="AddTeacherCustomFieldForm.required.$error.required">Required is mandatory</li>
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
                                       <h5 class="title header">Teacher Category</h5>
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
                                        <tr ng-repeat="category in CustomService.category_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ category.name }}</td>
                                              <td>
                                                   <button class="btn action-btn btn-edit" data-toggle="modal" data-target="#UpdateModalCategory" ui-toggle-class="bounce" ui-target="#animateModal" ng-click="SetEditCategoryID(category.id)" title="Update this Category"><i class="fa fa-pencil"></i></button>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#deleteModalCategory" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteCategoryID(category.id)" title="Delete this Category"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Add Teacher Category</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="AddTeacherCategoryForm" name="AddTeacherCategoryForm" class="col-12 row" method="post" role="form" novalidate ng-submit="AddTeacherCategoryFormSubmission()">
                                        <div class="row form-box w-100">
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Category Name<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="name" ng-model="teacher_category.name" placeholder="Category Name" required ng-maxlength="255">
                                        </div>
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddTeacherCategoryForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddTeacherCategoryForm.name.$error.required">Field Name is mandatory</li>
                                            <li ng-show="AddTeacherCategoryForm.name.$error.maxlength">Field Name should be max 255chars</li>
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
            <form ng-hide="isLoadingEdit" id="EditTeacherCustomFieldForm" name="EditTeacherCustomFieldForm" class="w-100" method="post" role="form" novalidate ng-submit="EditTeacherCustomFieldFormSubmission()">
              <div class="modal-header text-left p-lg pt-0 pb-1">
                <h3 class="theme-color title">Update Teacher CUSTOM FIELDS</h3>
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
                            <div class="row error alert alert-danger m-0 mb-2" ng-show="EditTeacherCustomFieldForm.$invalid" >
                            <ul class="m-0 mt-0 ">
                                <li ng-show="EditTeacherCustomFieldForm.name.$error.required">Field Name is mandatory</li>
                                <li ng-show="EditTeacherCustomFieldForm.name.$error.maxlength">Field Name should be max 255chars</li>
                                <li ng-show="EditTeacherCustomFieldForm.type.$error.required">Field Type Address is mandatory</li>
                                <li ng-show="EditTeacherCustomFieldForm.required.$error.required">Required is mandatory</li>
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
                <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteTeacherCategoryID()">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div>
        </div>
        
        <div id="UpdateModalCategory" class="modal fade animate with-form" data-backdrop="true">
          <div class="modal-dialog" id="animateModal">
            <div class="modal-content">
            <div ng-show="isLoadingEdit" class="text-center row loader small"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
            <form ng-hide="isLoadingEdit" id="EditTeacherCategoryForm" name="EditTeacherCategoryForm" class="w-100" method="post" role="form" novalidate ng-submit="EditTeacherCategoryFormSubmission()">
              <div class="modal-header text-left p-lg pt-0 pb-1">
                <h3 class="theme-color title">Update Teacher Category</h3>
              </div>
              <div class="modal-body p-lg pt-3 w-100">
                    <div class="row form-box w-100 m-0" >
                            <div class="row form-box w-100">
                    			<div class="form-group col-6 m-b">
                                    <label class="label-role info pos-rlt">Name<span class="required theme-color">*</span></label>
                                    <input type="text" class="form-control inline" name="name" ng-model="edit_category.name" placeholder="Category Name" required ng-maxlength="255">
                                </div>
                            </div>
                            <div class="row error alert alert-danger m-0 mb-2" ng-show="EditTeacherCategoryForm.$invalid" >
                            <ul class="m-0 mt-0 ">
                                <li ng-show="EditTeacherCategoryForm.name.$error.required">Category Name is mandatory</li>
                                <li ng-show="EditTeacherCategoryForm.name.$error.maxlength">Category Name should be max 255chars</li>
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
    if(isset($getTeacherCustomSettings) and is_array($getTeacherCustomSettings)){
    foreach($getTeacherCustomSettings as $value){ ?>
    dataObj.custom_settings['<?php echo addslashes($value->options); ?>'] = '<?php echo addslashes($value->value); ?>';
    <?php }} ?>
    
    <?php
    if(isset($getTeacherCustomFields) and is_array($getTeacherCustomFields)){
    foreach($getTeacherCustomFields as $value){ ?>
    dataObj.custom_fields_list.push({'id': '<?php echo addslashes($value->id); ?>','name':'<?php echo addslashes($value->name); ?>','title':'<?php echo addslashes($value->title); ?>',
    'type':'<?php echo addslashes($value->type); ?>','used_for':'<?php echo addslashes($value->used_for); ?>','required':'<?php echo addslashes($value->required); ?>','status':'<?php echo addslashes($value->status); ?>' });
    <?php }} ?>
    
    <?php
    if(isset($getTeacherCategories) and is_array($getTeacherCategories)){
    foreach($getTeacherCategories as $value){ ?>
    dataObj.category_list.push({'id': '<?php echo addslashes($value->id); ?>','name':'<?php echo addslashes($value->name); ?>','status':'<?php echo addslashes($value->status); ?>' });
    <?php }} ?>
    
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/teacher/custom_settings.js"></script>
</body>
</html>