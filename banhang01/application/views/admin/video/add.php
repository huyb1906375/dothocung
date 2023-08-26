<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />
<script src="<?php echo base_url();?>public/admin/js/jquery.uploadfile.min.js"></script>
<link href="<?php echo base_url();?>public/admin/css/uploadfile.css" rel="stylesheet">
<?php
$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","chuyen-muc-video","","");
$option = "";
foreach ($parent as $p) 
{
	$option.="<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
	$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"chuyen-muc-video","","");
	foreach ($child as $c) 
	{
		$option.="<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
		$child2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($c["cm_id"],"chuyen-muc-video","","");
		foreach ($child2 as $c2) 
		{
			$option.="<option ".(($this->session->userdata('cm_id') == $c2["cm_id"])?"selected":"")." value='".$c2["cm_id"]."'>|----------".$c2["cm_ten"]."</option>";
		}
	}
}
$id_news = date('YmdHis');
if(isset($id))
	$id_news = $id;
?>
<form name="frm" action="<?php echo base_url() ?>admin/video/add" method="post"  enctype="multipart/form-data"  onsubmit="return checkValue();">
<section class="content-header">
  <h1>
  	VIDEO
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/video">Video</a></li>
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
                            <label>Tiêu đề:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo set_value('txtTen');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
							<input type="hidden" class="form-control" id="txtID" name="txtID" value="<?php echo $id_news;?>" style="width:100%">
                        </div>
						<div class="form-group">
                            <label>Thuộc chuyên mục:</label>
                            <select name="cboChuyenMuc" class="form-control" style="width:100%">
                                <option value="0"></option>
								<?php echo $option;?>
                            </select>
                        </div>
						
						<div class="form-group">
                            <label>Tóm tắt:</label>
                            <textarea name="txtTomTat" id="txtTomTat" class="form-control" rows="3"><?php echo set_value('txtTomTat');?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Chi tiết:</label>
                            <textarea name="txtChiTiet" id="txtChiTiet" class="form-control" ><?php echo set_value('txtChiTiet');?></textarea>
                            <script>CKEDITOR.replace('txtChiTiet');</script>
                        </div>
						
						
						
                    </div>
                    <div class="col-md-3">                  	
						<div class="form-group">
                            <label>File văn bản:</label>
							<input type="file" id="fileVanBan" name="fileVanBan" class="form-control" style="width:100%">
                        </div>
						<div class="form-group">
                            <label>Link video:</label>
                            <textarea name="txtLink" id="txtLink" class="form-control" rows="3"><?php echo set_value('txtLinkVideo');?></textarea>
							<div class="error" id="password_error"><?php echo form_error('txtLinkVideo')?></div>
                        </div>
                        <div class="form-group">
                            <label>Loại link video:</label>
                            <select name="cboLoaiLinkVideo" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('loai_link_video') == "youtube") echo "selected";?> value="youtube">Youtube</option>
                                <option <?php if($this->session->userdata('loai_link_video') == "dailymotion") echo "selected";?> value="dailymotion">Daily motion</option>
								<option <?php if($this->session->userdata('loai_link_video') == "iframe") echo "selected";?> value="iframe">IFrame</option>
                            </select>
                        </div>
                        <div class="form-group">
							<label>Loại:</label>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkNoiBat" name="chkNoiBat" type="checkbox" <?php if(set_value('chkNoiBat') == 1) echo "checked";?> value="1">Nổi bật										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkTieuDiem" name="chkTieuDiem" type="checkbox" <?php if(set_value('chkTieuDiem') == 1) echo "checked";?> value="1">Tiêu điểm										
									</div>
								</div>			
							</div>
                        </div>
						<div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('trang_thai') == 0) echo "selected";?> value="0">Chưa xuất bản</option>
                                <option <?php if($this->session->userdata('trang_thai') == 1) echo "selected";?> value="1">Xuất bản</option>
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
                            <a class="btn btn-primary btn-sm" href="admin/video" role="button">
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

function checkValue(){
	if (document.frm.txtTen.value==""){
		alert("Bạn chưa nhập tên!");
		document.frm.txtTen.focus();
		return false;
	}
	if (document.frm.cboChuyenMuc.value==""){
		alert("Bạn chưa chọn chuyên mục!");
		document.frm.cboChuyenMuc.focus();
		return false;
	}
	return true;

}

document.frm.txtTen.focus();
</script>
</form>