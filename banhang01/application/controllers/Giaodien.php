<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Giaodien extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
		
    }
    
	
	public function index()
	{
		$this->session->set_userdata('tukhoa','');
		$this->session->set_userdata('tukhoa2','');
		$this->baiviet_model->kich_hoat_bai_viet();
		$this->data['tab'] = "trang-chu";
        $this->data['title'] = chs_tieu_de;
		$this->data['keywords'] = chs_tu_khoa;
		$this->data['description'] = chs_mo_ta;
		$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
		$this->data['url'] = $this->getCurrentPageURL();		
		$url = explode('/', uri_string());
		$theme = $url[1];
		$this->session->set_userdata('theme',$theme);
		redirect('/','refresh');
	}
}
?>