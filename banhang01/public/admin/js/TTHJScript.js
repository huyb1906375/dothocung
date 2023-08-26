function gourl(url){
	window.location=url;
}
function NewWindow(a,b,c,e,d)
{
    LeftPosition=screen.width?(screen.width-c)/2:0;
    TopPosition=screen.height?(screen.height-e)/2:0;
    settings="height="+e+",width="+c+",top="+TopPosition+",left="+LeftPosition+",scrollbars="+d+",resizable";
    window.open(a,b,settings)
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
function TinhGiaBan(obj)
{
	try{
	    
	    var giathitruong = obj.replace(",","");
	    document.getElementById('txtGiaBan').value = formatCurrency(giathitruong);
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