var xmlHttp;
var s = "";
var divhienthi;
function GetXmlHttpObject()
{
var xmlHttp=null;
	try
	 {
	 // Firefox, Opera 8.0+, Safari
	 xmlHttp=new XMLHttpRequest();
	 }
	catch (e)
	 {
	 //Internet Explorer
	 try
	  {
	  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	  }
	 catch (e)
	  {
	  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	 }
	return xmlHttp;
}
function loadDuLieu(div,url)
{ 
	//alert(url);
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
	 	alert ("Browser does not support HTTP Request");
	 	return;
	}
	divhienthi = div;
	xmlHttp.onreadystatechange= processReqChange;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function ajaxXuLy(div,url,thongbao)
{ 
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
	 	alert ("Browser does not support HTTP Request");
	 	return;
	}
	divhienthi = div;
	s = thongbao;
	xmlHttp.onreadystatechange= processReqChange1;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function processReqChange1() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	 {  
	 	if(xmlHttp.responseText == "")
	 		alert(s);   
		else document.getElementById("" + divhienthi + "").innerHTML=xmlHttp.responseText;       
	 } 
}
function kiemTraDangNhap(url,thongbao)
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
	 	alert ("Browser does not support HTTP Request");
	 	return;
	}
	s = thongbao;
	xmlHttp.onreadystatechange= processReqChange2;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function processReqChange() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		if(xmlHttp.responseText != "")		
			document.getElementById("" + divhienthi + "").innerHTML=xmlHttp.responseText;         
	} 
}

function processReqChange2() 
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	 {  
	 	if(xmlHttp.responseText == "")
	 		alert(s);        
	 } 
}
