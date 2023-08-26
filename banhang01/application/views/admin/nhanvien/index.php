<form id="frm" name="frm" action="<?php echo base_url() ?>admin/nhanvien/delete_all" method="post"  enctype="multipart/form-data" onsubmit="return delete_confirm();" >
<section class="content-header">
  	<h1>
        NHÂN VIÊN
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Nhân viên</li>
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
					
					<div class="form-group col-md-12 text-right">
						<a class="btn btn-primary" style="margin-right: 10px;" onclick="$('#frm').submit()" role="button">
							<span class="glyphicon glyphicon-trash"></span> Xóa chọn
						</a>
                        <a href="/admin/nhanvien/add" class="btn btn-primary" role="button">
							<span class="glyphicon glyphicon-plus"></span> Thêm mới
						</a>
					</div>
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center"  style="width:20px"><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                       
										<th class="text-center" style="width:50px">Hình</th>
                                        <th>Họ tên</th>
										<th class="text-center" style="width:120px">Điện thoại</th>
										<th class="text-center" style="width:120px">Email</th>
                                        <th class="text-center" style="width:120px">Zalo</th>
										<th class="text-center" style="width:120px">Sky</th>
                                        <th class="text-center" style="width:90px">Kích hoạt</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									foreach ($nhanvien_list as $row)
									{	
										$img = "default.png";
										if($row["nv_hinh"] != "")
											$img = $row["nv_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["nv_id"];?>"/>
                                        </td>
										
                                        <td class="text-center">
                                            &nbsp;<img src="../uploads/nhanvien/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["nv_ten"];?></td>
										<td>&nbsp;<?php echo $row["nv_dien_thoai"];?></td>
										<td>&nbsp;<?php echo $row["nv_email"];?></td>
										<td>&nbsp;<?php echo $row["nv_zalo"];?></td>
										<td>&nbsp;<?php echo $row["nv_sky"];?></td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["nv_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/nhanvien/hide_status/'.$row["nv_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/nhanvien/show_status/'.$row["nv_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/nhanvien/edit/'.$row["nv_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/nhanvien/delete/'.$row["nv_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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