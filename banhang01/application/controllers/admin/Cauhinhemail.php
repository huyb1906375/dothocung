<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cauhinhemail extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='hethong';
		$this->data['com']='cauhinhemail';
	}
	public function index()
	{
		$this->data['view']='index';
		$this->data['title']='Cấu hình email - SakiCMS';
		$id = "email";
		$this->data['row']=$this->cauhinhemail_model->lay_thong_tin_cau_hinh_email($id);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtProtocol', 'Protocol', 'required');
		$this->form_validation->set_rules('txtHost', 'Host', 'required');
		$this->form_validation->set_rules('txtPort', 'Port', 'required');
		$this->form_validation->set_rules('txtUsername', 'Username', 'required');
		$this->form_validation->set_rules('txtPassword', 'Password', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			
			$mydata= array(
				'che_protocol' => $this->input->post('txtProtocol'),
				'che_host' => $this->input->post('txtHost'),
				'che_port' => $this->input->post('txtPort'),
				'che_username' => $this->input->post('txtUsername'),
				'che_password' => $this->input->post('txtPassword')
			);
			
			if($this->cauhinhemail_model->sua_cau_hinh_email($mydata, $id))
			{
				$this->session->set_flashdata('success', 'Cấu hình email thành công');								
				
				redirect('admin/cauhinhemail','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Cấu hình không thành công!');
				$this->data['template']='admin/cauhinhemail/index';
				$this->data['title']='Cấu hình email - SakiCMS';
				$this->load->view('admin/index', $this->data);
				
			}
		} 
		else 
		{
			$this->data['template']='admin/cauhinhemail/index';
			$this->data['title']='Cấu hình email - SakiCMS';
			$this->load->view('admin/index', $this->data);
		}
        
	}
	
}
