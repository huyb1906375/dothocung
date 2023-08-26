<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Khachhang extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='khachhang';
	}
	public function index()
	{
		
		$this->data['title']='Khách hàng - SutekCMS';
		/*if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}*/
		$search = "";
		if($this->input->post())
		{
			$this->session->set_userdata('tu_khoa',$this->input->post('txtTuKhoa'));
			$search = $this->utils->create_string_search($this->input->post('txtTuKhoa'));
		}
		else 
		{
			$search = $this->utils->create_string_search($this->session->userdata('tu_khoa'));
		}
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->khachhang_model->lay_danh_sach_khach_hang($search,0,0));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/khachhang/page');
		$this->data['khachhang_list']= $this->khachhang_model->lay_danh_sach_khach_hang($search,$limit,$first);
		$this->data['template']='admin/khachhang/index';
		$this->data['com']='khachhang';
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
			$ipwan = $this->utils->getIPWan();
			$mydata= array(
				'dt_id' => $id,
				'dt_ten' => $this->input->post('txtTen'),
				'dt_dia_chi' => $this->input->post('txtDiaChi'),
				'dt_dien_thoai' => $this->input->post('txtDienThoai'),				
				'dt_email' => $this->input->post('txtEmail'),
				'dt_username' => $this->input->post('txtTenDangNhap'),
				'dt_password' => md5($this->input->post('txtMatKhau')),
				'dt_ghi_chu' => $this->input->post('txtGhiChu'),
				'dt_search'	=> $this->utils->create_string_search($this->input->post('txtTen').$this->input->post('txtDienThoai').$this->input->post('txtEmail')),
				'dt_trang_thai' => $this->input->post('cboTrangThai'),
				'dt_loai' => 'KH',
				'dt_ngay_dang_ky' =>  date('d/m/Y'),
				'dt_ip' => $ipwan
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/khachhang/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['dt_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['dt_hinh']='';
				}
			}
			else $mydata['dt_hinh']='';
			if($this->khachhang_model->them_khach_hang($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm khách hàng thành công');								
				$this->session->set_userdata('dt_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/khachhang/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được khách hàng này!');
				$this->data['template']='admin/khachhang/add';
				$this->data['title']='Thêm khách hàng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/khachhang/add';
			$this->data['title']='Thêm khách hàng - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->khachhang_model->lay_thong_tin_khach_hang($id);
		$hinhanh = $this->khachhang_model->lay_hinh_khach_hang($id);
		$this->form_validation->set_rules('txtTen', 'Họ tên', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'dt_ten' => $this->input->post('txtTen'),
				'dt_dia_chi' => $this->input->post('txtDiaChi'),
				'dt_dien_thoai' => $this->input->post('txtDienThoai'),				
				'dt_email' => $this->input->post('txtEmail'),
				'dt_username' => $this->input->post('txtTenDangNhap'),
				'dt_ghi_chu' => $this->input->post('txtGhiChu'),
				'dt_search'	=> $this->utils->create_string_search($this->input->post('txtTen').$this->input->post('txtDienThoai').$this->input->post('txtEmail')),
				'dt_trang_thai' => $this->input->post('cboTrangThai')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/khachhang/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['dt_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/khachhang/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['dt_hinh']='';
				}
			}
			else
			{
				$mydata['dt_hinh'] = $hinhanh;
				
			}
			if($this->khachhang_model->sua_khach_hang($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa khách hàng thành công');								
				$this->session->set_userdata('dt_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/khachhang','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không sửa được thông tin khách hàng này!');
				$this->data['template']='admin/khachhang/edit';
				$this->data['title']='Sửa khách hàng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/khachhang/edit';
			$this->data['title']='Sửa khách hàng - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->khachhang_model->lay_hinh_khach_hang($id);
		if($this->khachhang_model->xoa_khach_hang($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/khachhang/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/khachhang','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				$hinhanh = $this->khachhang_model->lay_hinh_khach_hang($id);
				$ok = $this->khachhang_model->xoa_khach_hang($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/khachhang/';
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
		redirect('admin/khachhang','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('dt_trang_thai' => 1);
		if($this->khachhang_model->sua_khach_hang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/khachhang','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('dt_trang_thai' => 0);
		if($this->khachhang_model->sua_khach_hang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/khachhang','refresh');
    }
	
}
