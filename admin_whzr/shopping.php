<?php require_once(dirname(__FILE__).'/inc/config.pay.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员购买记录</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">会员购买记录：</span><a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="11%" height="36" align="center">订单号</td>
			<td width="17%" align="left">提取码</td>
			<td width="20%" align="center">合计金额</td>
			<td width="15%" align="center">订单类型</td>
			<td width="18%" align="center">订单状态</td>
		  <td width="19%" align="center">下单时间</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `orderform` where UserId='$Account'",6);	
		while($row = $dosql->GetArray())
		{
			if($row['dingdantype']==1 && $row['PaymentType']!=4){
	            $xingzhi="<font color='#1f6f29'><b>"."预约订单"."</B></font>";    
		}elseif($row['PaymentType']==4){
				$xingzhi="";
		}elseif($row['dingdantype']==0 && $row['PaymentType']!=4){
				$xingzhi="<font color='#96C'><b>"."自提订单"."</B></font>";    
			   }
		//state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
			switch($row['State'])
			{
				case 1:
				$State="<font color='#4bb1cf'><B>".'待提取'."</b></font>";
				break;
				
				case 2;
				$State="<font color='#6699FF'><B>".'返利单'."</b></font>";
				break;
	        
				case 3;
				$State="换购单";
				break;
				
				case 4;
				$State="已失效";
				break;
				
				case 5;
				$State="<font color='#FF0000'><B>".'待付款'."</b></font>";
				break;
				
				case 6;
				$State="待评价";
				$break;
				
				case 7;
				$State="已提取";
				break;
				
				case 8;
				$State="<font color='#36F'><B>".'已提取'."</b></font>";
				break;
			}
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center"><?php echo $row['OrderId']; ?></td>
			<td align="center"><?php echo $row['tiquma'];?></td>
			<td align="center"><?php if($row['PayAmount']!="" && $row['PayJiuQian']!="")echo $row['PayAmount']+$row['PayJiuQian']; ?></td>
			<td align="center"><?php echo $xingzhi; ?></td>
			<td align="center" class="num"><?php echo $State; ?></td>
			<td align="center"><span class="number"><?php echo $row['CreatTime']; ?></span>
            </td>
		</tr>
		<?php
		}
		?>
	</table>
</form>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
</body>
</html>