<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />

<form name="frm" action="<?php echo base_url() ?>admin/cauhinhsite" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	CẤU HÌNH SITE
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/cauhinhsite">Cấu hình site</a></li>
    
  </ol>
</section>
<section class="content">
    <div class="row">
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
			<div class="box box-primary">
				<div class="box-body">
					<b>Đây là cấu hình chung cho toàn hệ thống</b>
				</div>
                <div class="box-body">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">THÔNG TIN CHUNG</a></li>
							<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">HÌNH ẢNH</a></li>
							<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">THÔNG TIN LIÊN HỆ</a></li>
							<li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">MẠNG XÃ HỘI</a></li>
							<li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">CẤU TRÚC TRANG CHỦ</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								<div class="form-group">
									<label>Tên miền:</label>
									<input type="text" class="form-control" id="txtTenMien" name="txtTenMien" value="<?php echo $row['chs_ten_mien'] ?>" style="width:100%">
									<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
									
								</div>						
								<div class="form-group">
									<label>Tiêu đề:</label>
									<input type="text" class="form-control" id="txtTieuDe" name="txtTieuDe" value="<?php echo $row['chs_tieu_de'] ?>" style="width:100%">
									<div class="error" id="password_error"><?php echo form_error('txtTieuDe')?></div>
								</div>
								<div class="form-group">
									<label>Từ khóa:</label>
									<textarea name="txtTuKhoa" id="txtTuKhoa" class="form-control" ><?php echo $row['chs_tu_khoa'] ?></textarea>
								</div>
								<div class="form-group">
									<label>Mô tả:</label>
									<textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo $row['chs_mo_ta'] ?></textarea>
								</div>
								<div class="form-group">
									<label>Biên tập:</label>
									<input type="text" class="form-control" id="txtBienTap" name="txtBienTap" value="<?php echo $row['chs_bien_tap'] ?>" style="width:100%">
								</div>
								<div class="form-group">
									<label>Kỹ thuật:</label>
									<input type="text" class="form-control" id="txtKyThuat" name="txtKyThuat" value="<?php echo $row['chs_ky_thuat'] ?>" style="width:100%">
								</div>
								<div class="form-group">
									<label>Bản quyền:</label>
									<input type="text" class="form-control" id="txtBanQuyen" name="txtBanQuyen" value="<?php echo $row['chs_ban_quyen'] ?>" style="width:100%">
								</div>
								<div class="form-group">
									<label>Giới thiệu chung:</label>
									<textarea name="txtGioiThieu" id="txtGioiThieu" class="form-control" ><?php echo $row['chs_gioi_thieu'] ?></textarea>
									<script>CKEDITOR.replace('txtGioiThieu');</script>
								</div>
								
								
								
							</div>
							<div class="tab-pane" id="tab_2">
								<div class="form-group">
									<label>Logo:</label><br/>
									<?php
									$logo = "upload-image.png";
									if($row['chs_logo'] != "")
										$logo = $row['chs_logo'];
									?>
									<img src="uploads/<?php echo $logo;?>" height="50"/> 
									<input name="fileLogo" id="fileLogo" class="inputimage" accept="image/*" type="file"> 
								</div>
								<br/>
								<div class="form-group">
									<label>Mobile logo:</label><br/>
									<?php
									$logo_mobile = "upload-image.png";
									if($row['chs_logo_mobile'] != "")
										$logo_mobile = $row['chs_logo_mobile'];
									?>
									<img src="uploads/<?php echo $logo_mobile;?>" height="50"/>
									<input name="fileMobileLogo" id="fileMobileLogo" class="inputimage" accept="image/*" type="file"> 
								</div>
								<br/>
								<div class="form-group">
									<label>Favicon:</label><br/>
									<?php
									$favicon = "upload-image.png";
									if($row['chs_favicon'] != "")
										$favicon = $row['chs_favicon'];
									?>
									<img src="uploads/<?php echo $favicon;?>" height="50"/>
									<input name="fileFavicon" id="fileFavicon" class="inputimage" accept="image/*" type="file"> 
								</div>
								<br/>
								<div class="form-group">
									<label>Banner:</label><br/>
									<?php
									$banner = "upload-image.png";
									if($row['chs_banner'] != "")
										$banner = $row['chs_banner'];
									?>
									<img src="uploads/<?php echo $banner;?>" height="50"/>
									<input name="fileBanner" id="fileBanner" class="inputimage" accept="image/*" type="file"> 
								</div>
								<div class="form-group">
									<label>Hình nền:</label><br/>
									<?php
									$hinhnen = "upload-image.png";
									if($row['chs_hinh_nen'] != "")
										$hinhnen = $row['chs_hinh_nen'];
									?>
									<img src="uploads/<?php echo $hinhnen;?>" height="50"/>
									<input name="fileHinhNen" id="fileHinhNen" class="inputimage" accept="image/*" type="file"> 
								</div>
							</div>
							<div class="tab-pane" id="tab_3">
								<div class="form-group">
									<label>Tên đơn vị:</label>
									<input type="text" class="form-control" id="txtDonVi" name="txtDonVi" value="<?php echo $row['chs_don_vi'] ?>" style="width:100%">	
								</div>						
								<div class="form-group">
									<label>Địa chỉ:</label>
									<input type="text" class="form-control" id="txtDiaChi" name="txtDiaChi" value="<?php echo $row['chs_dia_chi'] ?>" style="width:100%">
									
								</div>
								<div class="form-group">
									<label>Điện thoại:</label>
									<input type="text" class="form-control" id="txtDienThoai" name="txtDienThoai" value="<?php echo $row['chs_dien_thoai'] ?>" style="width:100%">
									
								</div>
								<div class="form-group">
									<label>Email:</label>
									<input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $row['chs_email'] ?>" style="width:100%">
									
								</div>
								
								<div class="form-group">
									<label>Google maps:</label>
									<textarea name="txtGoogleMaps" id="txtGoogleMaps" class="form-control" ><?php echo $row['chs_google_maps'] ?></textarea>
								</div>
								<div class="form-group">
									<label>Thông tin khác:</label>
									<textarea name="txtThongTinKhac" id="txtThongTinKhac" class="form-control" ><?php echo $row['chs_thong_tin_khac'] ?></textarea>
									<script>CKEDITOR.replace('txtThongTinKhac');</script>
								</div>
							</div>
							<div class="tab-pane" id="tab_4">
								<div class="form-group">
									<label>Facebook:</label>
									<input type="text" class="form-control" id="txtFacebook" name="txtFacebook" value="<?php echo $row['chs_facebook'] ?>" style="width:100%">	
								</div>						
								<div class="form-group">
									<label>Zalo:</label>
									<input type="text" class="form-control" id="txtZalo" name="txtZalo" value="<?php echo $row['chs_zalo'] ?>" style="width:100%">
									
								</div>
								<div class="form-group">
									<label>Sky:</label>
									<input type="text" class="form-control" id="txtSky" name="txtSky" value="<?php echo $row['chs_sky'] ?>" style="width:100%">									
								</div>
								<div class="form-group">
									<label>Youtube:</label>
									<textarea name="txtYoutube" id="txtYoutube" class="form-control" ><?php echo $row['chs_youtube'] ?></textarea>
									
								</div>
								<div class="form-group">
									<label>Twitter:</label>
									<input type="text" class="form-control" id="txtTwitter" name="txtTwitter" value="<?php echo $row['chs_twitter'] ?>" style="width:100%">
									
								</div>
								<div class="form-group">
									<label>Instagram:</label>
									<input type="text" class="form-control" id="txtInstagram" name="txtInstagram" value="<?php echo $row['chs_instagram'] ?>" style="width:100%">
									
								</div>
								<div class="form-group">
									<label>LinkedIn:</label>
									<input type="text" class="form-control" id="txtLinkedIn" name="txtLinkedIn" value="<?php echo $row['chs_linkedin'] ?>" style="width:100%">
									
								</div>
								
							</div>
							<div class="tab-pane" id="tab_5">
								<div class="row">
									<div class="form-group col-md-5">
										<!--<label>Vị trí:</label>-->
										<select id="cboViTri" name="cboViTri" class="form-control" style="width:100%">
											<option value="">Chọn vị trí</option>
											<option value="Main">Main</option>
											<option value="Top">Top</option>
											<option value="Bottom">Bottom</option>
											<option value="Left">Left</option>
											<option value="Center">Center</option>
											<option value="Right">Right</option>
											<option value="Option">Option</option>
											<option value="Option1">Option1</option>
											<option value="Option2">Option2</option>
											<option value="Option3">Option3</option>
										</select>
									</div>
									<div class="form-group col-md-5">
										<!--<label>Chuyên mục:</label>-->
										<select id="cboChuyenMuc" name="cboChuyenMuc" class="form-control" style="width:100%">
											<option value="">chọn chuyên mục</option>
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
									<div class="form-group col-md-2">
										<div class="input-group">
											<button type="button" class="btn btn-primary" onclick="themCauTruc();">Lưu lại</button>
										</div>
									</div>
									
								</div>
								<div id="cautruc" class="box-body table-responsive no-padding">
									<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th>Tên</th>
												<th class="text-center" style="width:100px">Vị trí</th>
												<th class="text-center" style="width:50px">Xuống</th>
												<th class="text-center" style="width:50px">Xóa</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$ct_list = $this->cautruc_model->lay_danh_sach_cau_truc();
											foreach ($ct_list as $ct)
											{	
											?>
											<tr>			   					               
												<td><?php echo $ct["cm_ten"];?></td>
												<td><?php echo $ct["ct_vi_tri"];?></td>
												<td class="text-center">                
													<a class="btn btn-info btn-xs" onclick="loadDuLieu('cautruc','<?php echo base_url(); ?>admin/ajax/ajax_update_thu_tu_cau_truc/<?php echo $ct["ct_id"];?>')"  role="button"> <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
												</td>
												<td class="text-center">                
													<a class="btn btn-danger btn-xs" onclick="loadDuLieu('cautruc','<?php echo base_url(); ?>admin/ajax/ajax_xoa_cau_truc/<?php echo $ct["ct_id"];?>')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
												</td>
											</tr>												
											<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="box-footer text-center">
					<button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
						<span class="glyphicon glyphicon-floppy-save"></span> Cập nhật
					</button>
				</div>
			</div>
		</div>
		
        
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script type="text/javascript">
function themCauTruc()
{	
	var cm_id = $("#cboChuyenMuc").val();
	var vitri = $("#cboViTri").val();
	if (vitri == ""){
		alert("Bạn chưa chọn vị trí!");
		return false;
	}
	if (cm_id == ""){
		alert("Bạn chưa chọn chuyên mục!");
		return false;
	}
	$.ajax({
		url: '<?php echo base_url(); ?>admin/ajax/ajax_them_cau_truc',
		type: 'POST',
		data: {
			'cm': cm_id,
			'vt': vitri
		},
		success: function (result) {
			//var s = result.split("|");
			//alert(s[0]);
			var url = "<?php echo base_url(); ?>admin/ajax/lay_danh_sach_cau_truc";
			loadDuLieu('cautruc',url);
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});

	
}
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();
</script>
</form>