<ul class="nav navbar-nav navbar-left" data-in="" data-out="">
	<?php
	$mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu("0");
	foreach($mainmenu_list as $mainmenu)
	{
		$sub_mainmenu_list = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($mainmenu["cm_id"]);
		$num = count($sub_mainmenu_list);
		if($num > 0)
		{
	?>
	<li  id="<?php echo $mainmenu["cm_slug"];?>" class="dropdown">
		<a class="dropdown-toggle" href="<?php echo $mainmenu["cm_link"];?>" data-toggle="dropdown">
			<?php echo $mainmenu["cm_ten"];?> <i class="lni-chevron-down"></i>
		</a>
		<ul class="dropdown-menu">
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
		<a href="<?php echo $mainmenu["cm_link"];?>" target="<?php echo $mainmenu["cm_loai_link"];?>">
			<?php echo $mainmenu["cm_ten"];?>
		</a>
	</li>
	<?php
		}
	}
	?>
</ul>