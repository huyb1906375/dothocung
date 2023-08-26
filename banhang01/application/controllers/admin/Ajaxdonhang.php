<?php
class Ajaxdonhang extends MY_Controller {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->limit = 5;
    }
	public function ajax_them_don_hang_chi_tiet()
	{
		$dh_id = $_POST['dh_id'];
		$sp_id = $_POST['sp_id'];
		$so_luong = $_POST['so_luong']; 
		$don_gia = $_POST['sp_don_gia']; 	
		$thanh_tien = $so_luong * $don_gia;
		$phivanchuyen = $_POST['dh_phi_van_chuyen'];
		$tienhang = 0;
		$tongcong = 0;
		$mydata= array(				
				'dhct_dh_id' => $dh_id,
				'dhct_sp_id' => $sp_id,
				'dhct_don_gia' => $don_gia,
				'dhct_so_luong' => $so_luong,
				'dhct_thanh_tien' => $thanh_tien,
				'dhct_chu_thich' => ''
		);
		if($this->donhang_model->them_don_hang_chi_tiet($mydata)) 
		{
			$tienhang = $this->donhang_model->lay_tong_thanh_tien_don_hang_chi_tiet($dh_id);
			$tongcong = $tienhang + $phivanchuyen;
			$mydata= array(				
				'dh_tien_hang' => $tienhang,
				'dh_phi_van_chuyen' => $phivanchuyen,
				'dh_tong_cong' => $tongcong
			);
			if($this->donhang_model->sua_don_hang($mydata,$dh_id))
				echo "1|".$tienhang."|".$phivanchuyen."|".$tongcong;
			else echo "1|0|0|0";
		}
		else echo "0|Không thể thêm!";
		
	}
	public function ajax_update_so_luong()
	{
		$dh_id = $_POST['dh_id'];  
		$dhct_id = $_POST['dhct_id'];
		$so_luong = $_POST['dhct_soluong']; 
		$don_gia = $_POST['dhct_dongia']; 	
		$thanh_tien = $so_luong * $don_gia;
		$phivanchuyen = $_POST['dh_phi_van_chuyen'];
		$tienhang = 0;
		$tongcong = 0;
		$mydata= array(				
				'dhct_so_luong' => $so_luong,
				'dhct_thanh_tien' => $thanh_tien
		);
		if($this->donhang_model->sua_don_hang_chi_tiet($mydata,$dhct_id )) 
		{
			$tienhang = $this->donhang_model->lay_tong_thanh_tien_don_hang_chi_tiet($dh_id);
			$tongcong = $tienhang + $phivanchuyen;
			$mydata= array(				
				'dh_tien_hang' => $tienhang,
				'dh_phi_van_chuyen' => $phivanchuyen,
				'dh_tong_cong' => $tongcong
			);
			if($this->donhang_model->sua_don_hang($mydata,$dh_id))
				echo "1|".$tienhang."|".$phivanchuyen."|".$tongcong;
			else echo "1|0|0|0";
		}
		else echo "0|Không thể sửa!";
		
	}
	public function ajax_lay_danh_sach_don_hang_chi_tiet()
	{
		$id = $this->uri->rsegment(3);
		$this->data['donhangchitiet']= $this->donhang_model->lay_ds_don_hang_chi_tiet($id);	
		$this->load->view('admin/donhang/donhangchitiet', $this->data);
		
	}
	public function ajax_xoa_don_hang_chi_tiet()
	{
		$dh_id = $_POST['dh_id'];  
		$dhct_id = $_POST['dhct_id'];	
		$phivanchuyen = $_POST['dh_phi_van_chuyen'];
		$tienhang = 0;
		$tongcong = 0;
		//echo "1|".$tienhang."|".$phivanchuyen."|".$tongcong;
		
		if($this->donhang_model->xoa_don_hang_chi_tiet($dhct_id)) 
		{
			if($this->donhang_model->lay_so_san_pham_trong_gio($dh_id) != 0)
			{
				$tienhang = $this->donhang_model->lay_tong_thanh_tien_don_hang_chi_tiet($dh_id);
				//$donhang = $this->donhang_model->lay_thong_tin_don_hang($dh_id);
				$tongcong = $tienhang + $phivanchuyen;
				$mydata= array(				
					'dh_tien_hang' => $tienhang,
					'dh_phi_van_chuyen' => $phivanchuyen,
					'dh_tong_cong' => $tongcong
				);
				if($this->donhang_model->sua_don_hang($mydata,$dh_id))
					echo "1|".$tienhang."|".$phivanchuyen."|".$tongcong;
				else echo "1|0|0|0";
			}
			else
			{
				$this->donhang_model->xoa_don_hang($dh_id);
				echo "1|0|0|0";
			}
		}
		else echo "0|Không thể xóa!";
		
		
	}
	public function ajax_luu_don_hang()
	{
		$id = $_POST['id'];
		$kyhieu = $_POST['kyhieu'];
		$ngaylap = $_POST['ngaylap'];
		$doitac = $_POST['doitac'];
		$ten = $_POST['ten'];
		$diachi = $_POST['diachi'];
		$dienthoai = $_POST['dienthoai'];
		$email = $_POST['email'];
		$ghichu = $_POST['ghichu'];
		$ghichuvanchuyen = $_POST['ghichuvanchuyen'];
		$tienhang = $_POST['tienhang'];
		$phivanchuyen = $_POST['phivanchuyen'];	
		$tongcong = $_POST['tongcong'];
		$thanhtoan = $_POST['thanhtoan'];
		$phuongthucthanhtoan = $_POST['phuongthucthanhtoan'];
		$trangthai = $_POST['trangthai'];
		$mydata= array(				
			'dh_id' => $id ,
			'dh_ky_hieu' => $kyhieu,
			'dh_ngay_lap' => $ngaylap,
			'dh_dt_id' => $doitac,
			'dh_ten' => $ten,
			'dh_dia_chi' => $diachi,
			'dh_dien_thoai' => $dienthoai,
			'dh_email' => $email,
			'dh_ghi_chu' => $ghichu,
			'dh_ghi_chu_van_chuyen' => $ghichuvanchuyen,			
			'dh_tien_hang' => $tienhang,
			'dh_phi_van_chuyen' => $phivanchuyen,			
			'dh_tong_cong' => $tongcong,
			'dh_thanh_toan' => $thanhtoan,
			'dh_phuong_thuc_thanh_toan' => $phuongthucthanhtoan,
			'dh_trang_thai' => $trangthai
			
		);
		if($this->donhang_model->sua_don_hang($mydata,$id))
			echo "1";
		else echo "0|Không thể lưu đơn hàng này!";
		
		
	}
	public function cms_autocomplete_products()
    {
		$this->load->library('alias');
		$data = $this->alias->str_alias($this->input->get('term'));
        $sanphams = $this->sanpham_model->lay_danh_sach_san_pham_autocomplete($data);
        echo json_encode($sanphams);
    }
}