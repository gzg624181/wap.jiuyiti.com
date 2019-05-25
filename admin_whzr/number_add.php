<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增购物券金额</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/getuploadify.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
<script type="text/javascript" src="templates/js/getjcrop.js"></script>
<script type="text/javascript" src="templates/js/getinfosrc.js"></script>
<script type="text/javascript" src="plugin/colorpicker/colorpicker.js"></script>
<script type="text/javascript" src="plugin/calendar/calendar.js"></script>
<script type="text/javascript" src="editor/kindeditor-min.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>

<script>
function quan()
{
	
	if($("#money").val() == "")
	{
		alert("购物券金额不能为空！");
		$("#money").focus();
		return false;
	}
}

</script>
</head>
<body>
<div class="formHeader"> <span class="title">新增购物券金额</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="number_save.php" onsubmit="return quan();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="9%" height="40" align="right">金额：</td>
			<td><input type="text" name="money" id="money" class="input"/></td>
		</tr>
        	<tr>
        	  <td height="40" align="right">消费额度：</td>
        	  <td><input type="text" name="fanwei" id="fanwei" class="input"/></td>
      	  </tr>
        	<tr>
        	  <td height="40" align="right">备注：</td>
        	  <td><br /></td>
      	  </tr>
           <?php
		$dosql->Execute("SELECT * FROM money");
		while($row = $dosql->GetArray())
		{
		?>
        	<tr>
        	  <td height="40" align="right">&nbsp;</td>
        	  <td> <?php echo $row['fanwei'];?> &nbsp;&nbsp;&nbsp; <?php echo $row['number'];?>元</td>
      	  </tr>
         <?php }?>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:95px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="creatime" id="creatime" value="<?php echo date("Y-m-d");?>" />
  </div>
</form>
</body>
</html>