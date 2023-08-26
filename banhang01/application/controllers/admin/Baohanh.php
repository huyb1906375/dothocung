<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baohanh extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='baohanh';
	}
	public function index()
	{		
		$this->data['title']='Bảo hành - SVSoft';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$trangthai = 0;
		/*
		if($this->input->post('cboTrangThai'))
		{
			$trangthai = $this->input->post('cboTrangThai');
			$this->session->set_userdata('bh_trang_thai',$this->input->post('cboTrangThai'));
		}
		else $trangthai = $this->session->userdata('bh_trang_thai');	
		*/
		$search = "";
		if($this->input->post())
		{
			$trangthai = $this->input->post('cboTrangThai');
			$this->session->set_userdata('bh_trang_thai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('tu_khoa',$this->input->post('txtTuKhoa'));
			$search = $this->utils->create_string_search($this->input->post('txtTuKhoa'));
		}
		else 
		{
			$trangthai = $this->session->userdata('bh_trang_thai');
			$search = $this->utils->create_string_search($this->session->userdata('tu_khoa'));
		}
		
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->baohanh_model->lay_danh_sach_bao_hanh($search, $trangthai,0,0));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/baohanh/page');
		$this->data['baohanh_list']= $this->baohanh_model->lay_danh_sach_bao_hanh($search, $trangthai,$limit,$first);
		$this->data['template']='admin/baohanh/index';
		$this->data['com']='baohanh';
		$this->load->view('admin/index', $this->data);      
	}
	public function add()
	{
		$id = date('ymdHis');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtNgayLap', 'Ngày lập', 'required');
		$this->form_validation->set_rules('txtSoSeri', 'Số seri', 'required');
		$this->form_validation->set_rules('txtThietBi', 'Tên thiết bị', 'required');
		$this->form_validation->set_rules('txtTinhTrang', 'Tình trạng', 'required');
		$this->form_validation->set_rules('txtKhachHang', 'Khách hàng', 'required');
		$this->form_validation->set_rules('txtDienThoai', 'Số điện thoại', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('bh_trang_thai',$this->input->post('cboTrangThai'));
			$mydata= array(
				'bh_id' => $id,
				'bh_ngay_lap' => $this->input->post('txtNgayLap'),
				'bh_seri' => $this->input->post('txtSoSeri'),
				'bh_thiet_bi' => $this->input->post('txtThietBi'),
				'bh_tinh_trang' => $this->input->post('txtTinhTrang'),
				'bh_khach_hang' => $this->input->post('txtKhachHang'),
				'bh_dien_thoai' => $this->input->post('txtDienThoai'),				
				'bh_ghi_chu' => $this->input->post('txtGhiChu'),
				'bh_trang_thai' => $this->input->post('cboTrangThai'),
				'bh_ngay_tra' => $this->input->post('txtNgayTra'),
				'bh_search' => $this->utils->create_string_search($this->input->post('txtSoSeri').$this->input->post('txtThietBi').$this->input->post('txtKhachHang').$this->input->post('txtDienThoai'))
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baohanh/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 5000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['bh_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['bh_hinh']='';
				}
			}
			else $mydata['bh_hinh']='';
			if($this->baohanh_model->them_bao_hanh($mydata))
			{
				$this->session->set_flashdata('success', 'Đã thêm thành công!');								
				$this->session->set_userdata('bh_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/baohanh/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Đã thêm thất bại!');
				$this->data['template']='admin/baohanh/add';
				$this->data['title']='Thêm bảo hành - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/baohanh/add';
			$this->data['title']='Thêm bảo hành - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$baohanh = $this->baohanh_model->lay_thong_tin_bao_hanh($id);
		$hinhanh = $baohanh["bh_hinh"];
		$this->session->set_userdata('bh_trang_thai',$baohanh["bh_trang_thai"]);
		$this->data['baohanh']= $baohanh;				
		$this->form_validation->set_rules('txtNgayLap', 'Ngày lập', 'required');
		$this->form_validation->set_rules('txtSoSeri', 'Số seri', 'required');
		$this->form_validation->set_rules('txtThietBi', 'Tên thiết bị', 'required');
		$this->form_validation->set_rules('txtTinhTrang', 'Tình trạng', 'required');
		$this->form_validation->set_rules('txtKhachHang', 'Khách hàng', 'required');
		$this->form_validation->set_rules('txtDienThoai', 'Số điện thoại', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('bh_trang_thai',$this->input->post('cboTrangThai'));
			$mydata= array(
				'bh_ngay_lap' => $this->input->post('txtNgayLap'),
				'bh_seri' => $this->input->post('txtSoSeri'),
				'bh_thiet_bi' => $this->input->post('txtThietBi'),
				'bh_tinh_trang' => $this->input->post('txtTinhTrang'),
				'bh_khach_hang' => $this->input->post('txtKhachHang'),
				'bh_dien_thoai' => $this->input->post('txtDienThoai'),				
				'bh_ghi_chu' => $this->input->post('txtGhiChu'),
				'bh_trang_thai' => $this->input->post('cboTrangThai'),
				'bh_ngay_tra' => $this->input->post('txtNgayTra'),
				'bh_search' => $this->utils->create_string_search($this->input->post('txtSoSeri').$this->input->post('txtThietBi').$this->input->post('txtKhachHang').$this->input->post('txtDienThoai'))
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/baohanh/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 5000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['bh_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/baohanh/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['bh_hinh']='';
				}
			}
			else
			{
				$mydata['bh_hinh'] = $hinhanh;
				
			}
			if($this->baohanh_model->sua_bao_hanh($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa bảo hành thành công');								
				$this->session->set_userdata('bh_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/baohanh','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không sửa được thông tin bảo hành này!');
				$this->data['template']='admin/baohanh/edit';
				$this->data['title']='Sửa bảo hành - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/baohanh/edit';
			$this->data['title']='Sửa bảo hành - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->baohanh_model->lay_hinh_bao_hanh($id);
		if($this->baohanh_model->xoa_bao_hanh($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/baohanh/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/baohanh','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				$hinhanh = $this->baohanh_model->lay_hinh_bao_hanh($id);
				$ok = $this->baohanh_model->xoa_bao_hanh($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/baohanh/';
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
		redirect('admin/baohanh','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bh_trang_thai' => 1);
		if($this->baohanh_model->sua_bao_hanh($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baohanh','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('bh_trang_thai' => 0);
		if($this->baohanh_model->sua_bao_hanh($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/baohanh','refresh');
    }
	
}
