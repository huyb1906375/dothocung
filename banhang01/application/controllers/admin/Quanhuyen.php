<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quanhuyen extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='quanhuyen';
	}
	public function index()
	{		
		$this->data['title']='Quận huyện - SutekCMS';
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
		if($this->input->post('btnTimKiem'))
		{
			$this->session->set_userdata('tt_id',$this->input->post('cboTinhThanh'));
		}
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->quanhuyen_model->lay_danh_sach_quan_huyen($this->session->userdata('tt_id')));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/quanhuyen/page');
		$this->data['list']= $this->quanhuyen_model->lay_danh_sach_quan_huyen_gioi_han($this->session->userdata('tt_id'),$limit,$first);
		$this->data['template']='admin/quanhuyen/index';
		$this->data['tab']='quanly';
		$this->data['com']='quanhuyen';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$this->form_validation->set_rules('txtTen', 'Tên quận huyện', 'required');
		$this->form_validation->set_rules('cboTinhThanh', 'Tỉnh thành', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'qh_id' => $id,
				'qh_ten' => $this->input->post('txtTen'),
				'qh_mo_ta' => $this->input->post('txtMoTa'),
				'qh_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'qh_trang_thai' => $this->input->post('cboTrangThai'),
				'qh_tt_id' => $this->input->post('cboTinhThanh')
			);
			
			if($this->quanhuyen_model->them_quan_huyen($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm thành công!');	
				$this->session->set_userdata('tt_id',$this->input->post('cboTinhThanh'));							
				$this->session->set_userdata('qh_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/quanhuyen/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Thêm thất bại!');
				$this->data['template']='admin/quanhuyen/add';
				$this->data['title']='Thêm quận huyện - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/quanhuyen/add';
			$this->data['title']='Thêm tỉnh thành - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->quanhuyen_model->lay_thong_tin_quan_huyen($id);
		$this->form_validation->set_rules('txtTen', 'Tên quận huyện', 'required');
		$this->form_validation->set_rules('cboTinhThanh', 'Tỉnh thành', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'qh_ten' => $this->input->post('txtTen'),
				'qh_mo_ta' => $this->input->post('txtMoTa'),
				'qh_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'qh_trang_thai' => $this->input->post('cboTrangThai'),
				'qh_tt_id' => $this->input->post('cboTinhThanh')
			);
			
			if($this->quanhuyen_model->sua_quan_huyen($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa thành công!');
				$this->session->set_userdata('tt_id',$this->input->post('cboTinhThanh'));									
				$this->session->set_userdata('qh_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/quanhuyen','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa thất bại!');
				$this->data['template']='admin/quanhuyen/edit';
				$this->data['title']='Sửa người dùng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/quanhuyen/edit';
			$this->data['title']='Sửa quận huyện - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		if($this->quanhuyen_model->xoa_quan_huyen($id))
		{
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/quanhuyen','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				
				$ok = $this->quanhuyen_model->xoa_quan_huyen($id);
				if(!$ok)
				{
					break;
				}
				
			}		
			if($ok)
			{
				$this->session->set_flashdata('success', 'Xóa thành công!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Xóa thất bại!');
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Chọn ít nhất một dòng muốn xóa!');
		}
		redirect('admin/quanhuyen','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('qh_trang_thai' => 1);
		if($this->quanhuyen_model->sua_quan_huyen($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/quanhuyen','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('qh_trang_thai' => 0);
		if($this->quanhuyen_model->sua_quan_huyen($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/quanhuyen','refresh');
    }
	
}