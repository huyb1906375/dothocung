<!-- START POST BLOCK SECTION -->
<section class="slider-inner m-top0">
	<div class="container xam" style="padding-top: 10px; padding-bottom: 10px;">
		<div class="row thm-margin">
			<div class="col-xs-12 col-sm-6 col-md-6 thm-padding">
				<div class="slider-wrapper">
					<div id="owl-slider" class="owl-carousel owl-theme">
						<?PHP
						$video_list = $this->video_model->lay_danh_sach_video_gioi_han($rowcm["cm_id"], "xuatban", "", 5, 0);
						foreach($video_list as $video)
						{
							$img = "default.png";
							if(strlen($video["v_hinh"]) > 0)
								$img = $video["v_hinh"];
						?>
						<!-- Slider item one -->
						<div class="item">
							<div class="slider-post post-height-1">
								<a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html" class="news-image"><img src="<?php echo base_url();?>uploads/video/<?php echo $img;?>" alt="" class="img-responsive"></a>
								<div class="post-text">
									<span class="post-category"><?php echo $video["cm_ten"];?></span>
									<h2><a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html"><?php echo $video["v_ten"];?></a></h2>
									<ul class="authar-info">
										<li class="authar"><a href="#">by david hall</a></li>
										<li class="date"><?php echo date('d/m/Y H:i',strtotime($video["v_ngay_dang"]));?></li>
										<li class="view"><a href="#"><?php echo number_format($video["v_luot_xem"]);?> lượt xem</a></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /.Slider item one -->
						<?php
						}
						?>
						
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 thm-padding">
				<div class="row slider-right-post thm-margin">
				<?PHP
				$video_list = $this->video_model->lay_danh_sach_video_gioi_han($rowcm["cm_id"], "xuatban", "", 4, 5);
				foreach($video_list as $video)
				{
					$img = "default.png";
					if(strlen($video["v_hinh"]) > 0)
						$img = $video["v_hinh"];
				?>

					<div class="col-xs-6 col-sm-6 col-md-6 thm-padding">
						<div class="slider-post post-height-2">
							<a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html" class="news-image"><img src="<?php echo base_url();?>uploads/video/<?php echo $img;?>" alt="" class="img-responsive"></a>
							<div class="post-text">
								<span class="post-category"><?php echo $video["cm_ten"];?></span>
								<h4><a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html"><?php echo $video["v_ten"];?></a></h4>
								<ul class="authar-info">
									<li class="authar hidden-xs hidden-sm"><a href="#">by david hall</a></li>
									<li class="hidden-xs"><?php echo date('d/m/Y H:i',strtotime($video["v_ngay_dang"]));?></li>
									<li class="view hidden-xs hidden-sm"><a href="#"><?php echo number_format($video["v_luot_xem"]);?> lượt xem</a></li>
								</ul>
							</div>
						</div>
					</div>
					
				<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END OF /. POST BLOCK SECTION -->