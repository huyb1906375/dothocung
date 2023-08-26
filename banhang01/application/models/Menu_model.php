<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('menu');
	}
	//Thêm
	public function them_menu($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_menu($mydata, $id)
	{
		$this->db->where('m_id',$id);
		//echo $this->db->last_query();
		return $this->db->update($this->table, $mydata);
		
	}
	
	public function xoa_menu($id)
	{
		$this->db->where('m_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_menu($id)
	{
		$this->db->where('m_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function kiem_tra_ton_tai_menu($id, $loai)
	{
		$this->db->where('m_id',$id);
		$this->db->where('m_loai',$loai);
		$query = $this->db->get($this->table);		
        return count($query->result_array());
	}
	public function lay_ten_menu($id)
    {
        $this->db->where('m_id', $id);		
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['m_ten'];
    }
	public function lay_hinh_menu($id)
    {
        $this->db->where('m_id', $id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['m_hinh'];
    }
	public function lay_idparent_menu($id)
	{
		$this->db->where('m_id',$id);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['m_id_parent'];
	}
	
	
	public function lay_danh_sach_menu($idparent, $loai)
	{
		if(strlen($idparent) > 0)
			$this->db->where('m_id_parent', $idparent);
		if(strlen($loai) > 0)
			$this->db->where('m_loai', $loai);
		$this->db->order_by('m_thu_tu', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function lay_ids_menu($idparent, $loai, $vitri)
	{
		$catgory = $this->lay_danh_sach_menu($idparent, $loai, $vitri);
		$ids = "'".$idparent."',";
		foreach ($catgory as $item) {
			$ids .= "'".$item["m_id"]."',";
		}
		$ids = trim($ids);
		$ids = trim($ids, ',');
		
		return $ids;
	}
	
}