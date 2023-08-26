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
					<div class="product-detail-box">
						<h1 class="product-title-detail tp_product_detail_name"><?php echo $row["sp_ten"];?></h1>
						<span class="sku"><strong>Mã sản phẩm:</strong><?php echo $row["sp_ma"];?></span>
						<span class="sku"><p id="voteView0" class="si ic voteView"></p></span>
						<div class="row">
							<div class="col-sm-5 col-xs-5 left_box">
								<div class="attr"></div>

								<div class="price detail-info-entry">
									<div class="current tp_product_detail_price">322,592 ₫</div>
								</div>
								<div class="quantity-selector detail-info-entry">
									<div class="detail-info-entry-title">Số lượng</div>
									<div class="entry number-minus">&nbsp;</div>
									<div class="entry number" id="psQtt">1</div>
									<div class="entry number-plus">&nbsp;</div>
								</div>

								<div class="blockShip tp_product_detail_depot">
									<ul class="lstLocation">
										<li>
											<span class="image iconLocation"></span>
											<a style="color: #000;padding-left: 4px;font-weight: bold;">Danh sách địa chỉ</a>
										</li>
									</ul>
								</div>

							</div>
							<div class="col-sm-7 col-xs-7 right_box text-left">
                                <div class="pd_policy">
                                    <h3>Dịch vụ của hệ thống D Group Việt Nam</h3>
									<div class="serv serv-1">
										<p>- Giao hàng&nbsp;&nbsp;C.O.D bưu điện , Viettel post : Giao tận nhà trong 1-5&nbsp;ngày làm việc ( Yêu cầu đặt cọc )&nbsp;<br>
											- Giao hàng xe vận tải, xe khách ( Yêu cầu chuyển khoản trước 100% đơn hàng )&nbsp;</p>
									</div>
									<div class="serv serv-2">
										<p>- Được đổi trả nếu hàng không đúng thực tế đặt hàng&nbsp;</p>
										<p>- Đền tiền gấp 100 lần nếu phát hiện hàng giả, hàng nhái , hàng không chính hãng&nbsp;</p>
										<p>- Giá lẻ rẻ như giá buôn&nbsp;</p>
										<p>- Giá rẻ vô địch&nbsp;</p>
									</div>                                        
								</div>
							</div>
							<div class="clearfix"></div>
                            <div class="clearfix"></div>
							<div class="detail-info-entry pd_action">
								<input type="hidden" id="psId" value="11114453">
								<input type="hidden" id="selectPsId" value="11114453">
								<button id="addToCart" psid="11114453" selid="11114453" class="btn btn-outline tp_button" ck="1" data-original-title="" title="">Mua ngay</button>
								<button id="addQuickCart" psid="11114453" selid="11114453" class="btn btn-outline tp_button" ck="1" data-original-title="" title="">Thêm vào giỏ hàng</button>                                    
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
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
