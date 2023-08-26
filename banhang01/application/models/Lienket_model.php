<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lienket_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('lienket');
	}
	public function them_lien_ket($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_lien_ket($mydata, $id)
	{
		$this->db->where('lk_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	
	public function xoa_lien_ket($id)
	{
		$this->db->where('lk_id',$id);
		return $this->db->delete($this->table);
	}
	public function xoa_nhieu_lien_ket($sid)
	{
		$this->db->where("lk_id IN (".$sid.")");
		return $this->db->delete($this->table);
	}
	public function hien_an_lien_ket($id, $trangthai)
	{
		$this->db->where('lk_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_lien_ket($id)
	{
		$this->db->where('lk_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_hinh_lien_ket($id)
    {
        $this->db->where('lk_id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['lk_hinh'];
    }
	public function lay_danh_sach_lien_ket($loai, $vitri)
	{
		if($loai == "chuaxuatban")
			$this->db->where('lk_trang_thai', 0);
		if($loai == "noibat")
			$this->db->where('lk_noi_bat', 1);
		if($loai == "binhthuong")
			$this->db->where('lk_noi_bat', 0);
		if(strlen($vitri) > 0)
		{
			if($vitri != "All")
				$this->db->where('lk_vi_tri', $vitri);
		}
		$this->db->order_by('lk_thu_tu', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}

	public function lay_danh_sach_lien_ket_gioi_han($loai, $vitri,$limit,$first)
	{
		if($loai == "chuaxuatban")
			$this->db->where('lk_trang_thai', 0);
		if($loai == "noibat")
		{
			$this->db->where('lk_trang_thai', 1);
			$this->db->where('lk_noi_bat', 1);
		}
		if($loai == "binhthuong")
		{
			$this->db->where('lk_trang_thai', 1);
			$this->db->where('lk_noi_bat', 0);
		}
		if(strlen($vitri) > 0)
		{
			if($vitri != "All")
				$this->db->where('lk_vi_tri', $vitri);
		}
		$this->db->order_by('lk_thu_tu', 'asc');
        $query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	
}