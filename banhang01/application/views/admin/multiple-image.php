<!DOCTYPE html>
<html>
<head>
  <title>Upload Multiple Images in Codeigniter Using Ajax</title>
</head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<style type="text/css">
.thumb{
  margin: 24px 5px 20px 0;
  width: 150px;
  float: left;
}
#blah {
  border: 2px solid;
  display: block;
  background-color: white;
  border-radius: 5px;
}
</style>
<body>
  <?php //$this->load->view('layout/header',array('heading' => 'Upload Multiple Images in Codeigniter Using Ajax')); ?>
 <div  class="container">
  <div id="divMsg" class="alert alert-success" style="display: none">
   <span id="msg"></span>
  </div>
  <br><br>
   <div class="row" id="blah">
    <form method="post" id="upload_form" enctype="multipart/form-data">  
    <div class="form-control col-md-12">  
      <input type="file" id="image_file" multiple="multiple" />
      <br>
      <div id="uploadPreview"></div>
   </div></br></br><br>
   <div class="form-group col-md-6">
     <button>Submit</button>
   </div>
  </form>
   </div>
 </div> 
 <script type="text/javascript">
 
 $(document).ready(function(){  
      $('#upload_form').on('submit', function(e){  
			e.preventDefault();  
			if($('#image_file').val() == '')  
			{  
                alert("Please Select the File");  
			}  
			else 
			{ 
	   
				var form_data = new FormData();
				var ins = document.getElementById('image_file').files.length;
				for (var x = 0; x < ins; x++) 
				{
                  form_data.append("files[]", document.getElementById('image_file').files[x]);
				}
			  
                $.ajax({  
                     url:"/admin<?php echo base_url(); ?>ajax/multipleImageStore",    
                     method:"POST",  
                     data:form_data,  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     dataType: "json",
                     success:function(res)  
                     {  
						alert('aaa');
                        console.log(res.success);
                        if(res.success == true){
                         $('#image_file').val('');
                         $('#uploadPreview').html('');   
                         $('#msg').html(res.msg);   
                         $('#divMsg').show();   
                        }
                        else if(res.success == false){
                          $('#msg').html(res.msg); 
                          $('#divMsg').show(); 
                        }
                        setTimeout(function(){
                         $('#msg').html('');
                         $('#divMsg').hide(); 
                        }, 3000);
                     }  
                });  
			}  
      });  
 }); 
// var url = window.URL || window.webkitURL; // alternate use
 
function readImage(file) {
  var reader = new FileReader();
  var image  = new Image();
 
  reader.readAsDataURL(file);  
  reader.onload = function(_file) {
    image.src = _file.target.result; // url.createObjectURL(file);
    image.onload = function() {
		/*
      var w = this.width,
          h = this.height,
          t = file.type, // ext only: // file.type.split('/')[1],
          n = file.name,
          s = ~~(file.size/1024) +'KB';
		  */
	var w = 150,
          h = 150,
          t = file.type, // ext only: // file.type.split('/')[1],
          n = file.name,
          s = ~~(file.size/1024) +'KB';
      $('#uploadPreview').append('<img src="' + this.src + '" class="thumb">');
    };
 
    image.onerror= function() {
      alert('Invalid file type: '+ file.type);
    };      
  };
 
}
$("#image_file").change(function (e) {
  if(this.disabled) {
    return alert('File upload not supported!');
  }
 
  var F = this.files;
  if (F && F[0]) {
    for (var i = 0; i < F.length; i++) {
      readImage(F[i]);
    }
  }
});
</script>
</body>
</html>