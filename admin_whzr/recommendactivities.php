<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>推荐会员活动</title>
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
<script>
function cfm_sm(){
  if($("#title").val()==""){
	  alert("公告标题不能为空");
	  $("#title").focus();
	  return false; 
	  }	
    if($("#Details").val()==""){
	  alert("公告内容不能为空");
	  $("#Details").focus();
	  return false; 
	  }		
	}

</script>
</head>
<body>
<div class="formHeader"> <span class="title">活动说明</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<?php
$r=$dosql->GetOne("select * from shuoming where id=3");
?>
<form name="form" id="form" method="post" action="shuoming_save.php" onsubmit="return cfm_sm();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">活动标题：</td>
		  <td colspan="2"><input type="text" name="title" id="title" value="<?php echo $r['title'];?>" class="input"/></td>
    </tr>
		<tr>
		  <td height="40" align="right">商户端活动规则：</td>
		  <td><input type="text" name="picurl" readonly="readonly" id="picurl" class="input" value="<?php echo $r['picurl'];?>"  />
            <span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
            <input type="checkbox" name="rempic" id="rempic" value="true" />
远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span></span></td>
		  <td>
          <div id="layer-photos-demo" class="layer-photos-demo">
     <span style="text-align: left"></span><img  width="100" height="80" style="cursor:pointer" layer-src="../<?php echo $r['picurl']; ?>"  src="../<?php echo $r['picurl']; ?>" />
       </div>
          </td>
    </tr>
		<tr>
			<td width="8%" height="40" align="right">客户端活动规则：</td>
			<td width="28%"><input type="text" name="picurl1" id="picurl1" class="input" value="<?php echo $r['picurl1'];?>" />
			  <span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl1')">上 传</span> <span class="rePicTxt">
              <input type="checkbox" name="rempic" id="rempic" value="true" />
远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span></span></td>
			<td width="64%"><span class="cnote"><span class="rePicTxt">
          <div id="layer-photos-demo" class="layer-photos-demo">
     <img  width="100" height="80" style="cursor:pointer" layer-src="../<?php echo $r['picurl1']; ?>"  src="../<?php echo $r['picurl1']; ?>" />
       </div>
          </span></span></td>
		</tr>
		<tr>
		  <td height="345" align="right">服务条例：</td>
		  <td colspan="2"><textarea name="content" id="content" class="kindeditor"><?php echo $r['content'];?></textarea>
	      <script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="content"]', {
						allowFileManager : true,
						width:'1200px',
						height:'365px',
						extraFileUploadParams : {
							sessionid :  '<?php echo session_id(); ?>'
						}
					});
				});
				</script>			<div id="fenlei" style="font-size:12px; color:#ffa8a8;display:inline;"></div></td>
	  </tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:115px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update_recommendactivities" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
  </div>
  
</form>
</body>
</html>