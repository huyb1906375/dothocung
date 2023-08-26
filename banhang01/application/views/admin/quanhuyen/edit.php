<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/quanhuyen/edit/<?php echo $row['qh_id'] ?>" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	QUẬN HUYỆN
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/quanhuyen">Quận huyện</a></li>
    <li>[Sửa]</li>
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
                            <label>Tên:</label>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo $row['qh_ten'];?>" style="width:100%">
							<div class="error" id="ten_error"><?php echo form_error('txtTen')?></div>
                        </div>
                        <div class="form-group">
                            <label>Tỉnh thành:</label>
                            <select name="cboTinhThanh" class="form-control select2" style="width:100%">
                                <option value="">&nbsp;</option>
                                <?php
                                $tinhthanh = $this->tinhthanh_model->lay_danh_sach_tinh_thanh();
                                foreach ($tinhthanh as $tt) 
                                {
                                    echo "<option ".(($row['qh_tt_id'] == $tt["tt_id"])?"selected":"")." value='".$tt["tt_id"]."'>".$tt["tt_ten"]."</option>";
                                    
                                }
                                ?>
                            </select>
							<div class="error" id="tinhthanh_error"><?php echo form_error('cboTinhThanh')?></div>
                        </div>
						<div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="txtMoTa" id="txtMoTa" class="form-control" ><?php echo $row['qh_mo_ta'];?></textarea>
							
                        </div>
						
						<div class="form-group">
                            <label>Trạng thái:</label>
                            <select name="cboTrangThai" class="form-control" style="width:100%">
								<option <?php if($row['qh_trang_thai'] == 0) echo "selected";?> value="0">Chưa kích hoạt</option>
                                <option <?php if($row['qh_trang_thai'] == 1) echo "selected";?> value="1">Kích hoạt</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu lại
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/quanhuyen" role="button">
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
function SelectAllText() {
	var input = document.getElementById("txtTen");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();
</script>
</form>