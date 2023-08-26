<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tinhthanh extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='tinhthanh';
	}
	public function index()
	{		
		$this->data['title']='Tỉnh thành - SutekCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->tinhthanh_model->lay_danh_sach_tinh_thanh());
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/tinhthanh/page');
		$this->data['list']= $this->tinhthanh_model->lay_danh_sach_tinh_thanh_gioi_han($limit,$first);
		$this->data['template']='admin/tinhthanh/index';
		$this->data['tab']='quanly';
		$this->data['com']='tinhthanh';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$this->form_validation->set_rules('txtTen', 'Tên tỉnh', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'tt_id' => $id,
				'tt_ten' => $this->input->post('txtTen'),
				'tt_mo_ta' => $this->input->post('txtMoTa'),
				'tt_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'tt_trang_thai' => $this->input->post('cboTrangThai')
			);
			
			if($this->tinhthanh_model->them_tinh_thanh($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm thành công!');								
				$this->session->set_userdata('tt_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/tinhthanh/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Thêm thất bại!');
				$this->data['template']='admin/tinhthanh/add';
				$this->data['title']='Thêm tỉnh thành - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/tinhthanh/add';
			$this->data['title']='Thêm tỉnh thanh - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->tinhthanh_model->lay_thong_tin_tinh_thanh($id);
		$this->form_validation->set_rules('txtTen', 'Tên tỉnh', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'tt_ten' => $this->input->post('txtTen'),
				'tt_mo_ta' => $this->input->post('txtMoTa'),
				'tt_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'tt_trang_thai' => $this->input->post('cboTrangThai')
			);
			
			if($this->tinhthanh_model->sua_tinh_thanh($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa thành công!');								
				$this->session->set_userdata('tt_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/tinhthanh','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa thất bại!');
				$this->data['template']='admin/tinhthanh/edit';
				$this->data['title']='Sửa người dùng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/tinhthanh/edit';
			$this->data['title']='Sửa tỉnh thành - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		if($this->tinhthanh_model->xoa_tinh_thanh($id))
		{
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/tinhthanh','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				
				$ok = $this->tinhthanh_model->xoa_tinh_thanh($id);
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
		redirect('admin/tinhthanh','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('tt_trang_thai' => 1);
		if($this->tinhthanh_model->sua_tinh_thanh($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/tinhthanh','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('tt_trang_thai' => 0);
		if($this->tinhthanh_model->sua_tinh_thanh($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/tinhthanh','refresh');
    }
	
}