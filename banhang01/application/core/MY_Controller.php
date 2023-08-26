<?php
Class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('cauhinhsite_model');
		$this->load->helper('admin');
		$this->load->library('mobile');
		$settings = $this->cauhinhsite_model->lay_thong_tin_cau_hinh_site("site");		
		define('chs_ten_mien',$this->getDomain());
		define('chs_tieu_de',$settings["chs_tieu_de"]);
		define('chs_tu_khoa',$settings["chs_tu_khoa"]);
		define('chs_mo_ta',$settings["chs_mo_ta"]);
		define('chs_logo',$settings["chs_logo"]);
		define('chs_logo_mobile',$settings["chs_logo_mobile"]);
		define('chs_favicon',$settings["chs_favicon"]);
		define('chs_banner',$settings["chs_banner"]);
		define('chs_hinh_nen',$settings["chs_hinh_nen"]);
		define('chs_gioi_thieu',$settings["chs_gioi_thieu"]);
		define('chs_ban_quyen',$settings["chs_ban_quyen"]);
		define('chs_don_vi',$settings["chs_don_vi"]);
		define('chs_dien_thoai',$settings["chs_dien_thoai"]);
		define('chs_email',$settings["chs_email"]);
		define('chs_dia_chi',$settings["chs_dia_chi"]);
		define('chs_bien_tap',$settings["chs_bien_tap"]);
		define('chs_zalo',$settings["chs_zalo"]);
		define('chs_facebook',$settings["chs_facebook"]);
		define('chs_google_maps',$settings["chs_google_maps"]);
		define('chs_theme',"sieuviet");
		
		$email = $this->cauhinhemail_model->lay_thong_tin_cau_hinh_email("email");	
		define('che_protocol',$email["che_protocol"]);
		define('che_host',$email["che_host"]);
		define('che_port',$email["che_port"]);
		define('che_username',$email["che_username"]);
		define('che_password',$email["che_password"]);
		
		$vnpay = $this->cauhinhthanhtoan_model->lay_thong_tin_cau_hinh_thanh_toan("vnpay");	
		define('chtt_vnp_TmnCode',$vnpay["chtt_tmn_code"]);
		define('chtt_vnp_HashSecret',$vnpay["chtt_hash_secret"]);
		define('chtt_vnp_Url',$vnpay["chtt_url"]);
		define('chtt_vnp_ReturnUrl',$vnpay["chtt_return_url"]);
		define('chtt_vnp_ApiUrl',$vnpay["chtt_api_url"]);

		//define('chs_lg',"_en");
		$theme = "tintuc";
		/*
		$theme = "desktop";
		if ($this->mobile->isMobile() ) 
		{
			$theme = "mobile";
		}
		if($this->session->userdata("theme"))
		{
			$theme = $this->session->userdata("theme");
		}
		*/
		$lg = "vi";
		if($this->session->userdata("lg"))
		{
			$lg = $this->session->userdata("lg");
		}
		//if($lg == "_vi") $lg = "";
		define('chs_lg',$lg);
		/*
		$nn = "vi";
		if($this->session->userdata("nn"))
		{
			$nn = $this->session->userdata("nn");
		}
		define('chs_nn',$nn);
		*/
    }
	public function getDomain()
	{
		$pageURL = 'http';	 
		if (!empty($_SERVER['HTTPS'])) 
		{
			if ($_SERVER['HTTPS'] == 'on') 
			{
				$pageURL .= "s";
			}
		} 
		$pageURL .= "://"; 
		if ($_SERVER["SERVER_PORT"] != "80") 
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"];
		}
		return $pageURL;
	}

    public function getCurrentPageURL() 
	{
		$pageURL = 'http';
	 
		if (!empty($_SERVER['HTTPS'])) 
		{
			if ($_SERVER['HTTPS'] == 'on') 
			{
				$pageURL .= "s";
			}
		}
	 
		$pageURL .= "://";
	 
		if ($_SERVER["SERVER_PORT"] != "80") 
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
	 
		return $pageURL;
	}
	public function getServerUrl() 
	{
		$pageURL = 'http';
	 
		if (!empty($_SERVER['HTTPS'])) 
		{
			if ($_SERVER['HTTPS'] == 'on') 
			{
				$pageURL .= "s";
			}
		}
	 
		$pageURL .= "://";
	 
		if ($_SERVER["SERVER_PORT"] != "80") 
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"];
		}
	 
		return $pageURL;
	}
	function gui_email($namefrom, $emailfrom, $emailfrompass, $host, $port,$nameto, $emailto, $tieude, $noidung)
	{
		// Thiết lập SMTP Server
		//$this->load->library('phpmailer');
		//require("class.phpmailer.php"); // nạp thư viện
		$mailer = new PHPMailer(); // khởi tạo đối tượng
		$mailer->IsSMTP(); // gọi class smtp để đăng nhập
		$mailer->CharSet="utf-8"; // bảng mã unicode
		
		//Đăng nhập Gmail
		$mailer->SMTPAuth = true; // Đăng nhập
		$mailer->SMTPSecure = "ssl"; // Giao thức SSL
		$mailer->Host = $host;//"smtp.gmail.com"; // SMTP của GMAIL
		$mailer->Port = $port;//465; // cổng SMTP
		
		// Phải chỉnh sửa lại
		$mailer->Username = $emailfrom; // GMAIL username
		$mailer->Password = $emailfrompass; // GMAIL password
		$mailer->AddAddress($emailto,$nameto); //email người nhận
		 
		// Chuẩn bị gửi thư nào
		$mailer->FromName = $namefrom; // tên người gửi
		$mailer->From = $mailer->Username; // mail người gửi
		$mailer->Subject =  $tieude;
		$mailer->IsHTML(true); //Bật HTML không thích thì false
		$mailer->Body = $noidung;
		 
		// Gửi email
		return $mailer->Send();
		/* if(!$mailer->Send())
		{
		// Gửi không được, đưa ra thông báo lỗi
		echo "Không gửi được";
		echo "Lỗi: " . $mailer->ErrorInfo;
		}
		else
		{
		 
		// Gửi thành công
		echo "Gửi thư thành công";
		 
		}*/
	}
    /*
     * Kiem tra trang thai dang nhap cua admin
     */
	 
    private function _check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);
    
        $login = $this->session->userdata('login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if(!$login && $controller != 'login')
        {
            redirect(admin_url('login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if($login && $controller == 'login')
        {
            redirect(admin_url('home'));
        }elseif(!in_array($controller, array('login','home'))){
            $admin_id = $this->session->userdata('admin_id');
            $admin_root = $this->config->item('root_admin');
            if($admin_id != $admin_root){
            // kiem tra quyen tai day
               $permissions_admin = $this->session->userdata('permissions');

                $controller = $this->uri->rsegment(1);
                $action = $this->uri->rsegment(2);
                if(!isset($permissions_admin->{$controller})){
                    $check = false;
                }
                $permissions_actions = $permissions_admin ->{$controller};
                if(!in_array($action, $permissions_actions)){
                    $check = false;
                }
                if(!$check){
                    $this->session->set_flashdata('message','Bạn không có quyền truy cập trang này');
                    redirect(base_url('admin'));
                }
            }     
        }
    }
}


