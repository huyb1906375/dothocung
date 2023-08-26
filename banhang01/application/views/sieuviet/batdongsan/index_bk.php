

    <!-- Header Area wrapper Starts -->
<header id="header-wrap">
  

	<?php 
		$this->load->view('topmenu');
	?>

</header>
<!-- Header Area wrapper End -->

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
  <div class="container">
	<div class="row">         
	  <div class="col-md-12">
		<div class="breadcrumb-wrapper">
		  <h2 class="product-title">Details</h2>
		  <ol class="breadcrumb">
			<li><a href="#">Home /</a></li>
			<li class="current">Details</li>
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
                  <span><a href="#"><i class="lni-alarm-clock"></i> 7 Jan, 10:10 pm</a></span>
                  <span><a href="#"><i class="lni-map-marker"></i>  New York</a></span>
                  <span><a href="#"><i class="lni-eye"></i> 299 View</a></span>
                </div>
                <p class="mb-4"><?php echo $row["bds_mo_ta"];?></p>
				
              </div>
              <div class="tag-bottom">
                <div class="float-left">
                  <ul class="advertisement">
                    <li>
                    <p><strong><i class="lni-folder"></i> Categories:</strong> <a href="#">Electronics</a></p>
                    </li>
                    <li>
                    <p><strong><i class="lni-archive"></i> Condition:</strong> New</p>
                    </li>
                    <li>
                    <p><strong><i class="lni-package"></i> Brand:</strong> <a href="#">Apple</a></p>
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
			<div class="detail-box">
				<div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
					<div id="new-products" class="owl-carousel owl-theme">
						<?php
						$bds_list = $this->batdongsan_model->lay_ds_bat_dong_san_cung_chuyen_muc($row["bds_cm_id"],$row["bds_id"]);
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
								<div class="btn-product bg-sale">
								  <a href="#">VIP</a>
								</div> 
								<span class="price"><?php echo $gia;?></span>
							  </div>   
							  <div class="product-content-inner">
								<div class="product-content">
								  <h3 class="product-title"><a href="/bat-dong-san/<?php echo $bds["bds_slug"];?>.html"><?php echo $bds["bds_ten"];?></a></h3>
								  <span><?php echo $bds["cm_ten"];?></span>
								</div>
								<div class="card-text clearfix">
									<div class="float-left">
										<span class="icon-wrap">
											<a href="" title="Lượt xem"><i class="lni-eye"></i> <?php echo number_format($bds["bds_luot_xem"]);?></a>							
											<a href="" title="Lượt thích"><i class="lni-heart"></i></a>
											<a href="" title="Lưu vào danh sách yêu thích"><i class="lni-bookmark"></i></a>
										</span>
									</div>
									<div class="float-right">
										<a class="address" href="#"><i class="lni-map-marker"></i> <?php echo $bds["px_ten"]." - ".$bds["qh_ten"] ;?></a>
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
          <div class="col-lg-4 col-md-6 col-xs-12">
            <!--Sidebar-->
            <aside class="details-sidebar">
              <div class="widget">
                <h4 class="widget-title">Ad Posted By</h4>
                <div class="agent-inner">
                  <div class="mb-4">
                     <object style="border:0; height: 230px; width: 100%;" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d34015.943594576835!2d-106.43242624069771!3d31.677719472407432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75d90e99d597b%3A0x6cd3eb9a9fcd23f1!2sCourtyard+by+Marriott+Ciudad+Juarez!5e0!3m2!1sen!2sbd!4v1533791187584"></object>
                  </div>
                  <div class="agent-title">
                    <div class="agent-photo">
                      <a href="#"><img src="assets/img/productinfo/agent.jpg" alt=""></a>
                    </div>
                    <div class="agent-details">
                      <h3><a href="#">Amanda zweerink</a></h3>
                      <span><i class="lni-phone-handset"></i>(123) 123-456</span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Your Email">
                  <input type="text" class="form-control" placeholder="Your Phone">
                  <p>I'm interested in this property [ID 123456] and I'd like to know more details.</p>
                  <button class="btn btn-common fullwidth mt-4">Send Message</button>
                </div>
              </div>
              <!-- Popular Posts widget -->
              <div class="widget">
                <h4 class="widget-title">More Ads From Seller</h4>
                <ul class="posts-list">
                  <li>
                    <div class="widget-thumb">
                      <a href="#"><img src="assets/img/details/img1.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                      <h4><a href="#">Little Harbor Yacht 38</a></h4>
                      <div class="meta-tag">
                        <span>
                          <a href="#"><i class="lni-user"></i> Smith</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-map-marker"></i> New Your</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-tag"></i> Radio</a>
                        </span>
                      </div>
                      <h4 class="price">$480.00</h4>
                    </div>
                    <div class="clearfix"></div>
                  </li>
                  <li>
                    <div class="widget-thumb">
                      <a href="#"><img src="assets/img/details/img2.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                      <h4><a href="#">Little Harbor Yacht 38</a></h4>
                      <div class="meta-tag">
                        <span>
                          <a href="#"><i class="lni-user"></i> Smith</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-map-marker"></i> New Your</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-tag"></i> Radio</a>
                        </span>
                      </div>
                      <h4 class="price">$480.00</h4>
                    </div>
                    <div class="clearfix"></div>
                  </li>
                  <li>
                    <div class="widget-thumb">
                      <a href="#"><img src="assets/img/details/img3.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                      <h4><a href="#">Little Harbor Yacht 38</a></h4>
                      <div class="meta-tag">
                        <span>
                          <a href="#"><i class="lni-user"></i> Smith</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-map-marker"></i> New Your</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-tag"></i> Radio</a>
                        </span>
                      </div>
                      <h4 class="price">$480.00</h4>
                    </div>
                    <div class="clearfix"></div>
                  </li>
                  <li>
                    <div class="widget-thumb">
                      <a href="#"><img src="assets/img/details/img4.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                      <h4><a href="#">Little Harbor Yacht 38</a></h4>
                      <div class="meta-tag">
                        <span>
                          <a href="#"><i class="lni-user"></i> Smith</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-map-marker"></i> New Your</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-tag"></i> Radio</a>
                        </span>
                      </div>
                      <h4 class="price">$480.00</h4>
                    </div>
                    <div class="clearfix"></div>
                  </li>
                  <li>
                    <div class="widget-thumb">
                      <a href="#"><img src="assets/img/details/img5.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                      <h4><a href="#">Little Harbor Yacht 38</a></h4>
                      <div class="meta-tag">
                        <span>
                          <a href="#"><i class="lni-user"></i> Smith</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-map-marker"></i> New Your</a>
                        </span>
                        <span>
                          <a href="#"><i class="lni-tag"></i> Radio</a>
                        </span>
                      </div>
                      <h4 class="price">$480.00</h4>
                    </div>
                    <div class="clearfix"></div>
                  </li>
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

    <!-- Subscribe Section Start -->
    <section class="subscribes section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="subscribes-inner">
              <div class="icon">
                <i class="lni-pointer"></i>
              </div>
              <div class="sub-text">
                <h3>Subscribe to Newsletter</h3>
                <p>and receive new ads in inbox</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <form>
              <div class="subscribe">
                <input class="form-control" name="EMAIL" placeholder="Enter your Email" required="" type="email">
                <button class="btn btn-common" type="submit">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Subscribe Section End -->

