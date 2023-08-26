function backurl(url,msg){
	window.location=url;
}
function gourl(url){
	window.location=url;
}
function openLinkOut(wUrl) {
		 if (wUrl!=""){
			if (wUrl.indexOf("http://") < 0 && wUrl.indexOf("https://") < 0 )
			   wUrl = "http://"+ wUrl;
			window.open(wUrl);
		 }
}
function checkOrUncheckAll($value){	
	
	var checks = document.getElementsByName('chon[]');
	for (i = 0; i < checks.length; i++)
		checks[i].checked = $value ;	
}
function checkAll(){	
	alert($value);
	var checks = document.getElementsByName('chon[]');
	for (i = 0; i < checks.length; i++)
		checks[i].checked = true ;	
}

function uncheckAll(field){
	var checks = document.getElementsByName('chon[]');
	for (i = 0; i < checks.length; i++)
		checks[i].checked = false ;	
}
function NewWindow(a,b,c,e,d)
{
    LeftPosition=screen.width?(screen.width-c)/2:0;
    TopPosition=screen.height?(screen.height-e)/2:0;
    settings="height="+e+",width="+c+",top="+TopPosition+",left="+LeftPosition+",scrollbars="+d+",resizable";
    window.open(a,b,settings)
}
function PrintDiv(printDiv, title) {
	var contents = document.getElementById(printDiv).innerHTML;
	var frame1 = document.createElement('iframe');
	frame1.name = "frame1";
	frame1.style.position = "absolute";
	frame1.style.top = "-1000000px";
	document.body.appendChild(frame1);
	var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
	frameDoc.document.open();
	frameDoc.document.write('<html>');
	frameDoc.document.write('<head>');
	frameDoc.document.write('<link rel="stylesheet" media="print" type="text/css"  href="/public/site/css/print.css" />\n');
	frameDoc.document.write('<title>'+title+'</title>');
	frameDoc.document.write('</head>');
	frameDoc.document.write('<body>');
	frameDoc.document.write(contents);
	frameDoc.document.write('</body></html>');
	frameDoc.document.close();
	setTimeout(function () {
		window.frames["frame1"].focus();
		window.frames["frame1"].print();
		document.body.removeChild(frame1);
	}, 500);
	return false;
}
function printIt(printThis)
{
    win = window.open();
    self.focus();
    win.document.open();
    win.document.write('<html><head>');
    win.document.write('<link rel="stylesheet" media="print" type="text/css"  href="/public/site/css/print.css" />\n');
    win.document.write('<style>');
    win.document.write('body, td { font-family: Verdana; font-size: 10pt;width:100%;text-align:center;}');
    win.document.write('</style></head><body align="' + center +'">');
    win.document.write(printThis);
    win.document.write('</body></html>');
    win.document.close();
    win.print();
    //win.close();
 }
 // JScript File
function FormatNumber(obj) {
    var strvalue;
    if (eval(obj))
        strvalue = eval(obj).value;
    else
        strvalue = obj;	
    var num;
    num = strvalue.toString().replace(/\$|\,/g,'');
    if(isNaN(num))
        num = "";
    if(num == 0) return;
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    num = Math.floor(num/100).toString();
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
    num = num.substring(0,num.length-(4*i+3))+','+
    num.substring(num.length-(4*i+3));
    //return (((sign)?'':'-') + num);
    eval(obj).value = (((sign)?'':'-') + num);
}

function ShowMessageUpdate()
{	
	alert("Chức năng đang được cập nhật!");
	return;
}
function formatCurrency(num) 
{
    num = num.toString().replace(/\$|\,/g,'');
    if(isNaN(num))
    num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    num = Math.floor(num/100).toString();
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
    num = num.substring(0,num.length-(4*i+3))+','+
    num.substring(num.length-(4*i+3));
    return (((sign)?'':'-') + num);
}
function AddToCart(dh_id, sp_id, so_luong, don_gia)
{
	$.ajax({
		url: '/ajax/ajax_add_to_cart',
		type: 'POST',
		data: {
			'dh_id': dh_id,
			'sp_id': sp_id,
			'so_luong': so_luong,
			'don_gia': don_gia
		},
		success: function (result) {
			var s = result.split("|");
			$('#count_cart').html(s[0]);
			$('#count_cart_mobile').html(s[0]);
			$('.message-box').show();
			setTimeout(function() { $(".message-box").fadeOut(1500); }, 2000)
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
}
function MuaHang(dh_id, sp_id, so_luong, don_gia)
{
	$.ajax({
		url: '/ajax/ajax_add_to_cart',
		type: 'POST',
		data: {
			'dh_id': dh_id,
			'sp_id': sp_id,
			'so_luong': so_luong,
			'don_gia': don_gia
		},
		success: function (result) {
			var s = result.split("|");
			$('#count_cart').html(s[0]);
			$('#count_cart_mobile').html(s[0]);
			
			gourl('/thanh-toan.html');
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
}
