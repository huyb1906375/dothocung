<!-- START ADVERTISEMENT -->
<?php
$lk_list = $this->lienket_model->lay_danh_sach_lien_ket_gioi_han("binhthuong", "right", 0,0);
if(count($lk_list)> 0)
{
?>
<div class="add-inner">
	<?php
	foreach($lk_list as $lk)
	{
	?>
	<img src="<?php echo base_url();?>uploads/lienket/<?php echo $lk["lk_hinh"];?>" class="img-responsive" alt="" style="width: 100%">
	<?php
	}
	?>
</div>
<?php
}
?>
<!-- END OF /. ADVERTISEMENT -->
