<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/menu');
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page student-details" ng-controller="StudentDetails">
    <!-- Start content -->
    <div class="content ">
        <div class="container-fluid">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">PARENT PROFILE</h2>
                    </div>
                    <div class="box-body mt-2 ">
                        <div class="row col-12 d-inline-block">
                            <div class="box-top-content pull-right">
                                <a href="<?php echo base_url(); ?>edit-parent/<?php echo $getParentFullDetails->id; ?>" class="btn link-text theme-btn">Edit</a>
                            </div>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='details'">
                           <div class="tab-content">
                               <div class="tabs">
                                   <div class="profile-details row">
                                       <div class="col-sm-12">
                                           <h5 class="title header">PARENT DETAILS</h5>
                                       </div>
                                       <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">PERSONAL DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">first_name</b> : <span class="value"><?php echo $getParentFullDetails->first_name; ?></span></li>
                                                    <li><b class="heading">last_name</b> : <span class="value"><?php echo $getParentFullDetails->last_name; ?></span></li>
                                                    <li><b class="heading">education</b> : <span class="value"><?php echo $getParentFullDetails->education; ?></span></li>
                                                    <li><b class="heading">occupation</b> : <span class="value"><?php echo $getParentFullDetails->occupation; ?></span></li>
                                                    <li><b class="heading">Gender</b> : <span class="value"><?php echo $getParentFullDetails->gender; ?></span></li>
                                                    <li><b class="heading">income</b> : <span class="value"><?php echo $getParentFullDetails->income; ?></span></li>
                                                    <li><b class="heading">dob</b> : <span class="value"><?php echo $getParentFullDetails->dob; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">CONTACT DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">Address</b> : <span class="value"><?php echo $getParentFullDetails->address; ?></span></li>
                                                    <li><b class="heading">City</b> : <span class="value"><?php echo $getParentFullDetails->city; ?></span></li>
                                                    <li><b class="heading">State</b> : <span class="value"><?php echo $getParentFullDetails->state; ?></span></li>
                                                    <li><b class="heading">Pin Code</b> : <span class="value"><?php echo $getParentFullDetails->pincode; ?></span></li>
                                                    <li><b class="heading">Country</b> : <span class="value"><?php echo $getParentFullDetails->country; ?></span></li>
                                                    <li><b class="heading">Phone Number</b> : <span class="value"><?php echo $getParentFullDetails->mobile; ?></span></li>
                                                    <li><b class="heading">Email</b> : <span class="value"><?php echo $getParentFullDetails->email; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="profile-details w-100">
                                        <div class="w-100">
                                           <h5 class="title header">STUDENTS DETAILS</h5>
                                        </div>
                                        <?php
                                        if(isset($getStudentFromParent) and !empty($getStudentFromParent)){ ?>
                                        
                                        <table class="table-list table-striped table m-b-none" >
                                                <thead>
                                                <tr>
                                                    <th>#</th><th>Roll Number</th><th>Name</th><th>Relation</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                            <?php
                                            $row_count = 1;
                                            foreach($getStudentFromParent as $value){ ?>
                                                <tr>
                                                  <td><?php echo $row_count; ?></td>
                                                  <td><a class="link text-link" href="view-student/<?php echo $value->id; ?>"><?php echo $value->roll_number; ?></a></td>
                                                  <td><?php echo $value->first_name; ?></td>
                                                  <td><?php echo $getParentFullDetails->relationship; ?></td>
                                                </tr>
                                                  <?php $row_count++; } ?>
                                                </tbody>
                                            </table>
            
                                        <?php }else{ ?>
                                        <p class="alert alert-danger">No Student details found.</p>
                                        <?php } ?>
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
        </div>
<!-- /Right-bar -->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url(); ?>assets/angular/controller/student/parent.js"></script>
</body>
</html>