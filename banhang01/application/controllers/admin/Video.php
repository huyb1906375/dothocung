<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='video';
	}
	public function index()
	{
		$this->data['title']= 'Video - SutekCMS';
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
		if($this->input->post('btnTimKiem'))
		{
			$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
			$this->session->set_userdata('loai',$this->input->post('cboLoai'));
			$this->session->set_userdata('tu_khoa',$this->input->post('txtTuKhoa'));
			$search = $this->alias->str_alias($this->input->post('txtTuKhoa'));
			//$this->data['list'] = $this->video_model->lay_danh_sach_video($this->input->post('cboChuyenMuc'),$this->input->post('cboLoai'),$search);
		}
		else 
		{
			
			$search = $this->alias->str_alias($this->session->userdata('tu_khoa'));
			//$this->data['list'] = $this->video_model->lay_danh_sach_video($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search);
		}
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->video_model->lay_danh_sach_video($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/video/page');
		$this->data['list']= $this->video_model->lay_danh_sach_video_gioi_han($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search, $limit,$first);
		$this->data['template']='admin/video/index';
		$this->data['com']='video';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{			
			$noibat = 0;
			if ($this->input->post('chkNoiBat') == "1")
				$noibat = 1;
			$tieudiem = 0;
			if ($this->input->post('chkTieuDiem') == "1")
				$tieudiem = 1;
			
			$mydata= array(
				'v_id' => $this->input->post('txtID'),
				'v_ten' => $this->input->post('txtTen'),
				'v_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'v_cm_id' => $this->input->post('cboChuyenMuc'),
				'v_tom_tat' => $this->input->post('txtTomTat'),
				'v_chi_tiet' => $this->input->post('txtChiTiet'),
				'v_trang_thai' => $this->input->post('cboTrangThai'),
				'v_thu_tu' => date('YmdHis'),				
				'v_loai_link' => $this->input->post('cboLoaiLink'),
				'v_link' => $this->input->post('txtLink'),
				'v_noi_bat' => $noibat,
				'v_tieu_diem' => $tieudiem,
				'v_ngay_dang' => date("Y-m-d H:i:s"),
				'v_nd_id' => $this->session->userdata('nd_id'),
				'v_luot_xem' => 0
			);
			if($_FILES["fileHinhAnh"]["name"] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/video/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['v_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['v_hinh']='';
				}
			}
			else $mydata['v_hinh']='';
			if($_FILES["fileVanBan"]["name"] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileVanBan"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/video/';
				$config['allowed_types'] = 'pdf|doc|xls';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileVanBan'))
				{
					$data = $this->upload->data();
					$mydata['v_file_van_ban']= $data['file_name'];
				}
				else
				{
					$mydata['v_file_van_ban']='';
				}
			}
			else $mydata['v_file_van_ban']='';
			if($this->video_model->them_video($mydata))
			{
				//$this->data['message'] = 'Thêm chuyên mục thành công';
				$this->session->set_flashdata('success', 'Thêm thành công!');				
				$this->session->set_userdata('loai',$this->input->post('cboLoai'));
				$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
				$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('loai_link',$this->input->post('cboLoaiLink'));
				redirect('admin/video/add','refresh');
			}
			else
			{
				//$this->data['message'] = 'Không thêm được chuyên mục này!';
				$this->session->set_flashdata('error', 'Thêm không thành công!');
				$this->data['template']='admin/video/add';
				$this->data['title']='Thêm video - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['id'] = date('YmdHis');
			$this->data['template']='admin/video/add';
			$this->data['title']='Thêm video - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']= $this->video_model->lay_thong_tin_video($id);
		$hinhanh = $this->video_model->lay_hinh_video($id);
		$vanban = $this->video_model->lay_file_van_ban($id);
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{			
			$noibat = 0;
			if ($this->input->post('chkNoiBat') == "1")
				$noibat = 1;
			$tieudiem = 0;
			if ($this->input->post('chkTieuDiem') == "1")
				$tieudiem = 1;
			//$id = $this->input->post('txtID');
			$mydata= array(
				'v_ten' => $this->input->post('txtTen'),
				'v_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'v_cm_id' => $this->input->post('cboChuyenMuc'),
				'v_tom_tat' => $this->input->post('txtTomTat'),
				'v_chi_tiet' => $this->input->post('txtChiTiet'),
				'v_trang_thai' => $this->input->post('cboTrangThai'),				
				'v_loai_link' => $this->input->post('cboLoaiLink'),
				'v_link' => $this->input->post('txtLink'),
				'v_noi_bat' => $noibat,
				'v_tieu_diem' => $tieudiem,
				'v_ngay_cap_nhat' => date("Y-m-d H:i:s")
				
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/video/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['v_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/video/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['v_hinh']='';
				}
			}
			else 
			{
				$mydata['v_hinh']= $hinhanh;
			}
			if($_FILES["fileVanBan"]['name'] <> '')
			{
				$new_name = date("YmdHis").$this->alias->str_alias($_FILES["fileVanBan"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/video/';
				$config['allowed_types'] = 'pdf|doc|xls';
				$config['max_size'] = 10000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileVanBan'))
				{
					$data = $this->upload->data();
					$mydata['v_file_van_ban']= $data['file_name'];
					if(strlen($vanban) > 0)
					{
						$upload_path = './uploads/baiviet/';
						if(file_exists($upload_path.$vanban))
							unlink($upload_path.$vanban);
					}
				}
				else
				{
					$mydata['v_file_van_ban']='';
				}
			}
			else $mydata['v_file_van_ban']= $vanban;
			if($this->video_model->sua_video($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Đã sửa thành công!');				
				$this->session->set_userdata('loai',$this->input->post('cboLoai'));
				$this->session->set_userdata('cm_id',$this->input->post('cboChuyenMuc'));
				$this->session->set_userdata('trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('loai_link',$this->input->post('cboLoaiLink'));
				redirect('admin/video','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa không thành công!');
				$this->data['template']='admin/video/edit';
				$this->data['title']='Sửa video - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/video/edit';
			$this->data['title']='Sửa video - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
    public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->video_model->lay_hinh_video($id);
		if($this->video_model->xoa_video($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/video/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/video','refresh');
    }
	public function deleteone($id)
    {
		$hinhanh = $this->video_model->lay_hinh_video($id);
		$ok = $this->video_model->xoa_video($id);
		if($ok)
		{
			$upload_path = './uploads/video/';
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
				$hinhanh = $this->video_model->lay_hinh_video($id);
				$ok = $this->video_model->xoa_video($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/video/';
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
		redirect('admin/video','refresh');
    }

    public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('v_trang_thai' => 1);
		if($this->video_model->sua_video($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/video','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('v_trang_thai' => 0);
		if($this->video_model->sua_video($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/video','refresh');
    }
	public function show_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('v_noi_bat' => 1);
		if($this->video_model->sua_video($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/video','refresh');
    }
	public function hide_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('v_noi_bat' => 0);
		if($this->video_model->sua_video($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/video','refresh');
    }
	public function show_focus()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('v_tieu_diem' => 1);
		if($this->video_model->sua_video($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/video','refresh');
    }
	public function hide_focus()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('v_tieu_diem' => 0);
		if($this->video_model->sua_video($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/video','refresh');
    }
	 
}