<table class="table table-hover table-bordered table-responsive">
	<tr class="bg-light-blue"> 
		<th class="w10 text-center">#</th> 
		<th class="text-center">Tên hàng</th> 
		<th class="w80 text-center">Số lượng</th> 
		<th class="w120 text-center">Đơn giá</th> 
		<th class="w120 text-center">Thành tiền</th> 
		<th class="w50 text-center"><span class="glyphicon glyphicon-trash"></span></th> 
	</tr>
	<?php
	$total = 0;
	$i = 1;
	foreach($donhangchitiet as $giohang)
	{
		
		$total = $total + $giohang["dhct_thanh_tien"];
	?>
	<tr> 
		<td class="text-center"><?php echo $i;?></td> 
		<td><a href="" id="<?php echo $giohang["dhct_id"];?>" class="text-bold"><?php echo $giohang["sp_ten"];?></a></td> 
		<td>
			<div class="input-group">
			<input type="text" id="<?php echo $giohang["dhct_id"];?>" class="form-control text-soluong text-center"  value="<?php echo $giohang["dhct_so_luong"];?>" onkeyup="UpdateSoLuong(<?php echo $giohang["dhct_dh_id"];?>,this.id, this.value,<?php echo $giohang["dhct_don_gia"];?>)" onfocus="this.setSelectionRange(0,this.value.length)"/> 
			<span class="input-group-btn">
			<a href="javascript:SuaDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,<?php echo $giohang["dhct_id"];?>, <?php echo ($giohang["dhct_so_luong"]+1);?>,<?php echo $giohang["dhct_don_gia"];?>)" class="btn btn-primary btn-flat button-soluong">+</a>
			<a href="javascript:SuaDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,<?php echo $giohang["dhct_id"];?>, <?php echo ($giohang["dhct_so_luong"]-1);?>,<?php echo $giohang["dhct_don_gia"];?>)" class="btn btn-primary btn-flat button-soluong">-</a>
			</span>
			</div>
		</td> 
		<td class="text-right"><?php echo number_format($giohang["dhct_don_gia"]);?></td> 
		<td class="text-right"><?php echo number_format($giohang["dhct_thanh_tien"]);?></td> 
		<td class="text-center"> 
			<a title="Xóa" href="javascript:XoaDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,<?php echo $giohang["dhct_id"];?>)"> 
			<span class="glyphicon glyphicon-trash"></span>
			</a> 
		</td> 
	</tr>  
	<?php
	$i = $i + 1;
	}
	?>
</table> 