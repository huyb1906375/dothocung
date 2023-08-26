<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Giaodich extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='giaodich';
	}
	public function index()
	{
		$this->data['title']='Giao dịch - SakiCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		$limit=10;
		/*
		if($this->input->post('cboGioiHan'))
		{
			$limit = $this->input->post('cboGioiHan');
			$this->session->set_userdata('limit',$this->input->post('cboGioiHan'));
		}
		else $limit = $this->session->userdata('limit');
		if(!$limit) $limit = 10;
		*/
		if($this->input->post())
		{
			$this->session->set_userdata('nd_id',$this->input->post('cboNguoiDung'));
		}
		$this->load->library('phantrang');
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->giaodich_model->lay_danh_sach_giao_dich($this->session->userdata('nd_id')));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/giaodich/page');
		$this->data['list']= $this->giaodich_model->lay_danh_sach_giao_dich_gioi_han($this->session->userdata('nd_id'),$limit,$first);
		//$this->data['list']= $this->giaodich_model->lay_danh_sach_giao_dich2($this->session->userdata('nd_id'));
		$this->data['template']='admin/giaodich/index';
		$this->data['tab']='quanly';
		$this->data['com']='giaodich';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('ymdHis');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtNoiDung', 'Nội dung', 'required');
		$this->form_validation->set_rules('cboNguoiDung', 'Người dùng', 'required');
		$this->form_validation->set_rules('txtSoTien','Số tiền', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('nd_id',$this->input->post('cboNguoiDung'));
			$sotien = $this->input->post('txtSoTien');
			if(strlen($sotien) == 0)
				$sotien = 0;
			else $sotien = str_replace(",", "",$sotien);
			$mydata= array(
				'gd_id' => $id,
				'gd_thoi_gian' => date("Y-m-d H:i:s"),
				'gd_noi_dung' => $this->input->post('txtNoiDung'),
				'gd_so_tien' => $sotien,
				'gd_nd_id' => $this->input->post('cboNguoiDung')
			);
			
			if($this->giaodich_model->them_giao_dich($mydata))
			{
				
				$this->session->set_flashdata('success', 'Thêm thành công!');										
				redirect('admin/giaodich/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Thêm thất bại!');
				$this->data['template']='admin/giaodich/add';
				$this->data['title']='Thêm Giao dịch - SakiCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/giaodich/add';
			$this->data['title']='Thêm giao dịch - SakiCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->giaodich_model->lay_thong_tin_giao_dich($id);
		$this->session->set_userdata('nd_id',$row["gd_nd_id"]);
		$this->data['row'] = $row;
		$this->load->library('alias');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtNoiDung', 'Nội dung', 'required');
		$this->form_validation->set_rules('cboNguoiDung', 'Người dùng', 'required');
		$this->form_validation->set_rules('txtSoTien','Số tiền', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->session->set_userdata('nd_id',$this->input->post('cboNguoiDung'));
			$sotien = $this->input->post('txtSoTien');
			if(strlen($sotien) == 0)
				$sotien = 0;
			else $sotien = str_replace(",", "",$sotien);
			$mydata= array(
				'gd_id' => $id,
				'gd_noi_dung' => $this->input->post('txtNoiDung'),
				'gd_so_tien' => $sotien,
				'gd_nd_id' => $this->input->post('cboNguoiDung')
			);
			
			if($this->giaodich_model->sua_giao_dich($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa thành công!');	
				redirect('admin/giaodich','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Sửa thất bại!');
				$this->data['template']='admin/giaodich/edit';
				$this->data['title']='Sửa người dùng - SakiCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/giaodich/edit';
			$this->data['title']='Sửa Giao dịch - SakiCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		
		if($this->giaodich_model->xoa_giao_dich($id))
		{
			
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/giaodich','refresh');
    }
	public function delete_all()
    {
		$ids = $this->input->post('id');	
		if(!empty($ids))
		{
			$ok = true;
			foreach ($ids as $id)
			{
				
				$ok = $this->giaodich_model->xoa_giao_dich($id);
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
		redirect('admin/giaodich','refresh');
    }
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('gd_trang_thai' => 1);
		if($this->giaodich_model->sua_giao_dich($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/giaodich','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('gd_trang_thai' => 0);
		if($this->giaodich_model->sua_giao_dich($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/giaodich','refresh');
    }
	
}