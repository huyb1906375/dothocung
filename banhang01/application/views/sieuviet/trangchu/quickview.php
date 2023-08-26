<?php
$sanphamhinh_list = $this->sanpham_model->lay_danh_sach_san_pham_hinh_gioi_han($sanpham["sp_id"], 0, 0);
$i = 1;						
$i = 1;
foreach($sanphamhinh_list as $sanphamhinh)
{
?>
<a <?php if($i == 1) echo "class=\"active\"";?> data-toggle="tab" href="#thumb-<?php echo $i;?>"><img src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanphamhinh["sph_url"];?>" alt="product-thumbnail"></a>
<?php
$i = $i + 1;
}
?>
							
						