<?php
$slideshow_list = $this->slideshow_model->lay_danh_sach_slideshow("xuatban");
if(count($slideshow_list) > 0)
{
?>
<div class="col-xl-9 col-lg-8 slider_box">
	<div class="slider-wrapper theme-default">
		<div id="slider" class="nivoSlider" style="max-height: 410px;">
			<?php
			foreach($slideshow_list as $slideshow)
			{
			?>
			<a href="<?php echo $slideshow["slide_link"];?>" target="<?php echo $slideshow["slide_loai_link"];?>"><img src="<?php echo base_url();?>uploads/slideshow/<?php echo $slideshow["slide_hinh"];?>" data-thumb="<?php echo base_url();?>uploads/slideshow/<?php echo $slideshow["slide_hinh"];?>" alt="" title="#htmlcaption" style="max-height: 410px;"/></a>
			<?php
			}
			?>
		</div>
	</div>
</div>
<?php
}
?>