<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cautruc_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('cautruc');
	}
	//Thêm
	public function them_cau_truc($mydata)
	{
		 
		//$ok = $this->db->insert($this->table, $mydata);
		//$s = $this->db->last_query();
		//return $s;
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_cau_truc($mydata, $id)
	{
		$this->db->where('ct_id',$id);
		return $this->db->update($this->table, $mydata);
		
	}
	public function xoa_cau_truc($id)
	{
		$this->db->where('ct_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_cau_truc($id)
	{
		$this->db->where('ct_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function kiem_tra_ton_tai_cau_truc($cm_id, $vitri)
	{
		$this->db->where('ct_cm_id',$cm_id);
		$this->db->where('ct_vi_tri',$vitri);
		$query = $this->db->get($this->table);
			//echo $this->db->last_query();
         return count($query->result_array());
	}

	
	public function lay_danh_sach_cau_truc()
	{

		$this->db->select("ct_id, cm_ten, ct_vi_tri");
		$this->db->join('chuyenmuc', 'ct_cm_id = cm_id', 'left');
		//$this->db->order_by('ct_vi_tri', 'asc');
		$this->db->order_by('ct_thu_tu', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function lay_danh_sach_cau_truc_theo_vi_tri($vitri)
	{
		$this->db->join('chuyenmuc', 'ct_cm_id = cm_id', 'left');
		if(strlen($ngonngu) == 0)
			$ngonngu == "vi";
		$this->db->where("ct_vi_tri IN (" . $vitri . ")");
		//$this->db->where('ct_vi_tri',$vitri);
		$this->db->order_by('ct_thu_tu', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();

	}
	public function lay_ids_chuyen_muc_theo_vi_tri($vitri)
	{
		$this->db->where("ct_vi_tri IN (" . $vitri . ")");
		//$this->db->where('ct_vi_tri',$vitri);
		$query = $this->db->get($this->table);
		$catgory = $query->result_array();
		$ids = "";
		foreach ($catgory as $item) 
		{
			$ids .= "'".$item["ct_cm_id"]."',";
			$catgory2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($item["ct_cm_id"], "chuyen-muc", "xuatban");
			foreach ($catgory2 as $item2) {
				$ids .= "'".$item2["cm_id"]."',";
			}
		}
		$ids = trim($ids);
		$ids = trim($ids, ',');		
		return $ids;
	}
	
}

/* End of file mcategory.php */
/* Location: ./application/models/mcategory.php */