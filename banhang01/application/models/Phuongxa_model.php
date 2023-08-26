<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phuongxa_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('phuongxa');
	}
	public function them_phuong_xa($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_phuong_xa($mydata, $id)
	{
		$this->db->where('px_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	public function xoa_phuong_xa($id)
	{
		$this->db->where('px_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_phuong_xa($id)
	{
		$this->db->where('px_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_phuong_xa($tt_id, $qh_id)
	{
		if(strlen($tt_id) > 0)
			$this->db->where('px_tt_id',$tt_id);
		if(strlen($qh_id) > 0)
			$this->db->where('px_qh_id',$qh_id);
		$this->db->join('tinhthanh', 'px_tt_id = tt_id', 'left');
		$this->db->join('quanhuyen', 'px_qh_id = qh_id', 'left');
		$this->db->order_by('px_ten', 'asc');	
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_danh_sach_phuong_xa_gioi_han($tt_id, $qh_id,$limit,$first)
	{
		if(strlen($tt_id) > 0)
			$this->db->where('px_tt_id',$tt_id);
		if(strlen($qh_id) > 0)
			$this->db->where('px_qh_id',$qh_id);
		$this->db->join('tinhthanh', 'px_tt_id = tt_id', 'left');
		$this->db->join('quanhuyen', 'px_qh_id = qh_id', 'left');
		$this->db->order_by('px_ten', 'asc');
		//print_r($this->db->last_query()); 
        $query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	} 
}
