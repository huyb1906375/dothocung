<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nguoidung_model');
	}
	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required|min_length[3]|max_length[32]');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|min_length[3]|max_length[32]');
        if($this->form_validation->run())
        {
        	$username = $_POST['txtTenDangNhap'];
        	$password = md5($_POST['txtMatKhau']);
        	if($this->nguoidung_model->dang_nhap($username, $password)!=FALSE)
        	{
        		$row = $this->nguoidung_model->dang_nhap($username, $password);
				$this->session->set_userdata('nd_id',$row['nd_id']);
				$this->session->set_userdata('nd_time',time());
        		$this->session->set_userdata('nd_ten_dang_nhap',$row['nd_ten_dang_nhap']);
        		//$this->session->set_userdata('nd_ten',$row['nd_ten']);
        		//$this->session->set_userdata('nd_hinhanh',$row['nd_hinhanh']);
        		//$this->session->set_userdata('access',$row['access']);
        		redirect('admin','refresh');
        	}
        	else
	        {
	        	$data['error']='Tên đăng nhập hoặc mật khẩu không chính xác!';
	        	$this->load->view('admin/login/index', $data);
	        }
        }
        else
        {
        	$this->load->view('admin/login/index');
        }
	}
}

