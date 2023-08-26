var COMMAND_GET_DISTRICTS = 2;
var COMMAND_GET_WARDS = 3;
var COMMAND_GET_STREETS = 4;
var COMMAND_LOGIN = 6;
var COMMAND_LOGOUT = 7;
var COMMAND_RECOVER = 8;
var COMMAND_REGISTER = 9;
var COMMAND_GET_VIP_PROPERTY = 23;
var COMMAND_GET_BANNERS = 100;
var COMMAND_M_VIP_PROPERTY_LIST = 2000;

jQuery.fn.center = function() {
this.css("top", ($(window).height() - $(this).height()) / 2 + $(window).scrollTop() + "px");
this.css("left", ($(window).width() - $(this).width()) / 2 + "px");
    return this;
}
$(document).ready(function() {
    //InitSearchBox();
    InitSearchProjectBox();
    ReszieMenu();
    
    function ReszieMenu() {
        var menuHeight = $('.menu-left .menu').height();
        $('.menu-left .menu').css('max-height', $(window).height() - 50);
        $('.menu-left .menu').css('overflow-y', 'scroll');
    }

    $("body").on('click', '.header .view-search', function(e) {
        if ($('.header .view-search').hasClass('menu-hide')) {
            $('.head-search-box').slideDown(100);
            $('.header .view-search').removeClass('menu-hide');
            $('.header .view-search').addClass('menu-show');
            var pageId = $('.page-id').val();
            if (pageId == 3) {//project
                $('.head-search-box .search-tab .property-tab').removeClass('selected');
                $('.head-search-box .search-tab .project-tab').addClass('selected');
                $('.head-search-box .project-search-content').show();

            } else {
                $('.head-search-box .search-tab .project-tab').removeClass('selected');
                $('.head-search-box .search-tab .property-tab').addClass('selected');
                $('.head-search-box .property-search-content').show();
            }
            GoTop();
        } else {
            $('.head-search-box').slideUp(100);
            $('.header .view-search').removeClass('menu-show');
            $('.header .view-search').addClass('menu-hide');
        }
    });
    $("body").on('click', '.header .menu-left>ul>li .expand', function(e) {
        $(this).parents("li").find(">ul").slideDown(200);
        $(this).removeClass('expand');
        $(this).addClass('collapse');
    });
    $("body").on('click', '.header .menu-left>ul>li .collapse', function(e) {
        $(this).parents("li").find(">ul").slideUp(200);
        $(this).removeClass('collapse');
        $(this).addClass('expand');
    });

    $("body").on('click', '.header .menu-left>span', function(e) {
        var menuLeft = $(this).parents('.menu-left');
        if (menuLeft.hasClass('menu-hide')) {//menu is hiding
            menuLeft.removeClass('menu-hide');
            menuLeft.addClass('menu-show');
            menuLeft.find('>ul').slideDown(200);
            $('.menu-fade').show();
        } else {//menu is showing
            menuLeft.removeClass('menu-show');
            menuLeft.addClass('menu-hide');
            menuLeft.find('>ul').slideUp(200);
            $('.menu-fade').hide();
        }
        $('.header .menu-right').removeClass('menu-show');
        $('.header .menu-right').addClass('menu-hide');
        $('.header .menu-right>ul').hide();
    });

    $("body").on('click', '.header .menu-right>span', function(e) {
        var menuRight = $(this).parents('.menu-right');
        if (menuRight.hasClass('menu-hide')) {//menu is hiding
            menuRight.removeClass('menu-hide');
            menuRight.addClass('menu-show');
            menuRight.find('>ul').slideDown(200);
            $('.menu-fade').show();
        } else {//menu is showing
            menuRight.removeClass('menu-show');
            menuRight.addClass('menu-hide');
            menuRight.find('>ul').slideUp(200);
            $('.menu-fade').hide();
        }
        $('.header .menu-left').removeClass('menu-show');
        $('.header .menu-left').addClass('menu-hide');
        $('.header .menu-left>ul').hide();
    });
    $("body").on('click', '.header .menu-right>ul>li.expand', function(e) {
        $(this).find(">ul").slideDown(300);
        $(this).removeClass('expand');
        $(this).addClass('collapse');
    });
    $("body").on('click', '.header .menu-right>ul>li.collapse', function(e) {
        $(this).find(">ul").slideUp(300);
        $(this).removeClass('collapse');
        $(this).addClass('expand');
    });
    $("body").on('click', '.header .menu-fade', function(e) {
        $('.header .menu-left>ul').hide();
        $('.header .menu-left').removeClass('menu-show');
        $('.header .menu-left').addClass('menu-hide');
        $('.header .menu-right>ul').hide();
        $('.header .menu-right').removeClass('menu-show');
        $('.header .menu-right').addClass('menu-hide');
        $('.header .menu-fade').hide();
    });
    //====== menu right =========//
    $("body").on('click', '.header .menu-right .show-login-form', function(e) {
        ShowLoginForm();
        var menuRight = $('.header .menu-right');
        menuRight.removeClass('menu-show');
        menuRight.addClass('menu-hide');
        menuRight.find('>ul').hide();
        $('.menu-fade').hide();

    });
    $("body").on('click', '.header .menu-right .show-register-form', function(e) {
        var url = "/publish/form/RegisterForm.aspx";
        $.post(url, function(data) {
            $('.register-form').html(data);
            $('.register-form').show();
            $('#fade').show();
            var menuRight = $('.header .menu-right');
            menuRight.removeClass('menu-show');
            menuRight.addClass('menu-hide');
            menuRight.find('>ul').hide();
            $('.menu-fade').hide();
            GoTop();
        });
    });
	//============Main Form=========//
	$("body").on('click', '.frmMain .title .exit', function(e) {
        $('.frmMain').hide();
        $('#fade').hide();
    });
    //============login form
    $("body").on('click', '.login-form .title .exit', function(e) {
        $('.login-form').hide();
        $('#fade').hide();
    });

    $("body").on('click', '.login-form .show-recover-form', function(e) {
        $('.login-form').hide();
        $('.recover-form').show();
        GoTop();
    });
    $("body").on('click', '.login-form .show-register-form', function(e) {
        var url = "/publish/form/RegisterForm.aspx";
        $.post(url, function(data) {
            $('.register-form').html(data);
            $('.register-form').show();

        });

        $('.login-form').hide();
        $('.register-form').show();
    });

    $('.login-form').keypress(function(e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            Login();
        }
    });
    //===================== SEARCH FORM ===============
    $("body").on('click', '.head-search-box .show-advance-search', function(e) {

        if ($('.head-search-box .extra').is(":visible")) {
            $('.head-search-box .show-advance-search').html("Nâng cao");
            $('.head-search-box .extra').slideUp(100);
        } else {
            $('.head-search-box .extra').slideDown(100);
            $('.head-search-box .show-advance-search').html("Thu gọn");
        }
    });
    $("body").on('click', '.head-search-box .property-tab', function(e) {
        //hide
        $('.head-search-box .project-tab').removeClass('selected');
        $('.head-search-box .project-search-content').hide();
        //show
        $('.head-search-box .property-tab').addClass('selected');
        $('.head-search-box .property-search-content').show();

    });
    $("body").on('click', '.head-search-box .project-tab', function(e) {
        //hide
        $('.head-search-box .property-tab').removeClass('selected');
        $('.head-search-box .property-search-content').hide();
        //show
        $('.head-search-box .project-tab').addClass('selected');
        $('.head-search-box .project-search-content').show();

    });
    //===================== RECOVER FROM ===============
    $("body").on('click', '.recover-form .title .exit', function(e) {
        $('.recover-form').hide();
        $('#fade').hide();
    });
    $('.recover-form').keypress(function(e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            Recover();
        }
    });
    //============================= REGISTER FORM ==============================//
    $("body").on('focus', '.register-form .row input', function(e) {
        $(this).parents('.row').find('.suggesstion').show();
    });
    $("body").on('blur', '.register-form .row input', function(e) {
        $(this).parents('.row').find('.suggesstion').hide();
    });
    $("body").on('focus', '.register-form .row textarea', function(e) {
        $(this).parents('.row').find('.suggesstion').show();
    });
    $("body").on('blur', '.register-form .row textarea', function(e) {
        $(this).parents('.row').find('.suggesstion').hide();
    });
    $("body").on('click', '.register-form .agent', function() {
        var agent = $('.register-form .agent:checked').val();
        if (agent == 2)
            $('.register-form .expand').show();
        else
            $('.register-form .expand').hide();
    });

    $("body").on('click', '.register-form .title .exit', function(e) {
        $('.register-form').hide();
        $('#fade').hide();
    });
    $("body").on('click', '.register-form .button .close', function(e) {
        $('.register-form').hide();
        $('#fade').hide();
    });
    $("body").on('click', '.register-form .button .register', function(e) {
        RegisterMember();
    });

    $('.register-form').keypress(function(e) {

        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            if ($('.register-form .message-box').is(":hidden")) {
                RegisterMember();
            } else {
                if ($('.register-form .message-box .button .success').is(":hidden")) {
                    $('.register-form .message-box .button .fail').css('display', 'none'); //button fail 
                    $('.register-form .loading').css('display', 'none'); //loading
                    $('.register-form .message-box .button .fail').parent().parent().css('display', 'none'); //message-box

                } else {
                    $('.register-form .message-box .button .success').css('display', 'none'); //button success
                    $('.register-form .message-box .button .success').parent().parent().css('display', 'none'); //message-box
                    $('.register-form .loading').css('display', 'none'); //loading
                    $('.register-form .message-box .button .success').parent().parent().parent().css('display', 'none'); //register form
                    $('#fade').css('display', 'none');
                    location.href = "/quan-ly-ca-nhan.html";
                }
            }
        }
    });


    $("body").on('click', '.register-form .message-box .button .success', function(e) {
        $(this).css('display', 'none'); //button success
        $(this).parent().parent().css('display', 'none'); //message-box
        $('.register-form .loading').css('display', 'none'); //loading
        $(this).parent().parent().parent().css('display', 'none'); //register form	
        $('#fade').css('display', 'none');
        //reset form
        location.reload();
    });

    $("body").on('click', '.register-form .message-box .button .fail', function(e) {
        $(this).css('display', 'none'); //button fail 
        $('.register-form .loading').css('display', 'none'); //loading
        $(this).parent().parent().css('display', 'none'); //message-box	    
        //reset form
    });

    //MANAGEMENT MENU
    $("body").on('click', '.management-page .right', function(e) {
        if ($('.management-page .right .manage-menu').is(":visible")) {
            $('.management-page .right .manage-menu').hide();
            $('.management-page .manage-menu-fade').hide();
        } else {
            $('.management-page .right .manage-menu').show();
            $('.management-page .manage-menu-fade').show();
        }
    });
    $("body").on('click', '.management-page .manage-menu-fade', function(e) {
        $('.management-page .right .manage-menu').hide();
        $('.management-page .manage-menu-fade').hide();
    });


    //VIP PAGING
    $('.home-page .vip-paging span').click(function() {
        var clickedPage = $(this).html();
        var activingPage = $('.home-page .vip-paging').find('.active').html();
        if (clickedPage == activingPage)
            return;
        $('.home-page .vip-paging span').removeClass('active');
        $(this).addClass('active');
        $('.home-page .vip-box-main .loading').show();

        var url = "/handler/Handler.ashx?command=" + COMMAND_M_VIP_PROPERTY_LIST + "&page=" + clickedPage;
        $.post(url, function(data) {
            if (data != "") {
                $('.home-page .vip-box-main .content').html(data);
                var offset = $('.home-page .vip-box-main').offset();
                $('html,body').animate({ scrollTop: offset.top - 50 }, 0);
            }
            $('.home-page .vip-box-main .loading').hide();
        }).error(function(data) {
            $('.home-page .vip-box-main .loading').hide();
        });
    });
});

