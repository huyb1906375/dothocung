<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />

<?php
/*
if(!isset($this->session->userdata('cm_id_parent'))
	$this->session->set_userdata('cm_id_parent',"");
if(!isset($this->session->userdata('cm_trang_thai'))
	$this->session->set_userdata('cm_trang_thai',"1");
*/
$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","chuyen-muc","","");
$option = "";
foreach ($parent as $p) 
{
	$option.="<option ".(($this->session->userdata('cm_id_parent') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
	$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"chuyen-muc","","");
	foreach ($child as $c) 
	{
		$option.="<option ".(($this->session->userdata('cm_id_parent') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
	}
}

?>
<form name="frm" action="<?php echo base_url() ?>admin/chuyenmuc/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	CHUYÊN MỤC
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php?frm=tongquan"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/chuyenmuc">Chuyên mục</a></li>
    <li>[Thêm]</li>
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
                            <label>Tên chuyên mục:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo set_value('txtTen');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
                        </div>
						
						<div class="form-group">
                            <label>Link:</label>
                            <input type="text" class="form-control" id="txtLink" name="txtLink" value="<?php echo set_value('txtLink');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtLink')?></div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo set_value('txtMoTa');?></textarea>
                            <script>CKEDITOR.replace('txtMoTa');</script>
                        </div>
						<div class="form-group">
							<label>Vị trí hiển thị nội dung trên trang chủ:</label>
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="checkbox">
										
										<input id="chkTren" name="chkTren" type="checkbox" <?php if(set_value('chkTren') == 1) echo "checked";?> value="1">Trên
										
									</div>
									<div class="checkbox">
										
										<input id="chkDuoi" name="chkDuoi" type="checkbox" <?php if(set_value('chkDuoi') == 1) echo "checked";?> value="1">Dưới
										
									</div>
									
								</div>
								<div class="col-md-4">								
									<div class="checkbox">
										
										<input id="chkTrai" name="chkTrai" type="checkbox" <?php if(set_value('chkTrai') == 1) echo "checked";?> value="1">Trái
										
									</div>
									<div class="checkbox">
										
										<input id="chkPhai" name="chkPhai" type="checkbox" <?php if(set_value('chkPhai') == 1) echo "checked";?> value="1">Phải
										
									</div>
								</div>
								<div class="col-md-4">								
									<div class="checkbox">
										
										<input id="chkGiua" name="chkGiua" type="checkbox" <?php if(set_value('chkGiua') == 1) echo "checked";?> value="1">Giữa
										
									</div>
									<div class="checkbox">										
										<input id="chkTuDo" name="chkTuDo" type="checkbox" <?php if(set_value('chkTuDo') == 1) echo "checked";?> value="1">Tự do										
									</div>
								</div>  			
							</div>
                        </div>
                        
                    </div>
                    <div class="col-md-3">
                    	<div class="form-group">
                            <label>Chuyên mục cha:</label>
                            <select name="cboChuyenMucCha" class="form-control" style="width:100%">
                                <option value="0"></option>
								<?php echo $option;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hiển thị thành menu:</label>
                            <select name="cboMenu" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('cm_loai_menu') == "NoMenu") echo "selected";?> value="NoMenu">Không hiển thị</option>
								<option <?php if($this->session->userdata('cm_loai_menu') == "TopMenu") echo "selected";?> value="TopMenu">Top Menu</option>
                                <option <?php if($this->session->userdata('cm_loai_menu') == "MainMenu") echo "selected";?> value="MainMenu">Main Menu</option>
								<option <?php if($this->session->userdata('cm_loai_menu') == "FooterMenu") echo "selected";?> value="FooterMenu">Footer Menu</option>
                            </select>
                        </div>
						
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('cm_trang_thai') == 0) echo "selected";?> value="0">Chưa xuất bản</option>
                                <option <?php if($this->session->userdata('cm_trang_thai') == 1) echo "selected";?> value="1">Xuất bản</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Nổi bật:</label>
                            <select name="cboNoiBat" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('cm_noi_bat') == 0) echo "selected";?> value="0">Bình thường</option>
                                <option <?php if($this->session->userdata('cm_noi_bat') == 1) echo "selected";?> value="1">Nổi bật</option>
                            </select>
                        </div>
                        <div class="form-group">
                        	<label>Hình đại diện:</label>
                            <div id="upload-image-box">                            	          
								<div class="item">
                                    <label for="fileHinhAnh">
                                        <img class="thumbnail form-control" src="uploads/images/upload-image.png"/>         
                                    </label>
                                    <input name="fileHinhAnh" id="fileHinhAnh" class="inputimage" accept="image/*" type="file">  
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
document.frm.txtTen.focus();
</script>
</form>