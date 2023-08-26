<?php
$nn = "vi";
if($this->session->userdata("nn"))
{
	$nn = $this->session->userdata("nn");
}
?>
<form name="frm" action="<?php echo base_url() ?>admin/danhmuc" method="post" enctype="multipart/form-data">
<section class="content-header">
  	<h1>
        DANH MỤC
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Danh mục</li>
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
						<a class="btn btn-primary" style="margin-right: 10px;" onclick="javascript:js_xoa_nhieu_danh_muc();" role="button">
							<span class="glyphicon glyphicon-trash"></span> Xóa chọn
						</a>
						<a href="<?php echo base_url();?>admin/danhmuc/add" class="btn btn-primary" role="button">
							<span class="glyphicon glyphicon-plus"></span> Thêm mới
						</a>                     
                    </div>
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                        
										<th class="text-center">Hình</th>
                                        <th>Tên danh mục</th>
                                        <th class="text-center" style="width:50px">Menu</th>
										
                                        <th class="text-center" style="width:90px">Xuất bản</th>
                                        <th class="text-center" style="width:90px">Nổi bật</th>
                                        <th class="text-center" style="width:50px">Xuống</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									$danhmuc = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0",'danh-muc',"", "");
									foreach ($danhmuc as $row)
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
                                            &nbsp;<img src="../uploads/chuyenmuc/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["cm_ten"];?></td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_menu"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/danhmuc/hide_menu/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/danhmuc/show_menu/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/danhmuc/hide_status/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/danhmuc/show_status/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_noi_bat"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/danhmuc/hide_hot/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/danhmuc/show_hot/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">                
                                            <a class="btn btn-info btn-xs" href="<?php echo 'admin/danhmuc/down/'.$row["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/danhmuc/edit/'.$row["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/danhmuc/delete/'.$row["cm_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                        </td>	
                                        
                                    </tr>
                                        <?php
                                            $danhmuc1 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($row["cm_id"],'danh-muc',"", "");
                                            foreach ($danhmuc1 as $row1)
                                            {	
                                                $img = "default.png";
                                                if($row1["cm_hinh"] != "")
                                                    $img = $row1["cm_hinh"]; 
                                        ?>
                                            <tr>			   					               
                                                <td class="text-center" style="width:20px"> 
                                                    <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row1["cm_id"];?>"/>
                                                </td>
												
                                                <td class="text-center" style="width:50px">
                                                    &nbsp;<img src="../uploads/chuyenmuc/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>&nbsp;|-----<?php echo $row1["cm_ten"];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row1["cm_menu"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/danhmuc/hide_menu/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/danhmuc/show_menu/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
												
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row1["cm_trang_thai"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/danhmuc/hide_status/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/danhmuc/show_status/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
													<?php 
													if ($row1["cm_noi_bat"]==1)
													{
													?>					 
														<a href="<?php echo 'admin/danhmuc/hide_hot/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
													<?php
													}
													else
													{
													?>
														 <a href="<?php echo 'admin/danhmuc/show_hot/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
													<?php
													}
													?>
												</td>
												<td class="text-center">                
													<a class="btn btn-info btn-xs" href="<?php echo 'admin/danhmuc/down/'.$row1["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
												</td>
                                                <td class="text-center">                
                                                    <a class="btn btn-success btn-xs" href="<?php echo 'admin/danhmuc/edit/'.$row1["cm_id"]; ?>"  role="button"> <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                                </td>
                                                <td class="text-center">                
                                                    <a class="btn btn-danger btn-xs" href="<?php echo 'admin/danhmuc/delete/'.$row1["cm_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')" role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            $danhmuc2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($row1["cm_id"],'danh-muc',"","");
                                            foreach ($danhmuc2 as $row2)
                                            {	
                                                $img = "default.png";
                                                if($row2["cm_hinh"] != "")
                                                    $img = $row2["cm_hinh"]; 
                                        ?>
                                            <tr>			   					               
                                                <td class="text-center" style="width:20px"> 
                                                    <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row2["cm_id"];?>"/>
                                                </td>
												
                                                <td class="text-center" style="width:50px">
                                                    &nbsp;<img src="../uploads/chuyenmuc/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>&nbsp;|----------<?php echo $row2["cm_ten"];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row2["cm_menu"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/danhmuc/hide_menu/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/danhmuc/hide_menu/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
												
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row2["cm_trang_thai"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/danhmuc/hide_status/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/danhmuc/show_status/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
													<?php 
													if ($row2["cm_noi_bat"]==1)
													{
													?>					 
														<a href="<?php echo 'admin/danhmuc/hide_hot/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
													<?php
													}
													else
													{
													?>
														 <a href="<?php echo 'admin/danhmuc/show_hot/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
													<?php
													}
													?>
												</td>
												<td class="text-center">                
													<a class="btn btn-info btn-xs" href="<?php echo 'admin/danhmuc/down/'.$row2["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
												</td>
                                                <td class="text-center">                
                                                    <a class="btn btn-success btn-xs" href="<?php echo 'admin/danhmuc/edit/'.$row2["cm_id"]; ?>" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                                </td>
                                                <td class="text-center">                
                                                    <a class="btn btn-danger btn-xs" href="<?php echo 'admin/danhmuc/delete/'.$row2["cm_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')" > <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                                </td>
                                                
                                            </tr>
                                        <?php
                                                }
                                            }
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
function js_xoa_nhieu_danh_muc(){
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
				var url = "/admin/ajax/ajax_xoa_nhieu_chuyen_muc";       
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