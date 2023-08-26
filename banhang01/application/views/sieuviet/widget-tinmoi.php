<!-- Popular Posts widget -->
<div class="widget widget-popular-posts">
  <h4 class="widget-title">TIN MỚI</h4>
  <ul class="posts-list">
	<?php
	$tinmoi_list = $this->baiviet_model->lay_danh_sach_bai_viet_moi(5,0);
	foreach($tinmoi_list as $tinmoi)
	{
		$img = "default.png";
		if(strlen($tinmoi["bv_hinh"]) > 0)
			$img = $tinmoi["bv_hinh"];
	?>
	<li>
		<div class="widget-thumb">
			<a href="<?php echo base_url();?>tin-tuc/<?php echo $tinmoi["bv_slug"];?>.html"><img src="<?php echo base_url();?>uploads/baiviet/<?php echo $img;?>" alt="" /></a>
		</div>
		<div class="widget-content">
			<a href="<?php echo base_url();?>tin-tuc/<?php echo $tinmoi["bv_slug"];?>.html"><?php echo $tinmoi["bv_ten"];?></a>
			<span><i class="lni-alarm-clock"></i> <?php echo date('d/m/Y H:i',strtotime($tinmoi["bv_ngay_dang"]));?></span>
		</div>
		<div class="clearfix"></div>
	</li>
	<?php
	}
	?>
	
  </ul>
</div>