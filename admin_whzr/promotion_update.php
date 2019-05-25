<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增活动</title>
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
<script type="text/javascript" src="templates/js/ajax.js"></script>
</head>
<body>
<?php
$row = $dosql->GetOne("SELECT * FROM `activitys` WHERE `id`='$id'");
?>
<div class="topToolbar"><span class="title">修改活动</span><a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="promotion_save.php">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="6%" height="119" align="right">活动图片：</td>
			<td colspan="5" valign="middle">
            <img src="../<?php echo $row['Image'];?>"  width="100px" />
            <input type="text" name="picurl" id="picurl" class="input" value="<?php echo $row['Image']; ?>"/>
		   <span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span></td>
	  </tr>
		<tr>
		  <td height="40" align="right">活动地址：</td>
		  <td><input type="text" name="Url" id="Url" class="input" value="<?php echo $row['Url']; ?>"/></td>
		  <td colspan="4" align="right">&nbsp;</td>
    </tr>
		<tr>
			<td height="40" align="right">排列排序：</td>
			<td width="17%"><input type="text" name="orderid" id="orderid" class="inputos" value="<?php echo $row['orderid']; ?>" /></td>
			<td colspan="4" align="right">&nbsp;</td>
		</tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:35px;">
<input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
  </div>
</form>
</body>
</html>