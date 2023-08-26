<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />
<script src="<?php echo base_url();?>public/admin/js/jquery.uploadfile.min.js"></script>
<link href="<?php echo base_url();?>public/admin/css/uploadfile.css" rel="stylesheet">
<?php
$id_news = date('YmdHis');
if(isset($id))
	$id_news = $id;
?>
<form name="frm" action="<?php echo base_url() ?>admin/sanpham/add" method="post"  enctype="multipart/form-data"  onsubmit="return checkValue();">
<section class="content-header">
  <h1>
  	SẢN PHẨM
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/sanpham">Sản phẩm</a></li>
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
                            <label>Tên sản phẩm:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo set_value('txtTen');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
							<input type="hidden" class="form-control" id="txtMa" name="txtMa" value="<?php echo set_value('txtMa');?>" style="width:100%">
							<input type="hidden" class="form-control" id="txtID" name="txtID" value="<?php echo $id_news;?>" style="width:100%">
                        </div>
						<div class="form-group">
                            <label>Tóm tắt:</label>
                            <textarea name="txtTomTat" id="txtTomTat" class="form-control" ><?php echo set_value('txtTomTat');?></textarea>
                        </div>
						<div class="form-group">
							<div class="nav-tabs-custom" style="border-top: 1px solid #ddd;">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_chitiet" data-toggle="tab" aria-expanded="false"><b>Mô tả chi tiết</b></a></li>
									<li class=""><a href="#tab_thuoctinh" data-toggle="tab" aria-expanded="false"><b>Thông số kỹ thuật</b></a></li>									
									<li class=""><a href="#tab_chitiet2" data-toggle="tab" aria-expanded="false"><b>Hướng dẫn sử dụng</b></a></li>
									<li class=""><a href="#tab_chitiet3" data-toggle="tab" aria-expanded="false"><b>Thông tin khác</b></a></li>
									
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_chitiet">
										<div class="form-group">
											<textarea name="txtChiTiet" id="txtChiTiet" class="form-control" ><?php echo set_value('txtChiTiet');?></textarea>
											<script>CKEDITOR.replace('txtChiTiet');</script>
										</div>
										
									</div>
									<div class="tab-pane" id="tab_thuoctinh">
										<div class="box-body table-responsive no-padding form-group" style="border: 1px solid #ddd;">
											<!--
											<div class="col-md-12" style="background: #ddd;">
												<label style="padding: 5px;">Thuộc tính</label>
											</div>
											-->
											<div class="col-md-12" id="sanphamthuoctinh">
												<?php
												$tt = $this->sanpham_model->lay_danh_sach_san_pham_thuoc_tinh($id_news);
												if(count($tt) > 0)
												{
												?>
												<table class="table table-hover table-bordered" style="margin-top: 10px;">
													<thead>
														<tr>
															<th>Tên</th>
															<th>Giá trị</th>                                        
															<th class="text-center" style="width:50px">Xóa</th>
														</tr>
													</thead>
													<tbody>
														<?php
															
															foreach ($tt as $rowtt)
															{
														?>
														<tr>
															<td>&nbsp;<?php echo $rowtt["sptt_ten"];?></td>
															<td>&nbsp;<?php echo $rowtt["sptt_gia_tri"];?></td>
															<td class="text-center" >                
																<a class="btn btn-danger btn-xs" onclick="loadDuLieu('sanphamthuoctinh','admin/ajax/xoa_san_pham_thuoc_tinh/<?php echo $rowtt["sptt_id"];?>/<?php echo $rowtt["sptt_sp_id"];?>');" style="cursor:pointer;"  role="button"><span class="glyphicon glyphicon-trash"></span> Xóa</a>                
															</td>
														</tr>
														<?php
															}
														?>
													</tbody>
												</table>
												<?php
												}
												?>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-5">
													<label>Tên:</label>
													<input type="text" class="form-control" id="txtTenThuocTinh" name="txtTenThuocTinh" style="width:100%"  value="">
												</div>
												<div class="form-group col-md-5">
													<label>Giá trị:</label>
													<input type="text" class="form-control" id="txtGiaTriThuocTinh" name="txtGiaTriThuocTinh" style="width:100%"  value="">
												</div>
												<div class="form-group col-md-2">
													<label>&nbsp;</label>
													<div class="input-group">
														<button type="button" class="btn btn-primary" onclick="themSanPhamThuocTinh();">Lưu lại</button>
													</div>
												</div>
											</div> 
										</div>
										
									</div>
									
									<div class="tab-pane" id="tab_chitiet2">
										<div class="form-group">
											<textarea name="txtChiTiet2" id="txtChiTiet2" class="form-control" ><?php echo set_value('txtChiTiet2');?></textarea>
											<script>CKEDITOR.replace('txtChiTiet2');</script>
										</div>
									</div>
									<div class="tab-pane" id="tab_chitiet3">
										<div class="form-group">
											<textarea name="txtChiTiet3" id="txtChiTiet3" class="form-control" ><?php echo set_value('txtChiTiet3');?></textarea>
											<script>CKEDITOR.replace('txtChiTiet3');</script>
										</div>
									</div>
								</div>
							</div>
						</div>
						
                    </div>
					<div class="col-md-3">
						<div class="form-group">
                            <label>Thuộc danh mục:</label>
                            <select id="cboChuyenMuc" name="cboChuyenMuc" class="form-control select2" style="width:100%">
                                <option value="0"></option>
								<?php 
								$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","danh-muc","","");
								foreach ($parent as $p) 
								{
									echo "<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
									$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"danh-muc","","");
									foreach ($child as $c) 
									{
										echo "<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
									}
								}
								?>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Giá thị trường:</label>
                            <input type="text" id="txtGiaThiTruong" name="txtGiaThiTruong" value="<?php echo set_value('txtGiaThiTruong');?>" onkeyup="FormatNumber(this); TinhGiaBan(this.value);" onfocus="this.setSelectionRange(0,this.value.length)"  class="form-control f-bold" /> 
                        </div>
						<div class="form-group">
                            <label>Giá bán:</label>
                            <input type="text" id="txtGiaBan" name="txtGiaBan" value="<?php echo set_value('txtGiaBan');?>" onkeyup="FormatNumber(this);" onfocus="this.setSelectionRange(0,this.value.length)"  class="form-control f-bold" /> 
                        </div>
						<div class="form-group">
							<label>Loại sản phẩm:</label>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkNoiBat" name="chkNoiBat" type="checkbox" <?php if(set_value('chkNoiBat') == 1) echo "checked";?> value="1">Nổi bật										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkMoi" name="chkMoi" type="checkbox" <?php if(set_value('chkMoi') == 1) echo "checked";?> value="1">Mới										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkKhuyenMai" name="chkKhuyenMai" type="checkbox" <?php if(set_value('chkKhuyenMai') == 1) echo "checked";?> value="1">Khuyến mãi										
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">										
										<input id="chkBanChay" name="chkBanChay" type="checkbox" <?php if(set_value('chkBanChay') == 1) echo "checked";?> value="1">Bán chạy										
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
                        	<label>Hình ảnh chi tiết:</label>
                            <div id="fileuploader">Upload</div>
                        	<div id="image_list">
                            	<?php
                            	$items = $this->sanpham_model->lay_danh_sach_san_pham_hinh($id_news);
                                foreach($items as $item)
                                {
                                ?>
                                <div class="image_item">
                                    
                                    <a class="image_item_delete"></a>
									<img class="thumbnail" src="/uploads/sanpham/<?php echo $item["bvh_url"];?>">                   
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
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Thêm]
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/sanpham" role="button">
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
	url:"<?php echo base_url(); ?>admin/ajax/upload_san_pham_hinh/<?php echo $id_news; ?>",
	fileName:"myfile",
	dragDrop: true,
	showDelete: true,
	showDownload:false,
	showStatusAfterSuccess:false,
	dataType: "json",
	onSuccess:function(res){
		var url = "<?php echo base_url(); ?>admin/ajax/lay_danh_sach_san_pham_hinh/<?php echo $id_news; ?>";
		loadDuLieu('image_list',url);
	}
});
function themSanPhamThuocTinh()
{	
	var sp = $("#txtID").val();
	var ten = $("#txtTenThuocTinh").val();
	var giatri = $("#txtGiaTriThuocTinh").val();
	//alert(giatri);
	if (ten == ""){
			alert("Bạn chưa nhập tên thuộc tính!");
			ten.focus();
			return false;
		}
	if (giatri == ""){
		alert("Bạn chưa nhập giá trị thuộc tính!");
		giatri.focus();
		return false;
	}


	$.ajax({
		url: '<?php echo base_url(); ?>admin/ajax/them_san_pham_thuoc_tinh',
		type: 'POST',
		data: {
			sp: sp,
			ten: ten,
			giatri: giatri
		}, success: function (result) {
			var url = "<?php echo base_url(); ?>admin/ajax/lay_danh_sach_san_pham_thuoc_tinh/<?php echo $id_news; ?>";
			loadDuLieu('sanphamthuoctinh',url);
			$("#txtTenThuocTinh").val('');
			$("#txtGiaTriThuocTinh").val('');
			$("#txtTenThuocTinh").focus();
		},
		error : function(result) {
			alert('Xảy ra lỗi!');
		}
	});

	
}
function js_lay_ds_danh_muc()
{
	var nn = $("#cboNgonNgu").val();
    var url = "/admin/ajax/ajax_lay_ds_danh_muc/"+nn;
	loadDuLieu('cboChuyenMuc',url);
}
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