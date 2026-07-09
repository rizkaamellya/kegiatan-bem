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

$route['kegiatan']['GET'] = 'KegiatanController/index';
$route['kegiatan/new']['GET'] = 'KegiatanController/newKegiatan';
$route['kegiatan']['POST'] = 'KegiatanController/tambahKegiatan';
$route['kegiatan/edit/(:num)']['GET'] = 'KegiatanController/editKegiatan/$1';
$route['kegiatan/update']['POST'] = 'KegiatanController/updateKegiatan';
$route['kegiatan/delete/(:num)']['GET'] = 'KegiatanController/hapusKegiatan/$1';

$route['kepanitiaan']['GET'] = 'KepanitiaanController/index';
$route['kepanitiaan/new']['GET'] = 'KepanitiaanController/newKepanitiaan';
$route['kepanitiaan']['POST'] = 'KepanitiaanController/tambahKepanitiaan';
$route['kepanitiaan/edit/(:num)']['GET'] = 'KepanitiaanController/editKepanitiaan/$1';
$route['kepanitiaan/update']['POST'] = 'KepanitiaanController/updateKepanitiaan';
$route['kepanitiaan/delete/(:num)']['GET'] = 'KepanitiaanController/hapusKepanitiaan/$1';

$route['keuangan']['GET'] = 'KeuanganController/index';
$route['keuangan/new']['GET'] = 'KeuanganController/newKeuangan';
$route['keuangan']['POST'] = 'KeuanganController/tambahKeuangan';
$route['keuangan/edit/(:num)']['GET'] = 'KeuanganController/editKeuangan/$1';
$route['keuangan/update']['POST'] = 'KeuanganController/updateKeuangan';
$route['keuangan/delete/(:num)']['GET'] = 'KeuanganController/hapusKeuangan/$1';

$route['admin']['GET'] = 'AdminController/index';
$route['admin/new']['GET'] = 'AdminController/newAdmin';
$route['admin']['POST'] = 'AdminController/tambahAdmin';
$route['admin/edit/(:num)']['GET'] = 'AdminController/editAdmin/$1';
$route['admin/update']['POST'] = 'AdminController/updateAdmin';
$route['admin/delete/(:num)']['GET'] = 'AdminController/hapusAdmin/$1';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
