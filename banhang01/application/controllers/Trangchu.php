<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Trangchu extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
        $this->data['com']='trangchu';
		
    }
    
	public function index()
	{
		$this->session->set_userdata('tukhoa','');
		$this->baiviet_model->kich_hoat_bai_viet();
		$this->load->helper('text');
		$this->data['tab'] = "trang-chu";
        $this->data['title'] = chs_tieu_de;
		$this->data['keywords'] = chs_tu_khoa;
		$this->data['description'] = chs_mo_ta;
		$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
		$this->data['url'] = $this->getCurrentPageURL();
		$this->data['site'] = chs_theme.'/trangchu/index';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	
}
?>