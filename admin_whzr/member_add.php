<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('member'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
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
<script type="text/javascript">
var xmlHttp;

function xmlhttprequest(){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}
	else{
		alert('您的浏览器不支持Ajax技术！');
	}
}


//用户名检测
function CheckUser(){

   var Account=document.getElementById("Account").value;
   if( Account !=""){
   var ajax_url='ajax_do.php?Account='+Account+'&action=checkuser';
  // alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
     document.getElementById("usernote").innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
    }
	}


function cfm_reg()
{
	if($("#Account").val() == "")
	{
		alert("请输入账号！");
		$("#Account").focus();
		return false;
	}
    var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
    if (!myreg.test($("#Account").val())) {
         alert ("请输入正确的电话号码！");
        $("#Account").focus();
        return false;
            }
	if($("#Alias").val() == "")
	{
        alert ("请输入昵称！");
        $("#Alias").focus();
        return false;
    }
}

</script>
</head>
<body>
<div class="formHeader"> <span class="title">注册会员</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="member_save.php" onsubmit="return cfm_reg();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="25%" height="40" align="right">账　号：</td>
			<td width="75%"><input type="text" name="Account" id="Account" class="input" onblur="CheckUser();" />
				<span id="usernote"><span class="maroon">*</span><span class="cnote">带<span class="maroon">*</span>号表示为必填项</span> </span>
				（手机号码）</td>
		</tr>
		<tr>
		  <td height="40" align="right">手机号：</td>
		  <td><input name="Phone" type="text" readonly="readonly" class="input" id="Phone" value="999" />&nbsp;<span class="reok">后台添加账号标记</span></td>
	  </tr>
		<tr>
			<td height="40" align="right">昵　称：</td>
			<td><input type="text" name="Alias" id="Alias" class="input" /></td>
		</tr>
		<tr>
			<td height="40" align="right">头　像：</td>
			<td><input type="text" name="picurl" id="picurl" class="input" />
              <span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
              <input type="checkbox" name="rempic" id="rempic" value="true" />
远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span></span></td>
		</tr>
		<tr>
			<td height="40" align="right">酒钱数：</td>
			<td id="live"><input name="JiuQian" readonly="readonly" type="text" class="input" id="JiuQian" value="0" />
			  </td>
		</tr>
		<tr class="nb">
		  <td height="40" align="right">排列排序：</td>
		  <td><input type="text" name="orderid" id="orderid" class="inputos" value="<?php echo GetOrderID('memberuser'); ?>" /></td>
	  </tr>
		<tr class="nb">
			<td height="40" align="right">注册时间：</td>
			<td><input type="text" name="CreatTime" id="CreatTime" class="inputms" value="<?php echo GetDateTime(time()); ?>" readonly="readonly" />
				<script type="text/javascript" src="plugin/calendar/calendar.js"></script>
				<script type="text/javascript">
				Calendar.setup({
					inputField     :    "CreatTime",
					ifFormat       :    "%Y-%m-%d %H:%M:%S",
					showsTime      :    true,
					timeFormat     :    "24"
				});
				</script></td>
		</tr>
	</table>
	<div class="formSubBtn">
		<input type="submit" class="submit" value="提交" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="Id" id="Id" value="<?php echo rand(1000000000,9999999999);?>" />

  </div>
</form>
</body>
</html>
