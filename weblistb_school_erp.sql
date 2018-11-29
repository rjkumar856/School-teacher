-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2018 at 04:32 AM
-- Server version: 5.6.41
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weblistb_school_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `current_year` enum('Yes','No','') NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `name`, `description`, `start_date`, `end_date`, `current_year`, `status`, `date_added`, `date_modified`) VALUES
(1, 'AY-2018-2019', 'Academic year -2018-2019', '2018-06-01', '2019-05-31', 'Yes', 'Active', '2018-10-29 08:10:14', '2018-10-29 08:10:14'),
(2, 'AY-2017-2018', 'Academic year - 2017-2018', '2017-06-01', '2018-05-31', 'No', 'Active', '2018-10-29 08:10:14', '2018-10-30 13:09:49'),
(3, 'AY-2019-2020', 'Academic year - 2019-2020', '2019-06-01', '2020-05-31', 'No', 'Active', '2018-10-29 08:10:14', '2018-10-29 08:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Suspended','Deleted','') DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `course_id`, `teacher_id`, `name`, `date_added`, `date_modified`) VALUES
(1, 1, 1, 'Section A', '2018-10-26 12:52:35', '2018-10-26 12:52:35'),
(2, 1, 2, 'Section B', '2018-10-26 12:52:35', '2018-10-26 12:55:38'),
(3, 2, 1, 'Section A', '2018-10-26 12:52:35', '2018-10-26 12:55:41'),
(4, 2, 2, 'Section B', '2018-10-26 12:52:35', '2018-10-26 12:52:35'),
(5, 1, 3, 'Section C', '2018-10-26 12:52:35', '2018-10-26 12:55:38'),
(6, 2, 3, 'Section C', '2018-10-26 12:52:35', '2018-10-26 12:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `academic_id`, `name`, `details`, `date_added`, `date_modified`) VALUES
(1, 1, '1st Standard', '1st Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:03'),
(2, 1, '2nd Standard', '2nd Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:06'),
(3, 1, '3rd Standard', '3rd Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:09'),
(4, 1, '4th Standard', '4th Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:11'),
(5, 1, '5th Standard', '5th Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:13'),
(6, 2, '5th Standard', '5th Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('Text','Textarea','Options') NOT NULL DEFAULT 'Text',
  `used_for` set('Student','Parent','Teacher','Admin','Course') NOT NULL DEFAULT 'Student',
  `required` enum('True','False','') NOT NULL DEFAULT 'False',
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `name`, `title`, `type`, `used_for`, `required`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Aadhar Number', 'aadhar_number', 'Textarea', 'Student', 'False', 'Active', '2018-10-31 07:11:07', '2018-10-31 10:15:29'),
(2, 'Land line', 'land_line', 'Text', 'Student', 'True', 'Active', '2018-10-31 07:11:07', '2018-10-31 09:40:04'),
(7, 'Aadhar Number', 'aadhar_number', 'Text', 'Teacher', 'True', 'Active', '2018-11-20 09:50:48', '2018-11-21 10:10:11'),
(9, 'PAN Number', 'land_line', 'Text', 'Teacher', 'True', 'Active', '2018-11-20 09:56:52', '2018-11-22 09:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('Active','Deactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `code`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Computer Science and Engineering', 'CSE', 'Active', '2018-11-21 06:01:20', '2018-11-21 06:01:20'),
(2, 'Electronics and Communication Engineering', 'ECE', 'Active', '2018-11-21 06:01:20', '2018-11-21 06:01:20'),
(3, 'Commerce', 'Com', 'Active', '2018-11-21 06:01:20', '2018-11-21 06:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `privacy` enum('All','Teacher','Student','Parent','Admin','Bus Supervisor','Manager','') NOT NULL DEFAULT 'All',
  `event_date` date NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `status` enum('Active','Deactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `details`, `type`, `privacy`, `event_date`, `start_time`, `end_time`, `organizer`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Wednesday missing', 'Some time happe when you deeply involved in worl and you forgot days.', 'Meetings', 'All', '2018-10-25', '3:00PM', '5:00PM', 'Dr.Rajkumar A', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:43:16'),
(2, 'Sports Day', 'We are planning to conduct the Sports day at School/College Staium.', 'Function', 'Teacher', '2018-10-26', '12:00PM', '2:00PM', 'Mr.Sarabrish', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:32'),
(3, 'Sports Day', 'We are planning to conduct the Freshers Day on School Auditorium.', 'Announcement', 'Student', '2018-10-31', '2:00PM', '4:00PM', 'Mr.Senthil', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:36'),
(4, 'Sports Day1', 'We are planning to conduct the Freshers Day on School Auditorium.', 'Announcement1', 'Admin', '2018-11-21', '2:00PM', '4:00PM', 'Mr.Senthil', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:40'),
(5, 'Sports Day2', 'We are planning to conduct the Freshers Day on School Auditorium.', 'Announcement2', 'Bus Supervisor', '2018-11-14', '2:00PM', '4:00PM', 'Mr.Senthil', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `title` int(11) NOT NULL,
  `type` enum('Marks','Grades','Marks & Grades','') NOT NULL DEFAULT 'Marks',
  `exam_date` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL DEFAULT 'All',
  `leave_date` date NOT NULL DEFAULT '0000-00-00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `class`, `leave_date`, `date_added`, `date_modified`) VALUES
(1, 'Dewali', 'All', '2018-10-25', '2018-10-25 09:16:27', '2018-10-25 09:31:05'),
(2, 'Ayutha Pooja', '1,2,3', '2018-10-26', '2018-10-25 09:16:27', '2018-10-25 09:18:29'),
(3, 'Muharam', 'All', '2018-10-27', '2018-10-25 09:16:27', '2018-10-25 09:19:14'),
(4, 'Christmas', 'All', '2018-10-29', '2018-10-25 09:16:27', '2018-10-25 09:19:19'),
(5, 'Dusshera', '1,3,4,5', '2018-10-31', '2018-10-25 09:16:27', '2018-10-25 09:19:47'),
(6, 'Independence Day', 'All', '2018-10-31', '2018-10-25 09:16:27', '2018-10-25 09:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` enum('Active','Deactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `details`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Wednesday missing', 'Some time happe when you deeply involved in worl and you forgot days.', 'Active', '2018-10-24 13:17:38', '2018-10-24 13:17:38'),
(2, 'Sports Day', 'We are planning to conduct the Sports day at School/College Staium.', 'Active', '2018-10-24 13:17:38', '2018-10-24 13:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `relationship` enum('Father','Mother','Sibiling','Others','') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(512) NOT NULL,
  `office_phone` varchar(20) NOT NULL,
  `education` varchar(100) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `gender` set('Male','Female','Others','') NOT NULL,
  `income` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `role` enum('All','For Details','') NOT NULL DEFAULT 'All',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Suspended','Deleted','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `relationship`, `first_name`, `last_name`, `mobile`, `email`, `password`, `office_phone`, `education`, `occupation`, `gender`, `income`, `dob`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `role`, `created_by`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Father', 'Rajakumar2', 'Anbalagan', '9092310791', 'rjkumar856@gmail.com', '0iM9AVETTpYH2oK9JCc7gZBrmsXPNw29mzcmEYCtd8HMVFkVx249SAT/l5t0B5vSzEOpwmtzyHXKrP5qRk2Kyg==', '1234567', 'BE', 'Software Engineer', '', 'Rs.300000 per Annum', '1990-10-24', 'E-City', 1, 1, 1, '456464', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-11-19 08:14:16'),
(2, 'Mother', 'Suresh', 'P', '9092310795', 'rjkumar855@gmail.com', '0iM9AVETTpYH2oK9JCc7gZBrmsXPNw29mzcmEYCtd8HMVFkVx249SAT/l5t0B5vSzEOpwmtzyHXKrP5qRk2Kyg==', '96642211', 'BCS', 'Self Employed', '', 'Rs.100000 per Annum', '1990-10-17', 'BTM Layout', 1, 1, 1, '456456', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-11-19 08:14:19'),
(3, 'Mother', 'Lokesh', 'K', '9092310794', 'rjkumar858@gmail.com', '0iM9AVETTpYH2oK9JCc7gZBrmsXPNw29mzcmEYCtd8HMVFkVx249SAT/l5t0B5vSzEOpwmtzyHXKrP5qRk2Kyg==', '435435454', 'Ph.D', 'Teacher', 'Female', 'Rs.400000 per Annum', '1990-10-17', 'BTM Layout', 1, 1, 1, '566445', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-11-21 07:10:30'),
(4, 'Father', 'Ashutosh', 'Kadri', '9092310793', 'rjkumar854@gmail.com', 'c5yYVPxiJkoB//3AUn9fJNVwpA8Kwvv2zBzUYQTg3/T2F51obNX2KfBPcA9gJ0jYgYVYFgCsEfPCofAw7+dHTg==', '453453414535', 'Ph.Dd', 'Teacher', 'Female', 'Rs.400000 per Annum', '1990-10-17', 'BTM Layout', 1, 1, 1, '456454', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-11-19 09:20:54'),
(5, 'Father', 'Rajsaku', 'sadsad', '9092310799', 'rjkumar859@gmail.com', '0iM9AVETTpYH2oK9JCc7gZBrmsXPNw29mzcmEYCtd8HMVFkVx249SAT/l5t0B5vSzEOpwmtzyHXKrP5qRk2Kyg==', '45345435', 'BEf', 'Software asdsa  sdaasd', 'Male', 'Rs.1000 month', '2016-02-01', 'sadsad dfdsfdsf', 1, 1, 1, '534336', 'All', 1, 'Active', '2018-11-12 13:03:16', '2018-11-19 08:14:26'),
(8, 'Mother', 'aaaa', 'aaaa', '9999999999', 'aaaa@gmail.com', 'HD4DigdhEippi6t9xkCJ72B3zzItVaIyXhbWD5RXPT+dK2TQe0cycwgolEbQn97GGpGKHqn1sce0UYSRx2ogKQ==', 'assa', 'aasa', 'aaaa', 'Male', 'aaaa', '2016-02-01', 'asasaaaaaaaaaaaaaaaaaaaa', 1, 1, 1, '560101', 'All', 1, 'Active', '2018-11-22 05:09:27', '2018-11-22 05:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `options` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `options`, `value`, `date_added`, `date_modified`) VALUES
(1, 'application_status', 'Active', '2018-11-13 03:48:37', '2018-11-20 06:07:48'),
(2, 'student_roll_number_prefix', 'STE', '2018-11-19 04:40:31', '2018-11-20 07:50:11'),
(3, 'teacher_id_prefix', 'A', '2018-11-19 04:40:50', '2018-11-28 08:00:40'),
(4, 'default_student_password', 'Welcome@1234', '2018-11-19 04:40:50', '2018-11-20 07:50:19'),
(5, 'default_parent_password', 'Welcome@12345', '2018-11-19 04:40:50', '2018-11-20 07:50:22'),
(6, 'default_teacher_password', 'Welcome@125', '2018-11-19 04:40:50', '2018-11-28 08:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `admission_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_key` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT '',
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `gender` enum('Male','Female','Others','') NOT NULL DEFAULT 'Male',
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-','') NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Terminated','Transfered','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `roll_number`, `admission_number`, `first_name`, `middle_name`, `last_name`, `mobile`, `email`, `password`, `access_key`, `photo`, `dob`, `doj`, `gender`, `blood_group`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `class_id`, `created_by`, `status`, `date_added`, `date_modified`) VALUES
(1, 'SCE1', '1', 'Rajakumar3', '', 'Anbalagan', '9092310791', 'rjkumar856@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', '', '', '1990-10-24', '2018-10-24', 'Male', 'A+', 'E-city', 1, 1, 1, '', 1, 1, 'Active', '2018-10-24 06:28:33', '2018-11-22 04:40:04'),
(2, 'SCE2', '2', 'Lokesh', '', 'Kumar Karri', '9092310792', 'rjkumar858@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', '', '', '1990-10-31', '2018-10-24', 'Male', 'A-', 'HSR Layout', 1, 1, 1, '', 2, 1, 'Active', '2018-10-24 06:28:33', '2018-11-22 04:40:02'),
(3, 'SCE3', '3', 'Suresh', '', 'K', '9092310793', 'rjkumar857@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', '', '', '1990-10-31', '2018-10-24', 'Male', 'B+', 'HSR Layout', 1, 1, 1, '', 3, 1, 'Active', '2018-10-24 06:28:33', '2018-11-22 04:40:07'),
(4, 'SCE4', '4', 'Raj1', '', 'Anbalagan', '9092310794', 'rjkumar8561@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', '', '', '1990-10-24', '2018-10-24', 'Female', 'B-', 'E-city1', 1, 1, 1, '', 4, 1, 'Terminated', '2018-10-24 06:28:33', '2018-11-22 04:40:09'),
(5, 'SCE5', '5', 'Lokesh2', '', 'K', '9092310795', 'rjkumar8582@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', '', '', '1990-10-31', '2018-10-24', 'Female', 'O+', 'HSR Layout', 1, 1, 1, '', 5, 1, 'Terminated', '2018-10-24 06:28:33', '2018-11-22 04:40:10'),
(6, 'SCE6', '6', 'Suresh2', '', 'K', '9092310796', 'rjkumar8563@gmail.com', 'tWzaj6ceUD14EIyzHYyxyhGGT3CODBLEKjGKejxHbnZvyz1iQJwPCw+fhiReimg57hMbNknLn7s3KVTbjkXp1Q==', '', '', '1990-10-31', '2018-10-24', 'Others', 'O-', 'HSR Layout', 1, 1, 1, '565655', 6, 1, 'Active', '2018-10-24 06:28:33', '2018-11-20 11:19:32'),
(7, 'BCS64', '7', 'asdasd', '', 'Nasdaq', '5645311455', 'ererew@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', 'key_5be6af2b3c609odji5piks', '', '2018-05-08', '2018-11-09', 'Male', 'A+', 'asdsad sadsad', 1, 1, 1, '56656', 1, 0, 'Active', '2018-11-10 10:12:59', '2018-11-15 08:55:28'),
(9, 'B08CS164', '9', 'Radsad adsadsad', 'asdsad sdd', 'sadsad', '9907632555', 'dsfsdfsd@ffsd.com', 'uRS+Xh7iRJQnOSw2UxZBXhxKtHP29OEf6cmm3xSqlfVAX5a+MnmFpbOA9NiOSshNDNlinIhoHCq9lV/BHwyltw==', 'key_5be927e981ae5hxt2yzgcw', 'b08cs164.jpg', '0000-00-00', '0000-00-00', 'Male', 'A-', 'sadsad dsfsdfsdf', 1, 1, 1, '657542', 4, 0, 'Active', '2018-11-12 07:12:41', '2018-11-12 07:12:41'),
(11, 'bsdfsd2333336', '11', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', 'q/LbWT+F1GQJ1rUvAybT9BuAwkX6xjoYXiGGfoTA+RFU0EX6HhTS9GKqezPcq47iSUiNHYxwOpb+nG+KvPbzug==', 'key_5be92fe2f0015poez2jsty', 'bsdfsd2333336.jpg', '0000-00-00', '0000-00-00', 'Male', 'A+', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, 0, 'Active', '2018-11-12 07:46:42', '2018-11-12 07:46:42'),
(13, 'bsdfsd23331', '13', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', 'kadX30Ig280ah/cdKlOasxCyoZGS7vvtTzeRDLInAoLTq+QjFuKXhNg/ylAwxRC1ChSK0h6StwCL6oimM7Zarg==', 'key_5be930405dd58uezda70ip', 'bsdfsd23331.jpg', '0000-00-00', '0000-00-00', 'Male', 'A+', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, 0, 'Active', '2018-11-12 07:48:16', '2018-11-12 07:48:16'),
(14, 'bsdfsd23332', '14', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', '/r15M/2AUOZZo6Tr1nxe/y1pwTxaowywchyMaJxo0cIq0Nt8XxlA9Cw4GnOHSh2DnlFvNMgIzpVxMLoc6MAXIw==', 'key_5be9323560d0b4dbkfgipl', '', '0000-00-00', '0000-00-00', 'Male', 'A+', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, 0, 'Active', '2018-11-12 07:56:37', '2018-11-15 06:52:38'),
(16, 'STE', '16', 'aaa', '', 'aaa', '9999999999', 'aaaaa@gmail.com', '3obe1h6me/VJQ3n986PkvgEKBMGtcsk6i9NLNO5JokSYO2s8Nc9I2/cb1ng9zSHMh7KNBKfFik5F0S4+JQF+Uw==', 'key_5bf6392cf00f9ricvrkoye', 'ste.png', '2016-01-04', '2018-11-22', 'Male', '', 'aaa aasasasasasasasasasasas', 1, 1, 1, '560102', 4, 0, 'Active', '2018-11-22 05:05:49', '2018-11-22 05:05:49'),
(17, 'STE12', '17', 'gfgdfg', '', 'fdgfgdg', '5454534345', 'rsdfsd@fgdf.fg', 'feczurYo/3IdyZg2k3Sn813oOm32VEndU6lgYC2KWuqeoxoXE5EmbkWLVvuDAPZrtIuGkr9uySx65xUYZQ4hjA==', 'key_5bf6494daeddchgwmtcrs0', '', '2018-11-22', '2018-11-22', 'Male', '', 'dfgdfg dfgdfgdfg', 1, 1, 1, '445432', 0, 0, 'Active', '2018-11-22 06:14:37', '2018-11-22 06:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `students_details`
--

CREATE TABLE `students_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `nationality` varchar(40) NOT NULL,
  `language` varchar(255) NOT NULL,
  `religion` varchar(40) NOT NULL,
  `student_category` varchar(40) NOT NULL,
  `is_handicapped` enum('Yes','No','') NOT NULL DEFAULT 'No',
  `handicap_details` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_details`
--

INSERT INTO `students_details` (`id`, `student_id`, `birth_place`, `nationality`, `language`, `religion`, `student_category`, `is_handicapped`, `handicap_details`, `date_added`, `date_modified`) VALUES
(1, 1, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:56'),
(2, 2, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:53'),
(3, 3, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:50'),
(4, 4, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:48'),
(5, 5, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:42'),
(6, 6, 'Salem', 'Indian6', 'Tamil,Telugu,English6', 'Hindu6', '1', 'Yes', 'Nil6', '2018-10-31 08:00:44', '2018-11-20 11:19:32'),
(7, 7, 'asdd', '', '', 'No', '1', 'No', '', '2018-11-10 10:12:59', '2018-11-10 10:28:37'),
(9, 9, 'SAlem', '', 'Tamil,English', 'No', '1', 'No', '', '2018-11-12 07:12:41', '2018-11-12 07:12:41'),
(17, 17, '', '', '', '', '1', 'No', '', '2018-11-22 06:14:37', '2018-11-22 06:14:37'),
(11, 11, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:46:42', '2018-11-12 07:46:42'),
(16, 16, '', '', '', '', '1', 'No', '', '2018-11-22 05:05:49', '2018-11-22 05:05:49'),
(13, 13, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:48:16', '2018-11-12 07:48:16'),
(14, 14, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:56:37', '2018-11-12 07:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `students_documents`
--

CREATE TABLE `students_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` enum('Approved','Disapproved','Rejected','Waiting','') NOT NULL DEFAULT 'Waiting',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_documents`
--

INSERT INTO `students_documents` (`id`, `student_id`, `doc_name`, `url`, `status`, `date_added`, `date_modified`) VALUES
(1, 15, 'Aadhar Card', '1.jpg', 'Disapproved', '2018-10-30 07:55:41', '2018-11-16 11:13:58'),
(2, 15, '12th Marksheet', '2.pdf', 'Waiting', '2018-10-30 07:55:41', '2018-11-14 09:28:30'),
(5, 15, '10th Marksheet', '3.doc', 'Approved', '2018-11-14 07:33:32', '2018-11-14 10:01:52'),
(6, 15, 'TC', '4.png', 'Approved', '2018-11-14 07:33:32', '2018-11-16 11:07:48'),
(11, 15, 'sdfsdfsd', '15_sdfsdfsd_1542356683.jpg', 'Approved', '2018-11-16 08:24:43', '2018-11-16 08:24:43'),
(12, 15, 'sdfsd dsfsdfsdf334', '15_sdfsd-dsfsdfsdf_1542356984.png', 'Disapproved', '2018-11-16 08:29:44', '2018-11-16 11:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `students_previous_qualification`
--

CREATE TABLE `students_previous_qualification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `institue_name` varchar(255) NOT NULL,
  `institue_address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `total_mark` varchar(10) NOT NULL DEFAULT '',
  `reason_for_change` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_previous_qualification`
--

INSERT INTO `students_previous_qualification` (`id`, `student_id`, `institue_name`, `institue_address`, `course`, `year`, `total_mark`, `reason_for_change`, `date_added`, `date_modified`) VALUES
(1, 2, 'MCET', 'Pollachi', 'BE-CSE', '2008-2012', '74%', 'Course completed', '2018-10-30 07:55:41', '2018-10-30 07:55:41'),
(2, 15, 'MCET', 'Pollachi', 'BE-CSE', '2008-2012', '74%', 'Course completed', '2018-10-30 07:55:41', '2018-10-30 07:55:41'),
(5, 15, 'Anna University', 'Chennai', 'ME-CSE', '2012-2016', '84%', 'Reason for change Course Complteddd', '2018-11-14 07:33:32', '2018-11-14 07:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` bigint(20) UNSIGNED NOT NULL,
  `att_date` date NOT NULL DEFAULT '0000-00-00',
  `attendance` enum('Present','Absent','Half Day','') NOT NULL DEFAULT 'Present',
  `reason` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `stu_id`, `att_date`, `attendance`, `reason`, `date_added`, `date_modified`) VALUES
(1, 1, '2018-10-24', 'Present', '', '2018-10-24 10:06:06', '2018-10-24 10:55:33'),
(2, 2, '2018-10-24', 'Absent', '', '2018-10-24 10:06:06', '2018-10-24 10:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `student_category`
--

CREATE TABLE `student_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_category`
--

INSERT INTO `student_category` (`id`, `name`, `status`, `date_added`, `date_modified`) VALUES
(1, 'General', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58'),
(2, 'Free Education', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `student_custom_fields`
--

CREATE TABLE `student_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_custom_fields`
--

INSERT INTO `student_custom_fields` (`id`, `student_id`, `field_name`, `value`, `date_added`, `date_modified`) VALUES
(2, 15, 'aadhar_number', 'fadfsa', '2018-11-15 11:58:09', '0000-00-00 00:00:00'),
(3, 15, 'land_line', 'dsdasdsad', '2018-11-15 11:58:09', '0000-00-00 00:00:00'),
(4, 6, 'aadhar_number', 'asdasd1', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(5, 6, 'land_line', 'sadasd2', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(6, 6, 'aadhar_number_1', 'sadsad3', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(7, 6, 'land_line_1', 'asdsad6', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(8, 6, 'aadhar_number_2', 'adsadsad5', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(9, 6, 'aadhar_number_1_2', 'asdsad4', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(10, 6, 'land_line_2', 'sadsad7', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(11, 16, 'aadhar_number', '', '2018-11-22 05:05:49', '0000-00-00 00:00:00'),
(12, 16, 'land_line', '22222', '2018-11-22 05:05:49', '0000-00-00 00:00:00'),
(13, 17, 'aadhar_number', '', '2018-11-22 06:14:37', '0000-00-00 00:00:00'),
(14, 17, 'land_line', '56556455654', '2018-11-22 06:14:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_to_class_assignment`
--

CREATE TABLE `student_to_class_assignment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `academic_id` bigint(20) NOT NULL,
  `status` enum('Inprogress','Passed','Failed','Alumini','') NOT NULL DEFAULT 'Inprogress',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_to_class_assignment`
--

INSERT INTO `student_to_class_assignment` (`id`, `student_id`, `class_id`, `academic_id`, `status`, `date_added`, `date_modified`) VALUES
(1, 1, 1, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(2, 2, 6, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-30 13:10:17'),
(3, 3, 2, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(4, 4, 3, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(5, 5, 3, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(6, 6, 4, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(7, 2, 1, 2, 'Inprogress', '2018-10-29 10:53:56', '2018-10-30 13:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_to_parent_assignment`
--

CREATE TABLE `student_to_parent_assignment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_to_parent_assignment`
--

INSERT INTO `student_to_parent_assignment` (`id`, `student_id`, `parent_id`, `date_added`, `date_modified`) VALUES
(1, 1, 1, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(2, 2, 6, '2018-10-29 10:53:56', '2018-10-30 13:10:17'),
(3, 3, 2, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(4, 4, 3, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(5, 5, 3, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(6, 6, 4, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(7, 1, 2, '2018-10-29 10:53:56', '2018-11-12 13:04:23'),
(24, 16, 8, '2018-11-22 05:09:27', '2018-11-22 05:09:27'),
(23, 7, 3, '2018-11-21 12:17:37', '2018-11-21 12:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('Active','Deactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Mathematcals', 'Maths', 'Active', '2018-11-21 06:02:44', '2018-11-21 06:02:44'),
(2, 'Social Science', 'Social', 'Active', '2018-11-21 06:02:44', '2018-11-21 06:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_key` varchar(512) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `pincode` varchar(7) NOT NULL,
  `gender` enum('Male','Female','Others','') NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `position` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `grade` varchar(40) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `experience_details` text NOT NULL,
  `blood_group` varchar(40) NOT NULL,
  `home_phone` varchar(40) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Suspended','Terminated','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `first_name`, `last_name`, `mobile`, `email`, `password`, `access_key`, `photo`, `dob`, `doj`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `gender`, `department_id`, `class_id`, `position`, `category_id`, `grade`, `qualification`, `experience`, `experience_details`, `blood_group`, `home_phone`, `emergency_contact`, `created_by`, `status`, `date_added`, `date_modified`) VALUES
(1, 'TEA01', 'Rajakumar', 'Anbalagan', '9092310791', 'rjkumar856@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', 'key_5bf6a385ed5d3udeltzkav', '', '1990-10-24', '2018-10-24', 'G202 SRK Silicana, E-City', 1, 1, 1, '656566', 'Male', 1, '1,2', 'Asst. Lecturer', 1, 'A', 'BE', '4 year(s) and 3 month(s)', 'Research Interests in irradiation accelerated corrosion for current and future accident tolerant fuel cladding materials in Light Water Reactors (LWR). His recent research developed a novel methods for testing high performance corrosion resistant materials in LWR environment using state-of-the-art in-situ proton irradiation-corrosion testing system.', 'O+', '66767567567', '676576576', 1, 'Deactive', '2018-10-24 06:25:31', '2018-11-26 06:14:54'),
(2, 'TEA02', 'Sabarish', 'R', '9092310792', 'rjkumar857@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', 'key_5bf6a385ed5d3udeltzkav', '', '1990-11-21', '2018-10-24', 'G202 SRK Silicana, E-City1', 1, 1, 1, '535677', 'Male', 2, '2', 'Seni. Lecturer', 1, 'B', 'ME', '5 year(s) and 4 month(s)', 'Research Interests in irradiation accelerated corrosion for current and future accident tolerant fuel cladding materials in Light Water Reactors (LWR). His recent research developed a novel methods for testing high performance corrosion resistant materials in LWR environment using state-of-the-art in-situ proton irradiation-corrosion testing system.', 'A+', '567567', '56756', 1, 'Terminated', '2018-10-24 06:25:31', '2018-11-26 06:14:35'),
(3, 'TEA03', 'Ashutosh', 'A', '9092310793', 'rjkumar858@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', 'key_5bf6a385ed5d3udeltzkav', '', '1990-11-21', '2018-10-24', 'G202 SRK Silicana, E-City1', 1, 1, 1, '666775', 'Male', 3, '3', 'Seni. Lecturer', 1, 'C', 'MSC,M.Phil,Phd', '6 year(s) and 5 month(s)', 'Research Interests in irradiation accelerated corrosion for current and future accident tolerant fuel cladding materials in Light Water Reactors (LWR). His recent research developed a novel methods for testing high performance corrosion resistant materials in LWR environment using state-of-the-art in-situ proton irradiation-corrosion testing system.', 'B-', '56756765', '567567', 1, 'Active', '2018-10-24 06:25:31', '2018-11-26 06:14:36'),
(6, 'TEC13', 'Kumar', 'Silwat', '9090945345', 'rerewr@sdfsdf.cvvc', 'ygiuarEO0XkHjUnzA33MCDvERCaVyf/CSiR/noVZwbxfZP/IpgdAAGGooDzlpA9zI6/1NQuW7ZQFKRF2a9+C1Q==', 'key_5bf6a385ed5d3udeltzkav', '', '2016-08-02', '2018-11-22', 'sadas sdaasdas', 1, 1, 1, '454534', 'Male', 1, '3', '', 0, '', 'ME-CSE', '4.9 Years', 'dfdas', 'AB-', '656456', '456546', 1, 'Active', '2018-11-22 12:39:33', '2018-11-26 11:22:51'),
(7, 'TEC15', 'asdadsa', 'sdaasd', '9076565367', 'sadsad@dsfsd.gf', '/WI2D/3weQ8RcQKwPtAMxiAt3Jj2xEHGIONMAkF6eD7ANBTFLZlxVC5hw0RFo5FDkvxV3lURDZi2acrMoB36vg==', 'key_5bf7b4f74ee6c0j2frab7l', '', '2017-11-17', '2018-11-23', 'sadsad sadsad', 1, 1, 1, '676579', 'Male', 1, '3', 'asdsad', 1, 'sadsadsa', 'sadsa', 'sadsad', 'sadsad', 'A+', 'dsadsad', 'sadsadsad', 1, 'Active', '2018-11-23 08:06:15', '2018-11-28 08:25:44'),
(8, 'TEC16', 'asdsad', 'asdsad', '9090965432', 'sadsadsa@dfdf.hgh', 'Hg1gfdq71fJqmlLmk+m3rSWCvChquEjrgqhi+H01jsnWSF6s4DiPRiZ/Jhy2vfhze5I1iC1/zUQ1fYfaYEBnbQ==', 'key_5bf7b7faeb1beepptvz0bn', 'tec16.png', '2016-10-06', '2018-11-23', 'asdsa Address', 1, 1, 1, '566633', 'Female', 2, '2', 'asdsadsa', 2, 'dfasdsad', 'sadsad', 'asdsad sadsad', 'sadf dfdafdf dfdsf', 'AB+', '454545435', '44545343', 1, 'Active', '2018-11-23 08:19:06', '2018-11-26 06:14:42'),
(9, 'TEC17', 'fdgfdgdfg', 'dfgdf', '9092311791', 'rjkumar826@gmail.com', 'pjBBZvG1STLpfkvJc8mgg36doAo+7eYzGtrX2NRz41q+op91HU6FTPqUd3DymfxXZ/ZU3rhRlN27fpN/sJUqRQ==', 'key_5bf7c6522ba4f9ln1zsjkv', 'tec17.jpg', '2016-09-07', '2018-11-23', 'sdfsdf dfsadasdas', 1, 1, 1, '456456', 'Others', 3, '1', 'fdgdfg', 2, 'dfgdfg', 'gdfg', 'dfgdfgdfg', 'dfgdfg', 'AB+', '43543534', '54534534', 1, 'Active', '2018-11-23 09:20:18', '2018-11-26 06:14:44'),
(12, 'TEC18', 'Senthil', 'Kumar', '5654456533', 'fgfgetret3454@fgfgr.hjj', '3ZFQfFO8r9KELW6W52ujFkfwB5HC5R+/XpIMDb3TomArfbg4JD1uEGHj2fyr7dZWYUR1e9av8VbvQwgOjRg2Sg==', 'key_5bfbc80e33728avuwihkpp', 'tec1833.jpg', '2017-03-08', '2018-11-26', '454fd565frtter 5465', 2, 2, 1, '565445', 'Female', 2, '5,6', 'dfsdfsdf', 2, '56757ytg5466', 'BE-ME', '4.6years', 'asdsad asdasdsa asdasdsad sadsadsad', 'A-', '5676545645', '45654645', 1, 'Active', '2018-11-26 10:16:46', '2018-11-26 12:09:51'),
(13, 'TEC19', 'fdgdfg', 'gsdfg', '7567567709', 'sdfdsfsdf@dfgfdg.bnnbvn', 'cIlxYdlpHhKyR3TaWtGjLuqCwyYH3RG0w91WsyfY/Kh0Twlh9Z52KUUgm57/QRo5nUILVIn5EbGtQNPArxRlWA==', 'key_5bfbce25c2c28sjze0vw8x', '', '2017-01-03', '2018-11-26', 'sdfsdf fgsdfsd', 1, 1, 1, '785678', 'Male', 2, '3,4', 'dfsdfsdf', 2, 'sdfsdf', 'fsdfsdf', 'sdfsdfs', 'sdfsdfsdf', 'B-', '67567', '56756756', 1, 'Active', '2018-11-26 10:42:45', '2018-11-26 12:09:46'),
(14, 'TEC20', 'asdsadsad9', 'dfdsf8', '9090965323', 'sdfsdfsd@fgfgsd.fgg', '3MOUalMnAyAR2R6Sve69hW29014/F5gBDhAs5rs8cqycJZm4xLozEIFcRS6COKRLUBZgN6Sn78evgfT6U9qyww==', 'key_5bfbe268d1c23mocrhaafl', 'tec201.png', '2016-09-07', '2018-11-26', 'sdfsdfsd dsfsdfsd12', 1, 1, 1, '546456', 'Male', 3, '2', 'sdfsd6', 2, 'fsdfsd7', 'sdfsd2', 'fsdfsdf3', 'sdfsdf4', '', '1234567813', '9876543214', 1, 'Active', '2018-11-26 12:09:12', '2018-11-28 09:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_documents`
--

CREATE TABLE `teachers_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` enum('Approved','Disapproved','Rejected','Waiting','') NOT NULL DEFAULT 'Waiting',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers_documents`
--

INSERT INTO `teachers_documents` (`id`, `teacher_id`, `doc_name`, `url`, `status`, `date_added`, `date_modified`) VALUES
(1, 1, 'Aadhar Card', '1.jpg', 'Disapproved', '2018-10-30 07:55:41', '2018-11-21 10:13:25'),
(2, 2, '12th Marksheet', '2.pdf', 'Waiting', '2018-10-30 07:55:41', '2018-11-21 10:13:28'),
(5, 1, '10th Marksheet', '3.doc', 'Approved', '2018-11-14 07:33:32', '2018-11-21 10:13:30'),
(6, 2, 'TC', '4.png', 'Approved', '2018-11-14 07:33:32', '2018-11-21 10:13:35'),
(11, 14, 'sdfsdfsd', '15_sdfsdfsd_1542356683.jpg', 'Approved', '2018-11-16 08:24:43', '2018-11-28 03:53:12'),
(12, 14, 'sdfsd dsfsdfsdf36', '15_sdfsd-dsfsdfsdf_1542356984.png', 'Approved', '2018-11-16 08:29:44', '2018-11-28 05:42:55'),
(13, 14, 'Rajkumar123', '14_rajkumar_1543382352.png', 'Disapproved', '2018-11-28 05:19:12', '2018-11-28 05:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendance`
--

CREATE TABLE `teacher_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `att_date` date NOT NULL DEFAULT '0000-00-00',
  `attendance` enum('Present','Absent','Half Day','') NOT NULL DEFAULT 'Present',
  `reason` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_attendance`
--

INSERT INTO `teacher_attendance` (`id`, `teacher_id`, `att_date`, `attendance`, `reason`, `date_added`, `date_modified`) VALUES
(1, 1, '2018-10-24', 'Present', '', '2018-10-24 10:06:06', '2018-10-24 10:55:33'),
(2, 2, '2018-10-25', 'Absent', '', '2018-10-24 10:06:06', '2018-10-24 12:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_category`
--

CREATE TABLE `teacher_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_category`
--

INSERT INTO `teacher_category` (`id`, `name`, `status`, `date_added`, `date_modified`) VALUES
(1, 'General', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58'),
(2, 'Free Education', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_custom_fields`
--

CREATE TABLE `teacher_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_custom_fields`
--

INSERT INTO `teacher_custom_fields` (`id`, `teacher_id`, `field_name`, `value`, `date_added`, `date_modified`) VALUES
(2, 1, 'aadhar_number', 'fadfsa', '2018-11-21 10:10:52', '0000-00-00 00:00:00'),
(3, 1, 'land_line', 'dsdasdsad', '2018-11-21 10:10:58', '0000-00-00 00:00:00'),
(4, 2, 'aadhar_number', 'asdasd1', '2018-11-21 10:11:03', '0000-00-00 00:00:00'),
(5, 2, 'land_line', 'sadasd2', '2018-11-21 10:11:06', '0000-00-00 00:00:00'),
(6, 6, 'aadhar_number_1', 'sadsad3', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(7, 6, 'land_line_1', 'asdsad6', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(8, 6, 'aadhar_number_2', 'adsadsad5', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(9, 6, 'aadhar_number_1_2', 'asdsad4', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(10, 6, 'land_line_2', 'sadsad7', '2018-11-20 11:19:32', '0000-00-00 00:00:00'),
(11, 6, 'aadhar_number', '234324', '2018-11-22 12:39:34', '0000-00-00 00:00:00'),
(12, 6, 'land_line', '452345234', '2018-11-22 12:39:34', '0000-00-00 00:00:00'),
(13, 7, 'aadhar_number', 'sadsa', '2018-11-23 08:06:15', '0000-00-00 00:00:00'),
(14, 7, 'land_line', 'sadsad', '2018-11-23 08:06:15', '0000-00-00 00:00:00'),
(15, 8, 'aadhar_number', 'asdsad', '2018-11-23 08:19:06', '0000-00-00 00:00:00'),
(16, 8, 'land_line', 'asdsad', '2018-11-23 08:19:06', '0000-00-00 00:00:00'),
(17, 10, 'aadhar_number', 'sdfsdf', '2018-11-23 10:13:29', '0000-00-00 00:00:00'),
(18, 10, 'land_line', 'sdfsdfs', '2018-11-23 10:13:29', '0000-00-00 00:00:00'),
(19, 11, 'aadhar_number', 'sdfsdf', '2018-11-23 10:12:35', '0000-00-00 00:00:00'),
(20, 11, 'land_line', 'sdfsdfs', '2018-11-23 10:12:35', '0000-00-00 00:00:00'),
(21, 12, 'aadhar_number', '676345345', '2018-11-26 10:16:46', '0000-00-00 00:00:00'),
(22, 12, 'land_line', '345345345', '2018-11-26 10:16:46', '0000-00-00 00:00:00'),
(23, 13, 'aadhar_number', 'hjgh', '2018-11-26 10:42:45', '0000-00-00 00:00:00'),
(24, 13, 'land_line', 'fghfghfg', '2018-11-26 10:42:45', '0000-00-00 00:00:00'),
(25, 14, 'aadhar_number', 'sdfds10', '2018-11-27 12:28:33', '0000-00-00 00:00:00'),
(26, 14, 'land_line', 'sdfsdf11', '2018-11-27 12:28:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_details`
--

CREATE TABLE `teacher_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `marital_status` enum('Married','Unmarried','Divorced','Widow','') NOT NULL DEFAULT 'Unmarried',
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL DEFAULT 'No',
  `is_handicapped` enum('Yes','No','') NOT NULL DEFAULT 'No',
  `handicap_details` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_details`
--

INSERT INTO `teacher_details` (`id`, `teacher_id`, `job_title`, `marital_status`, `father_name`, `mother_name`, `spouse_name`, `nationality`, `is_handicapped`, `handicap_details`, `date_added`, `date_modified`) VALUES
(1, 1, 'Salem-TN', 'Unmarried', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'No', 'Nil', '2018-10-31 08:00:44', '2018-11-21 05:40:33'),
(2, 2, 'Salem-TN', 'Unmarried', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'No', 'Nil', '2018-10-31 08:00:44', '2018-11-21 05:40:35'),
(3, 3, 'Salem-TN', 'Divorced', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'No', 'Nil', '2018-10-31 08:00:44', '2018-11-23 08:16:55'),
(6, 6, 'Salem', 'Divorced', 'Tamil,Telugu,English6', 'Hindu6', '1', 'Yes', 'No', 'Nil6', '2018-10-31 08:00:44', '2018-11-23 08:16:59'),
(9, 9, 'SAlem', '', 'Tamil,English', 'No', '1', 'No', 'No', '', '2018-11-12 07:12:41', '2018-11-12 07:12:41'),
(16, 7, 'asdsad', 'Married', 'sadsa', 'sadsad', 'sadsa', 'sadsad', 'No', 'sadsa', '2018-11-23 08:06:15', '2018-11-23 08:06:15'),
(17, 8, 'asdsadsab', 'Divorced', 'asdsadsa sadsad', 'asdsadas sdsa', 'asdsad adsad', 'asdasdsad sadsa', 'Yes', 'asdas sad sad', '2018-11-23 08:19:06', '2018-11-23 08:19:06'),
(26, 12, 'cxvxc developer', 'Unmarried', 'sadsadstyuyt', 'sadsadiwerewr', 'sadsakjkjhkl', 'dsadsadsa sadsadsa', 'No', '', '2018-11-26 10:16:46', '2018-11-26 10:16:46'),
(27, 13, 'sdfsdfsd', 'Unmarried', 'sdfsd', 'fsdfsdf', 'sdfsdfsd', 'sdfsdf', 'Yes', 'sdfsdf', '2018-11-26 10:42:45', '2018-11-26 10:42:45'),
(28, 14, 'sdfsdf1', '', 'fsdf2', 'sdfsdf3', 'sdfsd4', 'sdfsd5', 'No', 'sdfsd1', '2018-11-26 12:09:12', '2018-11-27 12:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_grade`
--

CREATE TABLE `teacher_grade` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_grade`
--

INSERT INTO `teacher_grade` (`id`, `name`, `status`, `date_added`, `date_modified`) VALUES
(1, 'General', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58'),
(2, 'Free Education', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `ze_city`
--

CREATE TABLE `ze_city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ze_city`
--

INSERT INTO `ze_city` (`id`, `name`, `state_id`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Bangalore', 1, 'Active', '2018-10-31 09:31:21', '2018-10-31 09:31:21'),
(2, 'Chennai', 2, 'Active', '2018-10-31 09:31:21', '2018-10-31 09:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `ze_country`
--

CREATE TABLE `ze_country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ze_country`
--

INSERT INTO `ze_country` (`id`, `name`, `status`, `date_added`, `date_modified`) VALUES
(1, 'India', 'Active', '2018-10-31 09:22:13', '2018-10-31 09:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `ze_state`
--

CREATE TABLE `ze_state` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ze_state`
--

INSERT INTO `ze_state` (`id`, `name`, `country_id`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Karnataka', 1, 'Active', '2018-10-31 09:31:59', '2018-10-31 09:31:59'),
(2, 'Tamil Nadu', 1, 'Active', '2018-10-31 09:31:59', '2018-10-31 09:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`roll_number`);

--
-- Indexes for table `students_details`
--
ALTER TABLE `students_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_documents`
--
ALTER TABLE `students_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_previous_qualification`
--
ALTER TABLE `students_previous_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stu_id` (`stu_id`);

--
-- Indexes for table `student_category`
--
ALTER TABLE `student_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_custom_fields`
--
ALTER TABLE `student_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_to_class_assignment`
--
ALTER TABLE `student_to_class_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_to_parent_assignment`
--
ALTER TABLE `student_to_parent_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teachers_documents`
--
ALTER TABLE `teachers_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stu_id` (`teacher_id`);

--
-- Indexes for table `teacher_category`
--
ALTER TABLE `teacher_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_custom_fields`
--
ALTER TABLE `teacher_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_details`
--
ALTER TABLE `teacher_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher_grade`
--
ALTER TABLE `teacher_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ze_city`
--
ALTER TABLE `ze_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ze_country`
--
ALTER TABLE `ze_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ze_state`
--
ALTER TABLE `ze_state`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students_details`
--
ALTER TABLE `students_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students_documents`
--
ALTER TABLE `students_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students_previous_qualification`
--
ALTER TABLE `students_previous_qualification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_category`
--
ALTER TABLE `student_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_custom_fields`
--
ALTER TABLE `student_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_to_class_assignment`
--
ALTER TABLE `student_to_class_assignment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_to_parent_assignment`
--
ALTER TABLE `student_to_parent_assignment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teachers_documents`
--
ALTER TABLE `teachers_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_category`
--
ALTER TABLE `teacher_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_custom_fields`
--
ALTER TABLE `teacher_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `teacher_details`
--
ALTER TABLE `teacher_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teacher_grade`
--
ALTER TABLE `teacher_grade`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ze_city`
--
ALTER TABLE `ze_city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ze_country`
--
ALTER TABLE `ze_country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ze_state`
--
ALTER TABLE `ze_state`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
