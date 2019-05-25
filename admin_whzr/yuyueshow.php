<?php
 require_once(dirname(__FILE__).'/inc/config.inc.php'); 
 error_reporting(E_ALL & ~E_NOTICE);  //屏蔽注意提示
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function message(Id){
  // alert(Id);
   layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
    photos: '#layer-photos-demo_'+Id,
	//area:['500px','300px'],  //图片的宽度和高度
    shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
	closeBtn:1,
	offset:'40px',  //离上方的距离
	shadeClose:false
  });
});  
}
</script>
</head>
<body>
<div class="topToolbar"> <span class="title" style="width:98%">商品订单</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="promotion_save.php">
<?php
		
	$r=$dosql->GetOne("select * from commercialuser where CommercialSite='$address'");
	$commercial=$r['Commercial'];
	//echo $commercial;
	$dosql->Execute("SELECT * FROM commoditystock,commodity where commoditystock.CommodityId=commodity.Id and commoditystock.CommercialUser='$commercial'");	
		while($show = $dosql->GetArray())
		{
		$shangjia[]=$show['Id'];
		}
		?>
  <?php
	$sum_price=0;
	$jiuqian_price=0;
	$dosql->Execute("SELECT * FROM ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$OrderId'");
	while($row=$dosql->GetArray()){
		$maijia[]=$row['Id'];
		}
		?> 
   
   
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="7%" height="36" align="center">预约订单</td>
			<td width="24%" align="center">预约地址</td>
			<td width="17%" align="center">预约时间</td>
			<td width="15%" align="center">商户名称</td>
			<td width="13%" align="center">下单人</td>
			<td width="12%" align="center">下单联系电话</td>
			<td width="12%" align="center">下单时间</td>
		</tr>
		<?php
	$dosql->Execute("SELECT * FROM orderform where OrderId='$OrderId'");
	while($row=$dosql->GetArray()){
		if(is_array($row)){
		$address=$row['address'];
		$accout=$row['UserId'];
		$r=$dosql->GetOne("select * from commercialuser where CommercialSite='$address'");
		$commerc=$r['CommercialName'];
		$gourl="businessshow.php?Commercial=".$r['Commercial']."&name=".$r['CommercialName'];
		$s=$dosql->GetOne("select * from memberuser where Account='$accout'");
		$alias=$s['Alias'];
		?>
		<tr align="left" class="dataTr">
			<td height="40" align="center"><?php  echo $row['OrderId'];?></td>
			<td align="center"><a href="<?php echo $gourl;?>"><?php  echo $address;?></a></td>
			<td align="center"><?php  echo $row['time'];?></td>
			<td align="center"><a href="<?php echo $gourl;?>"><?php  echo $commerc;?></a></td>
			<td align="center"><?php  echo $alias;?></td>
			<td align="center"><?php  echo $accout;?></td>
			<td align="center"><?php  echo $row['CreatTime']; ?></td>
		</tr>
        
		<?php
		}}
		?>
        <tr align="left" class="head">
			<td width="7%" height="36" align="center">&nbsp;</td>
			<td width="24%">&nbsp;</td>
			<td width="17%">&nbsp;</td>
			<td colspan="4" align="right">&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>
