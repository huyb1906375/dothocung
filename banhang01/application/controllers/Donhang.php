<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Donhang extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }
	
	public function showdathang()
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
		$this->load->view(chs_theme.'/donhang/dathang',$this->data);
	}
	
}
?>