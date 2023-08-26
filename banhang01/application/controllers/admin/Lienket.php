<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lienket extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='quanly';
		$this->data['com']='lienket';
	}
	public function index()
	{
		$this->data['title']= 'SutekCMS - Liên kết';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		if($this->input->post('cboViTri'))
		{
			$this->session->set_userdata('lk_vi_tri',$this->input->post('cboViTri'));
		}
		if($this->input->post('cboLoai'))
		{
			$this->session->set_userdata('loai',$this->input->post('cboLoai'));
		}
		$this->data['list']= $this->lienket_model->lay_danh_sach_lien_ket($this->session->userdata('loai'),$this->session->userdata('lk_vi_tri'));
		$this->data['template']='admin/lienket/index';
		$this->data['com']='lienket';
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
			$this->session->set_userdata('lk_vi_tri',$this->input->post('cboViTri'));
			$this->session->set_userdata('lk_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('lk_trang_thai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('lk_noi_bat',$this->input->post('cboNoiBat'));
			$mydata= array(
				'lk_id' => $id,
				'lk_ten' => $this->input->post('txtTen'),
				'lk_link' => $this->input->post('txtLink'),
				'lk_loai_link' => $this->input->post('cboLoaiLink'),
				'lk_mo_ta' => $this->input->post('txtMoTa'),
				'lk_trang_thai' => $this->input->post('cboTrangThai'),
				'lk_noi_bat' => $this->input->post('cboNoiBat'),
				'lk_thu_tu' => date('YmdHis'),				
				'lk_vi_tri' => $this->input->post('cboViTri')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/lienket/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['lk_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['lk_hinh']='';
				}
			}
			else $mydata['lk_hinh']='';
			if($this->lienket_model->them_lien_ket($mydata))
			{
				//$this->data['message'] = 'Thêm chuyên mục thành công';
				$this->session->set_flashdata('success', 'Thêm thành công');	
				$this->session->set_userdata('lk_vi_tri',$this->input->post('cboViTri'));
				$this->session->set_userdata('lk_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('lk_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('lk_noi_bat',$this->input->post('cboNoiBat'));
				redirect('admin/lienket/add','refresh');
			}
			else
			{
				//$this->data['message'] = 'Không thêm được chuyên mục này!';
				$this->session->set_flashdata('error', 'Không thêm được!');
				$this->data['template']='admin/lienket/add';
				$this->data['title']='SutekCMS - Thêm liên kết mới';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/lienket/add';
			$this->data['title']='SutekCMS - Thêm liên kết mới';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$row = $this->lienket_model->lay_thong_tin_lien_ket($id);
		$this->session->set_userdata('lk_vi_tri',$row["lk_vi_tri"]);
		$this->session->set_userdata('lk_loai_link',$row["lk_loai_link"]);
		$this->session->set_userdata('lk_trang_thai',$row["lk_trang_thai"]);
		$this->session->set_userdata('lk_noi_bat',$row["lk_noi_bat"]);
		$this->data['row'] = $row;
		$hinhanh = $this->lienket_model->lay_hinh_lien_ket($id);
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{	
			$this->session->set_userdata('lk_vi_tri',$this->input->post('cboViTri'));
			$this->session->set_userdata('lk_loai_link',$this->input->post('cboLoaiLink'));
			$this->session->set_userdata('lk_trang_thai',$this->input->post('cboTrangThai'));
			$this->session->set_userdata('lk_noi_bat',$this->input->post('cboNoiBat'));
			$mydata= array(
				'lk_id' => $id,
				'lk_ten' => $this->input->post('txtTen'),
				'lk_link' => $this->input->post('txtLink'),
				'lk_loai_link' => $this->input->post('cboLoaiLink'),
				'lk_mo_ta' => $this->input->post('txtMoTa'),
				'lk_trang_thai' => $this->input->post('cboTrangThai'),
				'lk_noi_bat' => $this->input->post('cboNoiBat'),			
				'lk_vi_tri' => $this->input->post('cboViTri')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/lienket/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['lk_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/lienket/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['lk_hinh']='';
				}
			}
			else
			{
				$mydata['lk_hinh'] = $hinhanh;
				
			}
			if($this->lienket_model->sua_lien_ket($mydata, $id))
			{
				
				$this->session->set_flashdata('success', 'Sửa thành công');
				$this->session->set_userdata('lk_vi_tri',$this->input->post('cboViTri'));
				$this->session->set_userdata('lk_loai_link',$this->input->post('cboLoaiLink'));
				$this->session->set_userdata('lk_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('lk_noi_bat',$this->input->post('cboNoiBat'));
				
				redirect('admin/lienket','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được!');
				$this->data['template']='admin/lienket/edit';
				$this->data['title']='SutekCMS - Sửa liên kết mới';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/lienket/edit';
			$this->data['title']='SutekCMS - Sửa liên kết mới';
			$this->load->view('admin/index', $this->data);
		}
	}

    public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->lienket_model->lay_hinh_lien_ket($id);
		if($this->lienket_model->xoa_lien_ket($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/lienket/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/lienket','refresh');
    }
	public function deleteone($id)
    {
		$hinhanh = $this->lienket_model->lay_hinh_lien_ket($id);
		$ok = $this->lienket_model->xoa_lien_ket($id);
		if($ok)
		{
			$upload_path = './uploads/lienket/';
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
				$hinhanh = $this->lienket_model->lay_hinh_lien_ket($id);
				$ok = $this->lienket_model->xoa_lien_ket($id);
				if(!$ok)
				{
					break;
				}
				else
				{					
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/lienket/';
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
		redirect('admin/lienket','refresh');
    }
	public function down()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('lk_thu_tu' => date('YmdHis'));
		if($this->lienket_model->sua_lien_ket($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/lienket','refresh');
    }
    public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('lk_trang_thai' => 1);
		if($this->lienket_model->sua_lien_ket($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/lienket','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('lk_trang_thai' => 0);
		if($this->lienket_model->sua_lien_ket($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/lienket','refresh');
    }
	public function show_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('lk_noi_bat' => 1);
		if($this->lienket_model->sua_lien_ket($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/lienket','refresh');
    }
	public function hide_hot()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('lk_noi_bat' => 0);
		if($this->lienket_model->sua_lien_ket($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/lienket','refresh');
    }
	public function show_position()
    {
        $id = $this->uri->rsegment(3);
		$pos = $this->uri->rsegment(4);
		if($pos == 'top')
			$pos = 'lk_tren';
		if($pos == 'bottom')
			$pos = 'lk_duoi';
		if($pos == 'left')
			$pos = 'lk_trai';
		if($pos == 'right')
			$pos = 'lk_phai';
		if($pos == 'middle')
			$pos = 'lk_giua';
		if($pos == 'free')
			$pos = 'lk_tu_do';
		$mydata= array($pos => 1);
		if($this->lienket_model->sua_lien_ket($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}        
        redirect('admin/lienket','refresh');
    }
	public function hide_position()
    {
        $id = $this->uri->rsegment(3);
		$pos = $this->uri->rsegment(4);
		if($pos == 'top')
			$pos = 'lk_tren';
		if($pos == 'bottom')
			$pos = 'lk_duoi';
		if($pos == 'left')
			$pos = 'lk_trai';
		if($pos == 'right')
			$pos = 'lk_phai';
		if($pos == 'middle')
			$pos = 'lk_giua';
		if($pos == 'free')
			$pos = 'lk_tu_do';
		$mydata= array($pos => 0);
		if($this->lienket_model->sua_lien_ket($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}
        redirect('admin/lienket','refresh');
    }	
}