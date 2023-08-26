<div class="widget categories">
  <h4 class="widget-title text-bold">CHUYÊN MỤC</h4>
  <ul class="categories-list">
	<?php
	$cm_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0", "chuyen-muc", "");
	foreach($cm_list as $cm)
	{
	?>
	<li>
	  <a href="<?php echo base_url();?>chuyen-muc/<?php echo $cm["cm_slug"];?>">
		<?php echo $cm["cm_ten"];?> <span class="category-counter"><?php echo $this->chuyenmuc_model->lay_so_bai_viet_theo_chuyen_muc($cm["cm_id"]);?></span>
	  </a>
	</li>
	
	<?php
		$cm_list1 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($cm["cm_id"], "chuyen-muc", "");
		foreach($cm_list1 as $cm1)
		{
			?>
			<li>
				<a href="<?php echo base_url();?>chuyen-muc/<?php echo $cm1["cm_slug"];?>" style="padding-left: 20px;">
					-&nbsp;&nbsp;<?php echo $cm1["cm_ten"];?> <span class="category-counter"><?php echo $this->chuyenmuc_model->lay_so_bai_viet_theo_chuyen_muc($cm1["cm_id"]);?></span>
				</a>
			</li>
			<?php
		}
	
	}
	?>
	
  </ul>
</div>