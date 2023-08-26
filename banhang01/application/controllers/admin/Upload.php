<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanpham extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->helper(array("form", "url"));
    }
      
    public function index(){
        $data['errors'] = '';
        $this->load->view("upload_view", $data);
    }
	//upload binh thuong
	public function doupload(){
        if($this->input->post("ok")){
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '900';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library("upload", $config);
            if($this->upload->do_upload("img")){
                echo 'Upload Ok';
                    $check = $this->upload->data();
                    echo "<pre>";
                    print_r($check);
                    echo "</pre>";
            }else{
                $data['errors'] = $this->upload->display_errors();
                $this->load->view("upload_view", $data);
            }
        }
    } 
	public function doupload2(){
        if($this->input->post("ok")){
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '900';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library("upload", $config);
            if($this->upload->do_upload("img")){
                echo 'Upload Ok';
                    $check = $this->upload->data();
                    echo "<pre>";
                    print_r($check);
                    echo "</pre>";
                   $this->load->library("image_lib");
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/'.$check['file_name'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = 150;
                    $config['height']   = 120;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
            }else{
                $data['errors'] = $this->upload->display_errors();
                $this->load->view("upload_view", $data);
            }
        }
    }
	public function doupload3(){
        if($this->input->post("ok")){
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '900';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library("upload", $config);
            if($this->upload->do_upload("img")){
                echo 'Upload Ok';
                    $check = $this->upload->data();
                    echo "<pre>";
                    print_r($check);
                    echo "</pre>";
                    $this->load->library("image_lib");
                    /*$config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/'.$check['file_name'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = 150;
                    $config['height']   = 120;*/
 
                    $config['wm_type'] = 'overlay';
                    $config['wm_overlay_path'] = './uploads/logo.png';
                    $config['wm_vrt_alignment'] = 'bottom';
                    $config['wm_hor_alignment'] = 'right';
                    $config['wm_padding'] = '0';
                    $config['wm_opacity'] = '50';
                    $this->image_lib->initialize($config);
                    $this->image_lib->watermark();
            }else{
                $data['errors'] = $this->upload->display_errors();
                $this->load->view("upload_view", $data);
            }
        }
    }
	public function doupload4(){
        if($this->input->post("ok")){
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '900';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library("upload", $config);
            if($this->upload->do_upload("img")){
                echo "Upload thanh cong";
                echo "<pre>";
                print_r($this->upload->data());
                echo "</pre>";
                $check=$this->upload->data();
                $this->load->library("image_lib");
                $config['image_library'] = 'gd2';
                $config['source_image'] = './uploads/'.$check['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 150;
                $config['height']   = 120;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                unset($config);
                
                $config['source_image'] = './uploads/'.$check['file_name'];
                $config['create_thumb'] = FALSE;
                $config['wm_type'] = 'overlay';
                $config['wm_overlay_path'] = './uploads/logo.png';
                $config['wm_vrt_alignment'] = 'bottom';
                $config['wm_hor_alignment'] = 'right';
                $config['wm_padding'] = '0';
                $config['wm_opacity'] = '50';
                $this->image_lib->initialize($config);
                $this->image_lib->watermark();
            }else{
                $data['errors'] = $this->upload->display_errors();
                $this->load->view("upload_view", $data);
            }
        }
    }
	public function doupload5(){
        if($this->input->post("ok")){
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '900';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library("upload", $config);
            if($this->upload->do_upload("img")){
                echo "Upload thanh cong";
                echo "<pre>";
                print_r($this->upload->data());
                echo "</pre>";
                $check=$this->upload->data();
                $this->load->library("image_lib");
                $config['image_library'] = 'gd2';
                $config['source_image'] = './uploads/'.$check['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 150;
                $config['height']   = 120;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                unset($config);
                
                $config['source_image'] = './uploads/'.$check['file_name'];
                $config['create_thumb'] = FALSE;
                $config['wm_type'] = 'overlay';
                $config['wm_overlay_path'] = './uploads/logo.png';
                $config['wm_vrt_alignment'] = 'bottom';
                $config['wm_hor_alignment'] = 'right';
                $config['wm_padding'] = '0';
                $config['wm_opacity'] = '50';
                $this->image_lib->initialize($config);
                $this->image_lib->watermark();
            }else{
                $data['errors'] = $this->upload->display_errors();
                $this->load->view("upload_view", $data);
            }
        }
    }
	 
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */