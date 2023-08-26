<?php
$sanphamlienquan_list = $this->sanpham_model->lay_danh_sach_san_pham_lien_quan($sanpham["sp_cm_id"], $sanpham["sp_id"],20,0);
if(count($sanphamlienquan_list) > 0)
{
?>
<div class="hot-deal-products off-white-bg pt-30 pb-30 pt-sm-60 pb-sm-50">
	<div class="container">
		<div class="post-title pb-10">
		   <h2>Sản phẩm liên quan</h2>
		</div>
		<div class="hot-deal-active owl-carousel">
			<?php
			foreach($sanphamlienquan_list as $sanphamlienquan)
			{
			?>
			<div class="single-product">
				<div class="pro-img">
					<a href="<?php echo base_url();?>san-pham/<?php echo $sanphamlienquan["sp_slug"];?>.html">
						<img class="h220 primary-img" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamlienquan["sp_hinh"];?>" alt="single-product">
					</a>
					
					<a class="quick_cart"  onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanphamlienquan["sp_id"];?>','1','<?php echo $sanphamlienquan["sp_gia_ban"];?>')"><img src="<?php echo base_url();?>public/img/icon-cart.png"/></a>
				</div>
				<div class="pro-content">
					<div class="pro-info">
						<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanphamlienquan["sp_slug"];?>.html"><?php echo $sanphamlienquan["sp_ten"];?></a></h4>
						<?php
						if($sanphamlienquan["sp_giam_gia"] > 0)
						{
						?>
						<p><span class="price"><?php echo number_format($sanphamlienquan["sp_gia_ban"]);?></span><del class="prev-price"><?php echo number_format($sanphamlienquan["sp_gia_thi_truong"]);?></del></p>
						<div class="label-product l_sale">-<?php echo $sanphamlienquan["sp_giam_gia"];?><span class="symbol-percent">%</span></div>
						<?php
						}
						else
						{
						?>
						<p><span class="price"><?php if($sanphamlienquan["sp_gia_ban"] == 0) echo "liên hệ"; else echo number_format($sanphamlienquan["sp_gia_ban"]);?></span></p>
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
	</div>
</div>
<?php
}
?>