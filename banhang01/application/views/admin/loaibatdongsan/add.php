<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />

<?php
$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","loai-bat-dong-san","","");
$option = "";
foreach ($parent as $p) 
{
	$option.="<option ".(($this->session->userdata('cm_id_parent') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
	$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"loai-bat-dong-san","","");
	foreach ($child as $c) 
	{
		$option.="<option ".(($this->session->userdata('cm_id_parent') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
	}
}

?>
<form name="frm" action="<?php echo base_url() ?>admin/loaibatdongsan/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	LOẠI BẤT ĐỘNG SẢN
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php?frm=tongquan"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/loaibatdongsan">Loại bất động sản</a></li>
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
                            <label>Tên loại bất động sản:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo set_value('txtTen');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
                        </div>
						
                        <div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo set_value('txtMoTa');?></textarea>
                            <script>CKEDITOR.replace('txtMoTa');</script>
                        </div>
						
                        
                    </div>
                    <div class="col-md-3">
                    	<div class="form-group">
                            <label>Loại bất động sản cha:</label>
                            <select name="cboChuyenMucCha" class="form-control" style="width:100%">
                                <option value="0"></option>
								<?php echo $option;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('cm_trang_thai') == 0) echo "selected";?> value="0">Không hiển thị</option>
                                <option <?php if($this->session->userdata('cm_trang_thai') == 1) echo "selected";?> value="1">Hiển thị</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Menu:</label>
                            <select name="cboMenu" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('cm_menu') == 0) echo "selected";?> value="0">Không hiển thị</option>
                                <option <?php if($this->session->userdata('cm_menu') == 1) echo "selected";?> value="1">Hiển thị</option>
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
                            <button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Thêm]
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/loaibatdongsan" role="button">
								<span class="glyphicon glyphicon-arrow-left"></span> Trở về
							</a>
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