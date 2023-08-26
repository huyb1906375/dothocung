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
					$mparent = $this->menu_model->lay_thong_tin_menu($chuyenmuc["cm_id_parent"],"FooterMenu");
				?>
				<li><a href="<?php echo $mparent["m_link"];?>"><?php echo $mparent["cm_ten"];?></a></li>
				<?php
				}
				?>
				<li class="active"><a href="<?php echo $chuyenmuc["cm_link"];?>"><?php echo $chuyenmuc["cm_ten"];?></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="single-blog ptb-30  ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 order-2 order-lg-1">
				<aside>
					<?php
					$menu_list = $this->menu_model->lay_danh_sach_menu("0", "FooterMenu");
					foreach($menu_list as $menu)
					{
					?>
					<div class="single-sidebar latest-pro mb-30">
						<h3 class="sidebar-title"><?php echo $menu["m_ten"];?></h3>
						<ul class="sidbar-style">
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
					<?php
					}
					?>
					<?php $this->load->view('sieuviet/left-quangcao'); ?>
				</aside>
			</div>
			<div class="col-lg-9 order-1 order-lg-2">
				<div class="single-sidebar-desc mb-all-40">
					
					<div class="sidebar-post-content">
						<h3 class="sidebar-lg-title"><?php echo $chuyenmuc["cm_ten"];?></h3>
						
					</div>
					<div class="sidebar-desc mb-50">
						<?php echo $chuyenmuc["cm_mo_ta"];?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>