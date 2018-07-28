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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Client Site
 */
// Main
$route['about'] = 'main/about';
$route['terms'] = 'main/about';
$route['privacy'] = 'main/about';

// Sign in
$route['signin'] = 'users/signin';
$route['signup'] = 'users/signup';

// courses
$route['courses'] = 'courses/index';
$route['courses/(:any)'] = 'courses/content';

// Quest
$route['quest'] = 'quest/index';
$route['quest/(:any)'] = 'quest/content';
$route['quest/(:any)/upload'] = 'quest/upload';

// Account
$route['account'] = 'account/index';
$route['account/history'] = 'account/history';
$route['account/rewards'] = 'account/rewards';
$route['account/profile'] = 'account/profile';
$route['account/report'] = 'account/report';

// Notification
$route['notification'] = 'notification/index';

/**
 * Admin Site
 */
// Sign In & Sign Out
$route['admin'] = 'Admin/admin/index';
$route['admin/signin'] = 'Admin/admin/signin';
$route['admin/signout'] = 'Admin/admin/signout';

// Dashboard
$route['admin/dashboard'] = 'Admin/admin/dashboard';
$route['admin/courses'] = 'Admin/courses/index';
$route['admin/courses/edit/(:any)'] = 'Admin/courses/edit_course';
$route['admin/courses/path/(:any)'] = 'Admin/courses/path';
$route['admin/courses/path/edit/(:any)'] = 'Admin/courses/edit_path';
$route['admin/courses/path/lesson/(:any)'] = 'Admin/courses/lesson';
$route['admin/courses/path/lesson/edit/(:any)'] = 'Admin/courses/edit_lesson';
$route['admin/account'] = 'Admin/admin/account';
