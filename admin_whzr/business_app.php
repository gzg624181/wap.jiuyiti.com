<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安卓商户端版本更新</title>
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
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function cfm_sm(){
  if($("#appName").val()==""){
	  alert("版本名称不能为空");
	  $("#appName").focus();
	  return false;
	  }
    if($("#picurl").val()==""){
	  alert("上传版本不能为空");
	  $("#picurl").focus();
	  return false;
	  }
	}
layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
    photos: '#layer-photos-demo',
	//area:['500px','300px'],  //图片的宽度和高度
    shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
	closeBtn:1,
	offset:'100px',  //离上方的距离
	shadeClose:true
  });
});
function getlink(){
  var link = $("#picurl").val();
  var path = $("#path").val();
  var getlink=path+link;
  document.getElementById("lianjie").value = getlink;
}
</script>
<style>
.input {
    width: 296px;
}
.input1 {    width: 296px;
}
</style>
</head>
<body>
<div class="formHeader"> <span class="title">安卓商户端版本更新</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<?php
$r=$dosql->GetOne("select * from upapp where id=2");
?>
<form name="form" id="form" method="post" action="shuoming_save.php" onsubmit="return cfm_sm();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="7%" height="40" align="right">版本名称：</td>
			<td width="93%"><input type="text" name="appName" id="appName" value="<?php echo $r['appName'];?>" class="input"/></td>
		</tr>
		<tr>
		  <td height="40" align="right">上传版本：</td>
		  <td colspan="11" valign="middle">
            <input type="text" name="picurl" id="picurl" class="input" value="<?php echo $r['url'];?>" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','软件APK上传','soft','soft',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span></span>（上传格式apk）
          （添加二维码链接<a target="_blank" href="http://www.liantu.com/">http://www.liantu.com/</a>）</td>
    </tr>
          <tr>
            <td height="40" align="right">版本号：</td>
            <td><input type="text" name="version" id="version" value="<?php echo $r['version'];?>" class="input"/></td>
          </tr>
          <tr>
			<td width="7%" height="40" align="right">下载链接：</td>
			<td width="93%"><input onfocus="getlink();" style="width:390px;" type="text" name="lianjie" id="lianjie" value="<?php echo $r['lianjie'];?>" class="input"/></td>
	</tr>
      <tr>
          <td height="40" align="right" style="vertical-align:bottom;padding-bottom: 8px;">下载二维码：</td>
          <td><div id="layer-photos-demo" class="layer-photos-demo" style="margin-bottom:5px;">
     <img  width="305" height="305" style="cursor:pointer" layer-src="../<?php echo $r['picurl']; ?>"  src="../<?php echo $r['picurl']; ?>" />
       </div>
            <input name="picurl1" type="text" class="input" id="picurl1" value="<?php echo $r['picurl'];?>" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl1')">上 传</span></span></td>
    </tr>

  </table>
	<div class="formSubBtn" style="float:left; margin-left:115px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="business_update" />
    <input type="hidden" name="path" id="path" value="<?php echo $cfg_webpath;?>" />
  </div>

</form>
</body>
</html>
