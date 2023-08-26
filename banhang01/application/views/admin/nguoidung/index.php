<form name="frm" action="<?php echo base_url() ?>admin/nguoidung/delete_all" method="post"  enctype="multipart/form-data" onsubmit="return delete_confirm();" >
<section class="content-header">
  	<h1>
        NGƯỜI DÙNG
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Người dùng</li>
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
                        <label>Hiển thị: </label>                                              
                        <select name="cboGioiHan" id="cboGioiHan" class="form-control" style="width: 100%;" onchange="submit()">
                            <option <?php if($this->session->userdata('limit') == "10") echo "selected"; ?> value="10">10</option>
                            <option <?php if($this->session->userdata('limit') == "20") echo "selected"; ?> value="20">20</option>
							<option <?php if($this->session->userdata('limit') == "50") echo "selected"; ?> value="50">50</option>
							<option <?php if($this->session->userdata('limit') == "100") echo "selected"; ?> value="100">100</option>
                        </select>
                    </div><!-- /.form-group -->
					<div class="form-group col-md-4">
						<label>&nbsp;</label>
                        <div class="input-group">
							
							<a href="<?php echo base_url();?>admin/nguoidung/add">
							   <input type="button" name="btnThemMoi" value="Thêm mới" class="btn btn-primary btn-sm"/>
							</a>
						</div>
					</div>
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                       
										<th class="text-center">Hình</th>
                                        <th>Họ tên</th>
										<th class="text-center" style="width:250px">Email</th>
                                        <th class="text-center" style="width:250px">Tên đăng nhập</th>
                                        <th class="text-center" style="width:90px">Kích hoạt</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									foreach ($list as $row)
									{	
										$img = "default.png";
										if($row["nd_hinh"] != "")
											$img = $row["nd_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center" style="width:20px"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["nd_id"];?>"/>
                                        </td>
										
                                        <td class="text-center" style="width:50px">
                                            &nbsp;<img src="../uploads/nguoidung/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["nd_ten"];?></td>
										<td>&nbsp;<?php echo $row["nd_email"];?></td>
										<td>&nbsp;<?php echo $row["nd_ten_dang_nhap"];?></td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["nd_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/nguoidung/hide_status/'.$row["nd_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/nguoidung/show_status/'.$row["nd_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/nguoidung/edit/'.$row["nd_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/nguoidung/delete/'.$row["nd_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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