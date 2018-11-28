<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/menu');
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page student-details" ng-controller="TeacherDetails">
    <!-- Start content -->
    <div class="content ">
        <div class="container-fluid">
            <div class=" row">
                <div class="box">
                    <div class="box-header">
                      <h2 class="title theme-color theme-border-color">Teacher PROFILE</h2>
                    </div>
                    <div class="box-body mt-2 ">
                        <div class="row col-12 d-inline-block">
                            
                            <div class="box-details1 box-profile text-center pull-left">
                                <div class="inner">
                                    <img src="assets/files/teacher/<?php if($getTeacherDetails->photo){ echo $getTeacherDetails->photo; }else{ echo "default.png";} ?>" width="64" alt="<?php echo $getTeacherDetails->first_name." ". $getTeacherDetails->last_name; ?>" title="<?php echo $getTeacherDetails->first_name." ". $getTeacherDetails->last_name; ?>" class="image" />
                                </div>
                            </div>
                            <div class="box-details col-4 pull-left">
                                <div class="inner border-top-0">
                                    <ul>
                                        <li><b class="heading">Name</b> : <span class="value"><?php echo $getTeacherDetails->first_name." ". $getTeacherDetails->last_name; ?></span></li>
                                        <li><b class="heading">Teacher ID</b> : <span class="value"><?php echo $getTeacherDetails->teacherId; ?></span></li>
                                        <li><b class="heading">Department</b> : <span class="value"><?php echo $getTeacherDetails->department; ?></span></li>
                                        <li><b class="heading">Position</b> : <span class="value"><?php echo $getTeacherDetails->position; ?></span></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="box-top-content pull-left">
                                <h5>Navigate to:</h5>
                                <a href="<?php echo base_url(); ?>view-teachers" class="btn link-text theme-btn">Attendance</a>
                                <a href="<?php echo base_url(); ?>view-teachers" class="btn link-text theme-btn">Time Table</a>
                            </div>
                            <div class="box-top-content pull-right">
                                <a href="<?php echo base_url(); ?>edit-teacher/<?php echo $getTeacherDetails->teacher_id; ?>" class="btn link-text theme-btn">Edit</a>
                                <a href="<?php echo base_url(); ?>view-teachers" class="btn link-text theme-btn">Teachers</a>
                            </div>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='details'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li ng-class="{ active : tabs === 'details'}"><button class="btn" tab-click="details">Profile</button></li>
                                   <li ng-class="{ active : tabs === 'documents'}"><button class="btn " tab-click="documents" >Documents</button></li>
                                   <li ng-class="{ active : tabs === 'attendance'}"><button class="btn " tab-click="attendance" >Attendance</button></li>
                                   <li ng-class="{ active : tabs === 'subject-association'}"><button class="btn " tab-click="subject-association" >Subject Association</button></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                               <div class="tabs" ng-show="tabs == 'details'">
                                   <div class="profile-details row">
                                       <div class="col-sm-12">
                                           <h5 class="title header">TEACHER DETAILS</h5>
                                       </div>
                                       
                                       <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">GENERAL DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">Date of Joining</b> : <span class="value"><?php echo $getTeacherDetails->doj; ?></span></li>
                                                    <li><b class="heading">Teacher ID:</b> : <span class="value"><?php echo $getTeacherDetails->teacherId; ?></span></li>
                                                    <li><b class="heading">Department</b> : <span class="value"><?php echo $getTeacherDetails->department; ?></span></li>
                                                    <li><b class="heading">Teacher Position</b> : <span class="value"><?php echo $getTeacherDetails->position; ?></span></li>
                                                    <li><b class="heading">Teacher Category</b> : <span class="value"><?php echo $getTeacherDetails->category; ?></span></li>
                                                    <li><b class="heading">Teacher Grade</b> : <span class="value"><?php echo $getTeacherDetails->grade; ?></span></li>
                                                    <li><b class="heading">Job Title</b> : <span class="value"><?php echo $getTeacherDetails->job_title; ?></span></li>
                                                    <li><b class="heading">Qualification</b> : <span class="value"><?php echo $getTeacherDetails->qualification; ?></span></li>
                                                    <li><b class="heading">Total Experience</b> : <span class="value"><?php echo $getTeacherDetails->experience; ?></span></li>
                                                    <li><b class="heading">Experience Details</b> : <span class="value"><?php echo $getTeacherDetails->experience_details; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                       
                                       <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">PERSONAL DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">Date Of Birth</b> : <span class="value"><?php echo $getTeacherDetails->dob; ?></span></li>
                                                    <li><b class="heading">Gender</b> : <span class="value"><?php echo $getTeacherDetails->gender; ?></span></li>
                                                    <li><b class="heading">Marital Status</b> : <span class="value"><?php echo $getTeacherDetails->marital_status; ?></span></li>
                                                    <li><b class="heading">Father Name</b> : <span class="value"><?php echo $getTeacherDetails->father_name; ?></span></li>
                                                    <li><b class="heading">Mother Name</b> : <span class="value"><?php echo $getTeacherDetails->mother_name; ?></span></li>
                                                    <li><b class="heading">Spouse Name</b> : <span class="value"><?php echo $getTeacherDetails->spouse_name; ?></span></li>
                                                    <li><b class="heading">Blood</b> : <span class="value"><?php echo $getTeacherDetails->blood_group; ?></span></li>
                                                    <li><b class="heading">Nationality</b> : <span class="value"><?php echo $getTeacherDetails->nationality; ?></span></li>
                                                    <li><b class="heading">Is Handicapped</b> : <span class="value"><?php echo $getTeacherDetails->is_handicapped; ?></span></li>
                                                    <li><b class="heading">Handicap Details</b> : <span class="value"><?php echo $getTeacherDetails->handicap_details; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">HOME ADDRESS</h4>
                                                <ul>
                                                    <li><b class="heading">Address</b> : <span class="value"><?php echo $getTeacherDetails->address; ?></span></li>
                                                    <li><b class="heading">City</b> : <span class="value"><?php echo $getTeacherDetails->city; ?></span></li>
                                                    <li><b class="heading">State</b> : <span class="value"><?php echo $getTeacherDetails->state; ?></span></li>
                                                    <li><b class="heading">Pin Code</b> : <span class="value"><?php echo $getTeacherDetails->pincode; ?></span></li>
                                                    <li><b class="heading">Country</b> : <span class="value"><?php echo $getTeacherDetails->country; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">CONTACT DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">Mobile Number</b> : <span class="value"><?php echo $getTeacherDetails->mobile; ?></span></li>
                                                    <li><b class="heading">Email</b> : <span class="value"><?php echo $getTeacherDetails->email; ?></span></li>
                                                    <li><b class="heading">Home Phone</b> : <span class="value"><?php echo $getTeacherDetails->home_phone; ?></span></li>
                                                    <li><b class="heading">Emergency Contact</b> : <span class="value"><?php echo $getTeacherDetails->emergency_contact; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                        if(isset($getTeacherDetails->customs) and is_array($getTeacherDetails->customs) and !empty($getTeacherDetails->customs)){
                                        ?>
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">CUSTOM DETAILS</h4>
                                                <ul>
                                            <?php
                                            foreach($getTeacherDetails->customs as $value){
                                            ?>
                                                <li><b class="heading"><?php echo $value->name; ?></b> : <span class="value"><?php echo $value->value; ?></span></li>
                                            <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                               </div>
                               <div class="tabs" ng-show="tabs == 'courses'">
                                   
                                   <?php if(isset($getTeacherCourses) and is_array($getTeacherCourses)){
                                    if(count($getTeacherCourses) == 0){ echo "No Courses Found"; }
                                    $row_count = 1;
                                    ?>
                                    <table class="table-list table-striped table m-b-none">
                                    <thead>
                                    <tr>
                                        <th>#</th><th>Academic Year</th><th>Course / Batch</th><th>Status</th><th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($getTeacherCourses as $value){ ?>
                                    <tr>
                                          <td><?php echo $row_count; ?></td>
                                          <td><?php echo $value->AcademicYear; ?></td>
                                          <td><?php echo $value->courseName; ?> / <?php echo $value->className; ?></td>
                                          <td><?php echo $value->status; ?></td>
                                          <td>
                                               <a href="/busytoeasy/admin/app/users/edit_user/{{user.id}}" class="btn action-btn btn-edit"><i class="fa fa-pencil"></i></a>
                                               <button class="btn action-btn btn-delete" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="bounce" ui-target="#animate" ng-click="SetDeleteUserID(user.id)" title="Delete this User"><i class="fa fa-trash"></i></button>
                                          </td>
                                      </tr>
                                      <?php $row_count++; } ?>
                                  </tbody>
                                </table>
                            <?php } ?>
                               </div>
                               <div class="tabs" ng-show="tabs == 'attendance'">
                                   <?php if(isset($getAllEventsMonth) and is_array($getAllEventsMonth)){
                                       if(count($getAllEventsMonth) == 0){ echo "No Event Found"; }
                                   foreach($getAllEventsMonth as $value){ ?>
                                   <article class="posts">
                                       <div class="post-heading">
                                          <div class="title"><span class="name"><?php echo $value['title']; ?></span></div>
                                          <div class="sub-title"><span><?php echo $value['details']; ?></span></div>
                                          <div class="sub-title"><span class="user-type"><?php echo $value['type']; ?></span><span>For: <?php echo $value['privacy']; ?></span></div>
                                          <div class="sub-title"><span class="user">Organizer: <?php echo $value['organizer']; ?></span></div>
                                          <div class="sub-title"><span class="timings"><i class="fa fa-clock-o"></i> : <?php echo $value['start_time']; ?> - <?php echo $value['end_time']; ?></span></div>
                                          
                                          <div class="date"><?php echo date("M, d (D)",strtotime($value['event_date'])); ?></div>
                                       </div>
                                   </article>
                                   <?php } } ?>
                               </div>
                               <div class="tabs" ng-show="tabs == 'activities'">
                                   <?php if(isset($getAllEventsNextMonth) and is_array($getAllEventsNextMonth)){
                                       if(count($getAllEventsNextMonth) == 0){ echo "No Event Found"; }
                                   foreach($getAllEventsNextMonth as $value){ ?>
                                   <article class="posts">
                                       <div class="post-heading">
                                          <div class="title"><span class="name"><?php echo $value['title']; ?></span></div>
                                          <div class="sub-title"><span><?php echo $value['details']; ?></span></div>
                                          <div class="sub-title"><span class="user-type"><?php echo $value['type']; ?></span><span>For: <?php echo $value['privacy']; ?></span></div>
                                          <div class="sub-title"><span class="user">Organizer: <?php echo $value['organizer']; ?></span></div>
                                          <div class="sub-title"><span class="timings"><i class="fa fa-clock-o"></i> : <?php echo $value['start_time']; ?> - <?php echo $value['end_time']; ?></span></div>
                                          
                                          <div class="date"><?php echo date("M, d (D)",strtotime($value['event_date'])); ?></div>
                                       </div>
                                   </article>
                                   <?php } } ?>
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

<script src="<?php echo base_url(); ?>assets/angular/controller/teacher/details.js"></script>
</body>
</html>