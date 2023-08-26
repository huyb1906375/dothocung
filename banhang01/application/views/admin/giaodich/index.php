<form id="frm" name="frm" action="<?php echo base_url() ?>admin/giaodich" method="post"  enctype="multipart/form-data">
<section class="content-header">
  	<h1>
        GIAO DỊCH
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Giao dịch</li>
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
					<div class="form-group col-md-4">
						<label>Người dùng:</label>
						<select name="cboNguoiDung" class="form-control select2" style="width:100%">
							<option value="">Tất cả</option>
							<?php
							$nguoidung = $this->nguoidung_model->lay_danh_sach_nguoi_dung();
							foreach ($nguoidung as $nd) 
							{
								echo "<option ".(($this->session->userdata('nd_id') == $nd["nd_id"])?"selected":"")." value='".$nd["nd_id"]."'>".$nd["nd_ten_dang_nhap"]." - ".$nd["nd_ten"]."</option>";
								
							}
                            ?>
						</select>
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
					<div class="form-group col-md-6">						
                       	<label>&nbsp;</label>
                        <div class="input-group">
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="$('#frm').submit()" role="button">
								<span class="glyphicon glyphicon-search"></span> Tìm kiếm
							</a>
							<a href="/admin/giaodich/add" class="btn btn-primary" role="button">
								<span class="glyphicon glyphicon-plus"></span> Thêm mới
							</a>
						</div>
					</div>
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style="width:100px">ID</th>
                                        <th style="width:200px">Thời gian</th>
										<th style="width:200px">Người dùng</th>
										<th>Nội dung</th>
                                        <th class="text-center" style="width:100px">Giao dịch</th>
										<th class="text-center" style="width:100px">Số dư</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									foreach ($list as $row)
									{	
									?>
                                    <tr>			   					               
                                        <td><?php echo $row["gd_id"];?></td>
										<td><?php echo $row["gd_thoi_gian"];?></td>
                                        <td><?php echo $row["nd_ten_dang_nhap"]." - ".$row["nd_ten"];?></td>
										<td><?php echo $row["gd_noi_dung"];?></td>
										<td><?php echo number_format($row["gd_so_tien"]);?></td>
										<td><?php echo number_format($row["gd_so_du"]);?></td>
                                        
                                        
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/giaodich/edit/'.$row["gd_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/giaodich/delete/'.$row["gd_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                        </td>	
                                        
                                    </tr>
                                        
                                        <?php
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
        if(result){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Xin chọn ít nhất một dòng để xóa!');
        return false;
    }
}

</script>
</form>