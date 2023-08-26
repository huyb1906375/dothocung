<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Baohanh extends MY_Controller
{
    function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		
		$this->data['title']= "Tra cứu bảo hành | ".chs_tieu_de;
		$this->data['keywords'] = "Tra cứu bảo hành | ".chs_tieu_de;
		$this->data['description'] = "Tra cứu bảo hành | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();
		
		$this->data['site'] = chs_theme.'/baohanh/index';
		$this->data['tab'] = 'don-hang';
		$this->form_validation->set_rules('txtTuKhoaBaoHanh', 'Từ khoá', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			if ($this->input->post('btnTraCuu')) 
			{
				$this->data['baohanh_list'] = $this->baohanh_model->tra_cuu_bao_hanh($this->input->post('txtTuKhoaBaoHanh'));
				$this->data['site'] = chs_theme.'/baohanh/index';
				$this->load->view(chs_theme.'/index',$this->data);
			}
			else
			{
				//$this->data['list'] = $this->donhang_model->tra_cuu_bao_hanh("");
				$this->data['site'] = chs_theme.'/baohanh/index';
				$this->load->view(chs_theme.'/index',$this->data);
			}
		}
		else
		{
			$this->load->view(chs_theme.'/index',$this->data);
		}
	}
	
}
?>