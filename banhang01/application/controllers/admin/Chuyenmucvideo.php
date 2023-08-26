<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chuyenmucvideo extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='chuyenmucvideo';
	}
	public function index()
	{
		$this->data['template']='admin/chuyenmucvideo/index';
		$this->data['title']='Chuyên mục - SutekCMS';
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
		$this->form_validation->set_rules('txtTen', 'Tên chuyên mục', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			
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
				'cm_link' => "/chuyen-muc-video/".$this->alias->str_alias($this->input->post('txtTen')).".html",
				'cm_loai_link' => '_parent',
				'cm_module' => 'chuyenmucvideo',
				'cm_loai' => 'chuyen-muc-video'
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/chuyenmuc/';
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
				$this->session->set_flashdata('success', 'Thêm chuyên mục thành công');				
				$this->session->set_userdata('cm_id_parent',$this->input->post('cboChuyenMucCha'));
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
				$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
				redirect('admin/chuyenmucvideo/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được chuyên mục video này!');
				$this->data['template']='admin/chuyenmucvideo/add';
				$this->data['title']='Thêm chuyên mục video - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/chuyenmucvideo/add';
			$this->data['title']='Thêm chuyên mục video - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->chuyenmuc_model->lay_thong_tin_chuyen_muc($id);
		$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
		$this->form_validation->set_rules('txtTen', 'Tên chuyên mục', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$mydata= array(
				'cm_ten' => $this->input->post('txtTen'),
				'cm_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'cm_mo_ta' => $this->input->post('txtMoTa'),
				'cm_trang_thai' => $this->input->post('cboTrangThai'),
				'cm_noi_bat' => $this->input->post('cboNoiBat'),
				'cm_id_parent' => $this->input->post('cboChuyenMucCha'),
				'cm_menu' => $this->input->post('cboMenu'),
				'cm_link' => "/chuyen-muc-video/".$this->alias->str_alias($this->input->post('txtTen')).".html",
				'cm_loai_link' => '_parent',
				'cm_module' => 'chuyenmucvideo',
				'cm_loai' => 'chuyen-muc-video'
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/chuyenmuc/';
				$config['allowed_types'] = 'gif|jpg|png';
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
				
				
				$this->session->set_flashdata('success', 'Sửa chuyên mục video thành công');				
				$this->session->set_userdata('cm_id_parent',$this->input->post('cboChuyenMucCha'));
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('cm_noi_bat',$this->input->post('cboNoiBat'));
				$this->session->set_userdata('cm_menu',$this->input->post('cboMenu'));
				redirect('admin/chuyenmucvideo','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không sửa được chuyên mục video này!');
				$this->data['template']='admin/chuyenmucvideo/edit';
				$this->data['title']='Sửa chuyên mục video - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/chuyenmucvideo/edit';
			$this->data['title']='Sửa chuyên mục video - SutekCMS';
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
        redirect('admin/chuyenmucvideo','refresh');
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
		redirect('admin/chuyenmuc','refresh');
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
        redirect('admin/chuyenmucvideo','refresh');
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
        redirect('admin/chuyenmucvideo','refresh');
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
        redirect('admin/chuyenmucvideo','refresh');
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
        redirect('admin/chuyenmucvideo','refresh');
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
        redirect('admin/chuyenmucvideo','refresh');
    }
	
}
