<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chucnang extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='hethong';
		$this->data['com']='chucnang';
	}
	public function index()
	{
		$this->data['template']='admin/chucnang/index';
		$this->data['title']='Chức năng - SutekCMS';
		
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$id = date('YmdHis');
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên chức năng', 'required');
		if ($this->form_validation->run() == TRUE) 
		{			
			
			$mydata= array(
				'cn_id' => $id,
				'cn_ten' => $this->input->post('txtTen'),
				'cn_module' => $this->input->post('txtModule'),
				'cn_mo_ta' => $this->input->post('txtMoTa'),
				'cn_trang_thai' => $this->input->post('cboTrangThai'),
				'cn_thu_tu' => date('YmdHis'),
				'cn_id_parent' => $this->input->post('cboChucNangCha')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/chucnang/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['cn_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['cn_hinh']='';
				}
			}
			else $mydata['cn_hinh']='';
			if($this->chucnang_model->them_chuc_nang($mydata))
			{
				//$this->data['message'] = 'Thêm chức năng thành công';
				$this->session->set_flashdata('success', 'Thêm chức năng thành công');				
				$this->session->set_userdata('cn_id_parent',$this->input->post('cboChucNangCha'));
				$this->session->set_userdata('cn_trang_thai',$this->input->post('cboTrangThai'));
				
				redirect('admin/chucnang/add','refresh');
			}
			else
			{
				//$this->data['message'] = 'Không thêm được chức năng này!';
				$this->session->set_flashdata('error', 'Không thêm được chức năng này!');
				$this->data['template']='admin/chucnang/add';
				$this->data['title']='Thêm chức năng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/chucnang/add';
			$this->data['title']='Thêm chức năng - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->chucnang_model->lay_thong_tin_chuc_nang($id);
		$hinhanh = $this->chucnang_model->lay_hinh_chuc_nang($id);
		$this->form_validation->set_rules('txtTen', 'Tên chức năng', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$mydata= array(
				'cn_id' => $id,
				'cn_ten' => $this->input->post('txtTen'),
				'cn_module' => $this->input->post('txtModule'),
				'cn_mo_ta' => $this->input->post('txtMoTa'),
				'cn_trang_thai' => $this->input->post('cboTrangThai'),
				'cn_id_parent' => $this->input->post('cboChucNangCha')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/chucnang/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['cn_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/chucnang/';
						unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['cn_hinh']='';
				}
			}
			else
			{
				$mydata['cn_hinh'] = '';
				if(strlen($hinhanh) > 0)
				{
					$upload_path = './uploads/chucnang/';
					if(file_exists($upload_path.$hinhanh))
						unlink($upload_path.$hinhanh);
				}
			}
			if($this->chucnang_model->sua_chuc_nang($mydata, $id))
			{
				
				$this->session->set_flashdata('success', 'Sửa chức năng thành công');				
				$this->session->set_userdata('cn_id_parent',$this->input->post('cboChucNangCha'));
				$this->session->set_userdata('cn_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('cn_noi_bat',$this->input->post('cboNoiBat'));
				redirect('admin/chucnang','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được chức năng này!');
				$this->data['template']='admin/chucnang/edit';
				$this->data['title']='Sửa chức năng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/chucnang/edit';
			$this->data['title']='Sửa chức năng - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
    public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->chucnang_model->lay_hinh_chuc_nang($id);
		if($this->chucnang_model->xoa_chuc_nang($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/chucnang/';
				unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/chucnang','refresh');
    }
	public function deleteone($id)
    {
		$hinhanh = $this->chucnang_model->lay_hinh_chuc_nang($id);
		$ok = $this->chucnang_model->xoa_chuc_nang($id);
		if($ok)
		{
			$upload_path = './uploads/chucnang/';
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
				$hinhanh = $this->chucnang_model->lay_hinh_chuc_nang($id);
				$ok = $this->chucnang_model->xoa_chuc_nang($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/chucnang/';
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
		redirect('admin/chucnang','refresh');
    }

    public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cn_trang_thai' => 1);
		if($this->chucnang_model->sua_chuc_nang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/chucnang','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cn_trang_thai' => 0);
		if($this->chucnang_model->sua_chuc_nang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/chucnang','refresh');
    }
	public function show_menu()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cn_menu' => 1);
		if($this->chucnang_model->sua_chuc_nang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/chucnang','refresh');
    }
	public function hide_menu()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('cn_menu' => 0);
		if($this->chucnang_model->sua_chuc_nang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/chucnang','refresh');
    }
	public function show_position()
    {
        $id = $this->uri->rsegment(3);
		$pos = $this->uri->rsegment(4);
		if($pos == 'top')
			$pos = 'cn_tren';
		if($pos == 'bottom')
			$pos = 'cn_duoi';
		if($pos == 'left')
			$pos = 'cn_trai';
		if($pos == 'right')
			$pos = 'cn_phai';
		if($pos == 'middle')
			$pos = 'cn_giua';
		if($pos == 'free')
			$pos = 'cn_tu_do';
		$mydata= array($pos => 1);
		if($this->chucnang_model->sua_chuc_nang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}        
        redirect('admin/chucnang','refresh');
    }
	public function hide_position()
    {
        $id = $this->uri->rsegment(3);
		$pos = $this->uri->rsegment(4);
		if($pos == 'top')
			$pos = 'cn_tren';
		if($pos == 'bottom')
			$pos = 'cn_duoi';
		if($pos == 'left')
			$pos = 'cn_trai';
		if($pos == 'right')
			$pos = 'cn_phai';
		if($pos == 'middle')
			$pos = 'cn_giua';
		if($pos == 'free')
			$pos = 'cn_tu_do';
		$mydata= array($pos => 0);
		if($this->chucnang_model->sua_chuc_nang($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}
        redirect('admin/chucnang','refresh');
    }
	 /*
    public function deleteall()
    {
		$ids = $this->input->post('id');
		
		 // If id array is not empty
		if(!empty($ids))
		{
			// Delete records from the database
			$delete = $this->chucnang_model->chuc_nang_xoa($ids);			
			// If delete is successful			
			if($delete)
			{
				$this->session->set_flashdata('success', 'Xóa thành công!');
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
		redirect('admin/chucnang','refresh');
    }
	*/
}
