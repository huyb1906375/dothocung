<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/nguoidung/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	NGƯỜI DÙNG
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/nguoidung">Người dùng</a></li>
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
                            <label>Họ tên:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo set_value('txtTen');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTen')?></div>
                        </div>
						<div class="form-group">
                            <label>Email:</label>
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo set_value('txtEmail');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtEmail')?></div>
                        </div>
						<div class="form-group">
                            <label>Tên đăng nhập:</label>
                            <input type="text" class="form-control" id="txtTenDangNhap" name="txtTenDangNhap" value="<?php echo set_value('txtTenDangNhap');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTenDangNhap')?></div>
                        </div>
						<div class="form-group">
                            <label>Mật khẩu:</label>
                            <input type="password" class="form-control" id="txtMatKhau" name="txtMatKhau" value="<?php echo set_value('txtMatKhau');?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtMatKhau')?></div>
                        </div>
						<div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($this->session->userdata('nd_trang_thai') == 0) echo "selected";?> value="0">Chưa kích hoạt</option>
                                <option <?php if($this->session->userdata('nd_trang_thai') == 1) echo "selected";?> value="1">Kích hoạt</option>
                            </select>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-6">
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
					<div class="form-group text-center">
						<button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
							<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Thêm]
						</button>
						<a class="btn btn-primary btn-sm" href="admin/nguoidung" role="button">
							<span class="glyphicon glyphicon-arrow-left"></span> Trở về
						</a>
						<label id="lblThongBao" style="color:#F00;">&nbsp;&nbsp;</label> 
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