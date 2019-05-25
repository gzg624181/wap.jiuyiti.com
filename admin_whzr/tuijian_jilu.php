<?php require_once(dirname(__FILE__).'/inc/config.product.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家推荐奖励记录</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
//初始化参数
$Commercial = isset($Commercial) ? $Commercial : '';
$adminlevel=$_SESSION['adminlevel'];
?>
<div class="topToolbar"> <span class="title">商家推荐码：</span><span class="num" style="color:red;"><?php echo $Recommand;?></span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="6%" height="36" align="center">商户账号</td>
			<td width="14%" align="left">商户名称</td>
			<td width="7%" align="center">推荐码</td>
			<td width="12%" align="center">联系人</td>
			<td width="12%" align="center">联系电话</td>
			<td width="9%" align="center">推荐人数</td>
			<td width="8%" align="center">奖励金额</td>
			<td width="11%" align="center">推荐日期</td>
			<td width="15%" align="center">添加时间</td>
            <?php
			if($adminlevel==1){
				?>
		  <td width="6%" align="center">操作</td>
          <?php }?>
		</tr>
		<?php
		$one=1;
		$number=array();
		$dosql->Execute("SELECT SUM( money ) as m FROM `pmw_reward` WHERE tjm = '$Recommand'",$one);
		$rowss = $dosql->GetArray($one);
		if(is_array($rowss)){
		$money=$rowss['m'];
		}else{
		$money=0;	
			}
		$dopage->GetPage("SELECT * FROM `pmw_reward` a inner join commercialuser b on a.tjm=b.Recommand where a.tjm='$Recommand'",10);	
		while($row = $dosql->GetArray())
		{
		?>
		<tr align="left" class="dataTr">
			<td height="50" align="center"><?php echo $row['Commercial']; ?></td>
			<td align="center"><?php echo $row['CommercialName']; ?></td>
			<td align="center"><?php echo $row['tjm']; ?></td>
			<td align="center"><?php echo $row['Linkman']; ?></td>
			<td align="center"><?php echo $row['Phone']; ?></td>
			<td align="center"><?php echo $row['num']; ?></td>
			<td align="center"><?php echo $row['money']; ?></td>
			<td align="center"><?php echo $row['year']; ?>-<?php echo $row['month']; ?></td>
			<td align="center"><span class="number"><?php echo $row['gettime']; ?></span></td>
            <?php
			if($adminlevel==1){
				?>
			<td align="center"><a  title="删除" href="member_save.php?action=tjjl_del&id=<?php echo $row['id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            <?php }?>
		</tr>
		<?php
		}
		?>
	</table>
</form>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="bottomToolbar"> 
<span style="text-align:right; display:block">
商家合计获取的酒钱：<a class="num" style="color:red;"><?php echo $money;
	?></a>元
</span>
</div>

</body>
</html>