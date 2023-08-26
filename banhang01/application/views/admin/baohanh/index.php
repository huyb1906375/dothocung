<form id="frm" name="frm" action="<?php echo base_url() ?>admin/baohanh" method="post"  enctype="multipart/form-data" >
<?php
$nn = "vi";
if($this->session->userdata("nn"))
{
	$nn = $this->session->userdata("nn");
}
?>
<section class="content-header">
  	<h1>
        BẢO HÀNH
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Bảo hành</li>
  	</ol>
</section>
<section class="content">
	<div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
					<?php  if($this->session->flashdata('success')):?>
						<div class="col-md-12">
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						</div>
					<?php  endif;?>
					<?php  if($this->session->flashdata('error')):?>
						<div class="col-md-12">
							<div class="alert alert-error">
								<?php echo $this->session->flashdata('error'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						</div>
					<?php  endif;?>
					
                	<div class="form-group col-md-3">
                        <label>Họ tên/Điện thoại/Số seri:</label>
                       	<input type="text" id="txtTuKhoa" name="txtTuKhoa" class="form-control" value="<?php echo $this->session->userdata('tu_khoa');?>" />  
                    </div>
					<div class="form-group col-md-3">
						<label>Trạng thái: </label> 
						<select name="cboTrangThai" id="cboTrangThai" class="form-control" style="width: 100%;">
							<option <?php if($this->session->userdata('bh_trang_thai') == "0") echo "selected"; ?> value="0">&nbsp;</option>
							<option <?php if($this->session->userdata('bh_trang_thai') == "1") echo "selected"; ?> value="1">Mới tiếp nhận</option>
							<option <?php if($this->session->userdata('bh_trang_thai') == "2") echo "selected"; ?> value="2">Đang xử lý</option>
							<option <?php if($this->session->userdata('bh_trang_thai') == "3") echo "selected"; ?> value="3">Đã có kết quả</option>
							<option <?php if($this->session->userdata('bh_trang_thai') == "4") echo "selected"; ?> value="4">Đã trả khách</option>
						</select>
					</div>
					
					<div class="form-group col-md-6">
						<label>&nbsp;</label>
                        <div class="input-group">
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="$('#frm').submit()" role="button">
								<span class="glyphicon glyphicon-search"></span> Tìm kiếm
							</a>							
							<a class="btn btn-primary" style="margin-right: 10px;" onclick="javascript:js_xoa_nhieu_lien_ket();" role="button">
								<span class="glyphicon glyphicon-trash"></span> Xóa chọn
							</a>
							<a href="/admin/baohanh/add" class="btn btn-primary" role="button">
								<span class="glyphicon glyphicon-plus"></span> Thêm mới
							</a>
							
						</div>
					</div>
                    	
                        
                    
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style='width:20px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
										<th class="text-center" style="width:100px">Hình</th>
										<th style="width:100px">Số seri</th>
										<th style="width:150px">Tên thiết bị</th>
                                        <th>Tình trạng</th>
										<th style="width:120px">Khách hàng</th>
										<th style="width:120px">Điện thoại</th>
                                        <th style="width:120px">Trạng thái</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									//$baohanh = $this->baohanh_model->lay_danh_sach_lien_ket("",$this->session->userdata('bh_trang_thai'));
									foreach ($baohanh_list as $baohanh)
									{	
										$img = "default.png";
										if($baohanh["bh_hinh"] != "")
											$img = $baohanh["bh_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $baohanh["bh_id"];?>"/>
                                        </td>
                                        <td class="text-center">
                                            <img src="../uploads/baohanh/<?php echo $img;?> " height="64" width="64"/>
                                        </td>
                                        <td><?php echo $baohanh["bh_seri"];?></td>
										<td><?php echo $baohanh["bh_thiet_bi"];?></td>
										<td><?php echo $baohanh["bh_tinh_trang"];?></td>
										<td><?php echo $baohanh["bh_khach_hang"];?></td>
										<td><?php echo $baohanh["bh_dien_thoai"];?></td>
                                        <td>
                                            <?php
											$trangthai = "";
											if($baohanh["bh_trang_thai"] == 0)
												$trangthai = "Mới tiếp nhận";
											if($baohanh["bh_trang_thai"] == 1)
												$trangthai = "Đang xử lý";
											if($baohanh["bh_trang_thai"] == 2)
												$trangthai = "Đã có kết quả";
											if($baohanh["bh_trang_thai"] == 3)
												$trangthai = "Đã trả khách";
											echo $trangthai;
											?>
                                        </td>
                                        
										
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/baohanh/edit/'.$baohanh["bh_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/baohanh/delete/'.$baohanh["bh_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
                                        </td>	
                                        
                                    </tr>
                                        
                                        <?php                                                
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
  	<!-- /.row -->
</section>
<script type="text/javascript">
function xacNhanXoa(){	
	return confirm("Bạn có chắc muốn xoá các dòng được chọn?");
	
}
function js_xoa_nhieu_lien_ket(){
    if($('.checkbox:checked').length > 0){
        var result = confirm("Bạn có chắc muốn xoá các dòng được chọn?");
        if(result)
		{			
            var checks = document.getElementsByName('id[]');
			var s = "";
			for (i = 0; i < checks.length; i++)
			{
				if(checks[i].checked == true)
				{
					s = s + "'" + checks[i].value + "',";					
				}
			}
			if(s.length > 0)
			{
				s = s.substring(0, s.length-1);
				var url = "/admin/ajax/ajax_xoa_nhieu_lien_ket";       
				$.post(url, {
					'sid': s
				}).success(function(data) {
					var fields = data.split("|");
					if(fields[0] == "1")
					{
						alert("Đã xóa thành công!");
						location.reload();
						
					}
				}).error(function(data) {
					alert("Xảy ra lỗi!");
				}); 
			}
        }
		else
		{
            return false;
        }
    }
	else
	{
        alert('Xin chọn ít nhất một dòng để xóa!');
        return false;
    }
}

</script>
</form>