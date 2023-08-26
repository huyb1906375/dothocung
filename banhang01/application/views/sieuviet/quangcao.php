<!--
<div id="divAdLeft" style="top: 0px; position: fixed; right: 50%; margin-right: 487px;">
<a rel="nofollow" href="http://keonhacai.com/img/lucky88" target="_blank">
<img alt="Lucky888" src="http://www.gmodules.com/gadgets/proxy?container=ig&amp;url=https://i.imgur.com/IZW0oFg.gif"  style="width: 120px; height: 280px;">
</a>
<br>
<a rel="nofollow" href="http://keonhacai.com/img/sobet" title="sbobet" target="_blank"><img src="http://www.gmodules.com/gadgets/proxy?container=ig&amp;url=http://i.imgur.com/yQ30oOS.gif" alt="sbobet" style="width: 120px; height: 280px;"></a>
</div>

<div id="divAdRight" style="position: fixed; top: 0px; left: 49.3%; margin-left: 487px; bottom: 0px;">
<a rel="dofollow" href="http://keonhacai.com/img/188" target="_blank">
<img src="http://sbbanner.com/newmedia/vi/promo/viSbnG_120x300.gif" alt="188BET, cá độ bóng đá, nhà cái uy tín"  style="width: 120px; height: 280px;">
</a>
<br>
<a rel="nofollow" href="http://keonhacai.com/img/fun88" target="_blank">
<img alt="i668" src="http://www.gmodules.com/gadgets/proxy?container=ig&amp;url=https://i.imgur.com/PbwmLHX.gif"  style="width: 120px; height: 280px;">
</a>

</div>
-->
<?php 
$lk_list = $this->lienket_model->lay_danh_sach_lien_ket_gioi_han("noibat", "left", 2,0);
if(count($lk_list) > 0)
{
?>
<div id="divAdLeft" style=" position: fixed;bottom: 0px; right: 50%; margin-right: 570px; z-index:9999;">
<?php 
foreach($lk_list as $lk)
{
?>  
<a href="<?php echo $lk["lk_link"];?>"  target="<?php echo $lk["lk_loai_link"];?>">
<img border="0" src="/uploads/lienket/<?php echo $lk["lk_hinh"];?>" style="width:130px; height: 460px;"/>
</a>
<br>
<?php
}
?>  
</div> 
<?php
}
$lk_list = $this->lienket_model->lay_danh_sach_lien_ket_gioi_han("noibat", "right", 2,0);
if(count($lk_list) > 0)
{
?> 
<div id="divAdRight" style="position: fixed; bottom: 0px; left: 50%; margin-left: 570px; z-index:9999;">
<?php 

$i = 1;
foreach($lk_list as $lk)
{
?>     
<a href="<?php echo $lk["lk_link"];?>"  target="<?php echo $lk["lk_loai_link"];?>">
<img border="0" src="/uploads/lienket/<?php echo $lk["lk_hinh"];?>" style="width:130px; height: 460px;"/>
</a>
<br>
<?php
}
?>  
</div> 
<?php
}
?>      
