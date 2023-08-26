<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Danhmuc extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='danhmuc';
	}
	public function index()
	{
		$this->data['template']='admin/danhmuc/index';
		$this->data['title']='Danh mục - SutekCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên danh mục', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('cm_id_parent',$this->input->post('cboChuyenMucCha'));
			$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
			$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
			$mydata= array(
				'cm_id' => $id,
				'cm_ten' => $this->input->post('txtTen'),				
				'cm_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'cm_mo_ta' => $this->input->post('txtMoTa'),
				'cm_trang_thai' => $this->input->post('cboTrangThai'),
				'cm_noi_bat' => $this->input->post('cboNoiBat'),
				'cm_thu_tu' => date('YmdHis'),
				'cm_id_parent' => $this->input->post('cboChuyenMucCha'),
				'cm_menu' => $this->input->post('cboMenu'),
				'cm_link' => "/danh-muc/".$this->alias->str_alias($this->input->post('txtTen')).".html",
				'cm_loai_link' => '_parent',
				'cm_module' => 'danhmuc',
				'cm_loai' => 'danh-muc'
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/chuyenmuc/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['cm_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['cm_hinh']='';
				}
			}
			else $mydata['cm_hinh']='';
			if($this->chuyenmuc_model->them_chuyen_muc($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm danh mục thành công');				
				$this->session->set_userdata('cm_id_parent',$this->input->post('cboChuyenMucCha'));
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
				$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
				redirect('admin/danhmuc/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được danh mục này!');
				$this->data['template']='admin/danhmuc/add';
				$this->data['title']='Thêm danh mục - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/danhmuc/add';
			$this->data['title']='Thêm danh mục - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($id);
		$this->session->set_userdata('cm_id_parent',$row["cm_id_parent"]);
		$this->session->set_userdata('cm_trang_thai',$row["cm_trang_thai"]);
		$this->session->set_userdata('cm_noi_bat',$row["cm_noi_bat"]);
		$this->session->set_userdata('cm_menu',$row["cm_menu"]);		
		$this->data['row'] = $row;
		$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
		$this->form_validation->set_rules('txtTen', 'Tên danh mục', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('cm_id_parent',$this->input->post('cboChuyenMucCha'));
			$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
			$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
			$mydata= array(
				'cm_ten' => $this->input->post('txtTen'),
				'cm_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'cm_mo_ta' => $this->input->post('txtMoTa'),
				'cm_trang_thai' => $this->input->post('cboTrangThai'),
				'cm_noi_bat' => $this->input->post('cboNoiBat'),
				'cm_id_parent' => $this->input->post('cboChuyenMucCha'),
				'cm_menu' => $this->input->post('cboMenu'),
				'cm_link' => "/danh-muc/".$this->alias->str_alias($this->input->post('txtTen')).".html",
				'cm_loai_link' => '_parent',
				'cm_module' => 'danhmuc',
				'cm_loai' => 'danh-muc'
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/chuyenmuc/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['cm_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/chuyenmuc/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['cm_hinh']='';
				}
			}
			else
			{
				$mydata['cm_hinh'] = $hinhanh;
				
			}
			if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
			{
				
				$this->session->set_flashdata('success', 'Sửa danh mục thành công');				
				$this->session->set_userdata('cm_id_parent',$this->input->post('cboChuyenMucCha'));
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
				$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
				redirect('admin/danhmuc','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được danh mục này!');
				$this->data['template']='admin/danhmuc/edit';
				$this->data['title']='Sửa danh mục - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/danhmuc/edit';
			$this->data['title']='Sửa danh mục - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}

    public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
		if($this->chuyenmuc_model->xoa_chuyen_muc($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/chuyenmuc/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/danhmuc','refresh');
    }
	public function deleteone($id)
    {
		$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
		$ok = $this->chuyenmuc_model->xoa_chuyen_muc($id);
		if($ok)
		{
			$upload_path = './uploads/chuyenmuc/';
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
				$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
				$ok = $this->chuyenmuc_model->xoa_chuyen_muc($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/chuyenmuc/';
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
		redirect('admin/danhmuc','refresh');
    }
	public function down()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cm_thu_tu' => date('YmdHis'));
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/danhmuc','refresh');
    }
    public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cm_trang_thai' => 1);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/danhmuc','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cm_trang_thai' => 0);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/danhmuc','refresh');
    }
	public function show_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cm_noi_bat' => 1);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/danhmuc','refresh');
    }
	public function hide_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cm_noi_bat' => 0);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/danhmuc','refresh');
    }
	public function show_menu()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cm_menu' => 1);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/danhmuc','refresh');
    }
	public function hide_menu()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cm_menu' => 0);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/danhmuc','refresh');
    }
	public function show_position()
    {
        $id = $this->uri->rsegment(3);
		$pos = $this->uri->rsegment(4);
		if($pos == 'top')
			$pos = 'cm_tren';
		if($pos == 'bottom')
			$pos = 'cm_duoi';
		if($pos == 'left')
			$pos = 'cm_trai';
		if($pos == 'right')
			$pos = 'cm_phai';
		if($pos == 'middle')
			$pos = 'cm_giua';
		if($pos == 'free')
			$pos = 'cm_tu_do';
		$mydata= array($pos => 1);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}        
        redirect('admin/danhmuc','refresh');
    }
	public function hide_position()
    {
        $id = $this->uri->rsegment(3);
		$pos = $this->uri->rsegment(4);
		if($pos == 'top')
			$pos = 'cm_tren';
		if($pos == 'bottom')
			$pos = 'cm_duoi';
		if($pos == 'left')
			$pos = 'cm_trai';
		if($pos == 'right')
			$pos = 'cm_phai';
		if($pos == 'middle')
			$pos = 'cm_giua';
		if($pos == 'free')
			$pos = 'cm_tu_do';
		$mydata= array($pos => 0);
		if($this->chuyenmuc_model->sua_chuyen_muc($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}
        redirect('admin/danhmuc','refresh');
    }
}