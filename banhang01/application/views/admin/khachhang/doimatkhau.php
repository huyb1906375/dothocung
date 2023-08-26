<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/doimatkhau" method="post"  enctype="multipart/form-data"  onsubmit="return checkValue();" >
<section class="content-header">
  <h1>
  	ĐỔI MẬT KHẨU
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/doimatkhau">Đổi mật khẩu</a></li>
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
                            <label>Tên đăng nhập:</label>
                            <input type="text" class="form-control" id="txtTenDangNhap" name="txtTenDangNhap" value="<?php echo $this->session->userdata('nd_ten_dang_nhap'); ?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtTenDangNhap')?></div>
                        </div>
						<div class="form-group">
                            <label>Mật khẩu cũ:</label>
                            <input type="password" class="form-control" id="txtMatKhau" name="txtMatKhau" value="" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtMatKhau')?></div>
                        </div>
						<div class="form-group">
                            <label>Mật khẩu mới:</label>
                            <input type="password" class="form-control" id="txtMatKhauMoi" name="txtMatKhauMoi" value="" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtMatKhauMoi')?></div>
                        </div>
						<div class="form-group">
                            <label>Xác nhận lại mật khẩu mới:</label>
                            <input type="password" class="form-control" id="txtXacNhanMatKhauMoi" name="txtXacNhanMatKhauMoi" value="" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtXacNhanMatKhauMoi')?></div>
                        </div>
						
                        <div class="form-group">
                             <input type="submit" name="btnLuu" value="Cập nhật" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
                            
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
function checkValue(){
	if (document.frm.txtMatKhau.value==""){
		alert("Bạn chưa nhập mật khẩu cũ!");
		document.frm.txtMatKhau.focus();
		return false;
	}
	if (document.frm.txtMatKhauMoi.value==""){
		alert("Bạn chưa nhập mật khẩu mới!");
		document.frm.txtMatKhauMoi.focus();
		return false;
	}
	if (document.frm.txtMatKhauMoi.value != document.frm.txtXacNhanMatKhauMoi.value){
		alert("Xác nhận mật khẩu mới chưa chính xác!");
		document.frm.txtXacNhanMatKhauMoi.focus();
		SelectAllText();
		return false;
	}
	return true;
}
function SelectAllText() {
	var input = document.getElementById("txtMatKhauMoi");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();
</script>
</form>