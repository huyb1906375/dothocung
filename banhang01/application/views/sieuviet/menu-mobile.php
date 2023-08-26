
<div id='header' class='header'>

    <div class="menu-left menu-hide">
        <span></span> 
        <ul class="menu">			
			
			
			<?php
			$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","danh-muc","xuatban");
			foreach($mainmenu_list as $mainmenu)
			{
			?>
				<li><a href="<?php echo $mainmenu["cm_link"];?>" target="<?php echo $mainmenu["cm_loai_link"];?>"><?php echo $mainmenu["cm_ten"];?></a>
				<?php
				$sub_mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($mainmenu["cm_id"],"danh-muc","xuatban");
				if(count($sub_mainmenu_list) > 0)
				{
				?>
					<span class="expand submenu"></span>
					<ul>
					<?php
					foreach($sub_mainmenu_list as $sub_mainmenu)
					{
					?>
						<li><a href="<?php echo $sub_mainmenu["cm_link"];?>" target="<?php echo $sub_mainmenu["cm_loai_link"];?>"><?php echo $sub_mainmenu["cm_ten"];?></a></li>
						<?php
						$sub_mainmenu_list2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($sub_mainmenu["cm_id"],"danh-muc","xuatban");
						if(count($sub_mainmenu_list2) > 0)
						{
							foreach($sub_mainmenu_list2 as $sub_mainmenu2)
							{
							?>
								<li class="blank"><a href="<?php echo $sub_mainmenu2["cm_link"];?>" target="<?php echo $sub_mainmenu2["cm_loai_link"];?>"><?php echo $sub_mainmenu2["cm_ten"];?></a></li>
							<?php
							}
						}
					}
					?>
					</ul>
				<?php
				}
				?>
				</li>
			<?php
			}
			?>
			
			<?php
			$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu("0");
			foreach($mainmenu_list as $mainmenu)
			{
			?>
				<li><a href="<?php echo $mainmenu["cm_link"];?>" target="<?php echo $mainmenu["cm_loai_link"];?>"><?php echo $mainmenu["cm_ten"];?></a>
				<?php
				$sub_mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($mainmenu["cm_id"]);
				if(count($sub_mainmenu_list) > 0)
				{
				?>
					<span class="expand submenu"></span>
					<ul>
					<?php
					foreach($sub_mainmenu_list as $sub_mainmenu)
					{
					?>
						<li><a href="<?php echo $sub_mainmenu["cm_link"];?>" target="<?php echo $sub_mainmenu["cm_loai_link"];?>"><?php echo $sub_mainmenu["cm_ten"];?></a></li>
						<?php
						$sub_mainmenu_list2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($sub_mainmenu["cm_id"]);
						if(count($sub_mainmenu_list2) > 0)
						{
							foreach($sub_mainmenu_list2 as $sub_mainmenu2)
							{
							?>
								<li class="blank"><a href="<?php echo $sub_mainmenu2["cm_link"];?>" target="<?php echo $sub_mainmenu2["cm_loai_link"];?>"><?php echo $sub_mainmenu2["cm_ten"];?></a></li>
							<?php
							}
						}
					}
					?>
					</ul>
				<?php
				}
				?>
				</li>
			<?php
			}
			?>
        </ul>              
    </div>
    <!--<a href="/index.php?view=pc"><span class='view-pc' ></span></a>
	<div class="logo"><a href="/"><img  src="/uploads/<?php echo chs_logo;?>" height='45'> </a></div>
	<input type="text" name="txtSearchBox" placeholder="Tìm kiếm..." autocomplete="off" style="width: 150px; height: 29px; margin-top: 10px; margin-left: 50px;"/>
	-->
    <div class="logo"><a href="/"><img  src="/uploads/<?php echo chs_logo;?>" height='45'> </a></div>
    <div class="menu-fade"></div>
	<a href="/gio-hang.html"><span class="view-cart"><span id="count_cart_mobile" class="header-cart-count-mobile CartCount"><?php echo $this->donhang_model->lay_so_san_pham_trong_gio($this->session->userdata("dh_id"));?></span></span>	</a>
    <span class="view-search menu-hide"></span>
    <div class="menu-right menu-hide">
    	<span></span>
        <ul style="display: none;">
			<!--
            <?php
			$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu("0");
			foreach($mainmenu_list as $mainmenu)
			{
			?>
			<li><a href="<?php echo $mainmenu["cm_link"];?>" target="<?php echo $mainmenu["cm_loai_link"];?>" title="<?php echo $mainmenu["cm_ten"];?>"><?php echo $mainmenu["cm_ten"];?></a></li> 
			<?php
			}
			?>
			-->
			<?php
			if($this->session->userdata("user_id"))
			{
			?>
			<li><a href="<?php echo base_url();?>thong-tin.html"><i class="fa fa-user" aria-hidden="true"></i> Thông tin cá nhân</a></li>
			<li><a href="<?php echo base_url();?>don-hang.html"><i class="fa fa-history" aria-hidden="true"></i> Quản lý đơn hàng</a></li>
			<li><a href="<?php echo base_url();?>san-pham-yeu-thich.html"><i class="fa fa-heart" aria-hidden="true"></i> Sản phẩm yêu thích</a></li>   
			<li><a href="<?php echo base_url();?>doi-mat-khau.html"><i class="fa fa-refresh" aria-hidden="true"></i> Đổi mật khẩu</a></li>
			<li><a rel="nofollow" href="javascript:ChekLogout();" class="login"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a></li>
			<?php
			}
			else
			{
			?>
			<li><a href="<?php echo base_url();?>dang-nhap.html" class="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
			<li><a href="<?php echo base_url();?>dang-ky.html"><i class="fa fa-registered" aria-hidden="true"></i> Đăng ký</a></li>
			<li><a href="<?php echo base_url();?>tro-giup.html"><i class="fa fa-support" aria-hidden="true"></i> Trợ giúp và hướng dẫn</a></li>
			  
			<?php
			}
			?>            
        </ul>	
    </div>
    <div class="menu-fade"></div>
</div>
<div class="head-search-box">
	<form id="frm_search_head" action="<?php echo base_url();?>tim-kiem-san-pham" method="post" onsubmit="return TimKiemMobile();">
	<div id="khung_timkiem2">
		<input name="txtTuKhoaMobile" id="txtTuKhoaMobile" class="txtTuKhoaMobile" type="text" placeholder="Tìm kiếm..." autocomplete="off"  value="<?php if($this->session->userdata("tukhoa")) echo $this->session->userdata("tukhoa");?>">		
		<input name="btnTimKiemMobile" value="Tìm" id="timkiem" class="btn_timkiem" type="submit" >
	</div>
	</form>
</div> 


