<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Tên</th>
			<th class="text-center" style="width:100px">Vị trí</th>
			<th class="text-center" style="width:50px">Xuống</th>
			<th class="text-center" style="width:50px">Xóa</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($list as $ct)
		{	
		?>
		<tr>			   					               
			<td><?php echo $ct["cm_ten"];?></td>
			<td><?php echo $ct["ct_vi_tri"];?></td>
			<td class="text-center">                
				<a class="btn btn-info btn-xs" onclick="loadDuLieu('cautruc','admin/ajax/ajax_update_thu_tu_cau_truc/<?php echo $ct["ct_id"];?>')"  role="button"> <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
			</td>
			<td class="text-center">                
				<a class="btn btn-danger btn-xs" onclick="loadDuLieu('cautruc','admin/ajax/ajax_xoa_cau_truc/<?php echo $ct["ct_id"];?>')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
			</td>
		</tr>												
		<?php
		}
		?>
	</tbody>
</table>