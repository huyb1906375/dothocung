<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cauhinhsite_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('cauhinhsite');
	}
	//Thêm
	public function them_cau_hinh_site($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_cau_hinh_site($mydata, $id)
	{
		$this->db->where('chs_id',$id);
		return $this->db->update($this->table, $mydata);
	}

	public function xoa_cau_hinh_site($id)
	{
		$this->db->where('chs_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_cau_hinh_site($id)
	{
		$this->db->where('chs_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_cau_hinh_site()
	{
		$query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_logo_cau_hinh_site($id)
    {
        $this->db->where('chs_id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['chs_logo'];
    }
	public function lay_logo_mobile_cau_hinh_site($id)
    {
        $this->db->where('chs_id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['chs_logo_mobile'];
    }
	public function lay_favicon_cau_hinh_site($id)
    {
        $this->db->where('chs_id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['chs_favicon'];
    }
	public function lay_banner_cau_hinh_site($id)
    {
        $this->db->where('chs_id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['chs_banner'];
    }
	public function lay_hinh_nen_cau_hinh_site($id)
    {
        $this->db->where('chs_id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['chs_hinh_nen'];
    }
}
