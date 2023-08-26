<div class="widget">
	<h4 class="widget-title">CÓ THỂ BẠN QUAN TÂM</h4>
	<div class="add-box">
	<?php
	$lk_list = $this->lienket_model->lay_danh_sach_lien_ket("binhthuong", "right");
	foreach($lk_list as $lk)
	{
	?>
		<a href="<?php echo $lk["lk_link"];?>" target="<?php echo $lk["lk_loai_link"];?>"><img src="<?php echo base_url();?>uploads/lienket/<?php echo $lk["lk_hinh"];?>" alt="" class="m-bottom10"/></a>
	<?php
	}
	?>
	</div>
</div>