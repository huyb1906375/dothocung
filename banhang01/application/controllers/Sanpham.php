<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Sanpham extends MY_Controller
{
    function __construct() {
        parent::__construct();
    }
	function tao_breadcrumb($cm_id)
	{
		$str = "";
		$s = "<a href=\"/\"> Trang chủ </a>";
		$s .= "<span class=\"divider\">/</span>";
		if($cm_id != "0")
		{
			$rowcm = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($cm_id);	
			$str = "<a href=\"/chuyen-muc/".$rowcm["cm_slug"]."\"> ".$rowcm["cm_ten"]." </a>";
			if ($rowcm["cm_id_parent"] != "0")
			{
				$rowcm1 = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($rowcm["cm_id_parent"]);				
				$str = "<a href=\"/chuyen-muc/".$rowcm1["cm_slug"]."\"> ".$rowcm1["cm_ten"]." </a>"."<span class=\"divider\">/</span>".$str;
				if ($rowcm1["cm_id_parent"] != "0")
				{
					$rowcm2 = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($rowcm1["cm_id_parent"]);	
					$str = "<a href=\"/chuyen-muc/".$rowcm2["cm_slug"]."\"> ".$rowcm2["cm_ten"]." </a>"." <span class=\"divider\">/</span> ".$str;
					

				}
			}		
		}
		$str = $s.$str;
		return $str;
	}
    public function index()
	{
		$this->session->set_userdata('tukhoa','');
		$this->session->set_userdata('tukhoa2','');
		$url = explode('/', uri_string());
		$slug = str_replace(".html","", $url[1]);
		$chuyenmuc = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc_bang_slug($slug);
		
		$this->data['breadcrumb'] = $this->tao_breadcrumb($chuyenmuc["cm_id"]);
		$this->session->set_userdata('cm_id',$chuyenmuc["cm_id"]);
		$this->data['tab'] = $slug;
		$this->data['slug'] = uri_string();
		$this->data['chuyenmuc']= $chuyenmuc;
		$this->data['title']= $chuyenmuc["cm_ten"]." | ".chs_tieu_de;
		$this->data['keywords'] = $chuyenmuc["cm_ten"]." | ".chs_tieu_de;
		$this->data['description'] = $chuyenmuc["cm_ten"]." | ".chs_tieu_de;
		
		$this->data['image'] = $this->getServerUrl()."/uploads/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$limit = 16;
		/*
		if($this->session->userdata("limit"))
		{
			$limit = $this->session->userdata('limit');
		}
		if($this->input->post('cboGioiHan'))
		{
			$limit = $this->input->post('cboGioiHan');
			$this->session->set_userdata('limit',$this->input->post('cboGioiHan'));
		}
		*/
		
		$order = "Order";
		if($this->session->userdata("order"))
		{
			$order = $this->session->userdata('order');
		}
		if($this->input->post('cboSapXep'))
		{
			$order = $this->input->post('cboSapXep');
			$this->session->set_userdata('order',$this->input->post('cboSapXep'));
		}
		
		$this->load->library('public_phantrang');
		$current=$this->public_phantrang->PageCurrent();
		$first=$this->public_phantrang->PageFirst($limit, $current);
		$total= count($this->sanpham_model->public_lay_danh_sach_san_pham($this->session->userdata('cm_id'),  "", "", 0, 0,""));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->public_phantrang->PagePer($total, $current, $limit, $url= "/danh-muc/".$chuyenmuc["cm_slug"]);
		
		$this->data['sanpham_list'] = $this->sanpham_model->public_lay_danh_sach_san_pham($this->session->userdata('cm_id'),  "", "", $limit,$first, $order);
		
		$this->data['site'] = chs_theme.'/sanpham/index';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function search()
	{
		$this->data['tab'] = "tim-kiem-san-pham";
		$this->data['slug'] = uri_string();
		$this->data['title']= "Tìm kiếm sản phẩm | ".chs_ten_mien;
		$this->data['keywords'] = "Tìm kiếm sản phẩm | ".chs_ten_mien;
		$this->data['description'] = "Tìm kiếm sản phẩm | ".chs_ten_mien;
		
		$this->data['image'] = $this->getServerUrl()."/uploads/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$limit = 16;
		/*
		if($this->session->userdata("limit"))
		{
			$limit = $this->session->userdata('limit');
		}
		if($this->input->post('cboGioiHan'))
		{
			$limit = $this->input->post('cboGioiHan');
			$this->session->set_userdata('limit',$this->input->post('cboGioiHan'));
		}
		*/
		
		$order = "Order";
		if($this->session->userdata("order"))
		{
			$order = $this->session->userdata('order');
		}
		if($this->input->post('cboSapXep'))
		{
			$order = $this->input->post('cboSapXep');
			$this->session->set_userdata('order',$this->input->post('cboSapXep'));
		}
		
		$search = "";
		if($this->session->userdata("tukhoa"))
		{
			$search = $this->alias->loai_bo_dau_html($this->session->userdata("tukhoa"));
		}
		if ($this->input->post('txtTuKhoa')) 
		{
			$this->session->set_userdata('tukhoa',$this->input->post('txtTuKhoa'));
			$search = $this->alias->loai_bo_dau_html($this->input->post('txtTuKhoa'));
		}
		if ($this->input->post('txtTuKhoaMobile')) 
		{
			$this->session->set_userdata('tukhoa',$this->input->post('txtTuKhoaMobile'));
			$search = $this->alias->loai_bo_dau_html($this->input->post('txtTuKhoaMobile'));
		}
		$this->load->library('public_phantrang');
		$current=$this->public_phantrang->PageCurrent();
		$first=$this->public_phantrang->PageFirst($limit, $current);
		$total= count($this->sanpham_model->public_lay_danh_sach_san_pham("",  "", $search, 0, 0,""));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->public_phantrang->PagePer($total, $current, $limit, $url= "/tim-kiem-san-pham");
		
		$this->data['sanpham_list'] = $this->sanpham_model->public_lay_danh_sach_san_pham("",  "", $search, $limit,$first, $order);
		
		$this->data['site'] = chs_theme.'/sanpham/search';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function detail()
	{
		$this->session->set_userdata('tukhoa','');
		$this->session->set_userdata('tukhoa2','');
		$url = explode('/', uri_string());
		$slug = str_replace(".html","", $url[1]);
		$sanpham = $this->sanpham_model->lay_thong_tin_san_pham_bang_slug($slug);
		$this->sanpham_model->sua_san_pham(array('sp_luot_xem'=>$sanpham['sp_luot_xem'] + 1), $sanpham['sp_id']);
		$this->data['title']= $sanpham["sp_ten"]." | ".chs_tieu_de;
		$this->data['keywords'] = $sanpham["sp_ten"]." | ".chs_tieu_de;
		$this->data['description'] = $sanpham["sp_ten"]." | ".chs_tieu_de;
		
		$this->data['image'] = $this->getServerUrl()."/uploads/sanpham/".$sanpham["sp_hinh"];
		$this->data['url'] = $this->getCurrentPageURL();
		$this->data['sanpham']= $sanpham;
		$this->data['sanphamhinh_list'] = $this->sanpham_model->lay_danh_sach_san_pham_hinh($sanpham["sp_id"]);
		$this->data['sanphamthuoctinh_list'] = $this->sanpham_model->lay_danh_sach_san_pham_thuoc_tinh($sanpham["sp_id"]);
		$this->data['chuyenmuc']= $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($sanpham["sp_cm_id"]);
		$this->data['breadcrumb'] = $this->tao_breadcrumb($sanpham["sp_cm_id"]);
		$this->data['site'] = chs_theme.'/sanpham/detail';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	
	public function saleoff()
	{		
		$this->data['tab'] = "khuyen-mai";
		$this->data['slug'] = "khuyen-mai";
		$this->data['title']= "Khuyến mãi | ".chs_ten_mien;
		$this->data['keywords'] = "Khuyến mãi ".chs_ten_mien;
		$this->data['description'] = "Khuyến mãi ".chs_ten_mien;
		
		$this->data['image'] = $this->getServerUrl()."/uploads/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$limit = 16;
		if($this->session->userdata("limit"))
		{
			$limit = $this->session->userdata('limit');
		}
		if($this->input->post('cboGioiHan'))
		{
			$limit = $this->input->post('cboGioiHan');
			$this->session->set_userdata('limit',$this->input->post('cboGioiHan'));
		}
		
		
		$order = "Order";
		if($this->session->userdata("order"))
		{
			$order = $this->session->userdata('order');
		}
		if($this->input->post('cboSapXep'))
		{
			$order = $this->input->post('cboSapXep');
			$this->session->set_userdata('order',$this->input->post('cboSapXep'));
		}
		
		$search = "";
		if($this->session->userdata("tukhoa"))
		{
			$search = $this->alias->str_alias($this->session->userdata("tukhoa"));
		}
		if ($this->input->post('txtTuKhoa')) 
		{
			$this->session->set_userdata('tukhoa',$this->input->post('txtTuKhoa'));
			$search = $this->alias->str_alias($this->input->post('txtTuKhoa'));
		}
		$this->load->library('phantrang2');
		$current=$this->phantrang2->PageCurrent();
		$first=$this->phantrang2->PageFirst($limit, $current);
		$total= count($this->sanpham_model->public_lay_danh_sach_san_pham("",  "", $search, 0, 0,""));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang2->PagePer($total, $current, $limit, $url= "/tim-kiem-san-pham/page");
		
		$this->data['list'] = $this->sanpham_model->public_lay_danh_sach_san_pham("",  "", $search, $limit,$first, $order);
		
		$this->data['site'] = 'site/sanpham/search';
		$this->load->view('index',$this->data);
	}
	public function print_doc()
	{
		
		$id = str_replace(".html","", $this->uri->rsegment(3));
		$sanpham = $this->sanpham_model->lay_thong_tin_san_pham($id);
		
		$this->data['title']= $sanpham["sp_ten"]." - ".chs_tieu_de;
		$this->data['keywords'] = $sanpham["sp_ten"]." - ".chs_tieu_de;
		$this->data['description'] = $sanpham["sp_tom_tat"]." - ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/baiviet/".$sanpham["sp_hinh"];
		$this->data['url'] = $this->getCurrentPageURL();
		$this->data['id']= $id;
		$this->data['sanpham']= $sanpham;
		$this->data['danhmuc']= $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($sanpham["sp_cm_id"]);
		$this->load->view(chs_theme.'/sanpham/print',$this->data);
		
		
		
	}
	
}
?>