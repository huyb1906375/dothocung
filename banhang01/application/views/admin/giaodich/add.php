<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/giaodich/add" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	GIAO DỊCH
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/giaodich">Giao dịch</a></li>
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
                        
						
						
						<div class="form-group">
							<label>Ngày giao dịch:</label>
							<div class='input-group date' id='datetimepicker1'>
								<input id="txtNgayLap" name="txtNgayLap" type='text' class="form-control" />
								<div class="error" id="ngaylap_error"><?php echo form_error('txtNgayLap')?></div>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
                            <label>Thành viên:</label>
                            <select name="cboNguoiDung" class="form-control select2" style="width:100%">
                                <option value="">&nbsp;</option>
                                <?php
                                $nguoidung = $this->nguoidung_model->lay_danh_sach_nguoi_dung();
                                foreach ($nguoidung as $nd) 
                                {
                                    echo "<option ".(($this->session->userdata('nd_id') == $nd["nd_id"])?"selected":"")." value='".$nd["nd_id"]."'>".$nd["nd_ten_dang_nhap"]." - ".$nd["nd_ten"]."</option>";
                                    
                                }
                                ?>
                            </select>
							<div class="error" id="nguoidung_error"><?php echo form_error('cboNguoiDung')?></div>
                        </div>
						<div class="form-group">
                            <label>Nội dung:</label>
                            <input type="text" class="form-control" id="txtNoiDung" name="txtNoiDung" value="<?php echo set_value('txNoiDung');?>" style="width:100%">
							<div class="error" id="noidung_error"><?php echo form_error('txNoiDung')?></div>
                        </div>
                        
						<div class="form-group">
                            <label>Số tiền:</label>
                            <input type="text" class="form-control" id="txtSoTien" name="txtSoTien" value="<?php echo set_value('txtSoTien');?>" style="width:100%" onkeyup="FormatNumber(this);">
							<div class="error" id="sotien_error"><?php echo form_error('txtSoTien')?></div>
                        </div>
						
                        
                        <div class="form-group">
                            <button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu lại
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/giaodich" role="button">
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
document.frm.txtTen.focus();
</script>
</form>