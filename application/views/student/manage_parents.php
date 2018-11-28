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
        <div class="container-fluid">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">Parent Management</h2>
                    </div>
                    <div class="box-body">
                        <form id="orderSearchForm" method="post" name="orderSearchForm" class="form-validation" role="form" novalidate ng-submit="getParentsBySearch()">
                        <div class="row">
                			<div class="form-group col-sm-4 m-b">
                                <label class="label-role info pos-rlt">Name</label>
                                <input type="text" class="form-control inline" name="name" ng-model="parent_search.name" placeholder="Name" >
                            </div>
                            <div class="form-group col-sm-4 m-b">
                                <label class="label-role info pos-rlt">Email</label>
                                <input type="text" class="form-control inline" name="email" ng-model="parent_search.email" placeholder="Email" >
                            </div>
                            <div class="form-group col-sm-4 m-b">
                                <label class="label-role info pos-rlt">Mobile</label>
                                <input type="text" class="form-control inline" name="mobile" ng-model="parent_search.mobile" placeholder="Mobile" >
                            </div>
                        </div>
                        
                        <div class="col-12 p-0" >
                                <button type="submit" class="btn bg-theme" >Search</button>
                                <button type="reset" class="btn btn-info">Clear</button>
                        </div>
                        </form>
                    </div>
                    
                    <div class="box-body mt-5" ng-cloak>
                        <div class="row" ng-show="AjaxRequestCodeDelete != '' && AjaxRequestStatusDelete != ''">
                            <div class="alert alert-success" ng-bind-html="AjaxRequestStatusDelete" ng-show="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                            <div class="alert alert-danger" ng-bind-html="AjaxRequestStatusDelete" ng-hide="AjaxRequestCodeDelete == 200"><strong>{{ AjaxRequestStatusDelete }}</strong></div>
                        </div>
                        <div ng-show="isLoading" class="text-center loader"><img src="assets/images/loader/loader.gif" alt="Loader" title="Loader" /></div>
                        <div ng-show="!isLoading && isFilterApplied && rowCollectionStudet.length == 0" class="text-center loader alert alert-danger">No Parent found based on Filters applied</div>
                        
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
                            <th data-toggle="true">#</th><th>Name</th><th>Students</th><th>Mobile</th><th>Email</th><th>Relationship</th>
                            <th>Status<br><small>click here to change status</small></th><th>Action</th>
                        </tr>
                        </thead>
                        <tbody >
                        <tr ng-repeat="user in rowCollectionStudet">
                              <td>{{ (currentPage * itemsByPage) + $index + 1 }}</td>
                              <td><a class="link text-link" href="view-parent/{{ user.id }}">{{ user.first_name }} {{user.last_name}}</a></td>
                              <td></td>
                              <td>{{ user.mobile }}</td>
                			  <td>{{ user.email }}</td>
                			  <td>{{ user.relationship }}</td>
                              <td>
                                <div class=" row">
                                  <div class="col-sm-9">
                                  	<span class="form-control-static">
                                    	<a editable-select="user.OStatus" e-ng-options="s.value as s.text for s in statuses">
                                    		<span class="label danger" title="Deactive" >{{ showStatus(user) }}</span>
                                    	</a>
                                    </span>
                                  </div>
                                </div>
                              </td>
                              <td>
                                   <a href="edit-parent/{{user.id}}" class="btn action-btn btn-edit"><i class="fa fa-pencil"></i></a>
                                   <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#delete_modal" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteParentID(user.id)" title="Delete this User"><i class="fa fa-trash"></i></button>
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
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <?php $this->load->view('common/right-side-bar'); ?>
            <div id="delete_modal" class="modal fade animate" data-backdrop="true">
              <div class="modal-dialog" id="animate">
                <div class="modal-content">
                  <div class="modal-body text-center p-lg pt-5">
                    <p class="questions">Are you sure to delete this Parent?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary " data-dismiss="modal" data-ng-click="deleteParentCancel()">No</button>
                    <button type="button" class="btn btn-success " data-dismiss="modal" data-ng-click="deleteParent()">Yes</button>
                  </div>
                </div><!-- /.modal-content -->
              </div>
            </div>
        </div>
    </div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/parent.js"></script>
</body>
</html>