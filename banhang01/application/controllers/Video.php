<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Video extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
		$this->load->model('chuyenmuc_model');
		$this->load->model('baiviet_model');
		$this->load->model('video_model');
		$this->load->model('lienket_model');
		$this->load->model('menu_model');
		$this->load->model('nguoidung_model');	
		$this->load->model('cautruc_model');
		$this->load->model('lienket_model');
    }
    public function index()
	{
		$this->session->set_userdata('tukhoa','');
		$this->load->library('alias');
		$this->load->helper('form');
		$this->load->helper('text');
		$url = explode('/', uri_string());
		//$num = count($url);
		$slug = $url[1];
		$rowcm = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc_bang_slug($slug);
		$this->session->set_userdata('cm_id',$rowcm["cm_id"]);
		$this->data['tab'] = $slug;
		$this->data['slug'] = $slug;
		$this->data['rowcm']= $rowcm;
		$this->data['title']= $rowcm["cm_ten"]." - ".chs_tieu_de;
		$this->data['keywords'] = $rowcm["cm_ten"]." - ".chs_tieu_de;
		$this->data['description'] = $rowcm["cm_ten"]." - ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
		$this->data['url'] = $this->getCurrentPageURL();
		$limit = 40;
		
		$this->load->library('phantrang2');
		$current=$this->phantrang2->PageCurrent();
		$first=$this->phantrang2->PageFirst($limit, $current);
		$total= count($this->video_model->lay_danh_sach_video($rowcm["cm_id"],  "xuatban", "" ));
		$this->data['total'] = $total;
		$this->data['strphantrang']=$this->phantrang2->PagePer($total, $current, $limit, $url= "/chuyen-muc-video/".$rowcm["cm_slug"].'/page');
		
		$this->data['list'] = $this->video_model->lay_danh_sach_video_gioi_han($rowcm["cm_id"], "xuatban", "" ,$limit,$first);
		$this->data['site'] = chs_theme.'/video/index';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function detail()
	{
		$this->session->set_userdata('tukhoa','');
		$this->load->helper('text');
		$url = explode('/', uri_string());
		$slug = str_replace(".html","", $url[1]);
		$row = $this->video_model->lay_thong_tin_video_bang_slug($slug);
		$this->video_model->sua_video(array('v_luot_xem'=>$row['v_luot_xem'] + 1), $row['v_id']);
		$this->data['title']= $row["v_ten"]." - ".chs_tieu_de;
		$this->data['keywords'] = $row["v_ten"]." - ".chs_tieu_de;
		$this->data['description'] = $row["v_ten"]." - ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/video/".$row["v_hinh"];
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['row']= $row;
		//$this->data['rownd']= $this->nguoidung_model->lay_thong_tin_nguoi_dung($row["bds_nd_id"]);
		$this->data['rowcm']= $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($row["v_cm_id"]);
        //$this->data['rowqh']= $this->quanhuyen_model->lay_thong_tin_quan_huyen($row["bds_qh_id"]);
		//$this->data['rowpx']= $this->phuongxa_model->lay_thong_tin_phuong_xa($row["bds_px_id"]);
		$this->data['site'] = chs_theme.'/video/detail';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function search()
	{
		$this->session->set_userdata('tukhoa','');
		$this->load->library('alias');
		$this->load->helper('form');
		$this->load->helper('text');
		

		$this->data['title']= "Tìm kiếm tin tức"." - ".chs_tieu_de;
		$this->data['keywords'] = "Tìm kiếm tin tức"." - ".chs_tieu_de;
		$this->data['description'] = "Tìm kiếm tin tức"." - ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
		$this->data['url'] = $this->getCurrentPageURL();
		$limit = 2;
		$search = "";
		if($this->input->post('btnSearch'))
		{
			$search = $this->alias->str_alias($this->input->post('txtTuKhoa'));
			$this->session->set_userdata('tukhoa',$this->input->post('txtTuKhoa'));
		}
		else $this->session->set_userdata('tukhoa',"");
		$this->data['list'] = $this->video_model->tim_kiem_video_bang_tu_khoa($search);
		$this->data['site'] = 'site/video/search';
		$this->load->view('layout',$this->data);
	}
}
?>