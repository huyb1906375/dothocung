<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Tintuc extends MY_Controller
{
    function __construct() {
        parent::__construct();
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
		$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
		$this->data['url'] = $this->getCurrentPageURL();
		
		$limit = 20;
		$search = "";
		//$this->load->library('public_phantrang');
		$current=$this->public_phantrang->PageCurrent();
		$first=$this->public_phantrang->PageFirst($limit, $current);
		$total= count($this->baiviet_model->lay_danh_sach_bai_viet($this->session->userdata('cm_id'),  "xuatban", $search ));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->public_phantrang->PagePer($total, $current, $limit, $url= "/chuyen-muc/".$chuyenmuc["cm_slug"]);
		
		$this->data['tintuc_list'] = $this->baiviet_model->lay_danh_sach_bai_viet_gioi_han($this->session->userdata('cm_id'), "xuatban", $search ,$limit,$first);
		$this->data['site'] = chs_theme.'/tintuc/index';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function search()
	{
		$this->data['title']= "Tìm kiếm tin tức"." - ".chs_tieu_de;
		$this->data['keywords'] = "Tìm kiếm tin tức"." - ".chs_tieu_de;
		$this->data['description'] = "Tìm kiếm tin tức"." - ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
		$this->data['url'] = $this->getCurrentPageURL();
		
		$limit = 20;
		$search = "";
		if($this->session->userdata("tukhoa"))
		{
			$search = $this->alias->create_slug($this->session->userdata("tukhoa"));
		}
		if ($this->input->post('txtTuKhoa')) 
		{
			$this->session->set_userdata('tukhoa',$this->input->post('txtTuKhoa'));
			$search = $this->alias->create_slug($this->input->post('txtTuKhoa'));
		}
		$this->data['tintuc_list'] = $this->baiviet_model->tim_kiem_bai_viet_bang_tu_khoa(chs_lg,$search);
		$this->data['site'] = chs_theme.'/tintuc/search';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function detail()
	{
		$this->session->set_userdata('tukhoa','');
		$this->session->set_userdata('tukhoa2','');
		$url = explode('/', uri_string());
		$slug = str_replace(".html","", $url[1]);
		$tintuc = $this->baiviet_model->lay_thong_tin_bai_viet_bang_slug($slug);
		$this->baiviet_model->sua_bai_viet(array('bv_luot_xem'=>$tintuc['bv_luot_xem'] + 1), $tintuc['bv_id']);
		$this->data['title']= $tintuc["bv_ten"]." | ".chs_tieu_de;
		$this->data['keywords'] = $tintuc["bv_ten"]." | ".chs_tieu_de;
		$this->data['description'] = $tintuc["bv_tom_tat"]." | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/baiviet/".$tintuc["bv_hinh"];
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['tintuc']= $tintuc;
		
		$this->data['chuyenmuc']= $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($tintuc["bv_cm_id"]);
		$this->data['nguoidung']= $this->nguoidung_model->lay_thong_tin_nguoi_dung($tintuc["bv_nd_id"]);
		$this->data['breadcrumb'] = $this->tao_breadcrumb($tintuc["bv_cm_id"]);
		$this->data['site'] = chs_theme.'/tintuc/detail';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function print_doc()
	{
		
		$id = str_replace(".html","", $this->uri->rsegment(3));
		$row = $this->baiviet_model->lay_thong_tin_bai_viet($id);
		
		$this->data['title']= $row["bv_ten"]." - ".chs_tieu_de;
		$this->data['keywords'] = $row["bv_ten"]." - ".chs_tieu_de;
		$this->data['description'] = $row["bv_tom_tat"]." - ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/baiviet/".$row["bv_hinh"];
		$this->data['url'] = $this->getCurrentPageURL();
		$this->data['id']= $id;
		$this->data['row']= $row;
		$this->data['rowcm']= $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($row["bv_cm_id"]);
		$this->load->view(chs_theme.'/tintuc/print',$this->data);
		
		
		
	}
	
	function tao_breadcrumb($cm_id)
	{
		$str = "";
		$s = "<a href=\"/\"> Trang chủ </a>";
		$s .= "<span class=\"divider\">/</span>";
		if($cm_id != "0")
		{
			$rowcm = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($cm_id);	
			$title = $rowcm["cm_ten"];
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
}
?>