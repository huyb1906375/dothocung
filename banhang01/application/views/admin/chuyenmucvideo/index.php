<form name="frm" action="<?php echo base_url() ?>admin/chuyenmucvideo/delete_all" method="post"  enctype="multipart/form-data" onsubmit="return delete_confirm();" >
<section class="content-header">
  	<h1>
        CHUYÊN MỤC VIDEO
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Chuyên mục video</li>
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
                    	<input type="submit" name="btnXoa" value="Xóa chọn" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
                        <a href="<?php echo base_url();?>admin/chuyenmucvideo/add">
                           <input type="button" name="btnThemMoi" value="Thêm mới" class="btn btn-primary btn-sm"/>
                        </a>
                        
                    </div>
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                        
										<th class="text-center">Hình</th>
                                        <th>Tên chuyên mục</th>
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
									$chuyenmuc = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0",'chuyen-muc-video',"", "");
									foreach ($chuyenmuc as $row)
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
                                            <img src="../uploads/chuyenmuc/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td><?php echo $row["cm_ten"];?></td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_menu"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/chuyenmucvideo/hide_menu/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/chuyenmucvideo/show_menu/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/chuyenmucvideo/hide_status/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/chuyenmucvideo/show_status/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cm_noi_bat"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/chuyenmucvideo/hide_hot/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/chuyenmucvideo/show_hot/'.$row["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
										<td class="text-center">                
                                            <a class="btn btn-info btn-xs" href="<?php echo 'admin/chuyenmucvideo/down/'.$row["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/chuyenmucvideo/edit/'.$row["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/chuyenmucvideo/delete/'.$row["cm_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                        </td>	
                                        
                                    </tr>
                                        <?php
                                            $chuyenmuc1 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($row["cm_id"],'chuyen-muc-video',"", "");
                                            foreach ($chuyenmuc1 as $row1)
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
                                                    <img src="../uploads/chuyenmuc/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>|-----<?php echo $row1["cm_ten"];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row1["cm_menu"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/chuyenmucvideo/hide_menu/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/chuyenmucvideo/show_menu/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
												
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row1["cm_trang_thai"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/chuyenmucvideo/hide_status/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/chuyenmucvideo/show_status/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
													<?php 
													if ($row1["cm_noi_bat"]==1)
													{
													?>					 
														<a href="<?php echo 'admin/chuyenmucvideo/hide_hot/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
													<?php
													}
													else
													{
													?>
														 <a href="<?php echo 'admin/chuyenmucvideo/show_hot/'.$row1["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
													<?php
													}
													?>
												</td>
												<td class="text-center">                
													<a class="btn btn-info btn-xs" href="<?php echo 'admin/chuyenmucvideo/down/'.$row1["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
												</td>
                                                <td class="text-center">                
                                                    <a class="btn btn-success btn-xs" href="<?php echo 'admin/chuyenmucvideo/edit/'.$row1["cm_id"]; ?>"  role="button"> <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                                </td>
                                                <td class="text-center">                
                                                    <a class="btn btn-danger btn-xs" href="<?php echo 'admin/chuyenmucvideo/delete/'.$row1["cm_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')" role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            $chuyenmuc2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($row1["cm_id"],'chuyen-muc-video',"","");
                                            foreach ($chuyenmuc2 as $row2)
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
                                                    <img src="../uploads/chuyenmuc/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>|----------<?php echo $row2["cm_ten"];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row2["cm_menu"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/chuyenmucvideo/hide_menu/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/chuyenmucvideo/hide_menu/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
												
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row2["cm_trang_thai"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/chuyenmucvideo/hide_status/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/chuyenmuc/show_status/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
													<?php 
													if ($row2["cm_noi_bat"]==1)
													{
													?>					 
														<a href="<?php echo 'admin/chuyenmucvideo/hide_hot/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
													<?php
													}
													else
													{
													?>
														 <a href="<?php echo 'admin/chuyenmucvideo/show_hot/'.$row2["cm_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
													<?php
													}
													?>
												</td>
												<td class="text-center">                
													<a class="btn btn-info btn-xs" href="<?php echo 'admin/chuyenmucvideo/down/'.$row2["cm_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
												</td>
                                                <td class="text-center">                
                                                    <a class="btn btn-success btn-xs" href="<?php echo 'admin/chuyenmucvideo/edit/'.$row2["cm_id"]; ?>" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                                </td>
                                                <td class="text-center">                
                                                    <a class="btn btn-danger btn-xs" href="<?php echo 'admin/chuyenmucvideo/delete/'.$row2["cm_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')" > <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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