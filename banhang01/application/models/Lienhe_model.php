<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lienhe_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('lienhe');
	}
	public function them_lien_he($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_lien_he($mydata, $id)
	{
		$this->db->where('lk_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	
	public function xoa_lien_he($id)
	{
		$this->db->where('lk_id',$id);
		return $this->db->delete($this->table);
	}
	public function hien_an_lien_he($id, $trangthai)
	{
		$this->db->where('lk_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_lien_he($id)
	{
		$this->db->where('lk_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	
	
	
}