function closeForm(formname) {
    document.getElementById(formname).style.display = 'none';
    document.getElementById('fade').style.display = 'none';
}
function Login() {
    var loginname = $('.login-form #account').val();
    var password = $('.login-form #password').val();
    var remember = "";
    if (loginname.length == 0 || password.length == 0) {
        alert("Chưa nhập tên truy cập hoặc mật khẩu");
        return;
    }
    if ($('.login-form #remember').is(':checked'))
        remember = "on";
    else
        remember = "";
    $('.login-form .loading').show();
    var url = "/handler/Handler.ashx?command=" + COMMAND_LOGIN;
    $.post(url, {
        loginname: loginname,
        password: password,
        remember: remember
    }).success(function(data) {
        var fields = data.split(/;/);
        var type = fields[0];
        var message = fields[1];

        if (type == "1") {
            $('.menu-right ul').html("" +
                "<li><img src='/publish/img/m-post.png'><a href='/dang-tin-nha-dat.html' title='đăng tin nhà đất' onclick='return CheckLogin()'>Đăng tin miễn phí</a></li>" +
                "<li><img src='/publish/img/m-user.png'><a href='/quan-ly-ca-nhan.html'>Quản lý cá nhân</a></li>" +
                "<li><img src='/publish/img/m-logout.png'><a href='/handler/Handler.ashx?command=7'>Thoát khỏi hệ thống</a></li>");

            //hide login
            $('.login-form').hide();
            $('#fade').hide();
            var currentURL = window.location.href;

            if (currentURL.indexOf("/dang-tin-nha-dat") == -1) {
                location.href = "/quan-ly-ca-nhan.html";
            } else {
                //đang ở trang đăng tin
                $('.post-content .lienhe').val(fields[1]);
                $('.post-content .dienthoai').val(fields[2]);
            }

        } else {//fail
            $('.login-form .input-form .message').html(message);
        }
        $('.login-form .loading').hide();
    }).error(function(data) {
        alert("Xảy ra lỗi!");
    });
}

