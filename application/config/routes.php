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
$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['user'] = 'user/index';
$route['about_us'] = 'user/about_us';
$route['service'] = 'user/service';
$route['contact'] = 'user/contact';
$route['login'] = 'user/login';
$route['forgot_password'] = 'user/forgot_password';
$route['forgot_password_email'] = 'user/forgot_password_email';

$route['admin'] = 'admin/index';
$route['profiles'] = 'admin/profile';
$route['rates'] = 'admin/rates';
$route['charge'] = 'admin/charge';
$route['comissione_list'] = 'admin/comissione_list';
$route['resellers'] = 'admin/reseller';
$route['change_passwords'] = 'admin/change_password';
$route['logouts'] = 'user/logout';

$route['reseller'] = 'reseller/index';
$route['profile'] = 'reseller/profile';
$route['topup'] = 'reseller/topup';
$route['report'] = 'reseller/report';
$route['rate'] = 'reseller/rate';
$route['register'] = 'reseller/register';
$route['change_password'] = 'reseller/change_password';
$route['logout'] = 'reseller/logout';

$route['bangladesh_flexiload'] = 'reseller/bangladesh_flexiload';
$route['bangladesh_ewallet'] = 'reseller/bangladesh_ewallet';
$route['malaysia_topup'] = 'reseller/malaysia_topup';
$route['indonesia_topup'] = 'reseller/indonesia_topup';
$route['nepal_topup'] = 'reseller/nepal_topup';

$route['topup_success'] = 'reseller/topup_success';



