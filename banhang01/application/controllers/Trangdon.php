<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Trangdon extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
    }
    
	public function index()
	{
		$this->session->set_userdata('tukhoa','');
		$this->load->helper('text');
		$url = explode('/', uri_string());
		$slug = str_replace(".html","", $url[0]);
		if($slug == "admin")
		{
			//redirect('admin/home','refresh');
		}
		else
		{
			//echo "<script>alert('".$slug."');</script>";
			$chuyenmuc = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc_bang_slug($slug);
			//$this->data['breadcrumb'] = $this->tao_breadcrumb($chuyenmuctin["cm_id"]);
			//$this->session->set_userdata('cm_id',$chuyenmuctin["cm_id"]);
			//$this->data['tab'] = $slug;
			//$this->data['slug'] = uri_string();
			if($chuyenmuc != null)
			{
				$this->data['chuyenmuc']= $chuyenmuc;
				$this->data['title']= $chuyenmuc["cm_ten"]." | ".chs_tieu_de;
				$this->data['keywords'] = $chuyenmuc["cm_ten"]." | ".chs_tieu_de;
				$this->data['description'] = $chuyenmuc["cm_ten"]." | ".chs_tieu_de;
				$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
				$this->data['url'] = $this->getCurrentPageURL();
				$this->data['site'] = chs_theme.'/trangdon/index';
				$this->load->view(chs_theme.'/index',$this->data);
			}
			else 
			{
				
				$this->data['heading']= chs_tieu_de;
				$this->data['message']= "Trang không tồn tại!";
				$this->load->view('errors/html/error_404',$this->data);
			}
		}
	}
	
}
?>