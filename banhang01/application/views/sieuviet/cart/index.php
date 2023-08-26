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
			<li class="active"><a href="<?php echo base_url();?>gio-hang.html">Giỏ hàng</a></li>
		</ol>
	</div>
</div>
<div class="cart-main-area ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div id="donhangchitiet" class="col-md-12 col-sm-12">
				<form name="frmGioHang" action="<?php echo base_url();?>gio-hang.html" method="post">
					<div class="table-content table-responsive mb-45">
						<table>
							<thead>
								<tr>
									<th class="product-remove"><b>Xóa</b></th>
									<th class="product-thumbnail"><b>Hình ảnh</b></th>
									<th class="product-name"><b>Tên hàng</b></th>
									<th class="product-price"><b>Đơn giá</b></th>
									<th class="product-quantity"><b>Số lượng</b></th>
									<th class="product-subtotal"><b>Thành tiền</b></th>
									
								</tr>
							</thead>
							<tbody>
								<?php
								$total = 0;
								foreach($list as $giohang)
								{
									$img = "default.png";
									if(strlen($giohang["sp_hinh"]) > 0)
										$img = $giohang["sp_hinh"];
									$total = $total + $giohang["dhct_thanh_tien"];
								?>
								<tr>
									<td class="product-remove"> <a href="javascript:XoaDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,<?php echo $giohang["dhct_id"];?>);"><i class="fa fa-times" aria-hidden="true"></i></a></td>
									<td class="product-thumbnail">
										<a href="#"><img src="<?php echo base_url();?>uploads/sanpham/<?php echo $img;?>" alt="cart-image" /></a>
									</td>
									<td class="product-name text-left text-bold">
										<a href="<?php echo base_url();?>san-pham/<?php echo $giohang["sp_slug"];?>.html"><?php echo $giohang["sp_ten"];?></a>
										<input type="hidden" name="txtID[]" value="<?php echo $giohang["dhct_id"];?>"/>
									</td>
									<td class="product-price"><span class="amount">
										<?php echo number_format($giohang["dhct_don_gia"]);?></span>
										<input type="hidden" name="txtDonGia[]" value="<?php echo $giohang["dhct_don_gia"];?>"/>
									</td>
									<td class="product-quantity">
										<input type="number" name="txtSoLuong[]" id="<?php echo $giohang["dhct_id"];?>" value="<?php echo $giohang["dhct_so_luong"];?>" onchange="UpdateDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,this.id, this.value,<?php echo $giohang["dhct_don_gia"];?>)" onmouseup="this.select()" />
									</td>
									<td class="product-subtotal"><?php echo number_format($giohang["dhct_thanh_tien"]);?></td>
									
								</tr>
								<?php
								}
								?>
								
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 mb-30">
							<div class="cart_totals float-md-right text-md-right">
								<table class="float-md-right">
									<tbody>
										<tr class="order-total">
											<th>Tổng cộng:</th>
											<td>
												<strong><span class="amount"><?php echo number_format($total);?></span></strong>
											</td>
										</tr>
									</tbody>
								</table>
								
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="buttons-cart" style="width: 100%">
								<input type="submit" name="btnCapNhatGioHang" value="Cập nhật giỏ hàng" />
								
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="buttons-cart" style="width: 100%">
								
								<a href="<?php echo base_url();?>trang-chu.html">Tiếp tục mua hàng</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="buttons-cart" style="width: 100%">
								<a href="<?php echo base_url();?>thanh-toan.html" class="mr-0">Tiến hành đặt hàng và thanh toán</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function()
{    
    $( ".captcha-image" ).load( "<?php echo base_url('captcha/created'); ?>" );    
    $("a.refresh").click(function() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('captcha/created'); ?>",
            success: function(res) {
            if (res)
                {
                    jQuery("div.image").html(res);
                }
            }
        });
    });            
});	
document.frmDangNhap.txtTenDangNhap0.focus();
function DangNhap()
{
	var tendangnhap = $('#txtTenDangNhap0').val();
	var matkhau = $('#txtMatKhau0').val();
	if(tendangnhap.length == 0 || matkhau.length == 0)
	{
		alert("Tên đăng nhập và mật khẩu không được để trống!");
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
				gourl('<?php echo base_url();?>thanh-toan.html');
			else 
			{
				alert("Tên đăng nhập hoặc mật khẩu không chính xác!");
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
function DangKy()
{
	var ten = $('#txtHoTen').val();	
	var diachi = $('#txtDiaChi').val();
	var dienthoai = $('#txtDienThoai').val();
	var email = $('#txtEmail').val();
	var tendangnhap = $('#txtTenDangNhap').val();
	var matkhau = $('#txtMatKhau').val();
	var matkhau2 = $('#txtMatKhau2').val();
	var captcha = $('#txtCaptcha').val();
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
	$.ajax({
		url: '/ajax/ajax_dang_ky',
		type: 'POST',
		data: {
			'ten': ten,
			'diachi': diachi,
			'dienthoai': dienthoai,
			'email': email,
			'tendangnhap': tendangnhap,
			'matkhau': matkhau,
			'captcha': captcha
		},
		success: function (result) {
			var s = result.split("|");			
			if(s[0] == "1")
				gourl('<?php echo base_url();?>thanh-toan.html');
			else 
			{
				alert(s[1]);
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
function UpdateDonHangChiTiet(dh_id, dhct_id, dhct_soluong, dhct_dongia)
{
	if(dhct_soluong <= 0)
	{
		XoaDonHangChiTiet(dh_id, dhct_id);
		return;
	}
	$.ajax({
		url: '/ajax/ajax_update_don_hang_chi_tiet',
		type: 'POST',
		data: {
			'dh_id': dh_id,
			'dhct_id': dhct_id,
			'dhct_soluong': dhct_soluong,
			'dhct_dongia': dhct_dongia
		},
		success: function (result) {
			var s = result.split("|");	
			if(s == "1") LoadDonHang(dh_id, dhct_id);
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
function LoadDonHang(dh_id, dhct_id)
{	
	var url = "<?php echo base_url(); ?>ajax/ajax_lay_danh_sach_don_hang_chi_tiet/"+dh_id;
	loadDuLieu('donhangchitiet',url);
	$('#'+dhct_id).focus();
}
function XoaDonHangChiTiet(dh_id, dhct_id)
{
	$.ajax({
		url: '/ajax/ajax_xoa_don_hang_chi_tiet',
		type: 'POST',
		data: {
			'dh_id': dh_id,
			'dhct_id': dhct_id
		},
		success: function (result) {
			var s = result.split("|");	
			if(s == "1") location.reload();//LoadDonHang(dh_id, dhct_id);
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
</script>