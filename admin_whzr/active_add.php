<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加活动</title>
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
<script type="text/javascript" src="templates/js/getarea.js"></script>
</head>
<body>
<div class="formHeader"> <span class="title">添加活动</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="active_save.php" onsubmit="return cfm_activelist();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="7%" height="40" align="right">活动标题：</td>
			<td colspan="10"><input type="text" name="title" id="title" class="input"/></td>
		</tr>
		<tr>
		  <td height="40" align="right">活动起始时间：</td>
		  <td colspan="10"><input type="text" name="firsttime" id="firsttime" class="input"/>
		    (如：2017-01-01)</td>
    </tr>
		<tr>
		  <td height="40" align="right">活动截止时间：</td>
		  <td colspan="10"><input type="text" name="endtime" id="endtime" class="input"/>
(如：2017-01-01)</td>
    </tr>
		<tr>
			<td height="40" align="right">活动代码：</td>
			<td colspan="10"><input type="text" name="daima" id="daima" class="input"/></td>
		</tr>
        <tr>
		  <td height="64" align="right">活动简介：</td>
		  <td colspan="10"><textarea style="width: 64.2%; height: 50px;" type="text" name="introduction" id="introduction" class="input"/></textarea></td>
    </tr>
    <tr>
		  <td height="64" align="right">活动协议：</td>
			<td colspan="10" style="padding:5px;"><textarea name="xieyi" id="xieyi" class="kindeditor"></textarea>
				<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="xieyi"]', {
						allowFileManager : true,
						width:'985px',
						height:'365px',
						extraFileUploadParams : {
							sessionid :  '<?php echo session_id(); ?>'
						}
					});
				});
				</script>			<div id="fenlei" style="font-size:12px; color:#ffa8a8;display:inline;"></div></td>
    </tr>
		<tr>
		  <td height="345" align="right">活动内容：</td>
		  <td colspan="10" style="padding:5px;"><textarea name="content" id="content" class="kindeditor"></textarea>
				<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="content"]', {
						allowFileManager : true,
						width:'985px',
						height:'365px',
						extraFileUploadParams : {
							sessionid :  '<?php echo session_id(); ?>'
						}
					});
				});
				</script>			<div id="fenlei" style="font-size:12px; color:#ffa8a8;display:inline;"></div></td>
	  </tr>

    <tr>
          <td height="40" align="right">是否显示：</td>
          <td><label>
		      <input type="radio" name="play" value="1" id="play" checked="checked" />
		      是</label>
          &nbsp;&nbsp;
		    <label>
		      <input name="play" type="radio" id="play" value="0"  />
		      否</label>
           &nbsp;&nbsp;

		    （是否显示活动）</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td id="hot">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td id="leixing">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td  id="countrys">&nbsp;</td>
    </tr>
    <tr>
          <td height="40" align="right">排列排序：</td>
          <td width="18%"><input type="text" name="orderid" id="orderid" class="inputos" value="<?php echo GetOrderID('pmw_activelist'); ?>" /></td>
          <td width="7%">&nbsp;</td>
          <td width="5%" align="right">&nbsp;</td>
          <td width="6%">&nbsp;</td>
          <td width="4%" align="right">&nbsp;</td>
          <td width="6%" id="hot5">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td id="leixing5">&nbsp;</td>
          <td width="4%" align="right">&nbsp;</td>
          <td width="6%"  id="countrys5">&nbsp;</td>
    </tr>
    <tr>
      <td height="40" align="right">&nbsp;</td>
      <td><div class="formSubBtn" style="float:left; margin-left:1px; margin-bottom:20px;">
        <input type="submit" class="submit" value="保存" />
        <input type="button" class="back" value="返回" onclick="history.go(-1);" />
        <input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="posttime" id="posttime" value="<?php echo date("Y-m-d h:i:s");?>" />
      </div></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td id="hot6">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td id="leixing6">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td  id="countrys6">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
