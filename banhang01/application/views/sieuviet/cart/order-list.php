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
			<li class="active"><a href="<?php echo base_url();?>don-hang.html">Đơn hàng</a></li>
		</ol>
	</div>
</div>
<div class="cart-main-area ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead class="bg-light-blue">
							<tr>								
								<th class="text-center"  style="width:50px">ID</th>
								<th class="text-center" style="width:90px">Ngày lập</th>
								<th style="width:120px">Người nhận</th>				
								<th>Địa chỉ</th>
								<th style="width:90px">Điện thoại</th>
								
								<th class="text-center" style="width:90px">Số tiền</th>
								<th style="width:140px">Thanh toán</th>
								<th style="width:120px">Trạng thái</th>
								<th class="text-center" style="width:100px">Chức năng</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($list as $row)
							{	
								
							?>
							<tr>			   					               
								
								<td><a href="<?php echo base_url();?>don-hang/<?php echo $row["dh_id"];?>.html"><b><?php echo $row["dh_id"];?></b></a></td>
								<td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($row["dh_ngay_lap"]));?></td>
								<td><?php echo $row["dh_ten"];?></td>
								<td><?php echo $row["dh_dia_chi"];?></td>
								<td><?php echo $row["dh_dien_thoai"];?></td>
								
								<td><b><?php echo number_format($row["dh_tong_cong"]);?></b></td>
								<td>
								<?php
								$phuongthuc = "";
								if($row["dh_phuong_thuc_thanh_toan"] == "thanhtoansau")
									$phuongthuc = "Thanh toán khi nhận hàng";
								if($row["dh_phuong_thuc_thanh_toan"] == "thanhtoantruoc")
									$phuongthuc = "Thanh toán trước bằng chuyển khoản";
								
								echo $phuongthuc;
								?>
								</td>
								<td>
								<?php
								$trangthai = "";
								if($row["dh_trang_thai"] == 1)
									$trangthai = "Mới tiếp nhận";
								if($row["dh_trang_thai"] == 2)
									$trangthai = "Đang xử lý";
								if($row["dh_trang_thai"] == 3)
									$trangthai = "Đang giao hàng";
								if($row["dh_trang_thai"] == 4)
									$trangthai = "Đã hoàn tất";
								echo $trangthai;
								?>
								</td>
								<td class="text-center">                
									<div class="btn-group">
                                        <a class='btn btn-primary btn-xs' href="<?php echo base_url();?>don-hang/<?php echo $row["dh_id"];?>.html" title='Xem'><i class="fa  fa-search"></i></a>
                                        <a class='btn btn-success btn-xs' href="<?php echo base_url();?>in-don-hang/<?php echo $row["dh_id"];?>.html" title='In' title="In"><i class="fa fa-print"></i></a>
                                        <a class='btn btn-danger btn-xs' onclick="return confirm('Bạn có chắc muốn xóa không?')" href="<?php echo base_url();?>cart/delete/<?php echo $row["dh_id"];?>"  title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </div>               
								</td>
								
								
							</tr>
								
								<?php  
									$i = $i + 1;
								}
								?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
