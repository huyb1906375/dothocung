<form id="frm" name="frm" action="<?php echo base_url() ?>admin/baiviet" method="post"  enctype="multipart/form-data" >
<?php
$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","chuyen-muc","");
$option = "";
foreach ($parent as $p) 
{
	$option.="<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
	$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"chuyen-muc","");
	foreach ($child as $c) 
	{
		$option.="<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
	}
}

?>
<section class="content-header">
  	<h1>
        BÀI VIẾT
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Bài viết</li>
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
						
					</div>
					<div class="form-group col-md-3">
                        <label>Loại bài viết: </label>                                              
                        
                    </div><!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label>Tiêu đề:</label>
                       	
                    </div>
					<div class="form-group col-md-3">
						<label>&nbsp;</label>
                        <div class="input-group">
							<input type="submit" id="btnTimKiem" name="btnTimKiem" value="Tìm kiếm" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
							<input type="button" id="btnXoa" name="btnXoa" value="Xóa chọn" class="btn btn-primary btn-sm" style="margin-right: 10px;" onclick="delete_confirm()"/>
							<a href="<?php echo base_url();?>admin/baiviet/add">
							   <input type="button" name="btnThemMoi" value="Thêm mới" class="btn btn-primary btn-sm"/>
							</a>
						</div>
					</div>
                    <section class="content-search">
						<div class="form-inline">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Chuyên mục</span>
								<select name="cboChuyenMuc" class="form-control" style="width:100%">
									<option value=""></option>
									<?php echo $option;?>
								</select>
							</div>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Loại bài viết</span>
								<select name="cboLoai" id="cboLoai" class="form-control" style="width: 100%;">
									<option value="tatca">Tất cả</option>
									<option <?php if($this->session->userdata('loai') == "chuaxuatban") echo "selected"; ?> value="chuaxuatban">Chưa xuất bản</option>
									<option <?php if($this->session->userdata('loai') == "noibat") echo "selected"; ?> value="noibat">Nổi bật</option>
									<option <?php if($this->session->userdata('loai') == "tieudiem") echo "selected"; ?> value="tieudiem">Tiêu điểm</option>
								   
								</select>
							</div>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Tiêu đề</span>
								<input type="text" id="txtTuKhoa" name="txtTuKhoa" class="form-control" value="<?php echo $this->session->userdata('tu_khoa');?>" />  
							</div>
						</div>
					</section>    
                    
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                        <th class="text-center" style="width:50px">STT</th>
										<th class="text-center">Hình</th>
                                        <th>Tên bài viết</th>
										<th class="text-center" style="width:180px">Chuyên mục</th>
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
									$baiviet = $this->baiviet_model->lay_danh_sach_bai_viet($this->session->userdata('cm_id'),$this->session->userdata('loai'),$search);
									*/
									$i = 1;
									foreach ($list as $row)
									{	
										$img = "default.png";
										if($row["bv_hinh"] != "")
											$img = $row["bv_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center" style="width:20px"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["bv_id"];?>"/>
                                        </td>
										<td class="text-center"><?php echo $i;?></td>
                                        <td class="text-center" style="width:50px">
                                            &nbsp;<img src="../uploads/baiviet/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["bv_ten"];?></td>
										<td>&nbsp;<?php echo $row["cm_ten"];?></td>
                                        
                                        <td class="text-center">
                                            <?php 
                                            if ($row["bv_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/baiviet/hide_status/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/baiviet/show_status/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["bv_noi_bat"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/baiviet/hide_hot/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/baiviet/show_hot/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">
                                            <?php 
                                            if ($row["bv_tieu_diem"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/baiviet/hide_tieudiem/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/baiviet/show_tieudiem/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/baiviet/edit/'.$row["bv_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/baiviet/delete/'.$row["bv_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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
							<div class="col-md-12 text-center">
								<ul class="pagination">
									<?php echo $strphantrang ?>
								</ul>
							</div>
						</div>
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
    if($('.checkbox:checked').length > 0){
        var result = confirm("Bạn có chắc muốn xoá các dòng được chọn?");
        if(result)
		{
			//document.forms[0].submit();
			$("#form").submit(function(){
                return false;
            });
           //return true;
        }
		else
		{
            return false;
        }
    }else{
        alert('Xin chọn ít nhất một dòng để xóa!');
        return false;
    }
}

</script>
</form>