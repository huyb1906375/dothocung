<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slideshow extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='slideshow';
	}
	public function index()
	{
		$this->data['title']= 'SVSoft - Liên kết';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$this->data['list']= $this->slideshow_model->lay_danh_sach_slideshow("");
		$this->data['template']='admin/slideshow/index';
		$this->data['com']='slideshow';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{				
		$d=getdate();
		$id = date('YmdHis');
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{				
			$this->session->set_userdata('slide_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('slide_trang_thai',$this->input->post('cboTrangThai'));
			$mydata= array(
				'slide_id' => $id,
				'slide_ten' => $this->input->post('txtTen'),
				'slide_link' => $this->input->post('txtLink'),
				'slide_loai_link' => $this->input->post('cboLoaiLink'),
				'slide_mo_ta' => $this->input->post('txtMoTa'),
				'slide_trang_thai' => $this->input->post('cboTrangThai'),
				'slide_thu_tu' => date('YmdHis')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/slideshow/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['slide_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['slide_hinh']='';
				}
			}
			else $mydata['slide_hinh']='';
			if($this->slideshow_model->them_slideshow($mydata))
			{
				//$this->data['message'] = 'Thêm chuyên mục thành công';
				$this->session->set_flashdata('success', 'Thêm thành công');	
				$this->session->set_userdata('slide_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('slide_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/slideshow/add','refresh');
			}
			else
			{
				//$this->data['message'] = 'Không thêm được chuyên mục này!';
				$this->session->set_flashdata('error', 'Không thêm được!');
				$this->data['template']='admin/slideshow/add';
				$this->data['title']='SVSoft - Thêm slideshow mới';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/slideshow/add';
			$this->data['title']='SVSoft - Thêm slideshow mới';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->slideshow_model->lay_thong_tin_slideshow($id);
		$this->session->set_userdata('slide_loai_link',$row["slide_loai_link"]);
		$this->session->set_userdata('slide_trang_thai',$row["slide_trang_thai"]);
		$this->data['row'] = $row;
		$hinhanh = $this->slideshow_model->lay_hinh_slideshow($id);
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{	
			$this->session->set_userdata('slide_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('slide_trang_thai',$this->input->post('cboTrangThai'));
			$mydata= array(
				'slide_id' => $id,
				'slide_ten' => $this->input->post('txtTen'),
				'slide_link' => $this->input->post('txtLink'),
				'slide_loai_link' => $this->input->post('cboLoaiLink'),
				'slide_mo_ta' => $this->input->post('txtMoTa'),
				'slide_trang_thai' => $this->input->post('cboTrangThai')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/slideshow/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['slide_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/slideshow/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['slide_hinh']='';
				}
			}
			else
			{
				$mydata['slide_hinh'] = $hinhanh;
				
			}
			if($this->slideshow_model->sua_slideshow($mydata, $id))
			{
				
				$this->session->set_flashdata('success', 'Sửa thành công');	
				$this->session->set_userdata('slide_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('slide_trang_thai',$this->input->post('cboTrangThai'));				
				redirect('admin/slideshow','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được!');
				$this->data['template']='admin/slideshow/edit';
				$this->data['title']='SVSoft - Sửa slideshow mới';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/slideshow/edit';
			$this->data['title']='SVSoft - Sửa slideshow mới';
			$this->load->view('admin/index', $this->data);
		}
	}

    public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->slideshow_model->lay_hinh_slideshow($id);
		if($this->slideshow_model->xoa_slideshow($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/slideshow/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/slideshow','refresh');
    }
	public function deleteone($id)
    {
		$hinhanh = $this->slideshow_model->lay_hinh_slideshow($id);
		$ok = $this->slideshow_model->xoa_slideshow($id);
		if($ok)
		{
			$upload_path = './uploads/slideshow/';
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
				$hinhanh = $this->slideshow_model->lay_hinh_slideshow($id);
				$ok = $this->slideshow_model->xoa_slideshow($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/slideshow/';
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
		redirect('admin/slideshow','refresh');
    }
	public function down()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('slide_thu_tu' => date('YmdHis'));
		if($this->slideshow_model->sua_slideshow($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/slideshow','refresh');
    }
    public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('slide_trang_thai' => 1);
		if($this->slideshow_model->sua_slideshow($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/slideshow','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('slide_trang_thai' => 0);
		if($this->slideshow_model->sua_slideshow($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/slideshow','refresh');
    }
	public function show_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('slide_noi_bat' => 1);
		if($this->slideshow_model->sua_slideshow($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/slideshow','refresh');
    }
	public function hide_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('slide_noi_bat' => 0);
		if($this->slideshow_model->sua_slideshow($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/slideshow','refresh');
    }
		
}