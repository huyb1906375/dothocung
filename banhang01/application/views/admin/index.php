<?php
date_default_timezone_set('Asia/Saigon');
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="<?php echo base_url(); ?>"></base>
 
  	<title><?php echo $title ?></title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta charset="utf-8">
    
    <link href="public/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/admin/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="public/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="public/admin/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="public/admin/dist/css/custom.css" rel="stylesheet" type="text/css" />
	<link href="public/admin/css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="public/admin/plugins/datetimepicker/bootstrap-datetimepicker.min.css">	
	<script src="public/admin/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="public/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="public/admin/plugins/select2/select2.full.min.js" type="text/javascript"></script>   
	
    <script type="text/javascript" src="public/admin/js/moment.min.js"></script>  	
    <script type="text/javascript" src="public/admin/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
	
	<script src="public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="public/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>

	<script src="public/admin/js/jquery-ui.min.js" type="text/javascript"></script>
	<link href="public/admin/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
	<link href="public/admin/css/AutoComplete.css" rel="stylesheet" type="text/css" />
	
	<script src="public/admin/dist/js/demo.js" type="text/javascript"></script>
    <script src="public/admin/dist/js/app.js" type="text/javascript"></script>
	
    <script src="public/admin/js/common.js" type="text/javascript"></script>
	<script src="public/admin/js/TTHJScript.js" type="text/javascript"></script>
    <script src="public/admin/js/ajax.js" type="text/javascript"></script>
	
	
	<script src="public/admin/ckeditor/ckeditor.js" type="text/javascript"></script>
	
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Vung Header -->
		<?php $this->load->view('admin/header'); ?>
		<?php $this->load->view('admin/menu'); ?>
  		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
  		<?php 		
  			//if(isset($com, $view))
  			//{				
  				//$this->load->view('admin/'.$com.'/'.$view);
  			//}	
			$this->load->view($template, $this->data);
  		?>
		</div>
		<?php $this->load->view('admin/footer'); ?>
	    
    </div><!-- ./wrapper -->
	
	<!-- AdminLTE App -->
	
	<script type="text/javascript">
		$('#datetimepicker1').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
			defaultDate: new Date()
		});
		$('#dateNgayLap').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
			defaultDate: new Date()
		});
		$('#dateNgayTra').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
			defaultDate: new Date()
		});
		$('#dateTuNgay').datetimepicker({
			format: 'YYYY-MM-DD',
			defaultDate: new Date()
		});
		$('#dateDenNgay').datetimepicker({
			format: 'YYYY-MM-DD',
			defaultDate: new Date()
		});
		$('#dateNgayDi').datetimepicker({
			format: 'YYYY-MM-DD',
			defaultDate: new Date()
		});
		$("#<?php echo $com;?>").addClass("active");
		$("#<?php echo $tab;?>").addClass("active");
		/*
		setTimeout(function() {
			$(".alert").alert('close');
		}, 3000);
		
		$(".alert").delay(4000).slideUp(200, function() {
			$(this).alert('close');
		});
		*/
		
		window.setTimeout(function() {
			$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
				$(this).remove(); 
			});
		}, 2000);
		
		
	</script> 
</body>
</html>
