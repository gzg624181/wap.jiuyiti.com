<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现申请</title>
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

<script>
function tixian()
{
	if($("#RealName").val() == "")
	{
		alert("开户人不能为空！");
		$("#RealName").focus();
		return false;
	}
	if($("#BankName").val() == "")
	{
		alert("开户行不能为空！");
		$("#BankName").focus();
		return false;
	}
	if($("#BankNo").val() == "")
	{
		alert("银行卡号码不能为空！");
		$("#BankNo").focus();
		return false;
	}
	if($("#ApplyMonery").val() == "")
	{
		alert("提现金额不能为空！");
		$("#ApplyMonery").focus();
		return false;
	}
}
function je(){
	var je=document.getElementById("ApplyMonery").value;
	if(je%100!=0){
		alert("提现金额必须为100的整数！");
		return false;
		}
	}

</script>
</head>
<body>
<form name="form" id="form" method="post" action="tixian_save.php" onsubmit="return tixian();">
<?php
$r = $dosql->GetOne("SELECT * FROM `bank` WHERE Commercial='$username'");  //判断是否已经填写过账号
if(is_array($r)){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">开户人：</td>
		  <td width="81%"><input name="RealName" type="text" readonly="readonly" class="input" id="RealName" value="<?php echo $r['RealName'];?>" /></td>
    </tr>
	<tr>
			<td width="19%" height="40" align="right">银行名称：</td>
			<td><input name="BankName" type="text"  readonly="readonly" class="input" id="BankName" value="<?php echo $r['BankName'];?>" /></td>
	    </tr>
		<tr>
		  <td height="40" align="right">银行卡号：</td>
		  <td><input name="BankNo" type="text"  readonly="readonly" class="input" id="BankNo" value="<?php echo $r['BankNo'];?>"/></td>
  </tr>
		<tr>
			<td height="40" align="right">提现金额：</td>
			<td><input name="ApplyMonery" type="text" onBlur="je();" class="input" id="ApplyMonery"/></td>
		</tr>
      <input name="leibie" type="hidden" class="input" id="leibie" value="1"/>
  </table>
 <?php }else{?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">开户人：</td>
		  <td width="81%"><input name="RealName" type="text" class="input" id="RealName" /></td>
    </tr>
	<tr>
			<td width="19%" height="40" align="right">银行名称：</td>
			<td><input name="BankName" type="text" class="input" id="BankName" /></td>
	    </tr>
		<tr>
		  <td height="40" align="right">银行卡号：</td>
		  <td><input name="BankNo" type="text" class="input" id="BankNo"/></td>
  </tr>
		<tr>
			<td height="40" align="right">提现金额：</td>
			<td><input name="ApplyMonery" type="text" onBlur="je();" class="input" id="ApplyMonery"/></td>
		</tr>
         <input name="leibie" type="hidden" class="input" id="leibie" value="0"/>
  </table>
 <?php }?>
	<div class="formSubBtn" style="float:left; margin-left:95px;">
      <a style="cursor:pointer" onclick="return quan();"><input type="submit" class="submit" value="提交" /></a>
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="RealName" id="RealName" value="<?php echo $nickname;?>" />
        <input type="hidden" name="Commercial" id="Commercial" value="<?php echo $username;?>" />
        <input type="hidden" name="ApplyTime" id="ApplyTime" value="<?php echo date("Y-m-d h:i:s");?>" />
  </div>
 </form>
</body>
</html>