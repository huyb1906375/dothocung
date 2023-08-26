<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tinhthanh_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('tinhthanh');
	}
	public function them_tinh_thanh($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_tinh_thanh($mydata, $id)
	{
		$this->db->where('tt_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	public function xoa_tinh_thanh($id)
	{
		$this->db->where('tt_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_tinh_thanh($id)
	{
		$this->db->where('tt_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_tinh_thanh()
	{
		$this->db->order_by('tt_ten', 'asc');	
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_danh_sach_tinh_thanh_gioi_han($limit,$first)
	{
		$this->db->order_by('tt_ten', 'asc');
        $query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	} 
}
