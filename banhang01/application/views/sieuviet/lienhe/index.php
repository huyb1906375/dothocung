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
				
				<li class="active"><a href="/lien-he.html">Liên hệ</a></li>
			</ul>
		</div>
	</div>
</div> 
<div class="main-shop-page pt-30 pb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 order-2 order-lg-1">
				<div class="sidebar">
					                         
					<?php $this->load->view('sieuviet/left-quangcao'); ?>
				</div>
			</div>

			<div class="col-lg-9 order-1 order-lg-2">
				<form name="frmDangNhap" method="Post" action="<?php echo base_url();?>lien-he.html" role="form" class="login-form" onsubmit="return checkDangNhap();">
					<div class="sidebar-post-content">
						<h3 class="sidebar-lg-title">LIÊN HỆ</h3>						
					</div>
					<div class="sidebar-desc mb-30">
						<?php echo chs_google_maps;?>
					</div>
					<div class="sidebar-desc mb-30">
						<p><a href="#"><strong><?php echo chs_don_vi;?></strong></a></p>
						<p><i class="lnr lnr-map-marker"></i> Địa chỉ: <?php echo chs_dia_chi;?></p>
						<p><i class="lnr lnr-phone-handset"></i> Điện thoại: <?php echo chs_dien_thoai;?></p>
						<p><i class="lnr lnr-envelope"></i> Email: <?php echo chs_email;?></p>
					</div>
					
				</form>	
			</div>
		</div>
	</div>
</div>


