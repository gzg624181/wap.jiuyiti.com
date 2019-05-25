<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动规则管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
</head>
<body>
<div class="topToolbar"> <span class="title">活动规则管理</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="active_save.php?action=saverule">
	<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="dataTable">
		<tr align="left" class="head">
			<td width="3%" height="36" class="firstCol"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);" /></td>
			<td width="17%">规则简介</td>
			<td width="17%">推荐起始人数</td>
			<td width="17%">推荐截止人数</td>
			<td width="17%" align="center">图标显示</td>
			<td width="17%" align="center">奖励金额</td>
			<td width="8%" align="center">排序</td>
			<td width="4%" class="endCol">操作</td>
		</tr>
		<?php
		$dosql->Execute("SELECT * FROM `#@__rule` where daima= 	$daima ORDER BY `orderid` ASC");
		if($dosql->GetTotalRow() > 0)
		{
			while($row = $dosql->GetArray())
			{
		?>
		<tr align="left" class="dataTr">
			<td height="36" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td><input type="text" name="rulename[]" id="rulename[]" class="inputd" style="width:80%; text-align:center" value="<?php echo $row['rulename']; ?>" />
			<input type="hidden" name="id[]" id="id[]" value="<?php echo $row['id']; ?>" /></td>
			<td><input type="text" name="rulefirst[]" id="rulefirst[]" class="inputd" style="width:80%;text-align:center" value="<?php echo $row['rulefirst']; ?>" /></td>
			<td><input type="text" name="ruleend[]" id="ruleend[]" class="inputd" style="width:80%;text-align:center" value="<?php echo $row['ruleend']; ?>" /></td>
			<td align="center"><input type="text" name="ruletubiao[]" id="ruletubiao[]" class="inputd" style="width:80%;text-align:center" value="<?php echo $row['ruletubiao']; ?>" /></td>
			<td align="center"><input type="text" name="rulemoney[]" id="rulemoney[]" class="inputd" style="width:80%;text-align:center" value="<?php echo $row['rulemoney']; ?>" /></td>
			<td align="center"><a href="rule_save.php?id=<?php echo $row['id']; ?>&orderid=<?php echo $row['orderid']; ?>&action=up" class="leftArrow" title="提升排序"></a>
				<input type="text" name="orderid[]" id="orderid[]" class="inputls" value="<?php echo $row['orderid']; ?>" />
				<a href="active_save.php?id=<?php echo $row['id']; ?>&orderid=<?php echo $row['orderid']; ?>&action=down" class="rightArrow" title="下降排序"></a></td>
					<input type="hidden" name="daima[]" id="daima[]" class="inputls" value="<?php echo $row['daima']; ?>" />
			<td class="action endCol"><a href="active_save.php?action=del5&id=<?php echo $row['id'] ?>&daima=<?php echo $row['daima'];?>" onclick="return ConfDel(0);">删除</a></td>
		</tr>
		<?php
			}
		}
		else
		{
		?>
		<tr align="center">
			<td colspan="8" class="dataEmpty">暂时没有相关的记录</td>
		</tr>
		<?php
		}
		?>
		<tr align="center">
			<td height="36" colspan="8"><strong>新增一个活动规则</strong></td>
		</tr>
		<tr align="left" class="dataTrOn">
			<td height="36">&nbsp;</td>
			<td><input type="text" name="rulenameadd" id="rulenameadd" class="input" style="width:80%" /></td>
			<td><input type="text" name="rulefirstadd" id="rulefirstadd" class="input" style="width:80%" /></td>
			<td><input type="text" name="ruleendadd" id="ruleendadd" class="input" style="width:80%" /></td>
			<td align="center"><input type="text" name="ruletubiaoadd" id="ruletubiaoadd" class="input" style="width:80%" /></td>
			<td align="center"><input type="text" name="rulemoneyadd" id="rulemoneyadd" class="input" style="width:80%" /></td>
			<td align="center"><input type="text" name="orderidadd" id="orderidadd" class="inputls" value="<?php echo GetOrderID('#@__rule'); ?>" /></td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<input type="hidden" name="daima" id="daima" class="inputls" value="<?php echo $daima; ?>" />

<div class="bottomToolbar">
	<span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('active_save.php');" onclick="return ConfDelAll(0);">删除</a>　
	<span>操作：</span><a href="javascript:UpOrderID('active_save.php');">更新排序</a></span>
	<a style="cursor:pointer" onclick="form.submit();" class="dataBtn">更新全部</a></div>
<div class="page">
	<div class="pageText">共有<span><?php echo $dosql->GetTableRow("#@__rule"); ?></span>条记录</div>
</div>
</form>
</body>
</html>
