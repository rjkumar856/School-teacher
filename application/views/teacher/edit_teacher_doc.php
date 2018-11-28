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
        <div class="container-fluid" ng-init="teacher_edit.id='<?php echo $teacher_id; ?>'">
            <div class=" row" >
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">MANAGE TEACHER</h2>
                    </div>
                    <div class="box-body" ng-cloak>
                        <p class="note d-inline-block">Fields with <strong class="required theme-color">*</strong> are required.</p>
                        <div class="box-top-content pull-right">
                            <a href="<?php echo base_url(); ?>view-teacher/<?php echo $teacher_id; ?>" class="btn link-text theme-btn">View</a>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='parents'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li><a class="btn " href="edit-teacher/<?php echo $teacher_id; ?>" >Profile</a></li>
                                   <li class="active"><a class="btn disabled" href="edit-teacher/doc/<?php echo $teacher_id; ?>" >Documents</a></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                            <div ng-show="isLoading" class="text-center row loader big"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
                            <div class="tabs in show" ng-hide="isLoading">
                                <div class="row form-box m-0" >
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Teacher Documents</h5>
                                    </div>
                                    <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                                    </div>
                                    <table class="table-list table-striped table m-b-none" >
                                        <thead>
                                        <tr>
                                            <th>#</th><th>Doc</th><th>Status</th><th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="doc in DetailsService.assigned_teacher_doc_list">
                                              <td>{{ $index + 1 }}</td>
                                              <td>{{ doc.doc_name }}</td>
                                              <td>{{ doc.status }}</td>
                                              <td>
                                                   <a data-toggle="modal" data-target="#UpdateTeacherDocsModal" ui-toggle-class="bounce" ui-target="#animateModal" ng-click="SetUpdateDocumentID(doc.id)" title="Update this Details" class="btn action-btn btn-edit" ><i class="fa fa-pencil"></i></a>
                                                   <a ng-click="SetTeacherDocumentStatusApproved(doc.id)" class="btn action-btn btn-edit btn-success" title="Approve"><i class="fa fa-thumbs-up"></i></a>
                                                   <a ng-click="SetTeacherDocumentStatusDisapproved(doc.id)" class="btn action-btn btn-edit btn-warning" title="Disapproved"><i class="fa fa-thumbs-down"></i></a>
                                                   <a href="<?php echo base_url(); ?>assets/files/documents/{{doc.url}}" target="_blank" class="btn action-btn btn-edit btn-info" title="Download"><i class="fa fa-download"></i></a>
                                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteDocumentID(doc.id)" title="Delete this Document"><i class="fa fa-trash"></i></button>
                                              </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row form-box m-0">
                                    <div class="col-sm-12 p-0">
                                       <h5 class="title header">Add Teacher Document</h5>
                                    </div>
                                    
                                    <div class="row form-box w-100 m-0" >
                                    <form id="AddTeacherDocForm" name="AddTeacherDocForm" class="w-100" method="post" role="form" novalidate ng-submit="AddTeacherDocFormSubmission()">
                                        <div class="row form-box w-100">
                                            
                            			<div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Doc Name<span class="required theme-color">*</span></label>
                                            <input type="text" class="form-control inline" name="doc_name" ng-model="document_add.doc_name" placeholder="Doc Name" required ng-maxlength="255">
                                        </div>
                                        <div class="form-group col-6 col-md-4 m-b">
                                            <label class="label-role info pos-rlt">Document (Type: jpg, png, gif, pdf, doc & docx)<span class="required theme-color">*</span></label>
                                            <input type="file" class="form-control inline" file-upload="teacherDocument" accept=".png,.jpg,.jpeg,.gif,.doc,.docx,.pdf" name="document" ng-model="document_add.document" placeholder="Photo" required>
                                        </div>
                                        
                                        </div>
                                        <div class="row error alert alert-danger m-0 mb-2" ng-show="formValidation && AddTeacherDocForm.$invalid" >
                                        <ul class="m-0 mt-0 ">
                                            <li ng-show="AddTeacherDocForm.doc_name.$error.required">Doc Name is mandatory</li>
                                            <li ng-show="AddTeacherDocForm.doc_name.$error.maxlength">Doc Name should be max 255chars</li>
                                            <li ng-show="AddTeacherDocForm.document.$error.required">Select Valid Document</li>
                                        </ul>
                                    </div>
                                
                                    <div class="row" ng-show="AjaxRequestCode != '' && AjaxRequestStatus != ''">
                                        <div class="alert alert-success" ng-bind-html="AjaxRequestStatus" ng-show="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                        <div class="alert alert-danger" ng-bind-html="AjaxRequestStatus" ng-hide="AjaxRequestCode == 200"><strong>{{ AjaxRequestStatus }}</strong></div>
                                    </div>
                                        <div class="col-12 p-0" >
                                            <button type="submit" class="btn bg-theme" >Add Document</button>
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
                <p class="questions ">Are you sure to delete this Document?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deleteDocumentIDCancel()">No</button>
                <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteDocumentID()">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div>
        </div>
        
        <div id="UpdateTeacherDocsModal" class="modal fade animate with-form" data-backdrop="true">
          <div class="modal-dialog" id="animateModal" >
            <div class="modal-content">
                
            <div ng-show="isLoadingEdit" class="text-center row loader small"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></i></div>
            <form ng-hide="isLoadingEdit" id="EditTeacherDocForm" name="EditTeacherDocForm" class="w-100" method="post" role="form" novalidate ng-submit="EditTeacherDocFormSubmission()">
              <div class="modal-header text-left p-lg pt-0 pb-1">
                <h3 class="theme-color title">Update Teacher Previous Details</h3>
              </div>
              <div class="modal-body p-lg pt-3 w-100">
                    <div class="row form-box w-100 m-0" >
                			<div class="form-group col-12 col-md-12 m-b">
                                <label class="label-role info pos-rlt">Doc Name<span class="required theme-color">*</span></label>
                                <input type="text" class="form-control inline" name="doc_name" ng-model="document_edit.doc_name" placeholder="Doc Name" required ng-maxlength="255">
                            </div>
                            <div class="row error alert alert-danger m-0 mb-2" ng-show="EditTeacherDocForm.$invalid" >
                                <ul class="m-0 mt-0 ">
                                    <li ng-show="EditTeacherDocForm.doc_name.$error.required">Institue Name is mandatory</li>
                                    <li ng-show="EditTeacherDocForm.doc_name.$error.maxlength">Institue Name should be max 255chars</li>
                                </ul>
                            </div>
                    
                        <div class="row" ng-show="AjaxRequestCodeEdit != '' && AjaxRequestStatusEdit != ''">
                            <div class="alert alert-success" ng-bind-html="AjaxRequestStatusEdit" ng-show="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusEdit" ng-hide="AjaxRequestCodeEdit == '200'"><strong>{{ AjaxRequestStatusEdit }}</strong></div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary " data-dismiss="modal" data-ng-click="SetUpdateDocumentIDCancel()" >Cancel</button>
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
function DetailsService(){
    var dataObj = {
        edit_teacher_details : {},
        teacher_class_list : [],
        assigned_teacher_doc_list : [],
    };
    <?php
    $row_count = 1;
    if(isset($getTeacherDocuments) and is_array($getTeacherDocuments)){
    foreach($getTeacherDocuments as $value){ ?>
        dataObj.assigned_teacher_doc_list.push({'id':'<?php echo $value->id; ?>','doc_name':'<?php echo addslashes($value->doc_name); ?>','url':'<?php echo addslashes($value->url); ?>','status':'<?php echo addslashes($value->status); ?>'});
    <?php }} ?>
    return dataObj;
}
</script>
<script src="<?php echo base_url(); ?>assets/angular/controller/teacher/teacher-edit.js"></script>
</body>
</html>