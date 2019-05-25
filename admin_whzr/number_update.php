<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改购物券金额</title>
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
<?php
$row = $dosql->GetOne("SELECT * FROM `money` WHERE id=$id");
?>
<form name="form" id="form" method="post" action="number_save.php" onsubmit="return quan();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">金额：</td>
		  <td><input type="text" name="money" id="money" class="input" value="<?php echo $row['number'];?>"/></td>
    </tr>
		<tr>
			<td width="9%" height="40" align="right">消费额度：</td>
			<td><input type="text" name="fanwei" readonly="readonly" id="fanwei" class="input" value="<?php echo $row['fanwei'];?>"/></td>
		</tr>
        	<tr>
        	  <td height="40" align="right">备注：</td>
        	  <td> 0 - 100    10元<br /></td>
      	  </tr>
        	<tr>
        	  <td height="40" align="right">&nbsp;</td>
        	  <td> 100-200  15元</td>
      	  </tr>
        	<tr>
        	  <td height="40" align="right">&nbsp;</td>
        	  <td>200-300  23元</td>
      	  </tr>
        	<tr>
        	  <td height="40" align="right">&nbsp;</td>
        	  <td>300-500  38元</td>
      	  </tr>
        	<tr>
        	  <td height="40" align="right">&nbsp;</td>
        	  <td>500-800  50元</td>
      	  </tr>
        	<tr>
        	  <td height="40" align="right">&nbsp;</td>
        	  <td>800-1200 100元</td>
      	  </tr>
        	<tr>
			<td width="9%" height="40" align="right">&nbsp;</td>
			<td>1200- 以上 200元</td>
		</tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:95px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
        <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" />
  </div>
</form>
</body>
</html>