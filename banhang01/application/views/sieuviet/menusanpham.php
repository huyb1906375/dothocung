<div class="vertical-menu mb-all-30">
	<nav>
		<ul class="vertical-menu-list">
			<?php
			$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","danh-muc","noibat");
			foreach($mainmenu_list as $mainmenu)
			{
				$sub_mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($mainmenu["cm_id"],"danh-muc","xuatban");
				$num = count($sub_mainmenu_list);
				if($num > 0)
				{
			?>
			<li>
				<a href="<?php echo base_url();?>danh-muc/<?php echo $mainmenu["cm_slug"];?>.html"><span><img src="<?php echo base_url();?>uploads/chuyenmuc/<?php echo $mainmenu["cm_hinh"];?>" style="width: 20px; height: 20px;"></span> <?php echo $mainmenu["cm_ten"];?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				<ul  class="ht-dropdown mega-child">
					<?php
					foreach($sub_mainmenu_list as $sub_mainmenu)
					{
						$sub_mainmenu_list2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($sub_mainmenu["cm_id"],"danh-muc","xuatban");
						$num2 = count($sub_mainmenu_list2);
						if($num2 > 0)
						{
						?>
							<li><a href="<?php echo base_url();?>danh-muc/<?php echo $sub_mainmenu["cm_slug"];?>.html" ><?php echo $sub_mainmenu["cm_ten"];?> <i class="fa fa-angle-right"></i></a>
								<ul class="ht-dropdown mega-child">
								<?php
								foreach($sub_mainmenu_list2 as $sub_mainmenu2)
								{
								?>
									<li><a href="<?php echo base_url();?>danh-muc/<?php echo $sub_mainmenu2["cm_slug"];?>.html"><?php echo $sub_mainmenu2["cm_ten"];?></a></li>
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
							<li><a href="<?php echo base_url();?>danh-muc/<?php echo $sub_mainmenu["cm_slug"];?>.html"><?php echo $sub_mainmenu["cm_ten"];?></a></li>
						<?php
						}
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
					<a href="<?php echo base_url();?>danh-muc/<?php echo $mainmenu["cm_slug"];?>.html" >
						<span><img src="<?php echo base_url();?>uploads/chuyenmuc/<?php echo $mainmenu["cm_hinh"];?>" style="width: 20px; height: 20px;"></span> <?php echo $mainmenu["cm_ten"];?>
					</a>
				</li>
			<?php
				}
			}
			?>
			<!--
			<li id="cate-toggle" class="category-menu v-cat-menu">
				<ul>
					<li class="has-sub"><a href="#">Xem thêm danh mục</a>
						<ul class="category-sub">
							<?php
							$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","danh-muc","binhthuong");
							foreach($mainmenu_list as $mainmenu)
							{												
							?>											
								<li>
									<a href="<?php echo base_url();?>danh-muc/<?php echo $mainmenu["cm_slug"];?>.html" >
										<span><img src="<?php echo base_url();?>uploads/chuyenmuc/<?php echo $mainmenu["cm_hinh"];?>"  style="width: 20px; height: 20px;"></span> <?php echo $mainmenu["cm_ten"];?>
									</a>
								</li>
							<?php
							}
							?>
						</ul>
					</li>
				</ul>
			</li>
			-->
		</ul>
	</nav>
</div>