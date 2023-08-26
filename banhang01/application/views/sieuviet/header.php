<div class="header-top-area">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<ul class="list-inline pull-left">
						<!--<li><a href="mailto:<?php echo chs_email;?>"><i class="fa fa-envelope"></i> <?php echo chs_email;?></a></li>-->
						<li><a href="tel:<?php echo str_replace(" ","",chs_dien_thoai);?>"><i class="fa fa-phone"></i> <?php echo chs_dien_thoai;?></a></li>												
					</ul> 
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<ul class="list-inline pull-right">						
						<li><a href="#"><i class="fa fa-edit"></i> UY TÍN - CHẤT LƯỢNG - CHUYÊN NGHIỆP</a></li>
					</ul>                        
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('sieuviet/menu-mobile'); ?>
<div class="header-middle">
	<div class="container">
		<div class="row align-items-center">
			<div id="chir_logo" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
				<div class="mobile-menu d-block d-lg-none">
					<nav>
						<ul>
							<?php
							$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu("0");
							foreach($mainmenu_list as $mainmenu)
							{
								$sub_mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($mainmenu["cm_id"]);
								$num = count($sub_mainmenu_list);
								if($num > 0)
								{
							?>
							<li>
								<a href="<?php echo $mainmenu["cm_link"];?>" target="<?php echo $mainmenu["cm_loai_link"];?>"><?php echo $mainmenu["cm_ten"];?></a>
								<ul>
									<?php
									foreach($sub_mainmenu_list as $sub_mainmenu)
									{
									?>
									<li><a href="<?php echo $sub_mainmenu["cm_link"];?>" target="<?php echo $sub_mainmenu["cm_loai_link"];?>"><?php echo $sub_mainmenu["cm_ten"];?></a></li>
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
								<li>
									<a href="<?php echo $mainmenu["cm_link"];?>" target="<?php echo $mainmenu["cm_loai_link"];?>">
										<?php echo $mainmenu["cm_ten"];?>
									</a>
								</li>
							<?php
								}
							}
							?>
							
						</ul>
					</nav>
				</div>
				<p>
					<a href="/" title="Logo" class="logoHome"><img src="<?php echo base_url();?>uploads/<?php echo chs_logo;?>" alt="Logo"></a>
				</p>
			</div>
			<div id="chir_search_head" class="col-lg-5 col-md-7 col-sm-12 col-xs-12">
				<div class="chir_frm">
					<form id="frm_search_head" action="<?php echo base_url();?>tim-kiem-san-pham" method="post" onsubmit="return TimKiem();">
						<i class="fa fa-search"></i>
						<span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
						<input id="txtTuKhoa" name="txtTuKhoa" type="text" class="txtSearch ui-autocomplete-input" placeholder="Tìm kiếm..."  value="<?php if($this->session->userdata("tukhoa")) echo $this->session->userdata("tukhoa");?>">
						<button type="submit" name="btnTimKiem" class="chir_btn_sub tp_button">Tìm kiếm</button>
						
					</form>
				</div>
				
			</div>
			
			<script type="text/javascript">
				function TimKiem()
				{
					var tukhoa = $('#txtTuKhoa').val();
					if(tukhoa.length == 0)
					{
						alert("Bạn chưa nhập từ khóa!");
						return false;
					}
					return true;
				}
				$(function () {
				$("#txtTuKhoa").autocomplete({
					minLength: 1,
					source: '/ajax/ajax_tim_kiem_san_pham/',
					focus: function (event, ui) {
						$("#txtTuKhoa").val(ui.item.sp_ten);
						return false;
					},
					select: function (event, ui) {
						$("#txtTuKhoa").val('');
						gourl('/san-pham/'+ui.item.sp_slug+'.html');
						return false;
					},
					error: function (response) { alert(response.responseText); }
				}).keyup(function (e) {
					if (e.which === 13) {
						//cms_autocomplete_enter_sell();
						$("#txtTuKhoa").val('');
						$(".ui-menu-item").hide();
					}
				})
				.autocomplete("instance")._renderItem = function (ul, item) {
					return $("<li>").append("<img src='/uploads/sanpham/" + item.sp_hinh + "' align='left'/>")
									.append("<span><b>" + item.sp_ten + "</b><br/>" + formatCurrency(item.sp_gia_ban) + "</span>")
									
									.appendTo(ul);
				};
				});
			</script>
			<div id="chir_search_head" class="col-lg-4 col-md-5 col-sm-12 col-xs-12 hidden-sm hidden-xs fr scroll-down2">
				<div class="control-box">
					<ul class="ul-control-box">

						<li class="top-hotline">
							<a rel="nofollow" href="<?php echo base_url();?>tra-cuu-don-hang.html" title="Tra cứu đơn hàng">
								<span class="div-user-control control-4">
									<img src="<?php echo base_url();?>public/img/find_cart-512.png" alt="searchorder">
								</span>
								<span class="info">Tra cứu đơn hàng</span>
							</a>
						</li>
						
						<li class="top-cart-block ">
							<a rel="nofollow" href="<?php echo base_url();?>gio-hang.html" class="open-cart-popup" title="Giỏ hàng">
								<span class="div-user-control control-4" id="cartItemsCount"></span>
								<span class="info">Giỏ hàng</span>
								<span id="count_cart" class="header-cart-count CartCount"><?php echo $this->donhang_model->lay_so_san_pham_trong_gio($this->session->userdata("dh_id"));?></span>
							</a>
						</li>
						<?php
						if($this->session->userdata("user_id"))
						{
						?>
						<li class="dropdown">
							<a class="info" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<div class="div-user-control control-2"></div>
								<span><b><?php echo $this->session->userdata("user_ten");?></b></span>
							</a>
							<ul class="dropdown-menu info-user" aria-labelledby="dLabel">
								
								<li class="info"><a rel="nofollow" href="<?php echo base_url();?>thong-tin.html"><i class="fa fa-user" aria-hidden="true"></i> Thông tin cá nhân</a></li>
								<li class="info info-social social_fb"><a href="<?php echo base_url();?>don-hang.html"><i class="fa fa-history" aria-hidden="true"></i> Quản lý đơn hàng</a></li>
								<li class="info info-social"><a href="<?php echo base_url();?>san-pham-yeu-thich.html"><i class="fa fa-heart" aria-hidden="true"></i> Sản phẩm yêu thích</a></li>   
								<li class="info info-social"><a href="<?php echo base_url();?>doi-mat-khau.html"><i class="fa fa-refresh" aria-hidden="true"></i> Đổi mật khẩu</a></li>
								<li class="info"><a rel="nofollow" href="javascript:ChekLogout();" class="login"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a></li>
							</ul>
						</li>
						<?php
						}
						else
						{
						?>
						<li class="dropdown">
							<a class="info" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<div class="div-user-control control-2"></div>
								<span>Tài khoản </span>
							</a>
							<ul class="dropdown-menu info-user" aria-labelledby="dLabel">
								<li class="info"><a rel="nofollow" href="<?php echo base_url();?>dang-nhap.html" class="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
								<li class="info"><a rel="nofollow" href="<?php echo base_url();?>dang-ky.html"><i class="fa fa-registered" aria-hidden="true"></i> Đăng ký</a></li>
								                               
							</ul>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
			
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<!-- Header Middle End Here -->
<!-- Header Bottom Start Here -->
<div class="header-bottom  header-sticky" style="background: #2d9bcc">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-xl-3 col-lg-4 col-md-6 vertical-menu d-none d-lg-block">
				<span class="categorie-title">DANH MỤC SẢN PHẨM</span>
			</div>                       
			<div class="col-xl-9 col-lg-8 col-md-12 ">
				<nav class="d-none d-lg-block">
					<ul class="header-bottom-list d-flex">
						<?php
						$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu("0");
						foreach($mainmenu_list as $mainmenu)
						{
							$sub_mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($mainmenu["cm_id"]);
							$num = count($sub_mainmenu_list);
							if($num > 0)
							{
						?>
						<li id="<?php echo $mainmenu["cm_slug"];?>">
							<a href="<?php echo $mainmenu["cm_link"];?>"><?php echo $mainmenu["cm_ten"];?><i class="fa fa-angle-down"></i></a>
							<ul class="ht-dropdown">
								<?php
								foreach($sub_mainmenu_list as $sub_mainmenu)
								{
								?>
								<li><a href="<?php echo $sub_mainmenu["cm_link"];?>" target="<?php echo $sub_mainmenu["cm_loai_link"];?>"><?php echo $sub_mainmenu["cm_ten"];?></a></li>
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
							<li id="<?php echo $mainmenu["cm_slug"];?>">
								<a class="nav-link" href="<?php echo $mainmenu["cm_link"];?>" target="<?php echo $mainmenu["cm_loai_link"];?>">
									<?php echo $mainmenu["cm_ten"];?>
								</a>
							</li>
						<?php
							}
						}
						?>
						
					</ul>
				</nav>
				
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<!-- Navbar End -->
<script type="text/javascript">
	function ChekLogout() {
		if (confirm('Bạn có chắc muốn đăng xuất khỏi hệ thống không?' )){
		   window.location = '<?php echo base_url();?>auth/logout';
		}
	}
</script>

