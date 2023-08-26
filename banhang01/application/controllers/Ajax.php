<?php
class Ajax extends MY_Controller {
  
    public function __construct()
    {
        parent::__construct();
		$this->limit = 5;
    }
	public function ajax_keep_session_alive()
	{
		$this->session->set_userdata('KeepSessionAlive',date('ymdhis'));		
	}
	public function ajax_loai_link_video()
	{
		$id = $this->uri->rsegment(3);
		$bv = $this->video_model->lay_thong_tin_video($id);
		echo $bv["v_link"];
		
	}
	public function ajax_show_quick_view()
	{
		$id = $this->uri->rsegment(3);
		$this->data['sanpham']= $this->sanpham_model->lay_thong_tin_san_pham($id);
		$this->load->view('public/trangchu/quickview', $this->data);
	}
	public function ajax_add_to_cart()
	{
		$dh_id = $_POST['dh_id'];  
		$sp_id = $_POST['sp_id'];
		$so_luong = $_POST['so_luong']; 
		$don_gia = $_POST['don_gia']; 	
		$thanh_tien = $so_luong * $don_gia;
		if($this->donhang_model->kiem_tra_don_hang_chi_tiet($dh_id, $sp_id) > 0)
		{
			$dhct = $this->donhang_model->lay_thong_tin_don_hang_chi_tiet($dh_id, $sp_id);
			$mydata= array(				
				'dhct_so_luong' => $dhct["dhct_so_luong"] + $so_luong,
				'dhct_thanh_tien' => ($dhct["dhct_so_luong"] + $so_luong) * $dhct["dhct_don_gia"]
			);
			if($this->donhang_model->sua_don_hang_chi_tiet($mydata,$dhct["dhct_id"])) 
			{
				$number = $this->donhang_model->lay_so_san_pham_trong_gio($dh_id);
				echo $number;
			}

		}
		else
		{
			$mydata= array(
				'dhct_dh_id' => $dh_id,
				'dhct_sp_id' => $sp_id,
				'dhct_so_luong' => $so_luong,
				'dhct_don_gia' => $don_gia,
				'dhct_thanh_tien' => $thanh_tien,
				'dhct_chu_thich' => ''
			);
			if($this->donhang_model->them_don_hang_chi_tiet($mydata)) 
			{
				$number = $this->donhang_model->lay_so_san_pham_trong_gio($dh_id);
				echo $number;
			}
		}
	}
	public function ajax_dang_nhap()
	{
		$username = $_POST['tendangnhap'];  
		$password = md5($_POST['matkhau']);
		$row = $this->doitac_model->dang_nhap($username, $password);
		if($row!=FALSE)
		{
			
			$this->session->set_userdata('user_id',$row['dt_id']);
			$this->session->set_userdata('user_username',$row['dt_username']);
			$this->session->set_userdata('user_ten',$row['dt_ten']);
			$this->session->set_userdata('user_diachi',$row['dt_dia_chi']);
			$this->session->set_userdata('user_dienthoai',$row['dt_dien_thoai']);
			$this->session->set_userdata('user_email',$row['dt_email']);			
			$this->session->set_userdata('user_time',time());
			echo "1";
			
		}
		else
		{
			echo "0";
		}
	}
	public function ajax_dang_ky()
	{
		$this->load->library('utils');
		$ipwan = $this->utils->getIPWan();
		$maxacnhan = $this->session->userdata('maxacnhan');
		$id = date('YmdHis');
		$ten = $_POST['ten'];
		$diachi = $_POST['diachi'];
		$dienthoai = $_POST['dienthoai'];
		$email = $_POST['email'];
		$captcha = $_POST['captcha'];
		$username = $_POST['tendangnhap'];  
		$password = $_POST['matkhau'];
		$trangthai = 1;
		$ghichu = '';
		$hinh = '';
		$loai = 'KH';
		$ngaydangky = date('d/m/Y');
		
		if($maxacnhan != $captcha)
		{
			echo "0|Mã xác nhận không chính xác!";
			return;
		}
		else
		{
			$mydata= array(
				'dt_id' => $id,
				'dt_ten' => $ten,
				'dt_dia_chi' => $diachi,
				'dt_dien_thoai' => $dienthoai,
				'dt_email' => $email,
				'dt_username' => $username,
				'dt_password' => md5($password),
				'dt_trang_thai' => 1,
				'dt_ghi_chu' => '',
				'dt_hinh' => '',
				'dt_loai' => 'KH',
				'dt_ngay_dang_ky' => $ngaydangky,
				'dt_ip' => $ipwan
			);
			if($this->doitac_model->kiem_tra_ten_dang_nhap($username))
			{
				echo "0|Tên đăng nhập này đã được sử dụng. Bạn vui lòng lấy tên đăng nhập khác!";
				return;
			}
			else
			{
				if($this->doitac_model->kiem_tra_ip_dang_ky($ipwan, $ngaydangky))
				{
					echo "0|Bạn chỉ được đăng ký không quá 3 lần trên 1 IP/ngày!";
					return;
				}
				else
				{
					if($this->doitac_model->them_doi_tac($mydata))
					{
						$this->session->set_userdata('user_id',$id);
						$this->session->set_userdata('user_username',$username);
						$this->session->set_userdata('user_ten',$ten);
						$this->session->set_userdata('user_diachi',$diachi);
						$this->session->set_userdata('user_dienthoai',$dienthoai);
						$this->session->set_userdata('user_email',$email);
						$this->session->set_userdata('user_time',time());
						echo "1";
					}
					else
					{
						echo "0|Đăng ký thất bại!";
						return;
						
					}
				}
			}
		}
	}
	public function ajax_update_don_hang_chi_tiet()
	{
		$dh_id = $_POST['dh_id'];  
		$dhct_id = $_POST['dhct_id'];
		$so_luong = $_POST['dhct_soluong']; 
		$don_gia = $_POST['dhct_dongia']; 	
		$thanh_tien = $so_luong * $don_gia;
		$mydata= array(				
				'dhct_so_luong' => $so_luong,
				'dhct_thanh_tien' => $thanh_tien
		);
		if($this->donhang_model->sua_don_hang_chi_tiet($mydata,$dhct_id )) 
		{
			echo "1";
		}
		else echo "0";
		
	}
	public function ajax_lay_danh_sach_don_hang_chi_tiet()
	{
		$id = $this->uri->rsegment(3);
		$this->data['list']= $this->donhang_model->lay_ds_don_hang_chi_tiet($id);	
		$this->load->view('sieuviet/cart/donhangchitiet', $this->data);
		
	}
	public function ajax_xoa_don_hang_chi_tiet()
	{
		$dh_id = $_POST['dh_id'];  
		$dhct_id = $_POST['dhct_id'];		
		if($this->donhang_model->xoa_don_hang_chi_tiet($dhct_id )) 
		{
			echo "1";
		}
		else echo "0";
	}
	public function ajax_tim_kiem_san_pham()
    {
		
		$this->load->library('alias');
		$data = $this->alias->str_alias($this->input->get('term'));
        $sanphams = $this->sanpham_model->lay_danh_sach_san_pham_autocomplete($data);
        echo json_encode($sanphams);
    }
}