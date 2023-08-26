<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chucnang_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('chucnang');
	}
	public function them_chuc_nang($mydata)
	{
		return $this->db->insert($this->table, $mydata);
		//echo $this->db->last_query();
	}
	public function sua_chuc_nang($mydata, $id)
	{
		$this->db->where('cn_id',$id);
		return $this->db->update($this->table, $mydata);
		print_r($this->db->last_query()); 
	}
	public function xoa_chuc_nang($id)
	{
		$this->db->where('cn_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_chuc_nang($id)
	{
		$this->db->where('cn_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_chuc_nang($idparent, $trangthai)
	{
		if(strlen($trangthai) > 0)
			$this->db->where('cn_trang_thai', $trangthai);
		if(strlen($idparent) > 0)
			$this->db->where('cn_id_parent', $idparent);			
		$this->db->order_by('cn_thu_tu', 'asc');
        $query = $this->db->get($this->table);
		//echo $this->db->last_query(); 
        return $query->result_array();

	}
	public function lay_hinh_chuc_nang($id)
    {
        $this->db->where('cn_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['cn_hinh'];
    }
	
}
