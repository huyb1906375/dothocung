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
			<li class="active"><a href="<?php echo base_url();?>doi-mat-khau.html">Đổi mật khẩu</a></li>
		</ol>
	</div>
	<!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- LogIn Page Start -->
<div class="log-in ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<!-- New Customer Start -->
			<div class="col-md-6">
				<div class="well mb-sm-30">
					<div class="new-customer">
						<h3 class="custom-title mb-10">Bạn là khách hàng mới?</h3>
						<!--<p class="mtb-10"><strong>Đăng ký</strong></p>-->
						<p>Bằng cách tạo tài khoản, bạn sẽ có thể mua sắm nhanh hơn, cập nhật trạng thái của đơn hàng và theo dõi các đơn hàng bạn đã thực hiện trước đó.</p>
						<a class="customer-btn" href="<?php echo base_url();?>dang-ky.html">Tiếp tục</a>
					</div>
				</div>
			</div>
			<!-- New Customer End -->
			<!-- Returning Customer Start -->
			<div class="col-md-6">
				<div class="well">
					<form name="frmDangNhap" class="form-register" action="<?php echo base_url();?>dang-nhap.html" method="POST" onsubmit="return KiemTraDangNhap();">
					<div class="return-customer">
						<h3 class="mb-10 custom-title">Đổi mật khẩu</h3>
						<p class="mb-10"><strong>Bạn đã có tài khoản đăng nhập? Vui lòng điền thông tin để đăng nhập!</strong></p>
						<form action="#">
							<div class="form-group">
								<label><b>Tên đăng nhập</b></label>
								<input type="text" name="txtTenDangNhap" placeholder="Tên đăng nhập" id="txtTenDangNhap" class="form-control">
							</div>
							<div class="form-group">
								<label><b>Mật khẩu cũ</b></label>
								<input type="password" name="txtMatKhau" placeholder="Mật khẩu cũ" id="txtMatKhau" class="form-control">
							</div>
							<div class="form-group">
								<label><b>Mật khẩu mới</b></label>
								<input type="password" name="txtMatKhauMoi" placeholder="Mật khẩu" id="txtMatKhauMoi" class="form-control">
							</div>
							<div class="form-group">
								<label><b>Xác nhận mật khẩu mới</b></label>
								<input type="password" name="txtMatKhauMoi2" placeholder="Mật khẩu" id="txtMatKhauMoi2" class="form-control">
							</div>
							<div  class="form-group">
								<div class="alert alert-danger message-login">
									Tên đăng nhập hoặc mật khẩu không chính xác!
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								</div>
								<!--
								<?php  if(isset($error)):?>
								
									<div class="alert alert-danger">
										<?php echo $error; ?>
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									</div>
								
								<?php  endif;?>
								-->
							</div>
							<p class="lost-password"><a href="<?php echo base_url();?>quen-mat-khau.html"><b>Bạn đã quên mật khẩu?</b></a></p>
							<input type="button" name="btnDangNhap" value="Đồng ý" class="return-customer-btn" onclick="DangNhap()">
						</form>
					</div>
					</form>
				</div>
			</div>
			<!-- Returning Customer End -->
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<!-- LogIn Page End -->

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