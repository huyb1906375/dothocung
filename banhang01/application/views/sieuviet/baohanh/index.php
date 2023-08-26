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
			<li class="active"><a href="<?php echo base_url();?>tra-cuu-bao-hanh.html">Tra cứu bảo hành</a></li>
		</ol>
	</div>
</div>
<div class="cart-main-area ptb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="checkout-form-list mb-30">
					<form name="frmTraCuu" action="<?php echo base_url();?>tra-cuu-bao-hanh.html" method="POST" onsubmit="return KiemTraDatHang();">
					<table border="0" width="100%">
						<tr>
							<td width="200px"><label>Số Seri thiết bị/Số ĐT khách hàng: <span class="required">*</span></label></td>
							<td width="200px">
								<input type="text" class="form-control" id="txtTuKhoaBaoHanh" name="txtTuKhoaBaoHanh" value="<?php echo set_value('txtTuKhoaBaoHanh');?>"/>
								<div class="error"><?php echo form_error('txtTuKhoaBaoHanh')?></div>
							</td>
							<td>
								<input type="submit" name="btnTraCuu" id="btnTraCuu" value="Tra cứu" class="button" style="margin-left: 10px; margin-top: 0px;"/>
							</td>
						</tr>
					</table>
					</form>
					
					
				</div>
			</div>
			<?php
			if(isset($baohanh_list))
			{
			?>
			<div class="col-md-12">
				<div class="table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead class="bg-light-blue">
							<tr>								
								<th class="text-center" style="width:100px">Hình</th>
								<th class="text-center" style="width:120px">Số seri</th>
								<th class="text-center" style="width:180px">Tên thiết bị</th>
								<th class="text-center" style="width:120px">Ngày nhận</th>
								<th class="text-center">Tình trạng</th>								
								<th class="text-center" style="width:180px">Khách hàng</th>
								<th class="text-center" style="width:120px">Điện thoại</th>								
								<th class="text-center" style="width:120px">Trạng thái</th>
								
							</tr>
						</thead>
						<tbody>
							 <?php		   	
							//$baohanh = $this->baohanh_model->lay_danh_sach_lien_ket("",$this->session->userdata('bh_trang_thai'));
							foreach ($baohanh_list as $baohanh)
							{	
								$img = "default.png";
								if($baohanh["bh_hinh"] != "")
									$img = $baohanh["bh_hinh"]; 	
							?>
							<tr>			   					               
								<td class="text-center">
									<img src="../uploads/baohanh/<?php echo $img;?> " height="64" width="64"/>
								</td>
								<td><?php echo $baohanh["bh_seri"];?></td>
								
								<td><?php echo $baohanh["bh_thiet_bi"];?></td>
								<td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($baohanh["bh_ngay_lap"]));?></td>
								<td><?php echo $baohanh["bh_tinh_trang"];?></td>
								<td><?php echo $baohanh["bh_khach_hang"];?></td>
								
								<td><?php echo $baohanh["bh_dien_thoai"];?></td>
								
								<td>
								<?php
								$trangthai = "";
								if($baohanh["bh_trang_thai"] == 0)
									$trangthai = "Mới tiếp nhận";
								if($baohanh["bh_trang_thai"] == 1)
									$trangthai = "Đang xử lý";
								if($baohanh["bh_trang_thai"] == 2)
									$trangthai = "Đã có kết quả";
								if($baohanh["bh_trang_thai"] == 3)
									$trangthai = "Đã trả khách";
								echo $trangthai;
								?>
								</td>
								
							</tr>
								
							<?php                                                
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php
			}
			
			?>
		</div>
	</div>
</div>
