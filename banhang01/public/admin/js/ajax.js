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
/*
function cms_select_product_sell($id) {
    if ($('tbody#pro_search_append tr').length != 0) {
        $flag = 0;
        $('tbody#pro_search_append tr').each(function () {
            $id_temp = $(this).attr('data-id');
            if ($id == $id_temp) {
                value_input = $(this).find('input.quantity_product_order');
                value_input.val(parseInt(value_input.val()) + 1);
                $flag = 1;
                cms_load_infor_order();
                return false;
            }
        });
        if ($flag == 0) {
            var $seq = parseInt($('td.seq').last().text()) + 1;
            var $param = {
                'type': 'POST',
                'url': 'orders/cms_select_product/',
                'data': {'id': $id, 'seq': $seq},
                'callback': function (data) {
                    $('#pro_search_append').append(data);
                    cms_load_infor_order();
                }
            };
            cms_adapter_ajax($param);
        }
    } else {
        var $param = {
            'type': 'POST',
            'url': 'orders/cms_select_product/',
            'data': {'id': $id, 'seq': 1},
            'callback': function (data) {
                $('#pro_search_append').append(data);
                cms_load_infor_order();
            }
        };
        cms_adapter_ajax($param);
    }
}
*/
