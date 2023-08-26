<div class="main-page-banner home-3">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<?php $this->load->view('sieuviet/menusanpham'); ?>
			</div>
		</div>
	</div>          
</div>
<div class="breadcrumb-area mt-30">
	<div class="container">
		<div class="breadcrumb">
			<ul class="d-flex align-items-center">
				<li><a href="<?php echo base_url();?>">Trang chủ</a></li>
				<?php
				if($chuyenmuc["cm_id_parent"] != "0")
				{
					$cmparent = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($chuyenmuc["cm_id_parent"]);
				?>
				<li><a href="<?php echo base_url();?>chuyen-muc/<?php echo $cmparent["cm_slug"];?>.html"><?php echo $cmparent["cm_ten"];?></a></li>
				<?php
				}
				?>
				<li class="active"><a href="<?php echo base_url();?>chuyen-muc/<?php echo $chuyenmuc["cm_slug"];?>.html"><?php echo $chuyenmuc["cm_ten"];?></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="main-shop-page pt-30 pb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 order-2 order-lg-1 hidden-xs hidden-sm hidden-md">
				<div class="sidebar">
					
					<?php
					$tinmoi_list = $this->baiviet_model->lay_danh_sach_bai_viet_moi("",5,0);
					$total = count($tinmoi_list);					
					if($total > 0)
					{
					?>
					<div class="top-new mb-30">
						<h3 class="sidebar-title">TIN MỚI</h3>
						<div class="side-product-active owl-carousel">
							
							<div class="side-pro-item">
								<?php
								foreach($tinmoi_list as $tinmoi)
								{	
									$img = "default.png";
									if(strlen($tinmoi["bv_hinh"]) > 0)
										$img = $tinmoi["bv_hinh"];
								?>
								<div class="single-product single-product-sidebar pl-15 pr-15">
									<a href="<?php echo base_url();?>tin-tuc/<?php echo $tinmoi["bv_slug"];?>.html" title="<?php echo $tinmoi["bv_ten"];?>">
									<img align="left" style="width: 100px; heigh: 80px;" class="primary-img" src="<?php echo base_url();?>uploads/baiviet/<?php echo $img;?>" alt="<?php echo $tinmoi["bv_ten"];?>">
									<h4><?php echo $tinmoi["bv_ten"];?></h4>
									</a>
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
					<?php $this->load->view('sieuviet/left-quangcao'); ?>
				</div>
			</div>
			<div class="col-lg-9 order-1 order-lg-2">
				<div class="single-sidebar-desc mb-all-30">
					
					<div class="sidebar-post-content">
						<h3 class="sidebar-lg-title"><?php echo $tintuc["bv_ten"];?></h3>
						<ul class="post-meta d-sm-inline-flex">
							<li><i class="fa fa-clock-o"></i> <?php echo date('d/m/Y H:i',strtotime($tintuc["bv_ngay_dang"]));?></li>
							<li><i class="fa fa-eye"></i> <?php echo number_format($tintuc["bv_luot_xem"]);?></li>
						</ul>
					</div>
					<div class="sidebar-desc mb-30">
						<?php echo $tintuc["bv_chi_tiet"];?>
					</div>
					<?php
					$list = $this->baiviet_model->lay_danh_sach_bai_viet_cung_chuyen_muc($chuyenmuc["cm_id"], $tintuc["bv_id"], 0, 0);
					if(count($list) > 0)
					{
						$img = "default.png";
						if(strlen($tintuc["bv_hinh"]) > 0)
							$img = $tintuc["bv_hinh"];
					?>
					<div class="sidebar-post-content">
						<h3 class="sidebar-lg-title">TIN CÙNG CHUYÊN MỤC:</h3>
						
					</div>
					<div class="row">
						<?php
						$list = $this->baiviet_model->lay_danh_sach_bai_viet_cung_chuyen_muc($chuyenmuc["cm_id"], $tintuc["bv_id"], 0, 0);
						foreach($list as $tintuc)
						{
							$img = "default.png";
							if(strlen($tintuc["bv_hinh"]) > 0)
								$img = $tintuc["bv_hinh"];
						?>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="news-item">
								<a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html" title="<?php echo $tintuc["bv_ten"];?>">
								<img align="left" style="width: 100px; heigh: 80px;" class="primary-img" src="<?php echo base_url();?>uploads/baiviet/<?php echo $img;?>" alt="<?php echo $tintuc["bv_ten"];?>">
								<h4><?php echo $tintuc["bv_ten"]; ?></h4>
								</a>
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
	<!-- Container End -->
</div>