function RegisterMember() {
    var account = $('.register-form #account').val();
    var password1 = $('.register-form #password1').val();
    var password2 = $('.register-form #password2').val();
    var username = $('.register-form #username').val();
    var phone1 = $('.register-form #phone1').val();
    var phone2 = $('.register-form #phone2').val();
    var email1 = $('.register-form #email1').val();
    var email2 = $('.register-form #email2').val();
    var province = $('.register-form #register_province').val();
    var district = $('.register-form #register_district').val();
    var agent = $('.register-form .agent:checked').val();
    var loaibds = $('.register-form #loaibds').val();
    var province1 = $('.register-form #register_province1').val();
    var district1 = $('.register-form #register_district1').val();
    var introduce = $('.register-form #introduce').val();
    var captcha = $('.register-form #captcha').val();
    var noemail = "";
    if ($('.register-form .no-email').is(':checked')) {
        noemail = "on";
    }
    $('.register-form *').removeClass('fielderror');
    //account
    var re = new RegExp("^[a-zA-Z0-9_-]{3,30}$");
    var m = re.exec(account);
    if (m == null) {
        $('.register-form #account').addClass('fielderror');
        alert("Tên truy cập không hợp lệ");
        return;
    }
    if (account.length < 3 || account.length > 30) {
        $('.register-form #account').addClass('fielderror');
        alert("Tên truy cập phải lớn hơn 3 và nhỏ hơn 30 ký tự");
        return;
    }
    if (password1.length < 6 || password1.length > 30) {
        $('.register-form #password1').addClass('fielderror');
        alert("Mật khẩu phải lớn hơn 6 và nhỏ hơn 30 ký tự");
        return;
    }

    if (password1 != password2) {
        $('.register-form #password1').addClass('fielderror');
        $('.register-form #password2').addClass('fielderror');
        alert("Mật khẩu được nhập phải giống nhau");
        return;
    }

    if (username.length < 3 || username.length > 45) {
        $('.register-form #username').addClass('fielderror');
        alert("Họ tên từ 3 đến 45 ký tự");
        return;
    }
    //check phone 1
    re = new RegExp("^[0-9]{8,12}$");
    m = re.exec(phone1);
    if (m == null) {
        $('.register-form #phone1').addClass('fielderror');
        alert("Số điện thoại không hợp lệ");
        return;
    }
    if (phone2 != "") {
        //check phone 2
        re = new RegExp("^[0-9]{8,12}$");
        m = re.exec(phone2);
        if (m == null) {
            $('.register-form #phone2').addClass('fielderror');
            alert("Số điện thoại không hợp lệ");
            return;
        }
        //
        if (phone1 == phone2) {
            $('.register-form #phone1').addClass('fielderror');
            $('.register-form #phone2').addClass('fielderror');
            alert("Số điện thoại phải khác nhau");
            return;
        }
    }
    if (noemail == "") {
        re = new RegExp("^([0-9a-zA-Z]([-\\.\\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\\w]*[0-9a-zA-Z]\\.)+[a-zA-Z]{2,9})$");
        m = re.exec(email1);

        if (m == null) {
            $('.register-form #email1').addClass('fielderror');
            alert("Email không hợp lệ");
            return;
        }

        if (email1 != email2) {
            $('.register-form #email1').addClass('fielderror');
            $('.register-form #email2').addClass('fielderror');
            alert("Email được nhập phải giống nhau");
            return;
        }
    }
    if (province == 0) {
        $('.register-form #register_province').addClass('fielderror');
        alert("Chưa chọn Tỉnh/Thành");
        return;
    }
    if (district == 0) {
        $('.register-form #register_district').addClass('fielderror');
        alert("Chưa chọn Quận/Huyện");
        return;
    }
    if (agent == null) {
        $('.register-form .agent').addClass('fielderror');
        alert("Chưa chọn loại tài khoản");
        return;
    } else {
        if (agent == 2) {
            if (loaibds == '0;0') {
                $('.register-form #loaibds').addClass('fielderror');
                alert("Chưa chọn loại BĐS môi giới chính");
                return;
            }
            if (province1 == 0) {
                $('.register-form #register_province1').addClass('fielderror');
                alert("Chưa chọn khu vực môi giới chính");
                return;
            }
            if (district1 == 0) {
                $('.register-form #register_district1').addClass('fielderror');
                alert("Chưa chọn khu vực môi giới chính");
                return;
            }
            if (introduce.length <= 100) {
                $('.register-form #introduce').addClass('fielderror');
                alert("Giới thiệu về hoạt động môi giới phải lớn hơn 100 ký tự");
                return;
            }
        }
    }
    if (captcha.length == 0) {
        $('.register-form #captcha').addClass('fielderror');
        alert("Chưa nhập mã an toàn");
        return;
    }

    $('.register-form .loading').show();

    var url = "/handler/Handler.ashx?command=" + COMMAND_REGISTER;
    $.post(url,
	    {
	        account: account,
	        password: password1,
	        username: username,
	        phone1: phone1,
	        phone2: phone2,
	        email: email1,
	        noemail: noemail,
	        province: province,
	        district: district,
	        agent: agent,
	        loaibds: loaibds,
	        province1: province1,
	        district1: district1,
	        introduce: introduce,
	        captcha: captcha
	    }).success(function(data) {
	        var fields = data.split(/;/);
	        type = fields[0];
	        message = fields[1];

	        //fail
	        if (type == "0") {
	            //$('.register-form .loading').hide();

	            $('.register-form .message-box .message').html(message);
	            $('.register-form .message-box').show();
	            //show button fail
	            $('.register-form .message-box .fail').css('display', 'inline-block');
	            $('.register-form .message-box .success').hide();
	            $('.register-form img.captchagenerator').attr("src", "/CaptchaGenerator.ashx?t=" + Math.floor((Math.random() * 1000) + 1)); //reload captcha          
	        } else {

	            $('.register-form .message-box .message').html(message);
	            $('.register-form .message-box').show();
	            //show button success
	            $('.register-form .message-box .success').css('display', 'inline-block');
	            $('.register-form .message-box .fail').hide();
	            $('.reg-menu-box .reg-menu').html('<a class="regular-post" href="/dang-tin-nha-dat.html">Đăng tin</a><a class="advance-post" href="/dang-tin-nang-cao.html" rel="nofollow">Đăng tin dự án</a><a href="/quan-ly-ca-nhan.html" rel="nofollow"><span class="user">Quản lý cá nhân</span></a> &nbsp; (<a href="/handler/Handler.ashx?command=7"><span class="exit">Thoát</span></a>)');
	        }
	        GoTop();
	    }).error(function(data) {
	        alert("Xảy ra lỗi, vui lòng thử lại sau");
	        $('.register-form img.captchagenerator').attr("src", "/CaptchaGenerator.ashx?t=" + Math.floor((Math.random() * 1000) + 1)); //reload captcha   
	        $('.register-form .loading').hide();
	    });
}

