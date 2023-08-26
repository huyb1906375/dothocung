<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class User extends MY_Controller
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
		$this->data['title']= "Thông tin cá nhân | ".chs_tieu_de;
		$this->data['keywords'] = "Thông tin cá nhân | ".chs_tieu_de;
		$this->data['description'] = "Thông tin cá nhân | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/index';
		$this->data['tab'] = 'thong-tin';
		if(!$this->session->userdata('user_id'))
		{
			//echo "<script>alert('Bạn phải đăng nhập trước khi đăng tin!');</script>";
			redirect(base_url().'dang-nhap.html','refresh');
		}
		$this->data['info'] = $this->doitac_model->lay_thong_tin_doi_tac($this->session->userdata('user_id'));
		$this->form_validation->set_rules('txtHoTen', 'Họ tên', 'required');
		$this->form_validation->set_rules('txtDiaChi', 'Địa chỉ', 'required');
		$this->form_validation->set_rules('txtDienThoai', 'Điện thoại', 'required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$id = $this->input->post('txtID');
			//$hinhanh = $this->doitac_model->lay_hinh_doi_tac($id);
			$mydata= array(
				'dt_ten' => $this->input->post('txtHoTen'),
				'dt_dia_chi' => $this->input->post('txtDiaChi'),
				'dt_dien_thoai' => $this->input->post('txtDienThoai'),
				'dt_email' => $this->input->post('txtEmail'),
				'dt_ghi_chu' => $this->input->post('txtGhiChu')
			);
			/*
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = 'uploads/doitac/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['dt_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = 'uploads/doitac/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['dt_hinh']='';
				}
			}
			else
			{
				$mydata['dt_hinh'] = $hinhanh;
				
			}
			*/
			if($this->doitac_model->sua_doi_tac($mydata, $id))
			{
				$this->session->set_userdata('user_ten',$this->input->post('txtHoTen'));
				$this->session->set_userdata('user_diachi',$this->input->post('txtDiaChi'));
				$this->session->set_userdata('user_dienthoai',$this->input->post('txtDienThoai'));
				$this->session->set_userdata('user_email',$this->input->post('txtEmail'));
				echo "<script>alert('Đã cập nhật thành công!');</script>";						
				redirect(base_url().'thong-tin.html','refresh');
			}
			else
			{
				echo "<script>alert('Đã cập nhật thất bại!');</script>";
				redirect(base_url().'thong-tin.html','refresh');
				//$this->load->view(chs_theme.'/index', $this->data);
				
			}
		} 
		else 
		{
			$this->load->view(chs_theme.'/index', $this->data);
		}
		
	}
	/*public function laymatkhau()
	{
		$this->data['title']= "Quên mật khẩu | ".chs_tieu_de;
		$this->data['keywords'] = "Quên mật khẩu | ".chs_tieu_de;
		$this->data['description'] = "Quên mật khẩu | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/laymatkhau';
		$this->data['tab'] = 'lay-mat-khau';
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			if($this->nguoidung_model->sua_nguoi_dung($mydata, $id))
			{
				echo "<script>alert('Đã cập nhật thành công!');</script>";						
				redirect(base_url().'thong-tin.html','refresh');
			}
			else
			{
				echo "<script>alert('Đã cập nhật thất bại!');</script>";
				$this->load->view(chs_theme.'/index', $this->data);
				
			}
		} 
		else 
		{
			$this->load->view(chs_theme.'/index', $this->data);
		}
		
	}*/
	public function laymatkhau()
	{
		$this->data['title']= "Quên mật khẩu | ".chs_tieu_de;
		$this->data['keywords'] = "Quên mật khẩu | ".chs_tieu_de;
		$this->data['description'] = "Quên mật khẩu | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/laymatkhau';
		$this->data['tab'] = 'lay-mat-khau';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtEmail', 'Email', 'required|min_length[3]|max_length[32]');
        if($this->form_validation->run())
        {
        	$email = $_POST['txtEmail'];
			$password = $this->nguoidung_model->lay_mat_khau($email);
        	if(strlen($password) > 0)
        	{
        		$this->load->library('email');
				$this->load->library('parser');
				$this->email->clear();
				$config['protocol']    = che_protocol;
				$config['smtp_host']    = che_host;//'ssl://smtp.gmail.com';
				$config['smtp_port']    = che_port;//'465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = che_username;
				$config['smtp_pass']    = che_password;
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$config['validation'] = TRUE;   
				$this->email->initialize($config);
				$this->email->from(che_username, 'Smart Store');
				$this->data['email_title'] = chs_tieu_de;
				$this->data['email_password'] = $password;
				$this->email->to($email);
				$this->email->subject('Quên mật khẩu');
				$body = $this->load->view(chs_theme.'/user/email_quenmatkhau',$this->data,TRUE);
				$this->email->message($body); 
				if($this->email->send())
				{
					echo "<script>alert('Mật khẩu của bạn đã được gửi đến email!');</script>";
					//echo $this->email->print_debugger();
					redirect(base_url().'trang-chu.html','refresh');
				}
				else echo "<script>alert('Lấy mật khẩu thất bại!');</script>";
				
        	}
        	else
	        {
	        	$this->data['error']='Email này chưa được đăng ký!';
	        	$this->load->view(chs_theme.'/index', $this->data);
	        }
        }
        else
        {
        	$this->load->view(chs_theme.'/index', $this->data);
        }
	}
	public function dangky()
	{
		$this->data['title']= "Đăng ký | ".chs_tieu_de;
		$this->data['keywords'] = "Đăng ký | ".chs_tieu_de;
		$this->data['description'] = "Đăng ký | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/register';
		$id = date('YmdHis');
		$ngaydangky = date('d/m/Y');
		//$this->load->library('form_validation');
		//$this->load->library('utils');
		$this->form_validation->set_rules('txtHoTen', 'Họ tên', 'required');
		$this->form_validation->set_rules('txtDiaChi', 'Địa chỉ', 'required');
		$this->form_validation->set_rules('txtDienThoai', 'Điện thoại', 'required');
		//$this->form_validation->set_rules('txtEmail', 'Email', 'required');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required');
		$this->form_validation->set_rules('txtMatKhau2', 'Nhập lại mật khẩu', 'required');
		$this->form_validation->set_rules('txtCaptcha', 'Mã xác nhận', 'required');
		$ipwan = $this->utils->getIPWan();
		$maxacnhan = $this->session->userdata('maxacnhan');
		if ($this->form_validation->run() == TRUE) 
		{
			if($maxacnhan != $this->input->post('txtCaptcha'))
			{
				$this->session->set_flashdata('error', 'Mã xác nhận không chính xác!');
				$this->load->view(chs_theme.'/index', $this->data);
			}
			else
			{
				$mydata= array(
					'dt_id' => $id,
					'dt_ten' => $this->input->post('txtHoTen'),
					'dt_dia_chi' => $this->input->post('txtDiaChi'),
					'dt_dien_thoai' => $this->input->post('txtDienThoai'),
					'dt_email' => $this->input->post('txtEmail'),
					'dt_username' => $this->input->post('txtTenDangNhap'),
					'dt_password' => md5($this->input->post('txtMatKhau')),
					'dt_trang_thai' => 1,
					'dt_ghi_chu' => '',
					'dt_hinh' => '',
					'dt_loai' => 'KH',
					'dt_ngay_dang_ky' => $ngaydangky,
					'dt_ip' => $ipwan
				);
				if($this->doitac_model->kiem_tra_ten_dang_nhap($this->input->post('txtTenDangNhap')))
				{
					$this->session->set_flashdata('error', 'Tên đăng nhập này đã được sử dụng. Bạn vui lòng lấy tên đăng nhập khác!');
					$this->load->view('index', $this->data);
				}
				else
				{
					if($this->doitac_model->kiem_tra_ip_dang_ky($ipwan, $ngaydangky))
					{
						$this->session->set_flashdata('error', 'Bạn chỉ được đăng ký không quá 3 lần trên 1 IP/ngày!');
						$this->load->view(chs_theme.'/index', $this->data);
					}
					else
					{
						if($this->doitac_model->them_doi_tac($mydata))
						{
							$this->session->set_userdata('user_id',$id);
							$this->session->set_userdata('user_username',$this->input->post('txtTenDangNhap'));
							$this->session->set_userdata('user_ten',$this->input->post('txtHoTen'));
							$this->session->set_userdata('user_diachi',$this->input->post('txtDiaChi'));
							$this->session->set_userdata('user_dienthoai',$this->input->post('txtDienThoai'));
							$this->session->set_userdata('user_email',$this->input->post('txtEmail'));
							$this->session->set_userdata('user_time',time());
							echo "<script>alert('Đã đăng ký thành công thành công!');</script>";
							//$this->session->set_flashdata('success', 'Thêm người dùng thành công');								
							redirect(base_url().'trang-chu.html','refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'Đăng ký thất bại!');
							$this->load->view(chs_theme.'/index', $this->data);
							
						}
					}
				}
			}
		} 
		else 
		{
			if($this->session->set_flashdata('error')) $this->session->unset_flashdata('error');
			$this->load->view(chs_theme.'/index', $this->data);
		}
	}
	public function doimatkhau()
	{
		$this->data['title']= "Đổi mật khẩu | ".chs_tieu_de;
		$this->data['keywords'] = "Đổi mật khẩu | ".chs_tieu_de;
		$this->data['description'] = "Đổi mật khẩu | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/doimatkhau';
		if(!$this->session->userdata('user_id'))
		{
			//echo "<script>alert('Bạn phải đăng nhập trước khi đăng tin!');</script>";
			redirect(base_url().'dang-nhap.html','refresh');
		}
		$this->data['info'] = $this->doitac_model->lay_thong_tin_doi_tac($this->session->userdata('user_id'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required');
		$this->form_validation->set_rules('txtMatKhauMoi', 'Mật khẩu mới', 'required');
		$this->form_validation->set_rules('txtMatKhauMoi2', 'Xác nhận mật khẩu mới', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$tendangnhap = $this->input->post('txtTenDangNhap');
			$matkhau = md5($this->input->post('txtMatKhau'));
			if($this->doitac_model->kiem_tra_ton_tai_doi_tac($tendangnhap, $matkhau)!=FALSE)
			{
				$id = $this->session->userdata('user_id');
				$mydata= array('nd_mat_khau' => md5($this->input->post('txtMatKhauMoi')));
				if($this->doitac_model->sua_doi_tac($mydata, $id))
				{
					echo "<script>alert('Đã đổi mật khẩu thành công!');</script>";							
					redirect(base_url().'trang-chu.html','refresh');
				}
				else
				{
					echo "<script>alert('Đổi mật khẩu thất bại!');</script>";
					$this->load->view(chs_theme.'/index', $this->data);
					
				}
				
			}
			else
			{
				echo "<script>alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại!');</script>";
				$this->load->view(chs_theme.'/index', $this->data);
			}
		} 
		else 
		{
			
			$this->load->view(chs_theme.'/index', $this->data);
		}
	}

	public function dangtin()
	{
		$this->data['title']= "Đăng tin BĐS | ".chs_tieu_de;
		$this->data['keywords'] = "Đăng tin BĐS | ".chs_tieu_de;
		$this->data['description'] = "Đăng tin BĐS | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/dangbds';
		
		$this->data['tab'] = 'dang-tin';
		/*
		if(!$this->session->userdata('user_id'))
		{
			echo "<script>alert('Bạn phải đăng nhập để được đăng tin!');</script>";
			redirect(base_url().'dang-nhap.html','refresh');
		}
		*/
		$this->load->library('alias');
		$today = date("Y-m-d H:i:s");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		$this->form_validation->set_rules('cboLoaiBDSDT', 'Loại bất động sản', 'required');
		$this->form_validation->set_rules('cboQuanHuyenDT', 'Quận huyện', 'required');
		$this->form_validation->set_rules('cboPhuongXaDT', 'Phường xã', 'required');
		//$this->form_validation->set_rules('txtDiaChi', 'Địa chỉ', 'required');
		$this->form_validation->set_rules('txtDienTich', 'Diện tích', 'required');
		$this->form_validation->set_rules('txtTenLienHe', 'Tên liên hệ', 'required');
		$this->form_validation->set_rules('txtDienThoaiLienHe', 'Điện thoại liên hệ', 'required');
		$id = $this->input->post('txtID');
		if ($this->form_validation->run() == TRUE) 
		{			
			
			
			$donvi = $this->input->post('cboDonVi');
			$gia = $this->input->post('txtGia');
			//$giaban = $this->input->post('txtGia');
			if(strlen($gia) == 0)
				$gia = 0;
			else 
			{
				$gia = str_replace(",", "",$gia);
				
			}
			
			$mydata= array(
				'bds_id' => $id,
				'bds_ten' => $this->input->post('txtTen'),
				'bds_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'bds_hinh' => $this->batdongsan_model->lay_bat_dong_san_hinh_first($this->input->post('txtID')),
				'bds_cm_id' => $this->input->post('cboLoaiBDSDT'),
				'bds_tt_id' => 'kiengiang',
				'bds_qh_id' => $this->input->post('cboQuanHuyenDT'),
				'bds_px_id' => $this->input->post('cboPhuongXaDT'),
				'bds_dia_chi' => $this->input->post('txtDiaChi'),
				'bds_phap_ly' => $this->input->post('cboPhapLy'),
				'bds_dien_tich' => $this->input->post('txtDienTich'),
				'bds_gia' => $gia,		
				'bds_mo_ta' => $this->input->post('txtMoTa'),
				'bds_ten_lien_he' => $this->input->post('txtTenLienHe'),
				'bds_dien_thoai_lien_he' => $this->input->post('txtDienThoaiLienHe'),
				'bds_email_lien_he' => '',				
				'bds_thu_tu' => date('YmdHis'),					
				'bds_search' => $this->alias->loai_bo_dau_html($this->input->post('txtTen').$this->input->post('txtMoTa')),
				'bds_noi_bat' => 0,
				'bds_trang_thai' => 0,
				'bds_giao_dich' => 0,
				'bds_ngay_dang' => date("Y-m-d H:i:s"),
				'bds_nd_id' => 'admin',
				'bds_luot_xem' => 0,
				'bds_luot_thich' => 0,
				'bds_ngay_cap_nhat' => date("Y-m-d H:i:s")
			);
			
			if($this->batdongsan_model->them_bat_dong_san($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm thành công!');				
				$this->session->set_userdata('cm_id',$this->input->post('cboLoaiBDSDT'));
				//$this->session->set_userdata('tt_id',$this->input->post('cboTinhThanh'));
				$this->session->set_userdata('qh_id',$this->input->post('cboQuanHuyenDT'));
				$this->session->set_userdata('px_id',$this->input->post('cboPhuongXaDT'));
				$this->session->set_userdata('donvi',$this->input->post('cboDonVi'));
				$this->session->set_userdata('huong',$this->input->post('cboHuong'));
				$this->session->set_userdata('phaply',$this->input->post('cboPhapLy'));
				echo "<script>alert('Tin của bạn đã được gửi thành công. Nếu tin của bạn hợp lệ thì chúng tôi sẽ kích hoạt trong thời gian sớm nhất!');</script>";
				redirect(base_url().'dang-tin.html','refresh');
			}
			else
			{
				//$this->session->set_flashdata('error', 'Thêm thất bại!');
				echo "<script>alert('Không thể gửi tin này. Vui lòng kiểm tra lại!');</script>";
				$this->load->view(chs_theme.'/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['id'] = $id;
			if($this->session->set_flashdata('error')) $this->session->unset_flashdata('error');
			$this->load->view(chs_theme.'/index', $this->data);
		}
	}
	public function edit()
	{
		$this->data['title']= "Đăng tin BĐS | ".cchs_tieu_de;
		$this->data['keywords'] = "Đăng tin BĐS | ".chs_tieu_de;
		$this->data['description'] = "Đăng tin BĐS | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/dangbds';
		
		$this->data['tab'] = 'dang-tin';
		if(!$this->session->userdata('user_id'))
		{
			echo "<script>alert('Bạn phải đăng nhập để được đăng tin!');</script>";
			redirect(base_url().'dang-nhap.html','refresh');
		}
		$this->load->library('alias');
		$today = date("Y-m-d H:i:s");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		$this->form_validation->set_rules('cboLoaiBDSDT', 'Loại bất động sản', 'required');
		$this->form_validation->set_rules('cboQuanHuyenDT', 'Quận huyện', 'required');
		$this->form_validation->set_rules('cboPhuongXaDT', 'Phường xã', 'required');
		//$this->form_validation->set_rules('txtDiaChi', 'Địa chỉ', 'required');
		$this->form_validation->set_rules('txtDienTich', 'Diện tích', 'required');
		$this->form_validation->set_rules('txtTenLienHe', 'Tên liên hệ', 'required');
		$this->form_validation->set_rules('txtDienThoaiLienHe', 'Điện thoại liên hệ', 'required');
		$id = $this->input->post('txtID');
		if ($this->form_validation->run() == TRUE) 
		{			
			
			
			$donvi = $this->input->post('cboDonVi');
			$gia = $this->input->post('txtGia');
			//$giaban = $this->input->post('txtGia');
			if(strlen($gia) == 0)
				$gia = 0;
			else 
			{
				$gia = str_replace(",", "",$gia);
				
			}
			
			$mydata= array(
				'bds_id' => $id,
				'bds_ten' => $this->input->post('txtTen'),
				'bds_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'bds_hinh' => $this->batdongsan_model->lay_bat_dong_san_hinh_first($this->input->post('txtID')),
				'bds_cm_id' => $this->input->post('cboLoaiBDSDT'),
				'bds_tt_id' => 'kiengiang',
				'bds_qh_id' => $this->input->post('cboQuanHuyenDT'),
				'bds_px_id' => $this->input->post('cboPhuongXaDT'),
				'bds_dia_chi' => $this->input->post('txtDiaChi'),
				'bds_phap_ly' => $this->input->post('cboPhapLy'),
				'bds_dien_tich' => $this->input->post('txtDienTich'),
				'bds_gia' => $gia,		
				'bds_mo_ta' => $this->input->post('txtMoTa'),
				'bds_ten_lien_he' => $this->input->post('txtTenLienHe'),
				'bds_dien_thoai_lien_he' => $this->input->post('txtDienThoaiLienHe'),
				'bds_email_lien_he' => '',				
				'bds_thu_tu' => date('YmdHis'),					
				'bds_search' => $this->alias->loai_bo_dau_html($this->input->post('txtTen').$this->input->post('txtMoTa')),
				'bds_noi_bat' => 0,
				'bds_trang_thai' => 0,
				'bds_giao_dich' => 0,
				'bds_ngay_dang' => date("Y-m-d H:i:s"),
				'bds_nd_id' => $this->session->userdata('user_id'),
				'bds_luot_xem' => 0,
				'bds_luot_thich' => 0,
				'bds_ngay_cap_nhat' => date("Y-m-d H:i:s")
			);
			
			if($this->batdongsan_model->them_bat_dong_san($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm thành công!');				
				$this->session->set_userdata('cm_id',$this->input->post('cboLoaiBDSDT'));
				//$this->session->set_userdata('tt_id',$this->input->post('cboTinhThanh'));
				$this->session->set_userdata('qh_id',$this->input->post('cboQuanHuyenDT'));
				$this->session->set_userdata('px_id',$this->input->post('cboPhuongXaDT'));
				$this->session->set_userdata('donvi',$this->input->post('cboDonVi'));
				$this->session->set_userdata('huong',$this->input->post('cboHuong'));
				$this->session->set_userdata('phaply',$this->input->post('cboPhapLy'));
				echo "<script>alert('Tin của bạn đã được gửi thành công. Nếu tin của bạn hợp lệ thì chúng tôi sẽ kích hoạt trong thời gian sớm nhất!');</script>";
				redirect(base_url().'dang-tin.html','refresh');
			}
			else
			{
				//$this->session->set_flashdata('error', 'Thêm thất bại!');
				echo "<script>alert('Không thể gửi tin này. Vui lòng kiểm tra lại!');</script>";
				$this->load->view(chs_theme.'/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['id'] = $id;
			if($this->session->set_flashdata('error')) $this->session->unset_flashdata('error');
			$this->load->view('index', $this->data);
		}
	}
	public function xemgiaodich()
	{
		$this->data['title']= "Xem giao dịch | ".chs_tieu_de;
		$this->data['keywords'] = "Xem giao dịch | ".chs_tieu_de;
		$this->data['description'] = "Xem giao dịch | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/user/xemgiaodich';
		
		$this->data['tab'] = 'xem-giao-dich';
		
		
		$id = $this->uri->rsegment(3);
		$this->data['list']= $this->giaodich_model->lay_danh_sach_giao_dich_gioi_han($this->session->userdata('user_id'),0,0);
		
		$this->load->view(chs_theme.'/index',$this->data);
	}
}
?>