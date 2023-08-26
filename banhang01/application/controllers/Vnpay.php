<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
  
class Vnpay extends MY_Controller
{
    function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		
		$this->data['title']= "Thanh toán trực tuyến | ".chs_tieu_de;
		$this->data['keywords'] = "Thanh toán trực tuyến | ".chs_tieu_de;
		$this->data['description'] = "Thanh toán trực tuyến | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();	

		

		$this->data['startTime'] = $startTime;
		$this->data['expire'] = $expire;
		
		$this->data['site'] = chs_theme.'/vnpay/index';
		$this->data['tab'] = 'vnpay';
		$this->load->view(chs_theme.'/index',$this->data);
	}
	public function create_payment()
	{
		//$vnp_TxnRef = $this->input->post('order_id');
		//echo "<script>alert('".$vnp_TxnRef."');</script>";
		$startTime = date("YmdHis");
		$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));	
		
		$vnp_TxnRef = $startTime;
		$vnp_OrderInfo = "Nạp tiền";
		$vnp_OrderType = $this->input->post('order_type');
		$vnp_Amount = $this->input->post('amount') * 100;
		$vnp_Locale = "vn";
		$vnp_BankCode = "";
		$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
		$vnp_ExpireDate = $expire;
		
		$vnp_TmnCode = chtt_vnp_TmnCode;
		$vnp_Returnurl = chtt_vnp_ReturnUrl;
		$vnp_HashSecret = chtt_vnp_HashSecret;
		$vnp_Url = chtt_vnp_Url;
		$inputData = array(
			"vnp_Version" => "2.1.0",
			"vnp_TmnCode" => $vnp_TmnCode,
			"vnp_Amount" => $vnp_Amount,
			"vnp_Command" => "pay",
			"vnp_CreateDate" => date('YmdHis'),
			"vnp_CurrCode" => "VND",
			"vnp_IpAddr" => $vnp_IpAddr,
			"vnp_Locale" => $vnp_Locale,
			"vnp_OrderInfo" => $vnp_OrderInfo,
			"vnp_OrderType" => $vnp_OrderType,
			"vnp_ReturnUrl" => $vnp_Returnurl,
			"vnp_TxnRef" => $vnp_TxnRef,
			"vnp_ExpireDate"=>$vnp_ExpireDate
		);

		if (isset($vnp_BankCode) && $vnp_BankCode != "") {
			$inputData['vnp_BankCode'] = $vnp_BankCode;
		}
		if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
			$inputData['vnp_Bill_State'] = $vnp_Bill_State;
		}

		ksort($inputData);
		$query = "";
		$i = 0;
		$hashdata = "";
		foreach ($inputData as $key => $value) {
			if ($i == 1) {
				$hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
			} else {
				$hashdata .= urlencode($key) . "=" . urlencode($value);
				$i = 1;
			}
			$query .= urlencode($key) . "=" . urlencode($value) . '&';
		}

		$vnp_Url = $vnp_Url . "?" . $query;

		if (isset($vnp_HashSecret)) {
			$vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
			$vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
		}
		$returnData = array('code' => '00'
			, 'message' => 'success'
			, 'data' => $vnp_Url);
		if (isset($_POST['redirect'])) {
			header('Location: ' . $vnp_Url);
			die();
		} else {
			echo json_encode($returnData);
		}
	}
	public function process_return_url()
	{
		$this->data['title']= "Thanh toán trực tuyến | ".chs_tieu_de;
		$this->data['keywords'] = "Thanh toán trực tuyến | ".chs_tieu_de;
		$this->data['description'] = "Thanh toán trực tuyến | ".chs_tieu_de;
		$this->data['image'] = $this->getServerUrl()."/logo_200.png";
		$this->data['url'] = $this->getCurrentPageURL();	
		
		$vnp_HashSecret = chtt_vnp_HashSecret;
		$vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
		if ($secureHash == $vnp_SecureHash) 
		{
			$return_data = array(
				'vnp_TxnRef' => $_GET['vnp_TxnRef'],
				'vnp_Amount' => $_GET['vnp_Amount'],
				'vnp_OrderInfo' => $_GET['vnp_OrderInfo'],
				'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
				'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
				'vnp_BankCode' => $_GET['vnp_BankCode'],
				'vnp_PayDate' => $_GET['vnp_PayDate'],
				'vnp_CardType' => $_GET['vnp_CardType'],
				'vnp_TmnCode' => $_GET['vnp_TmnCode'],
				'vnp_TransactionStatus' => $_GET['vnp_TransactionStatus'],
				'vnp_SecureHash' => $_GET['vnp_SecureHash']
			);
			if ($_GET['vnp_ResponseCode'] == '00') 
			{
				$amount = intval($_GET['vnp_Amount']) / 100;
				$mydata= array(
					'gd_id' => strtotime($_GET['vnp_TxnRef']),
					'gd_thoi_gian' => date('Y-m-d H:i:s',strtotime($_GET['vnp_PayDate'])),
					'gd_noi_dung' => $_GET['vnp_OrderInfo'],
					'gd_so_tien' => $amount,
					'gd_nh_id' => $_GET['vnp_BankCode'],
					'gd_nd_id' => $this->session->userdata('nd_id')
				);
				//echo "<script>alert('".$amount."');</script>";
				$this->giaodich_model->them_giao_dich($mydata);
				echo "<script>alert('Đã thanh toán thành công!');</script>";
				$this->data['site'] = chs_theme.'/vnpay/return';
				$this->data['return_data'] = $return_data;
				$this->load->view(chs_theme.'/index',$this->data);
				//redirect(base_url().'dang-nhap.html','refresh');
			} 
			else 
			{
				echo "<script>alert('Thanh toán thất bại!');</script>";
			}
		}
		else 
		{
			echo "<script>alert('Chữ ký không hợp lệ!');</script>";
		}
	}
}
?>