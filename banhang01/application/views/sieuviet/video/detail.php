<!-- START PAGE TITLE --> 
<div class="page-title m-bottom0">
	<div class="container xam">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<h1><strong class="text-upper c-white"><a href="<?php echo base_url();?>chuyen-muc-video/<?php echo $rowcm["cm_slug"];?>"><?php echo $rowcm["cm_ten"];?></a></strong></h1>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<ol class="breadcrumb text-upper no-backgroud no-border">					
					<li><a href="/">Trang chủ</a></li>
					<?php
					if($rowcm["cm_id_parent"] != "0")
					{
						$cmparent = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($rowcm["cm_id_parent"]);
					?>
					<li><a href="<?php echo base_url();?>chuyen-muc-video/<?php echo $cmparent["cm_slug"];?>"><?php echo $cmparent["cm_ten"];?></a></li>
					<?php
					}
					?>
					<li class="current"><a href="<?php echo base_url();?>chuyen-muc-video/<?php echo $rowcm["cm_slug"];?>"><?php echo $rowcm["cm_ten"];?></a></li>					 					
				</ol>
			</div>
		</div>
	</div>
</div>
<!-- END OF /. PAGE TITLE --> 
<div class="container xam p-top10">
	<div class="row row-m">
		<!-- START MAIN CONTENT -->
		<div class="col-sm-8 col-p  main-content">
			<div class="theiaStickySidebar">
				<div class="post_details_inner">
					<div class="post_details_block">
						
						<h2><?php echo $row["v_ten"];?></h2>
						<ul class="authar-info">
							
							<li><i class="ti-timer"></i> <?php echo date('d/m/Y H:i',strtotime($row["v_ngay_dang"]));?></a></li>
							<li><i class="ti-eye"></i> <?php echo number_format($row["v_luot_xem"]);?> lượt xem</li>
						</ul>
						<?php
						if(strlen($row["v_link"]) > 0)
						{
						?>
						<figure class="social-icon">
							<p><?php echo $row["v_link"];?></p>
							<div>
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="hidden-xs"><i class="fa fa-linkedin"></i></a>
								<a href="#" class="hidden-xs"><i class="fa fa-pinterest-p"></i></a>
							</div>			
						</figure>
						<?php
						}
						?>
						<p><?php echo $row["v_chi_tiet"];?></p>
					</div>
					
				</div>
				<!-- START RELATED ARTICLES -->
				<?PHP
				$video_list = $this->video_model->lay_danh_sach_video_cung_chuyen_muc($row["v_cm_id"], $row["v_id"], 0, 0);
				if(count($video_list ) > 0)
				{
				?>
				<div class="post-inner post-inner-2">
					<!--post header-->
					<div class="post-head">
						<h2 class="title"><strong>VIDEO CÙNG CHUYÊN MỤC</strong></h2>
					</div>
					<!-- post body -->
					<div class="post-body">
						<div id="post-slider" class="owl-carousel owl-theme">
							<!-- item one -->
							<div class="item">
								<div class="news-grid-2">
									<div class="row row-margin">
										<?PHP
						
										foreach($video_list as $video)
										{
											$img = "default.png";
											if(strlen($video["v_hinh"]) > 0)
												$img = $video["v_hinh"];
										?>
										<div class="col-xs-12 col-sm-4 col-md-4 col-padding"  style="height: 250px;">
											<div class="grid-item">
												<div class="grid-item-img">
													<a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html">
														<img src="<?php echo base_url();?>uploads/video/<?php echo $img;?>" class="img-responsive" alt="" style="height: 150px;">
														
														<div class="link-icon"><i class="fa fa-play"></i></div>
														
													</a>
												</div>
												<h5><a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html" class="title"><?php echo $video["v_ten"];?></a></h5>
												<ul class="authar-info">
													<li><i class="lni-calendar"></i> <?php echo date('d/m/Y H:i',strtotime($video["v_ngay_dang"]));?></li>
													<li class="hidden-sm"><i class="lni-eye"></i> <?php echo number_format($video["v_luot_xem"]);?></a></li>
												</ul>
											</div>
										</div>
										<?php
										}
										?>
										
									</div>
								</div>
							</div>
							<!-- item two -->
							
						</div>
					</div>
					<!-- Post footer -->
					<div class="post-footer">
						<div class="row thm-margin">
							<div class="col-xs-12 col-sm-8 col-md-9 thm-padding">
								<a href="#" class="more-btn">More popular posts</a>
							</div>
							<div class="hidden-xs col-sm-4 col-md-3 thm-padding">
								<div class="social">
									<ul>
										<li>
											<div class="share transition">
												<a href="#" target="_blank" class="ico fb"><i class="fa fa-facebook"></i></a>
												<a href="#" target="_blank" class="ico tw"><i class="fa fa-twitter"></i></a>
												<a href="#" target="_blank" class="ico gp"><i class="fa fa-google-plus"></i></a>
												<a href="#" target="_blank" class="ico pin"><i class="fa fa-pinterest"></i></a>
												<i class="ti-share ico-share"></i>
											</div> 
										</li>
										<li><a href="#"><i class="ti-heart"></i></a></li>
										<li><a href="#"><i class="ti-twitter"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				 <?php
				}
				?>
				<!-- END OF /. RELATED ARTICLES -->
				
			</div>
		</div>
		<!-- END OF /. MAIN CONTENT -->
		<!-- START SIDE CONTENT -->
		<div class="col-sm-4 col-p rightSidebar">
			<div class="theiaStickySidebar">
				<?php 
				$this->load->view('site/right-videonoibat'); 
				$this->load->view('site/right-tintuc'); 
				$this->load->view('site/right-quangcao'); 
				?>
			</div>
		</div>
		<!-- END OF /. SIDE CONTENT -->
	</div>
</div>
<style type="text/css">
iframe
{
	
	width: 100%;
	
	height: 400px;
	display: block;
	margin-bottom: 3px;
}
</style>