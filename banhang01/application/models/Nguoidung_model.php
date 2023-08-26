<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nguoidung_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('nguoidung');
	}
	//Thêm
	public function them_nguoi_dung($mydata)
	{
		return $this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function sua_nguoi_dung($mydata, $id)
	{
		$this->db->where('nd_id',$id);
		return $this->db->update($this->table, $mydata);
	}

	public function xoa_nguoi_dung($id)
	{
		$this->db->where('nd_id',$id);
		return $this->db->delete($this->table);
	}
	public function lay_thong_tin_nguoi_dung($id)
	{
		$this->db->where('nd_id',$id);
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	public function lay_danh_sach_nguoi_dung()
	{
		//$this->db->where('nd_trang_thai', 1);		
        $query = $this->db->get($this->table);
		//echo $this->db->last_query(); 
        return $query->result_array();
	}
	public function lay_danh_sach_nguoi_dung_gioi_han($limit,$first)
	{
        $query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}
	public function lay_hinh_nguoi_dung($id)
    {
        $this->db->where('nd_id', $id);
        $query = $this->db->get($this->table);
        $row = $query->row_array();
        return $row['nd_hinh'];
    }
	function dang_nhap($username, $password)
    {
    	$this->db->where('nd_ten_dang_nhap', $username);
    	$this->db->where('nd_mat_khau', $password);
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
	function dang_nhap_admin($username, $password)
    {
    	$this->db->where('nd_ten_dang_nhap', $username);
    	$this->db->where('nd_mat_khau', $password);
		$this->db->where('nd_admin', 1);
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
	public function kiem_tra_ten_dang_nhap($tendangnhap)
	{
		$this->db->where('nd_ten_dang_nhap', $tendangnhap);
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
		$this->db->where('nd_ip', $ip);
		$this->db->where('nd_ngay_dang_ky', $ngay);
        $query = $this->db->get($this->table);
		$result = false;
        if(count($query->result_array()) > 3)
        {
        	$result = true;
        }
        return $result;
	}
	
	function kiem_tra_ton_tai_nguoi_dung($username, $password)
    {
    	$this->db->where('nd_ten_dang_nhap', $username);
    	$this->db->where('nd_mat_khau', $password);
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
	public function lay_mat_khau($email)
    {
        $this->db->where('nd_email', $email);
        $query = $this->db->get($this->table);
        $row = $query->row_array();
		$s = "";
		if($row != NULL) $s = $row['nd_mat_khau'];
        return $s;
    }
	public function lay_id_bang_email($email)
    {
        $this->db->where('nd_email', $email);
        $query = $this->db->get($this->table);
        $row = $query->row_array();
		$s = "";
		if($row != NULL) $s = $row['nd_id'];
        return $s;
    }
	public function lay_id_bang_chuoi_bao_mat($chuoibaomat)
    {
        $this->db->where('nd_chuoi_bao_mat', $chuoibaomat);
        $query = $this->db->get($this->table);
        $row = $query->row_array();
		$s = "";
		if($row != NULL) $s = $row['nd_id'];
        return $s;
    }
    
}
