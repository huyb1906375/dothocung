<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'trangchu/index';
$route['trang-chu.html'] = 'trangchu/index';

$route['bat-dong-san/(:any)'] = 'batdongsan/detail/$1';
$route['loai-bat-dong-san/(:any)'] = 'batdongsan/index/$1';
$route['loai-bat-dong-san/(:any)/page/(:num)'] ='batdongsan/index/$1/$2';
$route['loai-bat-dong-san/(:any)/(:any)'] = 'batdongsan/index/$1/$2';

$route['tin-tuc/(:any)'] = 'tintuc/detail/$1';
$route['chuyen-muc/(:any)'] = 'tintuc/index/$1';
$route['chuyen-muc/(:any)/page/(:num)'] ='tintuc/index/$1/$2';
$route['chuyen-muc/(:any)/(:any)'] = 'tintuc/index/$1/$2';
$route['tim-kiem-tin.html'] = 'tintuc/search';

$route['video/(:any)'] = 'video/detail/$1';
$route['chuyen-muc-video/(:any)'] = 'video/index/$1';
$route['chuyen-muc-video/(:any)/page/(:num)'] ='video/index/$1/$2';
$route['chuyen-muc-video/(:any)/(:any)'] = 'video/index/$1/$2';
$route['tim-kiem-video.html'] = 'video/search';






$route['san-pham/(:any)'] = 'sanpham/detail/$1';
$route['danh-muc/(:any)'] = 'sanpham/index/$1';
$route['danh-muc/(:any)/page/(:num)'] ='sanpham/index/$1/$2';
$route['danh-muc/(:any)/(:any)'] = 'sanpham/index/$1/$2';
$route['tim-kiem-san-pham'] = 'sanpham/search';
$route['tim-kiem-san-pham/page/(:num)'] ='sanpham/search/$1';
$route['dang-nhap.html'] = 'auth/index';
$route['dang-ky.html'] = 'user/dangky';
$route['doi-mat-khau.html'] = 'user/doimatkhau';
$route['quen-mat-khau.html'] = 'auth/lay_mat_khau';
$route['dat-lai-mat-khau/(:any)'] = 'auth/dat_lai_mat_khau/$1';
$route['dang-tin.html'] = 'user/dangtin';
$route['thong-tin.html'] = 'user/index';
$route['gio-hang.html'] = 'cart/index';
$route['thanh-toan.html'] = 'cart/checkout';
$route['don-hang.html'] = 'cart/orderlist';
$route['don-hang/(:any).html'] = 'cart/orderdetail/$1';
$route['in-don-hang/(:any).html'] = 'cart/orderprint/$1';
$route['tra-cuu-don-hang.html'] = 'cart/ordersearch';
$route['tra-cuu-bao-hanh.html'] = 'baohanh/index';
$route['lien-he.html'] = 'lienhe/index';
$route['thanh-toan-truc-tuyen.html'] = 'vnpay/index';
$route['admin'] = 'admin/home';
$route['(:any)'] = 'trangdon/index';




$route['admin/lienket'] ='admin/lienket';
$route['admin/lienket/(:num)'] ='admin/lienket/index/$1';
$route['admin/lienket/page/(:num)'] ='admin/lienket/index/$1';

$route['admin/baiviet'] ='admin/baiviet';
$route['admin/baiviet/(:num)'] ='admin/baiviet/index/$1';
$route['admin/baiviet/page/(:num)'] ='admin/baiviet/index/$1';

$route['admin/video'] ='admin/video';
$route['admin/video/(:num)'] ='admin/video/index/$1';
$route['admin/video/page/(:num)'] ='admin/video/index/$1';

$route['admin/sanpham'] ='admin/sanpham';
$route['admin/sanpham/(:num)'] ='admin/sanpham/index/$1';
$route['admin/sanpham/page/(:num)'] ='admin/sanpham/index/$1';

$route['admin/batdongsan'] ='admin/batdongsan';
$route['admin/batdongsan/(:num)'] ='admin/batdongsan/index/$1';
$route['admin/batdongsan/page/(:num)'] ='admin/batdongsan/index/$1';

$route['admin/tinhthanh'] ='admin/tinhthanh';
$route['admin/tinhthanh/(:num)'] ='admin/tinhthanh/index/$1';
$route['admin/tinhthanh/page/(:num)'] ='admin/tinhthanh/index/$1';

$route['admin/quanhuyen'] ='admin/quanhuyen';
$route['admin/quanhuyen/(:num)'] ='admin/quanhuyen/index/$1';
$route['admin/quanhuyen/page/(:num)'] ='admin/quanhuyen/index/$1';

$route['admin/phuongxa'] ='admin/phuongxa';
$route['admin/phuongxa/(:num)'] ='admin/phuongxa/index/$1';
$route['admin/phuongxa/page/(:num)'] ='admin/phuongxa/index/$1';

$route['admin/thamso'] ='admin/thamso';
$route['admin/thamso/(:num)'] ='admin/thamso/index/$1';
$route['admin/thamso/page/(:num)'] ='admin/thamso/index/$1';

$route['admin/khachhang'] ='admin/khachhang/index';
$route['admin/khachhang/(:num)'] ='admin/khachhang/index/$1';
$route['admin/khachhang/page/(:num)'] ='admin/khachhang/index/$1';

$route['admin/orders'] ='admin/orders';
$route['admin/orders/(:num)'] ='admin/orders/index/$1';
$route['404_override'] = 'Error404';


$route['translate_uri_dashes'] = FALSE;

/*
*-------------------------------------------------------------------------------------------------
* DYNAMIC ROUTES
*-------------------------------------------------------------------------------------------------
*/
/*
require_once(BASEPATH . 'database/DB.php');
$db =& DB();
$email = $db->get('cauhinhemail')->row_array();
define('che_protocol',$email["che_protocol"]);
define('che_host',$email["che_host"]);
define('che_port',$email["che_port"]);
define('che_username',$email["che_username"]);
define('che_password',$email["che_password"]);

$db->close();
*/