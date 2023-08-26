<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />

<?php

$parent = $this->chucnang_model->lay_danh_sach_chuc_nang("0",1);
$option = "";
foreach ($parent as $p) 
{
	$option.="<option ".(($row['cn_id_parent'] == $p["cn_id"])?"selected":"")." value='".$p["cn_id"]."'>".$p["cn_ten"]."</option>";
	$child = $this->chucnang_model->lay_danh_sach_chuc_nang($p["cn_id"],"chuc-nang","");
	foreach ($child as $c) 
	{
		$option.="<option ".(($row['cn_id_parent'] == $c["cn_id"])?"selected":"")." value='".$c["cn_id"]."'>|-----".$c["cn_ten"]."</option>";
	}
}

?>
<form name="frm" action="<?php echo base_url() ?>admin/chucnang/edit/<?php echo $row['cn_id'];?>" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	CHỨC NĂNG
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php?frm=tongquan"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="index.php?frm=chucnang">Chức năng</a></li>
    <li>[Sửa]</li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" id="view">
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
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Tên chức năng:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo $row["cn_ten"];?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
                        </div>
						
						<div class="form-group">
                            <label>Module:</label>
                            <input type="text" class="form-control" id="txtModule" name="txtModule" value="<?php echo $row["cn_module"];?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtModule')?></div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo $row["cn_mo_ta"];?></textarea>
                            <script>CKEDITOR.replace('txtMoTa');</script>
                        </div>
						
                        
                    </div>
                    <div class="col-md-3">
                    	<div class="form-group">
                            <label>Chức năng cha:</label>
                            <select name="cboChucNangCha" class="form-control" style="width:100%">
								<?php echo $option;?>
                            </select>
                        </div>
                        
						
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($row["cn_trang_thai"] == 0) echo "selected";?> value="0">Chưa xuất bản</option>
                                <option <?php if($row["cn_trang_thai"] == 1) echo "selected";?> value="1">Xuất bản</option>
                            </select>
                        </div>
						
                        <div class="form-group">
                        	<label>Hình đại diện:</label>
							<?php
							$img = "upload-image.png";
							if($row['cn_hinh'] != "")
								$img = $row['cn_hinh'];
							?>
                            <div id="upload-image-box">                            	          
								<div class="item">
                                    <label for="fileHinhAnh">
                                        <img class="thumbnail form-control" src="uploads/chuyenmuc/<?php echo $img;?>"/>         
                                    </label>
                                    <input name="fileHinhAnh" id="fileHinhAnh" class="inputimage" accept="image/*" type="file"> 
									<span class="imgdelete"></span>
								</div>								
                            </div>
                        </div>
                        <div class="form-group">
                             <input type="submit" name="btnLuu" value="Lưu lại" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
                            <a href="index.php">
                               <input type="button" name="btnTroVe" value="Trở về" class="btn btn-primary btn-sm"/>
                            </a>
                            <label id="lblThongBao" style="color:#F00;">&nbsp;&nbsp;</label> 
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
        
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script type="text/javascript">
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();
</script>
</form>