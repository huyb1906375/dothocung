<!-- Searcg Widget -->
<div class="widget_search">
  <form name="frmSearch" method="post" action="<?php echo base_url();?>tim-kiem-tin.html" id="frmSearch" onsubmit="return checkValue();">
	<input type="text" id="txtTuKhoa" name="txtTuKhoa" class="form-control" autocomplete="off" placeholder="Từ khóa tìm kiếm"/>
	<input type="submit" id="btnSearch" name="btnSearch" class="search-btn" value=" "/>
  </form>
</div>
<!-- Categories Widget -->
<script type="text/javascript">
function checkValue()
{
	var tukhoa = $('#txtTuKhoa').val();
	if(tukhoa.length == 0)
	{
		alert("Bạn chưa nhập từ khóa!");
		return false;
	}
	return true;
}

</script>