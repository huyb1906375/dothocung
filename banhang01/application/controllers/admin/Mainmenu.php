<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainmenu extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='mainmenu';
	}
	public function index()
	{
		$this->data['title']='Menu chính - SVSoft';
		
		$this->data['template']='admin/mainmenu/index';
		$this->load->view('admin/index', $this->data);  
	}
	public function add()
	{
		$id = date('YmdHis');
		$this->form_validation->set_rules('txtTen', 'Tên menu', 'required');
		$this->form_validation->set_rules('txtLink', 'Link', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('cm_id_parent',$this->input->post('cboMenuCha'));
			$this->session->set_userdata('cm_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
			$mydata= array(
				'cm_id' => $id,
				'cm_ten' => $this->input->post('txtTen'),
				'cm_slug' => $this->alias->str_alias($this->input->post('txtTen')),
				'cm_mo_ta' => "",
				'cm_trang_thai' => $this->input->post('cboTrangThai'),
				'cm_noi_bat' => 0,
				'cm_thu_tu' => date('YmdHis'),
				'cm_id_parent' => $this->input->post('cboMenuCha'),
				'cm_menu' => 1,
				'cm_link' => $this->input->post('txtLink'),
				'cm_loai_link' => $this->input->post('cboLoaiLink'),
				'cm_module' => 'mainmenu',
				'cm_loai' => 'menu'
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
			else
			{
				$mydata['cm_hinh'] = '';
				
			}
			if($this->chuyenmuc_model->them_chuyen_muc($mydata))
			{
				
				$this->session->set_flashdata('success', 'Thêm menu thành công');
				$this->session->set_userdata('cm_id_parent',$this->input->post('cboMenuCha'));
				$this->session->set_userdata('cm_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/mainmenu/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được menu này!');
				$this->data['template']='admin/mainmenu/add';
				$this->data['title']='Thêm menu chính - SVSoft';
				
			}
		} 
		else 
		{
			$this->data['template']='admin/mainmenu/add';
			$this->data['title']='Thêm menu chính - SVSoft';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($id);
		$this->session->set_userdata('cm_id_parent',$row["cm_id_parent"]);
		$this->session->set_userdata('cm_loai_link',$row["cm_loai_link"]);
		$this->session->set_userdata('cm_trang_thai',$row["cm_trang_thai"]);
		$this->data['row']=$row;
		$hinhanh = $this->chuyenmuc_model->lay_hinh_chuyen_muc($id);
		$this->form_validation->set_rules('txtTen', 'Tên menu', 'required');
		$this->form_validation->set_rules('txtLink', 'Link', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('cm_id_parent',$this->input->post('cboMenuCha'));
			$this->session->set_userdata('cm_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
			$mydata= array(
				'cm_ten' => $this->input->post('txtTen'),
				'cm_slug' => $this->alias->str_alias($this->input->post('txtTen')),
				'cm_mo_ta' => "",
				'cm_trang_thai' => $this->input->post('cboTrangThai'),
				'cm_noi_bat' => 0,
				'cm_id_parent' => $this->input->post('cboMenuCha'),
				'cm_menu' => 1,
				'cm_link' => $this->input->post('txtLink'),
				'cm_loai_link' => $this->input->post('cboLoaiLink'),
				'cm_module' => 'mainmenu',
				'cm_loai' => 'menu'
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
				
				$this->session->set_flashdata('success', 'Sửa menu thành công');
				$this->session->set_userdata('cm_id_parent',$this->input->post('cboMenuCha'));
				$this->session->set_userdata('cm_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('cm_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/mainmenu','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không sửa được menu này!');
				$this->data['template']='admin/mainmenu/edit';
				$this->data['title']='Sửa menu - SutekCMS';
				
			}
		} 
		else 
		{
			$this->data['template']='admin/mainmenu/edit';
			$this->data['title']='Sửa menu - SutekCMS';
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
        redirect('admin/mainmenu','refresh');
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
		redirect('admin/mainmenu','refresh');
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
        redirect('admin/mainmenu','refresh');
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
        redirect('admin/mainmenu','refresh');
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
        redirect('admin/mainmenu','refresh');
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
        redirect('admin/mainmenu','refresh');
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
        redirect('admin/mainmenu','refresh');
    }
}
