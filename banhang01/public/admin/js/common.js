$(document).ready(function(){
	$(".select2").select2();
	$("body").on('change', '.inputimage', function() {
		//alert('aaa');
		var noImage = "uploads/images/upload-image.png";
		var defaultImage = "uploads/images/upload-image.png";
		var filename = $(this).val().split('/').pop().split('\\').pop(); ;
		var input = this;
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$(input).parents('.item').find('img').attr('src', e.target.result);
				$(input).parents('.item').append('<span class="imgdelete"></span>');
				CaculateFileSize();
			}
			reader.readAsDataURL(input.files[0]);
		}
		
	});
	$("body").on('click', '.imgdelete', function() {
        var noImage = "uploads/images/upload-image.png";
        input = $(this).parents('.item').find('input');
        input.replaceWith(input.clone(true)); //repace with new
        $(this).parents('.item').find('img').attr('src', noImage);
		$(this).parents('.item').find('.inputimage').val("");
        $(this).parents('.item').find('.imgdelete').remove();
        CaculateFileSize();
    });
	/*
	$("#txtHangHoa").autocomplete({
		source: function (request, response) {
            $.ajax({
                url: 'admin/ajaxdonhang/cms_autocomplete_products',
                data: 'req='+request.term,				
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    
                },
                error: function (response) { alert(response.responseText); },
                failure: function (response) { alert(response.responseText); }
            });
        },
        select: function (event, ui) {
            //alert(ui.item.sp_id);
            
        },
        minLength: 1
    }).keyup(function (e) {
        
    })
    .autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>").append("<div><b>" + item.sp_ten + "</b><br/>ĐG: " + item.sp_gia_ban + "</div>")
                        .appendTo(ul);
    };
	*/
});
function CaculateFileSize() {

    if (GetImageSize() > 29)
        alert("Dung lượng ảnh quá lớn vui lòng xóa bớt hoặc giảm dung lượng trước khi up hình");
}

function GetImageSize() {
    var size = 0;
    $(".inputimage").each(function(index) {
        if (this.files[0] != null)
            size += this.files[0].size;
    });
    size = size / (1024 * 1024);
    return size;
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
	
	var checks = document.getElementsByName('id[]');
	for (i = 0; i < checks.length; i++)
		checks[i].checked = $value ;	
}
function checkAll(){	
	alert($value);
	var checks = document.getElementsByName('id[]');
	for (i = 0; i < checks.length; i++)
		checks[i].checked = true ;	
}

function uncheckAll(field){
	var checks = document.getElementsByName('id[]');
	for (i = 0; i < checks.length; i++)
		checks[i].checked = false ;	
}
