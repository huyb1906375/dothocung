

    <!-- Header Area wrapper Starts -->
<header id="header-wrap">
  

	<?php 
		$this->load->view('mainmenu');
	?>

</header>
<!-- Header Area wrapper End -->

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
  <div class="container">
	<div class="row">         
	  <div class="col-md-12">
		<div class="breadcrumb-wrapper">
		<h2 class="product-title"><?php echo $row["bds_ten"];?></h2>
		  <ol class="breadcrumb">
			<li><a href="/">Trang chủ /</a></li>
			<li class="current"><a href="<?php echo base_url();?>loai-bat-dong-san/<?php echo $rowcm["cm_slug"];?>.html"><?php echo $rowcm["cm_ten"];?></a></li>
		  </ol>
		</div>
	  </div>
	</div>
  </div>
</div>
<!-- Page Header End -->  

    <!-- Ads Details Start -->
    <div class="section-padding">
      <div class="container">
        <!-- Product Info Start -->
        <div class="product-info row">
          <div class="col-lg-8 col-md-12 col-xs-12">
            <div class="ads-details-wrapper text-center">
              <div id="owl-demo" class="owl-carousel owl-theme">
			  <?php
			  $hinhbds_list = $this->batdongsan_model->lay_danh_sach_bat_dong_san_hinh($row["bds_id"]);
			  foreach($hinhbds_list as $hinhbds)
			  {
			  ?>
                <div class="item">
                  <div class="product-img">
                    <img class="img-fluid" src="/uploads/batdongsan/<?php echo $hinhbds["bdsh_url"];?>" alt="">
                  </div>
                  <!--<span class="price">$1,550</span>-->
                </div>
				<?php
			  }
			  ?>
                
              </div>
            </div>

            <div class="details-box">
              <div class="ads-details-info">
                <h2><?php echo $row["bds_ten"];?></h2>
                <div class="details-meta">
                  <span><a href="#"><i class="lni-alarm-clock"></i> <?php echo date('d/m/Y H:i:s',strtotime($row["bds_ngay_dang"]));?></a></span>
                  <span><a href="#"><i class="lni-eye"></i> <?php echo number_format($row["bds_luot_xem"] + 1);?></a></span>
				  <span><a href="#"><i class="lni-heart"></i> <?php echo number_format($row["bds_luot_thich"]);?></a></span>
                </div>
                <p class="mb-4"><?php echo $row["bds_mo_ta"];?></p>
				<p class="mb-2"><b>Địa chỉ:</b> <?php echo $row["bds_dia_chi"];?></p>
				<ul class="list-specification">
					<li><i class="lni-check-mark-circle"></i><b>Diện tích:</b> <?php echo $row["bds_dien_tich"];?></li>
					<li><i class="lni-check-mark-circle"></i><b>Giá:</b> <?php echo number_format($row["bds_gia_ban"]);?></li>
					<li><i class="lni-check-mark-circle"></i><b>Liên hệ:</b> <?php echo $row["bds_ten_lien_he"];?></li>
					<li><i class="lni-check-mark-circle"></i><b>Điện thoại:</b> <?php echo $row["bds_dien_thoai_lien_he"];?></li>
                </ul>
              </div>
              <div class="tag-bottom">
                <div class="float-left">
                  <ul class="advertisement">
                    <li>
                    <p><strong><i class="lni-folder"></i><a href="#"><?php echo $rowpx["px_ten"];?></a></strong> </p>
                    </li>
                    <li>
                    <p><strong><i class="lni-folder"></i><a href="#"><?php echo $rowqh["qh_ten"];?></a></strong> </p>
                    </li>
                  </ul>
                </div>
                <div class="float-right">
                  <div class="share">
                    <div class="social-link">  
                      <a class="facebook" data-toggle="tooltip" data-placement="top" title="facebook" href="#"><i class="lni-facebook-filled"></i></a>
                      <a class="twitter" data-toggle="tooltip" data-placement="top" title="twitter" href="#"><i class="lni-twitter-filled"></i></a>
                      <a class="linkedin" data-toggle="tooltip" data-placement="top" title="linkedin" href="#"><i class="lni-linkedin-fill"></i></a>
                      <a class="google" data-toggle="tooltip" data-placement="top" title="google plus" href="#"><i class="lni-google-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <!--Sidebar-->
            <aside class="details-sidebar">
				<div class="widget">
					<h4 class="widget-title"><b>THÔNG TIN LIÊN HỆ</b></h4>
					<div class="agent-inner">                  
						<div class="agent-title">
							<div class="agent-photo">
							  <a href="#"><img src="assets/img/productinfo/agent.jpg" alt=""></a>
							</div>
							<div class="agent-details">
							  <h3><a href="#"><?php echo $rownd["nd_ten"];?></a></h3>
							  <span><i class="lni-phone-handset"></i><?php echo $rownd["nd_email"];?></span>
							  
							</div>
						</div>

						<button class="btn btn-common col-md-12 mb-3">TRANG CÁ NHÂN</button>
						<button class="btn btn-default col-md-12">CHÁT VỚI NGƯỜI BÁN</button>
					</div>
				</div>
				<!-- Popular Posts widget -->
				<div class="widget">
					<h4 class="widget-title"><b>TIN CÙNG NGƯỜI ĐĂNG</b></h4>
					<ul class="posts-list">
						<?php
						$bdsnd_list = $this->batdongsan_model->lay_ds_bat_dong_san_cung_nguoi_dang($row["bds_nd_id"],$row["bds_id"],0, 5,0);
						foreach($bdsnd_list as $bdsnd)
						{
							$img = "default.png";
							if(strlen($bdsnd["bds_hinh"]) > 0)
								$img = $bdsnd["bds_hinh"];
							$gia = "Giá: ";
							if($bdsnd["bds_gia_ban"] == 0)
								$gia = $gia."liên hệ";
							else
							{
								if($bdsnd["bds_gia_ty"] > 0)
									$gia = $gia.$bdsnd["bds_gia_ty"]." tỷ ";
								if($bdsnd["bds_gia_trieu"] > 0)
									$gia = $gia.$bdsnd["bds_gia_trieu"]." triệu";
								else
								{
									if($bdsnd["bds_gia_ty"] == 0)
										$gia = $bdsnd["bds_gia_ban"]." đồng";
									else $gia.$bdsnd["bds_gia_ban"]." đồng";
								}
							}
						?>
						<li>
							<div class="widget-thumb">
								<a href="#"><img src="/uploads/batdongsan/<?php echo $img;?>" alt="" style="height: 90px; width: 90px;" /></a>
							</div>
							<div class="widget-content">
								<h4 class="text-justify"><a href="/bat-dong-san/<?php echo $bdsnd["bds_slug"];?>.html"><?php echo html_escape(character_limiter($bdsnd["bds_ten"], 45, '...')); ?></a></h4>
								<div class="meta-tag">
									<span>
										<a href="#"><i class="lni-alarm-clock"></i> <?php echo date('d/m/Y',strtotime($bdsnd["bds_ngay_dang"]));?></a>
									</span>
									<span>
										<a href="#"><i class="lni-eye"></i> <?php echo number_format($bdsnd["bds_luot_xem"]);?></a>
									</span>
									
								</div>
								<h4 class="price"><?php echo $gia;?></h4>
							</div>
							<div class="clearfix"></div>
						</li>
						<?php
						}
						?>
					</ul>
				</div>

            </aside>
            <!--End sidebar-->
          </div>
        </div>
        <!-- Product Info End -->

      </div>    
    </div>
    <!-- Ads Details End -->

