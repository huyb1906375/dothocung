<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doimatkhau extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='hethong';
		$this->data['com']='doimatkhau';
	}
	public function index()
	{
		$this->data['title']='Đổi mật khẩu - SutekCMS';
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required');
		$this->form_validation->set_rules('txtMatKhauMoi', 'Mật khẩu mới', 'required');
		$this->form_validation->set_rules('txtXacNhanMatKhauMoi', 'Xác nhận mật khẩu mới', 'required');
        if($this->form_validation->run())
        {
        	$username = $_POST['txtTenDangNhap'];
        	$password = md5($_POST['txtMatKhau']);
        	if($this->nguoidung_model->dang_nhap($username, $password)!=FALSE)
        	{
        		$row = $this->nguoidung_model->dang_nhap($username, $password);
				$id = $row["nd_id"];
				$mydata= array(
					'nd_mat_khau' => md5($this->input->post('txtMatKhauMoi'))
				);
				if($this->nguoidung_model->sua_nguoi_dung($mydata, $id))
				{
					$this->session->set_flashdata('success', 'Đổi mật khẩu thành công!');
					redirect('admin/doimatkhau','refresh');					
				}
				else
				{
					$this->session->set_flashdata('error', 'Đổi mật khẩu thất bại!');
					$this->data['template'] = 'admin/nguoidung/doimatkhau';
					$this->load->view('admin/index', $this->data);
					
				}
        		
        	}
        	else
	        {
				$this->session->set_flashdata('error', 'Tên đăng nhập hoặc mật khẩu không chính xác!');
				$this->data['template'] = 'admin/nguoidung/doimatkhau';
	        	
	        	$this->load->view('admin/index', $this->data);
	        }
        }
        else
        {
			$this->data['template'] = 'admin/nguoidung/doimatkhau';
        	$this->load->view('admin/index', $this->data);
        }
	}
}

