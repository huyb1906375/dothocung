<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="public/images/admin/" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Trực tuyến</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">DANH MỤC QUẢN LÝ</li>
            <li class="treeview">
                <a href="<?php echo base_url() ?>admin">
                    <i class="glyphicon glyphicon-blackboard"></i> <span>Thống kê</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-cd"></i><span>Sản phẩm</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url()?>admin/product/insert">
                            <i class="glyphicon glyphicon-file"></i> Thêm sản phẩm
                        </a>
                    </li>
                    <li>
    					<a href="<?php echo base_url()?>admin/product">
    						<i class="glyphicon glyphicon-list"></i> Danh sách sản phẩm
    					</a>
    				</li>
                    <li>
    					<a href="<?php echo base_url()?>admin/category">
    						<i class="glyphicon glyphicon-list"></i> Danh mục loại sản phẩm
    					</a>
    				</li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-text-background"></i><span>Bài viết</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="<?php echo base_url() ?>admin/content/insert">
                            <i class="fa fa-pencil-square-o"></i> Thêm bài viết
                        </a>
                    </li>
                    <li >
                        <a href="<?php echo base_url() ?>admin/content">
                            <i class="glyphicon glyphicon-list"></i> Danh sách bài viết
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>admin/topic">
                            <i class="glyphicon glyphicon-list"></i> Chủ đề bài viết
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-shopping-cart"></i><span>Bán hàng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url() ?>admin/orders">
                            <i class="glyphicon glyphicon-list-alt"></i> Danh sách đơn hàng
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-log-in"></i> Nhập hàng
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() ?>admin/customer">
                    <i class="glyphicon glyphicon-user"></i><span>Khách hàng</span>
                </a>
            </li>
    		<li class="treeview">
                <a href="#">
                    <i class="fa fa-align-justify"></i><span>Giao diện</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
    					<a href="<?php echo base_url() ?>admin/sliders">
    						<i class="fa fa-cogs"></i> Sliders
    					</a>
    				</li>
                </ul>
            </li>
    		<li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-cog"></i><span>Hệ thống</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
    					<a href="#">
    						<i class="fa fa-cogs"></i> Cấu hình
    					</a>
    				</li>
                    <li>
    					<a href="#">
    						<i class="fa fa-users"></i> Thành viên
    					</a>
    				</li>
                </ul>
            </li>
            <li><a href="admin/user/logout.html"><i class="fa fa-sign-out text-red"></i> <span>Thoát</span></a></li>
            <li><a href="#"><i class="fa fa-question-circle text-yellow"></i> <span>Trợ giúp</span></a></li>
        </ul>
    	
    </section>
    <!-- /.sidebar -->
</aside>