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
			<li class="active"><a href="<?php echo base_url();?>thanh-toan.html">Thanh toán</a></li>
		</ol>
	</div>
	<!-- Container End -->
</div>

<!-- checkout-area start -->
<div class="checkout-area pb-30 pt-30 pb-sm-30">
	<div class="container">
		<form name="frmCheckout" action="<?php echo base_url();?>thanh-toan.html" method="POST" onsubmit="return KiemTraDatHang();">
		<div class="row">
			
			<div class="col-lg-6 col-md-6">
				<div class="checkbox-form mb-sm-40">
					<h3><a>THÔNG TIN ĐẶT HÀNG</a></h3>
					<div class="row">
						
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Họ và tên: <span class="required">*</span></label>
								<input type="text" class="form-control" id="txtHoTen" name="txtHoTen" value="<?php echo $this->session->userdata("user_ten");?>"/>
								<div class="error"><?php echo form_error('txtHoTen')?></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Địa chỉ: <span class="required">*</span></label>
								<input type="text" class="form-control" id="txtDiaChi" name="txtDiaChi" value="<?php echo $this->session->userdata("user_diachi");?>">
								<div class="error"><?php echo form_error('txtDiaChi')?></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Điện thoại: <span class="required">*</span></label>
								<input type="phone" class="form-control" id="txtDienThoai" name="txtDienThoai" value="<?php echo $this->session->userdata("user_dienthoai");?>">
								<div class="error"><?php echo form_error('txtDienThoai')?></div>
							</div>
						</div>
						<div class="col-md-12" style="font-weight: bold; margin-bottom: 30px;">
							<input type="submit" name="btnHoanThanh" value="Hoàn thành đơn hàng"  class="form-control customer-btn"/>
						</div>
						<?php
						if(!$this->session->userdata("user_id"))
						{
						?>
						<div class="col-md-12">
							<div class="well mb-sm-30">
								<div class="new-customer">
									<h3 class="custom-title mb-10">Bạn có muốn tạo một tài khoản?</h3>
									<!--<p class="mtb-10"><strong>Đăng ký</strong></p>-->
									<p>Bằng cách tạo tài khoản, bạn sẽ có thể mua sắm nhanh hơn, cập nhật trạng thái của đơn hàng và theo dõi các đơn hàng bạn đã thực hiện trước đó.</p>
									<a class="customer-btn" href="<?php echo base_url();?>dang-ky.html">Tạo tài khoản</a>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						<!--
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Email: </label>
								<input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $this->session->userdata("user_email");?>">
								<div class="error"><?php echo form_error('txtEmail')?></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="country-select clearfix mb-30">
								<label>Phương thức thanh toán: <span class="required">*</span></label>
								<select name="cboPhuongThuc" class="wide">
									<option value="thanhtoansau">Thanh toán khi nhận hàng</option>
									<option value="thanhtoantruoc">Thanh toán trước bằng chuyển khoản</option>
									
							   </select>
							</div>
						</div>
						-->
					</div>
					<!--
					<div class="different-address">
						
						<div class="order-notes">
							<div class="checkout-form-list">
								<label>Ghi chú:</label>
								<textarea id="txtGhiChu" name="txtGhiChu" cols="30" rows="10"></textarea>
							</div>
						</div>
					</div>
					-->
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="your-order">
					<!--<h3><a>Hóa đơn của bạn</a></h3>-->
					<div class="your-order-table table-responsive">
						<table>
							<thead>
								<tr>
									<th class="product-name text-left"><b>HÀNG HÓA X SỐ LƯỢNG</b></th>
									<th class="product-total text-right"><b>THÀNH TIỀN</b></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$total = 0;
								foreach($list as $giohang)
								{
									
									$total = $total + $giohang["dhct_thanh_tien"];
								?>
								<tr class="cart_item">
									<td class="product-name text-left">
										<a href="<?php echo base_url();?>san-pham/<?php echo $giohang["sp_slug"];?>.html"><?php echo $giohang["sp_ten"];?></a> <span class="product-quantity"> × <?php echo $giohang["dhct_so_luong"];?></span>
									</td>
									<td class="product-total text-right">
										<span class="amount"><?php echo number_format($giohang["dhct_thanh_tien"]);?></span>
									</td>
								</tr>
								<?php
								}
								?>
								
							</tbody>
							<tfoot>
								
								<tr class="order-total">
									<th class="text-left">Tổng cộng:</th>
									<td class="text-right">
										<span class=" total amount"><?php echo number_format($total);?></span>
										<input type="hidden" name="txtTongCong" id="txtTongCong" value="<?php echo $total;?>"/>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					
					
					<div class="box-promise mt-30">
						<div class="promise">
							
							<div class="pd_policy">
								
								<div class="serv serv-1">
									<p>- Giao hàng thông qua các đơn vị chuyển phát : Giao tận nhà trong 1-5&nbsp;ngày làm việc ( Yêu cầu đặt cọc )&nbsp;<br>
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
		</form>
	</div>
</div>

<script type="text/javascript">
document.frmCheckout.txtHoTen.focus();
function KiemTraDatHang()
{
	var ten = $('#txtHoTen').val();
	
	var diachi = $('#txtDiaChi').val();
	var dienthoai = $('#txtDienThoai').val();
	var email = $('#txtEmail').val();
	var tongcong = $('#txtTongCong').val();
	if(ten.length == 0)
	{
		alert("Họ tên không được để trống!");
		$('#txtHoTen').focus();
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
	if(tongcong == 0)
	{
		alert("Không có hàng hóa nào trong giỏ hàng!");
		return false;
	}
	return true;
}
</script>