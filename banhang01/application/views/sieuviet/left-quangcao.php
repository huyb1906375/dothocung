<?php
$lienket_list = $this->lienket_model->lay_danh_sach_lien_ket_gioi_han("binhthuong","left",4,0);
foreach($lienket_list as $lienket)
{
?>
<div class="col-img mb-1">
	<a href="<?php echo $lienket["lk_link"];?>" target="<?php echo $lienket["lk_loai_link"];?>"><img src="<?php echo base_url();?>uploads/lienket/<?php echo $lienket["lk_hinh"];?>" alt="slider-banner"></a>
</div>
<?php
}
?>