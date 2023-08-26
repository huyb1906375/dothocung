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
			<li class="active"><a href="<?php echo base_url();?>quen-mat-khau.html">ĐẶT LẠI MẬT KHẨU</a></li>
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
				<form name="frmDangKy" class="form-register" action="/dat-lai-mat-khau/<?php echo $chuoibaomat;?>" method="POST" onsubmit="return js_check_value();">
					
					<fieldset>
						
						
						
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4">Mật khẩu mới:</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="txtMatKhau" name="txtMatKhau" value="<?php echo set_value('txtMatKhau');?>">
								<div class="error"><?php echo form_error('txtEmail')?></div>
							</div>
						</div>
						<div class="form-group d-md-flex align-items-md-center">
							<label class="control-label col-md-4">Mật khẩu mới:</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="txtMatKhau2" name="txtMatKhau2" value="<?php echo set_value('txtMatKhau2');?>">
								<div class="error"><?php echo form_error('txtMatKhau2')?></div>
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

function js_check_value()
{
	var matkhau = $('#txtMatKhau').val();
	var matkhau2 = $('#txtMatKhau2').val();
	
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