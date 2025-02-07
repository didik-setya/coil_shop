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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'homepage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//route page homepage
$route['register'] = 'login/register';
$route['checkout'] = 'homepage/checkout';
$route['transaction_history'] = 'homepage/history';


//route ajax homepage
$route['show_detail_product']['POST'] = 'ajax/ajax_homepage/show_product';
$route['add_to_cart']['POST'] = 'ajax/ajax_homepage/add_cart';
$route['destroy_cart']['GET'] = 'ajax/ajax_homepage/destroy_cart';
$route['remove_cart']['POST'] = 'ajax/ajax_homepage/remove_cart';
$route['get_prov']['POST'] = 'ajax/ajax_homepage/get_api_prov';
$route['calculate_courir_cost']['POST'] = 'ajax/ajax_homepage/cost_courir';
$route['validation_checkout']['POST'] = 'ajax/ajax_homepage/validation_checkout';
$route['send_proof_payment']['POST'] = 'ajax/ajax_homepage/proof_payment';


//route page admin
$route['product'] = 'dashboard/product';
$route['web_settings'] = 'dashboard/web_settings';
$route['transaction'] = 'dashboard/transaction';
$route['users'] = 'dashboard/users';
$route['settings_admin'] = 'dashboard/settings';


//route product in admin
$route['verify_product']['POST'] = 'ajax/ajax_product/verify_product';
$route['action_product']['POST'] = 'ajax/ajax_product/form_action';
//route settings in admin
$route['change_settings']['POST'] = 'ajax/ajax_settings/update_settings';
//route transaction in admin
$route['load_data_transaction']['POST'] = 'ajax/ajax_transaction/load_data';
$route['edit_status_checkout']['POST'] = 'ajax/ajax_transaction/edit_status';
$route['detail_checkout']['POST'] = 'ajax/ajax_transaction/detail_checkout';
//route users in admin
$route['load_data_users']['POST'] = 'ajax/ajax_users/load_data';
//route settings account in admin
$route['edit_account_admin']['POST'] = 'ajax/ajax_account/edit_profile';
$route['validation_password']['POST'] = 'ajax/ajax_account/validation_password';



$route['verify_login_admin']['POST'] = 'auth/verify_login';