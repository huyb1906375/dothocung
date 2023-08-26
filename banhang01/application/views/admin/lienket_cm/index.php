<form name="frm" action="<?php echo base_url() ?>admin/lienket/delete_all" method="post"  enctype="multipart/form-data" onsubmit="return delete_confirm();" >
<section class="content-header">
  	<h1>
        LIÊN KẾT
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Liên kết</li>
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
                        <label>Loại: </label>                                              
                        <select name="cboLoai" id="cboLoai" class="form-control" style="width: 100%;" onchange="submit()">
                            <option value="tatca">Tất cả</option>
                            <option <?php if($this->session->userdata('loai') == "chuaxuatban") echo "selected"; ?> value="chuaxuatban">Chưa xuất bản</option>
                            <option <?php if($this->session->userdata('loai') == "noibat") echo "selected"; ?> value="noibat">Nổi bật</option>
							<option <?php if($this->session->userdata('loai') == "binhthuong") echo "selected"; ?> value="tieudiem">Bình thường</option>
                           
                        </select>
                    </div><!-- /.form-group -->
					<div class="form-group col-md-3">
						<label>Vị trí: </label> 
						<select name="cboViTri" class="form-control" style="width:100%" onchange="submit()">
							<option <?php if($this->session->userdata('vi_tri') == '0') echo "selected";?> value="0">Tất cả</option>
							<option <?php if($this->session->userdata('vi_tri') == 'top') echo "selected";?> value="top">Trên</option>
							<option <?php if($this->session->userdata('vi_tri') == 'bottom') echo "selected";?> value="bottom">Dưới</option>
							<option <?php if($this->session->userdata('vi_tri') == 'left') echo "selected";?> value="left">Trái</option>
							<option <?php if($this->session->userdata('vi_tri') == 'right') echo "selected";?> value="right">Phải</option>
							<option <?php if($this->session->userdata('vi_tri') == 'middle') echo "selected";?> value="middle">Giữa</option>
							<option <?php if($this->session->userdata('vi_tri') == 'free') echo "selected";?> value="free">Tự do</option>
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
					<div class="form-group col-md-4">
						<label>&nbsp;</label>
                        <div class="input-group">
							<input type="submit" name="btnXoa" value="Xóa chọn" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
							<a href="<?php echo base_url();?>admin/lienket/add">
							   <input type="button" name="btnThemMoi" value="Thêm mới" class="btn btn-primary btn-sm"/>
							</a>
						</div>
					</div>
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                        
										<th class="text-center">Hình</th>
                                        <th>Tên liên kết</th>
										<th class="text-center" style="width:50px">Menu</th>
                                        <th class="text-center" style="width:50px">Trên</th>
										<th class="text-center" style="width:50px">Dưới</th>
										<th class="text-center" style="width:50px">Trái</th>
										<th class="text-center" style="width:50px">Phải</th>
										<th class="text-center" style="width:50px">Giữa</th>
										<th class="text-center" style="width:90px">Tự do</th>
                                        <th class="text-center" style="width:90px">Xuất bản</th>
                                        <th class="text-center" style="width:90px">Nổi bật</th>
										<th class="text-center" style="width:90px">Đi xuống</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									foreach ($list as $row)
									{	
										$img = "default.png";
										if($row["cm_hinh"] != "")
											$img = $row["cm_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center" style="width:20px"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["cm_id"];?>"/>
                                        </td>
										
                                        <td class="text-center" style="width:50px">
                                            &nbsp;<img src="../uploads/lienket/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["cm_ten"];?></td>
										<td class="text-center">
                                            <?php echo $row["cm_loai_menu"];?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_tren"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_position/'.$row["cm_id"]; ?>/top" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_position/'.$row["cm_id"]; ?>/top" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">
                                            <?php 
                                            if ($row["cm_duoi"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_position/'.$row["cm_id"]; ?>/bottom" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_position/'.$row["cm_id"]; ?>/bottom" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">
                                            <?php 
                                            if ($row["cm_trai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_position/'.$row["cm_id"]; ?>/left" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_position/'.$row["cm_id"]; ?>/left" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">
                                            <?php 
                                            if ($row["cm_phai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_position/'.$row["cm_id"]; ?>/right" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_position/'.$row["cm_id"]; ?>/right" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">
                                            <?php 
                                            if ($row["cm_giua"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_position/'.$row["cm_id"]; ?>/middle" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_position/'.$row["cm_id"]; ?>/middle" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">
                                            <?php 
                                            if ($row["cm_tu_do"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_position/'.$row["cm_id"]; ?>/free" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_position/'.$row["cm_id"]; ?>/free" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_status/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_status/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_noi_bat"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_hot/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_hot/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">                
                                            <a class="btn btn-info btn-xs" href="<?php echo 'admin/lienket/down/'.$row["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Đi xuống</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/lienket/edit/'.$row["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/lienket/delete/'.$row["cm_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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