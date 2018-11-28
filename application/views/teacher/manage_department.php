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
                      <h2 class="title theme-color theme-border-color">Manage Department</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        
                        <div class="box-content">
                           <div class="tab-content">
                            <div ng-show="isLoading" class="text-center row loader big"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
                            
                            <div class="tabs in show" ng-hide="isLoading">
                                <div class="row form-box m-0" >
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Departments</h5>
                                    </div>
                                    <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                    </div>
                                    <table class="table-list table-striped table m-b-none" >
                                        <thead>
                                        <tr>
                                            <th>#</th><th>Name</th><th>Code</th><th>Status</th><th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="department in DepartmentList.department_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ department.name }}</td>
                                              <td>{{ department.code }}</td>
                                              <td>{{ department.status }}</td>
                                              <td>
                                                   <button class="btn action-btn btn-edit" data-toggle="modal" data-target="#UpdateModalDepartment" ui-toggle-class="bounce" ui-target="#animateModal" ng-click="SetEditDepartmentID(department.id)" title="Update this Details"><i class="fa fa-pencil"></i></button>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#deleteModalDepartment" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteDepartmentID(department.id)" title="Delete this Fields"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Add Department</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="AddDepartmentForm" name="AddDepartmentForm" class="col-12 row" method="post" role="form" novalidate ng-submit="AddDepartmentFormSubmission()">
                                        <div class="row form-box w-100">
                                			<div class="form-group col-6 col-md-4 m-b">
                                                <label class="label-role info pos-rlt">Dept Name<span class="required theme-color">*</span></label>
                                                <input type="text" class="form-control inline" name="name" ng-model="custom_field.name" placeholder="Dept Name" required ng-maxlength="255">
                                            </div>
                                            <div class="form-group col-6 col-md-4 m-b">
                                                <label class="label-role info pos-rlt">Dept Code<span class="required theme-color">*</span></label>
                                                <input type="text" class="form-control inline" name="code" ng-model="custom_field.code" placeholder="Dept Code" required ng-maxlength="255">
                                            </div>
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddTeacherCustomFieldForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddTeacherCustomFieldForm.name.$error.required">Dept Name is mandatory</li>
                                            <li ng-show="AddTeacherCustomFieldForm.name.$error.maxlength">Dept Name should be max 255chars</li>
                                            <li ng-show="AddTeacherCustomFieldForm.code.$error.required">Dept Code Address is mandatory</li>
                                            <li ng-show="AddTeacherCustomFieldForm.code.$error.maxlength">Dept Code should be max 255chars</li>
                                        </ul>
                                    </div>
                                
                                    <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    </div>
                                        <div class="col-12 p-0" >
                                            <button type="submit" class="btn bg-theme" >Add Department</button>
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
            
        <div id="deleteModalDepartment" class="modal fade animate" data-backdrop="true">
          <div class="modal-dialog" id="animate">
            <div class="modal-content">
              <div class="modal-body text-center p-lg pt-5">
                <p class="questions">Are you sure to delete this Department?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deleteCustomDepartmentIDCancel()">No</button>
                <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteTeacherDepartmentID()">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div>
        </div>
        
        <div id="UpdateModalDepartment" class="modal fade animate with-form" data-backdrop="true">
          <div class="modal-dialog" id="animateModal">
            <div class="modal-content">
            <div ng-show="isLoadingEdit" class="text-center row loader small"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
            <form ng-hide="isLoadingEdit" id="EditTeacherDepartmentForm" name="EditTeacherDepartmentForm" class="w-100" method="post" role="form" novalidate ng-submit="EditTeacherDepartmentFormSubmission()">
              <div class="modal-header text-left p-lg pt-0 pb-1">
                <h3 class="theme-color title">Update Teacher Department</h3>
              </div>
              <div class="modal-body p-lg pt-3 w-100">
                    <div class="row form-box w-100 m-0" >
                            <div class="row form-box w-100">
                    			<div class="form-group col-6 m-b">
                                    <label class="label-role info pos-rlt">Name<span class="required theme-color">*</span></label>
                                    <input type="text" class="form-control inline" name="name" ng-model="edit_department.name" placeholder="Department Name" required ng-maxlength="255">
                                </div>
                                <div class="form-group col-6 m-b">
                                    <label class="label-role info pos-rlt">Name<span class="required theme-color">*</span></label>
                                    <input type="text" class="form-control inline" name="code" ng-model="edit_department.code" placeholder="Department Name" required ng-maxlength="255">
                                </div>
                                <div class="form-group col-6 col-md-4 m-b">
                                    <label class="label-role info pos-rlt">Status<span class="required theme-color">*</span></label>
                                    <select name="status" class="form-control inline" ng-model="edit_department.status" required>
                                        <option value="">Select a Status</option>
                                        <option ng-repeat="value in form.statuses" value="{{value}}">{{ value }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row error alert alert-danger m-0 mb-2" ng-show="EditTeacherDepartmentForm.$invalid" >
                            <ul class="m-0 mt-0 ">
                                <li ng-show="EditTeacherDepartmentForm.name.$error.required">Department Name is mandatory</li>
                                <li ng-show="EditTeacherDepartmentForm.name.$error.maxlength">Department Name should be max 255chars</li>
                                <li ng-show="EditTeacherDepartmentForm.code.$error.required">Dept Code Address is mandatory</li>
                                <li ng-show="EditTeacherDepartmentForm.code.$error.maxlength">Dept Code should be max 255chars</li>
                                <li ng-show="EditTeacherDepartmentForm.status.$error.required">Status is mandatory</li>
                            </ul>
                        </div>
                    
                        <div class="row" ng-show="AjaxRequestCodeEdit != '' && AjaxRequestStatusEdit != ''">
                            <div class="alert alert-success" ng-bind-html="AjaxRequestStatusEdit" ng-show="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusEdit" ng-hide="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary " data-dismiss="modal" data-ng-click="SetEditDepartmentIDCancel()" >Close</button>
                <button type="submit" class="btn btn-success" >Update</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div>
        </div>
</div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>
<script>
function DepartmentList(){
    var dataObj = {
        department_list : [],
    };
    <?php
    if(isset($getAllDepartments) and is_array($getAllDepartments)){
    foreach($getAllDepartments as $value){ ?>
    dataObj.department_list.push({'id': '<?php echo addslashes($value->id); ?>','name':'<?php echo addslashes($value->name); ?>','code':'<?php echo addslashes($value->code); ?>','status':'<?php echo addslashes($value->status); ?>' });
    <?php }} ?>
    
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/teacher/manage-department.js"></script>
</body>
</html>