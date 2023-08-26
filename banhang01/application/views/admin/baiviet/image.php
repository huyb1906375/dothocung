<?php
foreach($list as $item)
{
?>
<div class="image_item">	
	<a onclick="loadDuLieu('image_list','<?php echo base_url(); ?>admin/ajax/xoa_hinh_bai_viet/<?php echo $item['bvh_id'];?>/<?php echo $item['bvh_bv_id'];?>')" class="image_item_delete"></a>
	<img class="thumbnail" src="/uploads/baiviet/<?php echo $item["bvh_url"];?>">                   
</div>
<?php
}
?>