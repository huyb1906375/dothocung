<table class="table table-hover table-bordered">
	<thead>
		<tr>
			
			<th>Tên</th>
			<th class="text-center" style="width:50px">Chọn</th>                                       
		</tr>
	</thead>
	<tbody>
		<?php
		if($cm_loai == "he-thong")
		{
		?>
		<tr>			   					                    
			<td>Trang chủ</td>										
			<td class="text-center">                
				<a class="btn btn-info btn-xs" role="button" onclick="themMenu('admin/ajax/them_menu/he-thong/trang-chu');" > <span class="glyphicon glyphicon-ok"></span> Chọn</a>                
			</td>                                        
		</tr>
		<tr>			   					                    
			<td>Liên hệ</td>										
			<td class="text-center">                
				<a class="btn btn-info btn-xs" role="button" onclick="themMenu('admin/ajax/them_menu/he-thong/lien-he');" > <span class="glyphicon glyphicon-ok"></span> Chọn</a>                
			</td>                                        
		</tr>
		<?php
		}
		else
		{
		$chuyenmuc = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0",$cm_loai,"xuatban");
		foreach ($chuyenmuc as $row)
		{		
		?>
		<tr>			   					               
			<td><?php echo $row["cm_ten"];?></td>
			
			<td class="text-center">                
				<a class="btn btn-info btn-xs" role="button" onclick="js_set_link('<?php echo $row["cm_link"];?>')" > <span class="glyphicon glyphicon-ok"></span> Chọn</a>               
			</td>
			
		</tr>
			<?php
				$chuyenmuc1 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($row["cm_id"],$cm_loai,"xuatban");
				foreach ($chuyenmuc1 as $row1)
				{	
			?>
				<tr>			   					               
					<td>|-----<?php echo $row1["cm_ten"];?></td>
					
					<td class="text-center">                
						<a class="btn btn-info btn-xs" role="button" onclick="js_set_link('<?php echo $row1["cm_link"];?>')" > <span class="glyphicon glyphicon-ok"></span> Chọn</a>               
					</td>
					
					
				</tr>
				<?php
				$chuyenmuc2 = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($row1["cm_id"],$cm_loai,"xuatban");
				foreach ($chuyenmuc2 as $row2)
				{	
			?>
				<tr>			   					               
					<td>|----------<?php echo $row2["cm_ten"];?></td>
					<td class="text-center">                
						<a class="btn btn-info btn-xs" role="button" onclick="js_set_link('<?php echo $row2["cm_link"];?>')" > <span class="glyphicon glyphicon-ok"></span> Chọn</a>               
					</td>
					
					
				</tr>
			<?php
					}
				}
			}
		}
		?>
	</tbody>
</table>