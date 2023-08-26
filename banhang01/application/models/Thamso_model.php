<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thamso_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('thamso');
	}
	public function them_tham_so($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_tham_so($mydata, $id)
	{
		$this->db->where('ts_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	public function xoa_tham_so($id)
	{
		$this->db->where('ts_id',$id);
		return $this->db->delete($this->table);
	}
	public function xoa_nhieu_tham_so($sid)
	{
		$this->db->where("ts_id IN (".$sid.")");
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_tham_so($id)
	{
		$this->db->where('ts_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_tham_so($tukhoa)
	{
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('ts_tu_khoa' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('ts_id', 'asc');	
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_danh_sach_tham_so_gioi_han($tukhoa,$limit,$first)
	{
		if(strlen($tukhoa) > 0){	    
	        $arraylike = array('ts_tu_khoa' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('ts_id', 'asc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
		else $query = $this->db->get($this->table);
        return $query->result_array();
	} 
}
