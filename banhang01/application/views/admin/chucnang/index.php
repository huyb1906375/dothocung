<form name="frm" action="<?php echo base_url() ?>admin/chucnang/delete_all" method="post"  enctype="multipart/form-data" onsubmit="return delete_confirm();" >
<section class="content-header">
  	<h1>
        CHỨC NĂNG
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Chức năng</li>
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
                        <a href="<?php echo base_url();?>admin/chucnang/add">
                           <input type="button" name="btnThemMoi" value="Thêm mới" class="btn btn-primary btn-sm"/>
                        </a>
                        
                    </div>
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
                                        
										<th class="text-center" style="width:50px">Hình</th>
                                        <th>Tên chức năng</th>
                                        <th class="text-center" style="width:90px">Xuất bản</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									$chucnang = $this->chucnang_model->lay_danh_sach_chuc_nang("0","");
									foreach ($chucnang as $row)
									{	
										$img = "default.png";
										if($row["cn_hinh"] != "")
											$img = $row["cn_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center" style="width:20px"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["cn_id"];?>"/>
                                        </td>
										
                                        <td class="text-center">
                                            &nbsp;<img src="../uploads/chucnang/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["cn_ten"];?></td>
										
                                        <td class="text-center">
                                            <?php 
                                            if ($row["cn_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/chucnang/hide_status/'.$row["cn_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/chucnang/show_status/'.$row["cn_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/chucnang/edit/'.$row["cn_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/chucnang/delete/'.$row["cn_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                        </td>	
                                        
                                    </tr>
                                        <?php
                                            $chucnang1 = $this->chucnang_model->lay_danh_sach_chuc_nang($row["cn_id"],"");
                                            foreach ($chucnang1 as $row1)
                                            {	
                                                $img = "default.png";
                                                if($row1["cn_hinh"] != "")
                                                    $img = $row1["cn_hinh"]; 
                                        ?>
                                            <tr>			   					               
                                                <td class="text-center" style="width:20px"> 
                                                    <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row1["cn_id"];?>"/>
                                                </td>
												
                                                <td class="text-center" style="width:50px">
                                                    &nbsp;<img src="../uploads/chucnang/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>&nbsp;|-----<?php echo $row1["cn_ten"];?></td>
												
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row1["cn_trang_thai"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/chucnang/hide_status/'.$row1["cn_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/chucnang/show_status/'.$row1["cn_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                
                                                <td class="text-center">                
                                                    <a class="btn btn-success btn-xs" href="<?php echo 'admin/chucnang/edit/'.$row1["cn_id"]; ?>"  role="button"> <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                                </td>
                                                <td class="text-center">                
                                                    <a class="btn btn-danger btn-xs" href="<?php echo 'admin/chucnang/delete/'.$row1["cn_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')" role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            $chucnang2 = $this->chucnang_model->lay_danh_sach_chuc_nang($row1["cn_id"],"");
                                            foreach ($chucnang2 as $row2)
                                            {	
                                                $img = "default.png";
                                                if($row2["cn_hinh"] != "")
                                                    $img = $row2["cn_hinh"]; 
                                        ?>
                                            <tr>			   					               
                                                <td class="text-center" style="width:20px"> 
                                                    <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row2["cn_id"];?>"/>
                                                </td>
												
                                                <td class="text-center" style="width:50px">
                                                    &nbsp;<img src="../uploads/chucnang/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>&nbsp;|----------<?php echo $row2["cn_ten"];?></td>
												
                                                <td class="text-center">
                                                    <?php 
                                                    if ($row2["cn_trang_thai"]==1)
                                                    {
                                                    ?>					 
                                                        <a href="<?php echo 'admin/chucnang/hide_status/'.$row2["cn_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <a href="<?php echo 'admin/chucnang/show_status/'.$row2["cn_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                
                                                <td class="text-center">                
                                                    <a class="btn btn-success btn-xs" href="<?php echo 'admin/chucnang/edit/'.$row2["cn_id"]; ?>" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                                </td>
                                                <td class="text-center">                
                                                    <a class="btn btn-danger btn-xs" href="<?php echo 'admin/chucnang/delete/'.$row2["cn_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')" > <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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