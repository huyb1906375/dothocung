<?php
$chuyenmuc_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0", "danh-muc", "noibat");
foreach($chuyenmuc_list as $chuyenmuc)
{
$sanpham_list = $this->sanpham_model->lay_danh_sach_san_pham_gioi_han($chuyenmuc["cm_id"], "noibat", "", 12, 0);
if(count($sanpham_list) > 0)
{
?>
<div class="arrivals-product pt-30" >
	<div class="container">
		<div class="main-product-tab-area">
				
				<div class="section-ttitle">
					<h2>
						<a href="<?php echo base_url();?>danh-muc/<?php echo $chuyenmuc["cm_slug"];?>"><img src="<?php echo base_url();?>public/site/img/right.png"  height="20" style="margin-top: -3px; margin-right: 5px;"><?php echo $chuyenmuc["cm_ten"];?></a>
						<a href="<?php echo base_url();?>danh-muc/<?php echo $chuyenmuc["cm_slug"];?>"><img src="<?php echo base_url();?>public/site/img/tatca.png" style="float: right; margin-right: 10px;"></a>
					</h2>
					
				</div>
				
				<div class="main-categorie" style="border: 1px solid #ddd;">
					<div class="tab-content fix">
						
						<div id="grid-view" class="tab-pane fade show active" >
							<div class="row">
								<?php
								foreach($sanpham_list as $sanpham)
								{
								?>
								
									<div class="single-product col-lg-2 col-md-4 col-sm-6 col-6" style="border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 0px; margin-top: 0px; margin-bottom: 0px;">
										<div class="pro-img">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_id"];?>/<?php echo $sanpham["sp_slug"];?>.html">
												<img class="primary-img" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanpham["sp_hinh"];?>" alt="<?php echo $sanpham["sp_ten"];?>" style="height: 200px; padding-left: 10px; padding-right: 10px; padding-top: 10px;">
											</a>
											<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_id"];?>/<?php echo $sanpham["sp_slug"];?>.html"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_thi_truong"]);?></del></p>
												<div class="label-product l_sale">-<?php echo $sanpham["sp_giam_gia"];?><span class="symbol-percent">%</span></div>
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php if($sanpham["sp_gia_ban"] == 0) echo "liên hệ"; else echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
											</div>
											
											<div class="pro-actions">
												<div class="actions-primary">
													<input type="button" name="btnAddToCart" value="+ Thêm vào giỏ hàng" class="btnAddToCart" onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham["sp_id"];?>','1','<?php echo $sanpham["sp_gia_ban"];?>')"/>
													<!--<a title="Add to Cart" onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham["sp_id"];?>','1','<?php echo $sanpham["sp_gia_ban"];?>')"> + Thêm vào giỏ hàng</a>-->
												</div>
											</div>
											
										</div>
									</div>
								
								<?php
								}
								?>
								
							</div>
							<!-- Row End -->
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
}

</script>
