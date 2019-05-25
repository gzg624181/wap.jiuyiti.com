<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告显示</title>
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
<script type="text/javascript" src="layer/layer.js"></script>

<script>
function gds()
{
	if($("#picurl").val() == "")
	{
		alert("上传图片不能为空！");
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
</script>
</head>
<body>
<div class="formHeader"> <span class="title">添加广告图片</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<?php
$r=$dosql->GetOne("select * from gd where id=1");
?>
<form name="form" id="form" method="post" action="shuoming_save.php" onsubmit="return gds();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="9%" height="40" align="right" style="vertical-align:bottom;padding-bottom: 8px;">广告图片：</td>
			<td valign="middle">
            <div id="layer-photos-demo" class="layer-photos-demo">
     <img  width="440" height="225" style="cursor:pointer" layer-src="../<?php echo $r['picurl']; ?>"  src="../<?php echo $r['picurl']; ?>" />
       </div>
            <input type="text" name="picurl" id="picurl" class="input" value="<?php echo $r['picurl'];?>" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span></span>
           </td>
	  </tr>

		<tr>
			<td height="96" align="right" style="text-align: right">显示截止时间：</td>
			<td> <input type="text" name="jztime" id="jztime" class="inputms" value="<?php echo $r['jztime']; ?>" readonly="readonly" />
		  <script type="text/javascript">
				Calendar.setup({
					inputField     :    "jztime",
					ifFormat       :    "%Y-%m-%d %H:%M:%S",
					showsTime      :    true,
					timeFormat     :    "24"
				});
				</script></td>
		</tr>
      		<tr>
		  <td height="40" align="right" style="text-align: right">是否显示：</td>
		  <td><label>
		    <input type="radio" name="play" value="1" <?php if($r['play'] == '1') echo 'checked="checked"'; ?> id="play"/>
		    是</label>
&nbsp;&nbsp;
<label>
  <input name="play" type="radio" id="play" value="0" <?php if($r['play'] == '0') echo 'checked="checked"'; ?>  />
  否</label>
&nbsp;&nbsp;
		    
	      （首页广告弹窗显示）</td>
    </tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:95px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="gd_update" />
  </div>
</form>
</body>
</html>