function Recover() {
    var loginname = $('.recover-form #username').val();
    var email = $('.recover-form #email').val();
    if (loginname.length == 0) {
        alert("Chưa nhập tên truy cập.");
        return;
    }
    if (email.length == 0) {
        alert("Chưa nhập email.");
        return;
    }

    $('.recover-form .loading').css('display', 'block');
    var url = "/handler/Handler.ashx?command=" + COMMAND_RECOVER;
    $.post(url, {
        loginname: loginname,
        email: email

    }).success(function(data) {
        var fields = data.split(/;/);
        var type = fields[0];
        var message = fields[1];

        //success
        if (type == "1") {
            alert(message);
            closeForm('recover-form');
        } else {
            $('.recover-form .input-form .message').html('<span style=\'color:red\'>' + message + '</span>');
        }
        $('.recover-form .loading').hide();
    }).error(function() {
        alert("Xảy ra lỗi");
        $('.recover-form .loading').hide();
    });
}

//search property
$(document).ready(function() {
    $("body").on('change', '.head-search-box .demand-row select', function(e) {
        LoadPrice();
    });

    $("body").on('change', '.head-search-box .demand-row select', function(e) {
        var demandId = $(this).val();
        $('.hddSDemandId').val(demandId);
    });

    $("body").on('change', '.head-search-box .property-type-row select', function(e) {
        var propertyTypeId = $(this).val();
        $('.hddSPropertyTypeId').val(propertyTypeId);
    });

    $("body").on('change', '.head-search-box .province-row select', function(e) {
        var provinceId = $(this).val();
        $('.hddSProvinceId').val(provinceId);
        LoadDictrict(provinceId);
    });

    $("body").on('change', '.head-search-box .district-row select', function(e) {
        var districtId = $(this).val();
        $('.hddSDistrictId').val(districtId);
        LoadWardAndStreet(districtId);
    });
    $("body").on('change', '.head-search-box .ward-row select', function(e) {
        var wardId = $(this).val();
        $('.hddSWardId').val(wardId);
    });
    $("body").on('change', '.head-search-box .street-row select', function(e) {
        var streetId = $(this).val();
        $('.hddSStreetId').val(streetId);
    });
    $("body").on('change', '.head-search-box .square-row select', function(e) {
        var squareId = $(this).val();
        $('.hddSSquareId').val(squareId);
    });
    $("body").on('change', '.head-search-box .price-row select', function(e) {
        var priceId = $(this).val();
        $('.hddSPriceId').val(priceId);
    });
    $("body").on('change', '.head-search-box .direct-row select', function(e) {
        var directId = $(this).val();
        $('.hddSDirectId').val(directId);
    });
/*
    $("body").on('click', '.head-search-box .btnPropertySearch', function(e) {
        var loaitin = $('.head-search-box .demand-row select').val();
        var loaibds = $('.head-search-box .property-type-row select').val();
        var gia = $('.head-search-box .price-row select').val();
        var dt = $('.head-search-box .square-row select').val();
        var huong = $('.head-search-box .direct-row select').val();
        var matinh = $('.head-search-box .province-row select').val();
        var tentinh = locdau($(".head-search-box .province-row select option:selected").text());
        var mahuyen = $('.head-search-box .district-row select').val();
        var tenhuyen = locdau($(".head-search-box .district-row select option:selected").text());
        var maphuong = $('.head-search-box .ward-row select').val();
        var tenphuong = locdau($(".head-search-box .ward-row select option:selected").text());
        var maduong = $('.head-search-box .street-row select').val();
        var tenduong = locdau($(".head-search-box .street-row select option:selected").text());

        if (dt == 0 && gia == 0 && huong == 0)
            params = "";
        else
            params = "?dt=" + dt + "&gia=" + gia + "&huong=" + huong;

        if (loaibds == "nha") {
            url = "/" + loaitin + "-nha";
            if (maphuong != 0 || maduong != 0) {//có chọn đường hoặc phường
                if (maduong != 0) {//chọn đường
                    url += "-" + tenduong + "-" + tenhuyen + "-d" + maduong;
                } else {
                    url += "-" + tenphuong + "-" + tenhuyen + "-p" + maphuong;
                }
            } else {
                if (matinh != 0) {//có chọn tỉnh
                    if (mahuyen != 0) {//chọn huyện 
                        url += "-" + tenhuyen + "-" + tentinh + "-q" + mahuyen;
                    } else {
                        url += "-" + tentinh + "-t" + matinh;
                    }
                }
            }
            url = url + ".htm" + params;
        } else {
            url = "/nha-dat/" + loaitin + "/" + loaibds;
            if (maphuong != 0 || maduong != 0) {//có chọn đường hoặc phường
                if (maduong != 0) {//chọn đường
                    url += "/" + tenduong + "-" + tenhuyen + "-dp" + maduong;
                } else {
                    url += "/" + tenphuong + "-" + tenhuyen + "-px" + maphuong;
                }
            } else {
                if (matinh != 0) {//có chọn tỉnh
                    if (mahuyen != 0) {//chọn huyện 
                        url += "/" + tentinh + "/" + mahuyen + "/" + tenhuyen;
                    } else {
                        url += "/" + matinh + "/" + tentinh;
                    }
                }
            }
            url = url + ".html" + params;
        }
        window.parent.location = url;
    });
*/
    //PROJECT =====
    $("body").on('change', '.head-search-box .project-province-row select', function(e) {
        var provinceId = $(this).val();
        LoadProjectDictrict(provinceId);
    });    
});

