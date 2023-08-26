<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/baohanh/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	BẢO HÀNH
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/baohanh">Bảo hành</a></li>
    <li>[Thêm]</li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" id="view">
                <div class="box-body">
                    <?php  if($this->session->flashdata('success')):?>
						<div class="col-md-12">
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('success'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						</div>
					<?php  endif;?>
					<?php  if($this->session->flashdata('error')):?>
						<div class="col-md-12">
							<div class="alert alert-error">
								<?php echo $this->session->flashdata('error'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						</div>
					<?php  endif;?>
                    <div class="col-md-6">
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Ngày lập:</label>
							<div class="col-sm-9">
								<div class='input-group date' id='dateNgayLap'>
									<input id="txtNgayLap" name="txtNgayLap" type='text' class="form-control" />
									<div class="error" id="ngaylap_error"><?php echo form_error('txtNgayLap')?></div>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
                        </div>
						<div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Số seri:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="txtSoSeri" name="txtSoSeri" value="<?php echo set_value('txtSoSeri');?>" style="width:100%">
								<div class="error" id="txtSoSeri_error"><?php echo form_error('txtSoSeri')?></div>
							</div>
						</div>
						<div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Tên thiết bị:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="txtThietBi" name="txtThietBi" value="<?php echo set_value('txtThietBi');?>" style="width:100%">
								<div class="error" id="txtThietBi_error"><?php echo form_error('txtThietBi')?></div>
							</div>
						</div>
						<div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Tình trạng:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="txtTinhTrang" name="txtTinhTrang" value="<?php echo set_value('txtTinhTrang');?>" style="width:100%">
								<div class="error" id="txtTinhTrang_error"><?php echo form_error('txtTinhTrang')?></div>
							</div>
						</div>
						<div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Khách hàng:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="txtKhachHang" name="txtKhachHang" value="<?php echo set_value('txtKhachHang');?>" style="width:100%">
								<div class="error" id="txtKhachHang_error"><?php echo form_error('txtKhachHang')?></div>
								
							</div>
                        </div>
						<div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Điện thoại:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="txtDienThoai" name="txtDienThoai" value="<?php echo set_value('txtDienThoai');?>" style="width:100%">
								<div class="error" id="txtDienThoai_error"><?php echo form_error('txtDienThoai')?></div>
							</div>
						</div>
						<div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Ghi chú:</label>
							<div class="col-sm-9">
								<textarea name="txtGhiChu" id="txtGhiChu" class="form-control" rows="3"><?php echo set_value('txtGhiChu');?></textarea>
							</div>
						</div>
						<div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Trạng thái:</label>
							<div class="col-sm-9">
								<select name="cboTrangThai" id="cboTrangThai" class="form-control" style="width: 100%;">
									<option <?php if($this->session->userdata('bh_trang_thai') == "0") echo "selected"; ?> value="0">&nbsp;</option>
									<option <?php if($this->session->userdata('bh_trang_thai') == "1") echo "selected"; ?> value="1">Mới tiếp nhận</option>
									<option <?php if($this->session->userdata('bh_trang_thai') == "2") echo "selected"; ?> value="2">Đang xử lý</option>
									<option <?php if($this->session->userdata('bh_trang_thai') == "3") echo "selected"; ?> value="3">Đã có kết quả</option>
									<option <?php if($this->session->userdata('bh_trang_thai') == "4") echo "selected"; ?> value="4">Đã trả khách</option>
								</select>
							</div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label text-right">Ngày trả:</label>
							<div class="col-sm-9">
								<div class='input-group date' id='dateNgayTra'>
									<input id="txtNgayTra" name="txtNgayTra" type='text' class="form-control" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
                        
                    </div>
                    <div class="col-md-6">
						<div class="form-group">
                        	
                            <div id="upload-image-box">                            	          
								<div class="item">
                                    <label for="fileHinhAnh">
                                        <img class="thumbnail form-control" src="uploads/images/upload-image.png"/>         
                                    </label>
                                    <input name="fileHinhAnh" id="fileHinhAnh" class="inputimage" accept="image/*" type="file">  
								</div>								
                            </div>
                        </div>
					</div>
					
                </div>
				<div class="box-footer">
					<div class="col-md-12 text-center">
						<div class="form-group">
                            <button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu [Thêm]
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/baohanh" role="button">
								<span class="glyphicon glyphicon-arrow-left"></span> Trở về
							</a> 
                        </div>
					</div>
				</div>
            </div><!-- /.box -->
        </div>
        
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script type="text/javascript">
document.frm.txtSoSeri.focus();
</script>
</form>