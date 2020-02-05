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
$route['default_controller'] 	= 'C_login';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

// ROUTE BUAT ADMIN
$route['add_user'] 				= 'C_meeting/add_user';
$route['user_add'] 				= 'C_meeting/user_add';
$route['user_edit'] 			= 'C_meeting/user_edit';
$route['delete_user'] 			= 'C_meeting/delete_user';
$route['add_schedule'] 			= 'C_meeting/add_schedule';
$route['menu_jabatan'] 			= 'C_meeting/menu_jabatan';
$route['data_member'] 			= 'C_meeting/data_member';
$route['status'] 				= 'C_meeting/status';
$route['data_schedule'] 		= 'C_meeting/data_schedule';
$route['absent'] 				= 'C_meeting/absent';
$route['meeting_result/:any'] 	= 'C_meeting/meeting_result';
$route['meeting_list'] 			= 'C_meeting/meeting_list';
$route['meeting_report'] 		= 'C_meeting/meeting_report';
$route['add_result'] 			= 'C_meeting/add_result';
$route['member_add'] 			= 'C_meeting/member_add';
$route['add_jabatan'] 			= 'C_meeting/add_jabatan';
$route['edit_jabatan'] 			= 'C_meeting/edit_jabatan';
$route['delete_jabatan'] 		= 'C_meeting/delete_jabatan';
$route['schedule_add']			= 'C_meeting/schedule_add';
$route['delete_schdeule'] 		= 'C_meeting/delete_schdeule';
$route['detail_schedule/:any'] 	= 'C_meeting/detail_schedule';
$route['list_user_member'] 		= 'C_meeting/list_user_member';
$route['add_absen'] 			= 'C_meeting/add_absen';
$route['konfirmasi_hadir'] 		= 'C_meeting/konfirmasi_hadir';
$route['absent_list/:any']  	= 'C_meeting/absent_list';
$route['dashboard'] 			= 'C_meeting/index';
$route['schedule_edit'] 		= 'C_meeting/schedule_edit';
$route['detailReport/:any'] 	= 'C_meeting/detailReport';
$route['menu_room'] 			= 'C_meeting/menu_room';
$route['add_room'] 				= 'C_meeting/add_room';
$route['edit_room'] 			= 'C_meeting/edit_room';
$route['delete_room'] 			= 'C_meeting/delete_room'; 

//ROUTE BUAT LOGIN
$route['login']  = 'C_login/aksi_login';
$route['logout'] = 'C_login/logout';


//ROUTE BUAT MEMBER
$route['hadir_meeting']   				= 'C_member/hadir_meeting';
$route['riwayat_meeting'] 				= 'C_member/riwayat_meeting';
$route['detailMeetingMember/:any'] 		= 'C_member/detail_meeting_member';
$route['invitationMeeting'] 			= 'C_member/list_undangan';

//ROUTE BUAT NOTULEN
$route['absent_list_notulen/:any']  	= 'C_meeting/absent_list_notulen';
$route['konfirmasi_hadir_notulen'] 		= 'C_meeting/konfirmasi_hadir_notulen';
$route['absen_schedule'] 				= 'C_meeting/absen_schedule';
$route['meeting_list_notulen'] 			= 'C_meeting/meeting_list_notulen';
$route['meeting_result_notulen/:any'] 	= 'C_meeting/meeting_result_notulen';
$route['add_result_notulen'] 			= 'C_meeting/add_result_notulen';
$route['meeting_report_notulen'] 		= 'C_meeting/meeting_report_notulen';
$route['detailReportnotulen/:any'] 		= 'C_meeting/detailReport_notulen';