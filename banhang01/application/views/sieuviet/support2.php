<style> 
.success.is-underline:hover, .success.is-outline:hover, .success { background-color: #0160a0 !important; } 
.call-mobile {background: #ED1C24;position: fixed;bottom: 10px;height: 36px;line-height: 36px; padding: 0 0px 0 0px;border-radius: 36px;color: #fff;left: 10px;z-index: 99999; font-size: 14px; } 
.call-mobile1 {position: fixed;bottom: 140px;height: 40px;line-height: 40px; padding: 0 0px 0 0px;border-radius: 40px;color: #fff;left: 10px;z-index: 99999; font-size: 14px; } 
.call-mobile2 {position: fixed;bottom: 136px;height: 40px;line-height: 40px; padding: 0 0px 0 0px;border-radius: 40px;color: #fff;left: 10px;z-index: 99999; font-size: 14px; } 
.call-mobile i {font-size: 20px;line-height: 40px;background: #B52026; border-radius: 100%;width: 40px;height: 40px; text-align: center; float: right; font-size: 14px; } 
.call-mobile a {color: #fff;font-size: 18px;font-weight: bold; text-decoration: none; margin-right: 10px; padding-left: 10px; font-size: 14px;} 

.hotline { position: fixed; left: 10px; bottom: 20px; z-index: 9000; display: block; background: #df043e; color: white; padding-top: 5px; padding-bottom: 5px; padding-left: 12px; padding-right: 12px; border-radius: 99px; font-size: 15px; } 
.hotline .hotline-number { font-size: 15px; color: #fff; font-weight: 700; } 
.ctrlq.fb-button { z-index: 999; background: url(https://thaibinhweb.net/wp-content/uploads/2018/06/201703271048061846_201703271042138304_Facebook-to-scrap-support-for-Messenger-on-Windows-Phone-8-and-8.1-at-the-end-of-March.jpg) center no-repeat #0084ff; width: 60px; height: 60px; text-align: center; bottom: 10px; border: 0; outline: 0; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; -ms-border-radius: 60px; -o-border-radius: 60px; box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16); -webkit-transition: box-shadow .2s ease; background-size: 80%; transition: all .2s ease-in-out; } 
.bubble { width: 20px; height: 20px; background: #c00; color: #fff; position: absolute; z-index: 999999999; text-align: center; vertical-align: middle; top: -2px; left: -5px; border-radius: 50%; } .ctrlq.fb-overlay { z-index: 0; position: fixed; height: 100vh; width: 100vw; -webkit-transition: opacity .4s, visibility .4s; transition: opacity .4s, visibility .4s; top: 0; left: 0; background: rgba(0, 0, 0, .05); display: none; } 
.fb-widget { background: #fff; z-index: 1000; position: fixed; width: 360px; height: 435px; overflow: hidden; opacity: 0; bottom: 0; right: 24px; border-radius: 6px; -o-border-radius: 6px; -webkit-border-radius: 6px; box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); } 
.bubble-msg { width: 120px; left: -140px; top: 5px; position: relative; background: rgba(59, 89, 152, .8); color: #fff; padding: 5px 8px; border-radius: 8px; text-align: center; font-size: 13px; } .ctrlq.fb-button, .ctrlq.fb-close { position: fixed; right: 24px; cursor: pointer; bottom: 20px; } 
.ctrlq.fb-button:focus, .ctrlq.fb-button:hover { transform: scale(1.1); box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24); } 
</style> 

<div class="call-mobile1"> 
<a data-animate="fadeInDown" rel="noopener noreferrer" href="http://zalo.me/<?php echo str_replace(" ","",chs_hotline);?>" target="_blank" class="button success" style="border-radius:99px;background: #0c8800 !important;" data-animated="true"> 
<span><img src="<?php echo base_url();?>public/site/img/hotline.png"> Chat Zalo </span>
</a>
</div> 

<!--
<div class="call-mobile2"> 
	<a data-animate="fadeInDown" rel="noopener noreferrer" href="<?php echo $chs_facebook;?>" target="_blank" class="button success" style="border-radius:99px;" data-animated="true"> 
	<span>Facebook</span></a> 
</div>
-->
<div class="hotlinefix"> 
<a href="tel:<?php echo str_replace(" ","",chs_dien_thoai);?>">
	<span class="phone"> 
		<p><?php echo str_replace(" ","",chs_dien_thoai);?></p> 
	</span>
	<div class="circle-hotline"> <span><img src="<?php echo base_url();?>public/site/img/hotline.png"></span> </div> 
</a>
</div> 

<style> 
.hotline-chat { position: fixed; bottom: -12px; right: -9px; z-index: 99; } 
.circle-hotline-chat { height: 30px; width: 30px; border-radius: 50%; background-color: #0080FF; -webkit-transition: height .25s ease, width .25s ease; transition: height .25s ease, width .25s ease; -webkit-transform: translate(-50%,-50%); transform: translate(-50%,-50%); box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); margin-top: 3px; margin-left: -3px; } 
.circle-hotline-chat span { margin: 12px; display: inline-block; } 
.circle-hotline-chat:before, .circle-hotline-chat:after { content:''; display:block; position:absolute; top:0; right:0; bottom:0; left:0; border-radius:50%; border: 1px solid #0080FF; } 
.circle-hotline-chat:before { -webkit-animation: ripple 2s linear infinite; animation: ripple 2s linear infinite; } 
.circle-hotline-chat:after { -webkit-animation: ripple 2s linear 1s infinite; animation: ripple 2s linear 1s infinite; } 
.circle-hotline-chat:hover:before, .circle-hotline-chat:hover:after { -webkit-animation: none; animation: none; } 
.circle-hotline-chat img { width: 50px; max-width: 100%; height: auto; } 
.hotline-chat .phone { font-size: 16px; font-weight: bold; background: #F00; color: white; padding: 1px 30px 1px 75px; border-radius: 39px; left: -25px; top: -25px; position: absolute; box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.4); line-height: 150%; } 


.hotlinefix .phone { font-size: 14px; font-weight: bold; background: #FFF; color: #F00; padding: 7px 30px 7px 75px; border-radius: 39px; left: -30px; top: -29px; position: absolute; box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.4);} 
.hotlinefix .phone p { line-height: 150%; margin-top: 6px; margin-bottom: 6px;  width: 160px; font-style: inherit; color: #F00; text-shadow: none; font-size: 24px; font-weight: bold; text-decoration: none;} 
.hotlinefix .phone p a{ font-style: inherit; color: #F00; text-shadow: none; font-size: 24px; font-weight: bold; text-decoration: none; }
.hotlinefix{ position: fixed; bottom: 6px; left: 42px; z-index: 99; line-height: 150%; } 
.circle-hotline { height: 50px; width: 50px; border-radius: 50%; background-color: #F00; -webkit-transition: height .25s ease, width .25s ease; transition: height .25s ease, width .25s ease; -webkit-transform: translate(-50%,-50%); transform: translate(-50%,-50%); box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); margin-top: 3px; margin-left: -3px; } .circle-hotline span { margin: 12px; display: inline-block; } 

.circle-hotline:before, .circle-hotline:after { content:''; display:block; position:absolute; top:0; right:0; bottom:0; left:0; border-radius:50%; border: 1px solid #F00; } 

.circle-hotline:before { -webkit-animation: ripple 2s linear infinite; animation: ripple 2s linear infinite; } 

.circle-hotline:after { -webkit-animation: ripple 2s linear 1s infinite; animation: ripple 2s linear 1s infinite; } 
.circle-hotline:hover:before, .circle-hotline:hover:after { -webkit-animation: none; animation: none; } 

@-webkit-keyframes ripple{ 0% {-webkit-transform:scale(1); } 
75% {-webkit-transform:scale(1.75); opacity:1;} 
100% {-webkit-transform:scale(2); opacity:0;} } 


@keyframes ripple{ 0% {transform:scale(1); } 75% {transform:scale(1.75); opacity:1;} 100% {transform:scale(2); opacity:0;} } 
.circle-hotline img { width: 50px; max-width: 100%; height: auto; } 



</style> 
