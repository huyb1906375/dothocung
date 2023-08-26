<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cauhinhthanhtoan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='hethong';
		$this->data['com']='cauhinhthanhtoan';
	}
	public function index()
	{
		$this->data['view']='index';
		$this->data['title']='Cấu hình thanh toán - SietVietSoft';
		$id = "vnpay";
		$this->data['row']=$this->cauhinhthanhtoan_model->lay_thong_tin_cau_hinh_thanh_toan($id);
		$this->form_validation->set_rules('txtTmnCode', 'TmnCode', 'required');
		$this->form_validation->set_rules('txtHashSecret', 'HashSecret', 'required');
		$this->form_validation->set_rules('txtUrl', 'Url', 'required');
		$this->form_validation->set_rules('txtReturnUrl', 'ReturnUrl', 'required');
		$this->form_validation->set_rules('txtApiUrl', 'ApiUrl', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'chtt_tmn_code' => $this->input->post('txtTmnCode'),
				'chtt_hash_secret' => $this->input->post('txtHashSecret'),
				'chtt_url' => $this->input->post('txtUrl'),
				'chtt_return_url' => $this->input->post('txtReturnUrl'),
				'chtt_api_url' => $this->input->post('txtApiUrl')
			);
			
			if($this->cauhinhthanhtoan_model->sua_cau_hinh_thanh_toan($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Cấu hình thanh toán thành công');								
				
				redirect('admin/cauhinhthanhtoan','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Cấu hình không thành công!');
				$this->data['template']='admin/cauhinhthanhtoan/index';
				$this->data['title']='Cấu hình thanh toán - SakiCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/cauhinhthanhtoan/index';
			$this->data['title']='Cấu hình thanh toán - SakiCMS';
			$this->load->view('admin/index', $this->data);
		}
        
	}
	
}
