<form id="frm" name="frm" action="<?php echo base_url() ?>admin/video" method="post"  enctype="multipart/form-data" >
<?php
$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","chuyen-muc-video","", "");
$option = "";
foreach ($parent as $p) 
{
	$option.="<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
	$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"chuyen-muc-video","","");
	foreach ($child as $c) 
	{
		$option.="<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
		$child2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($c["cm_id"],"chuyen-muc-video","","");
		foreach ($child2 as $c2) 
		{
			$option.="<option ".(($this->session->userdata('cm_id') == $c2["cm_id"])?"selected":"")." value='".$c2["cm_id"]."'>|----------".$c2["cm_ten"]."</option>";
		}
	}
}

?>
<section class="content-header">
  	<h1>
        VIDEO
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Video</li>
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
						<label>Chuyên mục:</label>
						<select name="cboChuyenMuc" class="form-control" style="width:100%">
							<option value=""></option>
							<?php echo $option;?>
						</select>
					</div>
					<div class="form-group col-md-2">
                        <label>Loại: </label>                                              
                        <select name="cboLoai" id="cboLoai" class="form-control" style="width: 100%;">
                            <option value="tatca">Tất cả</option>
                            <option <?php if($this->session->userdata('loai') == "chuaxuatban") echo "selected"; ?> value="chuaxuatban">Chưa xuất bản</option>
                            <option <?php if($this->session->userdata('loai') == "noibat") echo "selected"; ?> value="noibat">Nổi bật</option>
							<option <?php if($this->session->userdata('loai') == "tieudiem") echo "selected"; ?> value="tieudiem">Tiêu điểm</option>
                           
                        </select>
                    </div><!-- /.form-group -->
                    <div class="form-group col-md-2">
                        <label>Tiêu đề:</label>
                       	<input type="text" id="txtTuKhoa" name="txtTuKhoa" class="form-control" value="<?php echo $this->session->userdata('tu_khoa');?>" />  
                    </div>
					<div class="form-group col-md-2">
                        <label>Hiển thị: </label>                                              
                        <select name="cboGioiHan" id="cboGioiHan" class="form-control" style="width: 100%;" onchange="submit()">
                            <option <?php if($this->session->userdata('limit') == "10") echo "selected"; ?> value="10">10</option>
                            <option <?php if($this->session->userdata('limit') == "20") echo "selected"; ?> value="20">20</option>
							<option <?php if($this->session->userdata('limit') == "50") echo "selected"; ?> value="50">50</option>
							<option <?php if($this->session->userdata('limit') == "100") echo "selected"; ?> value="100">100</option>
                        </select>
                    </div><!-- /.form-group -->
					<div class="form-group col-md-3">
						<label>&nbsp;</label>
                        <div class="input-group">
							<input type="submit" id="btnTimKiem" name="btnTimKiem" value="Tìm kiếm" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
							<input type="submit" id="btnXoa" name="btnXoa" value="Xóa chọn" class="btn btn-primary btn-sm" style="margin-right: 10px;" onclick="return delete_confirm();"/>
							<a href="<?php echo base_url();?>admin/video/add">
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
										<th class="text-center" style="width:150px">Chuyên mục</th>
										<th class="text-center" style="width:90px">Ngày đăng</th>
										<th class="text-center" style="width:90px">Lượt xem</th>
                                        <th class="text-center" style="width:90px">Xuất bản</th>
                                        <th class="text-center" style="width:90px">Nổi bật</th>
										<th class="text-center" style="width:90px">Tiêu điểm</th>
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
									$video = $this->video_model->lay_danh_sach_bai_viet($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search);
									*/
									$i = 1;
									foreach ($list as $row)
									{	
										$img = "default.png";
										if($row["v_hinh"] != "")
											$img = $row["v_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["v_id"];?>"/>
                                        </td>
										
                                        <td class="text-center" >
                                            &nbsp;<img src="../uploads/video/<?php echo $img;?> " height="30" width="30"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["v_ten"];?></td>
										<td>&nbsp;<?php echo $row["cm_ten"];?></td>
                                        <td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($row["v_ngay_dang"]));?></td>
										<td class="text-center"><?php echo number_format($row["v_luot_xem"]);?></td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["v_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/video/hide_status/'.$row["v_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/video/show_status/'.$row["v_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["v_noi_bat"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/video/hide_hot/'.$row["v_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/video/show_hot/'.$row["v_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">
                                            <?php 
                                            if ($row["v_tieu_diem"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/video/hide_focus/'.$row["v_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/video/show_focus/'.$row["v_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/video/edit/'.$row["v_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/video/delete/'.$row["v_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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