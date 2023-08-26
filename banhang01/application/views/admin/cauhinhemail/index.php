<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/cauhinhemail" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	CẤU HÌNH EMAIL
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/cauhinhemail">Cấu hình email</a></li>
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
                            <label>Protocol:</label>
                            <input type="text" class="form-control" id="txtProtocol" name="txtProtocol" value="<?php echo $row['che_protocol'] ?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtProtocol')?></div>
                        </div>
						<div class="form-group">
                            <label>Host:</label>
                            <input type="text" class="form-control" id="txtHost" name="txtHost" value="<?php echo $row['che_host'] ?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtHost')?></div>
                        </div>
						<div class="form-group">
                            <label>Port:</label>
                            <input type="text" class="form-control" id="txtPort" name="txtPort" value="<?php echo $row['che_port'] ?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtPort')?></div>
                        </div>
						<div class="form-group">
                            <label>Username:</label>
                            <input type="text" class="form-control" id="txtUsername" name="txtUsername" value="<?php echo $row['che_username'] ?>" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtUsername')?></div>
                        </div>
						<div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" value="" style="width:100%">
							<div class="error" id="password_error"><?php echo form_error('txtPassword')?></div>
                        </div>
						
                        
                        <div class="form-group">
                             <input type="submit" name="btnLuu" value="Cập nhật" class="btn btn-primary btn-sm" style="margin-right: 10px;"/>
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
	var input = document.getElementById("txtProtocol");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();
</script>
</form>