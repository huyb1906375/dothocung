<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cauhinhthanhtoan_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('cauhinhthanhtoan');
	}
	//Thêm
	public function them_cau_hinh_thanh_toan($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_cau_hinh_thanh_toan($mydata, $id)
	{
		$this->db->where('chtt_id',$id);
		return $this->db->update($this->table, $mydata);
	}

	public function xoa_cau_hinh_thanh_toan($id)
	{
		$this->db->where('chtt_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_cau_hinh_thanh_toan($id)
	{
		$this->db->where('chtt_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	
}
