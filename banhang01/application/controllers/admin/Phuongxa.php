<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phuongxa extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='phuongxa';
	}
	public function index()
	{
		$this->data['title']='Phường xã - SutekCMS';
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
			$this->session->set_userdata('qh_id',$this->input->post('cboQuanHuyen'));
		}
		$this->load->library('phantrang');
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->phuongxa_model->lay_danh_sach_phuong_xa($this->session->userdata('tt_id'),$this->session->userdata('qh_id')));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/phuongxa/page');
		$this->data['list']= $this->phuongxa_model->lay_danh_sach_phuong_xa_gioi_han($this->session->userdata('tt_id'),$this->session->userdata('qh_id'),$limit,$first);
		$this->data['template']='admin/phuongxa/index';
		$this->data['tab']='quanly';
		$this->data['com']='phuongxa';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$this->form_validation->set_rules('txtTen', 'Tên phường xã', 'required');
		$this->form_validation->set_rules('cboTinhThanh', 'Tỉnh thành', 'required');
		$this->form_validation->set_rules('cboQuanHuyen', 'Quận huyện', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'px_id' => $id,
				'px_ten' => $this->input->post('txtTen'),
				'px_mo_ta' => $this->input->post('txtMoTa'),
				'px_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'px_trang_thai' => $this->input->post('cboTrangThai'),
				'px_tt_id' => $this->input->post('cboTinhThanh'),
				'px_qh_id' => $this->input->post('cboQuanHuyen')
			);
			
			if($this->phuongxa_model->them_phuong_xa($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm thành công!');	
				$this->session->set_userdata('tt_id',$this->input->post('cboTinhThanh'));	
				$this->session->set_userdata('qh_id',$this->input->post('cboQuanHuyen'));						
				$this->session->set_userdata('px_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/phuongxa/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Thêm thất bại!');
				$this->data['template']='admin/phuongxa/add';
				$this->data['title']='Thêm phường xã - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/phuongxa/add';
			$this->data['title']='Thêm phường xã - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->phuongxa_model->lay_thong_tin_phuong_xa($id);
		$this->form_validation->set_rules('txtTen', 'Tên phường xã', 'required');
		$this->form_validation->set_rules('cboTinhThanh', 'Tỉnh thành', 'required');
		$this->form_validation->set_rules('cboQuanHuyen', 'Quận huyện', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'px_ten' => $this->input->post('txtTen'),
				'px_mo_ta' => $this->input->post('txtMoTa'),
				'px_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'px_trang_thai' => $this->input->post('cboTrangThai'),
				'px_tt_id' => $this->input->post('cboTinhThanh'),
				'px_qh_id' => $this->input->post('cboQuanHuyen')
			);
			
			if($this->phuongxa_model->sua_phuong_xa($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa thành công!');
				$this->session->set_userdata('tt_id',$this->input->post('cboTinhThanh'));
				$this->session->set_userdata('qh_id',$this->input->post('cboQuanHuyen'));									
				$this->session->set_userdata('px_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/phuongxa','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa thất bại!');
				$this->data['template']='admin/phuongxa/edit';
				$this->data['title']='Sửa người dùng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/phuongxa/edit';
			$this->data['title']='Sửa phường xã - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		if($this->phuongxa_model->xoa_phuong_xa($id))
		{
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/phuongxa','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				
				$ok = $this->phuongxa_model->xoa_phuong_xa($id);
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
		redirect('admin/phuongxa','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('px_trang_thai' => 1);
		if($this->phuongxa_model->sua_phuong_xa($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/phuongxa','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('px_trang_thai' => 0);
		if($this->phuongxa_model->sua_phuong_xa($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/phuongxa','refresh');
    }
	
}