<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en" ng-app="schoolApp">
<head>
<!-- Meta Tags -->
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<base href="<?php echo base_url(); ?>" />
<!-- Page Title -->
<title>School ERP | Uriah Solution Pvt Ltd</title>
<meta name="description" content="BusyToEasy Service Experts | Hire Wedding, Home & Beauty Professionals" />
<meta name="keywords" content="BusyToEasy Service Experts | Hire Wedding, Home & Beauty Professionals"/>
<meta name="author" content="BusyToEasy Service Experts | Hire Wedding, Home & Beauty Professionals" />
<!-- Favicon and Touch Icons -->
<link href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo base_url(); ?>assets/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/angular.material.css">
        <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.css" rel="stylesheet" /><!-- Custom box css -->
        <link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">
		<link href="<?php echo base_url(); ?>assets/angular/lib/angular-ui-select/dist/select.min.css" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">
                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<span class="logo-small"><i class="mdi mdi-radar"></i></span>-->
                            <!--<span class="logo-large"><i class="mdi mdi-radar"></i> Adminto</span>-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="/" class="logo">
                            <img src="assets/images/uriah-logo-white.png" alt="Uriah Logo" title="Uriah Logo" height="50" class="logo-small">
                            <img src="assets/images/uriah-logo-white.png" alt="Uriah Logo" title="Uriah Logo" height="40" class="logo-large">
                        </a>
                    </div>
                    
                    <ul class="list-inline menu-left mb-0 navbar-left float-left">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                    </ul>
                    
                    <!-- End Logo container-->
                    <div class="menu-extras topbar-custom">
                        <ul class="list-unstyled topbar-right-menu float-right mb-0">
                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a href="javascript:void(0);" class="right-bar-toggle">
                                                <i class="mdi mdi-bell-outline noti-icon"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ti-user m-r-5"></i> Profile
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ti-settings m-r-5"></i> Settings
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ti-lock m-r-5"></i> Lock screen
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ti-power-off m-r-5"></i> Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="academic-year float-right">
                        <?php $this->session->academic_year; ?>
                        <select name="academic_year">
                            <option value="">Academic year</option>
                            <?php
                            if(isset($getAllAcademicYear) and is_array($getAllAcademicYear)){
                            foreach($getAllAcademicYear as $value){ ?>
                            <option value="<?php echo $value['id']; ?>" <?php if($this->session->academic_year == $value['id']){ echo "selected"; } ?> ><?php echo $value['name']; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    
                    
                    <!-- end menu-extras -->
                    <div class="clearfix"></div>
                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->
        </header>