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