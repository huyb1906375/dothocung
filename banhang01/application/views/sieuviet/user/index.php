<div class="main-page-banner home-3">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<?php $this->load->view('sieuviet/menusanpham'); ?>
			</div>
		</div>
	</div>      
</div>
<div class="breadcrumb-area mt-30">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>">Trang chủ</a></li>
			<li class="active"><a href="<?php echo base_url();?>thong-tin-ca-nhan.html">Thông tin cá nhân</a></li>
		</ol>
	</div>
</div>
<div class="register-account ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mb-sm-30">
				<form name="frmDangKy" class="form-register" action="<?php echo base_url();?>thong-tin.html" method="POST" onsubmit="return KiemTraThongTin();">
					<?php  if($this->session->flashdata('error')){?>
						<div class="form-group d-md-flex align-items-md-center">										
							<div class="col-md-12 red">	
								<b><span class="require">*</span><?php echo $this->session->flashdata('error'); ?></b>								
							</div>										
						</div>
						<?php }?>
					<fieldset>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-3" for="f-name"><span class="require">*</span>Họ và tên:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="txtHoTen" name="txtHoTen" value="<?php echo $info["dt_ten"];?>">
								<input type="hidden" class="form-control" id="txtID" name="txtID" value="<?php echo $info["dt_id"];?>">
								<div class="error"><?php echo form_error('txtHoTen')?></div>	
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-3" for="l-name"><span class="require">*</span>Địa chỉ:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="txtDiaChi" name="txtDiaChi" value="<?php echo $info["dt_dia_chi"];?>">
								<div class="error"><?php echo form_error('txtDiaChi')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-3" for="number"><span class="require">*</span>Điện thoại:</label>
							<div class="col-md-9">
								<input type="phone" class="form-control" id="txtDienThoai" name="txtDienThoai" value="<?php echo $info["dt_dien_thoai"];?>">
								<div class="error"><?php echo form_error('txtDienThoai')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-3" for="email">Email:</label>
							<div class="col-md-9">
								<input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $info["dt_email"];?>">
								<div class="error"><?php echo form_error('txtEmail')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-3" for="note">Ghi chú:</label>
							<div class="col-md-9">
								<textarea id="txtGhiChu" name="txtGhiChu" rows="3"  class="form-control"><?php echo $info["dt_ghi_chu"];?></textarea>
								
								<div class="error"><?php echo form_error('txtGhiChu')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-3" for="email">&nbsp;</label>
							<div class="col-md-9">
								<input type="submit" id="btnCapNhat" name="btnCapNhat" value="Cập nhật" class="return-customer-btn">
							</div>
						</div>
					</fieldset>
					
					
				</form>
			</div>
			<div class="col-md-4">
				<?php $this->load->view('sieuviet/right-camket'); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{   
    $(".captcha-image").load("<?php echo base_url('captcha/created'); ?>");    
    $("a.refresh").click(function() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('captcha/created'); ?>",
            success: function(res) {
				if (res)
                {
                    jQuery("div.captcha-image").html(res);
                }
            }
        });
    });            
});	
document.frmDangKy.txtHoTen.focus();
function KiemTraThongTin()
{
	var ten = $('#txtHoTen').val();
	
	var diachi = $('#txtDiaChi').val();
	var dienthoai = $('#txtDienThoai').val();
	var email = $('#txtEmail').val();
	
	if(ten.length == 0)
	{
		alert("Họ tên không được để trống!");
		$('#txtTen').focus();
		return false;
	}
	if(diachi.length == 0)
	{
		alert("Địa chỉ không được để trống!");
		$('#txtDiaChi').focus();
		return false;
	}
	if(dienthoai.length == 0)
	{
		alert("Số điện thoại không được để trống!");
		$('#txtDienThoai').focus();
		return false;
	}
	/*
	if(email.length == 0)
	{
		alert("Email không được để trống!");
		$('#txtEmail').focus();
		return false;
	}
	*/
	
	return true;
}

</script>