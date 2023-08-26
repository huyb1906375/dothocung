function NewWindow(a,b,c,e,d)
{
    LeftPosition=screen.width?(screen.width-c)/2:0;
    TopPosition=screen.height?(screen.height-e)/2:0;
    settings="height="+e+",width="+c+",top="+TopPosition+",left="+LeftPosition+",scrollbars="+d+",resizable";
    window.open(a,b,settings)
}
function PrintDiv(printDiv) {
	var contents = document.getElementById(printDiv).innerHTML;
	var frame1 = document.createElement('iframe');
	frame1.name = "frame1";
	frame1.style.position = "absolute";
	frame1.style.top = "-1000000px";
	document.body.appendChild(frame1);
	var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
	frameDoc.document.open();
	frameDoc.document.write('<html><head><title>DIV Contents</title>');
	frameDoc.document.write('</head><body>');
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
    win.document.write('<link rel="stylesheet" media="print" type="text/css"  href="/static/default.css" />\n');
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
function FormatNumber(obj)
{
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
function TinhGiaBan(mObject)
{
    var object_ = mObject.id;
	try{
	    var n1 = object_.replace('txtGiamGia','txtGiaThiTruong');
	    //alert(n1);
	    var n2 = object_.replace('txtGiamGia','txtGiaBan');
	    var n_giaban = document.getElementById(n1.replace(/\$|\,/g,'')).value.replace(/\$|\,/g,'');
	    var n_giamgia = mObject.value.replace(/\$|\,/g,'');
	    document.getElementById(n2).value = formatCurrency(n_giaban - 0.01 * n_giamgia * n_giaban);
	 }
    catch (error)
    {
        alert("Lỗi nhập liệu!"+error);
    }
	
	
}
function TinhGiaBan1(mObject)
{
    var object_ = mObject.id;
	try{
	    var n1 = object_.replace('txtGiaBan','txtGiaThiTruong');
	    var n2 = object_.replace('txtGiaBan','txtGiamGia');
	    var n_giaban = document.getElementById(n1.replace(/\$|\,/g,'')).value.replace(/\$|\,/g,'');
	    var n_tiengiamgia = mObject.value.replace(/\$|\,/g,'');
	    document.getElementById(n2).value = formatCurrency(((parseFloat(n_giaban) - parseFloat(n_tiengiamgia))/parseFloat(n_giaban)) * 100);
	   
		
	 }
    catch (error)
    {
        alert("Lỗi nhập liệu!"+error);
    }
	
	
}

function TinhTong(mObject)
{
var object_ = mObject.id;
// Khai báo và gán giá trị các cột dữ liệu
var m2= object_.replace('txtSoLuong','txtThanhTien');
var m3 = object_.replace('txtSoLuong','txtDonGia');
var mNhap = object_.replace('txtSoLuong','txtNhap');
var lblTT = object_.replace('txtSoLuong','lblThanhTien');
var m4 = document.getElementById(m2);
var m5 = document.getElementById(m3.replace(/\$|\,/g,''));
var SoLuong;   
if(mObject.value.length>0)
{
	 SoLuong = mObject.value.replace(/\$|\,/g,'');
}
var DonGia =m5.value.replace(/\$|\,/g,'');
// Tính ThanhTien =DonGia*SoLuong
var ThanhTien= parseFloat(SoLuong)* parseFloat(DonGia);
document.getElementById(lblTT).innerHTML=ThanhTien;
if(isNaN(m3))
{
	document.getElementById(m2).value =formatCurrency(ThanhTien);
}
// Tính tổng số tiền
var test="";
var tongtien =0;
var z="";
for(x=2;x<20;x++)
{
	if(x<10)
	{
		test ="grvSanPham_ctl0"+x+"_lblThanhTien";
		if(document.getElementById(test) !=null)
		{
			z = document.getElementById(test).innerHTML.toString().replace(/\$|\,/g,'');
			if(isNaN(z) || z ==''){z = '0';}
			tongtien =tongtien+ parseFloat(z);
		}
	}
	else
	{
		test ="grvSanPham_ctl"+x+"_lblThanhTien";
		if(document.getElementById(test) !=null)
		{
			z = document.getElementById(test).innerHTML.toString().replace(/\$|\,/g,'');
			if(isNaN(z) || z ==''){z = '0';}
			z = '0';
			tongtien =tongtien+ parseFloat(z);
		}
	}
}
document.getElementById('lblTong').innerHTML =formatCurrency(tongtien); 
document.getElementById('lblDocSo').innerHTML = DocTienBangChu(tongtien);
}
var ChuSo=new Array(" không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín ");
var Tien=new Array( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ");
function DocSo3ChuSo(baso)
{
	var tram;
	var chuc;
	var donvi;
	var KetQua="";
	tram=parseInt(baso/100);
	chuc=parseInt((baso%100)/10);
	donvi=baso%10;
	if(tram==0 && chuc==0 && donvi==0) return "";
	if(tram!=0)
	{
		KetQua += ChuSo[tram] + " trăm ";
		if ((chuc == 0) && (donvi != 0)) KetQua += " linh ";
	}
	if ((chuc != 0) && (chuc != 1))
	{
			KetQua += ChuSo[chuc] + " mươi";
			if ((chuc == 0) && (donvi != 0)) KetQua = KetQua + " linh ";
	}
	if (chuc == 1) KetQua += " mười ";
	switch (donvi)
	{
		case 1:
			if ((chuc != 0) && (chuc != 1))
			{
				KetQua += " mốt ";
			}
			else
			{
				KetQua += ChuSo[donvi];
			}
			break;
		case 5:
			if (chuc == 0)
			{
				KetQua += ChuSo[donvi];
			}
			else
			{
				KetQua += " lăm ";
			}
			break;
		default:
			if (donvi != 0)
			{
				KetQua += ChuSo[donvi];
			}
			break;
		}
	return KetQua;
}
function DocTienBangChu(SoTien)
{
	var lan=0;
	var i=0;
	var so=0;
	var KetQua="";
	var tmp="";
	var ViTri = new Array();
	if(SoTien<0) return "Số tiền âm !";
	if(SoTien==0) return "Không đồng !";
	if(SoTien>0)
	{
		so=SoTien;
	}
	else
	{
		so = -SoTien;
	}
	if (SoTien > 8999999999999999)
	{
		//SoTien = 0;
		return "Số quá lớn!";
	}

	ViTri[5] = Math.floor(so / 1000000000000000);
	if(isNaN(ViTri[5]))
		ViTri[5] = "0";
	so = so - parseFloat(ViTri[5].toString()) * 1000000000000000;
	ViTri[4] = Math.floor(so / 1000000000000);
	 if(isNaN(ViTri[4]))
		ViTri[4] = "0";
	so = so - parseFloat(ViTri[4].toString()) * 1000000000000;
	ViTri[3] = Math.floor(so / 1000000000);
	 if(isNaN(ViTri[3]))
		ViTri[3] = "0";
	so = so - parseFloat(ViTri[3].toString()) * 1000000000;
	ViTri[2] = parseInt(so / 1000000);
	 if(isNaN(ViTri[2]))
		ViTri[2] = "0";
	ViTri[1] = parseInt((so % 1000000) / 1000);
	 if(isNaN(ViTri[1]))
		ViTri[1] = "0";
	ViTri[0] = parseInt(so % 1000);
  if(isNaN(ViTri[0]))
		ViTri[0] = "0";
	if (ViTri[5] > 0)
	{
		lan = 5;
	}
	else if (ViTri[4] > 0)
	{
		lan = 4;
	}
	else if (ViTri[3] > 0)
	{
		lan = 3;
	}
	else if (ViTri[2] > 0)
	{
		lan = 2;
	}
	else if (ViTri[1] > 0)
	{
		lan = 1;
	}
	else
	{
		lan = 0;
	}
//        
	for (i = lan; i >= 0; i--)
	{
	   tmp = DocSo3ChuSo(ViTri[i]);
	   KetQua += tmp;
	   if (ViTri[i] > 0) KetQua += Tien[i];
	   if ((i > 0) && (tmp.length > 0)) KetQua += ',';//&& (!string.IsNullOrEmpty(tmp))
	}
	if (KetQua.substring(KetQua.length - 1) == ',')
	{
		KetQua = KetQua.substring(0, KetQua.length - 1);
	}
   
	KetQua = KetQua.substring(1,2).toUpperCase()+ KetQua.substring(2);
  
	return KetQua;//.substring(0, 1);//.toUpperCase();// + KetQua.substring(1);
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

function OnClientDropDownOpening(sender, args)
{
  if (sender.get_text() == "")
  {
     args.set_cancel(true); //hide dropdown on focus
  }
}
function OnClientKeyPressing(sender, args)
{
    sender.showDropDown();//show dropdown after entering some characters
}

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
//Play file format : swf, flv, wma, wmv, avi, mp3, wav, dat
function playfile(file, width, height, autoplay, image, slink, flashvars) {
    if (Left(file, 22) == "http://www.youtube.com") {
        EmbedYoutube(file, width, height, autoplay);
    }
    file = file.toLowerCase();
    if (Right(file, 3) == "swf" || Right(file, 3) == "xml") {
        EmbedFlash(file, width, height, flashvars);
    }
    if (Right(file, 3) == "flv") {
        PlayFlash(file, width, height, autoplay, image, slink, flashvars)
    }
    if (Right(file, 3) == "mp3" || Right(file, 3) == "wma" || Right(file, 3) == "wmv" || Right(file, 3) == "avi" || Right(file, 3) == "wav" || Right(file, 3) == "dat") {
        PlayVideo(file, width, height, autoplay, flashvars);
    }
    if (Right(file, 3) == "jpg" || Right(file, 4) == "jpeg" || Right(file, 3) == "gif" || Right(file, 3) == "png" || Right(file, 3) == "bmp") {
        PlayImage(file, width, height, flashvars);
    }
}

function EmbedYoutube(path, width, height, autoplay) {
    var auto = 0; if (autoplay == true) { auto = 1; }; path = path.replace("/watch?v=", "/v/") + "&amp;hl=en&amp;fs=1&autoplay=" + auto; var str_embed = "<object width=\"" + width + "\" height=\"" + height + "\"><param name=\"movie\" value=\"" + path + "\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"" + path + "\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"" + width + "\" height=\"" + height + "\"></embed></object>"; document.write(str_embed);
}

function PlayFlash(path, width, height, autoplay, image, slink, flashvars) {
    auto = false; if (autoplay == true) { auto = true; } var str_link = ""; if (slink.length > 0) { str_link = "&link=" + slink + "&linktarget=_blank"; } var str = "<embed name=\"PlayFlash\" id=\"PlayFlash\" wmode=\"transparent\" type=\"application/x-shockwave-flash\" src=\"/scripts/player.swf\" bgcolor=\"#FFFFFF\" quality=\"high\" allowscriptaccess=\"always\" allowfullscreen=\"true\" flashvars=\"file=" + path + "&image=" + image + str_link + "&autostart=" + auto + "&volume=100&overstretch=fit&showeq=true&linkfromdisplay=true&duration=auto\" width=\"" + width + "\" height=\"" + height + "\"></embed>"; if (flashvars != "") { $Get(flashvars).innerHTML = str; } else { document.write(str); } 
}

function PlayImage(path, width, height, flashvars) {
    str = "<img src=\"" + path + "\" width=\"" + width + "\" height=\"" + height + "\" />"; if (flashvars != "") { $Get(flashvars).innerHTML = str; } else { document.write(str); }
}

function PlayVideo(path, width, height, autoplay, flashvars) {
    auto = false; if (autoplay == true) { auto = true; } str = "<object id=\"MediaPlayer\" classid=\"CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6\"  codeBase=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715\" width=\"" + width + "\" height=\"" + height + "\"> <param name=\"autoplay\" value=\"" + auto + "\"/> <param name=\"autostart\" value=\"" + auto + "\"/> <param name=\"showcontrols\" value=\"true\">  <param name=\"EnableContextMenu\" value=\"true\"/> <param name=\"showstatusbar\" value=\"false\"/> <param name=\"URL\" value=\"" + path + "\"/><param name=\"wmode\" value=\"transparent\"><embed name=\"MediaPlayer\" type=\"application/x-mplayer2\" src=\"" + path + "\" autoplay=\"" + auto + "\" autostart=\"" + auto + "\" showcontrols=\"true\" enablecontextmenu=\"true\" showstatusbar=\"false\" pluginspage=\"http://www.microsoft.com/windows/windowsmedia/download\" wmode=\"transparent\" width=\"" + width + "\" height=\"" + height + "\"></embed> </object>"; if (flashvars != "") { $Get(flashvars).innerHTML = str; } else { document.write(str); } 
}

function EmbedFlash(path, width, height, flashvars) { if (height.length == 0) { height = "100%"; } if (width.length == 0) { width = "100%"; } str = "<object id=\"FlashContent\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"  codeBase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0\" quality=\"high\" width=\"" + width + "\" height=\"" + height + "\"> <param name=\"flashvars\" value=\"" + flashvars + "\"/> <param name=\"allowScriptAccess\" value=\"always\">  <param name=\"allowFullScreen\" value=\"true\"/> <param name=\"movie\" value=\"" + path + "\"/> <param name=\"src\" value=\"" + path + "\"/> <param name=\"quality\" value=\"high\"/> <param name=\"wmode\" value=\"transparent\"/> <param name=\"bgcolor\" value=\"#000000\"/> <embed name=\"FlashContent\" src=\"" + path + "\" quality=\"high\" flashvars=\"" + flashvars + "\" allowFullScreen=\"true\"  allowScriptAccess=\"always\" wmode=\"transparent\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"" + width + "\" height=\"" + height + "\"></embed> </object>"; document.write(str); }

function ChangeImage(path, pic_width, swf_height, flashvars) { document.write('<object id="FlashContent" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="' + pic_width + '" height="' + swf_height + '" style="margin: 0px 0px 0px 0px;"> <param name="movie" value="' + path + '"> <param name="quality" value="high"> <param name="wmode" value="transparent"> <param name="FlashVars" value="' + flashvars + '"> <embed style="margin: 0px 0px 0px 0px;" src="' + path + '" FlashVars="' + flashvars + '" quality="high" width="' + pic_width + '" height="' + swf_height + '" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer"> </object>'); }

function $Get(idname) {
    if (document.getElementById) {
        return document.getElementById(idname);
    }
    else if (document.all) {
        return document.all[idname];
    }
    else if (document.layers) {
        return document.layers[idname];
    }
    else {
        return null;
    }
}

function Trim(iStr) {
    while (iStr.charCodeAt(0) <= 32) { iStr = iStr.substr(1); } while (iStr.charCodeAt(iStr.length - 1) <= 32) { iStr = iStr.substr(0, iStr.length - 1); } return iStr;
}

function Left(str, n) {
    if (n <= 0) { return ""; } else if (n > String(str).length) { return str; } else { return String(str).substring(0, n); }
}

function Right(str, n) {
    if (n <= 0) return ""; else if (n > String(str).length) return str; else { var iLen = String(str).length; return String(str).substring(iLen, iLen - n); }
}

function chkSelect_OnMouseMove(tableRow) { var checkBox = tableRow.childNodes[1].childNodes[1]; if (checkBox.checked == false) tableRow.style.backgroundColor = "#ffffcc"; }
function chkSelect_OnMouseOut(tableRow, rowIndex) { var checkBox = tableRow.childNodes[1].childNodes[1]; if (checkBox.checked == false) { var bgColor; if (rowIndex % 2 == 0) bgColor = "#ffffff"; else bgColor = "#f5f5f5"; tableRow.style.backgroundColor = bgColor; } }
function chkSelect_OnClick(checkBox, rowIndex) { var bgColor; var tableRow = checkBox.parentNode.parentNode; if (rowIndex % 2 == 0) bgColor = "#ffffff"; else bgColor = "#f5f5f5"; if (checkBox.checked == true) tableRow.style.backgroundColor = "#b0c4de"; else tableRow.style.backgroundColor = bgColor; }
function chkSelectAll_OnClick(checkBox) { re = new RegExp('chkBox'); re2 = new RegExp('chkSelectAll'); for (i = 0; i < document.forms[0].elements.length; i++) { elm = document.forms[0].elements[i]; if (elm.type == 'checkbox') { if (re.test(elm.id) && re2.test(elm.id) == false) { elm.checked = checkBox.checked; var tableId = elm.parentNode.parentNode.id; chkSelect_OnClick(elm, i); } } } }
function OnlyInputNumber(event, Characters) { var re; var ch = String.fromCharCode(event.keyCode); if (event.keyCode < 32) { return; }; if ((event.keyCode <= 57) && (event.keyCode >= 48)) { if (!event.shiftKey) { return; } } if (Characters.length > 0 && ch == Characters) { return; } event.returnValue = false; }

//function OnlyInputNumber(Characters) {
//    return Characters.replace(/[^0-9\.]/g, '');
//}


function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return "";
}

//function toggleXPMenu(block, type) { var CloseImage = "images/closed.gif"; var OpenImage = "images/open.gif"; var divid = block; var img = "img" + block; if (($Get(divid).style.display == "" && type.toLowerCase() != "open") || type == "close") { $Get(divid).style.display = "none"; $Get(img).src = OpenImage; return false; } else { $Get(divid).style.display = ""; $Get(img).src = CloseImage; return false; } }

function toggleXPMenu(block) { var CloseImage = "images/closed.gif"; var OpenImage = "images/open.gif"; var divid = block; var img = "img" + block; if ($Get(divid).style.display == "") { $Get(divid).style.display = "none"; $Get(img).src = OpenImage; return false; } else { $Get(divid).style.display = ""; $Get(img).src = CloseImage; return false; } }

function openwindow(url,mwidth,mheight)
{
	window.open(url,"","width=" + mwidth + "px,height=" + mheight + "px,resizable=0,scrollbars=1,status=1,location=0")
}
function FindCtrName(control) {
    return $('[name*=' + control + ']');
}
function FindCtrClass(control) {
    return $('[class*=' + control + ']');
}
function FindCtrId(control) {
    return $('[id*=' + control + ']');
}
function FindOpenerCtrName(control) {
    if (window.opener != null)
        return $('[name*=' + control + ']', window.opener.document);
    else
        return $('[name*=' + control + ']', window.parent.document);
}
function FindOpenerCtrId(control) {
    if (window.opener != null)
        return $('[id*=' + control + ']', window.opener.document);
    else
        return $('[id*=' + control + ']', window.parent.document);
}
function LoadBanKhai() {
    var type = $('input:radio:checked[name*=rblRegister_For]').val();
    if(type == "com"){
        $(".popup_url").colorbox({ href: "/bankhaitochuc.aspx", title: "BẢN KHAI ĐĂNG KÝ TÊN MIỀN (TỔ CHỨC)", iframe: true, width: 620, height: "100%" });
    } else {
        $(".popup_url").colorbox({ href: "/bankhaicanhan.aspx", title: "BẢN KHAI ĐĂNG KÝ TÊN MIỀN (CÁ NHÂN)", iframe: true, width: 620, height: "100%" });
	}
}

function clear_data_customer() {
    $("#email input").val('');
    $("#email2 input").val('');
    $("#name input").val('');
    $("#name select").val('');
    $("#country select").val("VN");
    $("#province input").val("");
    $("#province select").val("Hà Nội");
    $('#province input').hide();
    $('#province select').show();
    $("#city input").val('');
    $("#phone input").val('');
    $("#fax input").val('');
    $("#address input").val('');
    $("#taxcode input").val('');
    $("#NgaySinh input").val('');
}

function clear_data_register() {
    $("#emailR input").val('');
    $("#email2R input").val('');
    $("#nameR input").val('');
    $("#nameR select").val('Ông');
    $("#countryR select").val("VN");
    $("#provinceR input").val("");
    $("#provinceR select").val("Hà Nội");
    $('#provinceR input').hide();
    $('#provinceR select').show();
    $("#cityR input").val('');
    $("#phoneR input").val('');
    $("#faxR input").val('');
    $("#addressR input").val('');
    $("#taxcodeR input").val('');
    $("#zipcodeR input").val('');
    $("#NgaySinhR input").val('');
}

function clear_data_user() {
    $("#emailU input").val('');
    $("#email2U input").val('');
    $("#nameU input").val('');
    $("#nameU select").val('Ông');
    $("#countryU select").val("VN");
    $("#provinceU input").val("");
    $("#provinceU select").val("Hà Nội");
    $('#provinceU input').hide();
    $('#provinceU select').show();
    $("#cityU input").val('');
    $("#phoneU input").val('');
    $("#faxU input").val('');
    $("#addressU input").val('');
    $("#taxcodeU input").val('');
    $("#zipcodeU input").val('');
    $("#NgaySinhU input").val('');
}


function copy_data_customer(){
	$("#emailR input").val($("#email input").val());
	$("#email2R input").val($("#email2 input").val());
	if ($("#name select").val() == "")
	    $("#nameR input").val($("#name input").val());
	else {
	    $("#nameR input").val("");
	    $("#nameR select").focus();
	}
	$("#nameR select").val($("#name select").val());
    $("#countryR select").val($("#country select").val());
	$("#provinceR select").val($("#province select").val());
	$("#provinceR input").val($("#province input").val());
	$("#cityR input").val($("#city input").val());
	$("#phoneR input").val($("#phone input").val());
	$("#faxR input").val($("#fax input").val());
	$("#addressR input").val($("#address input").val());
	$("#taxcodeR input").val($("#taxcode input").val());
	$("#zipcodeR input").val($("#zipcode input").val());
	$("#NgaySinhR input").val($("#NgaySinh input").val());
	GetUserInfoByEmail($("#email input").val());
}

function copy_data_register() {
    $("#emailU input").val($("#emailR input").val());
    $("#email2U input").val($("#email2R input").val());
    $("#nameU input").val($("#nameR input").val());
    $("#nameU select").val($("#nameR select").val());
    var type = $('input:radio:checked[name*=rblRegister_For]').val();
    if (type == "com"){
        $("#nameU input").val("");
        $("#nameU input").focus();
    }
    $("#txtNgaySinhs input").val($("#NgaySinh input").val());
    $("#countryU select").val($("#countryR select").val());
    $("#provinceU select").val($("#provinceR select").val());
    $("#provinceU input").val($("#provinceR input").val());
    $("#cityU input").val($("#cityR input").val());
    $("#phoneU input").val($("#phoneR input").val());
    $("#faxU input").val($("#faxR input").val());
    $("#addressU input").val($("#addressR input").val());
    $("#taxcodeU input[type=text]").val($("#taxcodeR input[type=text]").val());
    $("#zipcodeU input[type=text]").val($("#zipcodeR input[type=text]").val());
    $("#NgaySinhU input[type=text]").val($("#NgaySinhR input[type=text]").val());
}


function GetOwnerInfoByReseller(username) {
    $.ajax({
        url: 'ajax/getemail.aspx',
        data: 'user=' + username,
        success: function (result) {
            if (result != null && result.indexOf('null') < 0) {
                var myarr = result.split("|");
                if (myarr[0].trim() != "") {
                    $("#email input").val(myarr[0]); 
                }
                if (myarr[1].trim() != "") {
                    $("#email2 input").val(myarr[1]);
                }
                if (myarr[2].trim() != "") {
                    $("#name input").val(myarr[2]);
                }
                if (myarr[3].trim() != "") {
                    $("#phone input").val(myarr[3]); 
                }
                if (myarr[4].trim() != "") { 
                    $("#fax input").val(myarr[4]); 
                }
                if (myarr[5].trim() != "") { 
                    $("#address input").val(myarr[5]); 
                }
                if (myarr[6].trim() != "") { 
                    $("#taxcode input").val(myarr[6]); 
                }
            }
        }
    });
}

function GetRegisterInfoByReseller(username) {
    $.ajax({
        url: 'ajax/getemail.aspx',
        data: 'user=' + username,
        success: function (result) {
            if (result !=null && result.indexOf('null') < 0) {
                var type = $('input:radio:checked[name*=rblRegister_For]').val();
                var myarr = result.split("|");
                if (myarr[0].trim() != "") {
                    $("#emailR input").val(myarr[0]);
                }
                if (myarr[1].trim() != "") {
                    $("#email2R input").val(myarr[1]);
                }
                if (myarr[2].trim() != "" && (type == "com" || $("#name select").val() == ""))
                    $("#nameR input").val(myarr[2]);
                else
                    $("#nameR input").val('');
                if (myarr[3].trim() != "") {
                    $("#phoneR input").val(myarr[3]);
                }
                if (myarr[4].trim() != "") {
                    $("#faxR input").val(myarr[4]);
                }
                if (myarr[5].trim() != "") {
                    $("#addressR input").val(myarr[5]);
                }
                if (myarr[6].trim() != "") {
                    $("#taxcodeR input").val(myarr[6]);
                }
            }
        }
    });
}

function GetOwnerInfoByEmail(email) {
    $.ajax({
        url: 'ajax/getemail.aspx',
        data: 'email=' + email,
        success: function (result) {
            if (result != null && result.indexOf('null') < 0) {
                var myarr = result.split("|");
                if (myarr[0].trim() != "") {
                    $("#email input").val(myarr[0]);
                }
                if (myarr[1] != null && myarr[1].trim() != "") {
                    $("#email2 input").val(myarr[1]);
                }
                if (myarr[2].trim() != "") {
                    $("#name input").val(myarr[2]);
                }
                if (myarr[3].trim() != "") {
                    $("#phone input").val(myarr[3]);
                }
                
                if (myarr[4]!= null && myarr[4] != "") {
                    $("#fax input").val(myarr[4]);
                }
                if (myarr[5].trim() != "") {
                    $("#address input").val(myarr[5]);
                }
                if (myarr[6].trim() != "") {
                    $("#taxcode input[type=text]").val(myarr[6]);
                }
                if (myarr[7].trim() != "") {
                    $("#zipcode input").val(myarr[7]);
                }
                if (myarr[8].trim() != null && myarr[8].trim() != "") {
                    $("#country select").val(myarr[8]);
                    if ($('#country select option:selected').val() == "VN") {
                        $('#province input').hide();
                        $('#province select').show();
                    } else {
                        $('#province input').hide();
                        $('#province select').show();
                    }
                }
                if (myarr[9].trim() != null && myarr[9].trim() != "") {
                    $("#province input").val(myarr[9]);
                    if ($('#country select option:selected').val() == "VN")
                        $("#province select").val(myarr[9]);
                }
                if (myarr[10].trim() != null && myarr[10].trim() != "") {
                    $("#city input").val(myarr[10]);
                }
                //if (myarr[11].trim() != "") {
               
                $("#name select").val(myarr[11]);
                //}
                if (myarr[12].trim() != "") {
                    $("#NgaySinh input").val(myarr[12]);
                }
            }
        }
    });
}
function GetRegisterInfoByEmail(email) {
    $.ajax({
        url: 'ajax/getemail.aspx',
        data: 'email=' + email,
        success: function (result) {
            if (result != null && result.indexOf('null') < 0) {
                var myarr = result.split("|");
                if (myarr[0].trim() != "") {
                    $("#emailR input").val(myarr[0]);
                }
                if (myarr[1]!= null && myarr[1].trim() != "") {
                    $("#email2R input").val(myarr[1]);
                }
                if (myarr[2] != null && myarr[2].trim() != "") {
                    $("#nameR input").val(myarr[2]);
                }
                if (myarr[3] != null && myarr[3].trim() != "") {
                    $("#phoneR input").val(myarr[3]);
                }
                if (myarr[4] != null && myarr[4].trim() != "") {
                    $("#faxR input").val(myarr[4]);
                }
                if (myarr[5] != null && myarr[5].trim() != "") {
                    $("#addressR input").val(myarr[5]);
                }
                if (myarr[6] != null && myarr[6].trim() != "") {
                    $("#taxcodeR input[type=text]").val(myarr[6]);
                }
                if (myarr[7] != null && myarr[7].trim() != "") {
                    $("#zipcodeR input").val(myarr[7]);
                }
                if (myarr[8].trim() != "") {
                    $("#countryR select").val(myarr[8]);
                    if ($('#countryR select option:selected').val() == "VN") {
                        $('#provinceR input').hide();
                        $('#provinceR select').show();
                    } else {
                        $('#provinceR input').hide();
                        $('#provinceR select').show();
                    }
                }
                if (myarr[9].trim() != "") {
                    $("#provinceR input").val(myarr[9]);
                    if ($('#countryR select option:selected').val() == "VN")
                        $("#provinceR select").val(myarr[9]);
                }
                if (myarr[10].trim() != "") {
                    $("#cityR input").val(myarr[10]);
                }
                //if (myarr[11].trim() != "") {
                    $("#nameR select").val(myarr[11]);
                //}
                if (myarr[12].trim() != "") {
                    $("#NgaySinhR input").val(myarr[12]);
                }
            }
        }
    });
}
function GetUserInfoByEmail(email) {
    $.ajax({
        url: 'ajax/getemail.aspx',
        data: 'email=' + email,
        success: function (result) {
            if (result != null && result.indexOf('null') < 0) {
                var myarr = result.split("|");
                if (myarr[0].trim() != "") {
                    $("#emailU input").val(myarr[0]);
                }
                if (myarr[1] != null && myarr[1].trim() != "") {
                    $("#email2U input").val(myarr[1]);
                }
                if (myarr[2].trim() != "") {
                    $("#nameU input").val(myarr[2]);
                }
                if (myarr[3].trim() != "") {
                    $("#phoneU input").val(myarr[3]);
                }
                if (myarr[4].trim() != "") {
                    $("#faxU input").val(myarr[4]);
                }
                if (myarr[5].trim() != "") {
                    $("#addressU input").val(myarr[5]);
                }
                if (myarr[6].trim() != "") {
                    $("#taxcodeU input").val(myarr[6]);
                }
                if (myarr[7].trim() != "") {
                    $("#zipcodeU input").val(myarr[7]);
                }
                if (myarr[8].trim() != "") {
                    $("#countryU select").val(myarr[8]);
                    if ($('#countryU select option:selected').val() == "VN") {
                        $('#provinceU input').hide();
                        $('#provinceU select').show();
                    } else {
                        $('#provinceU input').hide();
                        $('#provinceU select').show();
                    }
                }
                if (myarr[9].trim() != "") {
                    $("#provinceU input").val(myarr[9]);
                    if ($('#countryU select option:selected').val() == "VN")
                        $("#provinceU select").val(myarr[9]);
                }
                if (myarr[10].trim() != "") {
                    $("#cityU input").val(myarr[10]);
                }
                //if (myarr[11].trim() != "") {
                    $("#nameU select").val(myarr[11]);
                //}
                if (myarr[12].trim() != "") {
                    $("#NgaySinhU input").val(myarr[12]);
                }
            }
        }
    });
}
String.prototype.capitalize = function () {
    return this.toLowerCase().replace(/(?:^|\s)\S/g, function (a) { return a.toUpperCase(); });
};

function RemoveUnicode(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/Đ/g, "D");
    return str;
}

function NormalizeString(str) 
{
    var arr = str.split(" ");
    for (var i = 0; i < arr.length; i++) {
        //if (arr[i] == arr[i].toLowerCase() || arr[i] != RemoveUnicode(arr[i])) {
        if (arr[i] != RemoveUnicode(arr[i])) {
            arr[i] = arr[i].capitalize();
        }
    }
    return arr.join(" ");
}


function CapitalizeWords(str) {
    //Capitalize first letter
    if (str == str.toUpperCase())
        str = str.capitalize();
    //remove multi commas
    str = str.replace(/(,)+/g, ', ');
    //remove multi space
    str = str.replace(/  +/g, ' ');
    //Normalized string
    str = NormalizeString(str);
    return str.trim();
}

function remove(arr, item) {
    for (var i = arr.length; i--; ) {
        if (arr[i] == item) {
            arr.splice(i, 1);
        }
    }
}

function UploadFile(fId, timestamp, token, attId) {
    var queueSize = 0;
    var list = [];
    $("#" + fId).uploadify({
        'formData': {
            'timestamp': timestamp,
            'token': token
        },
        'fileSizeLimit': '10MB',
        'removeCompleted': false,
        'swf': 'uploadify.swf',
        'uploader': 'uploadify.ashx',
        'onSelect': function (file) {
            list.push(file.name);
            $("[id*=" + attId + "]").val(list);
        },
        'onCancel': function (file) {
            remove(list, file.name);
            $("[id*=" + attId + "]").val(list);
        }
    });
}
