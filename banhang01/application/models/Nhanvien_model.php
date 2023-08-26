<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nhanvien_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('nhanvien');
	}
	//Thêm
	public function them_nhan_vien($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_nhan_vien($mydata, $id)
	{
		$this->db->where('nv_id',$id);
		return $this->db->update($this->table, $mydata);
	}

	public function xoa_nhan_vien($id)
	{
		$this->db->where('nv_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_nhan_vien($id)
	{
		$this->db->where('nv_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_nhan_vien()
	{
		//$this->db->where('nv_trang_thai', 1);		
        $query = $this->db->get($this->table);
		//echo $this->db->last_query(); 
        return $query->result_array();
	}
	public function lay_danh_sach_nhan_vien_gioi_han($limit,$first)
	{
        $query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	public function lay_hinh_nhan_vien($id)
    {
        $this->db->where('nv_id', $id);
        $query = $this->db->get($this->table);
        $row = $query->row_array();
        return $row['nv_hinh'];
    }
	
    
}
