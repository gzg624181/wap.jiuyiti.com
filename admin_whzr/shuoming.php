<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加商品</title>
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
	  alert("标题不能为空");
	  $("#title").focus();
	  return false; 
	  }	
    if($("#Details").val()==""){
	  alert("操作说明不能为空");
	  $("#Details").focus();
	  return false; 
	  }		
	}

</script>
</head>
<body>
<div class="formHeader"> <span class="title">操作说明</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<?php
$r=$dosql->GetOne("select * from shuoming where id=1");
?>
<form name="form" id="form" method="post" action="shuoming_save.php" onsubmit="return cfm_sm();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="7%" height="40" align="right">标题：</td>
			<td width="93%"><input type="text" name="title" id="title" value="<?php echo $r['title'];?>" class="input"/></td>
		</tr>
		<tr>
		  <td height="345" align="right">操作说明：</td>
		  <td><textarea name="Details" id="Details" class="kindeditor"><?php echo $r['content'];?></textarea>
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
				</script>			<div id="fenlei" style="font-size:12px; color:#ffa8a8;display:inline;"></div></td>
	  </tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:115px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
  </div>
  
</form>
</body>
</html>