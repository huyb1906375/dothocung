<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nguoidung extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='hethong';
		$this->data['com']='nguoidung';
	}
	public function index()
	{
		
		$this->data['title']='Người dùng - SutekCMS';
		if($this->input->post('btnXoa'))
		{
			$this->delete_all();
		}
		if($this->input->post('cboViTri'))
		{
			$this->session->set_userdata('vi_tri',$this->input->post('cboViTri'));
		}
		$limit=10;
		if($this->input->post('cboGioiHan'))
		{
			$limit = $this->input->post('cboGioiHan');
			$this->session->set_userdata('limit',$this->input->post('cboGioiHan'));
		}
		else $limit = $this->session->userdata('limit');
		if(!$limit) $limit = 10;
		$this->load->library('phantrang');
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total= count($this->nguoidung_model->lay_danh_sach_nguoi_dung());
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/nguoidung/page');
		$this->data['list']= $this->nguoidung_model->lay_danh_sach_nguoi_dung_gioi_han($limit,$first);
		$this->data['template']='admin/nguoidung/index';
		$this->data['com']='nguoidung';
		$this->load->view('admin/index', $this->data);
        
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$today = date("Y-m-d H:i:s");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTen', 'Họ tên', 'required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'required');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'nd_id' => $id,
				'nd_ten' => $this->input->post('txtTen'),
				'nd_email' => $this->input->post('txtEmail'),
				'nd_ten_dang_nhap' => $this->input->post('txtTenDangNhap'),
				'nd_mat_khau' => md5($this->input->post('txtMatKhau')),
				'nd_trang_thai' => $this->input->post('cboTrangThai')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/nguoidung/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['nd_hinh']= $data['file_name'];
				}
				else
				{
					$mydata['nd_hinh']='';
				}
			}
			else $mydata['nd_hinh']='';
			if($this->nguoidung_model->them_nguoi_dung($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm người dùng thành công');								
				$this->session->set_userdata('nd_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/nguoidung/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được người dùng này!');
				$this->data['template']='admin/nguoidung/add';
				$this->data['title']='Thêm người dùng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/nguoidung/add';
			$this->data['title']='Thêm người dùng - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($id);
		$hinhanh = $this->nguoidung_model->lay_hinh_nguoi_dung($id);
		$this->form_validation->set_rules('txtTen', 'Họ tên', 'required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'required');
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'nd_ten' => $this->input->post('txtTen'),
				'nd_email' => $this->input->post('txtEmail'),
				'nd_ten_dang_nhap' => $this->input->post('txtTenDangNhap'),
				'nd_mat_khau' => md5($this->input->post('txtMatKhau')),
				'nd_trang_thai' => $this->input->post('cboTrangThai')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/nguoidung/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['nd_hinh']= $data['file_name'];
					if(strlen($hinhanh) > 0)
					{
						$upload_path = './uploads/nguoidung/';
						if(file_exists($upload_path.$hinhanh))
							unlink($upload_path.$hinhanh);
					}
				}
				else
				{
					$mydata['nd_hinh']='';
				}
			}
			else
			{
				$mydata['nd_hinh'] = $hinhanh;
				
			}
			if($this->nguoidung_model->sua_nguoi_dung($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Sửa người dùng thành công');								
				$this->session->set_userdata('nd_trang_thai',$this->input->post('cboTrangThai'));
				redirect('admin/nguoidung','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không sửa được thông tin người dùng này!');
				$this->data['template']='admin/nguoidung/edit';
				$this->data['title']='Sửa người dùng - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/nguoidung/edit';
			$this->data['title']='Sửa người dùng - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	
	public function delete()
    {
        $id = $this->uri->rsegment(3);
		$hinhanh = $this->nguoidung_model->lay_hinh_nguoi_dung($id);
		if($this->nguoidung_model->xoa_nguoi_dung($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/nguoidung/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->session->set_flashdata('success', 'Đã xóa thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Không thể xóa dòng này!');
		}
        redirect('admin/nguoidung','refresh');
    }
	
	public function show_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('nd_trang_thai' => 1);
		if($this->nguoidung_model->sua_nguoi_dung($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/nguoidung','refresh');
    }
	public function hide_status()
    {
        $id = $this->uri->rsegment(3);
		$mydata= array('nd_trang_thai' => 0);
		if($this->nguoidung_model->sua_nguoi_dung($mydata, $id))
		{
			$this->session->set_flashdata('success', 'Đã thực hiện thành công!');
		}
        else
		{
			$this->session->set_flashdata('error', 'Thực hiện thất bại!');
		}       
        redirect('admin/nguoidung','refresh');
    }
	public function dangnhap()
	{
		$this->form_validation->set_rules('txtTenDangNhap', 'Tên đăng nhập', 'required|min_length[3]|max_length[32]');
		$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|min_length[3]|max_length[32]');
        if ($this->form_validation->run() ==TRUE)
        {
        	$username = $_POST['txtTenDangNhap'];
        	$password = md5($_POST['txtMatKhau']);
        	if($this->nguoidung_model->dang_nhap($username, $password)!=FALSE)
        	{
        		$row = $this->nguoidung_model->dang_nhap($username, $password);
				$this->session->set_userdata('nd_id',$row['nd_id']);
				$this->session->set_userdata('nd_time',time());
        		//$this->session->set_userdata('nd_tendangnhap',$row['nd_tendangnhap']);
        		//$this->session->set_userdata('nd_ten',$row['nd_ten']);
        		//$this->session->set_userdata('nd_hinhanh',$row['nd_hinhanh']);
        		//$this->session->set_userdata('access',$row['access']);
        		redirect('admin','refresh');
        	}
        	else
	        {
	        	$data['error']='Tên đăng nhập hoặc mật khẩu không chính xác!';
	        	$this->load->view('admin/login/index', $this->data);
	        }
        }
        else
        {
        	$this->load->view('admin/login/index');
        }
	}

	public function dangxuat()
	{
		$array_items = array('nd_id', 'nd_time');
        $this->session->unset_userdata($array_items);
		redirect('admin','refresh');
	}
}
