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
                      <h2 class="title theme-color theme-border-color">STUDENTS PROFILE</h2>
                    </div>
                    <div class="box-body mt-2 ">
                        <div class="row col-12 d-inline-block">
                            
                            <div class="box-details1 box-profile text-center pull-left">
                                <div class="inner">
                                    <img src="assets/files/student/<?php if($getStudentDetails->photo){ echo $getStudentDetails->photo; }else{ echo "default.png";} ?>" width="64" alt="Rajakumar Anbalagan" titl="Rajakumar Anbalagan" class="image" />
                                </div>
                            </div>
                            
                            <div class="box-details col-4 pull-left">
                                <div class="inner border-top-0">
                                    <ul>
                                        <li><b class="heading">Name</b> : <span class="value"><?php echo $getStudentDetails->first_name." ". $getStudentDetails->last_name; ?></span></li>
                                        <li><b class="heading">Roll No.</b> : <span class="value"><?php echo $getStudentDetails->roll_number; ?></span></li>
                                        <li><b class="heading">Admission No.</b> : <span class="value"><?php echo $getStudentDetails->admission_number; ?></span></li>
                                        <li><b class="heading">Course</b> : <span class="value"><?php echo $getStudentDetails->class_id; ?></span></li>
                                        <li><b class="heading">Batch/Class</b> : <span class="value"><?php echo $getStudentDetails->class_id; ?></span></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="box-top-content pull-left">
                                <h5>Navigate to:</h5>
                                <a href="<?php echo base_url(); ?>view-students" class="btn link-text theme-btn">Attendance</a>
                                <a href="<?php echo base_url(); ?>view-students" class="btn link-text theme-btn">Time Table</a>
                                <a href="<?php echo base_url(); ?>view-students" class="btn link-text theme-btn">Fees</a>
                                <a href="<?php echo base_url(); ?>view-students" class="btn link-text theme-btn">Exams</a>
                            </div>
                            <div class="box-top-content pull-right">
                                <a href="<?php echo base_url(); ?>edit-student/<?php echo $getStudentDetails->student_id; ?>" class="btn link-text theme-btn">Edit</a>
                                <a href="<?php echo base_url(); ?>view-students" class="btn link-text theme-btn">Students</a>
                            </div>
                        </div>
                        
                        <div class="box-content" ng-init="tabs='details'">
                        <div class="tabs theme-tabs">
                               <ul class="nav nav-tabs">
                                   <li ng-class="{ active : tabs === 'details'}"><button class="btn" tab-click="details">Profile</button></li>
                                   <li ng-class="{ active : tabs === 'courses'}"><button class="btn " tab-click="courses" >Course</button></li>
                                   <li ng-class="{ active : tabs === 'attendance'}"><button class="btn " tab-click="attendance" >Attendance</button></li>
                                   <li ng-class="{ active : tabs === 'activities'}"><button class="btn " tab-click="activities" >Activities</button></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                               <div class="tabs" ng-show="tabs == 'details'">
                                   <div class="profile-details row">
                                       <div class="col-sm-12">
                                           <h5 class="title header">STUDENT DETAILS</h5>
                                       </div>
                                       
                                       <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">PERSONAL DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">Roll Number</b> : <span class="value"><?php echo $getStudentDetails->roll_number; ?></span></li>
                                                    <li><b class="heading">Admission Date</b> : <span class="value"><?php echo $getStudentDetails->doj; ?></span></li>
                                                    <li><b class="heading">Student ID:</b> : <span class="value"><?php echo $getStudentDetails->roll_number; ?></span></li>
                                                    <li><b class="heading">Date Of Birth</b> : <span class="value"><?php echo $getStudentDetails->dob; ?></span></li>
                                                    <li><b class="heading">Gender</b> : <span class="value"><?php echo $getStudentDetails->gender; ?></span></li>
                                                    <li><b class="heading">Blood</b> : <span class="value"><?php echo $getStudentDetails->blood_group; ?></span></li>
                                                    <li><b class="heading">Birth Place</b> : <span class="value"><?php echo $getStudentDetails->birth_place; ?></span></li>
                                                    <li><b class="heading">Nationality</b> : <span class="value"><?php echo $getStudentDetails->nationality; ?></span></li>
                                                    <li><b class="heading">Language</b> : <span class="value"><?php echo $getStudentDetails->language; ?></span></li>
                                                    <li><b class="heading">Religion</b> : <span class="value"><?php echo $getStudentDetails->religion; ?></span></li>
                                                    <li><b class="heading">Student Category</b> : <span class="value"><?php echo $getStudentDetails->student_category; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">CONTACT DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">Address</b> : <span class="value"><?php echo $getStudentDetails->address; ?></span></li>
                                                    <li><b class="heading">City</b> : <span class="value"><?php echo $getStudentDetails->city_id; ?></span></li>
                                                    <li><b class="heading">State</b> : <span class="value"><?php echo $getStudentDetails->state_id; ?></span></li>
                                                    <li><b class="heading">Pin Code</b> : <span class="value"><?php echo $getStudentDetails->roll_number; ?></span></li>
                                                    <li><b class="heading">Country</b> : <span class="value"><?php echo $getStudentDetails->country_id; ?></span></li>
                                                    <li><b class="heading">Phone Number</b> : <span class="value"><?php echo $getStudentDetails->mobile; ?></span></li>
                                                    <li><b class="heading">Email</b> : <span class="value"><?php echo $getStudentDetails->email; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                        if(isset($getStudentDetails->customs) and is_array($getStudentDetails->customs) and !empty($getStudentDetails->customs)){
                                        ?>
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">CUSTOM DETAILS</h4>
                                                <ul>
                                            <?php
                                            foreach($getStudentDetails->customs as $value){
                                            ?>
                                                <li><b class="heading"><?php echo $value->name; ?></b> : <span class="value"><?php echo $value->value; ?></span></li>
                                            <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="profile-details row">
                                        <div class="col-sm-12">
                                           <h5 class="title header">GUARDIAN DETAILS</h5>
                                        </div>
                                        <?php
                                        if(isset($getParentDetails) and !empty($getParentDetails)){
                                            foreach($getParentDetails as $value){ ?>
                                        <div class="col-sm-12">
                                           <h4 class="title theme-color"><?php echo $value['relationship']; ?></h4>
                                        </div>
                    
                                        <div class="box-details col-sm-6 mb-0">
                                            <div class="inner">
                                                <h4 class="title theme-color">Personal Details</h4>
                                                <ul>
                                                    <li><b class="heading">First Name (Parent)</b> : <span class="value"><?php echo $value['first_name']; ?></span></li>
                                                    <li><b class="heading">Last Name</b> : <span class="value"><?php echo $value['last_name']; ?></span></li>
                                                    <li><b class="heading">Relation</b> : <span class="value"><?php echo $value['relationship']; ?></span></li>
                                                    <li><b class="heading">Date Of Birth</b> : <span class="value"><?php echo $value['dob']; ?></span></li>
                                                    <li><b class="heading">Education</b> : <span class="value"><?php echo $value['education']; ?></span></li>
                                                    <li><b class="heading">Occupation</b> : <span class="value"><?php echo $value['occupation']; ?></span></li>
                                                    <li><b class="heading">Income</b> : <span class="value"><?php echo $value['income']; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="box-details col-sm-6 mb-0">
                                            <div class="inner">
                                                <h4 class="title theme-color">CONTACT DETAILS</h4>
                                                <ul>
                                                    <li><b class="heading">Email</b> : <span class="value"><?php echo $value['email']; ?></span></li>
                                                    <li><b class="heading">Mobile Phone</b> : <span class="value"><?php echo $value['mobile']; ?></span></li>
                                                    <li><b class="heading">Office Phone</b> : <span class="value"><?php echo $value['office_phone']; ?></span></li>
                                                    <li><b class="heading">Address</b> : <span class="value"><?php echo $value['address']; ?></span></li>
                                                    <li><b class="heading">City</b> : <span class="value"><?php echo $value['city_id']; ?></span></li>
                                                    <li><b class="heading">State</b> : <span class="value"><?php echo $value['state_id']; ?></span></li>
                                                    <li><b class="heading">Pin Code</b> : <span class="value"><?php echo $value['pincode']; ?></span></li>
                                                    <li><b class="heading">Country</b> : <span class="value"><?php echo $value['country_id']; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php } }else{ ?>
                                        <p class="alert alert-danger">No Guardian details found.</p>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="profile-details row">
                                        <div class="col-sm-12">
                                           <h5 class="title header">PREVIOUS Qualification</h5>
                                        </div>
                                        <?php
                                        $index = 1;
                                        if(isset($getPreviousQualification) and !empty($getPreviousQualification)){
                                            foreach($getPreviousQualification as $value){ ?>
                                        <div class="col-sm-12">
                                           <h4 class="title theme-color">PREVIOUS DETAILS #<?php echo $index; ?></h4>
                                        </div>
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">Institute Details</h4>
                                                <ul>
                                                    <li><b class="heading">Institute</b> : <span class="value"><?php echo $value->institue_name; ?></span></li>
                                                    <li><b class="heading">Address</b> : <span class="value"><?php echo $value->institue_address; ?></span></li>
                                                    <li><b class="heading">Course</b> : <span class="value"><?php echo $value->course; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="box-details col-sm-6">
                                            <div class="inner">
                                                <h4 class="title theme-color">Other Details</h4>
                                                <ul>
                                                    <li><b class="heading">Year</b> : <span class="value"><?php echo $value->year; ?></span></li>
                                                    <li><b class="heading">Mark/Percentage</b> : <span class="value"><?php echo $value->total_mark; ?></span></li>
                                                    <li><b class="heading">Reason</b> : <span class="value"><?php echo $value->reason_for_change; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php $index++; } }else{ ?>
                                        <p class="alert alert-danger">No Qualification details found.</p>
                                        <?php } ?>
                                    </div>
                               </div>
                               <div class="tabs" ng-show="tabs == 'courses'">
                                   
                                   <?php if(isset($getStudentCourses) and is_array($getStudentCourses)){
                                    if(count($getStudentCourses) == 0){ echo "No Courses Found"; }
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
                                    foreach($getStudentCourses as $value){ ?>
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

<script src="<?php echo base_url(); ?>assets/angular/controller/student/details.js"></script>
</body>
</html>