</form>
<div class="topToolbar"><span class="title" style="width:100%">买家订单列表
<?php
if(is_array($maijia) && is_array($shangjia) ){
$array=array_intersect($maijia,$shangjia);
//print_r($array);
$jj = array_merge(array_diff($maijia,$array),array_diff($array,$maijia));
//print_r($jj);
if(empty($array)){
echo "<font color='red'><B>"."商品库存不足，请立即补货！"."</b></font>";
	}else{
echo "<font color='red'><B>"."商家缺货，请立即补货！（黄色背景的产品代表缺货）"."</b></font>";
		}
}
?>
</span></div>
<form name="form" id="form" method="post" action="promotion_save.php">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" style="border-top-color:red;" class="head">
			<td width="9%" height="36" align="center">商品图片</td>
			<td width="31%" align="center">商品名称</td>
			<td width="22%" align="center">商品现价</td>
			<td width="26%" align="center">商品件数</td>
			<td width="12%" align="center">下单时间</td>
		</tr>
		<?php
	$sum_price=0;
	$jiuqian_price=0;
	$dosql->Execute("SELECT * FROM ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$OrderId'");
	for($j=0;$j<$dosql->GetTotalRow();$j++)
		{
		$row=$dosql->GetArray();
		if(is_array($row)){
		$price[]=$row['Quantity']*$row['NewPrice']; 
		$jiuqian[]=$row['Quantity']*$row['JiuQian']; 
		if(isset($jj[$j])){
			$ss= $jj[$j];
		}else{
			$ss="";
		}
		?>
		<tr align="left" class="<?php if($ss == $row['Id']){echo "dataTrRed";}else{echo "dataTr";}?>">
			<td height="80" align="center" style=" padding-top:1px;">
            <div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
            <img layer-src="../<?php echo $row['Images']; ?>" style="cursor:pointer; width:100px; height:65px;" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" width="100px" />
            </div>
            </td>
			<td align="center"><?php  echo $row['Title'];?></td>
			<td align="center" class="num" ><?php  echo $row['NewPrice'];?></td>
			<td align="center" class="num" style="color:red;"><?php  echo $row['Quantity'];?></td>
			<td align="center" class="num" ><?php  echo $row['CreatTime']; ?></td>
		</tr>
		<?php
		}}
		?>
        <tr>
			<td width="9%" height="36" align="center">&nbsp;</td>
			<td width="31%">&nbsp;</td>
			<td width="22%" align="center"><?php // print_r($maijia);?></td>
			<td colspan="2" align="right"><span style="text-align:right;">商品合计金额</span>：
			¥      <?php 
		//商品的总价格
        foreach($price as $val){
	    $jiuqian_price += $val;	
         }  
		    echo $jiuqian_price;
		 ?>&nbsp;&nbsp;</td>
		</tr>
        <tr>
			<td width="9%" height="36" align="center">&nbsp;</td>
			<td width="31%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
			<td colspan="2" align="right"><span style="text-align:right;"> 赠送会员酒钱</span>：
			¥      <?php 
		//商品的总价格
        foreach($jiuqian as $val){
	    $sum_price += $val;	
         }  
		    echo $sum_price;
		 ?>&nbsp;&nbsp;</td>
		</tr>
	</table>
</form>



<?php	
	$r=$dosql->GetOne("select * from commercialuser where CommercialSite='$address'");
	$commercial=$r['Commercial'];
	$name=$r['CommercialName'];
	$gourl="businessshow.php?Commercial=".$r['Commercial']."&name=".$r['CommercialName'];
?>
<div class="topToolbar"><span class="title" style="width:100%">商家库存列表&nbsp;&nbsp;</span>
<div style="float:left"><font size="+1" style="margin-left:-900px;"><B><a href="<?php echo $gourl;?>"><?php echo $name;?>店</a></B></font></div>
</div>
<form name="form" id="form" method="post" action="promotion_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
		  <td width="9%" height="36" align="center">商品图片</td>
		  <td width="31%" align="center">商品名称</td>
			<td width="22%" align="center">商品现价</td>
		  <td width="26%" align="center">商户库存</td>
		  <td width="12%" align="center">商品销量</td>
		</tr>
        <?php

	//echo $commercial;
	$dosql->Execute("SELECT * FROM commoditystock,commodity where commoditystock.CommodityId=commodity.Id and commoditystock.CommercialUser='$commercial'");	
		for($i=0;$i<$dosql->GetTotalRow();$i++)
		{
		$show=$dosql->GetArray();
		if(is_array($show)){
		if(isset($array[$i])){
			
			$ii= $array[$i];
		}else{
			
			$ii="";
		}
		?>
		<tr align="left" class="<?php if($ii==$show['CommodityId']){echo "dataTrOff";}else{echo "dataTr";}?>" >
			<td height="80" align="center"><img style="padding:1px; border-radius:3px;"  width="100px;" height="65px;"  src="../<?php  echo $show['Images']; ?>"/></td>
			<td align="center"><?php  echo $show['Title'];?> </td>
			<td align="center" class="num"><?php  echo $show['NewPrice'];?></td>
			<td align="center" class="num"><?php echo "<font color='red'><B>".$show['Stock']."</B></font>"; ?><?php
			if($ii!=""){
	$s=$dosql->GetOne("select * from ordercommodity where CommodityId='$ii' and OrderId='$OrderId'");	
	$quantity=$s['Quantity'];
	//echo $quantity;
	if($show['Stock']<$quantity){
		echo "<font color='yellow'><B>"."警告：库存即将不足，请立即补充库存！"."</B></font>";
		}		
				}
			?>
            </td>
			<td align="center" class="num"><?php  echo $show['salenum']; ?></td>
	  </tr>
		<?php
		}}
		?>
       <?php // print_r($shangjia);?> 
	</table>
</form>

<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="formSubBtn" style="text-align:left; margin-left:50px; margin-top:20px;">
<input type="button" class="back" value="返回" onclick="history.go(-1);" />
	</div>

</body>
</html>