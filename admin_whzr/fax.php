<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家发货记录</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>

</head>
<body>
<?php
//初始化参数
$commercial  = isset($Commercial)  ? $Commercial  : '';
$name  = isset($CommercialName)  ? $CommercialName  : '';
?>
<div class="topToolbar" style="text-align:center"> 
<span class="title"  style="text-align:left;">商家发货记录</span>
<a href="javascript:location.reload();" class="reload">刷新</a><font size="+1" style="margin-left:-200px;"><B><?php echo $name;?></B></font>
</div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
		  <td height="35" colspan="4" align="center">订单号</td>
		  <td width="11%" align="center">商家获取的酒钱</td>
		  <td width="16%" align="center" class="count">提货时间</td>
			<td width="4%" align="center" class="count">操作</td>
		</tr>
		<?php
	    $dopage->GetPage("SELECT * FROM `pickuplist` WHERE Commercial='$commercial'");
		for($i=0;$i<$dosql->GetTotalRow();$i++){
		$show=$dosql->GetArray();
		?>
		<tr align="left" class="dataTr" style="background-color:#ebebeb;">
		  <td height="35" colspan="4" align="left" style="padding: 5px; text-align: center;"><?php  echo $show['orderId']; ?></td>
		  <td align="center" style="font-weight:bold;" class="num"><?php  echo $show['jiuQian']; ?></td>
		  <td align="center"><?php echo $show['pickUpTime']; ?></td>
		  <td align="center"><div id="jsddm"><a href="business_save.php?action=fax_del&id=<?php echo $show['id']; ?>" onclick="return ConfDel(0);">删除</a></div></td>
		</tr>
        <?php
		$ids=1;
		$orderid=$show['orderId'];
        $dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$ids);
		while($row = $dosql->GetArray($ids))
		{
			if(is_array($row)){
		?>
         <tr align="left" class="dataTr">
          <td width="9%" align="left" style="padding: 5px; text-align: center;"><img  width="120px" height="80px" src="../<?php echo $row['Images'];?>" alt="<?php echo $row['Title']; ?>" /></td>
			<td width="21%" height="35" align="left" style="padding: 5px; text-align: center;"><?php echo $row['Title']; ?></td>
			<td width="19%" align="center">价格：<?php echo $row['NewPrice']; ?>元</td>
			<td width="20%" align="center">数量：<?php echo $row['Quantity']; ?></td>
			<td align="center" style="color:red; font-weight:bold;" class="num">酒钱：<?php echo $row['JiuQian']; ?>元</td>
			<td align="center"><?php echo $row['CreatTime']; ?></td>
			<td align="center">&nbsp;</td>
		</tr>
		<?php
		}
		}
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
<div class="bottomToolbar">  <a onclick="history.go(-1);" style="cursor:pointer" class="dataBtn">返回</a> </div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php
//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea">
        <a onclick="history.go(-1);"  style="cursor:pointer" class="dataBtn">返回</a> <span class="pageSmall"><?php echo $dopage->GetList(); ?></span> 
        </div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>