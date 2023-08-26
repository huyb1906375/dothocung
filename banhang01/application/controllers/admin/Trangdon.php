<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trangdon extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='trangdon';
	}
	public function index()
	{
		$this->data['template']='admin/trangdon/index';
		$this->data['title']='Trang đơn - SutekCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		if($this->input->post('cboNgonNgu'))
		{
			$this->session->set_userdata('nn',$this->input->post('cboNgonNgu'));
		}
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tiêu đề', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
			$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
			$mydata= array(
				'cm_id' => $id,
				'cm_ten' => $this->input->post('txtTen'),
				'cm_slug' => $this->alias->str_alias($this->input->post('txtTen')),
				'cm_mo_ta' => $this->input->post('txtMoTa'),
				'cm_trang_thai' => $this->input->post('cboTrangThai'),
				'cm_noi_bat' => 0,
				'cm_thu_tu' => date('YmdHis'),
				'cm_id_parent' => 0,
				'cm_menu' => $this->input->post('cboMenu'),
				'cm_link' => "/".$this->alias->str_alias($this->input->post('txtTen')).".html",
				'cm_loai_link' => '_parent',
				'cm_module' => 'trangdon',
				'cm_loai' => 'trang-don'
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/trangdon/';
				$config['allowed_types'] = 'gif|jpg|png';
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
				$this->session->set_flashdata('success', 'Thêm thành công!');	
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
				$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
				redirect('admin/trangdon/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Thêm không thành công!');
				$this->data['template']='admin/trangdon/add';
				$this->data['title']='Thêm trang đơn - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/trangdon/add';
			$this->data['title']='Thêm trang đơn - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($id);
		
		$this->data['row']=$row;
		$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
		$this->form_validation->set_rules('txtTen', 'Tiêu đề', 'required');
		$this->session->set_userdata('cm_trang_thai',$row["cm_trang_thai"]);
		$this->session->set_userdata('cm_noi_bat',$row["cm_noi_bat"]);
		$this->session->set_userdata('cm_menu',$row["cm_menu"]);
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
			$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
			$mydata= array(
				'cm_ten' => $this->input->post('txtTen'),
				'cm_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'cm_mo_ta' => $this->input->post('txtMoTa'),
				'cm_trang_thai' => $this->input->post('cboTrangThai'),
				'cm_noi_bat' => $this->input->post('cboNoiBat'),
				'cm_id_parent' => 0,
				'cm_menu' => $this->input->post('cboMenu'),
				'cm_link' => "/".$this->alias->str_alias($this->input->post('txtTen')).".html",
				'cm_loai_link' => '_parent',
				'cm_module' => 'trangdon',
				'cm_loai' => 'trang-don'
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/trangdon/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['cm_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/trangdon/';
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
				
				$this->session->set_flashdata('success', 'Sửa thành công!');
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
				$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
				redirect('admin/trangdon','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa không thành công!!');
				$this->data['template']='admin/trangdon/edit';
				$this->data['title']='Sửa trang đơn - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/trangdon/edit';
			$this->data['title']='Sửa trang đơn - SutekCMS';
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
				$upload_path = './uploads/trangdon/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/trangdon','refresh');
    }
	public function deleteone($id)
    {
		$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
		$ok = $this->chuyenmuc_model->xoa_chuyen_muc($id);
		if($ok)
		{
			$upload_path = './uploads/trangdon/';
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
						$upload_path = './uploads/trangdon/';
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
		redirect('admin/trangdon','refresh');
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
        redirect('admin/trangdon','refresh');
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
        redirect('admin/trangdon','refresh');
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
        redirect('admin/trangdon','refresh');
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
        redirect('admin/trangdon','refresh');
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
        redirect('admin/trangdon','refresh');
    }
	
}