function InitSearchBox() {
    var demandId = $('.hddSDemandId').val();
    var propertyTypeId = $('.hddSPropertyTypeId').val();
    var provinceId = $('.hddSProvinceId').val();
    var districtId = $('.hddSDistrictId').val();
    var wardId = $('.hddSWardId').val();
    var streetId = $('.hddSStreetId').val();
    var squareId = $('.hddSSquareId').val();
    var directId = $('.hddSDirectId').val();
    var priceId = $('.hddSPriceId').val();

    //demand
    if (demandId != null) {
        $('.head-search-box .demand-row select').val(demandId);
        LoadPrice();
    }
    if (propertyTypeId != null) {
        $('.head-search-box .property-type-row select').val(propertyTypeId);
    }
    if (provinceId != null) {
        $('.head-search-box .province-row select').val(provinceId);
        LoadDictrict(provinceId, districtId, wardId, streetId);
    }
//    if (districtId != null) {
//        LoadWardAndStreet(districtId, wardId, streetId);
//    }

    //Square
    if (squareId != null) {
        $('.head-search-box .square-row select').val(squareId);
    }

    //direct
    if (directId != null) {
        $('.head-search-box .direct-row select').val(directId);
    }
    //price
    if (priceId != null) {
        $('.head-search-box .price-row select').val(priceId);
    }
}

