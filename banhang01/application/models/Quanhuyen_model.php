<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quanhuyen_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('quanhuyen');
	}
	public function them_quan_huyen($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_quan_huyen($mydata, $id)
	{
		$this->db->where('qh_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	public function xoa_quan_huyen($id)
	{
		$this->db->where('qh_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_quan_huyen($id)
	{
		$this->db->where('qh_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_thong_tin_quan_huyen_bang_slug($slug)
	{
		$this->db->where('qh_slug',$slug);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_quan_huyen($tt_id)
	{
		if(strlen($tt_id) > 0)
			$this->db->where('qh_tt_id',$tt_id);
		$this->db->join('tinhthanh', 'qh_tt_id = tt_id', 'left');
		$this->db->order_by('qh_ten', 'asc');	
		
        $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();
	}
	public function lay_danh_sach_quan_huyen_gioi_han($tt_id,$limit,$first)
	{
		if(strlen($tt_id) > 0)
			$this->db->where('qh_tt_id',$tt_id);
		$this->db->join('tinhthanh', 'qh_tt_id = tt_id', 'left');
		$this->db->order_by('qh_ten', 'asc');
		//print_r($this->db->last_query()); 
        $query = $this->db->get($this->table,$limit,$first);
		
        return $query->result_array();
	} 
}
