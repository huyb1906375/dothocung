<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baiviet_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('baiviet');
	}
	//Thêm
	public function them_bai_viet($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_bai_viet($mydata, $id)
	{
		$this->db->where('bv_id',$id);
		//$ok = $this->db->update($this->table, $mydata);
		//print_r($this->db->last_query()); 
		return $this->db->update($this->table, $mydata);
		
	}

	public function xoa_bai_viet($id)
	{
		$this->db->where('bv_id',$id);
		return $this->db->delete($this->table);
	}
	public function xoa_nhieu_bai_viet($sid)
	{
		$this->db->where("bv_id IN (".$sid.")");
		return $this->db->delete($this->table);
	}
	public function kich_hoat_bai_viet()
	{		
		$this->db->where('bv_trang_thai',0); 
		$this->db->where('bv_ngay_dang < ',date("Y-m-d H:i:s")); 
		$mydata= array('bv_trang_thai' => 1);
		return $this->db->update($this->table, $mydata);
	}
	public function lay_thong_tin_bai_viet($id)
	{
		$this->db->where('bv_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_thong_tin_bai_viet_bang_slug($slug)
	{
		$this->db->where('bv_slug',$slug);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_hinh_bai_viet($id)
    {
        $this->db->where('bv_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['bv_hinh'];
    }
	
	public function lay_file_van_ban1($id)
    {
        $this->db->where('bv_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['bv_file1'];
    }
	public function lay_file_van_ban2($id)
    {
        $this->db->where('bv_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['bv_file2'];
    }
	public function them_hinh_bai_viet($mydata)
	{
		return $this->db->insert("baiviethinh", $mydata);
	}
	public function lay_url_bai_viet_hinh($id)
    {
        $this->db->where('bvh_id', $id);
        $query = $this->db->get('baiviethinh');
        $row=$query->row_array();
        return $row['bvh_url'];
    }
	public function xoa_bai_viet_hinh($id)
	{
		$this->db->where('bvh_id',$id);
		return $this->db->delete('baiviethinh');
	}
	public function lay_danh_sach_hinh_bai_viet($id)
	{
		$this->db->where('bvh_bv_id',$id);
		$query = $this->db->get('baiviethinh');
        return $query->result_array();
	}
	public function lay_danh_sach_bai_viet_cung_chuyen_muc($cm_id, $bv_id, $limit, $first)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'chuyen-muc', "");
			$this->db->where("bv_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where_not_in('bv_id', $bv_id);
		$this->db->where('bv_trang_thai',1);
		$this->db->join('chuyenmuc', 'bv_cm_id = cm_id', 'left');
		
		$this->db->order_by('bv_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_ten_bai_viet($id)
    {
        $this->db->where('bv_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cm_ten'];
    }
	public function lay_danh_sach_bai_viet_xem_nhieu($vitri, $limit, $first)
	{
		if(strlen($vitri) > 0)
		{
			$cm_ids = $this->cautruc_model->lay_ids_chuyen_muc_theo_vi_tri($ngonngu,$vitri);
			$this->db->where("bv_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('bv_trang_thai',1);
		$this->db->join('chuyenmuc', 'bv_cm_id = cm_id', 'left');
		$this->db->order_by('bv_luot_xem', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_danh_sach_bai_viet_moi($vitri, $limit, $first)
	{
		if(strlen($vitri) > 0)
		{
			$cm_ids = $this->cautruc_model->lay_ids_chuyen_muc_theo_vi_tri($vitri);
			$this->db->where("bv_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('bv_trang_thai',1);
		$this->db->where('bv_noi_bat',0);
		$this->db->join('chuyenmuc', 'bv_cm_id = cm_id', 'left');
		$this->db->order_by('bv_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_danh_sach_bai_viet_noi_bat($vitri, $limit, $first)
	{
		if(strlen($vitri) > 0)
		{
			$cm_ids = $this->cautruc_model->lay_ids_chuyen_muc_theo_vi_tri($ngonngu,$vitri);
			$this->db->where("bv_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('bv_trang_thai',1);
		$this->db->where('bv_noi_bat',1);
		$this->db->join('chuyenmuc', 'bv_cm_id = cm_id', 'left');
		$this->db->order_by('bv_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function tim_kiem_bai_viet_bang_tu_khoa($tukhoa)
	{
		
		if(strlen($tukhoa) > 0)
		{	    
	        $arraylike = array('bv_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('bv_thu_tu', 'desc');
		print_r($this->db->last_query());
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function lay_danh_sach_bai_viet($cm_id, $loai, $tukhoa)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'chuyen-muc', "");
			$this->db->where("bv_cm_id IN (" . $cm_ids . ")");
		}
		if(strlen($loai) > 0)
		{
			if($loai == "xuatban")
				$this->db->where('bv_trang_thai',1);
			if($loai == "chuaxuatban")
				$this->db->where('bv_trang_thai',0);
			if($loai == "noibat")
				$this->db->where('bv_noi_bat',1);
			if($loai == "tieudiem")
				$this->db->where('bv_tieu_diem',1);
		}
		$this->db->join('chuyenmuc', 'bv_cm_id = cm_id', 'left');
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('bv_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('bv_thu_tu', 'desc');
        $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_danh_sach_bai_viet_gioi_han($cm_id, $loai, $tukhoa, $limit, $first)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'chuyen-muc', "");
			$this->db->where("bv_cm_id IN (" . $cm_ids . ")");
		}
		if(strlen($loai) > 0)
		{
			if($loai == "xuatban")
				$this->db->where('bv_trang_thai',1);
			if($loai == "chuaxuatban")
				$this->db->where('bv_trang_thai',0);
			if($loai == "noibat")
				$this->db->where('bv_noi_bat',1);
			if($loai == "tieudiem")
				$this->db->where('bv_tieu_diem',1);
		}
		$this->db->join('chuyenmuc', 'bv_cm_id = cm_id', 'left');
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('bv_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('bv_thu_tu', 'desc');
        $query = $this->db->get($this->table, $limit, $first);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	/*
	public function lay_danh_sach_bai_viet_gioi_han($cm_id,$limit,$first)
	{
		if(strlen($cm_id) > 0)
			$this->db->where('bv_cm_id', $cm_id);
		$this->db->order_by('bv_thutu', 'desc');
		$query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	*/
	public function tim_kiem_bai_viet($cm_id, $tukhoa,$limit,$first)
	{
		if(strlen($cm_id) > 0)
			$this->db->where('bv_cm_id', $cm_id);
		if(strlen($tukhoa) > 0)
			$this->db->like('bv_search', $tukhoa);
		$this->db->order_by('bv_thutu', 'desc');
		$query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	public function lay_danh_sach_bai_viet_theo_vi_tri($vitri,$limit,$first)
	{
		$catgory = $this->cautruc_model->lay_danh_sach_cau_truc_theo_vi_tri($vitri);
		$cm_ids = "";
		foreach ($catgory as $item) {
			$cm_ids .= "'".$item["ct_cm_id"]."',";
		}
		$cm_ids = trim($cm_ids);
		$cm_ids = trim($cm_ids, ',');
		$this->db->where("bv_cm_id IN (".$cm_ids.")");
		$this->db->join('nguoidung', 'bv_nd_id = nd_id', 'left');
		$this->db->order_by('bv_thu_tu', 'desc');
        $query = $this->db->get($this->table, $limit, $first);
		//print_r($this->db->last_query()); 
        return $query->result_array();
		/*
		$sql = "select distinct bv_id,bv_ten, bv_tom_tat, bv_hinh ";
		$sql .= "from baiviet where bv_cm_id in ";
		$sql .= "(select ct_cm_id from cautruc where ct_vi_tri = '".$vitri."') ";
		$sql .= "limit "
		$this->db->select("bv_id,bv_ten, bv_tom_tat, bv_hinh" );
			$this->db->where("baiviet");
			$this->db->where()*/
	}
	public function lay_danh_sach_bai_viet_theo_loai($cm_id, $loai, $limit, $first)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($ngonngu,$cm_id, 'chuyen-muc', "");
			$this->db->where("bv_cm_id IN (" . $cm_ids . ")");
		}
		if(strlen($loai) > 0)
			$this->db->where('bv_loai',$loai);
		$this->db->join('chuyenmuc', 'bv_cm_id = cm_id', 'left');
		$this->db->order_by('bv_thu_tu', 'desc');
        $query = $this->db->get($this->table, $limit, $first);
        return $query->result_array();

	}
	
}
