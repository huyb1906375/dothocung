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
			<?php
			if($chuyenmuc["cm_id_parent"] != "0")
			{
				$cmparent = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($chuyenmuc["cm_id_parent"]);
			?>
			<li><a href="<?php echo base_url();?>danh-muc/<?php echo $cmparent["cm_slug"];?>.html"><?php echo $cmparent["cm_ten"];?></a></li>
			<?php
			}
			?>
			<li class="active"><a href="<?php echo base_url();?>danh-muc/<?php echo $chuyenmuc["cm_slug"];?>.html"><?php echo $chuyenmuc["cm_ten"];?></a></li>
		</ol>  
	</div>
</div>
<div class="main-product-thumbnail ptb-30 ptb-sm-60">
	<div class="container">
		<div class="thumb-bg">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 information-entry mb-all-30">
					<div class="tab-content">
						<?php
						$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($sanpham["sp_id"], 0, 0);
						$i = 1;
						foreach($sanphamhinh_list as $sanphamhinh)
						{
						?>
						<div id="thumb<?php echo $i;?>" class="tab-pane fade <?php if($i == 1) echo "show active";?>">
							<a data-fancybox="images" href="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>"><img src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="product-view" style="max-height: 380px;"/></a>
						</div>
						<?php
						$i = $i + 1;
						}
						?>
						
					</div>
					<div class="product-thumbnail mt-20">
						<div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
							<?php						
							$i = 1;
							foreach($sanphamhinh_list as $sanphamhinh)
							{
							?>
							<a <?php if($i == 1) echo "class=\"active\"";?> data-toggle="tab" href="#thumb<?php echo $i;?>"><img src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="product-thumbnail" style="height: 64px;"></a>
							<?php
							$i = $i + 1;
							}
							?>
							
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 information-entry">
					<div class="thubnail-desc fix">
						<div class="Product_detail_name">
							<h4 class="text-22 font-weight-bold"><?php echo $sanpham["sp_ten"];?></h4>
							<!--<span class="sku"><strong>Mã số:</strong> <?php echo $sanpham["sp_ma"];?></span>-->
							<div class="rating-summary fix mb-15">							
								<div class="rating-feedback">
									<a href="#">(<?php echo number_format($sanpham["sp_luot_xem"] +1);?> lượt xem)</a>								
								</div>
							</div>
							
							<div class="social-product">
								<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
								  <a class="addthis_button_facebook"></a>
								  <a class="addthis_button_twitter"></a>
								  <a class="addthis_button_email"></a>
								  <a class="addthis_button_linkedin"></a>
								  <a class="addthis_button_compact"></a>
								</div>
								<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52493e8d684da4cc"></script> 										
							</div>
						</div>
						<?php
						$thuoctinh_list = $this->sanpham_model->lay_danh_sach_san_pham_thuoc_tinh($sanpham["sp_id"]);
						foreach($thuoctinh_list as $thuoctinh)
						{
						?>
						<p class="pro-desc-details"><?php echo $thuoctinh["sptt_ten"].": ".$thuoctinh["sptt_gia_tri"];?></p>
						<?php
						}
						?>						
						<p class="mb-15 pro-desc-details"><?php echo $sanpham["sp_tom_tat"];?></p>
						<div class="Product_detail_price">
							<?php
							if($sanpham["sp_giam_gia"] > 0)
							{
							?>
							<p class="p-detail-marketPrice">
								<b>Giá thị trường:</b> <span class="old_Price"> <?php echo number_format($sanpham["sp_gia_thi_truong"]);?> đ</span>  
								<span class="percent"> -<?php echo $sanpham["sp_giam_gia"];?>% </span>
							</p>							   
							<p class="p-detail-price">
								<b>Giá bán:</b> <span class="Price">  <?php echo number_format($sanpham["sp_gia_ban"]);?> đ </span>
								<span style="font-size: 13px; color: #333; padding: 15px 0 0 15px;"></span>
							</p>
							<?php
							}
							else
							{
								$giaban = "liên hệ";
								if($sanpham["sp_gia_ban"] > 0)
									$giaban = number_format($sanpham["sp_gia_ban"])."đ";
							?>													   
							<p class="p-detail-price">
								<b>Giá bán:</b> <span class="Price">  <?php echo $giaban;?> </span>
								<span style="font-size: 13px; color: #333; padding: 15px 0 0 15px;"></span>
							</p>
							<?php
							}
							?>
							
							<div class="align-items-center d-flex soluong-mua mt-20">
								<div class="d-inline-block thaydoi-soluong">
									<a class="btn btn-xs btn-flat btn-cart-quantity minus quantity-change" href="javascript:void(0)" data-value="-1" title="tru">-</a>
									<input id="txtSoLuong" name="txtSoLuong" class="quantity-cart-header buy-quantity" type="text" value="1" size="5" title="Số lượng sản phẩm muốn mua"/>
									<a href="javascript:void(0)" data-value="1" title="them" class="btn btn-xs btn-flat btn-cart-quantity plus quantity-change">+</a>
								</div>
								 
							</div>
							<div class="pd_action mt-20 mb-20">
								<input type="button" name="btnMuaNgay" value="Mua hàng" class="MuaNgay" onclick="MuaHang('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham["sp_id"];?>',$('#txtSoLuong').val(),'<?php echo $sanpham["sp_gia_ban"];?>')"/>
								<input type="button" name="btnChoVaoGio" value="Cho vào giỏ" class="Chovaogio" onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham["sp_id"];?>',$('#txtSoLuong').val(),'<?php echo $sanpham["sp_gia_ban"];?>')"/>
								
							</div>
							<p class="mt-15"><img src="<?php echo base_url();?>public/img/giaotannoi1.jpg" alt="" height="35"></p>
							
						</div>
						
						
						
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  hidden-xs hidden-sm hidden-md">
					<?php $this->load->view('sieuviet/right-camket'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="thumnail-desc pb-30 pb-sm-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul class="main-thumb-desc nav tabs-area" role="tablist">
					<li><a class="active" data-toggle="tab" href="#chitiet">Mô tả chi tiết</a></li>
					<li><a data-toggle="tab" href="#huongdan">Hướng dẫn sử dụng</a></li>
					<!--<li><a data-toggle="tab" href="#thongtinkhac">Thông tin khác</a></li>-->
					
				</ul>
				<div class="tab-content thumb-content border-default">
					<div id="chitiet" class="tab-pane fade show active">
						<p><?php echo $sanpham["sp_chi_tiet"];?></p>
					</div>
					<div id="huongdan" class="tab-pane fade">
						<p><?php echo $sanpham["sp_chi_tiet2"];?></p>
					</div>
					<!--
					<div id="thongtinkhac" class="tab-pane fade">
						<p><?php echo $sanpham["sp_chi_tiet3"];?></p>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
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
<?php $this->load->view('sieuviet/sanpham/relative'); ?>
