

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Navbar Start -->
      <?php 
		$this->load->view('mainmenu');
		//$this->load->view('timkiem'); 
	?>
      <!-- Navbar End -->
    </header>
    <!-- Header Area wrapper End -->

    <!-- Page Header Start -->
    <div class="page-header" style="background: url(<?php echo base_url();?>public/assets/img/banner1.jpg);">
      <div class="container">
        <div class="row">         
          <div class="col-md-12">
            <div class="breadcrumb-wrapper">
			<h2 class="product-title">Tìm kiếm: "<?php echo $this->session->userdata('tukhoa');?>"</h2>
			  <ol class="breadcrumb">
				<li><a href="#"><?php echo count($list);?> kết quả tìm kiếm</a></li>				
			  </ol>
			</div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page Header End -->  

    <!-- Start Content -->
    <div id="content" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-12 col-xs-12"> 
            <!-- Start Post -->
			<?php
			foreach($list as $tintuc)
			{
				$img = "default.png";
				if(strlen($tintuc["bv_hinh"]) > 0)
					$img = $tintuc["bv_hinh"];
			?>
            <div class="blog-post">
              <div class="post-thumb">
                <a href="#"><img class="img-fluid" src="<?php echo base_url();?>uploads/baiviet/<?php echo $img;?>" alt=""></a>
                <div class="hover-wrap"></div>
              </div>
              <!-- Post Content -->
              <div class="post-content">
				<div class="meta">
					<span class="meta-part"><a href="#"><i class="lni-alarm-clock"></i> <?php echo date('d/m/Y H:i',strtotime($tintuc["bv_ngay_dang"]));?></a></span>
					<span class="meta-part"><a href="#"><i class="lni-eye"></i> <?php echo number_format($tintuc["bv_luot_xem"]);?></a></span>             
                </div>  
                             
                <h2 class="post-title"><a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html"><?php echo $tintuc["bv_ten"];?></a></h2>
				
				
			   <div class="entry-summary">
                  <p><?php echo $tintuc["bv_tom_tat"];?></p>
                </div>
                <a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html" class="btn btn-common">Đọc thêm</a>
              </div>
              <!-- Post Content -->
            </div>
			<?php
			}
			?>
            <!-- End Post -->
          </div>

          <!--Sidebar-->
          <aside id="sidebar" class="col-lg-4 col-md-12 col-xs-12 right-sidebar">
            <?php 
				$this->load->view('site/widget-timkiem');
				$this->load->view('site/widget-chuyenmuc');
				$this->load->view('site/widget-tinmoi');
				$this->load->view('site/widget-quangcao');
			?>
          <!--End sidebar-->

        </div>
      </div>
    </div>
    <!-- End Content -->

