<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/thamso/edit/<?php echo $row['ts_id'] ?>" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	THAM SỐ
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/thamso">Tham số</a></li>
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
                            <label>Mã:</label>
                            <input type="text" class="form-control" id="txtMa" name="txtMa" value="<?php echo $row['ts_ma'];?>" style="width:100%" readonly="true">
							<div class="error" id="txtMa_error"><?php echo form_error('txtMa')?></div>
                        </div>
						<div class="form-group">
                            <label>Giá trị:</label>
							<textarea name="txtTen" id="txtTen" class="form-control" rows="3"><?php echo $row['ts_ten'];?></textarea>	 
							<div class="error" id="ten_error"><?php echo form_error('txtTen')?></div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả:</label>
							<textarea name="txtMoTa" id="txtMoTa" class="form-control" rows="3"><?php echo $row['ts_mo_ta'];?></textarea>
                            
                        </div>
						
                        <div class="form-group">
                            <button type="submit" name="btnLuu" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
								<span class="glyphicon glyphicon-floppy-save"></span> Lưu lại
							</button>
                            <a class="btn btn-primary btn-sm" href="admin/thamso" role="button">
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