<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Auth extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
/*		
		if($this->session->userdata('nd_id'))
		{
			redirect(base_url().'trang-chu.html','refresh');
		}
		*/
    }
    public function index()
	{
		$this->data['title']= "Đăng nhập | ".chs_ten_mien;
		$this->data['keywords'] = "Đăng nhập | ".chs_ten_mien;
		$this->data['description'] = "Đăng nhập | ".chs_ten_mien;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/login';
		if($this->session->userdata('user_id'))
		{
			redirect(base_url().'trang-chu.html','refresh');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required|min_length[1]|max_length[32]');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|min_length[1]|max_length[32]');
        if($this->form_validation->run())
        {
        	$username = $_POST['txtTenDangNhap'];
        	$password = md5($_POST['txtMatKhau']);
        	if($this->doitac_model->dang_nhap($username, $password)!=FALSE)
        	{
        		$row = $this->doitac_model->dang_nhap($username, $password);
				$this->session->set_userdata('user_id',$row['dt_id']);
				$this->session->set_userdata('user_username',$row['dt_username']);
				$this->session->set_userdata('user_ten',$row['dt_ten']);
				$this->session->set_userdata('user_diachi',$row['dt_dia_chi']);
				$this->session->set_userdata('user_dienthoai',$row['dt_dien_thoai']);
				$this->session->set_userdata('user_email',$row['dt_email']);
				
				$this->session->set_userdata('user_time',time());
        		redirect(base_url().'trang-chu.html','refresh');
				
        	}
        	else
	        {
	        	$this->data['error']='Tên đăng nhập hoặc mật khẩu không chính xác!';
	        	$this->load->view(chs_theme.'/index', $this->data);
	        }
        }
        else
        {
        	$this->load->view(chs_theme.'/index',$this->data);
        }
	}
	
	
	
	public function logout()
	{
		$array_items = array('user_id', 'user_time','user_ten_dang_nhap','user_ten','user_diachi','user_dienthoai','user_email');
        $this->session->unset_userdata($array_items);
		redirect(base_url().'trang-chu.html','refresh');
	}
	public function lay_mat_khau()
	{
		$this->data['title']= "Quên mật khẩu | ".chs_ten_mien;
		$this->data['keywords'] = "Quên mật khẩu | ".chs_ten_mien;
		$this->data['description'] = "Quên mật khẩu | ".chs_ten_mien;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/laymatkhau';
		$this->form_validation->set_rules('txtEmail', 'Email', 'required|min_length[3]|max_length[32]');
        if($this->form_validation->run())
        {
        	$email = $_POST['txtEmail'];
			$id = $this->doitac_model->lay_id_bang_email($email);
			$chuoibaomat = md5(time()); //
        	if(strlen($id) > 0)
        	{
				
				$domain = $this->getServerUrl();
				$this->data['email_domain'] = $domain;
				//echo "<script>alert('".$domain."');</script>";
				
				$this->data['email_chuoibaomat'] = $chuoibaomat;
				//echo "<script>alert('".che_username." - ".che_password." - ".che_host." - ".che_port." - ".$email."');</script>";
				
				$body = $this->load->view(chs_theme.'/user/email_quenmatkhau',$this->data,TRUE);
				if($this->gui_email(chs_tieu_de, che_username, che_password, che_host, che_port,$email, $email, 'Quên mật khẩu', $body))
				{
					$this->doitac_model->sua_doi_tac(array('dt_chuoi_bao_mat' => $chuoibaomat), $id);
					echo "<script>alert('Bạn làm theo hướng dẫn đã được gửi vào email để đặt lại mật khẩu!');</script>";
					redirect(base_url().'trang-chu.html','refresh');
				}
				else echo "<script>alert('Lấy mật khẩu thất bại!');</script>";
				
				
        	}
        	else
	        {
				echo "<script>alert('Email không tồn tại!');</script>";
				$this->load->view(chs_theme.'/index', $this->data);
	        	//$this->load->view(chs_theme.'/user/laymatkhau', $this->data);
	        }
        }
        else
        {
			$this->load->view(chs_theme.'/index', $this->data);
        	//$this->load->view(chs_theme.'/user/laymatkhau',$this->data);
        }
	}
	public function dat_lai_mat_khau()
	{
		$this->data['title']= "Đặt lại mật khẩu | ".chs_ten_mien;
		$this->data['keywords'] = "Đặt lại mật khẩu | ".chs_ten_mien;
		$this->data['description'] = "Đặt lại mật khẩu | ".chs_ten_mien;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/datlaimatkhau';
		
		$chuoibaomat = $this->uri->rsegment(3);		
		//echo "<script>alert('".$chuoibaomat."');</script>";

		$this->data['chuoibaomat'] = $chuoibaomat;
		$id = $this->doitac_model->lay_id_bang_chuoi_bao_mat($chuoibaomat);
		if(strlen($id) > 0)
		{
			$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|min_length[3]|max_length[32]');
			$this->form_validation->set_rules('txtMatKhau2', 'Xác nhận mật khẩu', 'required|min_length[3]|max_length[32]');
			if($this->form_validation->run())
			{
				$matkhaumoi = md5($this->input->post('txtMatKhau'));
				$mydata= array(
					'dt_password' => $matkhaumoi,
					'dt_chuoi_bao_mat' => ""
				);									
				if($this->doitac_model->sua_doi_tac($mydata, $id))
				{
					echo "<script>alert('Đã thực hiện thành công!');</script>";
					redirect(base_url().'dang-nhap.html','refresh');
				}
				else echo "<script>alert('Thực hiện thất bại!');</script>";				
				
			}
			else
			{
				$this->load->view(chs_theme.'/index', $this->data);
			}
		}
		else
		{
			echo "<script>alert('Link không tồn tại!');</script>";
			redirect(base_url().'trang-chu.html','refresh');
		}
	}
	/*
	public function doi_mat_khau()
	{
		$this->data['metaDescription'] = "Đổi mật khẩu - ".chs_tieu_de;
        $this->data['metaKeywords'] = "Đổi mật khẩu - ".chs_tieu_de;
		$this->data['title'] = "Đổi mật khẩu - ".chs_tieu_de;
		
		$this->data['site'] = chs_theme.'/user/doimatkhau';
		if(!$this->session->userdata('user_id'))
		{
			redirect(base_url().'trang-chu.html','refresh');
		}		
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|min_length[3]|max_length[32]');
		$this->form_validation->set_rules('txtXacNhanMatKhau', 'Xác nhận mật khẩu', 'required|min_length[3]|max_length[32]');
		if($this->form_validation->run())
		{
			$id = $this->session->userdata('user_id');
			$matkhaumoi = md5($this->input->post('txtMatKhau'));
			$mydata= array(
				'nd_mat_khau' => $matkhaumoi,
				'nd_chuoi_bao_mat' => ""
			);									
			if($this->nguoidung_model->sua_nguoi_dung($mydata, $id))
			{
				echo "<script>alert('Đã thực hiện thành công!');</script>";
				$array_items = array('user_id', 'user_time','user_ten_dang_nhap','user_ten','user_dien_thoai','user_email');
				$this->session->unset_userdata($array_items);
				redirect(base_url().'dang-nhap.html','refresh');
			}
			else echo "<script>alert('Thực hiện thất bại!');</script>";				
			
		}
		else
		{
			$this->load->view(chs_theme.'/index', $this->data);
		}
		
	}
	*/
	/*
	public function login()
	{
		$this->data['metaDescription'] = "Đăng nhập - ".chs_tieu_de;
        $this->data['metaKeywords'] = "Đăng nhập - ".chs_tieu_de;
		$this->data['title'] = "Đăng nhập - ".chs_tieu_de;
		
		$this->data['site'] = 'site/user/login';
		if($this->session->userdata('nd_id'))
		{
			redirect(base_url().'trang-chu.html','refresh');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required|min_length[3]|max_length[32]');
        if($this->form_validation->run())
        {
        	$username = $_POST['txtTenDangNhap'];
        	$password = md5($_POST['txtMatKhau']);
        	if($this->nguoidung_model->dang_nhap($username, $password)!=FALSE)
        	{
        		$row = $this->nguoidung_model->dang_nhap($username, $password);
				$this->session->set_userdata('user_id',$row['nd_id']);
				$this->session->set_userdata('user_ten_dang_nhap',$row['nd_ten_dang_nhap']);
				$this->session->set_userdata('user_ten',$row['nd_ten']);
				$this->session->set_userdata('user_dien_thoai',$row['nd_dien_thoai']);
				$this->session->set_userdata('user_email',$row['nd_email']);
				$this->session->set_userdata('user_admin',$row['nd_admin']);
				$this->session->set_userdata('user_time',time());
        		redirect(base_url().'trang-chu.html','refresh');
				
        	}
        	else
	        {
	        	$this->data['error']='Tên đăng nhập hoặc mật khẩu không chính xác!';
	        	$this->load->view('index', $this->data);
	        }
        }
        else
        {
        	$this->load->view('index',$this->data);
        }
	}
	public function dangtin()
	{
		$this->data['title']= "Đăng tin - ".chs_tieu_de;
		
		$this->data['site'] = 'site/user/login';
		if(!$this->session->userdata('nd_id'))
		{
			redirect(base_url().'dang-nhap.html','refresh');
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required|min_length[3]|max_length[32]');
        if($this->form_validation->run())
        {
        	$username = $_POST['txtTenDangNhap'];
        	$password = md5($_POST['txtMatKhau']);
        	if($this->nguoidung_model->dang_nhap($username, $password)!=FALSE)
        	{
        		$row = $this->nguoidung_model->dang_nhap($username, $password);
				$this->session->set_userdata('nd_id',$row['nd_id']);
				$this->session->set_userdata('nd_ten_dang_nhap',$row['nd_ten_dang_nhap']);
				$this->session->set_userdata('nd_ten',$row['nd_ten']);
				$this->session->set_userdata('nd_time',time());
        		redirect(base_url().'trang-chu.html','refresh');
				
        	}
        	else
	        {
	        	$this->data['error']='Tên đăng nhập hoặc mật khẩu không chính xác!';
	        	$this->load->view('index', $this->data);
	        }
        }
        else
        {
        	$this->load->view('index',$this->data);
        }
		
	}
	*/
}
?>