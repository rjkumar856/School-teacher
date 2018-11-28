<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/menu');
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page" ng-controller="Dashboard">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="dashboard dashboard_bg ui-sortable row" id="dashboard_block">
                
                <div class="dashboard_box birthday col-md-4 col-6" draggable="true" data-box-id="1" ondraggale="drag(ev)">
                    <div class="dashboard_inner_box">
                        <div class="heading">
                          <div class="title"><i class="mdi mdi-cake-variant"></i> Upcoming Birthday</div>
                          <div class="close-icon" title="Hide this box" data-box-id="1"><i class="fa fa-times" aria-hidden="true"></i></div>
                       </div>
                       <div class="box-content">
                           <?php if(isset($getAllBirthDay) and is_array($getAllBirthDay)){ 
                           foreach($getAllBirthDay as $value){ ?>
                           <article class="posts">
                               <div class="post-heading">
                                  <div class="title"><span class="name"><?php echo $value['first_name']; ?>(<?php echo $value['student_id']; ?>)</span></div>
                                  <div class="sub-title"><span class="user-type"><?php echo $value['from_tbl']; ?></span><?php if(!empty($value['class_id'])){?><span>Class: <?php echo $value['class_id']; ?></span><?php } ?></div>
                                  <div class="date"><?php echo date("d M Y",strtotime($value['birthday'])); ?></div>
                               </div>
                           </article>
                           <?php } } ?>
                       </div>
                       <div class="box-footer">
                          <ul>
                             <li><a href="<?php echo base_url(); ?>birthdays">View All</a></li>
                          </ul>
                       </div>
                    </div>
                </div>
                <div class="dashboard_box attendance col-md-4 col-6" draggable="true" data-box-id="2" ondraggale="drag(ev)">
                    <div class="dashboard_inner_box">
                        <div class="heading">
                          <div class="title"><i class="mdi mdi-account-multiple"></i> Attendance</div>
                          <div class="close-icon" title="Hide this box" data-box-id="2"><i class="fa fa-times" aria-hidden="true"></i></div>
                       </div>
                       <div class="box-content">
                           <h2 class="title">Student</h2>
                           <div class="row m-0 p-0">
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllStudentsWithAttendance->TotalStud)){ echo $getAllStudentsWithAttendance->TotalStud; }else { echo 0; } ?></h3>
                                   <span>Total Student</span>
                               </div>
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllStudentsWithAttendance->TotalPresent)){ echo $getAllStudentsWithAttendance->TotalPresent; }else { echo 0; } ?></h3>
                                   <span>No of Present</span>
                               </div>
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllStudentsWithAttendance->TotalAbsent)){ echo $getAllStudentsWithAttendance->TotalAbsent; }else { echo 0; } ?></h3>
                                   <span>No of Absent</span>
                               </div>
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllStudentsWithAttendance->TotalStud) and isset($getAllStudentsWithAttendance->TotalPresent) and isset($getAllStudentsWithAttendance->TotalAbsent)){ echo ($getAllStudentsWithAttendance->TotalStud - $getAllStudentsWithAttendance->TotalPresent - $getAllStudentsWithAttendance->TotalAbsent); }else { echo 0; } ?></h3>
                                   <span>Not Published</span>
                               </div>
                           </div>
                           <h2 class="title">Teachers</h2>
                           <div class="row m-0 p-0">
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllTeacherssWithAttendance->TotalTechr)){ echo $getAllTeacherssWithAttendance->TotalTechr; }else { echo 0; } ?></h3>
                                   <span>Total Teachers</span>
                               </div>
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllTeacherssWithAttendance->TotalPresent)){ echo $getAllTeacherssWithAttendance->TotalPresent; }else { echo 0; } ?></h3>
                                   <span>No of Present</span>
                               </div>
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllTeacherssWithAttendance->TotalAbsent)){ echo $getAllTeacherssWithAttendance->TotalAbsent; }else { echo 0; } ?></h3>
                                   <span>No of Absent</span>
                               </div>
                               <div class="color-box blue-gradient-bg">
                                   <h3><?php if(isset($getAllTeacherssWithAttendance->TotalTechr) and isset($getAllTeacherssWithAttendance->TotalPresent) and isset($getAllTeacherssWithAttendance->TotalAbsent)){ echo ($getAllTeacherssWithAttendance->TotalTechr - $getAllTeacherssWithAttendance->TotalPresent - $getAllTeacherssWithAttendance->TotalAbsent); }else { echo 0; } ?></h3>
                                   <span>Not Published</span>
                               </div>
                           </div>
                       </div>
                       <div class="box-footer">
                          <ul>
                              <li><a href="<?php echo base_url(); ?>create_student_attendance" title="Create Students Attendance">Create Students</a></li>
                              <li><a href="<?php echo base_url(); ?>view_student_attendance" title="View Students Attendance">View Students</a></li>
                              <li><a href="<?php echo base_url(); ?>create_teacher_attendance" title="Create Teachers Attendance">Create Teachers</a></li>
                              <li><a href="<?php echo base_url(); ?>view_teacher_attendance" title="View Teachers Attendance">View Teachers</a></li>
                          </ul>
                       </div>
                    </div>
                </div>
                <div class="dashboard_box examination col-md-4 col-6" draggable="true" data-box-id="1" ondraggale="drag(ev)">
                    <div class="dashboard_inner_box">
                        <div class="heading">
                          <div class="title"><i class="mdi mdi-pencil-box-outline"></i> Upcoming Exams</div>
                          <div class="close-icon" title="Hide this box" data-box-id="1"><i class="fa fa-times" aria-hidden="true"></i></div>
                       </div>
                       <div class="box-content">
                           <article class="posts">
                               <div class="post-heading">
                                  <div class="title"><span class="name">Half Yearly Exams</span></div>
                                  <div class="sub-title"><span class="user-type">Maths</span><span>Class: All</span></div>
                                  <div class="date">Today - 9:00 to 12 PM</div>
                               </div>
                           </article>
                           <article class="posts">
                               <div class="post-heading">
                                  <div class="title"><span class="name">Half Yearly Exams</span></div>
                                  <div class="sub-title"><span class="user-type">Science</span><span>Class: 11-D</span></div>
                                  <div class="date">Tomorrow - 9:00 to 12 PM</div>
                               </div>
                           </article>
                           <article class="posts">
                               <div class="post-heading">
                                  <div class="title"><span class="name">Lokesh (20)</span></div>
                                  <div class="sub-title"><span class="user-type">Chemistry</span><span>Class: 10-D</span></div>
                                  <div class="date">1st Aug - 9:00 to 12 PM</div>
                               </div>
                           </article>
                       </div>
                       <div class="box-footer">
                          <ul>
                             <li><a href="#">Create</a></li>
                             <li><a href="#">View All</a></li>
                          </ul>
                       </div>
                    </div>
                </div>
                <div class="dashboard_box news col-md-4 col-6" draggable="true" data-box-id="1" ondraggale="drag(ev)">
                    <div class="dashboard_inner_box">
                        <div class="heading">
                          <div class="title"><i class="mdi mdi-newspaper"></i> News</div>
                          <div class="close-icon" title="Hide this box" data-box-id="1"><i class="fa fa-times" aria-hidden="true"></i></div>
                       </div>
                       <div class="box-content">
                           <?php if(isset($getAllNews) and is_array($getAllNews)){ 
                           foreach($getAllNews as $value){ ?>
                           <article class="posts">
                               <div class="post-heading">
                                  <div class="title"><span class="name"><?php echo $value['title']; ?></span></div>
                                  <div class="sub-title"><span><?php echo $value['details']; ?></span></div>
                                  <div class="date"><?php echo date("d M Y",strtotime($value['date_added'])); ?></div>
                               </div>
                           </article>
                           <?php } } ?>
                       </div>
                       <div class="box-footer">
                          <ul>
                             <li><a href="<?php echo base_url(); ?>create_news">Create</a></li>
                             <li><a href="<?php echo base_url(); ?>view_news">View All</a></li>
                          </ul>
                       </div>
                    </div>
                </div>
                <div class="dashboard_box news col-md-4 col-6" draggable="true" data-box-id="1" ondraggale="drag(ev)">
                    <div class="dashboard_inner_box">
                        <div class="heading">
                          <div class="title"><i class="mdi mdi-calendar-text"></i> Events</div>
                          <div class="close-icon" title="Hide this box" data-box-id="1"><i class="fa fa-times" aria-hidden="true"></i></div>
                       </div>
                       <div class="box-content">
                           <div class="tabs">
                               <ul>
                                   <li ng-class="{ active : tabs === 'today'}"><button class="btn" tab-click="today">Today</button></li>
                                   <li ng-class="{ active : tabs === 'week'}"><button class="btn " tab-click="week" >This Week</button></li>
                                   <li ng-class="{ active : tabs === 'month'}"><button class="btn " tab-click="month" >This Month</button></li>
                                   <li ng-class="{ active : tabs === 'next_month'}"><button class="btn " tab-click="next_month" >Next Month</button></li>
                               </ul>
                           </div>
                           <div class="tab-content">
                               <div class="tabs" ng-show="tabs == 'today'">
                                   <?php if(isset($getAllEventsToday) and is_array($getAllEventsToday)){
                                       if(count($getAllEventsToday) == 0){ echo "No Event Found"; }
                                   foreach($getAllEventsToday as $value){ ?>
                                   <article class="posts">
                                       <div class="post-heading">
                                          <div class="title"><span class="name"><?php echo $value['title']; ?></span></div>
                                          <div class="sub-title"><span><?php echo $value['details']; ?></span></div>
                                          <div class="sub-title"><span class="user-type"><?php echo $value['type']; ?></span><span>For: <?php echo $value['privacy']; ?></span></div>
                                          <div class="sub-title"><span class="user">Organizer: <?php echo $value['organizer']; ?></span></div>
                                          <div class="sub-title"><span class="timings"><i class="fa fa-clock-o"></i> : <?php echo $value['start_time']; ?> - <?php echo $value['end_time']; ?></span></div>
                                          
                                          <div class="date">Today</div>
                                       </div>
                                   </article>
                                   <?php } } ?>
                               </div>
                               <div class="tabs" ng-show="tabs == 'week'">
                                    <?php if(isset($getAllEventsWeek) and is_array($getAllEventsWeek)){
                                       if(count($getAllEventsWeek) == 0){ echo "No Event Found"; }
                                   foreach($getAllEventsWeek as $value){ ?>
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
                               <div class="tabs" ng-show="tabs == 'month'">
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
                               <div class="tabs" ng-show="tabs == 'next_month'">
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
                       <div class="box-footer">
                          <ul>
                             <li><a href="<?php echo base_url(); ?>create_events">Create</a></li>
                             <li><a href="<?php echo base_url(); ?>view_events">View All</a></li>
                          </ul>
                       </div>
                    </div>
                </div>
                
                <div class="dashboard_box examination col-md-4 col-6" draggable="true" data-box-id="1" ondraggale="drag(ev)">
                    <div class="dashboard_inner_box">
                        <div class="heading">
                          <div class="title"><i class="mdi mdi-pencil-box-outline"></i> Upcoming Holidays</div>
                          <div class="close-icon" title="Hide this box" data-box-id="1"><i class="fa fa-times" aria-hidden="true"></i></div>
                       </div>
                       <div class="box-content">
                       <?php if(isset($getAllHolidays) and is_array($getAllHolidays)){
                        if(count($getAllHolidays) == 0){ echo "No Event Found"; }
                        foreach($getAllHolidays as $value){ ?>
                           <article class="posts">
                               <div class="post-heading">
                                  <div class="title"><span class="name"><?php echo $value['title']; ?></span></div>
                                  <div class="sub-title">For: <span class="user-type"><?php echo $value['class']; ?> Classes</span></div>
                                  <div class="date"><?php echo date("d M Y",strtotime($value['leave_date'])); ?></div>
                               </div>
                           </article>
                           <?php } } ?>
                       </div>
                       <div class="box-footer">
                          <ul>
                             <li><a href="<?php echo base_url(); ?>create_holidays">Create</a></li>
                             <li><a href="<?php echo base_url(); ?>view_holidays">View All</a></li>
                          </ul>
                       </div>
                    </div>
                </div>

                            <div id="dashboard_err" style="display: none;">
                               <div class="yellow_bx" style="background-image:none;padding-bottom:45px;">
                                  <div class="y_bx_head" style="width:650px;">
                                     All blocks in the dashboard are disabled. You can change it from Dashboard Settings                    
                                  </div>
                                  <div class="y_bx_list" style="width:650px;">
                                     <h1><a href="#">Dashboard Settings</a></h1>
                                  </div>
                               </div>
                            </div>
                            <br style="">
                            <div class="clear"></div>
                            <div id="jobDialog"></div>
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

<script src="<?php echo base_url(); ?>assets/angular/controller/dashboard.js"></script>
</body>
</html>