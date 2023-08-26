<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cauhinhsite extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='hethong';
		$this->data['com']='cauhinhsite';
	}
	public function index()
	{
		$this->data['view']='index';
		$this->data['title']='Cấu hình site - SutekCMS';
        $id = "site";//$this->uri->rsegment(3);
		$this->data['row']=$this->cauhinhsite_model->lay_thong_tin_cau_hinh_site($id);
		$logo = $this->cauhinhsite_model->lay_logo_cau_hinh_site($id);
		$logo_mobile = $this->cauhinhsite_model->lay_logo_mobile_cau_hinh_site($id);
		$favicon = $this->cauhinhsite_model->lay_favicon_cau_hinh_site($id);
		$banner = $this->cauhinhsite_model->lay_banner_cau_hinh_site($id);
		$hinhnen = $this->cauhinhsite_model->lay_hinh_nen_cau_hinh_site($id);
		$this->load->library('alias');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtTenMien', 'Tên miền', 'required');
		$this->form_validation->set_rules('txtTieuDe', 'Tiêu đề', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$mydata= array(
				'chs_ten_mien' => $this->input->post('txtTenMien'),
				'chs_tieu_de' => $this->input->post('txtTieuDe'),
				'chs_tu_khoa' => $this->input->post('txtTuKhoa'),
				'chs_mo_ta' => $this->input->post('txtMoTa'),
				'chs_bien_tap' => $this->input->post('txtBienTap'),
				'chs_ky_thuat' => $this->input->post('txtKyThuat'),
				'chs_ban_quyen' => $this->input->post('txtBanQuyen'),
				'chs_gioi_thieu' => $this->input->post('txtGioiThieu'),
				'chs_don_vi' => $this->input->post('txtDonVi'),
				'chs_dia_chi' => $this->input->post('txtDiaChi'),
				'chs_dien_thoai' => $this->input->post('txtDienThoai'),
				'chs_email' => $this->input->post('txtEmail'),
				'chs_google_maps' => $this->input->post('txtGoogleMaps'),
				'chs_thong_tin_khac' => $this->input->post('txtThongTinKhac'),
				'chs_facebook' => $this->input->post('txtFacebook'),
				'chs_zalo' => $this->input->post('txtZalo'),
				'chs_youtube' => $this->input->post('txtYoutube'),
				'chs_sky' => $this->input->post('txtSky'),
				'chs_twitter' => $this->input->post('txtTwitter'),
				'chs_instagram' => $this->input->post('txtInstagram'),
				'chs_linkedin' => $this->input->post('txtLinkedIn')
				
			);
			if($_FILES["fileLogo"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileLogo"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|ico';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileLogo'))
				{
					$data = $this->upload->data();
					$mydata['chs_logo']= $data['file_name'];
					if(strlen($logo) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$logo))
							unlink($upload_path.$logo);
					}
				}
				else
				{
					$mydata['chs_logo']='';
				}
			}
			else $mydata['chs_logo'] = $logo;
			
			if($_FILES["fileMobileLogo"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileMobileLogo"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|ico';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileMobileLogo'))
				{
					$data = $this->upload->data();
					$mydata['chs_logo_mobile']= $data['file_name'];
					if(strlen($logo_mobile) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$logo_mobile))
							unlink($upload_path.$logo_mobile);
					}
				}
				else
				{
					$mydata['chs_logo_mobile']='';
				}
			}
			else $mydata['chs_logo_mobile'] = $logo_mobile;
			
			if($_FILES["fileFavicon"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileFavicon"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|ico';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileFavicon'))
				{
					$data = $this->upload->data();
					$mydata['chs_favicon']= $data['file_name'];
					if(strlen($favicon) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$favicon))
							unlink($upload_path.$favicon);
					}
				}
				else
				{
					$mydata['chs_favicon']='';
				}
			}
			else $mydata['chs_favicon'] = $favicon;
			
			if($_FILES["fileBanner"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileBanner"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|ico';
				$config['max_size'] = 5000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileBanner'))
				{
					$data = $this->upload->data();
					$mydata['chs_banner']= $data['file_name'];
					if(strlen($banner) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$banner))
							unlink($upload_path.$banner);
					}
				}
				else
				{
					$mydata['chs_banner']='';
				}
			}
			else $mydata['chs_banner'] = $banner;
			
			if($_FILES["fileHinhNen"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhNen"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|ico';
				$config['max_size'] = 5000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhNen'))
				{
					$data = $this->upload->data();
					$mydata['chs_hinh_nen']= $data['file_name'];
					if(strlen($hinhnen) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$hinhnen))
							unlink($upload_path.$hinhnen);
					}
				}
				else
				{
					$mydata['chs_hinh_nen']='';
				}
			}
			else $mydata['chs_hinh_nen'] = $hinhnen;
			
			if($this->cauhinhsite_model->sua_cau_hinh_site($mydata, $id))
			{
				
				$this->session->set_flashdata('success', 'Cấu hình site thành công');				
				$this->session->set_userdata('chs_menu',$this->input->post('cboMenu'));
				$this->session->set_userdata('chs_id_parent',$this->input->post('cboChuyenMucCha'));
				$this->session->set_userdata('chs_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('chs_noi_bat',$this->input->post('cboNoiBat'));
				redirect('admin/cauhinhsite','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Cấu hình site thất bại!');
				$this->data['template']='admin/cauhinhsite/index';
				$this->data['title']='Cấu hình site - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/cauhinhsite/index';
			$this->data['title']='Cấu hình site - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function add()
	{
		$d=getdate();
		$id = date('YmdHis');
		$today = date("Y-m-d H:i:s");
		$this->form_validation->set_rules('txtTen', 'Tên cấu hình site', 'required');
		$this->form_validation->set_rules('txtThuTu', 'Thứ tự', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$tren = 0;
			if ($this->input->post('chkTren') == "1")
				$tren = 1;
			$duoi = 0;
			if ($this->input->post('chkDuoi') == "1")
				$duoi = 1;
			$trai = 0;
			if ($this->input->post('chkTrai') == "1")
				$trai = 1;
			$phai = 0;
			if ($this->input->post('chkPhai') == "1")
				$phai = 1;
			$giua = 0;
			if ($this->input->post('chkGiua') == "1")
				$giua = 1;
			$tudo = 0;
			if ($this->input->post('chkTuDo') == "1")
				$tudo = 1;
			$mydata= array(
				'chs_id' => $id,
				'chs_ten' => $this->input->post('txtTen'),
				'chs_slug' => $string=$this->alias->str_alias($this->input->post('txtTen')),
				'chs_mo_ta' => $this->input->post('txtMoTa'),
				'chs_trang_thai' => $this->input->post('cboTrangThai'),
				'chs_noi_bat' => $this->input->post('cboNoiBat'),
				'chs_thu_tu' => $this->input->post('txtThuTu'),
				'chs_id_parent' => $this->input->post('cboChuyenMucCha'),
				'chs_loai' => 'danh-muc',
				'chs_tren' => $tren,
				'chs_duoi' => $duoi,
				'chs_trai' => $trai,
				'chs_phai' => $phai,
				'chs_giua' => $giua,
				'chs_tu_do' => $tudo,
				'chs_menu' => $this->input->post('cboMenu')
			);
			if($_FILES["fileHinhAnh"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileHinhAnh"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileHinhAnh'))
				{
					$data = $this->upload->data();
					$mydata['chs_logo']= $data['file_name'];
				}
				else
				{
					$mydata['chs_logo']='';
				}
			}
			else $mydata['chs_logo']='';
			if($this->cauhinhsite_model->them_cau_hinh_site($mydata))
			{
				$this->session->set_flashdata('success', 'Thêm cấu hình site thành công');				
				$this->session->set_userdata('chs_menu',$this->input->post('cboMenu'));
				$this->session->set_userdata('chs_id_parent',$this->input->post('cboChuyenMucCha'));
				$this->session->set_userdata('chs_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('chs_noi_bat',$this->input->post('cboNoiBat'));
				redirect('admin/danhmuc/add','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được cấu hình site này!');
				$this->data['template']='admin/cauhinhsite/add';
				$this->data['title']='Thêm cấu hình site - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/cauhinhsite/add';
			$this->data['title']='Thêm cấu hình site - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$this->data['row']=$this->cauhinhsite_model->lay_thong_tin_cau_hinh_site($id);
		$logo = $this->cauhinhsite_model->lay_logo_cau_hinh_site($id);
		$logo_mobile = $this->cauhinhsite_model->lay_logo_mobile_cau_hinh_site($id);
		$favicon = $this->cauhinhsite_model->lay_favicon_cau_hinh_site($id);
		$this->form_validation->set_rules('txtTenMien', 'Tên miền', 'required');
		$this->form_validation->set_rules('txtTieuDe', 'Tiêu đề', 'required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$mydata= array(
				'chs_ten_mien' => $this->input->post('txtTenMien'),
				'chs_tieu_de' => $this->input->post('txtTieuDe'),
				'chs_tu_khoa' => $this->input->post('txtTuKhoa'),
				'chs_mo_ta' => $this->input->post('txtMoTa'),
				'chs_bien_tap' => $this->input->post('txtBienTap'),
				'chs_ky_thuat' => $this->input->post('txtKyThuat'),
				'chs_ban_quyen' => $this->input->post('txtBanQuyen'),
				'chs_gioi_thieu' => $this->input->post('txtGioiThieu'),
				'chs_don_vi' => $this->input->post('txtDonVi'),
				'chs_dia_chi' => $this->input->post('txtDiaChi'),
				'chs_dien_thoai' => $this->input->post('txtDienThoai'),
				'chs_email' => $this->input->post('txtEmail'),
				'chs_google_maps' => $this->input->post('txtGoogleMaps'),
				'chs_thong_tin_khac' => $this->input->post('txtThongTinKhac'),
				'chs_facebook' => $this->input->post('txtFacebook'),
				'chs_zalo' => $this->input->post('txtZalo'),
				'chs_sky' => $this->input->post('txtSky'),
				'chs_twitter' => $this->input->post('txtTwitter'),
				'chs_instagram' => $this->input->post('txtInstagram'),
				'chs_linkedin' => $this->input->post('txtLinkedIn')
				
			);
			if($_FILES["fileLogo"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileLogo"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|ico';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileLogo'))
				{
					$data = $this->upload->data();
					$mydata['chs_logo']= $data['file_name'];
					if(strlen($logo) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$logo))
							unlink($upload_path.$logo);
					}
				}
				else
				{
					$mydata['chs_logo']='';
				}
			}
			else $mydata['chs_logo'] = $logo;
			
			if($_FILES["fileMobileLogo"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileMobileLogo"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|ico';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileMobileLogo'))
				{
					$data = $this->upload->data();
					$mydata['chs_logo_mobile']= $data['file_name'];
					if(strlen($logo_mobile) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$logo_mobile))
							unlink($upload_path.$logo_mobile);
					}
				}
				else
				{
					$mydata['chs_logo_mobile']='';
				}
			}
			else $mydata['chs_logo_mobile'] = $logo_mobile;
			
			if($_FILES["fileFavicon"]['name'] <> '')
			{
				$new_name = time().$this->alias->str_alias($_FILES["fileFavicon"]['name']);
				$config['file_name'] = $new_name;
				$config['upload_path'] = './uploads/';
				//$config['allowed_types'] = 'gif|jpg|png|ico';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fileFavicon'))
				{
					$data = $this->upload->data();
					$mydata['chs_favicon']= $data['file_name'];
					if(strlen($favicon) > 0)
					{
						$upload_path = './uploads/';
						if(file_exists($upload_path.$favicon))
							unlink($upload_path.$favicon);
					}
				}
				else
				{
					$mydata['chs_favicon']='';
				}
			}
			else $mydata['chs_favicon'] = $favicon;
			
			if($this->cauhinhsite_model->sua_cau_hinh_site($mydata, $id))
			{
				
				$this->session->set_flashdata('success', 'Sửa cấu hình site thành công');				
				$this->session->set_userdata('chs_menu',$this->input->post('cboMenu'));
				$this->session->set_userdata('chs_id_parent',$this->input->post('cboChuyenMucCha'));
				$this->session->set_userdata('chs_trang_thai',$this->input->post('cboTrangThai'));
				$this->session->set_userdata('chs_noi_bat',$this->input->post('cboNoiBat'));
				redirect('admin/cauhinhsite/edit/'.$id,'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Không thêm được cấu hình site này!');
				$this->data['view']='edit';
				$this->data['title']='Sửa cấu hình site - SutekCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['view']='edit';
			$this->data['title']='Sửa cấu hình site - SutekCMS';
			$this->load->view('admin/index', $this->data);
		}
	}

}