function LoadPrice() {
    var value = $('.head-search-box .demand-row select').val();
    if (value == 'can-ban' || value == 'can-mua') {
        $('.head-search-box .price-row select').html($(".hddsaleprice").html());
    } else {
    $('.head-search-box .price-row select').html($(".hddrentprice").html());
    }
}

function LoadDictrict(provinceId, districtId, wardId, streetId) {
    var url = "/handler/Handler.ashx?command=" + COMMAND_GET_DISTRICTS + "&matinh=" + provinceId;
    $.post(url, function(data) {
        $('.head-search-box .district-row select').html(data);
        if (districtId != null && districtId != 0) {
            $('.head-search-box .district-row select').val(districtId);
            LoadWardAndStreet(districtId, wardId, streetId);
        } else {

            $('.head-search-box .ward-row select').html("<option value='0'>------ Phường/Xã ------");
            $('.head-search-box .street-row select').html("<option value='0'>------ Đường/Phố ------");
        }
    });
}

function LoadWardAndStreet(districtId, wardId, streetId) {
    var url = "/handler/Handler.ashx?command=" + COMMAND_GET_WARDS + "&mahuyen=" + districtId;
    $.post(url, function(data) {
        if (data == "")
            return;
        $('.head-search-box .ward-row select').html(data);
        if (wardId != null && wardId != 0)
            $('.head-search-box .ward-row select').val(wardId);
    });

    url = "/handler/Handler.ashx?command=" + COMMAND_GET_STREETS + "&mahuyen=" + districtId;
    $.post(url, function(data) {
    if (data == "")
        return;
    $('.head-search-box .street-row select').html(data);
        if (streetId != null && streetId != 0)
            $('.head-search-box .street-row select').val(streetId);
    });
}
function Search_District_Click() {
    var numberOfItem = $('.head-search-box .district-row select option').length;
    var provinceId = $('.head-search-box .province-row select').val();
    if (provinceId != 0 && numberOfItem < 2) {
        LoadDictrict(provinceId);
    }
}
function ResertSearchForm() {
    $('.head-search-box .property-type-row select').val('nha-dat');
    $('.head-search-box .price-row select').val('0');
    $('.head-search-box .square-row select').val('0');
    $('.head-search-box .direct-row select').val('0');
    $('.head-search-box .province-row select').val('0');
    $('.head-search-box .district-row select').val('0');
    $('.head-search-box .ward-row select').val('0');
    $('.head-search-box .street-row select').val('0');
}
//PROJECT
$(document).ready(function() {
    $("body").on('click', '.head-search-box .btnProjectSearch', function(e) {
        var loaitin = $('.head-search-box .demand-row select').val();
        var loaibds = $('.head-search-box .property-type-row select').val();
        var gia = $('.head-search-box .price-row select').val();
        var dt = $('.head-search-box .square-row select').val();
        var huong = $('.head-search-box .direct-row select').val();
        var matinh = $('.head-search-box .province-row select').val();
        var tentinh = locdau($(".head-search-box .province-row select option:selected").text());
        var mahuyen = $('.head-search-box .district-row select').val();
        var tenhuyen = locdau($(".head-search-box .district-row select option:selected").text());
        var maphuong = $('.head-search-box .ward-row select').val();
        var tenphuong = locdau($(".head-search-box .ward-row select option:selected").text());
        var maduong = $('.head-search-box .street-row select').val();
        var tenduong = locdau($(".head-search-box .street-row select option:selected").text());

        var province = $('.head-search-box .project-province-row select').val();
        var district = $('.head-search-box .project-district-row select').val();
        var projectcategory = $('.head-search-box .project-category-row select').val();
        if (district == null)
            return;
        var provincename = $('.head-search-box .project-province-row select :selected').text();
        var districtname = $('.head-search-box .project-district-row select :selected').text();
        var projectcategoryname = $('.head-search-box .project-category-row :selected').text();
        provincename = locdau(provincename);
        districtname = locdau(districtname);
        projectcategoryname = locdau(projectcategoryname);
        var url = "";
        if (projectcategory == 0) {
            if (province == 0 && district == 0) {
                url = "/du-an-bat-dong-san";
            } else {
                if (district != 0)
                    url = "/du-an-bat-dong-san-" + districtname + "-d" + district;

                else
                    url = "/du-an-bat-dong-san-" + provincename + "-pv" + province;
            }
        } else {
            if (province == 0 && district == 0) {
                url = "/du-an-" + projectcategoryname + "-pc" + projectcategory;
            } else {
                if (district != 0)
                    url = "/du-an-" + projectcategoryname + "-" + districtname + "-pc" + projectcategory + "-d" + district;
                else
                    url = "/du-an-" + projectcategoryname + "-" + provincename + "-pc" + projectcategory + "-pv" + province;
            }

        }
        window.parent.location = url;
    });

    $("body").on('change', '.head-search-box .project-province-row select', function(e) {
        var provinceId = $(this).val();
        LoadProjectDictrict(provinceId);
    });
});

