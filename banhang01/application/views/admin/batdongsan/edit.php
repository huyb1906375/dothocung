<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />
<script src="<?php echo base_url();?>public/admin/js/jquery.uploadfile.min.js"></script>
<link href="<?php echo base_url();?>public/admin/css/uploadfile.css" rel="stylesheet">
<?php

$id_news = $row['bds_id'];
?>
<form name="frm" action="<?php echo base_url();?>admin/batdongsan/edit/<?php echo $row['bds_id'];?>" method="post"  enctype="multipart/form-data"  onsubmit="return checkValue();">
<section class="content-header">
  <h1>
  	SẢN PHẨM
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/sanpham">Sản phẩm</a></li>
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
                            <label>Tên:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo $row['bds_ten']; ?>" style="width:100%">
                            <input type="hidden" class="form-control" id="txtID" name="txtID" value="<?php echo $row['bds_id']; ?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
                        </div>
						<div class="form-group">
                            <label>Thuộc loại bất động sản:</label>
                            <select name="cboChuyenMuc" class="form-control" style="width:100%">
                                <option value="0"></option>
								<?php 
								$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","loai-bat-dong-san","","");
								foreach ($parent as $p) 
								{
									echo "<option ".(($row['bds_cm_id'] == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
									$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"loai-bat-dong-san","","");
									foreach ($child as $c) 
									{
										echo "<option ".(($row['bds_cm_id'] == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
									}
								}
								?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tỉnh thành:</label>
                            <select name="cboTinhThanh" id="cboTinhThanh" class="form-control select2" style="width:100%" onchange="lay_ds_quan_huyen()">
                                <option value="">&nbsp;</option>
                                <?php
                                $tinhthanh = $this->tinhthanh_model->lay_danh_sach_tinh_thanh();
                                foreach ($tinhthanh as $tt) 
                                {
                                    echo "<option ".(($row['bds_tt_id'] == $tt["tt_id"])?"selected":"")." value='".$tt["tt_id"]."'>".$tt["tt_ten"]."</option>";
                                    
                                }
                                ?>
                            </select>
                        </div>
                        <div id="ajax_quanhuyen" class="form-group">
                            <label>Quận huyện:</label>
                            <select name="cboQuanHuyen" id="cboQuanHuyen" class="form-control select2" style="width:100%" onchange="lay_ds_phuong_xa()">
                                <option value="">&nbsp;</option>
                                <?php
                                $quanhuyen = $this->quanhuyen_model->lay_danh_sach_quan_huyen($this->session->userdata('tt_id'));
                                foreach ($quanhuyen as $qh) 
                                {
                                    echo "<option ".(($row['bds_qh_id'] == $qh["qh_id"])?"selected":"")." value='".$qh["qh_id"]."'>".$qh["qh_ten"]."</option>";
                                    
                                }
                                ?>
                            </select>
                        </div>	
                        <div id="ajax_phuongxa" class="form-group">
                            <label>Phường xã:</label>
                            <select name="cboPhuongXa" id="cboPhuongXa" class="form-control select2" style="width:100%">
                                <option value="">&nbsp;</option>
                                <?php
                                $phuongxa = $this->phuongxa_model->lay_danh_sach_phuong_xa($this->session->userdata('tt_id'),$this->session->userdata('qh_id'));
                                foreach ($phuongxa as $px) 
                                {
                                    echo "<option ".(($row['bds_px_id'] == $px["px_id"])?"selected":"")." value='".$px["px_id"]."'>".$px["px_ten"]."</option>";
                                    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">                            
                            <label>Địa chỉ:</label>
                            <input type="text" class="form-control" id="txtDiaChi" name="txtDiaChi" value="<?php echo $row['bds_dia_chi'];?>" style="width:100%">
                            
                        </div>
                        
						<div class="form-group">
                            <label>Tình trạng pháp lý:</label>
                            <select name="cboPhapLy" id="cboPhapLy" class="form-control select2" style="width:100%">
                                <option value="">Không xác định</option>
                                <option <?php if($row['bds_phap_ly'] == "sohong") echo "selected";?> value="dong">Sổ hồng</option>
                                <option <?php if($row['bds_phap_ly'] == "sodo") echo "selected";?> value="tay">Sổ đỏ</option>
                                <option <?php if($row['bds_phap_ly'] == "giaytay") echo "selected";?> value="nam">Giấy tay</option>
                                <option <?php if($row['bds_phap_ly'] == "hopdong") echo "selected";?> value="bac">Hợp đồng</option>
                                <option <?php if($row['bds_phap_ly'] == "giaytohople") echo "selected";?> value="dongbac">Giấy tờ hợp lệ</option>
                                <option <?php if($row['bds_phap_ly'] == "danghopthuchoa") echo "selected";?> value="dongnam">Đang hợp thức hóa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Diện tích (m2):</label>
                            <input type="text" id="txtDienTich" name="txtDienTich" value="<?php echo $row['bds_dien_tich'];?>" onfocus="this.setSelectionRange(0,this.value.length)"  class="form-control f-bold" /> 
                        </div>     
                        <div class="form-group">
                            <label>Giá bán/thuê:</label>
                            <input type="text" id="txtGia" name="txtGia" value="<?php echo number_format($row['bds_gia']);?>" onkeyup="FormatNumber(this);" onfocus="this.setSelectionRange(0,this.value.length)"  class="form-control f-bold" /> 
                        </div>
                        
                         
                        <div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo $row['bds_mo_ta'];?></textarea>
                            <script>CKEDITOR.replace('txtMoTa');</script>
                        </div>
                    </div>
                    <div class="col-md-3"> 
						<div class="form-group">                            
                            <label>Tên liên hệ:</label>
                            <input type="text" class="form-control" id="txtTenLienHe" name="txtTenLienHe" value="<?php echo $row['bds_ten_lien_he'];?>" style="width:100%">
                            
                        </div>
                        <div class="form-group">                            
                            <label>Điện thoại liên hệ:</label>
                            <input type="text" class="form-control" id="txtDienThoaiLienHe" name="txtDienThoaiLienHe" value="<?php echo $row['bds_dien_thoai_lien_he'];?>" style="width:100%">
                            
                        </div>
                        <div class="form-group">                            
                            <label>Email liên hệ:</label>
                            <input type="text" class="form-control" id="txtEmailLienHe" name="txtEmailLienHe" value="<?php $row['bds_email_lien_he'];?>" style="width:100%">
                            
                        </div>
						<div class="form-group">
							<label>Trạng thái:</label>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkNoiBat" name="chkNoiBat" type="checkbox" <?php if($row['bds_noi_bat'] == 1) echo "checked";?> value="1">Nổi bật										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkHienThi" name="chkHienThi" type="checkbox" <?php if($row['bds_trang_thai'] == 1) echo "checked";?> value="1">Hiển thị										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkTieuBieu" name="chkTieuBieu" type="checkbox" <?php if($row['bds_tieu_bieu'] == 1) echo "checked";?> value="1">Tiêu biểu									
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkGiaoDich" name="chkGiaoDich" type="checkbox" <?php if($row['bds_giao_dich'] == 1) echo "checked";?> value="1">Đã giao dịch									
									</div>
								</div>
								
							</div>
                        </div>
						<div class="form-group">
						  <label class="control-label">Ngày đăng:</label>
						  <div class='input-group date' id='datetimepicker1'>
							 <input id="txtNgayDang" name="txtNgayDang" type='text' class="form-control" value="<?php echo date('Y/m/d H:i:s',strtotime($row["bds_ngay_dang"]));?>" />
							 <span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							 </span>
						  </div>
						</div>
                        
						<div class="form-group">
                        	<label>Hình ảnh:</label>
                            <div id="fileuploader">Upload</div>
                        	<div id="image_list">
                            	<?php
                            	$items = $this->batdongsan_model->lay_danh_sach_bat_dong_san_hinh($id_news);
                                foreach($items as $item)
                                {
                                ?>
                                <div class="image_item">
                                    
                                    <a onclick="loadDuLieu('image_list','<?php echo base_url(); ?>admin/ajax/xoa_bat_dong_san_hinh/<?php echo $item['bdsh_id'];?>/<?php echo $item['bdsh_bds_id'];?>')" class="image_item_delete"></a>
									<img class="thumbnail" src="<?php echo base_url(); ?>uploads/batdongsan/<?php echo $item["bdsh_url"];?>">                   
                                </div>
                                <?php
                                }
                                ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Thêm]
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/batdongsan" role="button">
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
	var url = "<?php echo base_url(); ?>admin/ajax/lay_danh_sach_bat_dong_san_hinh/<?php echo $id_news; ?>";
	loadDuLieu('image_list',url);
}
$("#fileuploader").uploadFile({
	url:"<?php echo base_url(); ?>admin/ajax/upload_bat_dong_san_hinh/<?php echo $id_news; ?>",
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
function lay_ds_quan_huyen(){
	var tt_id = $("#cboTinhThanh").val();
    var url = "/admin/ajax/lay_ds_quan_huyen/"+tt_id;
	//alert(url);
	loadDuLieu('ajax_quanhuyen',url);
}
function lay_ds_phuong_xa(){
	var tt_id = $("#cboTinhThanh").val();
	var qh_id = $("#cboQuanHuyen").val();
    var url = "/admin/ajax/lay_ds_phuong_xa/"+tt_id+"/"+qh_id;
	//alert(url);
	loadDuLieu('ajax_phuongxa',url);
}
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();

</script>
</form>