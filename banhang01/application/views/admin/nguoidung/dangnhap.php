<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Đăng nhập - VinaBMS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?php echo base_url()?>public/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>public/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url()?>public/admin/css/login.css" rel="stylesheet" type="text/css">
  </head>
  <body class="login-page">
    <div class="login-box">
     
      <div class="login-box-body">
        <p class="login-box-msg"><b>ĐĂNG NHẬP HỆ THỐNG</b></p>
        <form name="frm" method="post" action="<?php echo base_url()?>admin/nguoidung/dangnhap">
			<div class="form-group has-feedback">
				<input type="text" id="txtTenDangNhap" name="txtTenDangNhap" class="form-control" placeholder="Tên đăng nhập"/>            
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				<div class="error" id="username_error"><?php echo form_error('txtTenDangNhap')?></div>
			</div>
		  
			<div class="form-group has-feedback">
				<input type="password" id="txtMatKhau" name="txtMatKhau" class="form-control" placeholder="Mật khẩu"/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				<div class="error" id="password_error"><?php echo form_error('txtMatKhau')?></div>
			</div>
		  
		  
			<div class="row">
				<div class="col-xs-8">
					Hotline: <b class="c-red">0899 68 68 84</b><br />
					Website: <b class="c-red"><a href="http://www.tamtrihiep.com" target="_blank">www.tamtrihiep.com</a></b><br />
				</div>
				<div class="col-xs-4">
					<input type="submit" id="btnDangNhap" name="btnDongY" value="Đồng ý" class="btn btn-primary btn-block btn-flat"/> 
				</div><!-- /.col -->
			</div>
			<?php  if(isset($error)):?>
				<div class="row">
					<div class="alert alert-danger">
						<?php echo $error; ?>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					</div>
				</div>
			<?php  endif;?>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
	<nav class="navbar navbar-fixed-bottom" role="navigation">
		<div class="container">
		   <h5 class="text-center">Copyright © 2020 Mini Mart. All rights reserved.</h5>
		</div>
	</nav>
	
    <script type="text/javascript">
	
	document.frm.txtTenDangNhap.focus();
	
	</script>
	<!-- jQuery -->
	<script src="<?php echo base_url()?>public/admin/js/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url()?>public/admin/js/bootstrap.js"></script>
  </body>
</html>
