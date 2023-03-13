<?php
// echo 1;
// $route['default_controller'] = 'Authenticate/login';
// $route['signup'] = 'Authenticate/signup';
// $route['translate_uri_dashes'] = FALSE;
$route['insert'] = 'Authenticate/signupData';
$route['search'] = 'Authenticate/loginData';
$route['message'] = 'SendController/index';
// $route['logout'] = 'Message/logout';
$route['send'] = 'SendController/send';
$route['get_message'] = 'SendController/getMessage';
$route['alluser'] = 'SendController/alluser';
$route['get_user_mess'] = 'SendController/get_user_mess';
$route['getBlockUserData'] = 'SendController/getBlockUserData';
$route['blockUser'] = 'SendController/blockUser';
$route['unblockUser'] = 'SendController/unblockUser';
