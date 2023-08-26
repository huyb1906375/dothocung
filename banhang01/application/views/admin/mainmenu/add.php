<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />

<?php
$nn = "vi";
if($this->session->userdata("nn"))
{
	$nn = $this->session->userdata("nn");
}

?>
<form name="frm" action="<?php echo base_url() ?>admin/mainmenu/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	MENU CHÍNH
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php?frm=tongquan"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/menu">Menu chính</a></li>
    <li>[Thêm]</li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" id="view">
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
                    <div class="col-md-6">
                        
						<div class="form-group">
                            <label>Tên menu:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo set_value('txtTen');?>" style="width:100%">
							<div class="error" id="txtTen_error"><?php echo form_error('txtTen')?></div>
							
                        </div>
						
						<div class="form-group">
                            <label>Link:</label>
                            <input type="text" class="form-control" id="txtLink" name="txtLink" value="<?php echo set_value('txtLink'); ?>" style="width:100%">
							<div class="error" id="txtLink_error"><?php echo form_error('txtLink')?></div>
                        </div>
						<div class="form-group">
                            <label>Loại link:</label>
                            <select name="cboLoaiLink" class="form-control"  style="width:100%; ">
                                <option value="_blank" <?php if($this->session->userdata('cm_loai_link') == '_blank') echo "selected"; else echo "";?>>Tạo trang mới</option>
                                <option value="_parent" <?php if($this->session->userdata('cm_loai_link') == '_parent') echo "selected"; else echo "";?>>Chuyển trang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu cha:</label>
                            <select id="cboMenuCha" name="cboMenuCha" class="form-control" style="width:100%">
                                <option value="0"></option>
								<?php 
								$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu("0");
								foreach ($parent as $p) 
								{
									echo "<option ".(($this->session->userdata('cm_id_parent') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
									$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc_menu($p["cm_id"]);
									foreach ($child as $c) 
									{
										echo "<option ".(($this->session->userdata('cm_id_parent') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
									}
								}
								?>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('cm_trang_thai') == 0) echo "selected";?> value="0">Không hiển thị</option>
                                <option <?php if($this->session->userdata('cm_trang_thai') == 1) echo "selected";?> value="1">Hiển thị</option>
                            </select>
                        </div>
						
                        
                    </div>
                    <div class="col-md-6">
						<div class="form-group">
                        	<label>Hình đại diện:</label>
							
                            <div id="upload-image-box">                            	          
								<div class="item">
                                    <label for="fileHinhAnh">
										
                                        <img class="thumbnail form-control" src="uploads/chuyenmuc/upload-image.png"/>         
                                    </label>
                                    <input name="fileHinhAnh" id="fileHinhAnh" class="inputimage" accept="image/*" type="file"> 
									
								</div>								
                            </div>
                        </div>
					</div>
                </div>
				<div class="box-footer">
					<div class="form-group text-center">
						<button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
							<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Thêm]
						</button>
						<a class="btn btn-primary btn-sm" href="admin/mainmenu" role="button">
							<span class="glyphicon glyphicon-arrow-left"></span> Trở về
						</a>
					</div>
				</div>
            </div><!-- /.box -->
        </div>
        
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script type="text/javascript">
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
function js_lay_ds_mainmenu()
{
	var nn = $("#cboNgonNgu").val();
    var url = "/admin/ajax/ajax_lay_ds_mainmenu/"+nn;
	loadDuLieu('cboMenuCha',url);
}
SelectAllText();
</script>
</form>