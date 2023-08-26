<header class="main-header">
    <!-- Logo -->
    <a href="index.php?frm=tongquan&tabid=tongquan" class="logo">
      	<!-- mini logo for sidebar mini 50x50 pixels -->
      	<span class="logo-mini"><b>Pháp Bảo</b></span>
      	<!-- logo for regular state and mobile devices -->
      	<span class="logo-lg">Pháp Bảo</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      	<!-- Sidebar toggle button-->
      	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        	<span class="sr-only">Toggle navigation</span>
      	</a>
		<div style="position: absolute;margin-top: 7px; margin-left: 40px; font-weight: bold; color: #fff; font-size: 24px;">HỆ THỐNG QUẢN TRỊ WEBSITE</div>
      	<div class="navbar-custom-menu">
        	<ul class="nav navbar-nav">
          		<li>
                    <a href="/">
                        <span class="glyphicon glyphicon-home"></span>
                        <span>Website</span>
                    </a>
                </li>
          		<!-- User Account: style can be found in dropdown.less -->
				<?php
				$hinhnd = "user.jpg";
				if($user['nd_hinh'] != "")
					$hinhnd = $user['nd_hinh'];
				?>
         		<li class="dropdown user user-menu">
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              		<img src="<?php echo base_url(); ?>uploads/nguoidung/<?php echo $hinhnd;?>" class="user-image"/>
              		<span class="hidden-xs">Xin chào: <?php echo $user['nd_ten'] ?></span>
            	</a>
            	<ul class="dropdown-menu">
              	<!-- User image -->
              	<li class="user-header">
					
                	<img src="<?php echo base_url(); ?>uploads/nguoidung/<?php echo $hinhnd;?>" class="img-circle" />
                	<p>
                  		<?php echo $user['nd_ten'] ?>
                  		<small>Đăng nhập lúc: <?php echo date('d/m/Y H:i:s',$this->session->userdata("nd_time"));?></small>
                	</p>
              	</li>
              
              	<!-- Menu Footer-->
              	<li class="user-footer">
                	<div class="pull-left">
                  		<a href="index.php?frm=doimatkhau&tabid=20160923212236" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                	</div>
                	<div class="pull-right">
                  		<a href="javascript:ChekLogout();" class="btn btn-default btn-flat">Đăng xuất</a>
                	</div>
              	</li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
</header>
<script type="text/javascript">
	function ChekLogout() {
		if (confirm('Bạn có chắc muốn đăng xuất khỏi hệ thống không?' )){
		   window.location = 'admin/nguoidung/dangxuat';
		}
	}
</script>