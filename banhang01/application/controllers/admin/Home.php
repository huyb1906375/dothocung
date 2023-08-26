<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nd_id'))
		{
			redirect('admin/login','refresh');
		}
		$this->data['user']=$this->nguoidung_model->lay_thong_tin_nguoi_dung($this->session->userdata('nd_id'));
		$this->data['tab']='home';
		$this->data['com']='home';
		/*
		$this->data['user']=$this->Muser->user_detail($this->session->userdata('id'));
		$this->data['com']='dashboard';
		*/
	}

	public function index()
	{

		$this->data['template']='admin/home/index';
		$this->data['title']='SutekCMS';
		$this->load->view('admin/index',$this->data);
		
	}
	public function error_404()
	{
		$data['title'] = "Error 404";
		$data['description'] = "Error 404";
		$data['keywords'] = "error, 404";

		$this->load->view('partials/_header', $data);
		$this->load->view('errors/error_404');
		$this->load->view('partials/_footer');
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */