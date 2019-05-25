<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发送消息</title>
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
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function messageid()
{
  layer.open({
  type: 2,
  title: '选择会员接收人',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '500px'],
  content: 'selectmember.php'
  });

}
function shanghu()
{
  layer.open({
  type: 2,
  title: '选择商户接收人',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '500px'],
  content: 'shanghu.php'
  });

}
//验证列表信息用
function m()
{
	if($("#Account").val() == "")
	{
		alert("请填写消息接收人！");
		$("#Account").focus();
		return false;
	}
	if($("#Title").val() == "")
	{
		alert("请填写消息标题！");
		$("#Title").focus();
		return false;
	}
	if($("#Message").val() == "")
	{
		alert("请填写消息内容！");
		$("#Message").focus();
		return false;
	}
}
</script>
</head>
<body>
<div class="formHeader"><span class="title">发送消息</span>
 <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="getui.php" onsubmit="return m();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td width="8%" height="40" align="right">消息接收人：</td>
		  <td width="18%"><input style="width:750px;" type="text" name="Account" id="Account" class="input"/></td>
		  <td width="3%"><div class="formSubBtn" style="float:left; margin-top:2px;">
     <input style="border-radius: 2px; width:120px;" onclick="messageid();" type="button" class="submit" id="submit" value="选择会员接收人" />
           </div></td>
		  <td width="58%" align="left"><div class="formSubBtn" style="float:left; margin-top:2px;">
     <input style="border-radius: 2px; width:120px; background:#509ee1;" onclick="shanghu();" type="button" class="submit" id="submit" value="选择商户接收人" />
           </div></td>
		  <td width="58%" align="left">	
          
            </td>
    </tr>
		<tr>
		  <td height="40" align="right">消息标题：</td>
		  <td colspan="4"><input style="width:750px;" type="text" name="Title" id="Title" class="input"/></td>
    </tr>
		<tr>
		  <td height="40" align="right">消息内容：</td>
		  <td colspan="21"><textarea style="height:100px;width:750px;" name="Message" id="Message" class="input"></textarea></td>
    </tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:127px;">
<input type="submit" class="submit" value="确认发送" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="MessageId" id="MessageId" value="<?php echo getrandomstring(20);?>" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
  </div>
</form>
</body>
</html>