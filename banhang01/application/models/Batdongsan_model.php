<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batdongsan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('batdongsan');
	}
	//Thêm
	public function them_bat_dong_san($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_bat_dong_san($mydata, $id)
	{
		$this->db->where('bds_id',$id);
		return $this->db->update($this->table, $mydata);
		
	}

	public function xoa_bat_dong_san($id)
	{
		$this->db->where('bds_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_bat_dong_san($id)
	{
		$this->db->where('bds_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_thong_tin_bat_dong_san_bang_slug($slug)
	{
		$this->db->where('bds_slug',$slug);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_bat_dong_san($cm_id, $loai, $tt_id, $qh_id, $px_id, $tukhoa)
	{
		
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'loai-bat-dong-san', "");
			$this->db->where("bds_cm_id IN (" . $cm_ids . ")");
		}
		if(strlen($loai) > 0)
		{
			if($loai == "chuaxuatban")
				$this->db->where('bds_trang_thai',0);
			if($loai == "noibat")
				$this->db->where('bds_noi_bat',1);
			if($loai == "chuagiaodich")
				$this->db->where('bds_giao_dich',0);
			if($loai == "dagiaodich")
				$this->db->where('bds_giao_dich',1);
		}
		if(strlen($tt_id) > 0)
			$this->db->where('bds_tt_id',$tt_id);
		if(strlen($qh_id) > 0)
			$this->db->where('bds_qh_id',$qh_id);
		if(strlen($px_id) > 0)
			$this->db->where('bds_px_id',$px_id);
		if(strlen($tukhoa)){	    
	        $arraylike = array('bds_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		
		$this->db->order_by('bds_thu_tu', 'desc');
        $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function public_lay_danh_sach_bat_dong_san($cm_id,  $tt_id, $qh_id, $px_id, $tukhoa)
	{
		
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'loai-bat-dong-san', "");
			$this->db->where("bds_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('bds_trang_thai', 1);
		$this->db->where('bds_giao_dich', 0);
		if(strlen($tt_id) > 0)
			$this->db->where('bds_tt_id',$tt_id);
		if(strlen($qh_id) > 0)
			$this->db->where('bds_qh_id',$qh_id);
		if(strlen($px_id) > 0)
			$this->db->where('bds_px_id',$px_id);
		if(strlen($tukhoa)){	    
	        $arraylike = array('bds_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		$this->db->join('quanhuyen', 'bds_qh_id = qh_id', 'left');
		$this->db->join('phuongxa', 'bds_px_id = px_id', 'left');
		$this->db->join('nguoidung', 'bds_nd_id = nd_id', 'left');
		$this->db->order_by('bds_thu_tu', 'desc');
        $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function public_lay_danh_sach_bat_dong_san_gioi_han($cm_id,  $tt_id, $qh_id, $px_id, $tukhoa, $limit,$first)
	{
		
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'loai-bat-dong-san', "");
			$this->db->where("bds_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('bds_trang_thai', 1);
		$this->db->where('bds_giao_dich', 0);
		if(strlen($tt_id) > 0)
			$this->db->where('bds_tt_id',$tt_id);
		if(strlen($qh_id) > 0)
			$this->db->where('bds_qh_id',$qh_id);
		if(strlen($px_id) > 0)
			$this->db->where('bds_px_id',$px_id);
		if(strlen($tukhoa)){	    
	        $arraylike = array('bds_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		$this->db->join('quanhuyen', 'bds_qh_id = qh_id', 'left');
		$this->db->join('phuongxa', 'bds_px_id = px_id', 'left');
		$this->db->join('nguoidung', 'bds_nd_id = nd_id', 'left');
		$this->db->order_by('bds_thu_tu', 'desc');
        $query = $this->db->get($this->table,$limit,$first);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_ds_bat_dong_san_noi_bat()
	{
		$this->db->where('bds_noi_bat', 1);
		$this->db->where('bds_trang_thai', 1);
		$this->db->where('bds_giao_dich', 0);
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		$this->db->join('quanhuyen', 'bds_qh_id = qh_id', 'left');
		$this->db->join('phuongxa', 'bds_px_id = px_id', 'left');
		
		$this->db->order_by('bds_thu_tu', 'desc');
		$query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_ds_bat_dong_san_moi($limit,$first)
	{
		//$this->db->where('bds_noi_bat', 0);
		$this->db->where('bds_trang_thai', 1);
		$this->db->where('bds_giao_dich', 0);
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		$this->db->join('quanhuyen', 'bds_qh_id = qh_id', 'left');
		$this->db->join('phuongxa', 'bds_px_id = px_id', 'left');
		$this->db->join('nguoidung', 'bds_nd_id = nd_id', 'left');
		$this->db->order_by('bds_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table,$limit,$first);
		else $query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_ds_bat_dong_san_cung_chuyen_muc($cm_id, $id, $giaodich)
	{
		$this->db->where('bds_cm_id', $cm_id);
		$this->db->where_not_in('bds_id', $id);
		$this->db->where('bds_trang_thai', 1);
		$this->db->where('bds_giao_dich', $giaodich);
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		$this->db->join('quanhuyen', 'bds_qh_id = qh_id', 'left');
		$this->db->join('phuongxa', 'bds_px_id = px_id', 'left');
		$this->db->order_by('bds_thu_tu', 'desc');
		$query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_ds_bat_dong_san_cung_nguoi_dang($nd_id, $id, $giaodich, $limit,$first)
	{
		$this->db->where('bds_nd_id', $nd_id);
		$this->db->where_not_in('bds_id', $id);
		$this->db->where('bds_trang_thai', 1);
		$this->db->where('bds_giao_dich', $giaodich);
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		$this->db->join('quanhuyen', 'bds_qh_id = qh_id', 'left');
		$this->db->join('phuongxa', 'bds_px_id = px_id', 'left');
		$this->db->order_by('bds_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table,$limit,$first);
		else $query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_hinh_bat_dong_san($id)
    {
        $this->db->where('bds_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['bds_hinh'];
    }
	public function lay_bat_dong_san_hinh_first($id)
    {
		$s = "";
        $this->db->where('bdsh_bds_id', $id);
		$this->db->order_by('bdsh_id', 'asc');
		$query = $this->db->get("batdongsanhinh", 1, 0);
        $row=$query->row_array();
		if(strlen($row['bdsh_url']) > 0)
			$s = $row['bdsh_url'];
        return $s;
    }
	public function them_bat_dong_san_hinh($mydata)
	{
		return $this->db->insert("batdongsanhinh", $mydata);
	}
	public function lay_url_bat_dong_san_hinh($id)
    {
        $this->db->where('bdsh_id', $id);
        $query = $this->db->get('batdongsanhinh');
        $row=$query->row_array();
        return $row['bdsh_url'];
    }
	public function xoa_bat_dong_san_hinh($id)
	{
		$this->db->where('bdsh_id',$id);
		return $this->db->delete('batdongsanhinh');
	}
	public function lay_danh_sach_bat_dong_san_hinh($id)
	{
		$this->db->where('bdsh_bds_id',$id);
		$query = $this->db->get('batdongsanhinh');
        return $query->result_array();
	}
	
	public function lay_ten_bat_dong_san($id)
    {
        $this->db->where('bds_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['lbds_ten'];
    }
	
	public function lay_danh_sach_bat_dong_san_gioi_han($cm_id, $loai, $tt_id, $qh_id, $px_id, $tukhoa, $limit, $first)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'loai-bat-dong-san', "");
			$this->db->where("bds_cm_id IN (" . $cm_ids . ")");
		}
		if($loai == "chuaxuatban")
			$this->db->where('bds_trang_thai',0);
		if($loai == "noibat")
			$this->db->where('bds_noi_bat',1);
		if($loai == "chuagiaodich")
			$this->db->where('bds_giao_dich',0);
		if($loai == "dagiaodich")
			$this->db->where('bds_giao_dich',1);
		if(strlen($tt_id) > 0)
			$this->db->where('bds_tt_id',$tt_id);
		if(strlen($qh_id) > 0)
			$this->db->where('bds_qh_id',$qh_id);
		if(strlen($px_id) > 0)
			$this->db->where('bds_px_id',$px_id);
		$this->db->join('chuyenmuc', 'bds_cm_id = cm_id', 'left');
		if(strlen($tukhoa)){	    
	        $arraylike = array('bds_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('bds_thu_tu', 'desc');
        $query = $this->db->get($this->table, $limit, $first);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}

	public function tim_kiem_bat_dong_san($lbds_id, $tukhoa,$limit,$first)
	{
		if(strlen($lbds_id) > 0)
			$this->db->where('bds_lbds_id', $lbds_id);
		if(strlen($tukhoa) > 0)
			$this->db->like('bds_search', $tukhoa);
		$this->db->order_by('bds_thu_tu', 'desc');
		$query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	
}
