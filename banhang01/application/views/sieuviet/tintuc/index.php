<div class="main-page-banner home-3">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<?php $this->load->view('sieuviet/menusanpham'); ?>
			</div>
		</div>
	</div>          
</div>
<div class="breadcrumb-area mt-30">
	<div class="container">
		<div class="breadcrumb">
			<ul class="d-flex align-items-center">
				<li><a href="<?php echo base_url();?>">Trang chủ</a></li>
				<?php
				if($chuyenmuc["cm_id_parent"] != "0")
				{
					$cmparent = $this->chuyenmuc_model->lay_thong_tin_chuyen_muc($chuyenmuc["cm_id_parent"]);
				?>
				<li><a href="<?php echo base_url();?>chuyen-muc/<?php echo $cmparent["cm_slug"];?>.html"><?php echo $cmparent["cm_ten"];?></a></li>
				<?php
				}
				?>
				<li class="active"><a href="<?php echo base_url();?>chuyen-muc/<?php echo $chuyenmuc["cm_slug"];?>.html"><?php echo $chuyenmuc["cm_ten"];?></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="blog ptb-30  ptb-sm-30">
	<div class="container">
		<div class="main-blog">
			<div class="row">
				<?php
				foreach($tintuc_list as $tintuc)
				{
					$img = "default.png";
					if(strlen($tintuc["bv_hinh"]) > 0)
						$img = $tintuc["bv_hinh"];
				?>
				<div class="col-lg-6 col-sm-12" >
				   <div class="single-latest-blog">
					   <div class="blog-img">
						   <a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html"><img src="<?php echo base_url();?>uploads/baiviet/<?php echo $img;?>" alt="blog-image"></a>
					   </div>
					   <div class="blog-desc">
						   <h4><a href="<?php echo base_url();?>tin-tuc/<?php echo $tintuc["bv_slug"];?>.html"><?php echo $tintuc["bv_ten"];?></a></h4>
							
							<p><?php echo html_escape(character_limiter($tintuc["bv_tom_tat"], 140, '...')); ?></p>
					   </div>
					   <div class="blog-date">
							<span><?php echo date('d/m',strtotime($tintuc["bv_ngay_dang"]));?></span>
							<?php echo date('Y',strtotime($tintuc["bv_ngay_dang"]));?>
						</div>
				   </div>
				</div>
				<?php
				}
				?>
				
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php echo $strphantrang ?>
				</div>
			</div>
		</div>
	</div>
</div>
