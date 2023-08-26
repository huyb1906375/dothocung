<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanpham extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='sanpham';
	}
	public function index()
	{
		
		$this->data['title']= 'Sản phẩm - SutekCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$limit=10;
		if($this->input->post('cboGioiHan'))
		{
			$limit = $this->input->post('cboGioiHan');
			$this->session->set_userdata('limit',$this->input->post('cboGioiHan'));
		}
		else $limit = $this->session->userdata('limit');
		if(!$limit) $limit = 10;
		$search = "";
		$cm = "";
		$loai = "";
		if($this->input->post())
		{
			$cm = $this->input->post('cboChuyenMuc');
			$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
			$loai = $this->input->post('cboLoai');
			$this->session->set_userdata('loai',$this->input->post('cboLoai'));
			$this->session->set_userdata('tu_khoa',$this->input->post('txtTuKhoa'));
			$search = $this->alias->loai_bo_dau_html($this->input->post('txtTuKhoa'));
			//$this->data['list'] = $this->sanpham_model->lay_danh_sach_san_pham($this->input->post('cboChuyenMuc'),$this->input->post('cboLoai'),$search);
		}
		else 
		{
			$cm = $this->session->userdata('cm_id');
			$loai = $this->session->userdata('loai');
			$search = $this->alias->loai_bo_dau_html($this->session->userdata('tu_khoa'));
			//$this->data['list'] = $this->sanpham_model->lay_danh_sach_san_pham($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search);
		}
		if(!$cm) $cm = "";
		if(!$loai) $nn = "";
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->sanpham_model->lay_danh_sach_san_pham($cm,$loai,$search));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/sanpham/page');
		$this->data['list']= $this->sanpham_model->lay_danh_sach_san_pham_gioi_han($cm,$loai,$search, $limit,$first);
		$this->data['template']='admin/sanpham/index';
		$this->data['com']='sanpham';
		$this->load->view('admin/index', $this->data);
        
	}
	
	public function add()
	{
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{	
			$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
			$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
			$noibat = 0;
			if ($this->input->post('chkNoiBat') == "1")
				$noibat = 1;
			$moi = 0;
			if ($this->input->post('chkMoi') == "1")
				$moi = 1;
			$khuyenmai = 0;
			if ($this->input->post('chkKhuyenMai') == "1")
				$khuyenmai = 1;
			$banchay = 0;
			if ($this->input->post('chkBanChay') == "1")
				$banchay = 1;
			$giaban = $_POST['txtGiaBan'];
			if(strlen($giaban) == 0)
				$giaban = 0;
			else $giaban = str_replace(",", "",$giaban);
			$giathitruong = $_POST['txtGiaThiTruong'];
			if(strlen($giathitruong) == 0)
				$giathitruong = 0;
			else $giathitruong = str_replace(",", "",$giathitruong);
			$giamgia = 0;
			if($giathitruong > 0)
				$giamgia = round(($giathitruong-$giaban)/$giathitruong,2) * 100;
			$mydata= array(
				'sp_id' => $this->input->post('txtID'),
				'sp_ma' => $this->input->post('txtMa'),
				'sp_ten' => $this->input->post('txtTen'),
				'sp_thuoc_tinh1' => "",
				'sp_thuoc_tinh2' => "",
				'sp_thuoc_tinh3' => "",
				'sp_tom_tat' => $this->input->post('txtTomTat'),		
				'sp_chi_tiet' => $this->input->post('txtChiTiet'),
				'sp_chi_tiet2' => $this->input->post('txtChiTiet2'),
				'sp_chi_tiet3' => $this->input->post('txtChiTiet3'),
				'sp_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'sp_cm_id' => $this->input->post('cboChuyenMuc'),				
				'sp_trang_thai' => $this->input->post('cboTrangThai'),
				'sp_thu_tu' => date('YmdHis'),				
				'sp_gia_ban' => $giaban,
				'sp_gia_thi_truong' => $giathitruong,
				'sp_giam_gia' => $giamgia,
				'sp_search' => $this->alias->loai_bo_dau_html($this->input->post('txtMa').$this->input->post('txtTen').$this->input->post('txtTenEn')),
				'sp_noi_bat' => $noibat,
				'sp_moi' => $moi,
				'sp_khuyen_mai' => $khuyenmai,
				'sp_ban_chay' => $banchay,
				'sp_ngay_dang' => date("Y-m-d H:i:s"),
				'sp_nd_id' => $this->session->userdata('nd_id'),
				'sp_luot_xem' => 0,
				'sp_ngay_cap_nhat' => date("Y-m-d H:i:s")
			);
			if($_FILES["fileHinhAnh"]["name"] <> '')
			{
				$new_name =  date("YmdHis").$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/sanpham/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 5000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['sp_hinh']= $data['file_name'];
					
				}
				else
				{
					$mydata['sp_hinh']='';
				}
			}
			else $mydata['sp_hinh']='';
			
			if($this->sanpham_model->them_san_pham($mydata))
			{
				//$this->data['message'] = 'Thêm chuyên mục thành công';
				$this->session->set_flashdata('success', 'Thêm thành công!');				
				$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
				$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/sanpham/add','refresh');
			}
			else
			{
				//$this->data['message'] = 'Không thêm được chuyên mục này!';
				$this->session->set_flashdata('error', 'Thêm thất bại!');
				$this->data['template']='admin/sanpham/add';
				$this->data['title']='Thêm sản phẩm - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['id'] = date('YmdHis');
			$this->data['template']='admin/sanpham/add';
			$this->data['title']='Thêm sản phẩm - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->sanpham_model->lay_thong_tin_san_pham($id);
		$this->session->set_userdata('cm_id',$row["sp_cm_id"]);
		$this->session->set_userdata('trang_thai',$row["sp_trang_thai"]);
		$this->data['row']= $row;
		$hinhanh = $this->sanpham_model->lay_hinh_san_pham($id);
		//$vanban = $this->sanpham_model->lay_file_van_ban_san_pham($id);
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
			$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
			$noibat = 0;
			if ($this->input->post('chkNoiBat') == "1")
				$noibat = 1;
			$moi = 0;
			if ($this->input->post('chkMoi') == "1")
				$moi = 1;
			$khuyenmai = 0;
			if ($this->input->post('chkKhuyenMai') == "1")
				$khuyenmai = 1;
			$banchay = 0;
			if ($this->input->post('chkBanChay') == "1")
				$banchay = 1;
			$giaban = $_POST['txtGiaBan'];
			if(strlen($giaban) == 0)
				$giaban = 0;
			else $giaban = str_replace(",", "",$giaban);
			$giathitruong = $_POST['txtGiaThiTruong'];
			if(strlen($giathitruong) == 0)
				$giathitruong = 0;
			else $giathitruong = str_replace(",", "",$giathitruong);
			$giamgia = 0;
			if($giathitruong > 0)
				$giamgia = round(($giathitruong-$giaban)/$giathitruong,2) * 100;
			$mydata= array(
				'sp_ma' => $this->input->post('txtMa'),				
				'sp_ten' => $this->input->post('txtTen'),
				'sp_thuoc_tinh1' => "",
				'sp_thuoc_tinh2' => "",
				'sp_thuoc_tinh3' => "",
				'sp_tom_tat' => $this->input->post('txtTomTat'),				
				'sp_chi_tiet' => $this->input->post('txtChiTiet'),
				'sp_chi_tiet2' => $this->input->post('txtChiTiet2'),
				'sp_chi_tiet3' => $this->input->post('txtChiTiet3'),			
				'sp_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'sp_cm_id' => $this->input->post('cboChuyenMuc'),
				'sp_trang_thai' => $this->input->post('cboTrangThai'),				
				'sp_gia_ban' => $giaban,
				'sp_gia_thi_truong' => $giathitruong,
				'sp_giam_gia' => $giamgia,
				'sp_search' => $this->alias->loai_bo_dau_html($this->input->post('txtMa').$this->input->post('txtTen').$this->input->post('txtTenEn')),
				'sp_noi_bat' => $noibat,
				'sp_moi' => $moi,
				'sp_khuyen_mai' => $khuyenmai,
				'sp_ban_chay' => $banchay,
				'sp_ngay_cap_nhat' => date("Y-m-d H:i:s")
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/sanpham/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 5000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['sp_hinh']= $data['file_name'];
					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/sanpham/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['sp_hinh']='';
				}
			}
			else 
			{
				$mydata['sp_hinh']= $hinhanh;
			}
			
			if($this->sanpham_model->sua_san_pham($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Đã sửa thành công!');	
				$this->session->set_userdata('nn',$this->input->post('cboNgonNgu'));
				//$this->session->set_userdata('loai',$this->input->post('cboLoai'));
				$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
				$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/sanpham','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa không thành công!');
				$this->data['template']='admin/sanpham/edit';
				$this->data['title']='Sửa sản phẩm - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			//$this->data['id'] = date('YmdHis');
			$this->data['template']='admin/sanpham/edit';
			$this->data['title']='Sửa sản phẩm - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
    public function delete()
    {
        //lay id danh mục
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->sanpham_model->lay_hinh_san_pham($id);
		
		if($this->sanpham_model->xoa_san_pham($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/sanpham/';
				if(file_exists($upload_path.$hinhanh))
				{
					unlink($upload_path.$hinhanh);
					$sanphamhinh = $this->sanpham_model->lay_danh_sach_san_pham_hinh($id);
					foreach($sanphamhinh as $sph)
					{
						if(file_exists($upload_path.$sph["sph_url"]))
						{
							unlink($upload_path.$sph["sph_url"]);
						}
					}
				}
			}
			$this->sanpham_model->xoa_san_pham_hinh($id);
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        //tạo ra nội dung thông báo
        
        redirect('admin/sanpham','refresh');
    }
	public function deleteone($id)
    {
		$hinhanh = $this->sanpham_model->lay_hinh_san_pham($id);
		$ok = $this->sanpham_model->xoa_san_pham($id);
		if($ok)
		{
			$upload_path = './uploads/sanpham/';
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
				$hinhanh = $this->sanpham_model->lay_hinh_san_pham($id);
				$ok = $this->sanpham_model->xoa_san_pham($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/sanpham/';
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
		redirect('admin/sanpham','refresh');
    }

    public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('sp_trang_thai' => 1);
		if($this->sanpham_model->sua_san_pham($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/sanpham','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('sp_trang_thai' => 0);
		if($this->sanpham_model->sua_san_pham($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/sanpham','refresh');
    }
	public function show_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('sp_noi_bat' => 1);
		if($this->sanpham_model->sua_san_pham($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/sanpham','refresh');
    }
	public function hide_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('sp_noi_bat' => 0);
		if($this->sanpham_model->sua_san_pham($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/sanpham','refresh');
    }
	public function show_focus()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('sp_tieu_diem' => 1);
		if($this->sanpham_model->sua_san_pham($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/sanpham','refresh');
    }
	public function hide_focus()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('sp_tieu_diem' => 0);
		if($this->sanpham_model->sua_san_pham($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/sanpham','refresh');
    }
	 
}