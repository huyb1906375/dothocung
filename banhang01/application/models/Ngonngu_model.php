<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ngonngu_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('ngonngu');
	}
	public function them_ngon_ngu($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_ngon_ngu($mydata, $id)
	{
		$this->db->where('nn_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	public function xoa_ngon_ngu($id)
	{
		$this->db->where('nn_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_ngon_ngu($id)
	{
		$this->db->where('nn_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_ngon_ngu()
	{
		$this->db->order_by('nn_thu_tu', 'asc');	
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
	
}
