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
			<li class="active"><a href="#">Đặt hàng</a></li>
		</ol>
	</div>
</div>
<div class="log-in ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="well mb-sm-30">
					<div class="new-customer">
						<h3 class="custom-title mb-10">Đặt hàng thành công!</h3>
						<p>Đơn hàng <b><?php echo $this->session->userdata("dh_id_comit");?></b> đã được gửi thành công!</p>
						<a class="button" href="<?php echo base_url();?>in-don-hang/<?php echo $this->session->userdata("dh_id_comit");?>.html">In đơn hàng</a>
						<a class="button" href="<?php echo base_url();?>don-hang.html">Quản lý đơn hàng</a>
					</div>
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="box-promise">
					<div class="promise">
						<span class="title mb-15"> Yên tâm mua hàng tại <b><?php echo chs_don_vi;?></b> </span>
						<div class="pd_policy">
							<div class="serv serv-3">
								<p>Sản phẩm 100% chính hãng</p>
							</div>
							<div class="serv serv-4">
								<p>Giá luôn tốt nhất</p>
							</div>
							<div class="serv serv-5">
								<p>Hậu mãi chu đáo</p>
							</div>
							<div class="serv serv-1">
								<p>- Giao hàng&nbsp;&nbsp;C.O.D bưu điện , Viettel post : Giao tận nhà trong 1-5&nbsp;ngày làm việc ( Yêu cầu đặt cọc )&nbsp;<br>
- Giao hàng xe vận tải, xe khách ( Yêu cầu chuyển khoản trước 100% đơn hàng )&nbsp;</p>
							</div>
							<div class="serv serv-2">
								<p>- Được đổi trả nếu hàng không đúng thực tế đặt hàng&nbsp;</p>
								<p>- Đền tiền gấp đôi nếu phát hiện hàng giả, hàng nhái , hàng không chính hãng&nbsp;</p>
								<p>- Giá lẻ rẻ như giá buôn&nbsp;</p>                                       
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">	
/*
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
*/
</script>