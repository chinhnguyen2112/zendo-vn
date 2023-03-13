<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Home/home';
$route['dang-nhap'] = 'Home/login';
// $route['dang-nhap-nguoi-mua'] = 'Home/login_user';
// $route['dang-nhap-nguoi-ban'] = 'Home/login_sell';
$route['dang-ky'] = 'Home/register';
$route['dang-ky-nguoi-mua'] = 'Home/register_user';
$route['dang-ky-nguoi-ban'] = 'Home/register_sell';
$route['xac-thuc-tai-khoan'] = 'Home/active_user';
//
$route['shop-lien-quan'] = 'Games/shoplienquan';
$route['shop-free-fire'] = 'Games/shopfreefire';
$route['shop-lien-minh-huyen-thoai'] = 'Games/shoplmht';
$route['shop-pubg-mobile'] = 'Games/shoppubg';
$route['shop-fifa-online'] = 'Games/shopfifa';
$route['shop-lien-minh-toc-chien'] = 'Games/shoplmtc';
$route['shop-dot-kich'] = 'Games/shopcf';
$route['shop-valorant'] = 'Games/shopvalorant';
$route['phan-mem-ban-quyen'] = 'Games/phanmembanquyen';
$route['game-ban-quyen'] = 'Games/gamebanquyen';
$route['nap-the'] = 'Service/nap_the';

$route['ve-so-may-man'] = 'Service/veso';
$route['vong-quay-lien-quan'] = 'Service/vongquaylienquan';
$route['the-game-garena'] = 'Service/ban_the';
$route['diem-danh-nhan-qua'] = 'Service/diem_danh';
$route['nhiem-vu-moi-ngay'] = 'Service/nv_hang_ngay';
$route['xsmb'] = 'Service/xsmb';

$route['blog'] = 'Blogs/blog';

$route['kho-do'] = 'Manager/kho_do';
$route['quan-ly-tai-khoan'] = 'Manager/quan_ly';
$route['lich-su-mua-hang'] = 'Manager/ls_mua_hang';
$route['gio-hang'] = 'Manager/gio_hang';

$route['dang-ban-acc'] = 'Ecommerce/dang_ban';
$route['dang-ban-acc-lien-quan'] = 'Ecommerce/lienquan';
$route['dang-ban-acc-pubg'] = 'Ecommerce/pubg';
$route['dang-ban-acc-cf'] = 'Ecommerce/cf';
$route['dang-ban-acc-lmht'] = 'Ecommerce/lmht';
$route['dang-ban-acc-fifa'] = 'Ecommerce/fifa';
$route['dang-ban-acc-freefire'] = 'Ecommerce/freefire';
$route['dang-ban-acc-tocchien'] = 'Ecommerce/tocchien';
$route['dang-ban-acc-valorant'] = 'Ecommerce/valorant';
$route['danh-sach-tai-khoan'] = 'Ecommerce/list_acc';
$route['danh-sach-tai-khoan/(:num)'] = 'Ecommerce/list_acc';

$route['tai-khoan-(:num)'] = 'Games/detail_account/$1';

$route['admin'] = 'Admin/admin';
$route['admin/his_acc'] = 'Admin/his_acc';
$route['admin/his_card'] = 'Admin/his_card';
$route['admin/member'] = 'Admin/member';
$route['admin/traffic'] = 'Admin/traffic';
$route['admin/add_traffic'] = 'Admin/add_traffic';
$route['admin/game_bq'] = 'Admin/game_bq';
$route['admin/add_game_bq'] = 'Admin/add_game_bq';
$route['admin/ve_so'] = 'Admin/ve_so';
$route['admin/post_lq'] = 'Admin/post_lq';
$route['admin/post_lmht'] = 'Admin/post_lmht';
$route['admin/post_fifa'] = 'Admin/post_fifa';
$route['admin/post_lmtc'] = 'Admin/post_lmtc';
$route['admin/post_freefire'] = 'Admin/post_freefire';
$route['admin/post_pubg'] = 'Admin/post_pubg';
$route['admin/post_cf'] = 'Admin/post_cf';
$route['admin/post_valorant'] = 'Admin/post_valorant';
$route['admin/post_lq_random'] = 'Admin/post_lq_random';
$route['admin/ds_acc'] = 'Admin/ds_acc';
$route['admin/ls_quay'] = 'Admin/ls_quay';
$route['admin/ds_gift'] = 'Admin/ds_gift';
$route['admin/add_gift'] = 'Admin/add_gift';
$route['admin/ds_blog'] = 'Admin/ds_blog';


//KOL
$route['danh-sach-idol'] = 'Home/list_kol';
$route['lich-su-choi'] = 'Home/his_playdoul';
$route['idol-(:num)'] = 'Home/detail_kol/$1';
// cộng đồng
$route['cong-dong'] = 'Home/community';

include('routes_chat.php');
include('routes_ajax.php');
$route['(:any)'] = 'Blogs/chuyenmuc';
