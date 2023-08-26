<table class="table table-hover table-bordered" style="margin-top: 10px;">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Giá trị</th>                                        
            <th class="text-center" style="width:50px">Xóa</th>
        </tr>
    </thead>
    <tbody>
	<?php
	foreach($list as $item)
	{
	?>
    
    <tr>
        <td>&nbsp;<?php echo $item["sptt_ten"];?></td>
        <td>&nbsp;<?php echo $item["sptt_gia_tri"];?></td>
        <td class="text-center" >
        	<a class="btn btn-danger btn-xs"  onclick="loadDuLieu('sanphamthuoctinh','admin/ajax/xoa_san_pham_thuoc_tinh/<?php echo $item["sptt_id"];?>/<?php echo $item["sptt_sp_id"];?>');" onclick="return confirm('Bạn có chắc muốn xóa không?')" role="button" >
                <span class="glyphicon glyphicon-trash"></span> Xóa
            </a>                
                          
        </td>
    </tr>
    <?php
        }
    ?>
	</tbody>
</table>