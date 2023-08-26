<?php
class Captcha extends MY_Controller
{
	function __construct()
    {
        parent::__construct();
    }
	function index()
	{                 
		$ndata = array(
			'title'          => "Hướng dẫn Tạo captcha cùng Codeigniter",
			'keywords'       => "Hoangcode Programming Blog, Huong Dan, jQuery, Ajax, PHP, MySQL and Demo",
			'description'    => "Hoangcode là Blog về lập trình được phát triển và duy trì bởi Hoàng Code CI. Hướng dẫn cơ bản, Jquery, Ajax, PHP, Demo, CSS3, Javascript, Codeigniter and MySQL."
        );            
		$this->load->view('tem-captcha',$ndata);            
    }  
	function created()
	{
		$vals = array(
			'word' => '',
			'word_length' => 5,
			'font_size' => '36',
			'img_path' => './public/captcha/',
			'img_url' => base_url('public/').'/captcha/',
			'font_path' => base_url('public/font').'/wetpet.ttf',
			'img_width' => '100',
			'img_height' => 35,
			'expiration' => 7200
        );
		$cap = create_captcha($vals);
		$this->session->set_userdata($cap);
		$this->session->set_userdata('maxacnhan',$cap['word']);
		//$_SESSION['captchaWord'] = $cap['word'];
		echo $cap['image'];  
	}           
} 
?>  