<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cauhinhemail_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('cauhinhemail');
	}
	//Thêm
	public function them_cau_hinh_email($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_cau_hinh_email($mydata, $id)
	{
		$this->db->where('che_id',$id);
		return $this->db->update($this->table, $mydata);
	}

	public function xoa_cau_hinh_email($id)
	{
		$this->db->where('che_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_cau_hinh_email($id)
	{
		$this->db->where('che_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	
}
