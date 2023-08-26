

<div class="hotline-btn">
    <a id="phonenumber" href="tel:<?php echo str_replace(" ","",chs_dien_thoai);?>"><?php echo str_replace(" ","",chs_dien_thoai);?>
		<div id="phone">
            <span></span>
        </div>
	</a>
</div>

<div class="sitechatzalo" id="zalo">
    <a id="zalonum" href="https://zalo.me/<?php echo str_replace(" ","",chs_zalo);?>" target="_blank"><span class="iczalo">&nbsp;</span> Chat Zalo</a>
</div>
<style> 
.hotline-btn a
{
	text-decoration:none;
	z-index:1010;
	line-height:37px;
	color:#fff;
	font-weight:700;
	font-size:21px;
	position:fixed;
	bottom:20px;
	left:9px;
	padding:0 10px 0 37px;
	height:36px;
	background:#f6642f;
	-webkit-box-shadow:0 4px 5px -1px rgba(0,0,0,.5);
	box-shadow:0 4px 5px -1px rgba(0,0,0,.5);border-radius:50px
}
.hotline-btn #phone{position:absolute;top:7px;left:0}
.hotline-btn #phone span
{
	display:inline-block;
	width:36px;height:36px;
	background:url(/public/img/phone2.png) no-repeat top;
	-webkit-animation:Rotate 1.3s linear 1.3s 5;
	animation:Rotate 1.3s linear 1.3s 5;
	animation-iteration-count:infinite;
	-webkit-animation-iteration-count:infinite;
	-moz-animation-iteration-count:infinite;-o-animation-iteration-count:infinite
}
.hotline-btn #phone+div
{
	border:1px solid #fff;
	width:34px;height:34px;
	position:absolute;
	border-radius:50px;left:0;top:0
}
@-webkit-keyframes Rotate{0%{-webkit-transform:rotate(0);transform:rotate(0)}4%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}8%{-webkit-transform:rotate(0);transform:rotate(0)}12%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}16%{-webkit-transform:rotate(0);transform:rotate(0)}20%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}24%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(0);transform:rotate(0)}}@keyframes Rotate{0%{-webkit-transform:rotate(0);transform:rotate(0)}4%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}8%{-webkit-transform:rotate(0);transform:rotate(0)}12%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}16%{-webkit-transform:rotate(0);transform:rotate(0)}20%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}24%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(0);transform:rotate(0)}}
.sitechatzalo .iczalo
{
	
	width:39px;
	height:39px;
	background:url(/public/img/iczalo.png) center no-repeat #0072b2;
	position:absolute;
	top:-1px;
	left:0;
	border-radius:50%;
	-webkit-animation:Rotate 1.3s linear 1.3s 5;
	animation:Rotate 1.3s linear 1.3s 5;
	animation-iteration-count:infinite;
	-webkit-animation-iteration-count:infinite;
	-moz-animation-iteration-count:infinite;-o-animation-iteration-count:infinite
}
.sitechatzalo
{
	position:fixed;
	left:10px;
	bottom:70px;
	z-index:1010;
	box-shadow:0 4px 5px -1px rgba(0,0,0,.5);
	background:#2196f3;
	border-radius:50px;
	color:#000;
	height:37px;
	line-height:37px;
	padding:0 20px 0 46px;
	font-size:20px;font-weight:700
}
.sitechatzalo>a{color:#fff!important}#banner1,#banner2{z-index:0}



</style> 
