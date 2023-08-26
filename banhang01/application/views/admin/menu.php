<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
				<?php
				$hinhnd = "user.jpg";
				if($user['nd_hinh'] != "")
					$hinhnd = $user['nd_hinh'];
				?>
                <img src="/uploads/nguoidung/<?php echo $hinhnd;?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $user["nd_ten"];?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Trực tuyến</a>
            </div>
        </div>
		  <ul class="sidebar-menu">
			<li id="home" class="treeview">
                <a href="<?php echo base_url()?>admin/home">
                    <i class="glyphicon glyphicon-eye-open"></i> <span>Tổng quan</span>
                </a>
            </li>
			
			<li id="quanly" class="treeview">
				<a href="#">
					<i class="glyphicon glyphicon-transfer"></i> <span>Quản lý</span> 
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					
					<li id="khachhang"><a href="/admin/khachhang"><i class="fa fa-caret-right"></i> Khách hàng</a></li>
					<li id="donhang"><a href="/admin/donhang"><i class="fa fa-caret-right"></i> Đơn hàng</a></li>
					<li id="danhmuc"><a href="/admin/danhmuc"><i class="fa fa-caret-right"></i> Danh mục</a></li>
                    <li id="sanpham"><a href="/admin/sanpham"><i class="fa fa-caret-right"></i> Sản phẩm</a></li>
					<li id="sanpham"><a href="/admin/baohanh"><i class="fa fa-caret-right"></i> Bảo hành</a></li>
                    <li id="chuyenmuc"><a href="/admin/chuyenmuc"><i class="fa fa-caret-right"></i> Chuyên mục</a></li>
                    <li id="baiviet"><a href="/admin/baiviet"><i class="fa fa-caret-right"></i> Bài viết</a></li>
					<li id="slideshow"> <a href="/admin/slideshow"><i class="fa fa-caret-right"></i> SlideShow</a></li>					
                    <li id="lienket"> <a href="/admin/lienket"><i class="fa fa-caret-right"></i> Liên kết</a></li>					 
                    <li id="trangdon"><a href="/admin/trangdon"><i class="fa fa-caret-right"></i> Trang độc lập</a></li>                   
                    <li id="mainmenu"><a href="/admin/mainmenu"><i class="fa fa-caret-right"></i> Menu chính</a></li>
					<li id="menu"><a href="/admin/menu"><i class="fa fa-caret-right"></i> Menu</a></li>					
					<!-- <li id="nhanvien"><a href="/admin/nhanvien"><i class="fa fa-caret-right"></i> Nhân viên</a></li>                  -->
                </ul>
			</li>
			<li id="hethong" class="treeview">
				<a href="#">
					<i class="glyphicon glyphicon-signal"></i> <span>Hệ thống</span> 
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li id="cauhinhsite"><a href="<?php echo base_url()?>admin/cauhinhsite"><i class="fa fa-caret-right"></i> Cấu hình site</a></li>
					<li id="cauhinhemail"><a href="<?php echo base_url()?>admin/cauhinhemail"><i class="fa fa-caret-right"></i> Cấu hình email</a></li>
					<li id="nguoidung"><a href="<?php echo base_url()?>admin/nguoidung"><i class="fa fa-caret-right"></i> Người dùng</a></li>					
					<li id="doimatkhau"><a href="<?php echo base_url()?>admin/doimatkhau"><i class="fa fa-caret-right"></i> Đổi mật khẩu</a></li>
				</ul>
			</li>
			
			<li><a href="javascript:ChekLogout();"><i class="fa fa-sign-out text-red"></i> <span>Thoát</span></a></li>
			<li><a href="#"><i class="fa fa-question-circle text-yellow"></i> <span>Trợ giúp</span></a></li>			
		  </ul>   	
    </section>
</aside>