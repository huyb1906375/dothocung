<form id="frm" name="frm" action="<?php echo base_url() ?>admin/baiviet" method="post"  enctype="multipart/form-data" >
<?php
$nn = "vi";
if($this->session->userdata("nn"))
{
	$nn = $this->session->userdata("nn");
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
                	
					<div class="form-group col-md-2">
						<label>Chuyên mục:</label>
						<select name="cboChuyenMuc" class="form-control select2" style="width:100%">
							<option value="">&nbsp;</option>
							<?php 
							$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","chuyen-muc","","");
							foreach ($parent as $p) 
							{
								echo "<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
								$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"chuyen-muc","","");
								foreach ($child as $c) 
								{
									echo "<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-2">
                        <label>Loại bài viết: </label>                                              
                        <select name="cboLoai" id="cboLoai" class="form-control select2" style="width: 100%;">
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
                        <select name="cboGioiHan" id="cboGioiHan" class="form-control select2" style="width: 100%;" onchange="submit()">
                            <option <?php if($this->session->userdata('limit') == "10") echo "selected"; ?> value="10">10</option>
                            <option <?php if($this->session->userdata('limit') == "20") echo "selected"; ?> value="20">20</option>
							<option <?php if($this->session->userdata('limit') == "50") echo "selected"; ?> value="50">50</option>
							<option <?php if($this->session->userdata('limit') == "100") echo "selected"; ?> value="100">100</option>
                        </select>
                    </div><!-- /.form-group -->
					<div class="form-group col-md-4">
						<label>&nbsp;</label>
                        <div class="input-group">
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="$('#frm').submit()" role="button">
								<span class="glyphicon glyphicon-search"></span> Tìm kiếm
							</a>
							
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="javascript:js_xoa_nhieu_bai_viet();" role="button">
								<span class="glyphicon glyphicon-trash"></span> Xóa chọn
							</a>
							<a href="/admin/baiviet/add" class="btn btn-primary" role="button">
								<span class="glyphicon glyphicon-plus"></span> Thêm mới
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
                                        <td class="text-center"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["bv_id"];?>"/>
                                        </td>
										
                                        <td class="text-center" >
                                            &nbsp;<img src="../uploads/baiviet/<?php echo $img;?> " height="30" width="30"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["bv_ten"];?></td>
										<td>&nbsp;<?php echo $row["cm_ten"];?></td>
                                        <td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($row["bv_ngay_dang"]));?></td>
										<td class="text-center"><?php echo number_format($row["bv_luot_xem"]);?></td>
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
                                                <a href="<?php echo 'admin/baiviet/hide_focus/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/baiviet/show_focus/'.$row["bv_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
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
							<div class="col-md-12 text-bold">
								Tổng số bài viết: <?php echo number_format($total);?>
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
function js_xoa_nhieu_bai_viet(){
    if($('.checkbox:checked').length > 0){
        var result = confirm("Bạn có chắc muốn xoá các dòng được chọn?");
        if(result)
		{			
            var checks = document.getElementsByName('id[]');
			var s = "";
			for (i = 0; i < checks.length; i++)
			{
				if(checks[i].checked == true)
				{
					s = s + "'" + checks[i].value + "',";					
				}
			}
			if(s.length > 0)
			{
				s = s.substring(0, s.length-1);
				var url = "/admin/ajax/ajax_xoa_nhieu_bai_viet";       
				$.post(url, {
					'sid': s
				}).success(function(data) {
					var fields = data.split("|");
					if(fields[0] == "1")
					{
						alert("Đã xóa thành công!");
						location.reload();
						
					}
				}).error(function(data) {
					alert("Xảy ra lỗi!");
				}); 
			}
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