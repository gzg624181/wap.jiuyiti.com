<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现申请确认</title>
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

</head>
<body>
<?php
$r = $dosql->GetOne("SELECT * FROM `pickupmoney` WHERE ApplyTime='$applytime' and RealName='$nickname'");  //判断是否已经填写过账号
if(is_array($r)){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="38" align="right">开户人：</td>
		  <td width="81%"><?php echo $r['RealName'];?></td>
    </tr>
	<tr>
			<td width="19%" height="38" align="right">银行名称：</td>
			<td><?php echo $r['BankName'];?></td>
	    </tr>
		<tr>
		  <td height="38" align="right">银行卡号：</td>
		  <td><?php echo $r['BankNo'];?></td>
  </tr>
		<tr>
		  <td height="38" align="right">申请时间：</td>
		  <td><?php echo $r['ApplyTime'];?></td>
    </tr>
		<tr>
			<td height="38" align="right">提现金额：</td>
			<td class="num"><font color="red"><?php echo $r['ApplyMonery'];?>元</font></td>
		</tr>
  </table>
 <?php }?>
</body>
</html>