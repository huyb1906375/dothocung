<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />
<script src="<?php echo base_url();?>public/admin/js/jquery.uploadfile.min.js"></script>
<link href="<?php echo base_url();?>public/admin/css/uploadfile.css" rel="stylesheet">
<?php

$id_news = substr(date('YmdHis'),2,12);
if(isset($id))
	$id_news = $id;
?>
<form name="frm" action="<?php echo base_url() ?>admin/batdongsan/add" method="post"  enctype="multipart/form-data"  onsubmit="return checkValue();">
<section class="content-header">
  <h1>
  	BẤT ĐỘNG SẢN
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/sanpham">Bất động sản</a></li>
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
                            <input type="text" class="form-control" id="txtID" name="txtID" value="<?php echo $id_news;?>" style="width:100%">
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
									echo "<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
									$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"loai-bat-dong-san","","");
									foreach ($child as $c) 
									{
										echo "<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
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
                                    echo "<option ".(($this->session->userdata('tt_id') == $tt["tt_id"])?"selected":"")." value='".$tt["tt_id"]."'>".$tt["tt_ten"]."</option>";
                                    
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
                                    echo "<option ".(($this->session->userdata('qh_id') == $qh["qh_id"])?"selected":"")." value='".$qh["qh_id"]."'>".$qh["qh_ten"]."</option>";
                                    
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
                                    echo "<option ".(($this->session->userdata('px_id') == $px["px_id"])?"selected":"")." value='".$px["px_id"]."'>".$px["px_ten"]."</option>";
                                    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">                            
                            <label>Địa chỉ:</label>
                            <input type="text" class="form-control" id="txtDiaChi" name="txtDiaChi" value="<?php echo set_value('txtDiaChi');?>" style="width:100%">
                            
                        </div>
                        
						<div class="form-group">
                            <label>Tình trạng pháp lý:</label>
                            <select name="cboPhapLy" id="cboPhapLy" class="form-control select2" style="width:100%">
                                <option value="">Không xác định</option>
                                <option <?php if($this->session->userdata('phaply') == "sohong") echo "selected";?> value="dong">Sổ hồng</option>
                                <option <?php if($this->session->userdata('phaply') == "sodo") echo "selected";?> value="tay">Sổ đỏ</option>
                                <option <?php if($this->session->userdata('phaply') == "giaytay") echo "selected";?> value="nam">Giấy tay</option>
                                <option <?php if($this->session->userdata('phaply') == "hopdong") echo "selected";?> value="bac">Hợp đồng</option>
                                <option <?php if($this->session->userdata('phaply') == "giaytohople") echo "selected";?> value="dongbac">Giấy tờ hợp lệ</option>
                                <option <?php if($this->session->userdata('phaply') == "danghopthuchoa") echo "selected";?> value="dongnam">Đang hợp thức hóa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Diện tích (m2):</label>
                            <input type="text" id="txtDienTich" name="txtDienTich" value="<?php echo set_value('txtDienTich');?>" onfocus="this.setSelectionRange(0,this.value.length)"  class="form-control f-bold" /> 
                        </div>     
                        <div class="form-group">
                            <label>Giá bán/thuê:</label>
                            <input type="text" id="txtGia" name="txtGia" value="<?php echo set_value('txtGia');?>" onkeyup="FormatNumber(this);" onfocus="this.setSelectionRange(0,this.value.length)"  class="form-control f-bold" /> 
                        </div>
                       
                         
                        <div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo set_value('txtMoTa');?></textarea>
                            <script>CKEDITOR.replace('txtMoTa');</script>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-3">
						
                        <div class="form-group">                            
                            <label>Tên liên hệ:</label>
                            <input type="text" class="form-control" id="txtTenLienHe" name="txtTenLienHe" value="<?php echo set_value('txtTenLienHe');?>" style="width:100%">
                            
                        </div>
                        <div class="form-group">                            
                            <label>Điện thoại liên hệ:</label>
                            <input type="text" class="form-control" id="txtDienThoaiLienHe" name="txtDienThoaiLienHe" value="<?php echo set_value('txtDienThoaiLienHe');?>" style="width:100%">
                            
                        </div>
                        <div class="form-group">                            
                            <label>Email liên hệ:</label>
                            <input type="text" class="form-control" id="txtEmailLienHe" name="txtEmailLienHe" value="<?php echo set_value('txtEmailLienHe');?>" style="width:100%">
                            
                        </div>
						<div class="form-group">
							<label>Trạng thái:</label>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkNoiBat" name="chkNoiBat" type="checkbox" <?php if(set_value('chkNoiBat') == 1) echo "checked";?> value="1">Nổi bật										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkHienThi" name="chkHienThi" type="checkbox" <?php if(set_value('chkHienThi') == 1) echo "checked";?> value="1">Hiển thị										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkTieuBieu" name="chkTieuBieu" type="checkbox" <?php if(set_value('chkTieuBieu') == 1) echo "checked";?> value="1">Tiêu biểu									
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkGiaoDich" name="chkGiaoDich" type="checkbox" <?php if(set_value('chkGiaoDich') == 1) echo "checked";?> value="1">Đã giao dịch									
									</div>
								</div>
								
							</div>
                        </div>
						<div class="form-group">
						  <label class="control-label">Ngày đăng:</label>
						  <div class='input-group date' id='datetimepicker1'>
							 <input id="txtNgayDang" name="txtNgayDang" type='text' class="form-control" />
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
                                    
                                    <a class="image_item_delete"></a>
									<img class="thumbnail" src="/uploads/batdongsan/<?php echo $item["bdsh_url"];?>">                   
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

$("#fileuploader").uploadFile({
	url:"<?php echo base_url(); ?>admin/ajax/upload_bat_dong_san_hinh/<?php echo $id_news; ?>",
	fileName:"myfile",
	dragDrop: true,
	showDelete: true,
	showDownload:false,
	showStatusAfterSuccess:false,
	dataType: "json",
	onSuccess:function(res){
		var url = "<?php echo base_url(); ?>admin/ajax/lay_danh_sach_bat_dong_san_hinh/<?php echo $id_news; ?>";
		loadDuLieu('image_list',url);
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
/*
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();
*/
document.frm.txtTen.focus();
</script>
</form>