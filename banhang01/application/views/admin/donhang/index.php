<form id="frm" name="frm" action="<?php echo base_url() ?>admin/donhang" method="post"  enctype="multipart/form-data" >
<?php
$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","chuyen-muc","", "");
$option = "";
foreach ($parent as $p) 
{
	$option.="<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
	$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"chuyen-muc","","");
	foreach ($child as $c) 
	{
		$option.="<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
		$child2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($c["cm_id"],"chuyen-muc","","");
		foreach ($child2 as $c2) 
		{
			$option.="<option ".(($this->session->userdata('cm_id') == $c2["cm_id"])?"selected":"")." value='".$c2["cm_id"]."'>|----------".$c2["cm_ten"]."</option>";
		}
	}
}

?>
<section class="content-header">
  	<h1>
        ĐƠN HÀNG
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Đơn hàng</li>
  	</ol>
</section>
<section class="content">
	<div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
					<?php  if($this->session->flashdata('success')):?>
						<div class="col-md-12">
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						</div>
					<?php  endif;?>
					<?php  if($this->session->flashdata('error')):?>
						<div class="col-md-12">
							<div class="alert alert-error">
								<?php echo $this->session->flashdata('error'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						</div>
					<?php  endif;?>
                	<div class="form-group col-md-2">
					  <label class="control-label">Từ ngày:</label>
					  <div class='input-group date' id='dateTuNgay'>
						 <input id="txtTuNgay" name="txtTuNgay" type='text' class="form-control" value="<?php echo $this->session->userdata('tungay');?>" />
						 <span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						 </span>
					  </div>
					</div>
					<div class="form-group col-md-2">
					  <label class="control-label">Đến ngày:</label>
					  <div class='input-group date' id='dateDenNgay'>
						 <input id="txtDenNgay" name="txtDenNgay" type='text' class="form-control" value="<?php echo $this->session->userdata('denngay');?>" />
						 <span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						 </span>
					  </div>
					</div>
					<div class="form-group col-md-2">
                        <label class="control-label">Họ tên:</label>
                       	<input type="text" id="txtHoTen" name="txtHoTen" class="form-control" value="<?php echo $this->session->userdata('hoten');?>" />  
                    </div>
					<div class="form-group col-md-2">
                        <label class="control-label">Trạng thái: </label>                                              
                        <select name="cboTrangThai" id="cboTrangThai" class="form-control" style="width: 100%;">
                            <option value="">Tất cả</option>
                            <option <?php if($this->session->userdata('trangthai') == "1") echo "selected"; ?> value="1">Mới tiếp nhận</option>
                            <option <?php if($this->session->userdata('trangthai') == "2") echo "selected"; ?> value="2">Đang xử lý</option>
							<option <?php if($this->session->userdata('trangthai') == "3") echo "selected"; ?> value="3">Đang giao hàng</option>
							<option <?php if($this->session->userdata('trangthai') == "4") echo "selected"; ?> value="4">Đã hoàn thành</option>
                        </select>
                    </div><!-- /.form-group -->
                    
					<div class="form-group col-md-4">
						<label class="control-label">&nbsp;</label>
                        <div class="input-group">
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="$('#frm').submit()" role="button">
								<span class="glyphicon glyphicon-search"></span> Tìm kiếm
							</a>
							
						</div>
					</div>
                    	
                        
                    
                    <div class="col-md-12">

                        <div class="table-responsive no-padding">
							<table class="table table-hover table-bordered">
								<thead class="bg-light-blue">
									<tr>								
										<th class="text-center"  style="width:50px">ID</th>
										<th class="text-center" style="width:90px">Ngày lập</th>
										<th class="text-center">Người nhận</th>				
										<th class="text-center" style="width:90px">Số tiền</th>
										<th class="text-center" style="width:90px">Thanh toán</th>
										<th class="text-center" style="width:120px">Hình thức TT</th>
										<th class="text-center" style="width:100px">Trạng thái</th>
										<th class="text-center" style="width:140px">Ghi chú</th>
										<th class="text-center" class="text-center" style="width:100px">Chức năng</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($list as $row)
									{	
										
									?>
									<tr>			   					               
										
										<td><a href="<?php echo base_url();?>admin/donhang/edit/<?php echo $row["dh_id"];?>"><b><?php echo $row["dh_id"];?></b></a></td>
										<td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($row["dh_ngay_lap"]));?></td>
										<td><?php echo $row["dh_ten"];?></td>
										
										
										<td class="text-right"><b><?php echo number_format($row["dh_tong_cong"]);?></b></td>
										<td class="text-right"><b><?php echo number_format($row["dh_thanh_toan"]);?></b></td>
										<td>
										<?php
										$phuongthuc = "";
										if($row["dh_phuong_thuc_thanh_toan"] == "thanhtoansau")
											$phuongthuc = "Thanh toán khi nhận hàng";
										if($row["dh_phuong_thuc_thanh_toan"] == "thanhtoantruoc")
											$phuongthuc = "Thanh toán trước bằng chuyển khoản";
										
										echo $phuongthuc;
										?>
										</td>
										<td>
										<?php
										$trangthai = "";
										if($row["dh_trang_thai"] == 1)
											$trangthai = "Mới tiếp nhận";
										if($row["dh_trang_thai"] == 2)
											$trangthai = "Đang xử lý";
										if($row["dh_trang_thai"] == 3)
											$trangthai = "Đang giao hàng";
										if($row["dh_trang_thai"] == 4)
											$trangthai = "Đã hoàn tất";
										echo $trangthai;
										?>
										</td>
										<td><?php echo $row["dh_ghi_chu"];?></td>
										<td class="text-center">                
											<div class="btn-group">
												<a class='btn btn-primary btn-xs' href="/admin/donhang/edit/<?php echo $row["dh_id"];?>" title='Xem'  role="button"><i class="fa fa-edit"></i></a>
												<!--<a class='btn btn-success btn-xs' onclick="NewWindow('/admin/donhang/printorder/<?php echo $row["dh_id"];?>','','840','500','yes');" title='In' title="In"  role="button"><i class="fa fa-print"></i></a>-->
												<a class='btn btn-success btn-xs' href="/admin/donhang/printorder/<?php echo $row["dh_id"];?>" target="_blank" title='In' title="In"  role="button"><i class="fa fa-print"></i></a>
												<a class='btn btn-danger btn-xs' onclick="return confirm('Bạn có chắc muốn xóa không?')" href="<?php echo base_url();?>admin/donhang/delete/<?php echo $row["dh_id"];?>"  title="Xóa" role="button"><i class="fa fa-trash-o"></i></a>
											</div>               
										</td>
										
										
									</tr>
										
										<?php  
											$i = $i + 1;
										}
										?>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-12 text-bold">
								Tổng số đơn hàng: <?php echo number_format($total);?>
							</div>
						</div>
						<?php echo $strphantrang ?>
						
                    </div>
                </div>
                
            </div>
        </div>
    </div>
  	<!-- /.row -->
</section>
<script type="text/javascript">
function xacNhanXoa(){	
	return confirm("Bạn có chắc muốn xoá các dòng được chọn?");
	
}
function delete_confirm(){
    if($('.checkbox:checked').length > 0)
	{
        var result = confirm("Bạn có chắc muốn xoá các dòng được chọn?");
        if(result)
		{
			$("#frm").submit();
        }
		else
		{
            return false;
        }
    }
	else
	{
        alert('Xin chọn ít nhất một dòng để xóa!');
        return false;
    }
}

</script>
</form>