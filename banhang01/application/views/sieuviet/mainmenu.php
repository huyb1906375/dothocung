<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
	<div class="container">
	  <div class="theme-header clearfix">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				<span class="lni-menu"></span>
				<span class="lni-menu"></span>
				<span class="lni-menu"></span>
			</button>
			<a href="/" class="navbar-brand"><img src="/uploads/<?php echo chs_logo;?>" alt=""></a>
		</div>
		<div class="collapse navbar-collapse" id="main-navbar">
		  <ul class="navbar-nav mr-auto w-100 justify-content-left">
			<?php
			$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu("0");
			foreach($mainmenu_list as $mainmenu)
			{
				$sub_mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($mainmenu["cm_id"]);
				$num = count($sub_mainmenu_list);
				if($num > 0)
				{
			?>
			<li id="<?php echo $mainmenu["cm_slug"];?>" class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle" href="<?php echo $mainmenu["cm_slug"];?>.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo $mainmenu["cm_ten"];?> <i class="lni-chevron-down"></i>
				</a>
				<ul class="dropdown-menu">
					<?php
					foreach($sub_mainmenu_list as $sub_mainmenu)
					{
					?>
					<li><a class="dropdown-item" href="<?php echo $sub_mainmenu["cm_link"];?>.html" target="<?php echo $sub_mainmenu["cm_loai_link"];?>"><?php echo $sub_mainmenu["cm_ten"];?></a></li>
					<?php
					}
					?>
				</ul>
			</li>
			<?php
				}
				else
				{
			?>
				<li id="<?php echo $mainmenu["cm_slug"];?>" class="nav-item">
					<a class="nav-link" href="<?php echo $mainmenu["cm_link"];?>.html" target="<?php echo $mainmenu["cm_loai_link"];?>">
						<?php echo $mainmenu["cm_ten"];?>
					</a>
				</li>
			<?php
				}
			}
			?>
			<!--
			<li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="lnr lnr-user"></i> My Account
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item active" href="account-home.html"><i class="lnr lnr-home"></i> Account Home</a></li>
                    <li><a class="dropdown-item" href="account-myads.html"><i class="lnr lnr-cart"></i> My Ads</a></li>
                    <li><a class="dropdown-item" href="account-favourite-ads.html"><i class="lnr lnr-heart"></i> Favourite ads</a></li>
                    <li><a class="dropdown-item" href="account-archived-ads.html"><i class="lnr lnr-file-add"></i> Archived</a></li>
                    <li><a class="dropdown-item" href="login.html"><i class="lnr lnr-lock"></i> Log In</a></li>
                    <li><a class="dropdown-item" href="signup.html"><i class="lnr lnr-user"></i> Signup</a></li>
                    <li><a class="dropdown-item" href="forgot-password.html"><i class="lnr lnr-sync"></i> Forgot Password</a></li>
                    <li><a class="dropdown-item" href="account-close.html"><i class="lnr lnr-cross"></i>Account close</a></li>
                  </ul>
                </li>
				-->
		  </ul>
		  <div class="header-top-right float-right">
			<?php
			if($this->session->userdata("nd_id"))
			{
			?>
			 <ul class="navbar-nav mr-auto w-100 justify-content-left">
			<li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="lnr lnr-user"></i> <?php echo $this->session->userdata("nd_ten");?>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="login.html"><i class="lnr lnr-lock"></i> Trang cá nhân</a></li>
                    
                    <li><a class="dropdown-item" href="forgot-password.html"><i class="lnr lnr-sync"></i> Đổi mật khẩu</a></li>
                    <li><a class="dropdown-item" href="javascript:ChekLogout();"><i class="lnr lnr-cross"></i>Đăng xuất</a></li>
                  </ul>
                </li>
				</ul>
			<?php
			}
			else
			{
			?>
			<a href="<?php echo base_url();?>dang-nhap.html" class="header-top-button"><i class="lni-lock"></i> Đăng nhập</a> |
			<a href="<?php echo base_url();?>dang-ky.html" class="header-top-button"><i class="lni-pencil"></i> Đăng ký</a>
			<?php
			}
			?>
		  </div>
		  <div class="post-btn">
			<a class="btn btn-common" href="<?php echo base_url();?>dang-tin.html"><i class="lni-pencil-alt"></i> Đăng tin</a>
		  </div>
		</div>
	  </div>
	</div>
	<div class="mobile-menu" data-logo="/uploads/<?php echo chs_logo_mobile;?>"></div>
</nav>
<!-- Navbar End -->
<script type="text/javascript">
	function ChekLogout() {
		if (confirm('Bạn có chắc muốn đăng xuất khỏi hệ thống không?' )){
		   window.location = '<?php echo base_url();?>user/logout';
		}
	}
</script>