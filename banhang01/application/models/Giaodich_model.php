<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Giaodich_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('giaodich');
	}
	public function them_giao_dich($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_giao_dich($mydata, $id)
	{
		$this->db->where('gd_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	public function xoa_giao_dich($id)
	{
		$this->db->where('gd_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_giao_dich($id)
	{
		$this->db->where('gd_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_thong_tin_giao_dich_bang_slug($slug)
	{
		$this->db->where('gd_slug',$slug);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	
	public function lay_so_du_hien_tai($nd_id)
	{
		$this->db->select("SUM(gd_so_tien) AS sotien");		
		$this->db->from("giaodich");
		$this->db->where('gd_nd_id',$nd_id);
		$query = $this->db->get();
		$number = 0;
		//echo $this->db->last_query();
        if($query->num_rows() > 0)
        { 
			$res = $query->row_array();
			$number = $res['sotien'];
        }
		return $number;
	}
	/*
	public function lay_so_du_giao_dich($nd_id, $thutu)
	{
		$sql = "select gd_id, gd_ten, gd_so_tien, nd_ten, "
		$sql .= "isnull(select sum(sotien) from giaodich where gd_nd_id = '".$nd_id."' and gd_id <= '".$thutu."',0) as gd_so_du ";
		$sql .= "from giaodich a left join nguoidung b on a.gd_nd_id = b.nd_id ";
		$sql .= "where gd_nd_id = '".$nd_id."' ";
		$sql .= "order by gd_id desc ";
		$query=$this->db->query($sql);
		if($query->num_rows() > 0)
        { 
			$res = $query->row_array();
			return $res['sotien'];
        }
       return 0;
	}*/
	public function lay_danh_sach_giao_dich($nd_id)
	{
		if(strlen($nd_id) > 0)
			$this->db->where('gd_nd_id',$nd_id);
		$this->db->join('nguoidung', 'gd_nd_id = nd_id', 'left');
		$this->db->order_by('gd_id', 'desc');			
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function lay_danh_sach_giao_dich_gioi_han($nd_id,$limit,$first)
	{
		$sql = "select gd_id, gd_thoi_gian, gd_noi_dung, gd_so_tien,nd_ten_dang_nhap, nd_ten, ";
		$sql .= "(select sum(gd_so_tien) from giaodich where gd_nd_id = a.gd_nd_id and gd_id <= a.gd_id) as gd_so_du ";
		$sql .= "from giaodich a left join nguoidung b on a.gd_nd_id = b.nd_id ";
		if(strlen($nd_id) > 0)
			$sql .= "where gd_nd_id = '".$nd_id."' ";
		$sql .= "order by gd_id desc ";
		if($limit > 0)
			$sql .= "limit ".$first.",".$limit." ";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	/*
	public function lay_danh_sach_giao_dich_gioi_han($nd_id,$limit,$first)
	{
		if(strlen($nd_id) > 0)
			$this->db->where('gd_nd_id',$nd_id);
		$this->db->join('nguoidung', 'gd_nd_id = nd_id', 'left');
		$this->db->order_by('gd_id', 'desc'); 
		if($limit > 0)
			$query = $this->db->get($this->table,$limit,$first);
		else
			$query = $this->db->get($this->table);
        return $query->result_array();
	} 
	*/
}
