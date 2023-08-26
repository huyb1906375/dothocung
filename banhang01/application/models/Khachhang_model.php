<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Khachhang_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('doitac');
	}
	//Thêm
	public function them_khach_hang($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_khach_hang($mydata, $id)
	{
		$this->db->where('dt_id',$id);
		return $this->db->update($this->table, $mydata);
	}

	public function xoa_khach_hang($id)
	{
		$this->db->where('dt_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_khach_hang($id)
	{
		$this->db->where('dt_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_khach_hang($tukhoa,$limit,$first)
	{	
		if(strlen($tukhoa) > 0)
			$this->db->like('dt_search', $tukhoa);
        
		if($limit > 0)
			$query = $this->db->get($this->table, $limit, $first);
		else $query = $this->db->get($this->table);
		//echo $this->db->last_query(); 
        return $query->result_array();
	}
	public function lay_danh_sach_khach_hang_gioi_han($limit,$first)
	{
        $query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	public function lay_hinh_khach_hang($id)
    {
        $this->db->where('dt_id', $id);
        $query = $this->db->get($this->table);
        $row = $query->row_array();
        return $row['dt_hinh'];
    }
	public function kich_hoat_khach_hang($id)
	{		
		$this->db->where('dt_id',$id); 
		$mydata= array('dt_trang_thai' => 1);
		return $this->db->update($this->table, $mydata);
	}
	public function kiem_tra_ten_dang_nhap($tendangnhap)
	{
		$this->db->where('dt_username', $tendangnhap);
        $query = $this->db->get($this->table);
		$result = false;
        if(count($query->result_array()) > 0)
        {
        	$result = true;
        }
        return $result;
	}
	public function kiem_tra_ip_dang_ky($ip, $ngay)
	{
		$this->db->where('dt_ip', $ip);
		$this->db->where('dt_ngay_dang_ky', $ngay);
        $query = $this->db->get($this->table);
		$result = false;
        if(count($query->result_array()) > 3)
        {
        	$result = true;
        }
        return $result;
	}
	function dang_nhap($username, $password)
    {
    	$this->db->where('dt_username', $username);
    	$this->db->where('dt_password', $password);
    	$query = $this->db->get($this->table);
        if(count($query->result_array())==1)
        {
        	return $query->row_array();
        }
        else
        {
        	return FALSE;
        }	
    }
	function kiem_tra_ton_tai_khach_hang($username, $password)
    {
    	$this->db->where('dt_username', $username);
    	$this->db->where('dt_password', $password);
    	$query = $this->db->get($this->table);
        if(count($query->result_array())==1)
        {
        	return TRUE;
        }
        else
        {
        	return FALSE;
        }	
    }

    
}
