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
				
				<li class="active"><a href="/lien-he.html">Liên hệ</a></li>
			</ul>
		</div>
	</div>
</div> 
<div class="main-shop-page pt-30 pb-30 ptb-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 order-2 order-lg-1">
				<div class="sidebar">
					                         
					<?php $this->load->view('sieuviet/left-quangcao'); ?>
				</div>
			</div>

			<div class="col-lg-9 order-1 order-lg-2">
				<div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php echo $return_data['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?php echo $return_data['vnp_Amount'] ?></label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php echo $return_data['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $return_data['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php echo $return_data['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php echo $return_data['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $return_data['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                        
						if ($return_data['vnp_ResponseCode'] == '00') {
							echo "<span style='color:blue'>GD Thanh cong</span>";
						} else {
							echo "<span style='color:red'>GD Khong thanh cong</span>";
						}
                       
                        ?>

                    </label>
                </div> 
			</div>
		</div>
	</div>
</div>


