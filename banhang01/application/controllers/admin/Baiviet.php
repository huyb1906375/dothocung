<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baiviet extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='baiviet';
	}
	public function index()
	{		
		$this->data['title']= 'Bài viết - SutekCMS';
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
		if($this->input->post())
		{
			$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
			$this->session->set_userdata('loai',$this->input->post('cboLoai'));
			$this->session->set_userdata('tu_khoa',$this->input->post('txtTuKhoa'));
			$search = $this->alias->str_alias($this->input->post('txtTuKhoa'));
			//$this->data['list'] = $this->baiviet_model->lay_danh_sach_bai_viet($this->input->post('cboChuyenMuc'),$this->input->post('cboLoai'),$search);
		}
		else 
		{
			
			$search = $this->alias->str_alias($this->session->userdata('tu_khoa'));
			//$this->data['list'] = $this->baiviet_model->lay_danh_sach_bai_viet($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search);
		}
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->baiviet_model->lay_danh_sach_bai_viet($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/baiviet/page');
		$this->data['list']= $this->baiviet_model->lay_danh_sach_bai_viet_gioi_han($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search, $limit,$first);
		$this->data['template']='admin/baiviet/index';
		$this->data['com']='baiviet';
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
			$tieudiem = 0;
			if ($this->input->post('chkTieuDiem') == "1")
				$tieudiem = 1;
			$thutu = str_replace(" ","",preg_replace("/(-|:)/", '',$this->input->post('txtNgayDang')));
			$mydata= array(
				'bv_id' => $this->input->post('txtID'),
				'bv_ten' => $this->input->post('txtTen'),
				'bv_slug' => $string=$this->alias->create_slug($this->input->post('txtTen')),
				'bv_cm_id' => $this->input->post('cboChuyenMuc'),				
				'bv_tom_tat' => $this->input->post('txtTomTat'),
				'bv_chi_tiet' => $this->input->post('txtChiTiet'),
				'bv_trang_thai' => $this->input->post('cboTrangThai'),
				'bv_thu_tu' => $thutu,				
				'bv_loai' => "tin-tuc",
				'bv_loai_link_video' => "youtube",
				'bv_link_video' => "",
				'bv_noi_bat' => $noibat,
				'bv_tieu_diem' => $tieudiem,
				'bv_ngay_dang' => $this->input->post('txtNgayDang'),
				'bv_nd_id' => $this->session->userdata('nd_id'),
				'bv_luot_xem' => 0
			);
			if($_FILES["fileHinhAnh"]["name"] <> '')
			{
				//$file = date('YmdHis').substr($_FILES['fileHinhAnh1']['name'], strrpos($_FILES['fileHinhAnh1']['name'], "."));	
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baiviet/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['bv_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['bv_hinh']='';
				}
			}
			else $mydata['bv_hinh']='';
			/*
			if($_FILES["fileVanBan1"]["name"] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileVanBan1"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baiviet/';
				$config['allowed_types'] = 'pdf|doc|xls';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileVanBan1'))
				{
					$data = $this->upload->data();
					$mydata['bv_file1']= $data['file_name'];
				}
				else
				{
					$mydata['bv_file1']='';
				}
			}
			else $mydata['bv_file1']='';
			if($_FILES["fileVanBan2"]["name"] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileVanBan2"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baiviet/';
				$config['allowed_types'] = 'pdf|doc|xls';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileVanBan2'))
				{
					$data = $this->upload->data();
					$mydata['bv_file2']= $data['file_name'];
				}
				else
				{
					$mydata['bv_file2']='';
				}
			}
			else $mydata['bv_file2']='';
			*/
			$mydata['bv_file1']='';
			$mydata['bv_file2']='';
			if($this->baiviet_model->them_bai_viet($mydata))
			{
				//$this->data['message'] = 'Thêm chuyên mục thành công';
				$this->session->set_flashdata('success', 'Thêm thành công!');				
				//$this->session->set_userdata('loai',$this->input->post('cboLoai'));
				$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));				
				$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
				//$this->session->set_userdata('loai_link_video',$this->input->post('cboLoaiLinkVideo'));
				redirect('admin/baiviet/add','refresh');
			}
			else
			{
				//$this->data['message'] = 'Không thêm được chuyên mục này!';
				$this->session->set_flashdata('error', 'Thêm không thành công!');
				$this->data['template']='admin/baiviet/add';
				$this->data['title']='Thêm bài viết - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['id'] = date('YmdHis');
			$this->data['template']='admin/baiviet/add';
			$this->data['title']='Thêm bài viết - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->baiviet_model->lay_thong_tin_bai_viet($id);
		$this->session->set_userdata('cm_id',$row["bv_cm_id"]);				
		$this->session->set_userdata('trang_thai',$row["bv_trang_thai"]);
		$this->data['row']= $row;
		$hinhanh = $this->baiviet_model->lay_hinh_bai_viet($id);
		//$vanban1 = $this->baiviet_model->lay_file_van_ban1($id);
		//$vanban2 = $this->baiviet_model->lay_file_van_ban2($id);
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{	
			$this->session->set_userdata('nn',$this->input->post('cboNgonNgu'));
			$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));				
			$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
			$noibat = 0;
			if ($this->input->post('chkNoiBat') == "1")
				$noibat = 1;
			$tieudiem = 0;
			if ($this->input->post('chkTieuDiem') == "1")
				$tieudiem = 1;
			//$id = $this->input->post('txtID');
			$thutu = str_replace(" ","",preg_replace("/(-|:)/", '',$this->input->post('txtNgayDang')));
			$mydata= array(
				'bv_ten' => $this->input->post('txtTen'),
				'bv_slug' => $string=$this->alias->create_slug($this->input->post('txtTen')),
				'bv_cm_id' => $this->input->post('cboChuyenMuc'),				
				'bv_tom_tat' => $this->input->post('txtTomTat'),
				'bv_chi_tiet' => $this->input->post('txtChiTiet'),
				'bv_trang_thai' => $this->input->post('cboTrangThai'),
				'bv_thu_tu' => $thutu,	
				'bv_loai' => "tin-tuc",
				'bv_loai_link_video' => "youtube",
				'bv_link_video' => "",
				'bv_noi_bat' => $noibat,
				'bv_tieu_diem' => $tieudiem,
				'bv_ngay_dang' => $this->input->post('txtNgayDang'),
				'bv_ngay_cap_nhat' => date("Y-m-d H:i:s")
				
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baiviet/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['bv_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/baiviet/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['bv_hinh']='';
				}
			}
			else 
			{
				$mydata['bv_hinh']= $hinhanh;
			}
			/*
			if($_FILES["fileVanBan1"]['name'] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileVanBan1"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baiviet/';
				$config['allowed_types'] = 'pdf|doc|xls';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileVanBan1'))
				{
					$data = $this->upload->data();
					$mydata['bv_file1']= $data['file_name'];
					if(strlen($vanban1) > 0)
					{
						$upload_path = './uploads/baiviet/';
						if(file_exists($upload_path.$vanban1))
							unlink($upload_path.$vanban1);
					}
				}
				else
				{
					$mydata['bv_file1']='';
				}
			}
			else $mydata['bv_file1']= $vanban1;
			if($_FILES["fileVanBan2"]['name'] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileVanBan2"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baiviet/';
				$config['allowed_types'] = 'pdf|doc|xls';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileVanBan2'))
				{
					$data = $this->upload->data();
					$mydata['bv_file2']= $data['file_name'];
					if(strlen($vanban2) > 0)
					{
						$upload_path = './uploads/baiviet/';
						if(file_exists($upload_path.$vanban2))
							unlink($upload_path.$vanban2);
					}
				}
				else
				{
					$mydata['bv_file2']='';
				}
			}
			else $mydata['bv_file2']= $vanban2;
			*/
			$mydata['bv_file1']='';
			$mydata['bv_file2']='';
			if($this->baiviet_model->sua_bai_viet($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Đã sửa thành công!');				
				//$this->session->set_userdata('loai',$this->input->post('cboLoai'));
				$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));				
				$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
				//$this->session->set_userdata('loai_link_video',$this->input->post('cboLoaiLinkVideo'));
				redirect('admin/baiviet','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa không thành công!');
				$this->data['template']='admin/baiviet/edit';
				$this->data['title']='Sửa bài viết - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			//$this->data['id'] = date('YmdHis');
			$this->data['template']='admin/baiviet/edit';
			$this->data['title']='Sửa bài viết - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
    public function delete()
    {
        //lay id danh mục
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->baiviet_model->lay_hinh_bai_viet($id);
		//$vanban1 = $this->baiviet_model->lay_file_van_ban1($id);
		//$vanban2 = $this->baiviet_model->lay_file_van_ban2($id);
		if($this->baiviet_model->xoa_bai_viet($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/baiviet/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			/*
			if(strlen($vanban1) > 0)
			{
				$upload_path = './uploads/baiviet/';
				if(file_exists($upload_path.$vanban1))
					unlink($upload_path.$vanban1);
			}
			if(strlen($vanban2) > 0)
			{
				$upload_path = './uploads/baiviet/';
				if(file_exists($upload_path.$vanban2))
					unlink($upload_path.$vanban2);
			}
			*/
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        
        redirect('admin/baiviet','refresh');
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
