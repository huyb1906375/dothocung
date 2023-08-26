<div class="panel_inner categories-widget">
	<div class="panel_header">
		<h4><strong>VIDEO NỔI BẬT</strong></h4>
	</div>
	<div class="most-viewed p-top0">
		<ul id="most-today" class="content tabs-content">
		<?PHP
		$video_list = $this->video_model->lay_danh_sach_video_gioi_han("", "noibat", "", 5, 0);
		foreach($video_list as $video)
		{
			$img = "default.png";
			if(strlen($video["v_hinh"]) > 0)
				$img = $video["v_hinh"];
		?>
		<li>
			
			<div class="col-xs-5 col-sm-5 col-md-5 p-left0 p-right0">
				<a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html">
					<img src="<?php echo base_url();?>uploads/video/<?php echo $img;?>" alt="" class="img-responsive">
					<div class="link-icon"><i class="fa fa-play"></i></div>
				</a>
			</div>
			<div class="col-xs-7 col-sm-7 col-md-7 p-right0">						
				<a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html">
					<h5 class="text-title"><?php echo $video["v_ten"];?><h5>
				</a>						
			</div>
			
		</li>
		
		<?php
		}
		?>
		</ul>
	</div>
</div>
			