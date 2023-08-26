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
			<li class="active"><a href="<?php echo base_url();?>don-hang/<?php echo $donhang["dh_id"];?>.html">Thông tin đơn hàng <b><?php echo $donhang["dh_id"];?></b></a></li>
		</ol>
	</div>
</div>
<div class="checkout-area pb-30 pt-30 pb-sm-30">
	<div class="container">
		
		<div class="row">
			
			<div class="col-lg-6 col-md-6">
				<div class="checkbox-form mb-sm-40">
					<h3><a>Thông tin nhận hàng</a></h3>
					<div class="row">
						
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Họ và tên: <span class="required">*</span></label>
								<input type="text" class="form-control" id="txtHoTen" name="txtHoTen" value="<?php echo $donhang["dh_ten"];?>" disabled />
								
							</div>
						</div>
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Địa chỉ: <span class="required">*</span></label>
								<input type="text" class="form-control" id="txtDiaChi" name="txtDiaChi" value="<?php echo $donhang["dh_dia_chi"];?>" disabled />
								
							</div>
						</div>
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Điện thoại: <span class="required">*</span></label>
								<input type="phone" class="form-control" id="txtDienThoai" name="txtDienThoai" value="<?php echo $donhang["dh_dien_thoai"];?>" disabled />
								
							</div>
						</div>
						<div class="col-md-12">
							<div class="checkout-form-list mb-30">
								<label>Email: </label>
								<input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $donhang["dh_email"];?>" disabled />
								
							</div>
						</div>
						<div class="col-md-12">
							<div class="country-select clearfix mb-30">
								<label>Phương thức thanh toán: <span class="required">*</span></label>
								<select name="cboPhuongThuc" class="wide"  disabled >
									<option <?php if($donhang["dh_phuong_thuc_thanh_toan"] == "thanhtoansau") echo "selected";?> value="thanhtoansau">Thanh toán khi nhận hàng</option>
									<option <?php if($donhang["dh_phuong_thuc_thanh_toan"] == "thanhtoantruoc") echo "selected";?> value="thanhtoantruoc">Thanh toán trước bằng chuyển khoản</option>
									
							   </select>
							</div>
						</div>
					</div>
					<div class="different-address">
						
						<div class="order-notes">
							<div class="checkout-form-list">
								<label>Ghi chú:</label>
								<textarea id="txtGhiChu" name="txtGhiChu" cols="30" rows="10" value="<?php echo $donhang["dh_ghi_chu"];?>"  disabled></textarea>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="your-order">
					<h3><a>Hóa đơn của bạn</a></h3>
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
								foreach($donhangchitiet as $giohang)
								{
									
									$total = $total + $giohang["dhct_thanh_tien"];
								?>
								<tr class="cart_item">
									<td class="product-name text-left">
										<a href="<?php echo base_url();?>san-pham/<?php echo $giohang["sp_id"];?>/<?php echo $giohang["sp_slug"];?>.html"><?php echo $giohang["sp_ten"];?></a> <span class="product-quantity"> × <?php echo $giohang["dhct_so_luong"];?></span>
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
					<div class="col-md-12" style="padding-left: 0px; padding-right: 0px; font-weight: bold; margin-top: 30px;">
						<a class="form-control btnHoanThanh text-center" href="<?php echo base_url();?>in-don-hang/<?php echo $donhang["dh_id"];?>.html" >In đơn hàng</a>
						<!--<a class="form-control btnHoanThanh text-center" href="javascript:NewWindow('<?php echo base_url();?>in-don-hang/<?php echo $donhang["dh_id"];?>.html','','840','500','yes');">In đơn hàng</a>-->
					</div>
					
					<div class="box-promise mt-30">
						<div class="promise">
							
							<div class="pd_policy">
								
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
</div>
