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

$route['root/kegiatan']['GET'] = 'KegiatanController/index';
$route['root/kegiatan/new']['GET'] = 'KegiatanController/newKegiatan';
$route['root/kegiatan']['POST'] = 'KegiatanController/tambahKegiatan';
$route['root/kegiatan/edit/(:num)']['GET'] = 'KegiatanController/editKegiatan/$1';
$route['root/kegiatan/update']['POST'] = 'KegiatanController/updateKegiatan';
$route['root/kegiatan/upload-editor']['POST'] = 'KegiatanController/uploadEditor';
$route['root/kegiatan/delete/(:num)']['GET'] = 'KegiatanController/hapusKegiatan/$1';

$route['kegiatan']['GET'] = 'KegiatanPublikController/index';
$route['kegiatan/(:num)']['GET'] = 'KegiatanPublikController/detail/$1';

$route['root/kepanitiaan']['GET'] = 'KepanitiaanController/index';
$route['root/kepanitiaan/new']['GET'] = 'KepanitiaanController/newKepanitiaan';
$route['root/kepanitiaan']['POST'] = 'KepanitiaanController/tambahKepanitiaan';
$route['root/kepanitiaan/edit/(:num)']['GET'] = 'KepanitiaanController/editKepanitiaan/$1';
$route['root/kepanitiaan/update']['POST'] = 'KepanitiaanController/updateKepanitiaan';
$route['root/kepanitiaan/delete/(:num)']['GET'] = 'KepanitiaanController/hapusKepanitiaan/$1';

$route['root/keuangan']['GET'] = 'KeuanganController/index';
$route['root/keuangan/new']['GET'] = 'KeuanganController/newKeuangan';
$route['root/keuangan']['POST'] = 'KeuanganController/tambahKeuangan';
$route['root/keuangan/edit/(:num)']['GET'] = 'KeuanganController/editKeuangan/$1';
$route['root/keuangan/update']['POST'] = 'KeuanganController/updateKeuangan';
$route['root/keuangan/delete/(:num)']['GET'] = 'KeuanganController/hapusKeuangan/$1';

$route['root/admin']['GET'] = 'AdminController/index';
$route['root/admin/new']['GET'] = 'AdminController/newAdmin';
$route['root/admin']['POST'] = 'AdminController/tambahAdmin';
$route['root/admin/edit/(:num)']['GET'] = 'AdminController/editAdmin/$1';
$route['root/admin/update']['POST'] = 'AdminController/updateAdmin';
$route['root/admin/delete/(:num)']['GET'] = 'AdminController/hapusAdmin/$1';

$route['login']['GET'] = 'AuthController/login';
$route['login']['POST'] = 'AuthController/authenticate';
$route['logout']['GET'] = 'AuthController/logout';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
