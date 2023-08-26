<?php

$loai = "MainMenu";
if($this->session->userdata('m_loai')) $loai = $this->session->userdata('m_loai');
?>
<form name="frm" action="<?php echo base_url() ?>admin/menu" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  	<h1>
        MENU
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Menu</li>
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
                	
                    <div class="col-md-12">
						<div class="row">
							
							<div class="form-group col-md-6">
								<label>Loại menu:</label>
								<select id="cboLoaiMenu" name="cboLoaiMenu" class="form-control" style="width:100%" onchange="submit()">
									<option <?php if($loai == 'MainMenu') echo "selected";?> value="MainMenu">Main Menu</option>
									<option <?php if($loai == 'TopMenu') echo "selected";?> value="TopMenu">Top Menu</option>
									<option <?php if($loai == 'LeftMenu') echo "selected";?> value="LeftMenu">Left Menu</option>
									<option <?php if($loai == 'RightMenu') echo "selected";?> value="RightMenu">Right Menu</option>
									<option <?php if($loai == 'FooterMenu') echo "selected";?> value="FooterMenu">Footer Menu</option>
								</select> 
							</div>
							<div class="form-group col-md-6">
								<label>&nbsp;</label>
								<div class="input-group">
									
									<a href="/admin/menu/add" class="btn btn-primary" role="button">
										<span class="glyphicon glyphicon-plus"></span> Thêm mới
									</a>
									
								</div>
							</div>
						</div>
                        <div id="cautrucmenu" class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
										
										<th class="text-center" style="width:50px">Hình</th>
                                        <th>Tên menu</th>
										<th class="text-center" style="width:50px">Xuống</th>
										<th class="text-center" style="width:50px">Sửa</th>
										<th class="text-center" style="width:50px">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									
									$menu = $this->menu_model->lay_danh_sach_menu("0",$loai);
									foreach ($menu as $row)
									{	
										$img = "default.png";
										if($row["m_hinh"] != "")
											$img = $row["m_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center">
                                            &nbsp;<img src="../uploads/menu/<?php echo $img;?> " height="25" width="25"/>
                                        </td>
                                        <td>&nbsp;<?php echo $row["m_ten"];?></td>
										
										<td class="text-center">                
                                            <a class="btn btn-info btn-xs" href="<?php echo 'admin/menu/down/'.$row["m_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
                                        </td>
										<td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/menu/edit/'.$row["m_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/menu/delete/'.$row["m_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"   role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                        </td>
                                    </tr>
                                        <?php
                                            $menu1 = $this->menu_model->lay_danh_sach_menu($row["m_id"],$loai);
                                            foreach ($menu1 as $row1)
                                            {	
                                                $img = "default.png";
                                                if($row1["m_hinh"] != "")
                                                    $img = $row1["m_hinh"]; 
                                        ?>
                                            <tr>			   					               
                                                <td class="text-center" style="width:50px">
                                                    &nbsp;<img src="../uploads/menu/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>&nbsp;|-----<?php echo $row1["m_ten"];?></td>
												
												<td class="text-center">                
													<a class="btn btn-info btn-xs" href="<?php echo 'admin/menu/down/'.$row1["m_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
												</td>
												<td class="text-center">                
													<a class="btn btn-success btn-xs" href="<?php echo 'admin/menu/edit/'.$row1["m_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
												</td>
												<td class="text-center">                
													<a class="btn btn-danger btn-xs" href="<?php echo 'admin/menu/delete/'.$row1["m_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
												</td>
                                            </tr>
                                            <?php
                                            $menu2 = $this->menu_model->lay_danh_sach_menu($row1["m_id"],$loai);
                                            foreach ($menu2 as $row2)
                                            {	
                                                $img = "default.png";
                                                if($row2["m_hinh"] != "")
                                                    $img = $row2["m_hinh"]; 
                                        ?>
                                            <tr>			   					               
                                                <td class="text-center" style="width:50px">
                                                    &nbsp;<img src="../uploads/menu/<?php echo $img;?> " height="25" width="25"/>
                                                </td>
                                                <td>&nbsp;|----------<?php echo $row2["m_ten"];?></td>
												<td class="text-center">                
													<a class="btn btn-info btn-xs" href="<?php echo 'admin/menu/down/'.$row2["m_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
												</td>
												<td class="text-center">                
													<a class="btn btn-success btn-xs" href="<?php echo 'admin/menu/edit/'.$row2["m_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
												</td>
												<td class="text-center">                
													<a class="btn btn-danger btn-xs" href="<?php echo 'admin/menu/delete/'.$row2["m_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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

function themMenu(url){	
	var loai = document.getElementById("cboMenu").value;
	//alert(url+'/'+loai);
	//$("#modal-default").val(value);
	//var loai = document.getElementById("cboLoai").value;
	loadDuLieu('cautrucmenu',url+'/'+loai);
}
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