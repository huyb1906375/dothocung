<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đơn hàng <<<?php echo $donhang["dh_id"];?>>></title>
<style>
.text-bold
{
	font-weight: bold;
}
.text-center
{
    text-align: center;
}
.text-left
{
    text-align: left;
}
.text-right
{
    text-align: right;
}
.cell
{ 
	PADDING: 5px;
}
.cell-text
{ 
	width:120px; 
	text-align: left;	
	PADDING: 7px;
	FONT-WEIGHT: bold; 
	COLOR: #000000; 	 
	FONT-FAMILY: Arial; 
}
.cell-control
{
	text-align: left;
	PADDING: 7px; 	
	FONT-FAMILY: Arial;
}
.table
{
	border-left:#ddd 2px solid;
	border-top:#ddd 2px solid;
}
.table th
{
	border-right: #ddd 2px solid; 
	border-bottom: #ddd 2px solid; 
    font-weight: bold; 
	padding: 7px; 
    color: #000000; 
    font-family: Arial; 
    background-color: #D7E3F2;
}
.table td
{
	
    border-right: #ddd 2px solid; 
	border-bottom:#ddd 2px solid; 
    color: #000000; 
    padding: 7px;    
    font-family: Arial; 
}
</style>
</head>

<body>
<div id="wrapper" style="width: 800px;">
	<div id="donhang">
		<div id="container" style="width: 800px;">
        	<table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px;margin-bottom: 30px;">
                <tr>
                    <td><b>Cảm ơn quý khách <?php echo $donhang["dh_ten"];?> đã đặt hàng tại <b><?php echo chs_don_vi;?></b>,</b></td>                                   
                </tr>
                <tr>
                    <td><b><?php echo chs_don_vi;?></b> rất vui thông báo đơn hàng <?php echo $donhang["dh_id"];?> của quý khách đã được tiếp nhận và đang trong quá trình xử lý. <b><?php echo chs_don_vi;?></b> sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</td> 
                </tr>
               	
            </table>
            <table width="100%" cellpadding="5" cellspacing="0" style="margin-top: 10px;margin-bottom: 30px;">
                <tr>
                    <td><span style="font-weight: bold; color: #007DB5;">Thông tin đơn hàng <?php echo $donhang["dh_id"];?></span> (Ngày <?php echo date('d/m/Y H:s',strtotime($donhang["dh_ngay_lap"]));?>)</td>                    
				</tr>
              	
			</table>
			<table width="100%" cellpadding="5" cellspacing="0" style="margin-top: 10px;margin-bottom: 10px;">
                <tr>
                    <td class="cell" style="width: 50%"><b>Thông tin thanh toán:</b></td>
                    <td class="cell" style="width: 50%"><b>Địa chỉ giao hàng:</b></td>
                </tr>
				<tr>
                    <td class="cell"><b>Name:</b> <?php echo $this->session->userdata("user_ten");?></td>
                    <td class="cell"><b>Name:</b> <?php echo $donhang["dh_ten"];?></td>
                </tr>
                <tr>
                    <td class="cell"><b>Email:</b> <?php echo $this->session->userdata("user_email");?></td>
                    <td class="cell"><b>Addres:</b> <?php echo $donhang["dh_dia_chi"];?></td>
                </tr>
                <tr>
                    <td class="cell"><b>Phone:</b> <?php echo $this->session->userdata("user_dienthoai");?></td>
                    <td class="cell"><b>Phone:</b> <?php echo $donhang["dh_dien_thoai"];?></td>
                </tr>
            </table>
            <table width="100%" cellpadding="5" cellspacing="0" class="table">
            	
                <tr>
                	<th>STT</th>
                    <th>Tên hàng</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
				$total = 0;
				$i = 1;
				foreach($donhangchitiet as $giohang)
				{
					
					$total = $total + $giohang["dhct_thanh_tien"];
				?>
                <tr>
                	<td class="text-center" style="width: 30px;"><?php echo $i;?></td>
                    <td><?php echo $giohang["sp_ten"];?></td>
                    <td class="text-center" style="width: 80px;"><?php echo $giohang["dhct_so_luong"];?></td>
                    <td class="text-right" style="width: 100px;"><?php echo number_format($giohang["dhct_don_gia"]);?></td>
                    <td class="text-right" style="width: 100px;"><?php echo number_format($giohang["dhct_thanh_tien"]);?></td>
                </tr>
                <?php
				$i = $i + 1;
				}
				?>
                <tr>
                	<td colspan="4" class="text-right text-bold">Tiền hàng:</td>                    
                    <td class="text-right text-bold"><?php echo number_format($donhang["dh_tien_hang"]);?></td>
                </tr>
				<tr>
                	<td colspan="4" class="text-right text-bold">Phí vận chuyển:</td>                    
                    <td class="text-right text-bold"><?php echo number_format($donhang["dh_phi_van_chuyen"]);?></td>
                </tr>
				<tr>
                	<td colspan="4" class="text-right text-bold">Tổng cộng:</td>                    
                    <td class="text-right text-bold"><?php echo number_format($donhang["dh_tong_cong"]);?></td>
                </tr>
            </table>
        </div>
    </div>
</div>