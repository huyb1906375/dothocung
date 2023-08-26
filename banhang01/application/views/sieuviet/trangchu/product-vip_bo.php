<?php
$chuyenmuc_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_gioi_han("0", "danh-muc", "",0,0);
foreach($chuyenmuc_list as $chuyenmuc)
{
$sanpham_list = $this->sanpham_model->lay_danh_sach_san_pham_gioi_han($chuyenmuc["cm_id"], "", "", 0, 0);
if(count($sanpham_list) > 0)
{
?>
<div class="arrivals-product pb-85 pb-sm-45">
	<div class="container">
		<div class="main-product-tab-area">
			<div class="tab-menu mb-25">
				<div class="section-ttitle">
					<h2><?php echo $chuyenmuc["cm_ten"];?></h2>
			   </div>
				<ul class="nav tabs-area" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#<?php echo $chuyenmuc["cm_id"];?>">Tất cả</a>
					</li>
					<?php
					$chuyenmuc_list2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_gioi_han($chuyenmuc["cm_id"], "danh-muc", "noibat",  0, 0);
					foreach($chuyenmuc_list2 as $chuyenmuc2)
					{
					?>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#<?php echo $chuyenmuc2["cm_id"];?>"><?php echo $chuyenmuc2["cm_ten"];?></a>
					</li>
					<?php
					}
					?>
					
				</ul>                       

			</div> 
			<div class="tab-content">
				<div id="<?php echo $chuyenmuc["cm_id"];?>" class="tab-pane fade show active">
					<div class="row">
						<div class="col-lg-3 order-2 order-lg-1">
							<div class="banner-site-box mt-10">
								<?php
								$lienket_list = $this->lienket_model->lay_danh_lien_ket_chuyen_muc($chuyenmuc["cm_id"]);
								foreach($lienket_list as $lienket)
								{
								?>
								<div class="col-img">
									<a href="<?php echo $lienket["lk_link"];?>" target="<?php echo $lienket["lk_loai_link"];?>"><img src="<?php echo base_url();?>uploads/lienket/<?php echo $lienket["lk_hinh"];?>" alt=""></a>
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="col-lg-9 order-1 order-lg-2">
							<div class="electronics-pro-active2 owl-carousel">
								<?php
								
								$total = count($sanpham_list);
								$numPage = floor( $total / 2);
								if(( $total / 2) - $numPage > 0)
								{
									$numPage += 1;
								}
								for($n=0;$n<$numPage;$n++)
								{
								?>
								<div class="double-product">
									<?php
									if(2*$n < $total)
									{
									$sanpham = $sanpham_list[2*$n];
									?>
									<div class="single-product">
										<div class="pro-img">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>">
												<?php
												$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($sanpham["sp_id"], 2, 0);
												$i = 1;
												if(count($sanphamhinh_list) > 0)
												{
												foreach($sanphamhinh_list as $sanphamhinh)
												{
												?>
												<img class="<?php if($i == 1) echo "primary-img"; else echo "secondary-img";?>" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="single-product">
												<?php
												$i = $i + 1;
												}
												}
												else
												{
												?>
												<img class="primary-img" src="<?php echo base_url();?>uploads/sanpham/noimage.png" alt="single-product">
												<?php
												}
												?>
											</a>
											
											<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_khuyen_mai"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_ban"]);?></del></p>
												<div class="label-product l_sale"><?php echo $sanpham["sp_giam_gia"];?><span class="symbol-percent">%</span></div>
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
											</div>
											<div class="pro-actions">
												<div class="actions-primary">
													<a href="cart.html" title="Add to Cart"> + Add To Cart</a>
												</div>
												<div class="actions-secondary">
													<a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
													<a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
												</div>
											</div>
										</div>
									</div>
									<?php
									}
									if(2*$n + 1 < $total)
									{
									$sanpham = $sanpham_list[2*$n + 1];
									?>
									<div class="single-product">
										<div class="pro-img">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>">
												<?php
												$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($sanpham["sp_id"], 2, 0);
												$i = 1;
												if(count($sanphamhinh_list) > 0)
												{
												foreach($sanphamhinh_list as $sanphamhinh)
												{
												?>
												<img class="<?php if($i == 1) echo "primary-img"; else echo "secondary-img";?>" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="single-product">
												<?php
												$i = $i + 1;
												}
												}
												else
												{
												?>
												<img class="primary-img" src="<?php echo base_url();?>uploads/sanpham/noimage.png" alt="single-product">
												<?php
												}
												?>
											</a>
											
											<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_khuyen_mai"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_ban"]);?></del></p>
												<div class="label-product l_sale"><?php echo $sanpham["sp_giam_gia"];?><span class="symbol-percent">%</span></div>
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
											</div>
											<div class="pro-actions">
												<div class="actions-primary">
													<a href="cart.html" title="Add to Cart"> + Add To Cart</a>
												</div>
												<div class="actions-secondary">
													<a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
													<a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
												</div>
											</div>
										</div>
									</div>
									<?php
									}
									?>
								</div>
								<?php
								}
								?>
								
							</div>
						</div>
					</div>
				</div>
				<?php
				$chuyenmuc_list2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_gioi_han($chuyenmuc["cm_id"], "danh-muc", "noibat", 0, 0);
				foreach($chuyenmuc_list2 as $chuyenmuc2)
				{
				$sanpham_list = $this->sanpham_model->lay_danh_sach_san_pham_gioi_han($chuyenmuc2["cm_id"], "", "", 0, 0);
				$total = count($sanpham_list);
				if($total > 0)
				{
				?>
				<div id="<?php echo $chuyenmuc2["cm_id"];?>" class="tab-pane fade">
					<div class="row">
						<div class="col-lg-5 order-2 order-lg-1">
							<div class="banner-site-box mt-10">
								<div class="col-img">
									<a href="#"><img src="<?php echo base_url();?>public/site/img/banner/electorince.jpg" alt=""></a>
								</div>
								
							</div>
						</div>
						<div class="col-lg-7 order-1 order-lg-2">
							<div class="electronics-pro-active2 owl-carousel">
								<?php
								
								$numPage = floor( $total / 2);
								if(( $total / 2) - $numPage > 0)
								{
									$numPage = $numPage + 1;
								}
								for($n=0;$n<$numPage;$n++)
								{
								?>
								<div class="double-product">
									<?php
									if(2*$n < $total)
									{
									$sanpham = $sanpham_list[2*$n];
									?>
									<div class="single-product">
										<div class="pro-img">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>">
												<?php
												$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($sanpham["sp_id"], 0, 0);
												$i = 1;
												foreach($sanphamhinh_list as $sanphamhinh)
												{
												?>
												<img class="<?php if($i == 1) echo "primary-img"; else echo "secondary-img";?>" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="single-product">
												<?php
												$i = $i + 1;
												}
												?>
											</a>
											
											<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_khuyen_mai"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_ban"]);?></del></p>
												<div class="label-product l_sale"><?php echo $sanpham["sp_giam_gia"];?><span class="symbol-percent">%</span></div>
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
											</div>
											<div class="pro-actions">
												<div class="actions-primary">
													<a href="cart.html" title="Add to Cart"> + Add To Cart</a>
												</div>
												<div class="actions-secondary">
													<a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
													<a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
												</div>
											</div>
										</div>
									</div>
									<?php
									}
									if(2*$n + 1 < $total)
									{
									$sanpham = $sanpham_list[2*$n + 1];
									?>
									<div class="single-product">
										<div class="pro-img">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>">
												<?php
												$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($sanpham["sp_id"], 0, 0);
												$i = 1;
												foreach($sanphamhinh_list as $sanphamhinh)
												{
												?>
												<img class="<?php if($i == 1) echo "primary-img"; else echo "secondary-img";?>" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="single-product">
												<?php
												$i = $i + 1;
												}
												?>
											</a>
											
											<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_khuyen_mai"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_ban"]);?></del></p>
												<div class="label-product l_sale"><?php echo $sanpham["sp_giam_gia"];?><span class="symbol-percent">%</span></div>
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
											</div>
											<div class="pro-actions">
												<div class="actions-primary">
													<a href="cart.html" title="Add to Cart"> + Add To Cart</a>
												</div>
												<div class="actions-secondary">
													<a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
													<a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
												</div>
											</div>
										</div>
									</div>
									<?php
									}
									?>
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				}
				?>
				
			</div>
		</div>
	</div>
</div>
<?php
}
}
?>
