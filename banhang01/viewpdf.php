<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
    <title>View file .PDF</title>
</head>
<body>
    <form id="form1">
   
        <?php
		$file_path = $_GET['url'];
		//$file = "http://localhost:8080/uploads/baiviet/20210420214004202103111511124-cn-4-ps-b-pdf.pdf";
		//$filename = $_GET['url'];		
		header('Content-type: application/pdf');		  
		//header('Content-Disposition: inline; filename="' . $filename . '"');		  
		//header('Content-Transfer-Encoding: binary');
		//header('Content-Length:'.filesize($file));  
		//header('Accept-Ranges: bytes');
		readfile($file_path);
		?>
    </form>
</body>
</html>


