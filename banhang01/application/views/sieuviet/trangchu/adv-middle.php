
<?php
$lienket_list = $this->lienket_model->lay_danh_sach_lien_ket_gioi_han("noibat","Main",3,0);
if(count($lienket_list) > 0)
{
?>
<div class="big-banner pt-15 pb-15 pb-sm-15 off-white-bg">
	<div class="container banner-2">
	<?php
	foreach($lienket_list as $lienket)
	{
	?>
	<div class="banner-box white-bg">
		<div class="col-img">
			<a href="<?php echo $lienket["lk_link"];?>" target="<?php echo $lienket["lk_loai_link"];?>"><img src="<?php echo base_url();?>uploads/lienket/<?php echo $lienket["lk_hinh"];?>"></a>
		</div>
	</div>
	<?php
	}
	?>
	</div>
</div>
<?php
}
?>

