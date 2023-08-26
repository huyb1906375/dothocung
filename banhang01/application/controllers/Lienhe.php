<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Lienhe extends MY_Controller
{
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();		
    }
    
	public function index()
	{
		$this->session->set_userdata('tukhoa','');
		$this->session->set_userdata('tukhoa2','');				
		$this->data['tab'] = "lien-he";
        $this->data['title'] = "Liên hệ"." | ".chs_tieu_de;
		$this->data['keywords'] = "Liên hệ"." | ".chs_tieu_de;
		$this->data['description'] = "Liên hệ"." | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/uploads/".chs_logo;
		$this->data['url'] = $this->getCurrentPageURL();
		$this->data['site'] = chs_theme.'/lienhe/index';
		$md5_hash = md5(rand(0,999)); 
		$this->data['security_code'] = substr($md5_hash, 15, 5); 
		$this->form_validation->set_rules('txtTen', 'Tên', 'required');
		$this->form_validation->set_rules('txtDienThoai', 'Điện thoại', 'required');
		$this->form_validation->set_rules('txtNoiDung', 'Nội dung', 'required');
		if ($this->form_validation->run() == TRUE) 
		{
			$maxacnhan = $_POST['txtMaXacNhan'];
			$security_code = $_POST['txtSecurityCode'];
			if($maxacnhan == $security_code)
			{
				$mydata= array(
					'lh_id' => date('YmdHis'),	
					'lh_ten' => $this->input->post('txtTen'),
					'lh_tu_khoa' => $string=$this->alias->str_alias($this->input->post('txtTen')),
					'lh_dia_chi' => '',
					'lh_dien_thoai' => $this->input->post('txtDienThoai'),
					'lh_email' => '',
					'lh_noi_dung' => $this->input->post('txtNoiDung'),
					'lh_ngay_gui' => date("Y-m-d H:i:s"),
					'lh_trang_thai' => 0				
				);				
				if($this->lienhe_model->them_lien_he($mydata))
				{
					
					echo "<script>alert('Bạn đã gửi liên hệ thành công!');</script>";
					$this->load->view(chs_theme.'/index',$this->data);
				}
				else
				{
					echo "<script>alert('Không thể gửi liên hệ này. Vui lòng kiểm tra lại!');</script>";
					$this->load->view(chs_theme.'/index',$this->data);
					
				}
			}
			else
			{
				echo "<script>alert('Mã xác nhận không chính xác!');</script>";
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