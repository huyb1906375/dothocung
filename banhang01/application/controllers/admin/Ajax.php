<?php
class Ajax extends MY_Controller {
  
    public function __construct()
    {
        parent::__construct();
		$this->load->model('baiviet_model');
		$this->load->model('sanpham_model');
		$this->load->model('batdongsan_model');
		$this->load->model('menu_model');
		$this->load->model('chuyenmuc_model');
		$this->load->model('tinhthanh_model');
		$this->load->model('quanhuyen_model');
		$this->load->model('phuongxa_model');
		$this->load->model('cautruc_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->database();
		$this->limit = 5;
    }
	public function load_list(){
        $limit = $this->limit;
        $data['users'] = $this->get_load_more_data($limit,'');
        $this->load->view('ajax_load_more_list', $data);
    }
	public function get_ajax_load_more(){
		$limit = $this->limit; 
		$page = $limit * $this->input->get('page');
		$data['users'] = $this->get_load_more_data($limit,$page);
		$isExist = $this->load->view('load_more_loop', $data);
		if($isExist){
			echo json_encode($isExist);
		}
	} 
	function get_load_more_data($limit, $offset = ''){
		$this->db->select('name');
		$this->db->from('users');
		$this->db->limit($limit,$offset);
		$data = $this->db->get()->result();
		return $data;
	}
    public function image()
    {
      $this->load->view('admin/image');
    }
 
    function ajaxImageStore()  
    {  
         if(isset($_FILES["image_file"]["name"]))  
         {  
              $config['upload_path'] = './uploads/';  
              $config['allowed_types'] = 'jpg|jpeg|png|gif';  
              $this->load->library('upload', $config);  
              if(!$this->upload->do_upload('image_file'))  
              {  
                  $error =  $this->upload->display_errors(); 
                  echo json_encode(array('msg' => $error, 'success' => false));
              }  
              else 
              {  
                   $data = $this->upload->data(); 
                   $insert['name'] = $data['file_name'];
                   $this->db->insert('images',$insert);
                   $getId = $this->db->insert_id();
 
                   $arr = array('msg' => 'Image has not uploaded successfully', 'success' => false);
 
                   if($getId){
                    $arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);
                   }
                   echo json_encode($arr);
              }  
         }  
    }
	public function multipleImage()
	{
		$this->load->view('admin/multiple-image');
	}
 
