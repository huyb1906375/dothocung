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
			<li class="active"><a href="<?php echo base_url();?>dang-ky.html">Ðăng ký tài khoản</a></li>
		</ol>
	</div>
</div>
<div class="register-account ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="register-title">
					<h3 class="mb-10">ÐĂNG KÝ TÀI KHOẢN</h3>
					<p class="mb-10">Nếu bạn đã có tài khoản, xin vui lòng <a href="<?php echo base_url();?>dang-nhap.html"><b>nhấn vào đây</b></a> để đăng nhập!</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 mb-sm-30">
				<form name="frmDangKy" class="form-register" action="<?php echo base_url();?>dang-ky.html" method="POST" onsubmit="return KiemTraDangKy();">
					<?php  if($this->session->flashdata('error')){?>
						<div class="form-group d-md-flex align-items-md-center">										
							<div class="col-md-12 red">	
								<b><span class="require">*</span><?php echo $this->session->flashdata('error'); ?></b>								
							</div>										
						</div>
						<?php }?>
					<fieldset>
						
						<legend><b>Thông tin cá nhân:</b></legend>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="f-name"><span class="require">*</span>Họ và tên:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="txtHoTen" name="txtHoTen" placeholder="Họ và tên" value="<?php echo set_value('txtHoTen');?>">
								<div class="error"><?php echo form_error('txtHoTen')?></div>	
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="l-name"><span class="require">*</span>Địa chỉ:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="txtDiaChi" name="txtDiaChi" placeholder="Địa chỉ" value="<?php echo set_value('txtDiaChi');?>">
								<div class="error"><?php echo form_error('txtDiaChi')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="number"><span class="require">*</span>Điện thoại:</label>
							<div class="col-md-8">
								<input type="phone" class="form-control" id="txtDienThoai" name="txtDienThoai" placeholder="Điện thoại" value="<?php echo set_value('txtDienThoai');?>">
								<div class="error"><?php echo form_error('txtDienThoai')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="email">Email:</label>
							<div class="col-md-8">
								<input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" value="<?php echo set_value('txtEmail');?>">
								<div class="error"><?php echo form_error('txtEmail')?></div>
							</div>
						</div>
						
					</fieldset>
					<fieldset>
						<legend><b>Thông tin đăng nhập</b></legend>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="pwd"><span class="require">*</span>Tên đăng nhập:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="txtTenDangNhap" name="txtTenDangNhap" placeholder="Tên đăng nhập" value="<?php echo set_value('txtTenDangNhap');?>">
								<div class="error"><?php echo form_error('txtTenDangNhap')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="pwd"><span class="require">*</span>Mật khẩu:</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="txtMatKhau" name="txtMatKhau" placeholder="Mật khẩu"  value="<?php echo set_value('txtMatKhau');?>">
								<div class="error"><?php echo form_error('txtMatKhau')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="pwd-confirm"><span class="require">*</span>Xác nhận lại mật khẩu:</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="txtMatKhau2" name="txtMatKhau2" placeholder="Xác nhận lại mật khẩu" value="<?php echo set_value('txtMatKhau2');?>">
								<div class="error"><?php echo form_error('txtMatKhau2')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="captcha"><span class="require">*</span>Mã xác nhận:</label>
							<div class="col-md-8">
								
								<table>
									<tr>
										<td><div class="captcha-image"></div></td>
										<td>
											<input name="txtCaptcha" id="txtCaptcha"  name="txtCaptcha" type="text"  class="form-control captcha-input" placeholder="Nhập mã bên trái" value="<?php echo set_value('txtCaptcha');?>">
											<div class="error"><?php echo form_error('txtCaptcha')?></div>
										</td>
										<td><a class="refresh" href="javascript:void(0)" title="Lấy mã mới"><i class="icon-refresh"></i></a></td>
									</tr>
								</table>
									
									
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4">
								<span>Tôi đã đọc và đồng ý với <a href="<?php echo base_url();?>chinh-sach-bao-mat-thong-tin.html" class="agree" target="_blank"><b>chính sách bảo mật!</b></a></span>
							</label>
								<input type="checkbox" id="chkDongY" name="chkDongY" value="1"> &nbsp;
							<div class="col-md-8">
								<input type="submit" id="btnDongY" name="btnDongY" value="Đồng ý" class="return-customer-btn">
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
function KiemTraDangKy()
{
	var ten = $('#txtHoTen').val();
	
	var diachi = $('#txtDiaChi').val();
	var dienthoai = $('#txtDienThoai').val();
	var email = $('#txtEmail').val();
	var tendangnhap = $('#txtTenDangNhap').val();
	var matkhau = $('#txtMatKhau').val();
	var matkhau2 = $('#txtMatKhau2').val();
	var captcha = $('#txtCaptcha').val();
	//var dongy = $('#chkDongY').checked;
	//alert(document.frmDangNhap.chkDongY.checked);
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
	if(tendangnhap.length == 0)
	{
		alert("Tên đăng nhập không được để trống!");
		$('#txtTenDangNhap').focus();
		return false;
	}
	if(matkhau.length == 0)
	{
		alert("Mật khẩu không được để trống!");
		$('#txtMatKhau').focus();
		return false;
	}
	if(matkhau != matkhau2)
	{
		alert("Xác nhận lại mật khẩu chưa chính xác!");
		$('#txtMatKhau2').focus();
		return false;
	}
	if(document.frmDangKy.chkDongY.checked == false)
	{
		alert("Bạn chưa đồng ý với điều khoản của chúng tôi!");
		return false;
	}
	return true;
}

</script>