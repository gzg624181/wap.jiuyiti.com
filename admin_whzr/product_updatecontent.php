<?php require_once(dirname(__FILE__).'/inc/config.inc.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品详情</title>
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
</head>
<body>
<?php
$row = $dosql->GetOne("SELECT * FROM `commodity` WHERE `Id`='$id'");
$rows = $dosql->GetOne("SELECT * FROM `commoditydetails` WHERE `id`='$id'");
?>
<div class="formHeader">商品详情<a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="product_save.php" onsubmit="return cfm_infolm();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="6%" height="40" align="right">商品名称：</td>
			<td width="94%"><?php echo $row['Title'];?></td>
		</tr>
		<tr>
			<td height="326" align="right">商品详情：</td>
			<td><textarea name="Details" id="Details" class="kindeditor"><?php  if(is_array($rows)){echo $rows['Details'];} ?></textarea>
				<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="Details"]', {
						allowFileManager : true,
						width:'1200px',
						height:'365px',
						extraFileUploadParams : {
							sessionid :  '<?php echo session_id(); ?>'
						}
					});
				});
				</script></td>
		</tr>
	</table>
	<div class="formSubBtn">
<input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="updatecontent" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
  </div>
</form>
</body>
</html>