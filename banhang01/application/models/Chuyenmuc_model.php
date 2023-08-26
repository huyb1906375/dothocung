<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chuyenmuc_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('chuyenmuc');
	}
	//Thêm
	public function them_chuyen_muc($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_chuyen_muc($mydata, $id)
	{
		$this->db->where('cm_id',$id);
		//echo $this->db->last_query();
		return $this->db->update($this->table, $mydata);
		
	}
	
	public function xoa_chuyen_muc($id)
	{
		$this->db->where('cm_id',$id);
		return $this->db->delete($this->table);
	}
	public function xoa_nhieu_chuyen_muc($sid)
	{
		$this->db->where("cm_id IN (".$sid.")");
		return $this->db->delete($this->table);
	}
	public function hien_an_chuyen_muc($id, $trangthai)
	{
		$this->db->where('cm_id',$id);
		return $this->db->delete($this->table);
	}
	/*
	public function chuyen_muc_xoa($id)
	{
        if(is_array($id)){
            $this->db->where_in('cm_id', $id);
        }else{
            $this->db->where('cm_id', $id);
        }
        $delete = $this->db->delete($this->table);
        return $delete?true:false;
    }
	*/
	public function lay_thong_tin_chuyen_muc($id)
	{
		$this->db->where('cm_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_thong_tin_chuyen_muc_bang_slug($slug)
	{
		$this->db->where('cm_slug',$slug);
		$this->db->where("cm_loai IN ('chuyen-muc','chuyen-muc-video','danh-muc','trang-don')");
		//$this->db->where('cm_loai','chuyen-muc');
		//$this->db->or_where('cm_loai','chuyen-muc-video');
		$query = $this->db->get($this->table);
		//echo $this->db->last_query();
        return $query->row_array();
	}
	public function lay_cm_id_bang_slug($slug)
    {
        $this->db->where('cm_slug', $slug);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cm_id'];
    }
	public function lay_ten_chuyen_muc($id)
    {
        $this->db->where('cm_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cm_ten'];
    }
	public function lay_hinh_chuyen_muc($id)
    {
        $this->db->where('cm_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cm_hinh'];
    }
	public function lay_idparent_chuyen_muc($id)
	{
		$this->db->where('cm_id',$id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cm_id_parent'];
	}
	public function lay_danh_sach_chuyen_muc_gioi_han($idparent, $loai, $trangthai,$limit,$first)
	{
		if(strlen($idparent) > 0)
			$this->db->where('cm_id_parent', $idparent);
		if(strlen($loai) > 0)
			$this->db->where('cm_loai', $loai);
		
		if(strlen($trangthai) > 0)
		{
			if($trangthai == "chuaxuatban")
				$this->db->where('cm_trang_thai', 0);
			if($trangthai == "noibat")
				$this->db->where('cm_noi_bat', 1);
			if($trangthai == "binhthuong")
				$this->db->where('cm_noi_bat', 0);
		}
		$this->db->order_by('cm_thu_tu', 'desc');
        $query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	public function lay_danh_sach_chuyen_muc($idparent, $loai, $trangthai)
	{
		if(strlen($idparent) > 0)
			$this->db->where('cm_id_parent', $idparent);
		if(strlen($loai) > 0)
			$this->db->where('cm_loai', $loai);
		
		if(strlen($trangthai) > 0)
		{
			if($trangthai == "chuaxuatban")
				$this->db->where('cm_trang_thai', 0);
			if($trangthai == "xuatban")
				$this->db->where('cm_trang_thai', 1);
			if($trangthai == "noibat")
				$this->db->where('cm_noi_bat', 1);
			if($trangthai == "binhthuong")
				$this->db->where('cm_noi_bat', 0);
		}
		$this->db->order_by('cm_thu_tu', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function lay_danh_sach_chuyen_muc_menu($idparent)
	{				
		if(strlen($idparent) > 0)
			$this->db->where('cm_id_parent', $idparent);
		$this->db->where('cm_menu', 1);
		$this->db->order_by('cm_thu_tu', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function dem_bat_dong_san_theo_quan_huyen()
	{
		$sql = "select qh_ten,qh_slug, (select count(bds_id) from batdongsan where bds_qh_id = a.qh_id) as qh_so_tin ";
		$sql .= "from quanhuyen a ";
		$sql .= "order by qh_ten ";
		$query= $this->db->query($sql);
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
	public function lay_ids_chuyen_muc($idparent, $loai, $trangthai)
	{
		$catgory = $this->lay_danh_sach_chuyen_muc($idparent, $loai, $trangthai);
		$ids = "'".$idparent."',";
		foreach ($catgory as $item) {
			$ids .= "'".$item["cm_id"]."',";
			$catgory2 = $this->lay_danh_sach_chuyen_muc($item["cm_id"], $loai, $trangthai);
			foreach ($catgory2 as $item2) {
				$ids .= "'".$item2["cm_id"]."',";
			}
		}
		$ids = trim($ids);
		$ids = trim($ids, ',');
		
		return $ids;
	}
	public function lay_so_bai_viet_theo_chuyen_muc($idparent)
	{
		$sql = "select bv_id ";
		$sql .= "from baiviet ";
		$sql .= "where bv_cm_id in ";
		$sql .= "(".$this->lay_ids_chuyen_muc($idparent, "chuyen-muc","").")";
		$query= $this->db->query($sql);
		//print_r($this->db->last_query()); 
        //$query->result_array();
        return count($query->result_array());
	}
}