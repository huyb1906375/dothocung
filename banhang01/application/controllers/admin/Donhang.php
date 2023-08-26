<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donhang extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('chucnang_model');
		$this->load->model('chuyenmuc_model');
        $this->load->model('nguoidung_model');
		$this->load->model('sanpham_model');
		$this->load->model('doitac_model');
		$this->load->model('donhang_model');
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='donhang';
	}
	public function index()
	{
		$this->load->library('alias');
		$this->load->helper('form');
		
		$this->data['title']= 'Đơn hàng - SakiCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$limit=20;
		
		$search = "";
		if($this->input->post())
		{
			$this->session->set_userdata('trangthai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('tungay',$this->input->post('txtTuNgay'));
			$this->session->set_userdata('denngay',$this->input->post('txtDenNgay'));
			$this->session->set_userdata('hoten',$this->input->post('txtHoTen'));
			$search = $this->alias->str_alias($this->input->post('txtHoTen'));
			
		}
		else 
		{
			
			$search = $this->alias->str_alias($this->session->userdata('hoten'));
			
		}
		if(!$this->session->userdata("tungay"))
			$this->session->set_userdata('tungay',date("Y-m-d"));
		if(!$this->session->userdata("denngay"))
			$this->session->set_userdata('denngay',date("Y-m-d"));
		$this->load->library('phantrang');
		
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->donhang_model->lay_danh_sach_don_hang($this->session->userdata('tungay'),$this->session->userdata('denngay'),"",$search,$this->session->userdata('trangthai'),0,0));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/donhang/page');
		$this->data['list']= $this->donhang_model->lay_danh_sach_don_hang($this->session->userdata('tungay'),$this->session->userdata('denngay'),"",$search,$this->session->userdata('trangthai'), $limit,$first);
		$this->data['template']='admin/donhang/index';
		$this->data['com']='donhang';
		$this->load->view('admin/index', $this->data);
        
	}
	public function thongkehangdat()
	{
		$this->load->library('alias');
		$this->load->helper('form');
		
		$this->data['title']= 'Đơn hàng - SakiCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$limit=20;
		
		$search = "";
		if($this->input->post('btnTimKiem'))
		{
			$this->session->set_userdata('trangthai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('tungay',$this->input->post('txtTuNgay'));
			$this->session->set_userdata('denngay',$this->input->post('txtDenNgay'));
			$this->session->set_userdata('hoten',$this->input->post('txtHoTen'));
			$search = $this->alias->str_alias($this->input->post('txtHoTen'));
			
		}
		else 
		{
			
			$search = $this->alias->str_alias($this->session->userdata('hoten'));
			
		}
		if(!$this->session->userdata("tungay"))
			$this->session->set_userdata('tungay',date("Y-m-d"));
		if(!$this->session->userdata("denngay"))
			$this->session->set_userdata('denngay',date("Y-m-d"));
		$this->load->library('phantrang');
		
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->donhang_model->lay_danh_sach_don_hang($this->session->userdata('tungay'),$this->session->userdata('denngay'),"",$search,$this->session->userdata('trangthai'),0,0));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/donhang/thongkehangdat/page');
		$this->data['list']= $this->donhang_model->lay_danh_sach_don_hang($this->session->userdata('tungay'),$this->session->userdata('denngay'),"",$search,$this->session->userdata('trangthai'), $limit,$first);
		$this->data['template']='admin/donhang/thongkehangdat';
		$this->data['com']='thongkehangdat';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->load->library('utils');
		$this->data['title']='Sửa đơn hàng - SakiCMS';
		$this->data['donhang'] = $this->donhang_model->lay_thong_tin_don_hang($id);
		$this->data['donhangchitiet'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($id);
		/*
		if($this->donhang_model->lay_so_san_pham_trong_gio($this->session->userdata("dh_id")) == 0)
		{
			echo "<script>alert('Chưa có sản phẩm nào trong giỏ hàng!');</script>";							
			redirect(base_url().'trang-chu.html','refresh');
		}
		*/
		//$this->form_validation->set_rules('txtHoTen', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$tienhang = $this->input->post('txtTienHang');
			if(strlen($tienhang) == 0)
				$tienhang = 0;
			else $tienhang = str_replace(",", "",$tienhang);
			
			$phivanchuyen = $this->input->post('txtPhiVanChuyen');
			if(strlen($phivanchuyen) == 0)
				$phivanchuyen = 0;
			else $phivanchuyen = str_replace(",", "",$phivanchuyen);
			
			$tongcong = $this->input->post('txtTongCong');
			if(strlen($tongcong) == 0)
				$tongcong = 0;
			else $tongcong = str_replace(",", "",$tongcong);
			
			$thanhtoan = $this->input->post('txtThanhToan');
			if(strlen($thanhtoan) == 0)
				$thanhtoan = 0;
			else $thanhtoan = str_replace(",", "",$thanhtoan);
			
			if ($this->input->post('btnLuuIn')) 
			{
				$mydata= array(				
					'dh_id' => $id ,
					'dh_dt_id' => $this->session->userdata("user_id"),
					'dh_ky_hieu' => 'XH'.$this->session->userdata("dh_id"),
					'dh_ngay_lap' => $this->input->post('txtNgayLap'),
					'dh_tien_hang' => $tienhang,
					'dh_phi_van_chuyen' => $phivanchuyen,
					'dh_chiet_khau' => 0,
					'dh_tien_chiet_khau' => 0,
					'dh_tong_cong' => $tongcong,
					'dh_thanh_toan' => $thanhtoan,
					'dh_phuong_thuc_thanh_toan' => $this->input->post('cboPhuongThuc'),
					'dh_ten' => $this->input->post('txtHoTen'),
					'dh_dia_chi' => $this->input->post('txtDiaChi'),
					'dh_dien_thoai' => $this->input->post('txtDienThoai'),
					'dh_email' => $this->input->post('txtEmail'),
					'dh_ghi_chu' => $this->input->post('txtGhiChu'),
					'dh_ghi_chu_van_chuyen' => '',
					'dh_loai' => 'XB',
					'dh_trang_thai' => $this->input->post('cboTrangThai'),
					
				);
				if($this->donhang_model->sua_don_hang($mydata,$id))
				{
					echo "<script>alert('Đã lưu thành công!');</script>";
					$this->data['template']='admin/donhang';
					$this->load->view('admin/index', $this->data);
					
				}
				else
				{
					echo "<script>alert('Không thể lưu đơn hàng này!');</script>";	
					$this->data['template']='admin/donhang/edit';
					$this->load->view('admin/index', $this->data);
				}
			}
			else
			{
				$this->data['template']='admin/donhang/edit';
				$this->data['list'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($this->session->userdata('dh_id'));
				$this->data['site'] = 'site/cart/checkout';
				$this->load->view('index',$this->data);
			}
			
		}
		else
		{
				
			$this->data['template']='admin/donhang/edit';
			$this->load->view('admin/index', $this->data);
		}
		
	}
	
    public function delete()
	{
		$id = $this->uri->rsegment(3);
		$dh = $this->donhang_model->lay_thong_tin_don_hang($id);
		if($this->donhang_model->xoa_don_hang($id))
		{
			$this->donhang_model->xoa_don_hang_chi_tiet($id);
			echo "<script>alert('Đã xóa thành công!');</script>";
		}
		else echo "<script>alert('Không thể xóa đơn hàng này!');</script>";
		/*
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
		*/
		redirect('admin/donhang','refresh');
	}
	public function printorder()
	{
		//echo APPPATH.'controllers/barcode.php';
		
		require_once(APPPATH.'/controllers/Barcode.php'); 
		
		$this->load->library('utils');
		
		$id = str_replace(".html","", $this->uri->rsegment(3));
		//echo "<script>alert('".$id."');</script>";
		$this->data['donhang'] = $this->donhang_model->lay_thong_tin_don_hang($id);
		$this->data['donhangchitiet'] = $this->donhang_model->lay_ds_don_hang_chi_tiet($id);
		$this->data['template']='admin/donhang/print';
		$this->data['title']='In đơn hàng <<'.$id.'>>';
		//$this->data["barcode"] = $this->product_barcode($id,"code128",80);
		$this->load->view('admin/donhang/print', $this->data);
		//echo "<script>alert('Đơn hàng này đã được xử lý nên bạn không thể xóa!');</script>";
		
		
		
	}
	public function deleteone($id)
    {
		$hinhanh = $this->baiviet_model->lay_hinh_bai_viet($id);
		$ok = $this->baiviet_model->xoa_bai_viet($id);
		if($ok)
		{
			$upload_path = './uploads/baiviet/';
			if(file_exists($upload_path.$hinhanh))
				unlink($upload_path.$hinhanh);
		}
		return $ok;
    }
	/*
     * Xoa nhieu danh muc san pham
     */
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				$hinhanh = $this->baiviet_model->lay_hinh_bai_viet($id);
				$ok = $this->baiviet_model->xoa_bai_viet($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/baiviet/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
			}		
			if($ok)
			{
				$this->session->set_flashdata('success', 'Đã xóa thành công!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Chọn ít nhất một dòng muốn xóa!');
		}
		redirect('admin/baiviet','refresh');
    }

    public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bv_trang_thai' => 1);
		if($this->baiviet_model->sua_bai_viet($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baiviet','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bv_trang_thai' => 0);
		if($this->baiviet_model->sua_bai_viet($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baiviet','refresh');
    }
	public function show_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bv_noi_bat' => 1);
		if($this->baiviet_model->sua_bai_viet($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baiviet','refresh');
    }
	public function hide_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bv_noi_bat' => 0);
		if($this->baiviet_model->sua_bai_viet($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baiviet','refresh');
    }
	public function show_focus()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bv_tieu_diem' => 1);
		if($this->baiviet_model->sua_bai_viet($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baiviet','refresh');
    }
	public function hide_focus()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bv_tieu_diem' => 0);
		if($this->baiviet_model->sua_bai_viet($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baiviet','refresh');
    }
	 
}
