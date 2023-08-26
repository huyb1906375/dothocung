<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />
<script src="<?php echo base_url();?>public/admin/js/jquery.uploadfile.min.js"></script>
<link href="<?php echo base_url();?>public/admin/css/uploadfile.css" rel="stylesheet">
<?php
$id_news = $row['bv_id'];
?>
<form name="frm" action="<?php echo base_url();?>admin/baiviet/edit/<?php echo $row['bv_id'];?>" method="post"  enctype="multipart/form-data"  onsubmit="return checkValue();">
<section class="content-header">
  <h1>
  	BÀI VIẾT
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/baiviet">Bài viết</a></li>
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
                            <label>Tiêu đề:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo $row['bv_ten']; ?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
							<input type="hidden" class="form-control" id="txtID" name="txtID" value="<?php echo $row['bv_id']; ?>" style="width:100%">
                        </div>
						
						<div class="form-group">
                            <label>Nội dung tóm tắt:</label>
                            <textarea name="txtTomTat" id="txtTomTat" class="form-control" ><?php echo $row['bv_tom_tat']; ?></textarea>
                        </div>
						<div class="form-group">
                            <label>Nội dung chi tiết:</label>
                            <textarea name="txtChiTiet" id="txtChiTiet" class="form-control" ><?php echo $row['bv_chi_tiet']; ?></textarea>
							<script>CKEDITOR.replace('txtChiTiet');</script>	
                        </div>
						
                    </div>
                    <div class="col-md-3">                  	
						<div class="form-group">
                            <label>Thuộc chuyên mục:</label>
                            <select name="cboChuyenMuc" class="form-control select2" style="width:100%">
                                <option value="0"></option>
								<?php
								$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","chuyen-muc","","");
								foreach ($parent as $p) 
								{
									echo "<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
									$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"chuyen-muc","","");
									foreach ($child as $c) 
									{
										echo "<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
									}
								}
								?>
                            </select>
                        </div>
                        <div class="form-group">
							<label>Loại bài viết:</label>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkNoiBat" name="chkNoiBat" type="checkbox" <?php if($row['bv_noi_bat'] == 1) echo "checked";?> value="1">Nổi bật										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkTieuDiem" name="chkTieuDiem" type="checkbox" <?php if($row['bv_tieu_diem'] == 1) echo "checked";?> value="1">Tiêu điểm										
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
						  <label class="control-label">Ngày đăng:</label>
						  <div class='input-group date' id='datetimepicker1'>
							 <input id="txtNgayDang" name="txtNgayDang" type='text' class="form-control" value="<?php echo date('Y/m/d H:i:s',strtotime($row["bv_ngay_dang"]));?>" />
							 <span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							 </span>
						  </div>
						</div>
						
                        <div class="form-group">
                        	<label>Hình đại diện:</label>
							<?php
							$img = "upload-image.png";
							if($row['bv_hinh'] != "")
								$img = $row['bv_hinh'];
							?>
                            <div id="upload-image-box">                            	          
								<div class="item">
                                    <label for="fileHinhAnh">
                                        <img class="thumbnail form-control" src="uploads/baiviet/<?php echo $img;?>"/>            
                                    </label>
                                    <input name="fileHinhAnh" id="fileHinhAnh" class="inputimage" accept="image/*" type="file">  
								</div>								
                            </div>
                        </div>
						<div class="form-group">
                        	<label>Album hình ảnh:</label>
                            <div id="fileuploader">Upload</div>
                        	<div id="image_list">
                            	<?php
                            	$items = $this->baiviet_model->lay_danh_sach_hinh_bai_viet($row['bv_id']);
                                foreach($items as $item)
                                {
                                ?>
                                <div class="image_item">
                                    
                                    <a onclick="loadDuLieu('image_list','<?php echo base_url(); ?>admin/ajax/xoa_hinh_bai_viet/<?php echo $item['bvh_id'];?>/<?php echo $item['bvh_bv_id'];?>')" class="image_item_delete"></a>
									<img class="thumbnail" src="/uploads/baiviet/<?php echo $item["bvh_url"];?>">                   
                                </div>
                                <?php
                                }
                                ?>
                            </div> 
                        </div>
                        
                    </div>
					
                </div>
				<div class="box-footer">
					<div class="col-md-12 text-center">
						<div class="form-group">
							<button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Sửa]
							</button>
							<a class="btn btn-primary btn-sm" href="admin/baiviet" role="button">
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
function LoadAlbumHinh()
{
	var url = "<?php echo base_url(); ?>admin/ajax/lay_danh_sach_hinh_bai_viet/<?php echo $id_news; ?>";
	loadDuLieu('image_list',url);
}
$("#fileuploader").uploadFile({
	url:"<?php echo base_url(); ?>admin/ajax/upload_hinh_bai_viet/<?php echo $id_news; ?>",
	fileName:"myfile",
	dragDrop: true,
	showDelete: true,
	showDownload:false,
	showStatusAfterSuccess:false,
	dataType: "json",
	onSuccess:function(res){
		LoadAlbumHinh();
	}
});
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
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();

</script>
</form>