<form name="frm" action="<?php echo base_url() ?>admin/lienket" method="post"  enctype="multipart/form-data" >
<?php
$nn = "vi";
if($this->session->userdata("nn"))
{
	$nn = $this->session->userdata("nn");
}
?>
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
							<option <?php if($this->session->userdata('lk_vi_tri') == '') echo "selected";?> value="All"></option>
							<option <?php if($this->session->userdata('lk_vi_tri') == 'Main') echo "selected";?> value="Main">Main</option>
							<option <?php if($this->session->userdata('lk_vi_tri') == 'Top') echo "selected";?> value="Top">Top</option>
							<option <?php if($this->session->userdata('lk_vi_tri') == 'Bottom') echo "selected";?> value="Bottom">Bottom</option>
							<option <?php if($this->session->userdata('lk_vi_tri') == 'Left') echo "selected";?> value="Left">Left</option>
							<option <?php if($this->session->userdata('lk_vi_tri') == 'Right') echo "selected";?> value="Right">Right</option>							
							<option <?php if($this->session->userdata('lk_vi_tri') == 'Option') echo "selected";?> value="Option">Option</option>
						</select>
					</div>
					
					<div class="form-group col-md-6">
						<label>&nbsp;</label>
                        <div class="input-group">
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="$('#frm').submit()" role="button">
								<span class="glyphicon glyphicon-search"></span> Tìm kiếm
							</a>							
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="javascript:js_xoa_nhieu_lien_ket();" role="button">
								<span class="glyphicon glyphicon-trash"></span> Xóa chọn
							</a>
							<a href="/admin/lienket/add" class="btn btn-primary" role="button">
								<span class="glyphicon glyphicon-plus"></span> Thêm mới
							</a>
							
						</div>
					</div>
                    	
                        
                    
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style='width:20px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
										<th class="text-center" style="width:150px">Hình</th>
                                        <th>Tên liên kết</th>
										
                                        <th class="text-center" style="width:80px">Vị trí</th>
										
                                        <th class="text-center" style="width:80px">Xuất bản</th>
                                        <th class="text-center" style="width:80px">Nổi bật</th>
										<th class="text-center" style="width:50px">Xuống</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									//$lienket = $this->lienket_model->lay_danh_sach_lien_ket("",$this->session->userdata('lk_vi_tri'));
									foreach ($list as $row)
									{	
										$img = "default.png";
										if($row["lk_hinh"] != "")
											$img = $row["lk_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["lk_id"];?>"/>
                                        </td>
                                        <td class="text-center">
                                            &nbsp;<img src="../uploads/lienket/<?php echo $img;?> " height="128" width=128"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["lk_ten"];?></td>
										<td>&nbsp;<?php echo $row["lk_vi_tri"];?></td>
                                        
                                        <td class="text-center">
                                            <?php 
                                            if ($row["lk_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_status/'.$row["lk_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_status/'.$row["lk_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["lk_noi_bat"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/lienket/hide_hot/'.$row["lk_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/lienket/show_hot/'.$row["lk_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">                
                                            <a class="btn btn-info btn-xs" href="<?php echo 'admin/lienket/down/'.$row["lk_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/lienket/edit/'.$row["lk_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/lienket/delete/'.$row["lk_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                        </td>	
                                        
                                    </tr>
                                        
                                        <?php                                                
                                        }
                                        ?>
                                </tbody>
                            </table>
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
function js_xoa_nhieu_lien_ket(){
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
				var url = "/admin/ajax/ajax_xoa_nhieu_lien_ket";       
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