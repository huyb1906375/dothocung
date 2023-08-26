
<div class="modal-dialog modal-lg modal-dialog-centered">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-5">
					<div class="tab-content">
						<?php
						$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($sanpham["sp_id"], 0, 0);
						$i = 1;
						foreach($sanphamhinh_list as $sanphamhinh)
						{
						?>
						<div id="thumb-<?php echo $i;?>" class="tab-pane fade <?php if($i == 1) echo "show active";?>">
							<a data-fancybox="images" href="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>"><img src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="product-view"></a>
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
							<a <?php if($i == 1) echo "class=\"active\"";?> data-toggle="tab" href="#thumb-<?php echo $i;?>"><img src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="product-thumbnail"></a>
							<?php
							$i = $i + 1;
							}
							?>
							
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-md-6 col-sm-7">
					<div class="thubnail-desc fix mt-sm-40">
						<h3 class="product-header"><?php echo $sanpham["sp_ten"];?></h3>
						<div class="pro-price mtb-30">
							<?php
							if($sanpham["sp_giam_gia"] > 0)
							{
							?>
							<p class="d-flex align-items-center"><span class="prev-price"><?php echo number_format($sanpham["sp_gia_thi_truong"]);?></span><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span><span class="saving-price">Tiết kiệm <?php echo number_format($sanpham["sp_giam_gia"]);?>%</span></p>
							<?php
							}
							else
							{
							?>
							<p class="d-flex align-items-center"><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span></p>
							<?php
							}
							?>
						</div>
						<p class="mb-20 pro-desc-details"><?php echo $sanpham["sp_tom_tat"];?></p>
						<div class="product-size mb-20 clearfix">
							<label>Size</label>
							<select class="">
								<option>S</option>
								<option>M</option>
								<option>L</option>
							</select>
						</div>
						<div class="color mb-20">
							<label>color</label>
							<ul class="color-list">
								<li>
									<a class="orange active" href="#"></a>
								</li>
								<li>
									<a class="paste" href="#"></a>
								</li>
							</ul>
						</div>
						<div class="box-quantity d-flex">
							<form action="#">
								<input class="quantity mr-40" type="number" min="1" value="1">
							</form>
							<a class="add-cart" href="cart.html">add to cart</a>
						</div>
						<div class="pro-ref mt-15">
							<p><span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="custom-footer">
			<div class="socila-sharing">
				<ul class="d-flex">
					<li>share</li>
					<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--
<div class="main-product-thumbnail quick-thumb-content">
	<div class="container">
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-5 col-md-6 col-sm-5">
								<div class="tab-content">
									<div id="thumb-1" class="tab-pane fade show active">
										<a data-fancybox="images" href="<?php echo base_url();?>public/site/img/products/35.jpg"><img src="<?php echo base_url();?>public/site/img/products/35.jpg" alt="product-view"></a>
									</div>
									<div id="thumb-2" class="tab-pane fade">
										<a data-fancybox="images" href="<?php echo base_url();?>public/site/img/products/13.jpg"><img src="<?php echo base_url();?>public/site/img/products/13.jpg" alt="product-view"></a>
									</div>
									<div id="thumb-3" class="tab-pane fade">
										<a data-fancybox="images" href="<?php echo base_url();?>public/site/img/products/15.jpg"><img src="<?php echo base_url();?>public/site/img/products/15.jpg" alt="product-view"></a>
									</div>
									<div id="thumb-4" class="tab-pane fade">
										<a data-fancybox="images" href="<?php echo base_url();?>public/site/img/products/4.jpg"><img src="<?php echo base_url();?>public/site/img/products/4.jpg" alt="product-view"></a>
									</div>
									<div id="thumb-5" class="tab-pane fade">
										<a data-fancybox="images" href="<?php echo base_url();?>public/site/img/products/5.jpg"><img src="<?php echo base_url();?>public/site/img/products/5.jpg" alt="product-view"></a>
									</div>
								</div>
								<div class="product-thumbnail mt-20">
									<div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
										<a class="active" data-toggle="tab" href="#thumb-1"><img src="<?php echo base_url();?>public/site/img/products/35.jpg" alt="product-thumbnail"></a>
										<a data-toggle="tab" href="#thumb-2"><img src="<?php echo base_url();?>public/site/img/products/13.jpg" alt="product-thumbnail"></a>
										<a data-toggle="tab" href="#thumb-3"><img src="<?php echo base_url();?>public/site/img/products/15.jpg" alt="product-thumbnail"></a>
										<a data-toggle="tab" href="#thumb-4"><img src="<?php echo base_url();?>public/site/img/products/4.jpg" alt="product-thumbnail"></a>
										<a data-toggle="tab" href="#thumb-5"><img src="<?php echo base_url();?>public/site/img/products/5.jpg" alt="product-thumbnail"></a>
									</div>
								</div>
							</div>
							<div class="col-lg-7 col-md-6 col-sm-7">
								<div class="thubnail-desc fix mt-sm-40">
									<h3 class="product-header">Printed Summer Dress</h3>
									<div class="pro-price mtb-30">
										<p class="d-flex align-items-center"><span class="prev-price">16.51</span><span class="price">$15.19</span><span class="saving-price">save 8%</span></p>
									</div>
									<p class="mb-20 pro-desc-details">Long printed dress with thin adjustable straps. V-neckline and wiring under the bust with ruffles at the bottom of the dress.</p>
									<div class="product-size mb-20 clearfix">
										<label>Size</label>
										<select class="">
											<option>S</option>
											<option>M</option>
											<option>L</option>
										</select>
									</div>
									<div class="color mb-20">
										<label>color</label>
										<ul class="color-list">
											<li>
												<a class="orange active" href="#"></a>
											</li>
											<li>
												<a class="paste" href="#"></a>
											</li>
										</ul>
									</div>
									<div class="box-quantity d-flex">
										<form action="#">
											<input class="quantity mr-40" type="number" min="1" value="1">
										</form>
										<a class="add-cart" href="cart.html">add to cart</a>
									</div>
									<div class="pro-ref mt-15">
										<p><span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="custom-footer">
						<div class="socila-sharing">
							<ul class="d-flex">
								<li>share</li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->