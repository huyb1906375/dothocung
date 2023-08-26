<?php
if(count($list) > 0)
{
foreach($list as $item)
{
?>
<div class="image_item">	
	<a onclick="loadDuLieu('image_list','<?php echo base_url(); ?>admin/ajax/xoa_san_pham_hinh/<?php echo $item['sph_id'];?>/<?php echo $item['sph_sp_id'];?>')" class="image_item_delete"></a>
	<img class="thumbnail" src="/uploads/sanpham/<?php echo $item["sph_url"];?>">                   
</div>
<?php
}
}
else echo "&nbsp;";
?>