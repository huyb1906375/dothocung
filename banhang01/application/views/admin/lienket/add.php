<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />

<form name="frm" action="<?php echo base_url() ?>admin/lienket/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	LIÊN KẾT
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/lienket">Liên kết</a></li>
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
                    <div class="col-md-9">
                        
						<div class="form-group">
                            <label>Tên liên kết:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo set_value('txtTen');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
                        </div>
						<div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo set_value('txtMoTa');?></textarea>
							<script>CKEDITOR.replace('txtMoTa');</script>
                        </div>
						
                        
                    </div>
                    <div class="col-md-3">
                    	<div class="form-group">
                            <label>Link:</label>
                            <input type="text" class="form-control" id="txtLink" name="txtLink" value="<?php echo set_value('txtLink');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtLink')?></div>
                        </div>
						<div class="form-group">
                            <label>Loại link:</label>
                            <select name="cboLoaiLink" class="form-control"  style="width:100%; ">
                                <option value="_blank" <?php if($this->session->userdata('lk_loai_link') == '_blank') echo "selected"; else echo "";?>>Tạo trang mới</option>
                                <option value="_parent" <?php if($this->session->userdata('lk_loai_link') == '_parent') echo "selected"; else echo "";?>>Chuyển trang</option>
                            </select>
                        </div>
						<div class="form-group">
							<label>Vị trí: </label> 
							<select name="cboViTri" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('lk_vi_tri') == '') echo "selected";?> value=""></option>
								<option <?php if($this->session->userdata('lk_vi_tri') == 'Main') echo "selected";?> value="Main">Main</option>
								<option <?php if($this->session->userdata('lk_vi_tri') == 'Top') echo "selected";?> value="Top">Top</option>
								<option <?php if($this->session->userdata('lk_vi_tri') == 'Bottom') echo "selected";?> value="Bottom">Bottom</option>
								<option <?php if($this->session->userdata('lk_vi_tri') == 'Left') echo "selected";?> value="Left">Left</option>
								<option <?php if($this->session->userdata('lk_vi_tri') == 'Right') echo "selected";?> value="Right">Right</option>							
								<option <?php if($this->session->userdata('lk_vi_tri') == 'Option') echo "selected";?> value="Option">Option</option>
							</select>
						</div>
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('lk_trang_thai') == 0) echo "selected";?> value="0">Chưa xuất bản</option>
                                <option <?php if($this->session->userdata('lk_trang_thai') == 1) echo "selected";?> value="1">Xuất bản</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Nổi bật:</label>
                            <select name="cboNoiBat" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('lk_noi_bat') == 0) echo "selected";?> value="0">Bình thường</option>
                                <option <?php if($this->session->userdata('lk_noi_bat') == 1) echo "selected";?> value="1">Nổi bật</option>
                            </select>
                        </div>
                        <div class="form-group">
                        	<label>Hình đại diện:</label>
                            <div id="upload-image-box">                            	          
								<div class="item">
                                    <label for="fileHinhAnh">
                                        <img class="thumbnail form-control" src="uploads/images/upload-image.png"/>         
                                    </label>
                                    <input name="fileHinhAnh" id="fileHinhAnh" class="inputimage" accept="image/*" type="file">  
								</div>								
                            </div>
                        </div>
                        
                    </div>
					
                </div>
				<div class="box-footer">
					<div class="col-md-12 text-center">
						<div class="form-group">
                            <button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Thêm]
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/lienket" role="button">
								<span class="glyphicon glyphicon-arrow-left"></span> Trở về
							</a>
                        </div>
					</div>
				</div>
            </div><!-- /.box -->
        </div>
        
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script type="text/javascript">
document.frm.txtTen.focus();
</script>
</form>