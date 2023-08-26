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
$route['chuyen-muc/(:any)/page-(:num).html'] ='tintuc/index/$1/$2';
$route['chuyen-muc/(:any)/(:any)'] = 'tintuc/index/$1/$2';
$route['tim-kiem.html'] = 'tintuc/search';
$route['tim-kiem/page-(:num).html'] ='tintuc/search/$1';
$route['in-tin-tuc/(:any)'] = 'tintuc/print_doc/$1';
$route['in-tour/(:any)'] = 'sanpham/print_doc/$1';

$route['video/(:any)'] = 'video/detail/$1';
$route['chuyen-muc-video/(:any)'] = 'video/index/$1';
$route['chuyen-muc-video/(:any)/page-(:num).html'] ='video/index/$1/$2';
$route['chuyen-muc-video/(:any)/(:any)'] = 'video/index/$1/$2';
$route['tim-kiem-video.html'] = 'video/search';

$route['san-pham/(:any)'] = 'sanpham/detail/$1';
/*$route['san-pham/(:any)/(:any)'] = 'sanpham/detail/$1';*/
$route['danh-muc/(:any)'] = 'sanpham/index/$1';
$route['danh-muc/(:any)/page-(:num).html'] ='sanpham/index/$1/$2';
$route['danh-muc/(:any)/(:any)'] = 'sanpham/index/$1/$2';
$route['tim-kiem-san-pham.html'] = 'sanpham/search';
$route['tim-kiem-san-pham/page-(:num).html'] ='sanpham/search/$1';


$route['giao-dien/(:any)'] = 'giaodien/index/$1';
$route['ngon-ngu/(:any)'] = 'ngonngu/index/$1';

$route['lien-he.html'] = 'lienhe/index';
$route['admin'] = 'admin/home';
$route['dang-nhap.html'] = 'auth/index';
$route['dang-tin.html'] = 'user/dangtin';
$route['(:any)'] = 'trangdon/index';

$route['admin/thamso'] ='admin/thamso';
$route['admin/thamso/(:num)'] ='admin/thamso/index/$1';
$route['admin/thamso/page/(:num)'] ='admin/thamso/index/$1';

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


$route['404_override'] = 'Error404';



$route['translate_uri_dashes'] = FALSE;

/*
*-------------------------------------------------------------------------------------------------
* DYNAMIC ROUTES
*-------------------------------------------------------------------------------------------------
*/
/*
require_once(BASEPATH . 'database/DB.php');
function GetDomain()
{
	$pageURL = 'http';	 
	if (!empty($_SERVER['HTTPS'])) 
	{
		if ($_SERVER['HTTPS'] == 'on') 
		{
			$pageURL .= "s";
		}
	} 
	$pageURL .= "://"; 
	if ($_SERVER["SERVER_PORT"] != "80") 
	{
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
	} 
	else 
	{
		$pageURL .= $_SERVER["SERVER_NAME"];
	}
	return $pageURL;
}



$db =& DB();
$settings = $db->get('cauhinhsite')->row_array();
define('chs_ten_mien',GetDomain());
define('chs_tieu_de',$settings["chs_tieu_de"]);
define('chs_tu_khoa',$settings["chs_tu_khoa"]);
define('chs_mo_ta',$settings["chs_mo_ta"]);
define('chs_logo',$settings["chs_logo"]);
define('chs_logo_mobile',$settings["chs_logo_mobile"]);
define('chs_favicon',$settings["chs_favicon"]);
define('chs_banner',$settings["chs_banner"]);
define('chs_hinh_nen',$settings["chs_hinh_nen"]);
define('chs_gioi_thieu',$settings["chs_gioi_thieu"]);
define('chs_ban_quyen',$settings["chs_ban_quyen"]);
define('chs_don_vi',$settings["chs_don_vi"]);
define('chs_dien_thoai',$settings["chs_dien_thoai"]);
define('chs_email',$settings["chs_email"]);
define('chs_dia_chi',$settings["chs_dia_chi"]);
define('chs_bien_tap',$settings["chs_bien_tap"]);
define('chs_facebook',$settings["chs_facebook"]);
define('chs_google_maps',$settings["chs_google_maps"]);
$db->close();
*/