function InitSearchProjectBox() {
    var provinceId = $('.hddSPProvinceId').val();
    var districtId = $('.hddSPDistrictId').val();
    var projectCategoryId = $('.hddSPProjectCategoryId').val();

    if (projectCategoryId != null) {
        $('.head-search-box .project-category-row select').val(projectCategoryId);
    }
    if (provinceId != null) {
        $('.head-search-box .project-province-row select').val(provinceId);
        LoadProjectDictrict(provinceId, districtId);
    }
}

function Search_Project_District_Click() {
    var numberOfItem = $('.head-search-box .project-district-row select option').length;
    var provinceId = $('.head-search-box .project-province-row select').val();
    if (provinceId != 0 && numberOfItem < 2) {
        LoadProjectDictrict(provinceId);
    }
}

function LoadProjectDictrict(provinceId, districtId) {
    var url = "/handler/Handler.ashx?command=" + COMMAND_GET_DISTRICTS + "&matinh=" + provinceId;
    $.post(url, function(data) {
        $('.head-search-box .project-district-row select').html(data);
        if (districtId != null && districtId != 0)
            $('.head-search-box .project-district-row select').val(districtId);       
    });
}

function RePostionPropertyHistory() {
    if ($('.property-history .content').html() != "") {
        $('.property-history').css('left', "0px");
        $('#wrapper').css('padding-bottom', "28px");
    } else {
    $('#wrapper').css('padding-bottom', "0px");
    }
}

