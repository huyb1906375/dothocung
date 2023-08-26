/*========================= POST FORM ==============*/
$(document).ready(function() {
   
    $("body").on('change', '.inputimage', function() {
		alert('aaa');
		/*
        var noImage = "uploads/images/upload-image.png";
        var defaultImage = "uploads/images/logo.png";
        var filename = $(this).val().split('/').pop().split('\\').pop(); ;
        var input = this;
		//alert(GetImageSize());
		alert(input.value);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).parents('.item').find('img').attr('src', e.target.result);
                $(input).parents('.item').append('<span class="imgdelete"></span>');
                CaculateFileSize();
            }
            reader.readAsDataURL(input.files[0]);
        }
		*/
        
    });
    $("body").on('click', '.imgdelete', function() {
        var noImage = "images/upload-image.png";
        input = $(this).parents('.item').find('input');
        input.replaceWith(input.clone(true)); //repace with new
        $(this).parents('.item').find('img').attr('src', noImage);
		$(this).parents('.item').find('.inputimage').val("");
        $(this).parents('.item').find('.imgdelete').remove();
        CaculateFileSize();
    });
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
