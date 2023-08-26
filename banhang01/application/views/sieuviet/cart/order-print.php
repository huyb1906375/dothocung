<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đơn hàng <<<?php echo $donhang["dh_id"];?>>></title>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/print.css">
<script src="<?php echo base_url();?>public/js/TTHJScript.js"></script>
</head>

<body>
<div id="wrapper" style="width: 800px;">
	<div id="donhang">
		<div id="container" style="width: 800px;">
        	<table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px;margin-bottom: 30px;">
                <tr>
                    <td><b><?php echo chs_don_vi;?></b></td> 
                    <td rowspan="3" class="w120"><img width="150px" src="<?php echo base_url()."barcode/gen_barcode/".$donhang["dh_id"]."/code128/50";?>"/></td>                    
                </tr>
                <tr>
                    <td><b>ĐC: <?php echo chs_dia_chi;?></b></td> 
                </tr>
               	<tr>
                    <td><b>ĐT: <?php echo chs_dien_thoai;?></b></td>
                </tr>
            </table>
            <table width="100%" cellpadding="5" cellspacing="0" style="margin-top: 10px;margin-bottom: 30px;">
                <tr>
                    <td class="cell-text" style="text-align: center; font-size: 20px;">HÓA ĐƠN BÁN HÀNG</td>                    
				</tr>
                <tr>
                    <td style="text-align: center;">Ngày: <?php echo date('d/m/Y H:s',strtotime($donhang["dh_ngay_lap"]));?><br/>Số: <?php echo $donhang["dh_id"];?></td>                    
				</tr>
               	
			</table>
			<table width="100%" cellpadding="5" cellspacing="0" style="margin-top: 10px;margin-bottom: 10px;">
                <tr>
                    <td class="cell-text">Khách hàng:</td>
                    <td class="cell-control"><?php echo $donhang["dh_ten"];?></td>
                </tr>
                <tr>
                    <td class="cell-text">Địa chỉ:</td>
                    <td class="cell-control"><?php echo $donhang["dh_dia_chi"];?></td>
                </tr>
                <tr>
                    <td class="cell-text">Điện thoại:</td>
                    <td class="cell-control"><?php echo $donhang["dh_dien_thoai"];?></td>
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
                	<td class="text-center w30"><?php echo $i;?></td>
                    <td><?php echo $giohang["sp_ten"];?></td>
                    <td class="text-center w80"><?php echo $giohang["dhct_so_luong"];?></td>
                    <td class="text-right w100"><?php echo number_format($giohang["dhct_don_gia"]);?></td>
                    <td class="text-right w100"><?php echo number_format($giohang["dhct_thanh_tien"]);?></td>
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
                <tr>
					<td colspan="5" class="text-right text-bold"><?php echo $this->utils->convert_number_to_words($donhang["dh_tong_cong"]);?></td>                    
                   
                </tr>
            </table>
			<table width="100%" cellpadding="5" cellspacing="0" style="margin-top: 20px;margin-bottom: 20px;">
                <tr>
                    <td style="width: 300px; text-align: center; line-height: 150%;"><b>Khách hàng</b><br/>(Ký, ghi họ tên)</td>
                    <td>&nbsp;</td>
					<td style="width: 300px; text-align: center; line-height: 150%;"><b>Người lập</b><br/>(Ký, ghi họ tên)</td>
                </tr>
               
            </table>
        </div>
    </div>
	<!--
	<div class="row">
		<a class="button" href="javascript:printIt('donhang')" style="width: 150px">In đơn hàng</a>
		<a class="button" href="javascript:goBack()" style="width: 150px">Quay về</a>
	</div>
	-->
</div>
<script>
	window.print();
	window.history.back();
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
