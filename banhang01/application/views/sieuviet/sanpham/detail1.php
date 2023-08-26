<div class="main-page-banner home-3">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<?php $this->load->view('menusanpham'); ?>
			</div>
		</div>
	</div>          
</div>
<div class="breadcrumb-area mt-30">
	<div class="container">
		<div class="breadcrumb">
			<ul class="d-flex align-items-center">
				<li><a href="<?php echo base_url();?>">Trang chủ</a></li>
				<?php
				if($rowcm["cm_id_parent"] != "0")
				{
					$cmparent = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($rowcm["cm_id_parent"]);
				?>
				<li><a href="<?php echo base_url();?>danh-muc/<?php echo $cmparent["cm_slug"];?>"><?php echo $cmparent["cm_ten"];?></a></li>
				<?php
				}
				?>
				<li class="active"><a href="<?php echo base_url();?>danh-muc/<?php echo $rowcm["cm_slug"];?>"><?php echo $rowcm["cm_ten"];?></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="main-product-thumbnail ptb-30 ptb-sm-60">
	<div class="container">
		<div class="thumb-bg">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 information-entry mb-all-30">
					<div class="tab-content">
						<?php
						$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($row["sp_id"], 0, 0);
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
							<a <?php if($i == 1) echo "class=\"active\"";?> data-toggle="tab" href="#thumb<?php echo $i;?>"><img src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="product-thumbnail" style="height: 120px;"></a>
							<?php
							$i = $i + 1;
							}
							?>
							
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 information-entry">
					<div class="thubnail-desc fix">
						<div class="Product_detail_name">
							<h4 class="text-22 font-weight-bold"><?php echo $row["sp_ten"];?></h4>
						
							<div class="rating-summary fix mb-15">							
								<div class="rating-feedback">
									<a href="#">(<?php echo number_format($row["sp_luot_xem"] +1);?> lượt xem)</a>								
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
						$thuoctinh_list = $this->sanpham_model->lay_danh_sach_san_pham_thuoc_tinh($row["sp_id"]);
						foreach($thuoctinh_list as $thuoctinh)
						{
						?>
						<p class="pro-desc-details"><?php echo $thuoctinh["sptt_ten"].": ".$thuoctinh["sptt_gia_tri"];?></p>
						<?php
						}
						?>						
						<p class="mb-15 pro-desc-details"><?php echo $row["sp_tom_tat"];?></p>
						<!--
						<ul class="mt-20">
							<li class="pb-3" style="padding:0">
								Kho hàng: <span style="color: #159500;">Liên hệ</span>
							</li>
						</ul>
						-->
						<div class="Product_detail_price">
							<?php
							if($row["sp_giam_gia"] > 0)
							{
							?>
							<p class="p-detail-marketPrice">
								<b>Giá thị trường:</b> <span class="old_Price"> <?php echo number_format($row["sp_gia_thi_truong"]);?> đ</span>  
								<span class="percent"> -<?php echo $row["sp_giam_gia"];?>% </span>
							</p>							   
							<p class="p-detail-price">
								<b>Giá bán:</b> <span class="Price">  <?php echo number_format($row["sp_gia_ban"]);?> đ </span>
								<span style="font-size: 13px; color: #333; padding: 15px 0 0 15px;"></span>
							</p>
							<?php
							}
							else
							{
							?>													   
							<p class="p-detail-price">
								<b>Giá bán:</b> <span class="Price">  <?php echo number_format($row["sp_gia_ban"]);?> đ </span>
								<span style="font-size: 13px; color: #333; padding: 15px 0 0 15px;"></span>
							</p>
							<?php
							}
							?>
							
							<div class="align-items-center d-flex soluong-mua mt-20">
								<div class="d-inline-block thaydoi-soluong" style="width: 30%;">
									<a class="btn btn-xs btn-flat btn-cart-quantity minus quantity-change" href="javascript:void(0)" data-value="-1" title="tru">-</a>
									<input class="quantity-cart-header buy-quantity  quantity-change" type="text" value="1" size="5" title="Số lượng sản phẩm muốn mua">
									<a href="javascript:void(0)" data-value="1" title="them" class="btn btn-xs btn-flat btn-cart-quantity plus quantity-change">+</a>
								</div>
								<a href="" data-url="/dang-nhap?type=ajax" class="MuaNgay js-open-fancybox" onclick="ShowMessageUpdate()">  Mua ngay </a>
								<a href="" data-url="/dang-nhap?type=ajax" class="Chovaogio js-open-fancybox" onclick="ShowMessageUpdate()"> Cho vào giỏ </a> 
							</div>
							
							<p class="mt-15"><img src="<?php echo base_url();?>public/site/img/giaotannoi1.jpg" alt="" height="35"></p>
							
						</div>
						<!--
						<div class="box-quantity d-flex hot-product2 mt-20">
							<form action="#">
								<input class="quantity mr-15" type="number" min="1" value="1">
							</form>
							<div class="pro-actions">
								<div class="actions-primary">
									<a href="cart.html" title="" data-original-title="Add to Cart"> + Mua ngay</a>
								</div>
								<div class="actions-primary">
									<a href="cart.html" title="" data-original-title="Add to Cart"> + Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
						-->
						
						
						
					</div>
				</div>
				<!-- Thumbnail Description End -->
			</div>
			<!-- Row End -->
		</div>
	</div>
	<!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-30 pb-sm-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul class="main-thumb-desc nav tabs-area" role="tablist">
					<li><a class="active" data-toggle="tab" href="#dtail">Thông tin chi tiết</a></li>
					<li><a data-toggle="tab" href="#review">Nhận xét - Đánh giá</a></li>
				</ul>
				<!-- Product Thumbnail Tab Content Start -->
				<div class="tab-content thumb-content border-default">
					<div id="dtail" class="tab-pane fade show active">
						<p><?php echo $row["sp_chi_tiet"];?></p>
					</div>
					<div id="review" class="tab-pane fade">
						
					</div>
				</div>
				<!-- Product Thumbnail Tab Content End -->
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<script type="text/javascript">
  //click thay doi so luong mua 
  $('.quantity-change').on("click",function(t){

    var quantity = parseInt(this.getAttribute("data-value"));
    var $row        = $(this).closest(".thaydoi-soluong");
    var current_quantity = parseInt($row.find(".buy-quantity").val());

    if(current_quantity < 0) {
      $row.find(".buy-quantity").val(0);
      return ;
    }
    $row.find(".buy-quantity").val(current_quantity + quantity);
    console.log(current_quantity);
  });
</script>
<?php $this->load->view('site/sanpham/relative'); ?>
