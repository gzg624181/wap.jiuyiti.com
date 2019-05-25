<?php	require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>快递费用管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script>
function kdcost(id){
	//alert(id);
	var rulename=$("#rulename"+id).val();
	var rulemoney=$("#rulemoney"+id).val();
	var ajax_url='product_save.php?rulemoney='+rulemoney+'&rulename='+rulename+'&id='+id+'&action='+'kdcost';
	window.location.href=ajax_url;
	}
</script>
</head>
<body>
<div class="topToolbar"> <span class="title">活动规则管理</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="product_save.php?action=saverule">
	<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="dataTable">
		<tr align="left" class="head">
			<td width="3%" height="36" class="firstCol">&nbsp;</td>
			<td width="47%">快递省份</td>
			<td width="46%">快递费用(元)</td>
			<td width="4%" class="endCol">操作</td>
		</tr>
		<?php
		$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='area' AND level=0 ORDER BY orderid ASC, datavalue ASC");
		$num=$dosql->GetTotalRow();
		if($num > 0)
		{   
		    
			for($i=0;$i<$num;$i++)
			{
				$row=$dosql->GetArray();	
		?>
		<tr align="center" class="dataTr">
			<td height="36"><?php echo $i+1;?></td>
			<td><input type="text" name="rulename<?php echo $row['id'];?>" id="rulename<?php echo $row['id'];?>" class="inputd" style="width:80%; text-align:center" value="<?php echo $row['dataname']; ?>" /></td>
			<td><input type="text" name="rulemoney<?php echo $row['id'];?>" id="rulemoney<?php echo $row['id'];?>" class="inputd" style="width:80%;text-align:center;font-family: Verdana, Geneva, sans-serif;
font-weight: bold;" value="<?php echo $row['costmoney']; ?>" />			</td>
			<td class="action endCol"><a style="cursor:pointer; text-decoration:none;" onclick="return kdcost('<?php echo $row['id'];?>');">更新</a></td>
		</tr>
		<?php
			}
		}
		else
		{
		?>
		<tr align="center">
			<td colspan="4" class="dataEmpty">暂时没有相关的记录</td>
		</tr>
		<?php
		}
		?>
	</table>
</form>

<div class="page">
	<div class="pageText">共有<span><?php echo $num; ?></span>条记录</div>
</div>
</body>
</html>