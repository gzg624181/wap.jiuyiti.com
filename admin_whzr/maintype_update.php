<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('maintype'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改二级类别</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
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
$row = $dosql->GetOne("SELECT * FROM `#@__maintype` WHERE id=$id");
?>
<div class="formHeader"> <span class="title">修改二级类别</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="maintype_save.php" onsubmit="return cfm_btype();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="14%" height="40" align="right">所属类别：</td>
			<td colspan="2"><select name="parentid" id="parentid">
			  <option value="0">一级分类</option>
			  <?php GetAllType('#@__maintype','#@__maintype','parentid'); ?>
			  </select>
		    <span class="maroon">*</span><span class="cnote">带<span class="maroon">*</span>号表示为必填项</span></td>
		</tr>
		<tr>
			<td height="40" align="right">类别名称：</td>
			<td colspan="2"><input type="text" name="classname" id="classname" class="input" value="<?php echo $row['classname']; ?>" />
		    <span class="maroon">*</span></td>
		</tr>
        <tr>
		  <td height="40" align="right">略缩图片：</td>
		  <td width="4%" align="center" valign="middle"><img style="margin-top:2px; margin-left:2px;" src="../<?php if($row['picurl']==""){echo "templates/default/images/noimage.gif";}else{echo $row['picurl'];}?>" width="50" height="50" /></td>
		  <td width="82%"><input type="hidden" name="picurl" id="picurl" class="input" value="<?php echo $row['picurl'];?>" />
          <span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
				<input type="checkbox" name="rempic" id="rempic" value="true" />
				远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span> </span>
          </td>
	  </tr>
		<tr>
			<td height="40" align="right">排列顺序：</td>
			<td colspan="2"><input type="text" name="orderid" id="orderid" class="inputs" value="<?php echo $row['orderid']; ?>" /></td>
		</tr>
		<tr class="nb">
			<td height="40" align="right">隐藏类别：</td>
			<td colspan="2"><input type="radio" name="checkinfo" value="true" <?php if($row['checkinfo'] == 'true') echo 'checked="checked"'; ?> />
				显示&nbsp;
				<input type="radio" name="checkinfo" value="false" <?php if($row['checkinfo'] == 'false') echo 'checked="checked"'; ?> />
			隐藏</td>
		</tr>
	</table>
	<div class="formSubBtn">
		<input type="submit" class="submit" value="提交" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="repid" id="repid" value="<?php echo $row['parentid']; ?>" />
	</div>
</form>
</body>
</html>