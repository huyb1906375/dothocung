<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />
<form name="frm" action="<?php echo base_url() ?>admin/menu/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	MENU
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php?frm=tongquan"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/menu">Menu</a></li>
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
							<label>Loại menu:</label>
							<select id="cboLoaiMenu" name="cboLoaiMenu" class="form-control" style="width:100%" onchange="js_lay_ds_menu()">
								<option <?php if($this->session->userdata('m_loai') == 'MainMenu') echo "selected";?> value="MainMenu">Main Menu</option>
								<option <?php if($this->session->userdata('m_loai') == 'TopMenu') echo "selected";?> value="TopMenu">Top Menu</option>
								<option <?php if($this->session->userdata('m_loai') == 'LeftMenu') echo "selected";?> value="LeftMenu">Left Menu</option>
								<option <?php if($this->session->userdata('m_loai') == 'RightMenu') echo "selected";?> value="RightMenu">Right Menu</option>
								<option <?php if($this->session->userdata('m_loai') == 'FooterMenu') echo "selected";?> value="FooterMenu">Footer Menu</option>
							</select> 
						</div>
						<div class="form-group">
                            <label>Link:</label>
                            
							<div class="input-group">
								
								<input type="text" class="form-control" id="txtLink" name="txtLink" value="<?php echo set_value('txtLink'); ?>" style="width:100%">
								<div class="error" id="txtLink_error"><?php echo form_error('txtLink')?></div>
								<div class="input-group-addon">
									<a href="javascript:js_show_popup_link()"><i class="fa fa-link"></i></a>
								</div>
							</div>
                        </div>
						<div class="form-group">
                            <label>Loại link:</label>
                            <select name="cboLoaiLink" class="form-control"  style="width:100%; ">
                                <option value="_blank" <?php if($this->session->userdata('m_loai_link') == '_blank') echo "selected"; else echo "";?>>Tạo trang mới</option>
                                <option value="_parent" <?php if($this->session->userdata('m_loai_link') == '_parent') echo "selected"; else echo "";?>>Chuyển trang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu cha:</label>
                            <select id="cboMenuCha" name="cboMenuCha" class="form-control" style="width:100%">
                                <option value="0"></option>
								<?php 
								$parent = $this->menu_model->lay_danh_sach_menu("0",$this->session->userdata("m_loai"));
								foreach ($parent as $p) 
								{
									echo "<option ".(($this->session->userdata('m_id_parent') == $p["m_id"])?"selected":"")." value='".$p["m_id"]."'>".$p["m_ten"]."</option>";
									$child = $this->menu_model->lay_danh_sach_menu($p["m_id"],$this->session->userdata("m_loai"));
									foreach ($child as $c) 
									{
										echo "<option ".(($this->session->userdata('m_id_parent') == $c["m_id"])?"selected":"")." value='".$c["m_id"]."'>|-----".$c["m_ten"]."</option>";
									}
								}
								?>
                            </select>
                        </div>
						
                    </div>
                    <div class="col-md-6">
						<div class="form-group">
                        	<label>Hình đại diện:</label>
							
                            <div id="upload-image-box">                            	          
								<div class="item">
                                    <label for="fileHinhAnh">
										
                                        <img class="thumbnail form-control" src="uploads/menu/upload-image.png"/>         
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
						<a class="btn btn-primary btn-sm" href="admin/menu" role="button">
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
<div class="modal fade" id="modal-lienket">
    <div class="modal-dialog primary">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">LIÊN KẾT</h4>
            </div>
            <div class="modal-body no-padding">
				<div class="box-body">
					<div class="form-group">
						<select id="cboTuyChon" name="cboTuyChon" class="form-control" style="width:100%" onchange="js_lay_ds_lien_ket()">
							
							<option value="trang-don">Trang đơn</option>
							<option value="menu">Menu chính</option>
							<option value="chuyen-muc">Chuyên mục</option>
							<option value="danh-muc">Danh mục sản phẩm</option>
							<option value="loai-du-an">Loại dự án</option>
							<option value="loai-bat-dong-san">Loại bất động sản</option>
							<option value="loai-rao-vat">Loại rao vặt</option>
						</select> 
					</div>
					<div id="listchuyenmuc" class="box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<thead>
								<tr>										
									<th>Tên</th>
									<th class="text-center" style="width:50px">Chọn</th>                                       
								</tr>
							</thead>
							<tbody>
								<?php
								
								$chuyenmuc = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","trang-don","","");
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
								}
								?>
								
							</tbody>
						</table>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnDongPopupLink" class="btn btn-primary pull-right" data-dismiss="modal">Đóng lại</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
function js_lay_ds_menu()
{	
	var loai = $("#cboLoaiMenu").val();
    var url = "/admin/ajax/ajax_lay_ds_menu/"+loai;
	loadDuLieu('cboMenuCha',url);
}
function js_lay_ds_lien_ket()
{
	
	var loai = $("#cboTuyChon").val();
    var url = "/admin/ajax/lay_danh_sach_chuyen_muc/"+loai;
	loadDuLieu('listchuyenmuc',url);
}
function js_show_popup_link()
{
	$('#modal-lienket').modal({backdrop:'static'});
	$('#modal-lienket').on('shown.bs.modal', function () {
			
	});
}
function js_set_link(link)
{
	$('#txtLink').val(link);
	$("#btnDongPopupLink").click();
	$('#txtLink').focus();
}
SelectAllText();
</script>
</form>