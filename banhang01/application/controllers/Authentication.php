<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Authentication extends MY_Controller
{
    function __construct() {
        parent::__construct();
/*		
		if($this->session->userdata('nd_id'))
		{
			redirect(base_url().'trang-chu.html','refresh');
		}
		*/
    }
    public function index(){
		$this->data['metaDescription'] = "Đăng nhập";
        $this->data['metaKeywords'] = "Đăng nhập";
		$this->data['title'] = "Đăng nhập";
		$this->data['site'] = 'site/user/login';
		if(isset($this->session->userdata['user']['id'])){
			redirect(base_url('authentication/success'));
		}else {
			$cookie_name	=	'siteAuth';
			if(isset($_COOKIE[$cookie_name])){	
				$us = parse_str($_COOKIE[$cookie_name]);
				$username = $us["username"];
				$password = $us['password'];				
				$user_checking = $this->nguoidung_model->dang_nhap($username,$password);
				if($user_checking){					
					$this->session->set_userdata('user', $user_checking);
					redirect(base_url('authentication/success'));
				}
			}
		}
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required|min_length[3]|max_length[32]');
		if($this->form_validation->run())
		{
			$username = $this->input->post('txtTenDangNhap');
			$password = md5($this->input->post('txtMatKhau'));
			$autologin =	($this->input->post('checkedall') == 'on') ? 1 : 0;
			$user_checking = $this->nguoidung_model->dang_nhap($username, $password);
			if($user_checking != FALSE){
				if($autologin == 1){
					$cookie_name	=	'siteAuth';
					setcookie('ci-session', 'username='."", time() - 3600);
					setcookie($cookie_name, 'username='.$username.'&password='.$password, time() + $cookie_time);
					
				}
				$this->session->set_userdata('user', $user_checking);
				redirect(base_url('authentication/success'));
			}
			
		}
		else
        {
        	$this->load->view('layout',$this->data);
        }
	}
	public function login(){
		$this->data['metaDescription'] = "Đăng nhập";
        $this->data['metaKeywords'] = "Đăng nhập";
		$this->data['title'] = "Đăng nhập";
		$this->data['site'] = 'site/user/login';
		if($this->form_validation->run())
		{
			$username = $this->input->post('txtTenDangNhap');
			$password = md5($this->input->post('txtMatKhau'));
			$autologin =	($this->input->post('checkedall') == 'on') ? 1 : 0;
			$user_checking = $this->nguoidung_model->dang_nhap($username, $password);
			if($user_checking != FALSE){
				if($autologin == 1){
					$cookie_name	=	'siteAuth';
					setcookie('ci-session', 'username='."", time() - 3600);	// Unset cookie of user
					setcookie($cookie_name, 'username='.$username.'&password='.$password, time() + $cookie_time);
					
				}
				$this->session->set_userdata('user', $user_checking);
				$this->data['user'] = $this->session->userdata('user');
				redirect(base_url().'trang-chu.html','refresh');
			}
			else
	        {
	        	$this->data['error']='Tên đăng nhập hoặc mật khẩu không chính xác!';
	        	$this->load->view('layout', $this->data);
	        }
		}
		else
        {
        	$this->load->view('layout',$this->data);
        }
		
	}
	
	public function logout(){
		$this->session->unset_userdata('user');
		$this->session->sess_destroy();
		$cookiename	=	"siteAuth";
		setcookie($cookiename, 'username='."", time() - 3600);
		redirect(base_url().'trang-chu.html','refresh');
	}
	
	public function success(){
		$this->data['user'] = $this->session->userdata('user');
		redirect(base_url().'trang-chu.html','refresh');
	}
	public function dangtin()
	{
		$this->data['title']= "Đăng tin - ".chs_tieu_de;		
		$this->data['site'] = 'site/user/login';
		if(!$this->session->userdata('nd_id'))
		{
			redirect(base_url().'dang-nhap.html','refresh');
		}
		
	}
}
?>