<section class="featured-lis section-padding" >
  <div class="container">
	<div class="row">
	  <div class="col-12 text-center">
		<div class="heading">
		  <h1 class="section-title">BẤT ĐỘNG SẢN CÙNG CHUYÊN MỤC</h1>
		</div>
	  </div>
	  <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
		<div id="new-products" class="owl-carousel owl-theme">
			<?php
			$bds_list = $this->batdongsan_model->lay_ds_bat_dong_san_cung_chuyen_muc($row["bds_cm_id"],$row["bds_id"],0);
			foreach($bds_list as $bds)
			{
				$img = "default.png";
				if(strlen($bds["bds_hinh"]) > 0)
					$img = $bds["bds_hinh"];
				$gia = "Giá: ";
				if($bds["bds_gia_ban"] == 0)
					$gia = $gia."liên hệ";
				else
				{
					if($bds["bds_gia_ty"] > 0)
						$gia = $gia.$bds["bds_gia_ty"]." tỷ ";
					if($bds["bds_gia_trieu"] > 0)
						$gia = $gia.$bds["bds_gia_trieu"]." triệu";
					else
					{
						if($bds["bds_gia_ty"] == 0)
							$gia = $bds["bds_gia_ban"]." đồng";
						else $gia.$bds["bds_gia_ban"]." đồng";
					}
				}
			?>
			  <div class="item">
				<div class="product-item">
				  <div class="carousel-thumb">
					<img class="img-fluid" src="/uploads/batdongsan/<?php echo $img;?>" alt=""> 
					<div class="overlay">
					  <div>
						<a class="btn btn-common" href="/bat-dong-san/<?php echo $bds["bds_slug"];?>.html">Xem chi tiết</a>
					  </div>
					</div>
					<?php
					if($bds["bds_noi_bat"] == 1)
					{
					?>
					<div class="btn-product bg-sale">
					  <a href="#">VIP</a>
					</div> 
					<?php
					}
					?>
					<span class="price"><?php echo $gia;?></span>
				  </div>   
				  <div class="product-content-inner">
					<div class="product-content">
					  <h3 class="product-title"><a href="/bat-dong-san/<?php echo $bds["bds_slug"];?>.html"><?php echo $bds["bds_ten"];?></a></h3>
					  <span><i class="lni-folder"></i> <?php echo $bds["cm_ten"];?></span>
					</div>
					<div class="card-text clearfix">
						<div class="float-left">
							<span class="icon-wrap">
								<a href="#" title="Ngày đăng"><i class="lni-alarm-clock"></i> <?php echo date('d/m/Y H:i',strtotime($bds["bds_ngay_dang"]));?></a>
								<a href="" title="Lượt xem"><i class="lni-eye"></i> <?php echo number_format($bds["bds_luot_xem"]);?></a>							
								
										
									
							</span>
							<!--
							<span class="count-review">
							(12 Review)
							</span>
							<ul class="icon-wrap">
								<li class="li-eye">515</li>
								<li class="li-heart">0</li>
								<li class="li-bookmark"><a href="#" style="color:#888;" target="_blank">22</a></li>
							</ul>
							-->
						</div>
						<div class="float-right">
							<a class="address" href="#"><i class="lni-map-marker"></i> <?php echo $bds["qh_ten"] ;?></a>
						</div>
					</div>
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

