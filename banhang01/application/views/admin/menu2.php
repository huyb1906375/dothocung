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
            <li class="header"><b>CHỨC NĂNG</b></li>
            <li id="home" class="treeview">
                <a href="<?php echo base_url()?>admin/home">
                    <i class="fa fa-bars"></i> <span>Tổng quan</span>
                </a>
            </li>
            <?php
			$chucnang = $this->chucnang_model->lay_danh_sach_chuc_nang("0", 1);

			foreach ($chucnang as $cn)
			{
				
				$chucnang1 = $this->chucnang_model->lay_danh_sach_chuc_nang($cn["cn_id"],1);
				
				if (count($chucnang1) > 0)
				{
			?>
            <li id="<?php echo $cn["cn_module"];?>" class="treeview">
                <a href="#">
                    <i class="fa fa-bars"></i><span><?php echo $cn["cn_ten"];?></span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                	<?php
                	foreach ($chucnang1 as $cn1)
                	{
					?>
                    <li id="<?php echo $cn1["cn_module"];?>">
                        <a href="<?php echo base_url()?>admin/<?php echo $cn1["cn_module"];?>">
                            <i class="fa fa-caret-right"></i> <?php echo $cn1["cn_ten"];?>
                        </a>
                    </li>
                    <?php
					}
					?>
                   
                </ul>
            </li>
            <?php
				}
				else
				{
			?>
            <li id="<?php echo $cn["cn_id"];?>" class="treeview">
                <a href="<?php echo base_url()?>admin/<?php echo $cn["cn_module"];?>">
                    <i class="fa fa-bars"></i> <span><?php echo $cn["cn_ten"];?></span>
                </a>
            </li>
            <?php
				}
			}
			?>
            
            <li><a href="javascript:ChekLogout();"><i class="fa fa-sign-out text-red"></i> <span>Thoát</span></a></li>
            <li><a href="#"><i class="fa fa-question-circle text-yellow"></i> <span>Trợ giúp</span></a></li>
        </ul>
    	
    </section>
    <!-- /.sidebar -->
</aside>