	public function multipleImageStore()
	{
 
      $countfiles = count($_FILES['files']['name']);
  
      for($i=0;$i<$countfiles;$i++)
	  {
  
        if(!empty($_FILES['files']['name'][$i]))
		{
  
          // Define new $_FILES array - $_FILES['file']
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
 
          // Set preference
          $config['upload_path'] = './uploads/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '20000'; // max_size in kb
          $config['file_name'] = $_FILES['files']['name'][$i];
  
          //Load upload library
          $this->load->library('upload',$config); 
          $arr = array('msg' => 'something went wrong', 'success' => false);
          // File upload
          if($this->upload->do_upload('file')){
           
           $data = $this->upload->data(); 
		   /*
           $insert['name'] = $data['file_name'];
           $this->db->insert('images',$insert);
           $get = $this->db->insert_id();
		   */
          $arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);
 
          }
        }
  
      }
      echo json_encode($arr);
  
  }
	public function ajax_lay_ds_chuyen_muc()
	{
		$nn = $this->uri->rsegment(3);
		$result = "";
		$result .= "<option value=\"0\">&nbsp;</option>";
		$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($nn,"0","chuyen-muc","","");
		foreach ($parent as $p) 
		{
			$result .= "<option ".(($this->session->userdata('cm_id_parent') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
			$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($nn,$p["cm_id"],"chuyen-muc","","");
			foreach ($child as $c) 
			{
				$result .= "<option ".(($this->session->userdata('cm_id_parent') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
			}
		}
        echo $result;
		
	}
	public function ajax_lay_ds_danh_muc()
	{
		$nn = $this->uri->rsegment(3);
		$result = "";
		$result .= "<option value=\"0\">&nbsp;</option>";
		$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($nn,"0","danh-muc","","");
		foreach ($parent as $p) 
		{
			$result .= "<option ".(($this->session->userdata('cm_id_parent') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
			$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($nn,$p["cm_id"],"danh-muc","","");
			foreach ($child as $c) 
			{
				$result .= "<option ".(($this->session->userdata('cm_id_parent') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
			}
		}
        echo $result;
		
	}
	public function ajax_lay_ds_mainmenu()
	{
		$nn = $this->uri->rsegment(3);
		$result = "";
		$result .= "<option value=\"0\">&nbsp;</option>";
		$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($nn,"0");
		foreach ($parent as $p) 
		{
			$result .= "<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
			$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($nn,$p["cm_id"]);
			foreach ($child as $c) 
			{
				$result .= "<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
			}
		}
        echo $result;
		
	}
	public function ajax_lay_ds_menu()
	{
		//$nn = $this->uri->rsegment(3);
		$loai = $this->uri->rsegment(3);
		$result = "";
		$result .= "<option value=\"0\">&nbsp;</option>";
		$parent = $this->menu_model->lay_danh_sach_menu("0",$loai);
		foreach ($parent as $p) 
		{
			$result .= "<option ".(($this->session->userdata('m_id_parent') == $p["m_id"])?"selected":"")." value='".$p["m_id"]."'>".$p["m_ten"]."</option>";
			$child = $this->menu_model->lay_danh_sach_menu($p["m_id"],$loai);
			foreach ($child as $c) 
			{
				$result .= "<option ".(($this->session->userdata('m_id_parent') == $c["m_id"])?"selected":"")." value='".$c["m_id"]."'>|-----".$c["m_ten"]."</option>";
			}
		}
        echo $result;
		
	}
	public function ajax_xoa_nhieu_chuyen_muc()
	{
		
		$sid = $_POST['sid'];
		if($this->chuyenmuc_model->xoa_nhieu_chuyen_muc($sid)) echo "1";
		else echo "0";
	}
	public function ajax_xoa_nhieu_bai_viet()
	{
		
		$sid = $_POST['sid'];
		if($this->baiviet_model->xoa_nhieu_bai_viet($sid)) echo "1";
		else echo "0";
	}
	public function ajax_xoa_nhieu_san_pham()
	{
		
		$sid = $_POST['sid'];
		if($this->sanpham_model->xoa_nhieu_san_pham($sid)) echo "1";
		else echo "0";
	}
	public function ajax_xoa_nhieu_lien_ket()
	{
		
		$sid = $_POST['sid'];
		if($this->lienket_model->xoa_nhieu_lien_ket($sid)) echo "1";
		else echo "0";
	}
	public function ajax_xoa_nhieu_slideshow()
	{
		
		$sid = $_POST['sid'];
		if($this->slideshow_model->xoa_nhieu_slideshow($sid)) echo "1";
		else echo "0";
	}
	public function ajax_xoa_nhieu_tham_so()
	{
		
		$sid = $_POST['sid'];
		if($this->thamso_model->xoa_nhieu_tham_so($sid)) echo "1";
		else echo "0";
	}
	public function upload_hinh_bai_viet()
	{
		$id = $this->uri->rsegment(3);
		$res = 0;
		if(!is_array($_FILES["myfile"]["name"]))
		{
			$url = date("YmdHis").$this->rand_string(10).$_FILES['myfile']['name'];
			$_FILES['file']['name'] = $url;
			$_FILES['file']['type'] = $_FILES['myfile']['type'];
			$_FILES['file']['tmp_name'] = $_FILES['myfile']['tmp_name'];
			$_FILES['file']['error'] = $_FILES['myfile']['error'];
			$_FILES['file']['size'] = $_FILES['myfile']['size'];
			$config['upload_path'] = './uploads/baiviet/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '20000'; 
			//$config['file_name'] = $_FILES['myfile']['name'][$i];
			$this->load->library('upload',$config); 
			//$arr = array('msg' => 'something went wrong', 'success' => false);
			if($this->upload->do_upload('file'))
			{			   
				$data = $this->upload->data(); 
				$mydata= array('bvh_url' => $data['file_name'], 'bvh_bv_id' => $id);
				$this->baiviet_model->them_hinh_bai_viet($mydata);
				$res = 1;
				//$arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);	 
			}
		}
		else
		{
			$countfiles = count($_FILES['myfile']['name']);  
			for($i=0;$i<$countfiles;$i++)
			{
	  
				if(!empty($_FILES['myfile']['name'][$i]))
				{
					$url = date("YmdHis").$this->rand_string(10).$_FILES['myfile']['name'];
					$_FILES['file']['name'] = $url ;
					//$_FILES['file']['name'] = $_FILES['myfile']['name'][$i];
					$_FILES['file']['type'] = $_FILES['myfile']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['myfile']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['myfile']['error'][$i];
					$_FILES['file']['size'] = $_FILES['myfile']['size'][$i];
					$config['upload_path'] = './uploads/baiviet/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '20000'; 
					//$config['file_name'] = $_FILES['myfile']['name'][$i];
					$this->load->library('upload',$config); 
					//$arr = array('msg' => 'something went wrong', 'success' => false);
					if($this->upload->do_upload('file'))
					{			   
						$data = $this->upload->data(); 
						$mydata= array('bvh_url' => $data['file_name'], 'bvh_bv_id' => $id);
						$this->baiviet_model->them_hinh_bai_viet($mydata);
						$res = 1;
						//$arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);	 
					}
				}
	  
			}
		}
		echo $this->res;
		//echo json_encode($arr);
	}
	public function lay_danh_sach_hinh_bai_viet()
	{
		$id = $this->uri->rsegment(3);
		$this->data['list'] = $this->baiviet_model->lay_danh_sach_hinh_bai_viet($id);	
		$this->load->view('admin/baiviet/image', $this->data);
	}
	public function xoa_hinh_bai_viet()
	{
		$id = $this->uri->rsegment(3);
		$bv_id = $this->uri->rsegment(4);
		$hinhanh = $this->baiviet_model->lay_url_bai_viet_hinh($id);
		if($this->baiviet_model->xoa_bai_viet_hinh($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/baiviet/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->data['list'] = $this->baiviet_model->lay_danh_sach_hinh_bai_viet($bv_id);	
			$this->load->view('admin/baiviet/image', $this->data);
			
		}
        
		
	}
	public function upload_san_pham_hinh()
	{
		$id = $this->uri->rsegment(3);
		$res = 0;
		if(!is_array($_FILES["myfile"]["name"]))
		{
			$url = date("YmdHis").$this->rand_string(10).$_FILES['myfile']['name'];
			$_FILES['file']['name'] = $url;
			$_FILES['file']['type'] = $_FILES['myfile']['type'];
			$_FILES['file']['tmp_name'] = $_FILES['myfile']['tmp_name'];
			$_FILES['file']['error'] = $_FILES['myfile']['error'];
			$_FILES['file']['size'] = $_FILES['myfile']['size'];
			$config['upload_path'] = './uploads/sanpham/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '20000'; 
			$this->load->library('upload',$config); 
			if($this->upload->do_upload('file'))
			{			   
				$data = $this->upload->data(); 
				$config['image_library'] = 'GD2';
				$config['source_image'] = './uploads/sanpham/'.$data['file_name'];
				$config['create_thumb'] = FALSE;
				$config['wm_type'] = 'overlay';
				$config['wm_overlay_path'] = './uploads/logo.png';
				$config['wm_vrt_alignment'] = 'middle';
				$config['wm_hor_alignment'] = 'center';
				$config['wm_padding'] = '0';
				$config['wm_opacity'] = '50';
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->watermark();
				$mydata= array('sph_url' => $data['file_name'], 'sph_sp_id' => $id);
				$this->sanpham_model->them_san_pham_hinh($mydata);
				$res = 1;
			}
		}
		else
		{
			$countfiles = count($_FILES['myfile']['name']);  
			for($i=0;$i<$countfiles;$i++)
			{
	  
				if(!empty($_FILES['myfile']['name'][$i]))
				{
					$url = date("YmdHis").$this->rand_string(10).$_FILES['myfile']['name'];
					$_FILES['file']['name'] = $url ;
					$_FILES['file']['type'] = $_FILES['myfile']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['myfile']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['myfile']['error'][$i];
					$_FILES['file']['size'] = $_FILES['myfile']['size'][$i];
					$config['upload_path'] = './uploads/sanpham/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '20000'; 
					$this->load->library('upload',$config); 
					if($this->upload->do_upload('file'))
					{			   
						$data = $this->upload->data(); 
						$mydata= array('sph_url' => $data['file_name'], 'sph_sp_id' => $id);
						$this->sanpham_model->them_san_pham_hinh($mydata);
						$res = 1;
					}
				}
			}
		}
		echo $this->res;
	}
	public function lay_danh_sach_san_pham_hinh()
	{
		$id = $this->uri->rsegment(3);
		$this->data['list'] = $this->sanpham_model->lay_danh_sach_san_pham_hinh($id);	
		$this->load->view('admin/sanpham/image', $this->data);
	}
	public function xoa_san_pham_hinh()
	{
		$id = $this->uri->rsegment(3);
		$sp_id = $this->uri->rsegment(4);
		$hinhanh = $this->sanpham_model->lay_url_san_pham_hinh($id);
		if($this->sanpham_model->xoa_san_pham_hinh($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/sanpham/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->data['list'] = $this->sanpham_model->lay_danh_sach_san_pham_hinh($sp_id);	
			$this->load->view('admin/sanpham/image', $this->data);
			/*
			$list = $this->sanpham_model->lay_danh_sach_hinh_san_pham($sp_id);	
			$s = "";
			foreach($list as $item)
			{
				$s .= "<div class=\"image_item\">	";
					$s .= "<a onclick=\"loadDuLieu('image_list','<?php echo base_url(); ?>admin/ajax/xoa_hinh_san_pham/".$item['sph_id']."/".$item['sph_sp_id']."')\" class=\"image_item_delete\"></a>";
					$s .= "<img class=\"thumbnail\" src=\"/uploads/sanpham/".$item["sph_url"]."\">    ";               
				$s .= "</div>";
			}
			echo $s;
			*/
		}
        
		
	}
	public function them_san_pham_thuoc_tinh()
	{
		$sp = $_POST['sp'];  
		$ten = $_POST['ten']; 
		$giatri = $_POST['giatri'];  
		$mydata= array(
			'sptt_sp_id' => $sp,
			'sptt_ten' => $ten,
			'sptt_gia_tri' => $giatri
		);
		if($this->sanpham_model->them_san_pham_thuoc_tinh($mydata))
		{
			$this->data['list'] = $this->sanpham_model->lay_danh_sach_san_pham_thuoc_tinh($sp);	
			$this->load->view('admin/sanpham/thuoctinh', $this->data);
		}
		
	}
	public function lay_danh_sach_san_pham_thuoc_tinh()
	{
		$id = $this->uri->rsegment(3);
		$this->data['list'] = $this->sanpham_model->lay_danh_sach_san_pham_thuoc_tinh($id);	
		$this->load->view('admin/sanpham/thuoctinh', $this->data);
	}
	public function xoa_san_pham_thuoc_tinh()
	{
		$id = $this->uri->rsegment(3);
		$sp_id = $this->uri->rsegment(4);
		if($this->sanpham_model->xoa_san_pham_thuoc_tinh($id))
		{
			
			$this->data['list'] = $this->sanpham_model->lay_danh_sach_san_pham_thuoc_tinh($sp_id);	
			$this->load->view('admin/sanpham/thuoctinh', $this->data);
			
		}
        
		
	}
	public function lay_danh_sach_cau_truc()
	{
		$this->data['list'] = $this->cautruc_model->lay_danh_sach_cau_truc();	
		$this->load->view('admin/cauhinhsite/cautruc', $this->data);
	}
	public function ajax_them_cau_truc()
	{
		$cm_id = $_POST['cm'];  
		$vitri = $_POST['vt'];  
		$mydata= array(
			'ct_cm_id' => $cm_id,
			'ct_vi_tri' => $vitri,
			'ct_thu_tu' => date("YmdHis")
		);
		if($this->cautruc_model->kiem_tra_ton_tai_cau_truc($cm_id, $vitri)== 0) 
		{
			echo $this->cautruc_model->them_cau_truc($mydata);
		}
		
	}
	public function ajax_xoa_cau_truc()
	{
		$id = $this->uri->rsegment(3);
		if($this->cautruc_model->xoa_cau_truc($id))
		{			
			$this->data['list'] = $this->cautruc_model->lay_danh_sach_cau_truc();	
			$this->load->view('admin/cauhinhsite/cautruc', $this->data);
			
		}
        
		
	}
	public function ajax_update_thu_tu_cau_truc()
	{
		$id = $this->uri->rsegment(3);
		$mydata= array(
			'ct_thu_tu' => date("YmdHis")
		);
		if($this->cautruc_model->sua_cau_truc($mydata,$id))
		{			
			$this->data['list'] = $this->cautruc_model->lay_danh_sach_cau_truc();	
			$this->load->view('admin/cauhinhsite/cautruc', $this->data);
			
		}
        
		
	}
	public function upload_bat_dong_san_hinh()
	{
		$id = $this->uri->rsegment(3);
		$res = 0;
		if(!is_array($_FILES["myfile"]["name"]))
		{
			$url = date("YmdHis").$this->rand_string(10).$_FILES['myfile']['name'];
			$_FILES['file']['name'] = $url;
			$_FILES['file']['type'] = $_FILES['myfile']['type'];
			$_FILES['file']['tmp_name'] = $_FILES['myfile']['tmp_name'];
			$_FILES['file']['error'] = $_FILES['myfile']['error'];
			$_FILES['file']['size'] = $_FILES['myfile']['size'];
			$config['upload_path'] = './uploads/batdongsan/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '20000'; 
			//$config['file_name'] = $_FILES['myfile']['name'][$i];
			$this->load->library('upload',$config); 
			//$arr = array('msg' => 'something went wrong', 'success' => false);
			if($this->upload->do_upload('file'))
			{			   
				$data = $this->upload->data(); 
				$mydata= array('bdsh_url' => $data['file_name'], 'bdsh_bds_id' => $id);
				$this->batdongsan_model->them_bat_dong_san_hinh($mydata);
				$res = 1;
				//$arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);	 
			}
		}
		else
		{
			$countfiles = count($_FILES['myfile']['name']);  
			for($i=0;$i<$countfiles;$i++)
			{
	  
				if(!empty($_FILES['myfile']['name'][$i]))
				{
					$url = date("YmdHis").$this->rand_string(10).$_FILES['myfile']['name'];
					$_FILES['file']['name'] = $url ;
					//$_FILES['file']['name'] = $_FILES['myfile']['name'][$i];
					$_FILES['file']['type'] = $_FILES['myfile']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['myfile']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['myfile']['error'][$i];
					$_FILES['file']['size'] = $_FILES['myfile']['size'][$i];
					$config['upload_path'] = './uploads/batdongsan/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '20000'; 
					//$config['file_name'] = $_FILES['myfile']['name'][$i];
					$this->load->library('upload',$config); 
					//$arr = array('msg' => 'something went wrong', 'success' => false);
					if($this->upload->do_upload('file'))
					{			   
						$data = $this->upload->data(); 
						$mydata= array('bdsh_url' => $data['file_name'], 'bdsh_bds_id' => $id);
						$this->batdongsan_model->them_bat_dong_san_hinh($mydata);
						$res = 1;
						//$arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);	 
					}
				}
	  
			}
		}
		echo $this->res;
		//echo json_encode($arr);
	}
	public function lay_danh_sach_bat_dong_san_hinh()
	{
		$id = $this->uri->rsegment(3);
		$this->data['list'] = $this->batdongsan_model->lay_danh_sach_bat_dong_san_hinh($id);	
		$this->load->view('admin/batdongsan/image', $this->data);
	}
	public function xoa_bat_dong_san_hinh()
	{
		$id = $this->uri->rsegment(3);
		$bds_id = $this->uri->rsegment(4);
		$hinhanh = $this->batdongsan_model->lay_url_bat_dong_san_hinh($id);
		if($this->batdongsan_model->xoa_bat_dong_san_hinh($id))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/batdongsan/';
				if(file_exists($upload_path.$hinhanh))
				{
					$hinh = $this->batdongsan_model->lay_bat_dong_san_hinh_first($bds_id);
					unlink($upload_path.$hinhanh);
					$mydata= array('bds_hinh' => $hinh);
					$this->batdongsan_model->sua_bat_dong_san($mydata, $bds_id);
				}
			}
			$this->data['list'] = $this->batdongsan_model->lay_danh_sach_bat_dong_san_hinh($bds_id);	
			$this->load->view('admin/batdongsan/image', $this->data);
			
		}
        
		
	}
	
	public function lay_ds_quan_huyen()
	{
		$tt_id = $this->uri->rsegment(3);
		$result = "";
		$result .= "<label>Quận huyện:</label>";
		$result .= "<select name=\"cboQuanHuyen\" id=\"cboQuanHuyen\" class=\"form-control select2\" style=\"width:100%\" onchange=\"lay_ds_phuong_xa()\">";
		$result .= "<option value=\"\">&nbsp;</option>";
		$quanhuyen = $this->quanhuyen_model->lay_danh_sach_quan_huyen($tt_id);
		foreach ($quanhuyen as $qh) 
		{
			$result .= "<option ".(($this->session->userdata('qh_id') == $qh["qh_id"])?"selected":"")." value='".$qh["qh_id"]."'>".$qh["qh_ten"]."</option>";
			
		}
		$result .= "</select>";
		$result .= "<div class=\"error\" id=\"quanhuyen_error\"><?php echo form_error('cboQuanHuyen')?></div>";
		echo $result;
        
		
	}
	public function lay_ds_phuong_xa()
	{
		$tt_id = $this->uri->rsegment(3);
		$qh_id = $this->uri->rsegment(4);
		$result = "";
		$result .= "<label>Phường xã:</label>";
		$result .= "<select name=\"cboPhuongXa\" id=\"cboPhuongXa\" class=\"form-control select2\" style=\"width:100%\">";
		$result .= "<option value=\"\">&nbsp;</option>";
		$phuongxa = $this->phuongxa_model->lay_danh_sach_phuong_xa($tt_id, $qh_id);
		foreach ($phuongxa as $px) 
		{
			$result .= "<option ".(($this->session->userdata('px_id') == $px["px_id"])?"selected":"")." value='".$px["px_id"]."'>".$px["px_ten"]."</option>";
			
		}
		$result .= "</select>";
		$result .= "<div class=\"error\" id=\"phuongxa_error\"><?php echo form_error('cboPhuongXa')?></div>";
		echo $result;
        
		
	}
	public function rand_string( $length ) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) 
		{
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}
	public function lay_danh_sach_menu()
	{
		$this->data['m_loai'] = $this->uri->rsegment(3);
		$this->load->view('admin/menu/list', $this->data);
	}
	public function lay_danh_sach_chuyen_muc()
	{
		//$this->data['nn'] = $this->uri->rsegment(3);
		$this->data['cm_loai'] = $this->uri->rsegment(3);
		$this->load->view('admin/chuyenmuc/list', $this->data);
	}
    public function xoa_menu()
	{
		$id = $this->uri->rsegment(3);
		$loai = $this->uri->rsegment(4);
		$hinhanh = $this->menu_model->lay_hinh_menu($id, $loai);
		if($this->menu_model->xoa_menu($id, $loai))
		{
			if(strlen($hinhanh) > 0)
			{
				$upload_path = './uploads/menu/';
				if(file_exists($upload_path.$hinhanh))
					unlink($upload_path.$hinhanh);
			}
			$this->data['m_loai'] = $loai;
			$this->load->view('admin/menu/list', $this->data);
		}
		
		
	}
	public function update_thu_tu_menu()
	{
		$id = $this->uri->rsegment(3);
		$loai = $this->uri->rsegment(4);
		$mydata= array('m_thu_tu' => date('YmdHis'));
		if($this->menu_model->sua_menu($mydata, $id, $loai))
		{
			$this->data['m_loai'] = $loai;
			$this->load->view('admin/menu/list', $this->data);
		}
		
	}
	public function them_menu()
	{
		$tuychon = $this->uri->rsegment(3);
		$cm_id = $this->uri->rsegment(4);
		$id = date('YmdHis');
		$thutu = date('YmdHis');
		$ten = "";
		$link = "";
		$idparent = "";
		$thutu = "";
		
		$row = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($cm_id);
		$id = $cm_id;
		$ten = $row["cm_ten"];
		if($tuychon == "trang-don" || $tuychon == "menu")
			$link = "/".$row["cm_slug"].".html";
		else $link = "/".$row["cm_loai"]."/".$row["cm_slug"].".html";
		$idparent = $row["cm_id_parent"];
		$thutu = $row["cm_thu_tu"];
		
		$loaimenu = $this->uri->rsegment(5);
		
		$mydata= array(
				'm_id' => $id,
				'm_ten' => $ten,
				'm_id_parent' => $idparent,
				'm_thu_tu' => $thutu,
				'm_link' => $link,
				'm_loai_link' => "_parent",
				'm_loai' => $loaimenu,
				'm_cm_id' => $cm_id
		);
		if($this->menu_model->kiem_tra_ton_tai_menu($id, $loaimenu) == 0)
		{
			if($this->menu_model->them_menu($mydata))
			{
				$this->data['m_loai'] = $loaimenu;
				$this->load->view('admin/menu/list', $this->data);
			}
		}
		
	}
	/**********DOI TAC***********************/
	public function ajax_lay_thong_tin_don_hang()
	{
		//$dt_id = $this->uri->rsegment(3);
        $dh_id = $_POST['dh_id'];
		$dh = $this->donhang_model->lay_thong_tin_don_hang($dh_id);
		echo json_encode($dh);
	}
}