<div class="main-page-banner pb-15 off-white-bg">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<?php $this->load->view('sieuviet/menusanpham'); ?>
			</div>
			<?php $this->load->view('sieuviet/trangchu/slide'); ?>
		</div>
	</div>
</div>
<?php 
$this->load->view('sieuviet/trangchu/adv-middle'); 
$this->load->view('sieuviet/trangchu/hotdeal');
$this->load->view('sieuviet/trangchu/product');
/*
$lienket_list = $this->lienket_model->lay_danh_sach_lien_ket_gioi_han("binhthuong","bottom",4,0);
if(count($lienket_list) > 0)
{
?>
<div class="big-banner mt-30">
	<div class="container big-banner-box">
		<?php
		foreach($lienket_list as $lienket)
		{
		?>
		<div class="col-img">
			<a href="<?php echo $lienket["lk_link"];?>" target="<?php echo $lienket["lk_loai_link"];?>"><img src="<?php echo base_url();?>uploads/lienket/<?php echo $lienket["lk_hinh"];?>" alt="banner 3"></a>
		</div>
		<?php
		}
		?>
	</div>
</div>
<?php
}
*/
?>

