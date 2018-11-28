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
            <div class=" row" >
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
                                   <li><a class="btn " href="edit-student/parent/<?php echo $student_id; ?>" >Parents Details</a></li>
                                   <li class="active"><a class="btn disabled" href="edit-student/previous/<?php echo $student_id; ?>" >Previous Details</a></li>
                                   <li><a class="btn" href="edit-student/doc/<?php echo $student_id; ?>" >Documents</a></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                            <div ng-show="isLoading" class="text-center row loader big"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
                            <div class="tabs in show" ng-hide="isLoading">
                                <div class="row form-box m-0" >
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Student Previous Details</h5>
                                    </div>
                                    <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                    </div>
                                    <table class="table-list table-striped table m-b-none" >
                                        <thead>
                                        <tr>
                                            <th>#</th><th>Institue</th><th>Address</th><th>Course</th><th>Year</th><th>Mark/Percentage</th><th>Reason</th><th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="previous in ParentService.assigned_previous_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ previous.institue_name }}</td>
                                              <td>{{ previous.institue_address }}</td>
                                              <td>{{ previous.course }}</td>
                                              <td>{{ previous.year }}</td>
                                              <td>{{ previous.total_mark }}</td>
                                              <td>{{ previous.reason_for_change }}</td>
                                              <td>
                                                   <button class="btn action-btn btn-edit" data-toggle="modal" data-target="#UpdateStudentPreviousModal" ui-toggle-class="bounce" ui-target="#animateModal" ng-click="SetUpdatePreviousID(previous.id)" title="Update this Details"><i class="fa fa-pencil"></i></button>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeletePreviousID(previous.id)" title="Delete this Details"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Add Student Previous Details</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="AddPreviousForm" name="AddPreviousForm" class="col-12 row" method="post" role="form" novalidate ng-submit="AddPreviousFormSubmission()">
                                        <div class="row form-box">
                                        <div class="col-sm-12">
                                           <h5 class="title theme-color">Institution Details</h5>
                                        </div>
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Institue Name<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="institue_name" ng-model="previous_add.institue_name" placeholder="Institue Name" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Institue Address<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="institue_address" ng-model="previous_add.institue_address" placeholder="Institue Address" required>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Course<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="course" ng-model="previous_add.course" placeholder="Course" required>
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Academic Year</label>
                                            <input type="text" class="form-control inline" name="year" ng-model="previous_add.year" placeholder="Academic Year" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Total Mark/Percentage</label>
                                            <input type="text" class="form-control inline" name="total_mark" ng-model="previous_add.total_mark" placeholder="Total Mark/Percentage" >
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b" >
                                            <label class="label-role info pos-rlt">Reason for change<span class="required theme-color">*</span></label>
                                            <textarea rows="1" class="form-control inline" name="reason_for_change" ng-model="previous_add.reason_for_change" placeholder="Reason for change" required></textarea>
                                        </div>
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddPreviousForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddPreviousForm.institue_name.$error.required">Institue Name is mandatory</li>
                                            <li ng-show="AddPreviousForm.institue_name.$error.maxlength">Institue Name should be max 255chars</li>
                                            <li ng-show="AddPreviousForm.institue_address.$error.required">Institue Address is mandatory</li>
                                            <li ng-show="AddPreviousForm.course.$error.required">Course is mandatory</li>
                                            <li ng-show="AddPreviousForm.reason_for_change.$error.required">Reason for change is mandatory</li>
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
        
        <div id="m-a-a" class="modal fade animate" data-backdrop="true">
          <div class="modal-dialog" id="animate">
            <div class="modal-content">
              <div class="modal-body text-center p-lg pt-5">
                <p class="questions">Are you sure to delete this Details?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deletePreviousIDCancel()">No</button>
                <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deletePreviousID()">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div>
        </div>
        
        <div id="UpdateStudentPreviousModal" class="modal fade animate with-form" data-backdrop="true">
          <div class="modal-dialog" >
            <div class="modal-content">
                
            <div ng-show="isLoadingEdit" class="text-center row loader small"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
            <form ng-hide="isLoadingEdit" id="EditPreviousForm" name="EditPreviousForm" class="w-100" method="post" role="form" novalidate ng-submit="EditPreviousFormSubmission()">
              <div class="modal-header text-left p-lg pt-0 pb-1">
                <h3 class="theme-color title">Update Student Previous Details</h3>
              </div>
              <div class="modal-body p-lg pt-3 w-100">
                    <div class="row form-box w-100 m-0" >
                            <div class="row form-box">
                			<div class="form-group col-12 col-md-6 m-b">
                                <label class="label-role info pos-rlt">Institue Name<span class="required theme-color">*</span></label>
                                <input type="text" class="form-control inline" name="institue_name" ng-model="previous_edit.institue_name" placeholder="Institue Name" required ng-maxlength="255">
                            </div>
                            <div class="form-group col-12 col-md-6 m-b">
                                <label class="label-role info pos-rlt">Institue Address<span class="required theme-color">*</span></label>
                                <input type="text" class="form-control inline" name="institue_address" ng-model="previous_edit.institue_address" placeholder="Institue Address" required>
                            </div>
                            <div class="form-group col-12 col-md-6 m-b">
                                <label class="label-role info pos-rlt">Course<span class="required theme-color">*</span></label>
                                <input type="text" class="form-control inline" name="course" ng-model="previous_edit.course" placeholder="Course" required>
                            </div>
                            <div class="form-group col-12 col-md-6 m-b">
                                <label class="label-role info pos-rlt">Academic Year</label>
                                <input type="text" class="form-control inline" name="year" ng-model="previous_edit.year" placeholder="Academic Year" >
                            </div>
                            <div class="form-group col-12 col-md-6 m-b">
                                <label class="label-role info pos-rlt">Total Mark/Percentage</label>
                                <input type="text" class="form-control inline" name="total_mark" ng-model="previous_edit.total_mark" placeholder="Total Mark/Percentage" >
                            </div>
                            <div class="form-group col-12 col-md-6 m-b" >
                                <label class="label-role info pos-rlt">Reason for change<span class="required theme-color">*</span></label>
                                <textarea rows="1" size="1" class="form-control inline" name="reason_for_change" ng-model="previous_edit.reason_for_change" placeholder="Reason for change" required></textarea>
                            </div>
                            </div>
                            <div class="row error alert alert-danger m-0 mb-2" ng-show="EditPreviousForm.$invalid" >
                            <ul class="m-0 mt-0 ">
                                <li ng-show="EditPreviousForm.institue_name.$error.required">Institue Name is mandatory</li>
                                <li ng-show="EditPreviousForm.institue_name.$error.maxlength">Institue Name should be max 255chars</li>
                                <li ng-show="EditPreviousForm.institue_address.$error.required">Institue Address is mandatory</li>
                                <li ng-show="EditPreviousForm.course.$error.required">Course is mandatory</li>
                                <li ng-show="EditPreviousForm.reason_for_change.$error.required">Reason for change is mandatory</li>
                            </ul>
                        </div>
                    
                        <div class="row" ng-show="AjaxRequestCodeEdit != '' && AjaxRequestStatusEdit != ''">
                            <div class="alert alert-success" ng-bind-html="AjaxRequestStatusEdit" ng-show="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusEdit" ng-hide="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary " data-dismiss="modal" data-ng-click="SetUpdatePreviousIDCancel()" >Cancel</button>
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
function ParentService(){
    var dataObj = {
        assigned_parent_list : [],
        assigned_previous_list : [],
        assigned_student_doc_list : [],
    };
    <?php
    $row_count = 1;
    if(isset($getPreviousQualification) and is_array($getPreviousQualification)){
    foreach($getPreviousQualification as $value){ ?>
    dataObj.assigned_previous_list.push({'id':'<?php echo $value->id; ?>','institue_name':'<?php echo addslashes($value->institue_name); ?>','institue_address':'<?php echo addslashes($value->institue_address); ?>',
    'course':'<?php echo addslashes($value->course); ?>','year':'<?php echo addslashes($value->year); ?>','total_mark':'<?php echo addslashes($value->total_mark); ?>','reason_for_change':'<?php echo addslashes($value->reason_for_change); ?>'});
    <?php }} ?>
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/student-edit.js"></script>
</body>
</html>