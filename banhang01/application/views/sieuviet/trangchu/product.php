<?php
$lienket_list = $this->lienket_model->lay_danh_sach_lien_ket_gioi_han("binhthuong","Main",1,0);
if(count($lienket_list) > 0)
{
?>
<div class="big-banner pb-15 pb-sm-15 off-white-bg" style="margin-top: 0px;">
	<div class="container banner-2">
	<?php
	foreach($lienket_list as $lienket)
	{
	?>
	<div class="banner-box white-bg">
		<div class="col-img">
			<a href="<?php echo $lienket["lk_link"];?>" target="<?php echo $lienket["lk_loai_link"];?>"><img src="<?php echo base_url();?>uploads/lienket/<?php echo $lienket["lk_hinh"];?>"></a>
		</div>
	</div>
	<?php
	}
	?>
	</div>
</div>
<?php
}
?>

<?php
$chuyenmuc_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0", "danh-muc", "noibat");
foreach($chuyenmuc_list as $chuyenmuc)
{
$sanpham_list = $this->sanpham_model->public_lay_danh_sach_san_pham($chuyenmuc["cm_id"], "", "", 0, 0,"Order");
if(count($sanpham_list) > 0)
{
?>
<div class="arrivals-product ptb-20 pb-sm-10">
	<div class="container">
		<div class="main-product-tab-area">
			<div class="tab-menu mb-0">
				
				<div class="section-ttitle">
					
					<div class="icon"><span></span><a href="<?php echo base_url();?>danh-muc/<?php echo $chuyenmuc["cm_slug"];?>.html"><?php echo $chuyenmuc["cm_ten"];?></a></div>
					<div class="catgory">					
						<a href="<?php echo base_url();?>danh-muc/<?php echo $chuyenmuc["cm_slug"];?>.html" style="float: right; font-weight: bold;"><img src="<?php echo base_url();?>public/img/tatca.png"/></a>
					</div>
					
				</div>
			</div> 
			<div class="tab-content">
				<div id="<?php echo $chuyenmuc["cm_id"];?>" class="tab-pane fade show active">
					<div class="row">
						
						<div class="col-lg-12 order-1 order-lg-2">
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
										<div class="pro-img 220">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>">
												<img class="h220 primary-img" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanpham["sp_hinh"];?>" alt="single-product">
											</a>
											
											<a class="quick_cart" onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham["sp_id"];?>','1','<?php echo $sanpham["sp_gia_ban"];?>')"><img src="<?php echo base_url();?>public/img/icon-cart.png"/></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_thi_truong"]);?></del></p>
												
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php if($sanpham["sp_gia_ban"] == 0) echo "Liên hệ"; else echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
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
												<img class="h220 primary-img" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanpham["sp_hinh"];?>" alt="single-product">
											</a>
											
											<a class="quick_cart"  onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham["sp_id"];?>','1','<?php echo $sanpham["sp_gia_ban"];?>')"><img src="<?php echo base_url();?>public/img/icon-cart.png"/></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_slug"];?>.html" title="<?php echo $sanpham["sp_ten"];?>"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_thi_truong"]);?></del></p>
												
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php  if($sanpham["sp_gia_ban"] == 0) echo "Liên hệ"; else echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
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
				
				
			</div>
		</div>
	</div>
</div>
<?php
}
}
?>
<!-- Quick View Content Start -->
<div class="main-product-thumbnail quick-thumb-content">
	<div class="container">
		<!-- The Modal -->
		<div class="modal fade" id="myModal">
			
		</div>
	</div>
</div>
<!-- Quick View Content End -->
<script type="text/javascript">
function ShowQuickView(id)
{	
	var url = "<?php echo base_url(); ?>ajax/ajax_show_quick_view/"+id;
	loadDuLieu('myModal',url);
	var $owl = $('.product-thumbnail').owlCarousel();

	$owl.trigger('refresh.owl.carousel');
}

</script>
