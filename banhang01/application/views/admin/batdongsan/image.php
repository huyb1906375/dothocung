<?php
if(count($list) > 0)
{
foreach($list as $item)
{
?>
<div class="image_item">	
	<a onclick="loadDuLieu('image_list','<?php echo base_url(); ?>admin/ajax/xoa_bat_dong_san_hinh/<?php echo $item['bdsh_id'];?>/<?php echo $item['bdsh_bds_id'];?>')" class="image_item_delete"></a>
	<img class="thumbnail" src="/uploads/batdongsan/<?php echo $item["bdsh_url"];?>">                   
</div>
<?php
}
}
else echo "&nbsp;";
?>