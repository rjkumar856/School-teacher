<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'errors';
$route['translate_uri_dashes'] = FALSE;
//STUDENTS
$route['view-students'] = "students/view_students";
$route['view-student'] = "students/view_students";
$route['add-student'] = "students/add_student";
$route['student-customs-settings'] = "students/customs_settings";
$route['add-student-submission'] = "students/add_student_submission";
$route['edit-student/(:any)'] = "students/edit_student/$1";
$route['edit-student/parent/(:any)'] = "students/edit_student_parent/$1";
$route['edit-student/previous/(:any)'] = "students/edit_student_previous/$1";
$route['edit-student/doc/(:any)'] = "students/edit_student_doc/$1";
$route['manage-parents'] = "students/manage_parents";
$route['view-student/(:any)'] = "students/view_student/$1";
$route['view-parent/(:any)'] = "students/view_parent/$1";
$route['edit-parent/(:any)'] = "students/edit_parent/$1";
//TEACHER
$route['view-teachers'] = "teacher/view_teachers";
$route['view-teacher'] = "teacher/view_teachers";
$route['view-teacher/(:any)'] = "teacher/view_teacher/$1";
$route['add-teacher'] = "teacher/add_teacher";
$route['edit-teacher/(:any)'] = "teacher/edit_teacher/$1";
$route['edit-teacher/doc/(:any)'] = "teacher/edit_teacher_doc/$1";
$route['teacher-customs-settings'] = "teacher/customs_settings";
$route['manage-department'] = "teacher/manage_department";

//LOGIN
$route['user_login'] = "login/login_submission";
$route['user_update'] = "login/user_update";
$route['user_forgot_password'] = "login/forgot_password";
$route['logout'] = "login/logout";

//API
$route['api/get_all_student'] = "api/get_all_student";
$route['api/get_student'] = "api/get_student";
$route['api/get_student_pagination'] = "api/get_student_pagination";
$route['api/get_parents_list'] = "api/get_parents_list";
$route['api/get_parent_pagination'] = "api/get_parent_pagination";
$route['api/update_student_status'] = "api/update_student_status";
$route['api/delete_student'] = "api/delete_student";
$route['api/get_states_by_country'] = "api/get_states_by_country";
$route['api/get_cities_by_state'] = "api/get_cities_by_state";
$route['api/add-student'] = "api/add_student";
$route['api/update-student'] = "api/update_student";
$route['api/add-student-document'] = "api/add_student_document";
$route['api/add-student-previous'] = "api/add_student_previous";
$route['api/update-student-previous'] = "api/update_student_previous";
$route['api/update-student-document'] = "api/update_student_document";
$route['api/update-student-document-status-approved'] = "api/update_student_document_status_approved";
$route['api/update-student-document-status-disapproved'] = "api/update_student_document_status_disapproved";
$route['api/add-parent'] = "api/add_parent";
$route['api/update-parent'] = "api/update_parent";
$route['api/delete_parent'] = "api/delete_parent";
$route['api/get-parent-from-student'] = "api/get_parent_from_student";
$route['api/assign-parent'] = "api/assign_parent";
$route['api/get_parents_details'] = "api/get_parents_details";
$route['api/delete_asssigned_id'] = "api/delete_asssigned_id";
$route['api/delete_previous_id'] = "api/delete_previous_id";
$route['api/delete_document_id'] = "api/delete_document_id";
$route['api/delete_student_photo'] = "api/delete_student_photo";
$route['api/update_student_custom_settings'] = "api/update_student_custom_settings";
$route['api/add_student_custom_fields'] = "api/add_student_custom_fields";
$route['api/update_student_custom_fields'] = "api/update_student_custom_fields";
$route['api/delete_student_custom_fields'] = "api/delete_student_custom_fields";
$route['api/add_student_category'] = "api/add_student_category";
$route['api/update_student_category'] = "api/update_student_category";
$route['api/delete_student_category'] = "api/delete_student_category";
//TEACHER
$route['api/get_teacher_list'] = "api_teacher/get_teacher_list";
$route['api/get_teacher_pagination'] = "api_teacher/get_teacher_pagination";
$route['api/update_teacher_status'] = "api_teacher/update_teacher_status";
$route['api/delete_teacher'] = "api_teacher/delete_teacher";
$route['api/add-teacher'] = "api_teacher/add_teacher";
$route['api/delete_teacher_photo'] = "api_teacher/delete_teacher_photo";
$route['api/update-teacher'] = "api_teacher/update_teacher";
$route['api/add-teacher-document'] = "api_teacher/add_teacher_document";
$route['api/update-teacher-document'] = "api_teacher/update_teacher_document";
$route['api/update-teacher-document-status-approved'] = "api_teacher/update_teacher_document_status_approved";
$route['api/update-teacher-document-status-disapproved'] = "api_teacher/update_teacher_document_status_disapproved";
$route['api/delete_teacher_document'] = "api_teacher/delete_teacher_document";
$route['api/update_teacher_custom_settings'] = "api_teacher/update_teacher_custom_settings";
$route['api/add_teacher_custom_fields'] = "api_teacher/add_teacher_custom_fields";
$route['api/update_teacher_custom_fields'] = "api_teacher/update_teacher_custom_fields";
$route['api/delete_teacher_custom_fields'] = "api_teacher/delete_teacher_custom_fields";
$route['api/add_teacher_category'] = "api_teacher/add_teacher_category";
$route['api/update_teacher_category'] = "api_teacher/update_teacher_category";
$route['api/delete_teacher_category'] = "api_teacher/delete_teacher_category";
$route['api/add_teacher_department'] = "api_teacher/add_teacher_department";
$route['api/update_teacher_department'] = "api_teacher/update_teacher_department";
$route['api/delete_teacher_department'] = "api_teacher/delete_teacher_department";


$route['api/(:any)'] = "api/not_found";
