<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nhanvien extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='nhanvien';
	}
	public function index()
	{
		
		$this->data['title']='Nhân viên - SutekCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		
		$limit=10;
		
		$this->load->library('phantrang');
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->nhanvien_model->lay_danh_sach_nhan_vien());
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/nhanvien/page');
		$this->data['nhanvien_list']= $this->nhanvien_model->lay_danh_sach_nhan_vien_gioi_han($limit,$first);
		$this->data['template']='admin/nhanvien/index';
		$this->data['com']='nhanvien';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('ymdHis');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTen', 'Họ tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'nv_id' => $id,
				'nv_ten' => $this->input->post('txtTen'),
				'nv_dien_thoai' => $this->input->post('txtDienThoai'),				
				'nv_email' => $this->input->post('txtEmail'),
				'nv_zalo' => $this->input->post('txtZalo'),
				'nv_yahoo' => $this->input->post('txtYahoo'),
				'nv_sky' => $this->input->post('txtSky'),
				'nv_trang_thai' => $this->input->post('cboTrangThai')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/nhanvien/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['nv_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['nv_hinh']='';
				}
			}
			else $mydata['nv_hinh']='';
			if($this->nhanvien_model->them_nhan_vien($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm nhân viên thành công');								
				$this->session->set_userdata('nv_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/nhanvien/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được nhân viên này!');
				$this->data['template']='admin/nhanvien/add';
				$this->data['title']='Thêm nhân viên - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/nhanvien/add';
			$this->data['title']='Thêm nhân viên - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->nhanvien_model->lay_thong_tin_nhan_vien($id);
		$hinhanh = $this->nhanvien_model->lay_hinh_nhan_vien($id);
		$this->form_validation->set_rules('txtTen', 'Họ tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'nv_ten' => $this->input->post('txtTen'),
				'nv_dien_thoai' => $this->input->post('txtDienThoai'),				
				'nv_email' => $this->input->post('txtEmail'),
				'nv_zalo' => $this->input->post('txtZalo'),
				'nv_yahoo' => $this->input->post('txtYahoo'),
				'nv_sky' => $this->input->post('txtSky'),
				'nv_trang_thai' => $this->input->post('cboTrangThai')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/nhanvien/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['nv_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/nhanvien/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['nv_hinh']='';
				}
			}
			else
			{
				$mydata['nv_hinh'] = $hinhanh;
				
			}
			if($this->nhanvien_model->sua_nhan_vien($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa nhân viên thành công');								
				$this->session->set_userdata('nv_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/nhanvien','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không sửa được thông tin nhân viên này!');
				$this->data['template']='admin/nhanvien/edit';
				$this->data['title']='Sửa nhân viên - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/nhanvien/edit';
			$this->data['title']='Sửa nhân viên - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->nhanvien_model->lay_hinh_nhan_vien($id);
		if($this->nhanvien_model->xoa_nhan_vien($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/nhanvien/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/nhanvien','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				$hinhanh = $this->nhanvien_model->lay_hinh_nhan_vien($id);
				$ok = $this->nhanvien_model->xoa_nhan_vien($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/nhanvien/';
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
		redirect('admin/nhanvien','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('nv_trang_thai' => 1);
		if($this->nhanvien_model->sua_nhan_vien($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/nhanvien','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('nv_trang_thai' => 0);
		if($this->nhanvien_model->sua_nhan_vien($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/nhanvien','refresh');
    }
	
}