$(document).ready(function() {
    var pageId = 0;
    var provinceId = 0;
    if ($('.page-id').val() == null) {
        pageId = 0;
    } else {
        pageId = $('.page-id').val();
    }
    if ($('.province-id').val() == null)
        provinceId = 0;
    else
        provinceId = $('.province-id').val();

    var position = { 1: "top", 2: "bottom", 3: "left", 4: "right", 5: "center" };
    var url = "/handler/Handler.ashx?command=" + COMMAND_GET_BANNERS + "&pageId=" + pageId + "&provinceId=" + provinceId + "&version=2";
    $.post(url, function(data) {
        if (data == "")
            return;
        var items = jQuery.parseJSON(data);
        var data_length = items.length;
        for (var i = 0; i < data_length; i++) {
            var id = items[i]["Id"];
            var file = items[i]["FileUrl"];
            var width = items[i]["Width"];
            var height = items[i]["Height"];
            var type = items[i]["Type"]
            var pos = items[i]["Position"];
            var IsExistFile = items[i]["IsExistFile"];
            var WebsiteUrl = items[i]["WebsiteUrl"];
            if (IsExistFile == 0) {
                $('.banner-' + position[pos]).append('<div class="item"><div>File not found!</div><div class="over"></div></div>');
                continue;
            }
            if (WebsiteUrl == '#') {
                if (type == 1) {
                    $('.banner-' + position[pos]).append('<div class="item"><img src="' + file + '" width="' + width + '" height="' + height + '"></img><div class="over"></div><div class="close"></div></div>');
                } else {
                    if (type == 2) { //flash
                        $('.banner-' + position[pos]).append('<div class="item"><object><param name="wmode" value="transparent"><embed src="' + file + '" allowscriptaccess="always" wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=Shockwaveflash" type="application/x-shockwave-flash" width="' + width + '" height="' + height + '"></object><div class="over"></div><div class="close"></div></div>');
                    } else {
                        $('.banner-' + position[pos]).append('<div class="item"><iframe src="' + file + '" width="' + width + '" height="' + height + '" frameborder="0" scrolling="no" style="overflow:hidden"></iframe><div class="over"></div><div class="close"></div></div>');
                    }
                }
            } else {
                if (type == 1) {
                    $('.banner-' + position[pos]).append('<div class="item"><img src="' + file + '" width="' + width + '" height="' + height + '"></img><div class="over" onclick="ClickBanner(' + id + ')"></div><div class="close"></div></div>');
                } else {
                    if (type == 2) { //flash
                        $('.banner-' + position[pos]).append('<div class="item"><object><param name="wmode" value="transparent"><embed src="' + file + '" allowscriptaccess="always" wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=Shockwaveflash" type="application/x-shockwave-flash" width="' + width + '" height="' + height + '"></object><div class="over" onclick="ClickBanner(' + id + ')"></div><div class="close"></div></div>');
                    } else {
                        $('.banner-' + position[pos]).append('<div class="item"><iframe src="' + file + '" width="' + width + '" height="' + height + '" frameborder="0" scrolling="no" style="overflow:hidden"></iframe><div class="over" onclick="ClickBanner(' + id + ')"></div><div class="close"></div></div>');
                    }
                }
            }
        }
        if ($('.banner-bottom').html().length != 0)
            $('.footer').css('margin-bottom', '81px');
    });

    $("body").on('click', '.banner-top .close', function(e) {
        $(this).closest('.item').remove();
    });
    $("body").on('click', '.banner-bottom .close', function(e) {
        $(this).closest('.item').remove();
        $('.footer').css('margin-bottom', '0px');
    });
});
function ClickBanner(id) {
    var url = "/bannerclick.aspx?id=" + id;
    window.open(url, '_blank');
}
