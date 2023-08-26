<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Cart extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
		//$this->load->model('chuyenmuc_model');
		//$this->load->model('baiviet_model');
		//$this->load->model('lienket_model');
		//$this->load->model('menu_model');
		//$this->load->model('nguoidung_model');
		//$this->load->model('doitac_model');
		//$this->load->model('donhang_model');
/*		
		if($this->session->userdata('nd_id'))
		{
			redirect(base_url().'trang-chu.html','refresh');
		}
		*/
    }
    public function index()
	{
		//$this->load->library('alias');
		//$this->load->helper('form');
		//$this->load->helper('text');
		$this->data['title']= "Giỏ hàng | ".chs_tieu_de;
		$this->data['keywords'] = "Giỏ hàng | ".chs_tieu_de;
		$this->data['description'] = "Giỏ hàng | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/cart/index';
		$this->data['tab'] = 'gio-hang';
		if($this->donhang_model->lay_so_san_pham_trong_gio($this->session->userdata("dh_id")) == 0)
		{
			echo "<script>alert('Chưa có sản phẩm nào trong giỏ hàng!');</script>";							
			redirect(base_url().'trang-chu.html','refresh');
		}
		if ($this->input->post('btnCapNhatGioHang')) 
		{
			$ids = $this->input->post('txtID');
			$soluongs = $this->input->post('txtSoLuong');
			$dongias = $this->input->post('txtDonGia');
			for($i=0;$i < sizeof($ids); $i++)
			{
				$id = $ids[$i];
				$soluong = $soluongs[$i];
				$dongia = $dongias[$i];
				$thanhtien = $soluongs[$i] * $dongias[$i];
				$mydata= array(				
						'dhct_so_luong' => $soluong,
						'dhct_thanh_tien' => $thanhtien
				);
				$this->donhang_model->sua_don_hang_chi_tiet($mydata,$id);
			}
		}
		$this->data['list'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($this->session->userdata('dh_id'));
		$this->data['site'] = chs_theme.'/cart/index';
		$this->load->view(chs_theme.'/index',$this->data);
		
		
	}
	public function checkout()
	{
		//$this->load->library('alias');
		//$this->load->helper('form');
		//$this->load->helper('text');
		$this->data['title']= "Giỏ hàng | ".chs_tieu_de;
		$this->data['keywords'] = "Giỏ hàng | ".chs_tieu_de;
		$this->data['description'] = "Giỏ hàng | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		
		$this->data['tab'] = 'gio-hang';
		if($this->donhang_model->lay_so_san_pham_trong_gio($this->session->userdata("dh_id")) == 0)
		{
			echo "<script>alert('Chưa có sản phẩm nào trong giỏ hàng!');</script>";							
			redirect(base_url().'trang-chu.html','refresh');
		}
		//if($this->session->userdata("user_id"))
		//{
			if ($this->input->post('btnHoanThanh')) 
			{
				$userid = "";
				if($this->session->userdata("user_id"))
					$userid = $this->session->userdata("user_id");
				$dh_id =  $this->session->userdata("dh_id");
				$mydata= array(				
					'dh_id' => $dh_id ,
					'dh_dt_id' => $userid,
					'dh_ky_hieu' => 'XH'.$this->session->userdata("dh_id"),
					'dh_ngay_lap' => date("Y-m-d H:i:s"),
					'dh_tien_hang' => $this->input->post('txtTongCong'),
					'dh_phi_van_chuyen' => 0,
					'dh_chiet_khau' => 0,
					'dh_tien_chiet_khau' => 0,
					'dh_tong_cong' => $this->input->post('txtTongCong'),
					'dh_thanh_toan' => 0,
					'dh_phuong_thuc_thanh_toan' => $this->input->post('cboPhuongThuc'),
					'dh_ten' => $this->input->post('txtHoTen'),
					'dh_dia_chi' => $this->input->post('txtDiaChi'),
					'dh_dien_thoai' => $this->input->post('txtDienThoai'),
					'dh_email' => $this->session->userdata('user_email'),
					'dh_ghi_chu' => $this->input->post('txtGhiChu'),
					'dh_ghi_chu_van_chuyen' => '',
					'dh_loai' => 'XB',
					'dh_trang_thai' => 1
					
				);
				if($this->donhang_model->them_don_hang($mydata))
				{
					$this->session->set_userdata('dh_id_comit',$dh_id );
					
					$email = $this->session->userdata('user_email');
					
					//$this->session->set_userdata('dh_id',time());
					//$this->data['site'] = chs_theme.'/cart/hoanthanh';
					//$this->load->view(chs_theme.'/index',$this->data);
					if(strlen($email) > 0)
					{
						$name = $this->input->post('txtHoTen');
						$this->data['donhang'] = $this->donhang_model->lay_thong_tin_don_hang($dh_id);
						$this->data['donhangchitiet'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($dh_id);
						$body = $this->load->view('sieuviet/cart/order-email',$this->data,TRUE);
						$this->gui_email(chs_don_vi, che_username, che_password, che_host, che_port,$name, $email, "Xác nhận đơn hàng", $body);
						/*
						if($this->gui_email(chs_don_vi, che_username, che_password, che_host, che_port,$name, $email, "Xác nhận đơn hàng", $body))
						{					
							echo "<script>alert('Email đã gửi thành công!');</script>";							
						}
						else echo "<script>alert('Gửi email thất bại!');</script>";
						*/
					}
					
					echo "<script>alert('Đơn hàng của bạn đã được gửi thành công!');</script>";	
					$this->session->set_userdata('dh_id',time());
					if(strlen($userid) > 0)
						redirect(base_url().'don-hang.html','refresh');
					else redirect(base_url().'trang-chu.html','refresh');
					/*
					$this->session->set_userdata('dh_id',time());
					$this->data['site'] = chs_theme.'/cart/hoanthanh';
					$this->load->view(chs_theme.'/index',$this->data);
					*/
					/*
					
					if(strlen($email) > 0)
					{
						$name = $this->input->post('txtHoTen');
						$this->data['donhang'] = $this->donhang_model->lay_thong_tin_don_hang($dh_id);
						$this->data['donhangchitiet'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($dh_id);
						$body = $this->load->view('sieuviet/cart/order-email',$this->data,TRUE);
						if($this->gui_email(chs_don_vi, che_username, che_password, che_host, che_port,$email, $email, "Xác nhận đơn hàng ", "Xác nhận đơn hàng"))
						{					
							echo "<script>alert('Email đã gửi thành công!');</script>";							
						}
						else echo "<script>alert('Gửi email thất bại!');</script>";
						$this->session->set_userdata('dh_id',time());
						$this->data['site'] = chs_theme.'/cart/hoanthanh';
						$this->load->view(chs_theme.'/index',$this->data);
						$config = Array( 
							'protocol' => 'smtp', 
							'smtp_host' => 'ssl://smtp.googlemail.com', 
							'smtp_port' => 465, 
							'smtp_user' => 'nguyenngocbaukg@gmail.com', 
							'smtp_pass' => 'nguyenngocbau175187', ); 

							$this->load->library('email', $config); 
							$this->email->set_newline("\r\n");
							$this->email->from('nguyenngocbaukg@gmail.com', 'Name');
							$this->email->to('sutekvn@gmail');
							$this->email->subject(' My mail through codeigniter from localhost '); 
							$this->email->message('Hello World…');
							 if($this->email->send()) 
								 echo "<script>alert('Email đã gửi thành công!');</script>";	
							 else
								 echo "<script>alert('Gửi email thất bại!');</script>";
							
						}
					
					*/
					
					
					
				}
				else
				{
					echo "<script>alert('Không thể hoàn thành đơn hàng do xảy ra lỗi. Vui lòng kiểm tra lại thông tin!');</script>";	
					$this->data['list'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($this->session->userdata('dh_id'));
					$this->data['site'] = chs_theme.'/cart/checkout';
					$this->load->view(chs_theme.'/index',$this->data);
				}
			}
			else
			{
				
				$this->data['list'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($this->session->userdata('dh_id'));
				$this->data['site'] = chs_theme.'/cart/checkout';
				$this->load->view(chs_theme.'/index',$this->data);
			}
			
		/*}
		else
		{
			$this->data['list'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($this->session->userdata('dh_id'));
			$this->data['site'] = 'site/cart/checkout';
			$this->load->view('index',$this->data);
		}*/
		
	}
	public function orderlist()
	{
		//$this->load->library('alias');
		//$this->load->helper('form');
		//$this->load->helper('text');
		$this->data['title']= "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['keywords'] = "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['description'] = "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/cart/donhang';
		$this->data['tab'] = 'don-hang';
		if(!$this->session->userdata('user_id'))
		{
			echo "<script>alert('Bạn chưa đăng nhập!');</script>";
			redirect(base_url().'dang-nhap.html','refresh');
		}
		else
		{
			$this->data['list'] = $this->donhang_model->lay_danh_sach_don_hang("","",$this->session->userdata('user_id'),"","",0,0);
			$this->data['site'] = chs_theme.'/cart/order-list';
			$this->load->view(chs_theme.'/index',$this->data);
		}
		
		
	}
	public function ordersearch()
	{
		//$this->load->library('alias');
		//$this->load->helper('form');
		//$this->load->helper('text');
		$this->data['title']= "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['keywords'] = "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['description'] = "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/cart/order-search';
		$this->data['tab'] = 'don-hang';
		$this->form_validation->set_rules('txtDHID', 'ID đơn hàng', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			if ($this->input->post('btnTraCuuDonHang')) 
			{
				$this->data['list'] = $this->donhang_model->tra_cuu_don_hang($this->input->post('txtDHID'));
				$this->data['site'] = chs_theme.'/cart/order-search';
				$this->load->view(chs_theme.'/index',$this->data);
			}
			else
			{
				$this->data['list'] = $this->donhang_model->tra_cuu_don_hang("");
				$this->data['site'] = chs_theme.'/cart/order-search';
				$this->load->view(chs_theme.'/index',$this->data);
			}
		}
		else
		{
			$this->data['list'] = $this->donhang_model->tra_cuu_don_hang("");
			$this->data['site'] = chs_theme.'/cart/order-search';
			$this->load->view(chs_theme.'/index',$this->data);
		}
		
	}
	public function delete()
	{
		//$this->load->library('alias');
		//$this->load->helper('form');
		//$this->load->helper('text');
		$this->data['title']= "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['keywords'] = "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['description'] = "Quản lý đơn hàng | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/cart/donhang';
		$this->data['tab'] = 'don-hang';
		if(!$this->session->userdata('user_id'))
		{
			echo "<script>alert('Bạn chưa đăng nhập!');</script>";
			redirect(base_url().'dang-nhap.html','refresh');
		}
		else
		{
			$id = $this->uri->rsegment(3);
			$dh = $this->donhang_model->lay_thong_tin_don_hang($id);
			if($dh["dh_trang_thai"] == 1)
			{
				if($this->donhang_model->xoa_don_hang($id))
				{
					$this->donhang_model->xoa_don_hang_chi_tiet($id);
					echo "<script>alert('Đã xóa thành công!');</script>";
				}
				else echo "<script>alert('Không thể xóa đơn hàng này!');</script>";
			}
			else echo "<script>alert('Đơn hàng này đã được xử lý nên bạn không thể xóa!');</script>";
			redirect('don-hang.html','refresh');
		}
		
		
	}
	public function orderdetail()
	{
		//$this->load->library('alias');
		//$this->load->helper('form');
		//$this->load->helper('text');
		
		$this->data['title']= "Đơn hàng chi tiết | ".chs_tieu_de;
		$this->data['keywords'] = "Đơn hàng chi tiết | ".chs_tieu_de;
		$this->data['description'] = "Đơn hàng chi tiết | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/cart/order-detail';
		$this->data['tab'] = 'order_detail';
		$id = str_replace(".html","", $this->uri->rsegment(3));
		//echo "<script>alert('".$id."');</script>";
		$this->data['donhang'] = $this->donhang_model->lay_thong_tin_don_hang($id);
		$this->data['donhangchitiet'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($id);
		$this->data['site'] = chs_theme.'/cart/order-detail';
		$this->load->view(chs_theme.'/index',$this->data);
		
		
	}
	public function orderprint()
	{
		//$this->load->library('alias');
		//$this->load->helper('form');
		//$this->load->helper('text');
		//$this->load->library('utils');
		
		$this->data['title']= "Đơn hàng chi tiết | ".chs_tieu_de;
		$this->data['keywords'] = "Đơn hàng chi tiết | ".chs_tieu_de;
		$this->data['description'] = "Đơn hàng chi tiết | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();

		$this->data['tab'] = 'order_detail';
		$id = str_replace(".html","", $this->uri->rsegment(3));
		//echo "<script>alert('".$id."');</script>";
		$this->data['donhang'] = $this->donhang_model->lay_thong_tin_don_hang($id);
		$this->data['donhangchitiet'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($id);
		$this->data['site'] = chs_theme.'/cart/order-detail';
		$this->load->view(base_url().chs_theme.'/cart/order-print',$this->data);
		
		
	}
	
}
?>