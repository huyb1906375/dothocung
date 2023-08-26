<form name="frm" action="<?php echo base_url() ?>admin/slideshow" method="post"  enctype="multipart/form-data" >
<?php
$nn = "vi";
if($this->session->userdata("nn"))
{
	$nn = $this->session->userdata("nn");
}
?>
<section class="content-header">
  	<h1>
        SLIDESHOW
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Slideshow</li>
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
					
					<div class="form-group col-md-12 text-right">
						
						<a class="btn btn-primary" style="margin-right: 10px;" onclick="$('#frm').submit()" role="button">
							<span class="glyphicon glyphicon-search"></span> Tìm kiếm
						</a>							
						<a class="btn btn-primary" style="margin-right: 10px;" onclick="javascript:js_xoa_nhieu_slideshow();" role="button">
							<span class="glyphicon glyphicon-trash"></span> Xóa chọn
						</a>
						<a href="/admin/slideshow/add" class="btn btn-primary" role="button">
							<span class="glyphicon glyphicon-plus"></span> Thêm mới
						</a>
							
						
					</div>
                    	
                        
                    
                    <div class="col-md-12">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th class="text-center" style='width:10px;'><input type="checkbox" onclick="checkOrUncheckAll(this.checked);"/></th>
										<th class="text-center" style="width:150px">Hình</th>
                                        <th>Tên</th>
                                        <th class="text-center" style="width:80px">Xuất bản</th>
										<th class="text-center" style="width:50px">Xuống</th>
                                        <th class="text-center" style="width:50px">Sửa</th>
                                        <th class="text-center" style="width:50px">Xóa</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php		   	
									foreach ($list as $row)
									{	
										$img = "default.png";
										if($row["slide_hinh"] != "")
											$img = $row["slide_hinh"]; 	
									?>
                                    <tr>			   					               
                                        <td class="text-center" style="width:20px"> 
                                            <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $row["slide_id"];?>"/>
                                        </td>
                                        <td class="text-center">
                                            <img src="../uploads/slideshow/<?php echo $img;?> " height="128" width="128"/>
                                        </td>
                                        <td><b><?php echo $row["slide_ten"];?></b><br/>Link: <?php echo $row["slide_link"];?></td>
										
                                        
                                        <td class="text-center">
                                            <?php 
                                            if ($row["slide_trang_thai"]==1)
                                            {
                                            ?>					 
                                                <a href="<?php echo 'admin/slideshow/hide_status/'.$row["slide_id"]; ?>" ><span class="glyphicon glyphicon-ok-circle mauxanh18"></span></a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                 <a href="<?php echo 'admin/slideshow/show_status/'.$row["slide_id"]; ?>" ><span class="glyphicon glyphicon-remove-circle maudo"></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        
										<td class="text-center">                
                                            <a class="btn btn-info btn-xs" href="<?php echo 'admin/slideshow/down/'.$row["slide_id"]; ?>" role="button" > <span class="glyphicon glyphicon-circle-arrow-down"></span> Xuống</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-success btn-xs" href="<?php echo 'admin/slideshow/edit/'.$row["slide_id"]; ?>" role="button" > <span class="glyphicon glyphicon-edit"></span> Sửa</a>                
                                        </td>
                                        <td class="text-center">                
                                            <a class="btn btn-danger btn-xs" href="<?php echo 'admin/slideshow/delete/'.$row["slide_id"]; ?>"  onclick="return confirm('Bạn có chắc muốn xóa không?')"  role="button"> <span class="glyphicon glyphicon-trash"></span> Xóa</a>                
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
function js_xoa_nhieu_slideshow(){
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
				var url = "/admin/ajax/ajax_xoa_nhieu_slideshow";       
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