<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baohanh_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('baohanh');
	}
	public function them_bao_hanh($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_bao_hanh($mydata, $id)
	{
		$this->db->where('bh_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	
	public function xoa_bao_hanh($id)
	{
		$this->db->where('bh_id',$id);
		return $this->db->delete($this->table);
	}
	
	public function lay_thong_tin_bao_hanh($id)
	{
		$this->db->where('bh_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_hinh_bao_hanh($id)
    {
        $this->db->where('bh_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['bh_hinh'];
    }
	public function lay_tong_so_bao_hanh($trangthai)
    {
		$this->db->select('bh_id');
        $this->db->where('bh_trang_thai', $trangthai);
        $query = $this->db->get($this->table); 
		$list = $query->result_array();
		$number = count($list);
		return $number;
    }

	public function lay_danh_sach_bao_hanh($tukhoa, $trangthai, $limit, $first)
	{
		//$this->db->select('bh_id, bh_ky_hieu, bh_ngay_lap, bh_ten,  bh_dien_thoai, bh_thiet_bi, bh_ghi_chu, bh_trang_thai');
		if(strlen($tukhoa) > 0)
		{	    
	        $arraylike = array('bh_search' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		if($trangthai > 0)
		{
			$this->db->where('bh_trang_thai', $trangthai);
		}
		$this->db->order_by('bh_id', 'desc');
		$query = $this->db->get($this->table);
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function tra_cuu_bao_hanh($tukhoa)
	{
		if(strlen($tukhoa) > 0)
		{	    
	        $arraylike = array('bh_search' => $tukhoa);	    
	        $this->db->like($arraylike);   
	    }
		$this->db->order_by('bh_ngay_lap', 'desc');
		$query = $this->db->get($this->table);
        return $query->result_array();

	}
	
	
	
}