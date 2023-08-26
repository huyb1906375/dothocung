<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('video');
	}
	//Thêm
	public function them_video($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_video($mydata, $id)
	{
		$this->db->where('v_id',$id);
		return $this->db->update($this->table, $mydata);		
	}

	public function xoa_video($id)
	{
		$this->db->where('v_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_video($id)
	{
		$this->db->where('v_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_thong_tin_video_bang_slug($slug)
	{
		$this->db->where('v_slug',$slug);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_hinh_video($id)
    {
        $this->db->where('v_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['v_hinh'];
    }
	public function lay_file_van_ban($id)
    {
        $this->db->where('v_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['v_file_van_ban'];
    }
	public function lay_danh_sach_video_cung_chuyen_muc($cm_id, $v_id, $limit, $first)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'chuyen-muc-video', "");
			$this->db->where("v_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where_not_in('v_id', $v_id);
		$this->db->where('v_trang_thai',1);
		$this->db->join('chuyenmuc', 'v_cm_id = cm_id', 'left');
		
		$this->db->order_by('v_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_ten_video($id)
    {
        $this->db->where('v_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cm_ten'];
    }
	public function lay_danh_sach_video_xem_nhieu($vitri, $limit, $first)
	{
		if(strlen($vitri) > 0)
		{
			$cm_ids = $this->cautruc_model->lay_ids_chuyen_muc_theo_vi_tri($vitri);
			$this->db->where("v_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('v_trang_thai',1);
		$this->db->join('chuyenmuc', 'v_cm_id = cm_id', 'left');
		$this->db->order_by('v_luot_xem', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_danh_sach_video_moi($vitri, $limit, $first)
	{
		if(strlen($vitri) > 0)
		{
			$cm_ids = $this->cautruc_model->lay_ids_chuyen_muc_theo_vi_tri($vitri);
			$this->db->where("v_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('v_trang_thai',1);
		$this->db->join('chuyenmuc', 'v_cm_id = cm_id', 'left');
		$this->db->order_by('v_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function tim_kiem_video_bang_tu_khoa($tukhoa)
	{
		
		if(strlen($tukhoa) > 0)
		{	    
	        $arraylike = array('v_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('v_thu_tu', 'desc');
		print_r($this->db->last_query());
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function lay_danh_sach_video($cm_id, $loai, $tukhoa)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'chuyen-muc-video', "");
			$this->db->where("v_cm_id IN (" . $cm_ids . ")");
		}
		if(strlen($loai) > 0)
		{
			if($loai == "xuatban")
				$this->db->where('v_trang_thai',1);
			if($loai == "chuaxuatban")
				$this->db->where('v_trang_thai',0);
			if($loai == "noibat")
				$this->db->where('v_noi_bat',1);
			if($loai == "tieudiem")
				$this->db->where('v_tieu_diem',1);
		}
		$this->db->join('chuyenmuc', 'v_cm_id = cm_id', 'left');
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('v_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('v_thu_tu', 'desc');
        $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_danh_sach_video_gioi_han($cm_id, $loai, $tukhoa, $limit, $first)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'chuyen-muc-video', "");
			$this->db->where("v_cm_id IN (" . $cm_ids . ")");
		}
		if(strlen($loai) > 0)
		{
			if($loai == "xuatban")
				$this->db->where('v_trang_thai',1);
			if($loai == "chuaxuatban")
				$this->db->where('v_trang_thai',0);
			if($loai == "noibat")
				$this->db->where('v_noi_bat',1);
			if($loai == "tieudiem")
				$this->db->where('v_tieu_diem',1);
		}
		$this->db->join('chuyenmuc', 'v_cm_id = cm_id', 'left');
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('v_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('v_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
		else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function tim_kiem_video($cm_id, $tukhoa,$limit,$first)
	{
		if(strlen($cm_id) > 0)
			$this->db->where('v_cm_id', $cm_id);
		if(strlen($tukhoa) > 0)
			$this->db->like('v_search', $tukhoa);
		$this->db->order_by('v_thutu', 'desc');
		$query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	public function lay_danh_sach_video_theo_vi_tri($vitri,$limit,$first)
	{
		$catgory = $this->cautruc_model->lay_danh_sach_cau_truc_theo_vi_tri($vitri);
		$cm_ids = "";
		foreach ($catgory as $item) {
			$cm_ids .= "'".$item["ct_cm_id"]."',";
		}
		$cm_ids = trim($cm_ids);
		$cm_ids = trim($cm_ids, ',');
		$this->db->where("v_cm_id IN (".$cm_ids.")");
		$this->db->join('nguoidung', 'v_nd_id = nd_id', 'left');
		$this->db->order_by('v_thu_tu', 'desc');
        $query = $this->db->get($this->table, $limit, $first);
		//print_r($this->db->last_query()); 
        return $query->result_array();
		/*
		$sql = "select distinct v_id,v_ten, v_tom_tat, v_hinh ";
		$sql .= "from video where v_cm_id in ";
		$sql .= "(select ct_cm_id from cautruc where ct_vi_tri = '".$vitri."') ";
		$sql .= "limit "
		$this->db->select("v_id,v_ten, v_tom_tat, v_hinh" );
			$this->db->where("video");
			$this->db->where()*/
	}
	public function lay_danh_sach_video_theo_loai($cm_id, $loai, $limit, $first)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'chuyen-muc-video', "");
			$this->db->where("v_cm_id IN (" . $cm_ids . ")");
		}
		if(strlen($loai) > 0)
		{
			if($loai == "xuatban")
				$this->db->where('v_trang_thai',1);
			if($loai == "chuaxuatban")
				$this->db->where('v_trang_thai',0);
			if($loai == "noibat")
				$this->db->where('v_noi_bat',1);
			if($loai == "tieudiem")
				$this->db->where('v_tieu_diem',1);
		}
		$this->db->join('chuyenmuc', 'v_cm_id = cm_id', 'left');
		$this->db->order_by('v_thu_tu', 'desc');
        $query = $this->db->get($this->table, $limit, $first);
        return $query->result_array();

	}
	
}
