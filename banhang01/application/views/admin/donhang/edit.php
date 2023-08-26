<form name="frmDonHang" id="frmDonHang" action="<?php echo base_url();?>admin/donhang/edit/<?php echo $donhang['dh_id'];?>" method="post"  enctype="multipart/form-data"  onsubmit="return KiemTraDonHang();">
<section class="content-header">
  	<h1>
        ĐƠN HÀNG
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-bars"></i> Trang chủ</a></li>
    	<li class="active">Đơn hàng</li>
  	</ol>
</section>
<section class="content">
	<div class="row">
        <div class="box box-primary">
            <div class="box-body no-padding-left-right">
                <div id="left" class="col-md-8 border-right">  
                    
                    <div id="donhangchitiet" class="form-group col-md-12 no-padding table-responsive" style="border: 1px solid #ddd; min-height: 450px;">
						<table class="table table-hover table-bordered table-responsive">
							<tr class="bg-light-blue"> 
								<th class="w10 text-center">#</th> 
								<th class="text-center">Tên hàng</th> 
								<th class="w80 text-center">Số lượng</th> 
								<th class="w120 text-center">Đơn giá</th> 
								<th class="w120 text-center">Thành tiền</th> 
								<th class="w50 text-center"><span class="glyphicon glyphicon-trash"></span></th> 
							</tr>
							<?php
							$total = 0;
							$i = 1;
							foreach($donhangchitiet as $giohang)
							{
								
								$total = $total + $giohang["dhct_thanh_tien"];
							?>
							<tr> 
								<td class="text-center"><?php echo $i;?></td> 
								<td><a href="" id="<?php echo $giohang["dhct_id"];?>" class="text-bold"><?php echo $giohang["sp_ten"];?></a></td> 
								<td>
									<div class="input-group">
									<input type="text" id="<?php echo $giohang["dhct_id"];?>" class="form-control text-soluong text-center"  value="<?php echo $giohang["dhct_so_luong"];?>" onkeyup="UpdateSoLuong(<?php echo $giohang["dhct_dh_id"];?>,this.id, this.value,<?php echo $giohang["dhct_don_gia"];?>)" onfocus="this.setSelectionRange(0,this.value.length)"/> 
									<span class="input-group-btn">
									<a href="javascript:SuaDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,<?php echo $giohang["dhct_id"];?>, <?php echo ($giohang["dhct_so_luong"]+1);?>,<?php echo $giohang["dhct_don_gia"];?>)" class="btn btn-primary btn-flat button-soluong">+</a>
									<a href="javascript:SuaDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,<?php echo $giohang["dhct_id"];?>, <?php echo ($giohang["dhct_so_luong"]-1);?>,<?php echo $giohang["dhct_don_gia"];?>)" class="btn btn-primary btn-flat button-soluong">-</a>
									</span>
									</div>
								</td> 
								<td class="text-right"><?php echo number_format($giohang["dhct_don_gia"]);?></td> 
								<td class="text-right"><?php echo number_format($giohang["dhct_thanh_tien"]);?></td> 
								<td class="text-center"> 
									<a title="Xóa" href="javascript:XoaDonHangChiTiet(<?php echo $giohang["dhct_dh_id"];?>,<?php echo $giohang["dhct_id"];?>)"> 
									<span class="glyphicon glyphicon-trash"></span>
									</a> 
								</td> 
							</tr>  
							<?php
							$i = $i + 1;
							}
							?>
						</table> 
					</div>
                  
                </div>
                <div id="right" class="col-md-4">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><b>Thông tin đặt hàng</b></a></li>
                          <li><a href="#tab_2" data-toggle="tab" aria-expanded="false"><b>Thông tin thanh toán</b></a></li>
                          
                        </ul>
                        <div class="tab-content no-padding">
                            <div class="tab-pane active" id="tab_1">
                                 <div class="form-group m-top10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-fw fa-server"></i>
                                        </div>
                                        
                                        <input type="text" id="txtID" name="txtID" class="form-control text-bold txtID" value="<?php echo $donhang["dh_id"];?>" readonly="readonly"/>
                                        <input type="hidden" id="txtKyHieu" name="txtKyHieu" class="form-control text-bold txtID" value="<?php echo $donhang["dh_ky_hieu"];?>"/>
                                    </div>
                                </div>
                                <div class="form-group m-top10">
                                    <div class='input-group date' id='dateNgayLap'>
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input id="txtNgayLap" name="txtNgayLap" type='text' class="form-control text-bold" value="<?php echo date('Y-m-d H:i:s',strtotime($donhang["dh_ngay_lap"]));?>"  readonly="readonly"/>
                                    </div>
                                </div>
								<!--
                                <div class="form-group">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left">Tài khoản:</div>
										<input type="text" id="txtTenNguoiDung" name="txtTenNguoiDung" class="form-control text-bold" value="<?php echo $donhang["dh_ten"];?>"/>
										<input type="hidden" id="txtIDNguoiDung" name="txtIDNguoiDung" class="form-control text-bold" value="<?php echo $donhang["dh_dt_id"];?>"/>
                                    </div>
                                    <div class="btn-group btn-group-justified">
					                    
										<div class="btn-group">
						                    <button class="btn btn-default btn-flat btn-xs" type="button" id="btnThemDoiTac" onclick="ShowFormThongTinDoiTac('Them')"><i class="fa fa-plus"></i> Thêm khách hàng </button>
					                    </div>
										
					                    <div class="btn-group">
						                    <button class="btn btn-default btn-flat btn-xs" type="button" id="btnLichSu" onclick="ShowFormLichSu()"><i class="fa fa-list-alt"></i> Lịch sử mua hàng</button>
					                    </div>
				                    </div>
										
									
                                </div>
								-->
								<div class="form-group">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left text-bold">Người nhận:</div>
										<input type="text" id="txtHoTen" name="txtHoTen" class="form-control" value="<?php echo $donhang["dh_ten"];?>"/>
										<input type="hidden" id="txtIDDoiTac" name="txtIDDoiTac" class="form-control" value="<?php echo $donhang["dh_dt_id"];?>"/>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left text-bold">Địa chỉ:</div>
										<input type="text" id="txtDiaChi" name="txtDiaChi" class="form-control" value="<?php echo $donhang["dh_dia_chi"];?>"/>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left text-bold">Điện thoại:</div>
										<input type="text" id="txtDienThoai" name="txtDienThoai" class="form-control" value="<?php echo $donhang["dh_dien_thoai"];?>"/>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left text-bold">Email:</div>
										<input type="text" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $donhang["dh_email"];?>"/>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label>Ghi chú:</label>
									<textarea id="txtGhiChu" name="txtGhiChu" class="form-control" cols="30" rows="2"><?php echo $donhang["dh_ghi_chu"];?></textarea>              
                                </div>
                                
                            </div>
                            <div class="tab-pane" id="tab_2">
                                
                                
                               
								<div class="form-group m-top10">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left text-bold">Tiền hàng:</div>
										<input type="text" id="txtTienHang" name="txtTienHang" class="form-control text-right text-bold" value="<?php echo number_format($donhang["dh_tien_hang"]);?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon min-width100 text-left text-bold">Phí ship: <a  onclick="ShowFormGiamGia()"><i class="fa fa-calendar"></i></a></div>                                       
                                        <input type="text" id="txtPhiVanChuyen" name="txtPhiVanChuyen" class="form-control text-right text-bold" value="<?php echo number_format($donhang["dh_phi_van_chuyen"]);?>" onkeyup="UpdatePhiVanChuyen()"  onfocus="this.setSelectionRange(0,this.value.length)"/>                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left text-bold">Tổng cộng:</div>
										<input type="text" id="txtTongCong" name="txtTongCong" class="form-control text-right text-bold" value="<?php echo number_format($donhang["dh_tong_cong"]);?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
										<div class="input-group-addon min-width100 text-left text-bold">Thanh toán: <a  onclick="SetThanhToan()"><i class="fa fa-check-square-o"></i></a></div>
										<input type="text" id="txtThanhToan" name="txtThanhToan" class="form-control text-right text-bold" value="<?php echo number_format($donhang["dh_thanh_toan"]);?>"/>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label>Phương thức thanh toán:</label>
									<select name="cboPhuongThuc" id="cboPhuongThuc" class="form-control" style="width: 100%;">										
										<option <?php if($this->session->userdata('phuongthuc') == "thanhtoansau") echo "selected"; ?> value="thanhtoansau">Thanh toán sau khi nhận hàng</option>
										<option <?php if($this->session->userdata('phuongthuc') == "thanhtoantruoc") echo "selected"; ?> value="thanhtoantruoc">Thanh toán trước bằng chuyển khoản</option>										
									</select>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái:</label>
									<select name="cboTrangThai" id="cboTrangThai" class="form-control" style="width: 100%;">
										
										<option <?php if($donhang["dh_trang_thai"] == "1") echo "selected"; ?> value="1">Mới tiếp nhận</option>
										<option <?php if($donhang["dh_trang_thai"] == "2") echo "selected"; ?> value="2">Đang xử lý</option>
										<option <?php if($donhang["dh_trang_thai"] == "3") echo "selected"; ?> value="3">Đang giao hàng</option>
										<option <?php if($donhang["dh_trang_thai"] == "4") echo "selected"; ?> value="4">Đã hoàn thành</option>
									</select>             
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú vận chuyển:</label>
									<textarea id="txtGhiChuVanChuyen" name="txtGhiChuVanChuyen" class="form-control" cols="30" rows="2"><?php echo $donhang["dh_ghi_chu_van_chuyen"];?></textarea>              
                                </div>
                            </div>
                        </div>                   
                    </div><!-- nav-tabs-custom -->
                    <div class="btn-group btn-group-justified">
					    <div class="btn-group">
						    <input type="button" class="btn btn-success btn-flat" type="button" id="btnLuuIn" name="btnLuuIn" value="Lưu & in" onclick="LuuIn()"/>
					    </div>
					    <div class="btn-group">
					        <input type="button" class="btn btn-danger btn-flat" type="button" id="btnLuuDong" name="btnLuuDong"  value="Lưu & đóng" onclick="LuuDong()"/>
					        
					    </div>
					    <div class="btn-group">
						    <a href="/admin/donhang" class="btn btn-warning btn-flat">Trở về</a>
					    </div>
				    </div>   
                </div>
            </div>
        </div>
    </div>
  	<!-- /.row -->
