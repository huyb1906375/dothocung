<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanpham_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('sanpham');
	}
	//Thêm
	public function them_san_pham($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_san_pham($mydata, $id)
	{
		$this->db->where('sp_id',$id);
		return $this->db->update($this->table, $mydata);
		
	}

	public function xoa_san_pham($id)
	{
		$this->db->where('sp_id',$id);
		return $this->db->delete($this->table);
	}
	public function xoa_nhieu_san_pham($sid)
	{
		$this->db->where("sp_id IN (".$sid.")");
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_san_pham($id)
	{
		$this->db->where('sp_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_thong_tin_san_pham_bang_slug($slug)
	{
		$this->db->where('sp_slug',$slug);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_hinh_san_pham($id)
    {
        $this->db->where('sp_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['sp_hinh'];
    }
	
	public function them_san_pham_hinh($mydata)
	{
		return $this->db->insert("sanphamhinh", $mydata);
	}
	public function lay_url_san_pham_hinh($id)
    {
        $this->db->where('sph_id', $id);
        $query = $this->db->get('sanphamhinh');
        $row=$query->row_array();
        return $row['sph_url'];
    }
	public function xoa_san_pham_hinh($id)
	{
		$this->db->where('sph_id',$id);
		return $this->db->delete('sanphamhinh');
	}
	public function lay_danh_sach_san_pham_hinh($id)
	{
		$this->db->where('sph_sp_id',$id);
		$query = $this->db->get('sanphamhinh');
        return $query->result_array();
	}
	public function lay_danh_sach_san_pham_hinh_gioi_han($id, $limit, $first)
	{
		$this->db->where('sph_sp_id',$id);
		if($limit > 0)
			$query = $this->db->get("sanphamhinh", $limit, $first);
		else $query = $this->db->get("sanphamhinh");
        return $query->result_array();
	}
	public function lay_ten_san_pham($id)
    {
        $this->db->where('sp_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cm_ten'];
    }
	public function lay_danh_sach_san_pham_autocomplete($tukhoa)
	{		
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('sp_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('sp_ten', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function lay_danh_sach_san_pham($cm_id, $loai, $tukhoa)
	{
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'danh-muc', "");
			$this->db->where("sp_cm_id IN (" . $cm_ids . ")");
		}
		if($loai == "chuaxuatban")
			$this->db->where('sp_trang_thai',0);
		if($loai == "noibat")
			$this->db->where('sp_noi_bat',1);
		if($loai == "moi")
			$this->db->where('sp_moi',1);
		if($loai == "khuyenmai")
			$this->db->where('sp_khuyen_mai',1);
		if($loai == "banchay")
			$this->db->where('sp_ban_chay',1);
		$this->db->join('chuyenmuc', 'sp_cm_id = cm_id', 'left');
		if(strlen($tukhoa)){	    
	        $arraylike = array('sp_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('sp_thu_tu', 'desc');
        $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_danh_sach_san_pham_gioi_han($cm_id, $loai, $tukhoa, $limit, $first)
	{
		
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'danh-muc', "");
			$this->db->where("sp_cm_id IN (" . $cm_ids . ")");
		}
		if($loai == "chuaxuatban")
			$this->db->where('sp_trang_thai',0);
		if($loai == "noibat")
			$this->db->where('sp_noi_bat',1);
		if($loai == "moi")
			$this->db->where('sp_moi',1);
		if($loai == "khuyenmai")
			$this->db->where('sp_khuyen_mai',1);
		if($loai == "banchay")
			$this->db->where('sp_ban_chay',1);
		$this->db->join('chuyenmuc', 'sp_cm_id = cm_id', 'left');
		if(strlen($tukhoa)){	    
	        $arraylike = array('sp_slug' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('sp_thu_tu', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
		else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function public_lay_danh_sach_san_pham($cm_id, $loai, $tukhoa, $limit, $first, $order)
	{
		
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'danh-muc', "");
			$this->db->where("sp_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('sp_trang_thai',1);
		if($loai == "noibat")
			$this->db->where('sp_noi_bat',1);
		if($loai == "moi")
			$this->db->where('sp_moi',1);
		if($loai == "khuyenmai")
			$this->db->where('sp_khuyen_mai',1);
		if($loai == "banchay")
			$this->db->where('sp_ban_chay',1);
		$this->db->join('chuyenmuc', 'sp_cm_id = cm_id', 'left');
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('sp_search' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		if(strlen($order) > 0){	    
	        if($order == "Order")
				$this->db->order_by('sp_thu_tu', 'desc');
			if($order == "View21")
				$this->db->order_by('sp_luot_xem', 'desc');
			if($order == "NameAZ")
				$this->db->order_by('sp_ten', 'asc');
			if($order == "NameZA")
				$this->db->order_by('sp_ten', 'desc');
			if($order == "Price12")
				$this->db->order_by('sp_gia_ban', 'asc');
			if($order == "Price21")
				$this->db->order_by('sp_gia_ban', 'desc');
	    }
		
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
		else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function lay_danh_sach_san_pham_lien_quan($cm_id, $sp_id,$limit,$first)
	{
		
		if(strlen($cm_id) > 0)
		{
			$cm_ids = $this->chuyenmuc_model->lay_ids_chuyen_muc($cm_id, 'danh-muc', "");
			$this->db->where("sp_cm_id IN (" . $cm_ids . ")");
		}
		$this->db->where('sp_trang_thai',1);
		$this->db->where_not_in('sp_id', $sp_id);
		$this->db->order_by('sp_thu_tu', 'desc');
        if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
		else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function tim_kiem_san_pham($cm_id, $tukhoa,$limit,$first)
	{
		if(strlen($cm_id) > 0)
			$this->db->where('sp_cm_id', $cm_id);
		if(strlen($tukhoa) > 0)
			$this->db->like('sp_search', $tukhoa);
		$this->db->order_by('sp_thu_tu', 'desc');
		$query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	public function them_san_pham_thuoc_tinh($mydata)
	{
		return $this->db->insert("sanphamthuoctinh", $mydata);
	}
	public function lay_danh_sach_san_pham_thuoc_tinh($id)
	{
		$this->db->where('sptt_sp_id',$id);
		$query = $this->db->get('sanphamthuoctinh');
        return $query->result_array();
	}
	public function xoa_san_pham_thuoc_tinh($id)
	{
		$this->db->where('sptt_id',$id);
		return $this->db->delete('sanphamthuoctinh');
	}
}