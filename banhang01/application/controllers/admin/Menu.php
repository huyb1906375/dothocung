<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='menu';
	}
	public function index()
	{
		$this->data['title']='Menu - SutekCMS';
		if($this->input->post('cboLoaiMenu'))
		{
			$this->session->set_userdata('m_loai',$this->input->post('cboLoaiMenu'));
		}
		
		$this->data['template']='admin/menu/index';
		$this->load->view('admin/index', $this->data);  
	}
	public function add()
	{
		//$loai = $this->uri->rsegment(3);
		//$this->data['m_loai']= $loai;
		$this->form_validation->set_rules('txtTen', 'Tên menu', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('m_loai',$this->input->post('cboLoaiMenu'));
			$this->session->set_userdata('m_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('m_id_parent',$this->input->post('cboMenuCha'));
			$mydata= array(
				'm_id' => date('YmdHis'),
				'm_ten' => $this->input->post('txtTen'),
				'm_link' => $this->input->post('txtLink'),
				'm_loai_link' => $this->input->post('cboLoaiLink'),
				'm_id_parent' => $this->input->post('cboMenuCha'),
				'm_thu_tu' => date('YmdHis'),
				'm_loai' => $this->input->post('cboLoaiMenu')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/menu/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['m_hinh']= $data['file_name'];
					
				}
				else
				{
					$mydata['m_hinh']='';
				}
			}
			else
			{
				$mydata['m_hinh'] = '';
				
			}
			if($this->menu_model->them_menu($mydata))
			{
				
				$this->session->set_flashdata('success', 'Thêm menu thành công');
				$this->session->set_userdata('m_loai',$this->input->post('cboLoaiMenu'));
				$this->session->set_userdata('m_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('m_id_parent',$this->input->post('cboMenuCha'));
				redirect('admin/menu/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được menu này!');
				$this->data['template']='admin/menu/add';
				$this->data['title']='Thêm menu - SutekCMS';
				
			}
		} 
		else 
		{
			$this->data['template']='admin/menu/add';
			$this->data['title']='Thêm menu - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->menu_model->lay_thong_tin_menu($id);
		$this->session->set_userdata('m_loai',$row["m_loai"]);
		$this->session->set_userdata('m_loai_link',$row["m_loai_link"]);
		$this->session->set_userdata('m_id_parent',$row["m_id_parent"]);
		$this->data['row']= $row;
		
		$hinhanh = $this->menu_model->lay_hinh_menu($id);
		$this->form_validation->set_rules('txtTen', 'Tên menu', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('m_loai',$this->input->post('cboLoaiMenu'));
			$this->session->set_userdata('m_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('m_id_parent',$this->input->post('cboMenuCha'));
			$mydata= array(
				'm_ten' => $this->input->post('txtTen'),
				'm_link' => $this->input->post('txtLink'),
				'm_loai_link' => $this->input->post('cboLoaiLink'),
				'm_id_parent' => $this->input->post('cboMenuCha'),
				'm_loai' => $this->input->post('cboLoaiMenu')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/menu/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['m_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/menu/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['m_hinh']='';
				}
			}
			else
			{
				$mydata['m_hinh'] = $hinhanh;
				
			}
			if($this->menu_model->sua_menu($mydata, $id))
			{
				
				$this->session->set_flashdata('success', 'Sửa menu thành công');
				$this->session->set_userdata('m_loai',$this->input->post('cboLoaiMenu'));
				$this->session->set_userdata('m_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('m_id_parent',$this->input->post('cboMenuCha'));
				redirect('admin/menu','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không sửa được menu này!');
				$this->data['template']='admin/menu/edit';
				$this->data['title']='Sửa menu - SutekCMS';
				
			}
		} 
		else 
		{
			$this->data['template']='admin/menu/edit';
			$this->data['title']='Sửa menu - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->menu_model->lay_hinh_menu($id);
		if($this->menu_model->xoa_menu($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/menu/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/menu','refresh');
    }
	public function down()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('m_thu_tu' => date('YmdHis'));
		if($this->menu_model->sua_menu($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/menu','refresh');
    }
}