</section>
<script type="text/javascript">


document.frmDonHang.txtHoTen.focus();
function KiemTraDonHang()
{
	var ten = $('#txtHoTen').val();	
	var diachi = $('#txtDiaChi').val();
	var dienthoai = $('#txtDienThoai').val();
	var email = $('#txtEmail').val();
	//var tienhang = $('#txtTienHang').val();
	if(ten.length == 0)
	{
		alert("Họ tên không được để trống!");
		$('#txtHoTen').focus();
		return false;
	}
	if(diachi.length == 0)
	{
		alert("Địa chỉ không được để trống!");
		$('#txtDiaChi').focus();
		return false;
	}
	if(dienthoai.length == 0)
	{
		alert("Số điện thoại không được để trống!");
		$('#txtDienThoai').focus();
		return false;
	}
	/*
	if(tienhang == 0)
	{
		alert("Không có hàng hóa nào trong giỏ hàng!");
		return false;
	}
	*/
	return true;
}

function ThemDonHangChiTiet(dh_id, sp_id, sp_gia_ban, so_luong)
{
	var phivanchuyen = $('#txtPhiVanChuyen').val();
	phivanchuyen = phivanchuyen.replace(",","");
	$.ajax({
		url: '<?php echo base_url(); ?>admin/ajaxdonhang/ajax_them_don_hang_chi_tiet',
		type: 'POST',
		data: {
			'dh_id': dh_id,
			'sp_id': sp_id,			
			'sp_don_gia': sp_gia_ban,
			'so_luong': so_luong,
			'dh_phi_van_chuyen': phivanchuyen
		},
		success: function (result) {
			var s = result.split("|");	
			if(s[0] == "1") 
			{
				if(s[1] == "0")
					gourl('<?php echo base_url();?>admin/donhang');
				else
				{	
					LayDanhSachDonHangChiTiet(dh_id);
					$('#txtTienHang').val(formatCurrency(s[1]));
					$('#txtPhiVanChuyen').val(formatCurrency(s[2]));
					$('#txtTongCong').val(formatCurrency(s[3]));
				}
			}
			else 
			{
				alert(s[1]);
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
	//alert(dh_id + ' - ' + sp_id + ' - ' + sp_gia_ban);
}
function SuaDonHangChiTiet(dh_id, dhct_id, dhct_soluong, dhct_dongia)
{
	//alert(dhct_soluong);
	var phivanchuyen = $('#txtPhiVanChuyen').val();
	phivanchuyen = phivanchuyen.replace(",","");
	if(dhct_soluong <= 0)
	{
		XoaDonHangChiTiet(dh_id, dhct_id);
		return;
	}
	$.ajax({
		url: '<?php echo base_url(); ?>admin/ajaxdonhang/ajax_update_so_luong',
		type: 'POST',
		data: {
			'dh_id': dh_id,
			'dhct_id': dhct_id,
			'dhct_soluong': dhct_soluong,
			'dhct_dongia': dhct_dongia,
			'dh_phi_van_chuyen': phivanchuyen
		},
		success: function (result) {
			var s = result.split("|");	
			if(s[0] == "1")
			{
				if(s[1] == "0")
					gourl('<?php echo base_url();?>admin/donhang');
				else
				{	
					LayDanhSachDonHangChiTiet(dh_id);
					$('#txtTienHang').val(formatCurrency(s[1]));
					$('#txtPhiVanChuyen').val(formatCurrency(s[2]));
					$('#txtTongCong').val(formatCurrency(s[3]));
				}
			}
			else 
			{
				alert(s[1]);
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
function LayDanhSachDonHangChiTiet(dh_id)
{	
	var url = "/admin/ajaxdonhang/ajax_lay_danh_sach_don_hang_chi_tiet/"+dh_id;
	loadDuLieu('donhangchitiet',url);
}
/*
function LayDanhSachDonHangChiTiet(dh_id, divFocus)
{	
	var url = "/admin/ajaxdonhang/ajax_lay_danh_sach_don_hang_chi_tiet/"+dh_id;
	loadDuLieu('donhangchitiet',url);
	$('#'+divFocus).focus();
}
*/
function XoaDonHangChiTiet(dh_id, dhct_id)
{
	var phivanchuyen = $('#txtPhiVanChuyen').val();
	phivanchuyen = phivanchuyen.replace(",","");
	//alert(phivanchuyen);
	$.ajax({
		url: 'admin/ajaxdonhang/ajax_xoa_don_hang_chi_tiet',
		type: 'POST',
		data: {
			'dh_id': dh_id,
			'dhct_id': dhct_id,
			'dh_phi_van_chuyen': phivanchuyen
		},
		success: function (result) {
			var s = result.split("|");	
			if(s[0] == "1") 
			{
				if(s[1] == "0")
					gourl('<?php echo base_url();?>admin/donhang');
				else
				{	
					LayDanhSachDonHangChiTiet(dh_id);
					$('#txtTienHang').val(formatCurrency(s[1]));
					$('#txtPhiVanChuyen').val(formatCurrency(s[2]));
					$('#txtTongCong').val(formatCurrency(s[3]));
				}
			}
			else 
			{
				alert(s[1]);
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
function LayThongTinDonHang(dh_id)
{
	$.ajax({
		url: '<?php echo base_url(); ?>admin/ajaxdonhang/ajax_lay_thong_tin_don_Hang',
		type: 'POST',
		data: {
			'dh_id': dh_id
		},
		success: function (result) {
			var s = result.split("|");	
			if(s[0] == "1") LoadDonHang(dh_id, dhct_id);
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
function UpdatePhiVanChuyen()
{
	var phivanchuyen = $('#txtPhiVanChuyen').val();
	phivanchuyen = phivanchuyen.replace(",","");
	$('#txtPhiVanChuyen').val(formatCurrency(phivanchuyen));
	
	var tienhang = $('#txtTienHang').val();
	tienhang = tienhang.replace(",","");
	
	//var phivanchuyen = $('#txtPhiVanChuyen').val();
	//phivanchuyen = phivanchuyen.replace(",","");
	
	var tongcong = parseFloat(tienhang) + parseFloat(phivanchuyen);
	
	$('#txtTongCong').val(formatCurrency(tongcong));
}
function SetThanhToan()
{
	var tongcong = $('#txtTongCong').val();
	tongcong = tongcong.replace(",","");
	$('#txtThanhToan').val(formatCurrency(tongcong));
	$('#txtThanhToan').focus();
	$('#txtThanhToan').select();
}
function LuuIn()
{
	var id = $('#txtID').val();	
	var kyhieu = $('#txtKyHieu').val();
	var ngaylap = $('#txtNgayLap').val();	
	var doitac = $('#txtIDDoiTac').val();
	var ten = $('#txtHoTen').val();	
	var diachi = $('#txtDiaChi').val();
	var dienthoai = $('#txtDienThoai').val();
	var email = $('#txtEmail').val();
	var ghichu = $('#txtGhiChu').val();
	var ghichuvanchuyen = $('#txtGhiChuVanChuyen').val();
	
	var tienhang = $('#txtTienHang').val();
	tienhang = tienhang.replace(/\,/gi, "");
	
	var phivanchuyen = $('#txtPhiVanChuyen').val();
	phivanchuyen = phivanchuyen.replace(/\,/gi, "");
	
	var tongcong = $('#txtTongCong').val();
	tongcong = tongcong.replace(/\,/gi, "");
	
	var thanhtoan = $('#txtThanhToan').val();
	thanhtoan = thanhtoan.replace(/\,/gi, "");
	
	var phuongthucthanhtoan = $('#cboPhuongThuc').val();
	var trangthai = $('#cboTrangThai').val();
	//alert(trangthai);
	if(ten.length == 0)
	{
		alert("Họ tên không được để trống!");
		$('#txtHoTen').focus();
		return false;
	}
	if(diachi.length == 0)
	{
		alert("Địa chỉ không được để trống!");
		$('#txtDiaChi').focus();
		return false;
	}
	if(dienthoai.length == 0)
	{
		alert("Số điện thoại không được để trống!");
		$('#txtDienThoai').focus();
		return false;
	}
	$.ajax({
		url: '/admin/ajaxdonhang/ajax_luu_don_hang',
		type: 'POST',
		data: {
			'id': id,
			'kyhieu': kyhieu,
			'ngaylap': ngaylap,
			'doitac': doitac,
			'ten': ten,
			'diachi': diachi,
			'dienthoai': dienthoai,
			'email': email,
			'ghichu': ghichu,
			'ghichuvanchuyen': ghichuvanchuyen,
			'tienhang': tienhang,
			'phivanchuyen': phivanchuyen,
			'tongcong': tongcong,
			'thanhtoan': thanhtoan,
			'phuongthucthanhtoan': phuongthucthanhtoan,
			'trangthai': trangthai
		},
		success: function (result) {
			var s = result.split("|");	
			if(s[0] == "1") 
			{
				alert("Đã lưu thành công!");
				NewWindow('/admin/donhang/printorder/'+id,'','840','500','yes');
				//gourl('<?php echo base_url();?>admin/donhang');
			}
			else 
			{
				alert(s[1]);
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
function LuuDong()
{
	var id = $('#txtID').val();	
	var kyhieu = $('#txtKyHieu').val();
	var ngaylap = $('#txtNgayLap').val();	
	var doitac = $('#txtIDDoiTac').val();
	var ten = $('#txtHoTen').val();	
	var diachi = $('#txtDiaChi').val();
	var dienthoai = $('#txtDienThoai').val();
	var email = $('#txtEmail').val();
	var ghichu = $('#txtGhiChu').val();
	var ghichuvanchuyen = $('#txtGhiChuVanChuyen').val();
	
	var re = /,/gi;
	
	var tienhang = $('#txtTienHang').val().replace(",","");
	tienhang = tienhang.replace(/\,/gi, "");
	//alert(tienhang);
	var phivanchuyen = $('#txtPhiVanChuyen').val();
	phivanchuyen = phivanchuyen.replace(/\,/gi, "");
	
	var tongcong = $('#txtTongCong').val();
	tongcong = tongcong.replace(/\,/gi, "");
	//alert(tongcong);
	var thanhtoan = $('#txtThanhToan').val();
	thanhtoan = thanhtoan.replace(/\,/gi, "");
	
	var phuongthucthanhtoan = $('#cboPhuongThuc').val();
	var trangthai = $('#cboTrangThai').val();
	//alert(trangthai);
	if(ten.length == 0)
	{
		alert("Họ tên không được để trống!");
		$('#txtHoTen').focus();
		return false;
	}
	if(diachi.length == 0)
	{
		alert("Địa chỉ không được để trống!");
		$('#txtDiaChi').focus();
		return false;
	}
	if(dienthoai.length == 0)
	{
		alert("Số điện thoại không được để trống!");
		$('#txtDienThoai').focus();
		return false;
	}
	$.ajax({
		url: '/admin/ajaxdonhang/ajax_luu_don_hang',
		type: 'POST',
		data: {
			'id': id,
			'kyhieu': kyhieu,
			'ngaylap': ngaylap,
			'doitac': doitac,
			'ten': ten,
			'diachi': diachi,
			'dienthoai': dienthoai,
			'email': email,
			'ghichu': ghichu,
			'ghichuvanchuyen': ghichuvanchuyen,
			'tienhang': tienhang,
			'phivanchuyen': phivanchuyen,
			'tongcong': tongcong,
			'thanhtoan': thanhtoan,
			'phuongthucthanhtoan': phuongthucthanhtoan,
			'trangthai': trangthai
		},
		success: function (result) {
			var s = result.split("|");	
			if(s[0] == "1") 
			{
				alert("Đã lưu thành công!");
				//NewWindow('/admin/donhang/printorder/'+id,'','840','500','yes');
				gourl('<?php echo base_url();?>admin/donhang');
			}
			else 
			{
				alert(s[1]);
			}
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
			
		}
	});
}
</script>
</form>