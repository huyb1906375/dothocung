

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
  

		<?php 
			$this->load->view('mainmenu');
			
		?>
		<!-- Hero Area Start -->
		<div id="hero-area">
			<div class="overlay"></div>
			<div class="container">
			  <div class="row justify-content-center">
				<div class="col-md-12 col-lg-9 col-xs-12 text-center">
				  <div class="contents">
					<div class="search-bar">
					  <div class="search-inner">
						<form name="frmTimKiem" action="<?php echo base_url()."loai-bat-dong-san/".$slug;?>" method="post" class="search-form">
						  <div class="form-group">
							<input type="text" name="txtTuKhoa" class="form-control" placeholder="Từ khóa tìm kiếm" value="<?php echo $this->session->userdata('tu_khoa');?>">
						  </div>
						  <div class="form-group inputwithicon">
							<div class="select">
							  <select id="cboKhuVuc" name="cboKhuVuc">
									<option value="">Khu vực</option>
									<?php
									$quanhuyen = $this->quanhuyen_model->lay_danh_sach_quan_huyen("kiengiang");
									foreach ($quanhuyen as $qh) 
									{
										echo "<option ".(($this->session->userdata('qh_id') == $qh["qh_id"])?"selected":"")." value='".$qh["qh_id"]."'>".$qh["qh_ten"]."</option>";
										
									}
									?>
							  </select>
							</div>
							<i class="lni-target"></i>
						  </div>
						  <div class="form-group inputwithicon">
							<div class="select">
							  <select id="cboLoaiBDS" name="cboLoaiBDS">
									<option value="tatca">Loại bất động sản</option>
									<?php
									$parent = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc("0","loai-bat-dong-san","", "");
									$option = "";
									foreach ($parent as $p) 
									{
										echo "<option ".(($this->session->userdata('cm_id') == $p["cm_id"])?"selected":"")." value='".$p["cm_id"]."'>".$p["cm_ten"]."</option>";
										$child = $this->chuyenmuc_model->lay_danh_sach_chuyen_muc($p["cm_id"],"loai-bat-dong-san","","");
										foreach ($child as $c) 
										{
											echo "<option ".(($this->session->userdata('cm_id') == $c["cm_id"])?"selected":"")." value='".$c["cm_id"]."'>|-----".$c["cm_ten"]."</option>";
										}
									}
									?>
							  </select>
							</div>
							<i class="lni-menu"></i>
						  </div>
						  <input type="submit" name="btnTimKiem" class="btn btn-common" value="Tìm kiếm"/>
						  <!--<button id="btnTimKiem" name="btnTimKiem" class="btn btn-common" type="submit"><i class="lni-search"></i> Tìm kiếm</button>-->
						</form>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<!-- Hero Area End -->
	</header>
    <!-- Header Area wrapper End -->
	<!-- Page Header Start -->
<div class="page-header" style="background: url(<?php echo base_url();?>public/assets/img/banner1.jpg);padding-top: 40px;">
  <div class="container">
	<div class="row">         
	  <div class="col-md-12">
		<div class="breadcrumb-wrapper">
			<h2 class="product-title"><?php echo $rowcm["cm_ten"];?></h2>
		  <ol class="breadcrumb">
			<li><a href="/">Trang chủ /</a></li>
			<li class="current"><a href="<?php echo base_url();?>chuyen-muc/<?php echo $rowcm["cm_slug"];?>.html"><?php echo $rowcm["cm_ten"];?></a></li>
		  </ol>
		</div>
	  </div>
	</div>
  </div>
</div>
<!-- Page Header End -->  
    <!-- Main container Start -->  
    <div class="main-container section-padding">
      <div class="container">
        <div class="row">

           
            <!-- Adds wrapper Start -->
            <div class="adds-wrapper">
              <div class="tab-content">
                <div id="grid-view" class="tab-pane fade active show">
                  <div class="row">
					<?php
					foreach($list as $bds)
					{
						$img = "default.png";
						if(strlen($bds["bds_hinh"]) > 0)
							$img = $bds["bds_hinh"];
						$gia = "Giá: ";
						if($bds["bds_gia_ban"] == 0)
							$gia = $gia."liên hệ";
						else
						{
							if($bds["bds_gia_ty"] > 0)
								$gia = $gia.$bds["bds_gia_ty"]." tỷ ";
							if($bds["bds_gia_trieu"] > 0)
								$gia = $gia.$bds["bds_gia_trieu"]." triệu";
							else
							{
								if($bds["bds_gia_ty"] == 0)
									$gia = $bds["bds_gia_ban"]." đồng";
								else $gia.$bds["bds_gia_ban"]." đồng";
							}
						}
					?>
                    <div  class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
						<div class="featured-box">
						  <figure>
							<div class="homes-tag featured"><a href="<?php echo base_url();?>loai-bat-dong-san/<?php echo $bds["cm_slug"];?>/<?php echo $bds["qh_slug"];?>.html"><i class="lni-folder"></i> <?php echo $bds["cm_ten"];?> </a></div>
							<div class="homes-tag rent"><i class="lni-heart"></i> <?php echo number_format($bds["bds_luot_thich"]);?></div>
							<span class="price-save">
							  <?php echo $gia;?>
							</span>
							<a href="<?php echo base_url();?>bat-dong-san/<?php echo $bds["bds_slug"];?>.html"><img class="img-fluid" src="<?php echo base_url();?>uploads/batdongsan/<?php echo $img;?>" alt=""></a>
						  </figure>
						  <div class="content-wrapper">
							<div class="feature-content">
							  <h4><a href="<?php echo base_url();?>bat-dong-san/<?php echo $bds["bds_slug"];?>.html"><?php echo $bds["bds_ten"];?></a></h4>
							  <div class="meta-tag">
								<div class="listing-review">
								  <span class="review-avg"><i class="lni-eye"></i> <?php echo number_format($bds["bds_luot_xem"]);?></span>    
								</div>
								<!--
								<div class="user-name">
								  <a href="#"><i class="lni-user"></i> <?php echo $bds["nd_ten"];?></a>
								</div>
								-->
								<div class="listing-category">
								  <a href="#"><i class="lni-alarm-clock"></i><?php echo date('d/m/Y H:i',strtotime($bds["bds_ngay_dang"]));?></a>         
								</div>
							  </div>
							</div>
							<div class="listing-bottom clearfix">
							  <a href="<?php echo base_url();?>loai-bat-dong-san/<?php echo $bds["qh_slug"];?>/<?php echo $bds["cm_slug"];?>" class="float-left"><i class="lni-map-marker"></i> <?php echo $bds["qh_ten"];?></a>
							  <a href="ads-details.html" class="float-right">Xem chi tiết</a> 
							</div>
						  </div>
						</div>
                    </div>
					<?php
					}
					?>
                    
                  </div>
                </div>
                
              </div>
            </div>
            <!-- Adds wrapper End -->
			<!--
            <div class="col-12 text-center">
				<a href="#" class="btn btn-common">XEM THÊM</a>
				
			</div>
			-->
        </div>
		<?php echo $strphantrang ?>
      </div>
    </div>

    <!-- Main container End -->  

