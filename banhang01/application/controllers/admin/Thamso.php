<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thamso extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='hethong';
		$this->data['com']='thamso';
	}
	public function index()
	{		
		$this->data['title']='Tham số - SutekCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$search = "";		
		if($this->input->post())
		{
			$this->session->set_userdata('tu_khoa',$this->input->post('txtTuKhoa'));
			$search = $this->alias->loai_bo_dau_html($this->input->post('txtTuKhoa'));
		}
		else 
		{
			$search = $this->alias->loai_bo_dau_html($this->session->userdata('tu_khoa'));
		}
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->thamso_model->lay_danh_sach_tham_so($search));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/thamso/page');
		$this->data['list']= $this->thamso_model->lay_danh_sach_tham_so_gioi_han($search,$limit,$first);
		$this->data['template']='admin/thamso/index';
		//$this->data['tab']='quanly';
		//$this->data['com']='thamso';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$this->form_validation->set_rules('txtMa', 'Mã', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'ts_id' => $id,
				'ts_ma' => $this->input->post('txtMa'),
				'ts_ten' => $this->input->post('txtTen'),
				'ts_mo_ta' => $this->input->post('txtMoTa'),
				'ts_tu_khoa' => $this->alias->loai_bo_dau_html($this->input->post('txtTen').$this->input->post('txtMoTa'))
			);
			
			if($this->thamso_model->them_tham_so($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm thành công!');								
				$this->session->set_userdata('ts_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/thamso/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Thêm thất bại!');
				$this->data['template']='admin/thamso/add';
				$this->data['title']='Thêm tỉnh thành - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/thamso/add';
			$this->data['title']='Thêm tham số - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->thamso_model->lay_thong_tin_tham_so($id);
		$this->form_validation->set_rules('txtTen', 'Tiếng Việt', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'ts_ma' => $this->input->post('txtMa'),
				'ts_ten' => $this->input->post('txtTen'),
				'ts_mo_ta' => $this->input->post('txtMoTa'),
				'ts_tu_khoa' => $this->alias->loai_bo_dau_html($this->input->post('txtTen').$this->input->post('txtMoTa'))
			);
			
			if($this->thamso_model->sua_tham_so($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa thành công!');								
				$this->session->set_userdata('ts_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/thamso','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa thất bại!');
				$this->data['template']='admin/thamso/edit';
				$this->data['title']='Sửa người dùng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/thamso/edit';
			$this->data['title']='Sửa tỉnh thành - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		if($this->thamso_model->xoa_tham_so($id))
		{
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/thamso','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				
				$ok = $this->thamso_model->xoa_tham_so($id);
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
		redirect('admin/thamso','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('ts_trang_thai' => 1);
		if($this->thamso_model->sua_tham_so($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/thamso','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('ts_trang_thai' => 0);
		if($this->thamso_model->sua_tham_so($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/thamso','refresh');
    }
	
}