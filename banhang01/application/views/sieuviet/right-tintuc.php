<!-- START NAV TABS -->
	<div class="tabs-wrapper">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">TIN XEM NHIỀU</a></li>
			<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">TIN TIÊU ĐIỂM</a></li>
		</ul>
		<!-- Tab panels one --> 
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="home">

				<div class="most-viewed">
					<ul id="most-today" class="content tabs-content">
						<?PHP
						$tintuc_list = $this->baiviet_model->lay_danh_sach_bai_viet_xem_nhieu( "", 5, 0);
						$i = 1;
						foreach($tintuc_list as $tintuc)
						{
							$img = "default.png";
							if(strlen($tintuc["bv_hinh"]) > 0)
								$img = $tintuc["bv_hinh"];
						?>
						<li>
							<span class="count">0<?php echo $i;?></span>
							
							<span class="text">
								<a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html">
									<?php echo $tintuc["bv_ten"];?>
								</a>
							</span>
						</li>
						<?php
						$i = $i + 1;
						}
						?>
						
					</ul>
				</div>
			</div>
			<!-- Tab panels two --> 
			<div role="tabpanel" class="tab-pane fade" id="profile">
				<div class="most-viewed">
					<ul id="most-today" class="content tabs-content">
					<?PHP
					$tintuc_list = $this->baiviet_model->lay_danh_sach_bai_viet_gioi_han("", "tieudiem", "", 5, 0);
					foreach($tintuc_list as $tintuc)
					{
						$img = "default.png";
						if(strlen($tintuc["bv_hinh"]) > 0)
							$img = $tintuc["bv_hinh"];
					?>
					<li>
						
						<div class="col-xs-5 col-sm-5 col-md-5 p-left0 p-right0">
							<a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html"><img src="<?php echo base_url();?>uploads/baiviet/<?php echo $img;?>" alt="" class="img-responsive"></a>
						</div>
						<div class="col-xs-7 col-sm-7 col-md-7 p-right0">						
							<a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html">
								<h5 class="text-title"><?php echo $tintuc["bv_ten"];?><h5>
							</a>						
						</div>
						
					</li>
					
					<?php
					}
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- END OF /. NAV TABS -->