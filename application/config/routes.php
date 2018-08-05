<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['admin/auth_user'] = 'Admin/admin/auth_user';
$route['admin/signout'] = 'Admin/admin/signout';

// Dashboard
$route['admin/dashboard'] = 'Admin/admin/dashboard';
$route['admin/courses'] = 'Admin/courses/index';
$route['admin/courses/add'] = 'Admin/courses/add_course';
$route['admin/courses/save'] = 'Admin/courses/save_course';
$route['admin/courses/edit/(:any)'] = 'Admin/courses/edit_course';
$route['admin/courses/path/(:any)'] = 'Admin/courses/path';
$route['admin/courses/path/add/(:any)'] = 'Admin/courses/add_path';
$route['admin/courses/path/edit/(:any)'] = 'Admin/courses/edit_path';
$route['admin/courses/path/lesson/(:any)'] = 'Admin/courses/lesson';
$route['admin/courses/path/lesson/add/(:any)'] = 'Admin/courses/add_lesson';
$route['admin/courses/path/lesson/edit/(:any)'] = 'Admin/courses/edit_lesson';
$route['admin/quest'] = 'Admin/quest/index';
$route['admin/account'] = 'Admin/admin/account';
$route['admin/user'] = 'Admin/user/index';
$route['admin/user/add'] = 'Admin/user/addUser';
$route['admin/user/edit/(:any)'] = 'Admin/user/editUser';
//$route['admin/user/save'] = 'Admin/user/add_edit';