<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donhang_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('donhang');
	}
	public function them_don_hang($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}
	public function sua_don_hang($mydata, $id)
	{
		$this->db->where('dh_id',$id);
		return $this->db->update($this->table, $mydata);
	}
	
	public function xoa_don_hang($id)
	{
		$this->db->where('dh_id',$id);
		return $this->db->delete($this->table);
	}
	
	public function lay_thong_tin_don_hang($id)
	{
		$this->db->where('dh_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function them_don_hang_chi_tiet($mydata)
	{
		return $this->db->insert("donhangchitiet", $mydata);
	}
	public function lay_tong_so_don_hang($trangthai)
    {
		$this->db->select('dh_id');
        $this->db->where('dh_trang_thai', $trangthai);
        $query = $this->db->get($this->table); 
		$list = $query->result_array();
		$number = count($list);
		return $number;
    }
	public function lay_tong_thanh_tien_don_hang_chi_tiet($id)
    {
		$this->db->select('sum(dhct_thanh_tien) as thanh_tien');
        $this->db->where('dhct_dh_id', $id);
		$this->db->group_by('dhct_dh_id');
        $query = $this->db->get('donhangchitiet');
		//print_r($this->db->last_query()); 
		$row = $query->row_array();
		$number = 0;
        if($row['thanh_tien']!="")
			$number = $row['thanh_tien'];
		return $number;
    }
	public function lay_so_san_pham_trong_gio($id)
    {
		$this->db->select('sum(dhct_so_luong) as so_luong');
        $this->db->where('dhct_dh_id', $id);
		$this->db->group_by('dhct_dh_id');
        $query = $this->db->get('donhangchitiet');
		//print_r($this->db->last_query()); 
		$row = $query->row_array();
		$number = 0;
		if($row)
		{
			if($row['so_luong']!="")
				$number = $row['so_luong'];
		}
		return $number;
    }
	public function lay_ds_don_hang_chi_tiet($dh_id)
    {
        $this->db->select('dhct_id, dhct_sp_id, dhct_dh_id, dhct_so_luong, dhct_don_gia, dhct_thanh_tien,sp_id, sp_ten, sp_hinh, sp_slug');
		$this->db->join('sanpham', 'dhct_sp_id = sp_id', 'left');
		$this->db->where('dhct_dh_id',$dh_id);
		$this->db->order_by('dhct_id', 'asc');
		$query = $this->db->get("donhangchitiet");
		//print_r($this->db->last_query()); 
        return $query->result_array();
    }
	public function lay_thong_tin_don_hang_chi_tiet($dh_id, $sp_id)
	{
		$this->db->where('dhct_dh_id',$dh_id);
		$this->db->where('dhct_sp_id',$sp_id);
		$query = $this->db->get('donhangchitiet');
        return $query->row_array();
	}
	public function kiem_tra_don_hang_chi_tiet($dh_id, $sp_id)
	{
		$this->db->where('dhct_dh_id',$dh_id);
		$this->db->where('dhct_sp_id',$sp_id);
		$query = $this->db->get('donhangchitiet');
        return count($query->result_array());
	}
	public function xoa_don_hang_chi_tiet($id)
	{
		$this->db->where('dhct_id',$id);
		return $this->db->delete('donhangchitiet');
	}
	public function sua_don_hang_chi_tiet($mydata, $id)
	{
		$this->db->where('dhct_id',$id);
		return $this->db->update('donhangchitiet', $mydata);
	}
	public function lay_danh_sach_don_hang($tungay, $denngay, $dt_id, $hoten, $trangthai, $limit, $first)
	{
		$this->db->select('dh_id, dh_ky_hieu, dh_ngay_lap, dh_ten, dh_dia_chi, dh_dien_thoai, dh_ghi_chu, dh_tong_cong, dh_thanh_toan, dh_phuong_thuc_thanh_toan, dh_trang_thai');
		//$this->db->join('doitac', 'dh_kh_id = kh_id', 'left');
		if(strlen($tungay) > 0)
			$this->db->where('dh_ngay_lap >=', $tungay.' 00:00:00');
		if(strlen($denngay) > 0)
			$this->db->where('dh_ngay_lap <=', $denngay.' 23:59:00');
		if(strlen($dt_id) > 0)
		{
			$this->db->where('dh_dt_id', $dt_id);
		}
		if(strlen($hoten) > 0)
		{	    
	        $arraylike = array('dh_ten' => $hoten);	    
	        $this->db->like($arraylike);   
	    }
		if(strlen($trangthai) > 0)
		{
			$this->db->where('dh_trang_thai', $trangthai);
		}
		$this->db->order_by('dh_id', 'desc');
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
        else $query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	public function tra_cuu_don_hang($dh_id)
	{
		$this->db->select('dh_id, dh_ky_hieu, dh_ngay_lap, dh_ten, dh_dia_chi, dh_dien_thoai, dh_ghi_chu, dh_tong_cong, dh_phuong_thuc_thanh_toan, dh_trang_thai');
		$this->db->where('dh_id', $dh_id);
		$this->db->order_by('dh_id', 'desc');
		$query = $this->db->get($this->table);
		//print_r($this->db->last_query()); 
        return $query->result_array();

	}
	
	
	
}