<div class="footer-top">
	<div class="container">		              
		<div class="row">
			<?php
			$menu_list = $this->menu_model->lay_danh_sach_menu("0", "FooterMenu");
			foreach($menu_list as $menu)
			{
			?>
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="single-footer mb-sm-40">
					<h3 class="footer-title"><?php echo $menu["m_ten"];?></h3>
					<div class="footer-content">
						<ul class="footer-list">
							<?php
							$menu_list2 = $this->menu_model->lay_danh_sach_menu($menu["m_id"], "FooterMenu");
							foreach($menu_list2 as $menu2)
							{
							?>
							<li><a href="<?php echo $menu2["m_link"];?>"><?php echo $menu2["m_ten"];?></a></li>
							<?php
							}
							?>
							
						</ul>
					</div>
				</div>
			</div>
			<?php
			}
			?>
			
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="single-footer mb-sm-40">
					<h3 class="footer-title">LIÊN HỆ VỚI CHÚNG TÔI:</h3>
					<div class="footer-content">
						<ul class="footer-list address-content">
							<li><i class="lnr lnr-map-marker"></i> Địa chỉ: <?php echo chs_dia_chi;?></li>
							<li><i class="lnr lnr-envelope"></i><a href="#"> Email: <?php echo chs_email;?></a></li>
							<li>
								<i class="lnr lnr-phone-handset"></i> Điện thoại: <?php echo chs_dien_thoai;?>
							</li>
						</ul>
						<div class="payment mt-25 bdr-top pt-30">
							<ul class="social-footer">
								<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
								
								<li><a href="#"><img src="<?php echo base_url();?>public/img/icon/social-img1.png" alt="google play"></a></li>
								<li><a href="#"><img src="<?php echo base_url();?>public/img/icon/social-img2.png" alt="app store"></a></li>
								<!--<li><a href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=41727"><img src=" http://online.gov.vn/PublicImages/2015/08/27/11/20150827110756-dathongbao.png" width="150"></a></li>-->
							</ul>
						</div>                                   
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

