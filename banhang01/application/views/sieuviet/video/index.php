<!-- START PAGE TITLE --> 
<div class="page-title m-bottom0">
	<div class="container xam">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<h1><strong class="text-upper c-white"><a href="<?php echo base_url();?>chuyen-muc/<?php echo $rowcm["cm_slug"];?>"><?php echo $rowcm["cm_ten"];?></a></strong></h1>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<ol class="breadcrumb text-upper no-backgroud no-border">					
					<li><a href="/">Trang chủ</a></li>
					<?php
					if($rowcm["cm_id_parent"] != "0")
					{
						$cmparent = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($rowcm["cm_id_parent"]);
					?>
					<li><a href="<?php echo base_url();?>chuyen-muc/<?php echo $cmparent["cm_slug"];?>"><?php echo $cmparent["cm_ten"];?></a></li>
					<?php
					}
					?>
					<li class="current"><a href="<?php echo base_url();?>chuyen-muc/<?php echo $rowcm["cm_slug"];?>"><?php echo $rowcm["cm_ten"];?></a></li>					 					
				</ol>
			</div>
		</div>
	</div>
</div>
<!-- END OF /. PAGE TITLE --> 

<div class="container xam">
	<div class="row row-m">
		<!-- START MAIN CONTENT -->
		<div class="col-sm-8 col-p main-content">
			<div class="theiaStickySidebar">
				<?php
				$cat_main_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($rowcm["cm_id"], "chuyen-muc-video", "xuatban");
				if(count($cat_main_list) > 0)
				{
				$num_cat = 1;
				foreach($cat_main_list as $cat_main)
				{
					$video_list = $this->video_model->lay_danh_sach_video_gioi_han($cat_main["cm_id"], "xuatban", "", 6, 0);
					$total = count($video_list);
					if($total > 0)
					{
				?>
				<div class="post-inner">
					<div class="post-head">
						<a href="<?php echo base_url();?>chuyen-muc-video/<?php echo $cat_main["cm_slug"];?>"><h2 class="title"><strong><?php echo $cat_main["cm_ten"];?></strong></h2></a>
					</div>
					<div class="post-body">
						<div id="post-slider<?php if($num_cat > 1) echo "-".$num_cat;?>" class="owl-carousel owl-theme">
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
										<div class="col-xs-12 col-sm-4 col-md-4 col-padding">
											<div class="grid-item">
												<div class="grid-item-img">
													<a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html">
														<img src="<?php echo base_url();?>uploads/video/<?php echo $img;?>" class="img-responsive" alt="" style="height: 140px;">
														
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
					
				</div>
				<?php
					$num_cat = $num_cat + 1;
					}
					
				}
				
				}
				else
				{
					$video_list = $this->video_model->lay_danh_sach_video_gioi_han($rowcm["cm_id"], "xuatban", "", 0, 0);
					if(count($video_list)>0)
					{
				?>
				<div class="post-inner">
					<!--post header
					<div class="post-head">
						<h2 class="title"><strong>Latest</strong> articles</h2>
					</div>
					-->
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
										<div class="col-xs-6 col-sm-4 col-md-4 col-padding" style="height: 250px;">
											<div class="grid-item">
												<div class="grid-item-img">
													<a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html">
														<img src="<?php echo base_url();?>uploads/video/<?php echo $img;?>" class="img-responsive" alt="" style="height: 150px;">
														
														<div class="link-icon"><i class="fa fa-play"></i></div>
														
													</a>
												</div>
												<h5><a href="<?php echo base_url();?>video/<?php echo $video["v_slug"];?>.html" class="title"><?php echo $video["v_ten"];?></a></h5>
												<ul class="authar-info">
													<li><i class="ti-timer"></i> <?php echo date('d/m/Y H:i',strtotime($video["v_ngay_dang"]));?></li>
													<li class="hidden-sm"><i class="ti-eye"></i> <?php echo number_format($video["v_luot_xem"]);?></a></li>
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
						
					</div> <!-- /. post body -->
					
				</div>				
				<?php
					}
				}
				?>
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
