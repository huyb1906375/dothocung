<form id="frm" name="frm" action="<?php echo base_url() ?>admin/batdongsan" method="post"  enctype="multipart/form-data" >

<section class="content-header">
  	<h1>
        BẤT ĐỘNG SẢN
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Bất động sản</li>
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
                	<div class="form-group col-md-3">
                        <label>Tiêu đề:</label>
                       	<input type="text" id="txtTuKhoa" name="txtTuKhoa" class="form-control" value="<?php echo $this->session->userdata('tu_khoa');?>" />  
                    </div>
					<div class="form-group col-md-3">
						<label>Loại bất động sản:</label>
						<select name="cboChuyenMuc" class="form-control" style="width:100%">
							<option value=""></option>
							<?php
							$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","loai-bat-dong-san","", "");
							$option = "";
							foreach ($parent as $p) 
							{
								echo "<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
								$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"loai-bat-dong-san","","");
								foreach ($child as $c) 
								{
									echo "<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
								}
							}
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3">
                        <label>Trạng thái: </label>                                              
                        <select name="cboLoai" id="cboLoai" class="form-control" style="width: 100%;">
                            <option value="tatca">Tất cả</option>
                            <option <?php if($this->session->userdata('loai') == "chuaxuatban") echo "selected"; ?> value="chuaxuatban">Chưa xuất bản</option>
                            <option <?php if($this->session->userdata('loai') == "noibat") echo "selected"; ?> value="noibat">Nổi bật</option>
							<option <?php if($this->session->userdata('loai') == "tieubieu") echo "selected"; ?> value="tieubieu">Tiêu biểu</option>
							<option <?php if($this->session->userdata('loai') == "chuagiaodich") echo "selected"; ?> value="chuagiaodich">chưa giao dịch</option>
							<option <?php if($this->session->userdata('loai') == "dagiaodich") echo "selected"; ?> value="dagiaodich">Đã giao dịch</option>
                        </select>
                    </div><!-- /.form-group -->
                    
					<div class="form-group col-md-3">
                        <label>Hiển thị: </label>                                              
                        <select name="cboGioiHan" id="cboGioiHan" class="form-control" style="width: 100%;" onchange="submit()">
                            <option <?php if($this->session->userdata('limit') == "10") echo "selected"; ?> value="10">10</option>
                            <option <?php if($this->session->userdata('limit') == "20") echo "selected"; ?> value="20">20</option>
							<option <?php if($this->session->userdata('limit') == "50") echo "selected"; ?> value="50">50</option>
							<option <?php if($this->session->userdata('limit') == "100") echo "selected"; ?> value="100">100</option>
                        </select>
                    </div><!-- /.form-group -->
					
                    <div class="form-group col-md-3">
						<label>Tỉnh thành:</label>
						<select name="cboTinhThanh" id="cboTinhThanh" class="form-control select2" style="width:100%" onchange="lay_ds_quan_huyen()">
							<option value="">Tất cả</option>
							<?php
							$tinhthanh = $this->tinhthanh_model->lay_danh_sach_tinh_thanh();
							foreach ($tinhthanh as $tt) 
							{
								echo "<option ".(($this->session->userdata('tt_id') == $tt["tt_id"])?"selected":"")." value='".$tt["tt_id"]."'>".$tt["tt_ten"]."</option>";
								
							}
                            ?>
						</select>
					</div>
					<div id="ajax_quanhuyen" class="form-group col-md-3">
						<label>Quận huyện:</label>
						<select name="cboQuanHuyen" id="cboQuanHuyen" class="form-control select2" style="width:100%" onchange="lay_ds_phuong_xa()">
							<option value="">Tất cả</option>
							<?php
							$quanhuyen = $this->quanhuyen_model->lay_danh_sach_quan_huyen($this->session->userdata('tt_id'));
							foreach ($quanhuyen as $qh) 
							{
								echo "<option ".(($this->session->userdata('qh_id') == $qh["qh_id"])?"selected":"")." value='".$qh["qh_id"]."'>".$qh["qh_ten"]."</option>";
								
							}
                            ?>
						</select>
					</div>	
                    <div id="ajax_phuongxa" class="form-group col-md-3">
						<label>Phường xã:</label>
						<select name="cboPhuongXa" id="cboPhuongXa" class="form-control select2" style="width:100%">
							<option value="">&nbsp;</option>
							<?php
							$phuongxa = $this->phuongxa_model->lay_danh_sach_phuong_xa($this->session->userdata('tt_id'),$this->session->userdata('qh_id'));
							foreach ($phuongxa as $px) 
							{
								echo "<option ".(($this->session->userdata('px_id') == $px["px_id"])?"selected":"")." value='".$px["px_id"]."'>".$px["px_ten"]."</option>";
								
							}
                            ?>
						</select>
					</div>    
                    <div class="form-group col-md-3">
						<label>&nbsp;</label>
                        <div class="input-group">
							<input type="submit" id="btnTimKiem" name="btnTimKiem" value="Tìm kiếm" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
							<input type="submit" id="btnXoa" name="btnXoa" value="Xóa chọn" class="btn btn-primary btn-sm" style="margin-right: 10px;" onclick="return delete_confirm();"/>
							<a href="<?php echo base_url();?>admin/batdongsan/add">
							   <input type="button" name="btnThemMoi" value="Thêm mới" class="btn btn-primary btn-sm"/>
							</a>
						</div>
					</div>
                    <div class="col-md-12">

                        <div class="table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                        
										<th class="text-center" style="width:50px">Hình</th>
                                        <th>Tiêu đề</th>
										<th class="text-center" style="width:120px">Danh mục</th>
										<th class="text-center" style="width:80px">Ngày đăng</th>
										<th class="text-center" style="width:80px">Lượt xem</th>
                                        <th class="text-center" style="width:80px">Hiển thị</th>
                                        <th class="text-center" style="width:80px">Nổi bật</th>
										
										<th class="text-center" style="width:80px">Giao dịch</th>
                                        <!--
										<th class="text-center" style="width:100px">Khuyến mãi</th>
										<th class="text-center" style="width:100px">Bán chạy</th>
										-->
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									/*
									$search = "";
									if(isset($keyword))
										$search = $keyword;
									$batdongsan = $this->batdongsan_model->lay_danh_sach_bai_viet($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search);
									*/
									$i = 1;
									foreach ($list as $row)
									{	
										$img = "default.png";
										if($row["bds_hinh"] != "")
											$img = $row["bds_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["bds_id"];?>"/>
                                        </td>
										
                                        <td class="text-center" >
                                            &nbsp;<img src="../uploads/batdongsan/<?php echo $img;?> " height="30" width="30"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["bds_ten"];?></td>
										<td>&nbsp;<?php echo $row["cm_ten"];?></td>
                                        <td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($row["bds_ngay_dang"]));?></td>
										<td class="text-center"><?php echo number_format($row["bds_luot_xem"]);?></td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["bds_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/batdongsan/hide_status/'.$row["bds_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/batdongsan/show_status/'.$row["bds_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["bds_noi_bat"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/batdongsan/hide_hot/'.$row["bds_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/batdongsan/show_hot/'.$row["bds_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										
										<td class="text-center">
                                            <?php 
                                            if ($row["bds_giao_dich"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/batdongsan/hide_trans/'.$row["bds_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/batdongsan/show_trans/'.$row["bds_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										
                                        <td class="text-center">                
                                        	<a class="btn btn-success btn-xs" href="<?php echo 'admin/batdongsan/edit/'.$row["bds_id"]; ?>" role="button" title="Sửa"> <i class="glyphicon glyphicon-edit"></i> Sửa</a>                             
                                        </td>
                                        <td class="text-center">                 
                                        	<a class="btn btn-danger btn-xs" href="<?php echo 'admin/batdongsan/delete/'.$row["bds_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button" title="Xóa"> <i class="glyphicon glyphicon-trash"></i> Xóa</a>                          
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
								Tổng số: <?php echo number_format($total);?>
							</div>
						</div>
						<?php echo $strphantrang ?>
						<!--
                        <div class="row">
							<div class="col-md-12 text-center">
								<ul class="pagination">
									<?php echo $strphantrang ?>
								</ul>
							</div>
						</div>
						-->
                    </div>
                </div>
                
            </div>
        </div>
    </div>
  	<!-- /.row -->
</section>
<script type="text/javascript">
function lay_ds_quan_huyen(){
	var tt_id = $("#cboTinhThanh").val();
    var url = "/admin/ajax/lay_ds_quan_huyen/"+tt_id;
	//alert(url);
	loadDuLieu('ajax_quanhuyen',url);
}
function lay_ds_phuong_xa(){
	var tt_id = $("#cboTinhThanh").val();
	var qh_id = $("#cboQuanHuyen").val();
    var url = "/admin/ajax/lay_ds_phuong_xa/"+tt_id+"/"+qh_id;
	//alert(url);
	loadDuLieu('ajax_phuongxa',url);
}
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