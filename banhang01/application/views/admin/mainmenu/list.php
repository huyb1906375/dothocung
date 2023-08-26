<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th class="text-center" style="width:50px">Hình</th>
			<th>Tên menu</th>
			<th class="text-center" style="width:90px">Đi xuống</th> 
			<th class="text-center" style="width:50px">Sửa</th>
			<th class="text-center" style="width:50px">Xóa</th>
		</tr>
	</thead>
	<tbody>
		<?php		   	
		$menu = $this->menu_model->lay_danh_sach_menu("0",$m_loai);
		foreach ($menu as $row)
		{	
			$img = "default.png";
			if($row["m_hinh"] != "")
				$img = $row["m_hinh"]; 	
		?>
		<tr>			   					               
			<td class="text-center">
				&nbsp;<img src="../uploads/menu/<?php echo $img;?> " height="25" width="25"/>
			</td>
			<td>&nbsp;<?php echo $row["m_ten"];?></td>
			<td class="text-center">                
				<a class="btn btn-info btn-xs" onclick="loadDuLieu('cautrucmenu','admin/ajax/update_thu_tu_menu/<?php echo $row["m_id"];?>/<?php echo $m_loai;?>')" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Đi xuống</a>                
			</td>
			<td class="text-center">                
				<a class="btn btn-success btn-xs" href="<?php echo 'admin/menu/edit/'.$row["m_id"]; ?>/<?php echo $m_loai;?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
			</td>
			<td class="text-center">                
				<a class="btn btn-danger btn-xs" onclick="loadDuLieu('cautrucmenu','admin/ajax/xoa_menu/<?php echo $row["m_id"];?>/<?php echo $m_loai;?>')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
			</td>
		</tr>
			<?php
				$menu1 = $this->menu_model->lay_danh_sach_menu($row["m_id"],$m_loai);
				foreach ($menu1 as $row1)
				{	
					$img = "default.png";
					if($row1["m_hinh"] != "")
						$img = $row1["m_hinh"]; 
			?>
				<tr>			   					               
					<td class="text-center" style="width:50px">
						&nbsp;<img src="../uploads/menu/<?php echo $img;?> " height="25" width="25"/>
					</td>
					<td>&nbsp;|-----<?php echo $row1["m_ten"];?></td>
					<td class="text-center">                
						<a class="btn btn-info btn-xs" onclick="loadDuLieu('cautrucmenu','admin/ajax/update_thu_tu_menu/<?php echo $row1["m_id"];?>/<?php echo $m_loai;?>')" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Đi xuống</a>                
					</td>
					<td class="text-center">                
						<a class="btn btn-success btn-xs" href="<?php echo 'admin/menu/edit/'.$row1["m_id"]; ?>/<?php echo $m_loai;?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
					</td>
					<td class="text-center">                
						<a class="btn btn-danger btn-xs" onclick="loadDuLieu('cautrucmenu','admin/ajax/xoa_menu/<?php echo $row1["m_id"];?>/<?php echo $m_loai;?>')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
					</td>
				</tr>
				<?php
				$menu2 = $this->menu_model->lay_danh_sach_menu($row1["m_id"],$m_loai);
				foreach ($menu2 as $row2)
				{	
					$img = "default.png";
					if($row2["m_hinh"] != "")
						$img = $row2["m_hinh"]; 
			?>
				<tr>			   					               
					<td class="text-center" style="width:50px">
						&nbsp;<img src="../uploads/menu/<?php echo $img;?> " height="25" width="25"/>
					</td>
					<td>&nbsp;|----------<?php echo $row2["m_ten"];?></td>
					<td class="text-center">                
						<a class="btn btn-info btn-xs" onclick="loadDuLieu('cautrucmenu','admin/ajax/update_thu_tu_menu/<?php echo $row2["m_id"];?>/<?php echo $m_loai;?>')" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Đi xuống</a>                
					</td>
					<td class="text-center">                
						<a class="btn btn-success btn-xs" href="<?php echo 'admin/menu/edit/'.$row2["m_id"]; ?>/<?php echo $m_loai;?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
					</td>
					<td class="text-center">                
						<a class="btn btn-danger btn-xs" onclick="loadDuLieu('cautrucmenu','admin/ajax/xoa_menu/<?php echo $row2["m_id"];?>/<?php echo $m_loai;?>')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
					</td>
				</tr>
			<?php
					}
				}
			}
			?>
	</tbody>
</table>
                       