<div class="main-page-banner home-3">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<?php $this->load->view('menusanpham'); ?>
			</div>
		</div>
	</div>          
</div>
<div class="breadcrumb-area pt-30">
	<div class="container">
		<ol class="breadcrumb">
				<li><a href="<?php echo base_url();?>">Trang chủ</a></li>
				<?php
				if($rowcm["cm_id_parent"] != "0")
				{
					$cmparent = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($rowcm["cm_id_parent"]);
				?>
				<li><a href="<?php echo base_url();?>danh-muc/<?php echo $cmparent["cm_slug"];?>"><?php echo $cmparent["cm_ten"];?></a></li>
				<?php
				}
				?>
				<li class="active"><a href="<?php echo base_url();?>danh-muc/<?php echo $rowcm["cm_slug"];?>"><?php echo $rowcm["cm_ten"];?></a></li>
		</ol>
	</div>
</div>
<div class="main-shop-page pt-30 pb-30 ptb-sm-30">
	<div class="container">
		<!-- Row End -->
		<div class="row">
			
			<!-- Product Categorie List Start -->
			<div class="col-lg-12 order-1 order-lg-2">
				<!-- Grid & List View Start -->
				<form name="frm" action="" method="post"  enctype="multipart/form-data">
				<div class="grid-list-top border-default universal-padding justify-content-md-between align-items-center mb-30" style="min-height: 70px;float:left; position: relative; width: 100%;">
						
						<div class="grid-list-view mb-sm-15" style="float:left; position: relative;">
							<ul class="nav tabs-area d-flex align-items-center">
								<li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
								<li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
							</ul>
						</div>
						
						<!-- Toolbar Short Area Start -->
						<div class="main-toolbar-sorter" style="float:left; position: relative;">
							<div class="toolbar-sorter align-items-center">
								<!--<label>Sắp xếp theo:</label>-->
								<select name="cboSapXep" class="sorter wide" onchange="submit()">
									<option <?php if($this->session->userdata('order') == "Order") echo "selected"; ?> value="Order">Thứ tự mới nhất</option>
									<option <?php if($this->session->userdata('order') == "NameAZ") echo "selected"; ?> value="NameAZ">Tên từ A đến Z</option>
									<option <?php if($this->session->userdata('order') == "NameZA") echo "selected"; ?> value="NameZA">Tên từ Z đến A</option>
									<option <?php if($this->session->userdata('order') == "Price12") echo "selected"; ?> value="Price12">Giá từ thấp đến cao</option>
									<option <?php if($this->session->userdata('order') == "Price21") echo "selected"; ?> value="Price21">Giá từ cao đến thấp</option>
								</select>
							</div>
						</div>
						<!-- Toolbar Short Area End -->
						<!-- Toolbar Short Area Start -->
						<div class="main-toolbar-sorter" style="float:left; position: relative;">
							<div class="toolbar-sorter align-items-center" >
								<!--<label>Hiển thị:</label>-->
								<select name="cboGioiHan" class="sorter wide" onchange="submit()" >
									<option <?php if($this->session->userdata('limit') == "30") echo "selected"; ?>  value="30" >30</option>
									<option <?php if($this->session->userdata('limit') == "60") echo "selected"; ?> value="60">60</option>
									<option <?php if($this->session->userdata('limit') == "90") echo "selected"; ?> value="90">90</option>
									<option <?php if($this->session->userdata('limit') == "120") echo "selected"; ?> value="120">120</option>
									<option <?php if($this->session->userdata('limit') == "180") echo "selected"; ?> value="180">180</option>
								</select>
							</div>
						</div>
					
					<!-- Toolbar Short Area End -->
				</div>
				</form>
				
			</div>
			<div class="col-lg-12 order-1 order-lg-2">
				<!-- Grid & List View End -->
				<div class="main-categorie" style="border: 1px solid #ddd;">
					<!-- Grid & List Main Area End -->
					<div class="tab-content fix">
						<div id="grid-view" class="tab-pane fade show active">
							<div class="row">
								<?php
								foreach($list as $sanpham)
								{
								?>
								
									<div class="single-product col-lg-2 col-md-4 col-sm-6 col-6" style="border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 0px; margin-top: 0px; margin-bottom: 0px;">
										<div class="pro-img">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_id"];?>/<?php echo $sanpham["sp_slug"];?>.html">
												<img class="primary-img" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanpham["sp_hinh"];?>" alt="<?php echo $sanpham["sp_ten"];?>" style="height: 200px; padding-left: 10px; padding-right: 10px; padding-top: 10px;">
											</a>
											<a class="quick_cart"  onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham["sp_id"];?>','1','<?php echo $sanpham["sp_gia_ban"];?>')"><img src="<?php echo base_url();?>public/site/img/icon-cart.png"/></a>
										</div>
										<div class="pro-content">
											<div class="pro-info">
												<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham["sp_id"];?>/<?php echo $sanpham["sp_slug"];?>.html"><?php echo $sanpham["sp_ten"];?></a></h4>
												<?php
												if($sanpham["sp_giam_gia"] > 0)
												{
												?>
												<p><span class="price"><?php echo number_format($sanpham["sp_gia_ban"]);?></span><del class="prev-price"><?php echo number_format($sanpham["sp_gia_thi_truong"]);?></del></p>
												<div class="label-product l_sale">-<?php echo $sanpham["sp_giam_gia"];?><span class="symbol-percent">%</span></div>
												<?php
												}
												else
												{
												?>
												<p><span class="price"><?php if($sanpham["sp_gia_ban"] == 0) echo "liên hệ"; else echo number_format($sanpham["sp_gia_ban"]);?></span></p>
												<?php
												}
												?>
											</div>
											
										</div>
									</div>
								
								<?php
								}
								?>
								
							</div>
							<!-- Row End -->
						</div>
						<!-- #grid view End -->
						<div id="list-view" class="tab-pane fade">
							<!-- Single Product Start -->
							<?php
							foreach($list as $sanpham2)
							{
							?>
							<div class="single-product"> 
								<div class="row">        
									<div class="col-lg-4 col-md-5 col-sm-12">
										<div class="pro-img">
											<a href="<?php echo base_url();?>san-pham/<?php echo $sanpham2["sp_id"];?>/<?php echo $sanpham2["sp_slug"];?>.html">
												<img class="h260 primary-img" src="<?php echo base_url();?>uploads/sanpham/<?php echo $sanpham2["sp_hinh"];?>" alt="single-product">
											</a>
											<a class="quick_cart"  onclick="AddToCart('<?php echo $this->session->userdata("dh_id");?>','<?php echo $sanpham2["sp_id"];?>','1','<?php echo $sanpham2["sp_gia_ban"];?>')"><img src="<?php echo base_url();?>public/site/img/icon-cart.png"/></a>
											<?php
											if($sanpham2["sp_moi"] == 1)
											{
											?>
											<span class="sticker-new">new</span>
											<?php
											}
											?>
										</div>
									</div>
									<div class="col-lg-8 col-md-7 col-sm-12">
										<div class="pro-content">
											<h4><a href="<?php echo base_url();?>san-pham/<?php echo $sanpham2["sp_id"];?>/<?php echo $sanpham2["sp_slug"];?>.html" title="<?php echo $sanpham2["sp_ten"];?>"><?php echo $sanpham2["sp_ten"];?></a></h4>
											<?php
											if($sanpham2["sp_giam_gia"] > 0)
											{
											?>
											<p><span class="price"><?php echo number_format($sanpham2["sp_gia_ban"]);?></span><del class="prev-price"><?php echo number_format($sanpham2["sp_gia_thi_truong"]);?></del></p>
											<?php
											}
											else
											{
											?>
											<p><span class="price"><?php echo number_format($sanpham2["sp_gia_ban"]);?></span></p>
											
											<?php
											}
											?>
											<p><?php echo $sanpham2["sp_tom_tat"];?></p>
											
										</div>
									</div>
								</div>
							</div>
							<?php
							}
							?>
							
						</div>
						<?php echo $strphantrang ?>
					</div>
					<!-- Grid & List Main Area End -->
				</div>
			</div>
			<!-- product Categorie List End -->
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
