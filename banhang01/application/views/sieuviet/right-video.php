<div class="panel_inner categories-widget">
	<div class="panel_header">
		<h4><strong>VIDEO MỚI</strong></h4>
	</div>
	<div class="most-viewed p-top0">
		<ul id="most-today" class="content tabs-content">
		<?PHP
		$tintuc_list = $this->baiviet_model->lay_danh_sach_bai_viet_gioi_han("", "tieudiem", "", 5, 0);
		foreach($tintuc_list as $tintuc)
		{
			$img = "default.png";
			if(strlen($tintuc["bv_hinh"]) > 0)
				$img = $tintuc["bv_hinh"];
		?>
		<li>
			
			<div class="col-xs-5 col-sm-5 col-md-5 p-left0 p-right0">
				<a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html">
					<img src="<?php echo base_url();?>uploads/baiviet/<?php echo $img;?>" alt="" class="img-responsive">
					<div class="link-icon"><i class="fa fa-play"></i></div>
				</a>
			</div>
			<div class="col-xs-7 col-sm-7 col-md-7 p-right0">						
				<a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html">
					<h5 class="text-title"><?php echo $tintuc["bv_ten"];?><h5>
				</a>						
			</div>
			
		</li>
		
		<?php
		}
		?>
		</ul>
	</div>
</div>
			