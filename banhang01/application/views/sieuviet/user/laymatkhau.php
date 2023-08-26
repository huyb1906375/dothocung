<!-- Categorie Menu & Slider Area Start Here -->
<div class="main-page-banner home-3">
	<div class="container">
		<div class="row">
			<!-- Vertical Menu Start Here -->
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<?php $this->load->view('sieuviet/menusanpham'); ?>
			</div>
			<!-- Vertical Menu End Here -->
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->           
</div>
<!-- Categorie Menu & Slider Area End Here -->
<!-- Categorie Menu & Slider Area End Here -->
<div class="breadcrumb-area mt-30">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>">Trang chủ</a></li>
			<li class="active"><a href="<?php echo base_url();?>quen-mat-khau.html">Quên mật khẩu</a></li>
		</ol>
	</div>
	<!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Register Account Start -->
<div class="Lost-pass ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<form name="frmDangKy" class="form-register" action="/quen-mat-khau.html" method="POST" onsubmit="return KiemTraDangKy();">
					
					<fieldset>
						
						<legend><b>Thông tin mật khẩu sẽ được gửi vào email bên dưới.</b></legend>
						
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4" for="email">Nhập email của bạn vào đây:</label>
							<div class="col-md-8">
								<input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo set_value('txtEmail');?>">
								<div class="error"><?php echo form_error('txtEmail')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4">&nbsp;</label>
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
	<!-- Container End -->
</div>
<!-- Register Account End -->

<script type="text/javascript">
//setTimeout(function() { $(".alert").fadeOut(1500); }, 3000)	
document.frmDangNhap.txtTenDangNhap.focus();
function KiemTraDangNhap()
{
	var tendangnhap = $('#txtTenDangNhap').val();
	var matkhau = $('#txtMatKhau').val();
	if(tendangnhap.length == 0 || matkhau.length == 0)
	{
		alert("Tên đăng nhập hoặc mật khẩu không được để trống!");
		return false;
	}
	return true;
}

function DangNhap()
{
	var tendangnhap = $('#txtTenDangNhap').val();
	var matkhau = $('#txtMatKhau').val();
	if(tendangnhap.length == 0 || matkhau.length == 0)
	{
		alert("Tên đăng nhập hoặc mật khẩu không được để trống!");
		return false;
	}
	$.ajax({
		url: '/ajax/ajax_dang_nhap',
		type: 'POST',
		data: {
			'tendangnhap': tendangnhap,
			'matkhau': matkhau
		},
		success: function (result) {
			var s = result.split("|");			
			if(s == "1")
				gourl('<?php echo base_url();?>trang-chu.html');
			else 
			{
				$('.message-login').show();
				setTimeout(function() { $(".message-login").fadeOut(1500); }, 3000)
				$('#txtTenDangNhap').focus();
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
</script>