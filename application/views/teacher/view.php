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
                      <h2 class="title theme-color theme-border-color">Teacher Management</h2>
                    </div>
                    <div class="box-body">
                        <form id="orderSearchForm" method="post" name="orderSearchForm" class="form-validation" role="form" novalidate ng-submit="getTeachersBySearch()">
                        <div class="row">
                			<div class="form-group col-sm-4 col-md-3 m-b">
                                <label class="label-role info pos-rlt">Name</label>
                                <input type="text" class="form-control inline" name="name" ng-model="teacher_search.name" placeholder="Name" >
                            </div>
                            <div class="form-group col-sm-4 col-md-3 m-b">
                                <label class="label-role info pos-rlt">Teacher ID</label>
                                <input type="text" class="form-control inline" name="teacher_id" ng-model="teacher_search.teacher_id" placeholder="Teacher ID" >
                            </div>
                            <div class="form-group col-sm-4 col-md-3 m-b">
                                <label class="label-role info pos-rlt">Position</label>
                                <input type="text" class="form-control inline" name="position" ng-model="teacher_search.position" placeholder="Position" >
                            </div>
                            <div class="form-group col-sm-4 col-md-3 m-b">
                                <label class="label-role info pos-rlt">Grade</label>
                                <input type="text" class="form-control inline" name="grade" ng-model="teacher_search.grade" placeholder="Grade" >
                            </div>
                            
                            <div class="form-group col-sm-4 col-md-3 m-b">
                              <label class="label-role info pos-rlt">Department</label>
                			  <select class="form-control c-select m-b" name="department_id" ng-model="teacher_search.department_id" >
                				<option value="">All</option>
                				<?php
                				if(isset($getAllCourses) and is_array($getAllCourses)){
                				foreach($getAllCourses as $value){?>
                				<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                				<?php } } ?>
                			  </select>
                            </div>
                            <div class="form-group col-sm-4 col-md-3 m-b">
                              <label class="label-role info pos-rlt">Category</label>
                			  <select class="form-control c-select m-b" name="category_id" ng-model="teacher_search.category_id" >
                				<option value="">All</option>
                				<?php
                				if(isset($getAllClasses) and is_array($getAllClasses)){
                				foreach($getAllClasses as $value){?>
                				<option value="<?php echo $value['id'] ?>"><?php echo $value['Course']." - ".$value['name'] ?></option>
                				<?php } } ?>
                			  </select>
                            </div>
                            <div class="form-group col-sm-4 col-md-3 m-b">
                              <label class="label-role info pos-rlt">Gender</label>
                			  <select class="form-control c-select m-b" name="gender" ng-model="teacher_search.gender" >
                				<option value="">All</option>
                				<option value="Male">Male</option>
                				<option value="Female">Female</option>
                				<option value="Other">Other</option>
                			  </select>
                            </div>
                            <div class="form-group col-sm-4 col-md-3 m-b">
                              <label class="label-role info pos-rlt">Marital Status</label>
                			  <select class="form-control c-select m-b" name="marital_status" ng-model="teacher_search.marital_status" >
                				<option value="">All</option>
                				<option value="Married">Married</option>
                				<option value="Unmarried">Unmarried</option>
                				<option value="Divorsed">Divorsed</option>
                				<option value="Widow">Widow</option>
                			  </select>
                            </div>
                            
                            <div class="form-group col-sm-4 col-md-3 m-b">
                              <label class="label-role info pos-rlt">Blood Group</label>
                			  <select class="form-control c-select m-b" name="blood_group" ng-model="teacher_search.blood_group" >
                				<option value="">All</option>
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
                            <div class="form-group col-sm-4 col-md-3 m-b">
                              <label class="label-role info pos-rlt">Status</label>
                			  <select class="form-control c-select m-b" name="status" ng-model="teacher_search.status" >
                				<option value="">All</option>
                				<option value="Active">Active</option>
                				<option value="Deactive">Deactive</option>
                				<option value="Terminated">Terminated</option>
                				<option value="Suspended">Suspended</option>
                			  </select>
                            </div>
                        </div>
                        
                        <div class="col-12 p-0" >
                                <button type="submit" class="btn bg-theme" >Search</button>
                                <button type="reset" class="btn btn-info">Clear</button>
                        </div>
                        </form>
                    </div>
                    
                    <div class="box-body mt-5" ng-cloak>
                        
                        <div ng-show="isLoading" class="text-center loader"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></div>
                        <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                            <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                        </div>
                        
                        <div ng-show="!isLoading && isFilterApplied && rowCollectionStudet.length == 0" class="text-center loader alert alert-danger">No teacher found based on Filters applied</div>
                        <div class="form-group col-sm-4 col-md-3 m-b" ng-hide="isLoading || rowCollectionStudet.length == 0">
                            <form id="userUpdateForm" name="userUpdateForm" class="form-validation" role="form">
                            <label>Number of rows : </label>
                            <select style="width:80px" class="form-control c-select m-b" name="itemsByPage" ng-model="itemsByPage" ng-options="page for page in rowsPerPage">
                                <option value="" >Choose</option>
                            </select>
                            </form>
                        </div>
                        
                        <table ng-hide="isLoading || rowCollectionStudet.length == 0" st-table="rowCollectionPage" class="table-list table-striped table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="{{itemsByPage}}">
                        <thead>
                        <tr>
                            <th data-toggle="true">#</th><th>Teacher ID/No</th><th>Name</th><th>Department</th><th>Position</th><th>Gender</th><th>Mobile</th><th>Status<br><small>click here to change status</small></th><th>Action</th>
                        </tr>
                        </thead>
                        <tbody >
                        <tr ng-repeat="user in rowCollectionStudet">
                              <td>{{ (currentPage * itemsByPage) + $index + 1 }}</td>
                              <td><a class="link text-link" href="view-teacher/{{ user.id }}">{{ user.teacher_id }}</a></td>
                              <td>{{ user.first_name }} {{user.last_name}}</td>
                              <td>{{ user.department }}</td>
                              <td>{{ user.position }}</td>
                              <td>{{ user.gender }}</td>
                			  <td>{{ user.mobile }}</td>
                              <td>
                                <div class=" row">
                                  <div class="col-sm-9">
                                  	<span class="form-control-static">
                                    	<span editable-select="user.status" e-ng-options="s.value as s.text for s in statuses" class=" theme-color theme-border-color">
                                    		<span class="label danger" title="Deactive" >{{ showStatus(user) }}</span>
                                    	</span>
                                    </span>
                                  </div>
                                </div>
                              </td>
                              <td>
                                   <a href="edit-teacher/{{user.id}}" class="btn action-btn btn-edit"><i class="fa fa-pencil"></i></a>
                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#delete_modal" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteTeacherID(user.id)" title="Delete this User"><i class="fa fa-trash"></i></button>
                              </td>
                          </tr>
                      </tbody>
                      <tfoot>
                          <tr>
                            <td colspan="14" class="text-left">
                                <span>Showing {{ (currentPage * itemsByPage) + 1 }} to {{ ((currentPage * itemsByPage) + itemsByPage < totalPost) ? (currentPage * itemsByPage) + itemsByPage : totalPost }} of {{ totalPost }} entries</span>
                            </td>
                            </tr>
                          <tr>
                          <td colspan="14" class="text-center">
                            <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                    <li class="page-item" ng-repeat="page in paginationPages" ng-class="{active: $index==currentPage}"><a class="page-link" ng-click="$index!=currentPage && selectPage($index)" href="JavaScript:void(0);">{{page}}</a></li>
                                  </ul>
                            </nav>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                    </div>
                  </div>
            </div>
        </div> <!-- container -->
                </div> <!-- content -->
                <?php $this->load->view('common/content-footer'); ?>
                
                <div id="delete_modal" class="modal fade animate" data-backdrop="true">
                  <div class="modal-dialog" id="animate">
                    <div class="modal-content">
                      <div class="modal-body text-center p-lg pt-5">
                        <p class="questions">Are you sure to delete this Teacher?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deleteTeacherCancel()">No</button>
                        <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteTeacher()">Yes</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <?php $this->load->view('common/right-side-bar'); ?>
        </div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>
<link href="<?php echo base_url(); ?>assets/angular/lib/angular-xeditable/dist/js/xeditable.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/angular/lib/angular-xeditable/dist/js/xeditable.js"></script>
<script src="<?php echo base_url(); ?>assets/angular/controller/teacher/teacher.js"></script>
</body>
</html>