<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Tonghop extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
		$this->load->model('chuyenmuc_model');
		$this->load->model('lienket_model');
		$this->load->model('menu_model');
		$this->load->model('nguoidung_model');	
		$this->load->model('cautruc_model');

    }
    public function tyle()
	{
		$this->load->library('alias');
		$this->load->helper('form');
		$this->load->helper('text');
		
		
		$this->data['tab'] = "ty-le";
		$this->data['slug'] = "ty-le";
		$this->data['rowcm']= "Tỷ lệ bóng đá";
		$this->data['title']= "Tỷ lệ bóng đá | ".chs_ten_mien;
		$this->data['keywords'] = "Tỷ lệ bóng đá";
		$this->data['description'] = "Tỷ lệ bóng đá";
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = 'site/tonghop/tyle';
		$this->load->view('index',$this->data);
	}
	public function tyso()
	{
		$this->load->library('alias');
		$this->load->helper('form');
		$this->load->helper('text');
		
		
		$this->data['tab'] = "ty-so";
		$this->data['slug'] = "ty-ố";
		$this->data['rowcm']= "Tỷ số";
		$this->data['title']= "Tỷ số | ".chs_ten_mien;
		$this->data['keywords'] = "Tỷ số";
		$this->data['description'] = "Tỷ số";
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = 'site/tonghop/tyso';
		$this->load->view('index',$this->data);
	}
}
?>