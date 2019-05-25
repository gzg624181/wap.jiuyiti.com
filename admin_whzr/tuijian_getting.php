<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家推荐购买记录</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">商家推荐码：</span><span class="num" style="color:red;"><?php echo $Recommand;?></span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="10%" height="36" align="center">会员账号</td>
			<td width="19%" align="left">昵称</td>
			<td width="12%" align="center">购买金额</td>
			<td width="12%" align="center">提现比率</td>
			<td width="22%" align="center">提现金额</td>
			<td width="17%" align="center">购买时间</td>
		  <td width="8%" align="center">操作</td>
		</tr>
		<?php
		$jiuqian_la=0;
		$numss=array();
		$dopage->GetPage("SELECT a.*,b.Alias FROM `recommandlist` a inner join memberuser b on a.account=b.Phone where a.tjm='$Recommand' and a.type=1",10);	
		while($row = $dosql->GetArray())
		{
		
		$numss[]=$row['sum_money'];	
		
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center"><?php echo $row['account']; ?></td>
			<td align="center"><?php echo $row['Alias']; ?></td>
			<td align="center"><?php echo $row['money']; ?></td>
			<td align="center"><?php echo $row['bilv']; ?></td>
			<td align="center" class="num"><?php echo $row['sum_money']; ?></td>
			<td align="center"><span class="number"><?php echo $row['posttime']; ?></span></td>
			<td align="center"><a  title="删除" href="business_save.php?action=sjtj_del&id=<?php echo $row['id']; ?>&Recommand=<?php echo $Recommand;?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
		</tr>
		<?php
		}
		?>
	</table>
</form>
<?php
if($dosql->GetTotalRow() != 0){ ?>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php }?>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="bottomToolbar"> 
<span style="text-align:right; display:block">
推荐会员消费提现酒钱：<a class="num" style="color:red;">
<?php
if($dosql->GetTotalRow() == 0){
	echo 0;
	}else{
foreach($numss as $val){
	$jiuqian_la += $val;	
}
echo $jiuqian_la;
	}

 ?>
</a>元
</span>
</div>
</body>
</html>