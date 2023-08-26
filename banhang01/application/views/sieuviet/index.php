<?php
if(!$this->session->userdata("dh_id"))
{
	$this->session->set_userdata('dh_id',time());
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<?php $this->load->view('sieuviet/head'); ?>
	</head>
    <body>		
		<div class="wrapper">
			<?php
			$lienket_list = $this->lienket_model->lay_danh_sach_lien_ket("noibat","top");
			foreach($lienket_list as $lienket)
			{
			?>
			<div class="popup_banner">
				<span class="popup_off_banner">×</span>
				<div class="banner_popup_area">
					<img src="<?php echo base_url();?>uploads/lienket/<?php echo $lienket["lk_hinh"];?>" alt="">
				</div>
			</div>
			<?php
			}
			?>
			
			<header>
				<?php $this->load->view('sieuviet/header'); ?>
			</header>
			<?php $this->load->view($site, $this->data);?>
			<footer class="off-white-bg2 pt-30 bdr-top pt-sm-30">
				<?php $this->load->view('sieuviet/footer'); ?>
			</footer>
			<?php $this->load->view('sieuviet/support'); ?>
			<div class="alert alert-success alert-dismissable message-box">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>	<i class="icon fa fa-check"></i> Thông báo!</h4>
				Đã cho sản phẩm vào giỏ hàng!
			</div>
		</div>
		<!-- Main Wrapper End Here -->
		<?php //$this->load->view('sieuviet/popup-quangcao'); ?>
		<!--
		<div class="quangcao-trai" >
			<img src="/uploads/quangcao.jpg"/>
		</div>
		<div class="quangcao-phai" >
			<img src="/uploads/quangcao.jpg"/>
		</div>
        -->
       <!-- Countdown js -->
		<script src="<?php echo base_url();?>public/js/jquery.countdown.min.js"></script>
		<!-- Mobile menu js -->
		<script src="<?php echo base_url();?>public/js/jquery.meanmenu.min.js"></script>
		<!-- ScrollUp js -->
		<script src="<?php echo base_url();?>public/js/jquery.scrollUp.js"></script>
		<!-- Nivo slider js -->
		<script src="<?php echo base_url();?>public/js/jquery.nivo.slider.js"></script>
		<!-- Fancybox js -->
		<script src="<?php echo base_url();?>public/js/jquery.fancybox.min.js"></script>
		<!-- Jquery nice select js -->
		<script src="<?php echo base_url();?>public/js/jquery.nice-select.min.js"></script>
		<!-- Jquery ui price slider js -->
		<script src="<?php echo base_url();?>public/js/jquery-ui.min.js"></script>
		<!-- Owl carousel -->
		<script src="<?php echo base_url();?>public/js/owl.carousel.min.js"></script>
		<!-- Bootstrap popper js -->
		<script src="<?php echo base_url();?>public/js/popper.min.js"></script>
		<!-- Bootstrap js -->
		<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
		<!-- Plugin js -->
		<script src="<?php echo base_url();?>public/js/plugins.js"></script>
		<!-- Main activaion js -->
		<script src="<?php echo base_url();?>public/js/main.js"></script>
		
		<!-- Load Facebook SDK for JavaScript -->
      <!-- Load Facebook SDK for JavaScript -->
      <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="103700638141137"
  logged_in_greeting="Chào bạn! Chúng tôi có thể giúp gì cho bạn!"
  logged_out_greeting="Chào bạn! Chúng tôi có thể giúp gì cho bạn!">
      </div>
    </body>
</html>