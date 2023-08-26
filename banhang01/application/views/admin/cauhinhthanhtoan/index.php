<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/css/upload.css" />


<form name="frm" action="<?php echo base_url() ?>admin/cauhinhthanhtoan" method="post"  enctype="multipart/form-data" >
<section class="content-header">
  <h1>
  	CẤU HÌNH THANH TOÁN
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>admin/home"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active"><a href="<?php echo base_url() ?>admin/cauhinhthanhtoan">Cấu hình thanh toán</a></li>
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
                            <label>TmnCode:</label>
                            <input type="text" class="form-control" id="txtTmnCode" name="txtTmnCode" value="<?php echo $row['chtt_tmn_code'] ?>" style="width:100%">
							<div class="error" id="txtTmnCode_error"><?php echo form_error('txtTmnCode')?></div>
                        </div>
						<div class="form-group">
                            <label>HashSecret:</label>
                            <input type="text" class="form-control" id="txtHashSecret" name="txtHashSecret" value="<?php echo $row['chtt_hash_secret'] ?>" style="width:100%">
							<div class="error" id="txtHashSecret_error"><?php echo form_error('txtHashSecret')?></div>
                        </div>
						<div class="form-group">
                            <label>Url:</label>
                            <input type="text" class="form-control" id="txtUrl" name="txtUrl" value="<?php echo $row['chtt_url'] ?>" style="width:100%">
							<div class="error" id="txtUrl_error"><?php echo form_error('txtUrl')?></div>
                        </div>
						<div class="form-group">
                            <label>ReturnUrl:</label>
                            <input type="text" class="form-control" id="txtReturnUrl" name="txtReturnUrl" value="<?php echo $row['chtt_return_url'] ?>" style="width:100%">
							<div class="error" id="txtReturnUrl_error"><?php echo form_error('txtReturnUrl')?></div>
                        </div>
						<div class="form-group">
                            <label>ApiUrl:</label>
                            <input type="text" class="form-control" id="txtApiUrl" name="txtApiUrl" value="<?php echo $row['chtt_api_url'] ?>" style="width:100%">
							<div class="error" id="txtApiUrl_error"><?php echo form_error('txtApiUrl')?></div>
                        </div>
						
                        
                        <div class="form-group">
                             <input type="submit" name="btnLuu" value="Cập nhật" class="btn btn-primary" style="margin-right: 10px;"/>
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
	var input = document.getElementById("txtTmnCode");
	input.focus();
	input.setSelectionRange(0,input.value.length);
}
SelectAllText();
</script>
</form>