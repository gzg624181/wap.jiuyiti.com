<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家推荐排行榜</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">商家推荐排行榜：</span><span class="num" style="color:red;"><?php echo $Recommand;?></span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="15%" height="36" align="center">商户账号</td>
			<td width="21%" align="left">商户名称</td>
			<td width="16%" align="center">酒钱</td>
			<td width="15%" align="center">联系电话</td>
			<td width="19%" align="center">登陆设备</td>
		  <td width="14%" align="center">注册时间</td>
		</tr>
		<?php
		$one=1;
		$two=2;
		$dosql->ExecNoneQuery("truncate linshi_paihang"); 
		$dosql->Execute("select * from commercialuser where online=1",$one);
		while($show=$dosql->GetTotalRow($one)){
		$Recommand=$show['Recommand'];
		$dosql->Execute("SELECT * FROM `recommand` where tjm='$Recommand' and type=1",$two);	
		$num=$dosql->GetTotalRow($two);
		$sql = "INSERT INTO `linshi_paihang` (num, recommand) VALUES   ($num, '$Recommand')";
	    $dosql->ExecNoneQuery($sql);
		}
		
		$dopage->GetPage("SELECT * FROM `linshi_paihang` a inner join commercialuser b on a.recommand=b.Recommand order by a.num desc",6);
		while($row = $dosql->GetArray())
		{
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center"><?php echo $row['Commercial']; ?></td>
			<td align="center"><?php echo $row['CommercialName']; ?></td>
			<td align="center"><?php echo $row['JiuQian']; ?></td>
			<td align="center"><?php echo $row['Phone']; ?></td>
			<td align="center"><?php // echo $devicetype; ?></td>
			<td align="center"><span class="number"><?php // echo $row['rec_time']; ?></span>
            </td>
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
/*if($dosql->GetTotalRow() == 0){
	echo 0;
	}else{
foreach($numss as $val){
	$jiuqian_la += $val;	
}
echo $jiuqian_la;
	}
*/
 ?>
</a>元
</span>
</div>
</body>
</html>