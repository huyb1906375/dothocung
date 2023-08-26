<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slideshow_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('slideshow');
	}
	public function them_slideshow($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_slideshow($mydata, $id)
	{
		$this->db->where('slide_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	
	public function xoa_slideshow($id)
	{
		$this->db->where('slide_id',$id);
		return $this->db->delete($this->table);
	}
	public function xoa_nhieu_slideshow($sid)
	{
		$this->db->where("slide_id IN (".$sid.")");
		return $this->db->delete($this->table);
	}
	public function hien_an_slideshow($id, $trangthai)
	{
		$this->db->where('slide_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_slideshow($id)
	{
		$this->db->where('slide_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_hinh_slideshow($id)
    {
        $this->db->where('slide_id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['slide_hinh'];
    }
	public function lay_danh_sach_slideshow($loai)
	{
		if($loai == "chuaxuatban")
			$this->db->where('slide_trang_thai', 0);
		if($loai == "xuatban")
			$this->db->where('slide_trang_thai', 1);
		$this->db->order_by('slide_thu_tu', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}

	
}