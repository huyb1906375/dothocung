<?php

$hoten = "Họ tên";
$dienthoai = "Điện thoại";
$nguoilon = "Số người lớn";
$treem = "Số trẻ em";
$noidung = "Nội dung";
$ngaydi = "Ngày đi";
$dongy = "Đồng ý";
$lg = "";
if($lg == "en")
{
	$hoten = "Full name";
	$dienthoai = "Phone number";
	$nguoilon = "Number of Adult";
	$treem = "Number of child";
	$noidung = "Content";
	$ngaydi = "Departure time";
	$dongy = "Book now";
}
?>
<div id="comments" class="comments-area">
			
	<form name="frm" action="/themes/camera/dathang-process.php" method="post" class="comment-form">
		<div class="section-content relative">			
			<div class="row row-small">
				<div class="col medium-12 small-12 large-12" style=" padding: 0px;">
					<div class="col-inner">
						<p class="comment-notes" style="text-align:center; font-size: 22px; font-weight: bold;background: #FFC92F; color: #fff;">BOOKING TOUR</p>
						<!--
						<p class="comment-notes" style="text-align:center;">
							Please leave a message to us, we will contact you as soon as possible.
						</p>
						-->
					</div>
				</div>
				<div class="col medium-12 small-12 large-12">
					<div class="col-inner">	
						<table width="100%" cellpadding="5">
							<tr>
								<td style="width: 100px;"><label for="author"><?php echo $hoten;?> <span class="required">(*):</span></label> </td>
								<td>
									<input id="txtTen" name="txtTen" type="text" size="30" maxlength="245" required="required">
								</td>
							</tr>
							<tr>
								<td><label for="phone"><?php echo $dienthoai;?> <span class="required">(*):</span></label> </td>
								<td>
									<input id="txtDienThoai" name="txtDienThoai" type="text" size="30" maxlength="245" required="required">
								</td>
							</tr>
							
							<tr>
								<td><label for="date"><?php echo $ngaydi;?> <span class="required">(*):</span></label> </td>
								<td>
									<input id="txtNgayDi" name="txtNgayDi" type="date" class="form-control"  style="width: 100%" value="<?php echo date("m/d/Y");?>">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="table-responsive table-booking" cellpadding="5" cellspacing="5">
										<tr>
											<td class="title">THÔNG TIN TOUR</td>
											<td class="title" width="100">SỐ NGƯỜI</td>
											<td class="title" width="100">
												THÀNH TIỀN
											</td>
											
										</tr>
										<tr>
											<td>
												
											</td>
											<td class="text-center">
												<div class="d-inline-block thaydoi-soluong">
												<input type="button" id="btnGiam" name="btnGiam" value="-"  />
												<input type="text" id="txtSoLuong" name="txtSoLuong" class="txtSoLuong buy-quantity" value="1" readonly="true"/>
												<input type="button" id="btnTang" name="btnTang" value="+" onclick="js_tinh_thanh_tien()"/>
												</div>
												<script type="text/javascript">

												function js_tinh_thanh_tien() 
												{
													
													alert("aaaa");
													//var dongia = $('#txtDonGia').val().replace(/\,/gi, "");
													//var soluong = $('#txtSoLuong').val().replace(/\,/gi, "");
													//var thanhtien = soluong * dongia;
													//$('#txtThanhTien').val(formatCurrency(thanhtien));
												}
												</script>
											</td>
											<td class="text-center">
												
											</td>
										</tr>
									</table>
								</td>
							</tr>
							
						</table>
						<p class="text-center">
							<input name="btnDongY" type="submit" id="btnDongY" value="<?php echo $dongy;?>" class="btnDongY" style="background: #1BA0E2;
}"> 
						</p>
					</div>
				</div>
			   
				
			</div>
		</div>
		<script>
		  //click thay doi so luong mua 
			$('.buy-quantity').on("click",function(t){
				$(".buy-quantity").select();
			});
			$('.quantity-change').on("click",function(t){

				var quantity = parseInt(this.getAttribute("data-value"));
				var $row        = $(this).closest(".thaydoi-soluong");
				var current_quantity = parseInt($row.find(".buy-quantity").val());

				if(current_quantity < 0) {
				  $row.find(".buy-quantity").val(0);
				  return ;
				}
				if(current_quantity + quantity >= 0)
					$row.find(".buy-quantity").val(current_quantity + quantity);
				else $row.find(".buy-quantity").val(0);
				//console.log(current_quantity);
			});
		</script>
			
				
	</form>

	
</div><!-- #comments -->

