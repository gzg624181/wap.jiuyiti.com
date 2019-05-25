<?php
$Data = array();
$us=array();
$dosql->Execute("SELECT * FROM `shoppingcart` WHERE Orderid='$orderid'");
while($rows=$dosql->GetArray()){
if(is_array($rows)){
	$us[]=$rows;
}
}
$mid=$us[0]['UserId'];
if(is_array($us)){
//购物成功之后，删除购物列表里面的数据
$dosql->QueryNone("DELETE FROM `shoppingcart` WHERE Orderid='$orderid'");	
  //购物成功之后，更新购物的状态，支付的金钱数目   （付款状态，订单状态）
  
  //state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
  
  //换购单：用酒钱购买的商品，订单状态用换购单来标识
  //已退款：购买了商品，但是没有过来提货，可以申请退款，在后台直接申请退款！
  //paymenttype 付款状态（1已付，为空未付）
  
  /* 判断小程序端传送过来的商品价格是否被更改过   */
$sum_price=0;
$dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
while($row=$dosql->GetArray()){
	$price[]=$row['Quantity']*$row['NewPrice'];   //商品价格
} 
 
foreach($price as $val){
	$sum_price += $val;	
}

$sum_jiuqian=floatval($payamount)+floatval($jiuqian);
if($sum_jiuqian==$sum_price){
	//更新商品订单里面的酒钱，支付的金额，订单状态,支付类型  
	//支付类型分为三种：
	//①. 1.酒钱支付
	//②. 2.现金支付
	//③. 3.混合支付
 if(floatval($payamount)>=0 && floatval($payamount)<=0){   //酒钱支付
	 $paymenttype="1";
 }elseif(floatval($jiuqian)>=0 && floatval($jiuqian)<=0){ //现金支付
	 $paymenttype="2";
 }else{  //混合支付
	 $paymenttype="3";
 }
$sql ="UPDATE `orderform` SET PayAmount='$payamount', State='1', PaymentType='$paymenttype',PayJiuQian='$jiuqian' WHERE OrderId='$orderid'";
$dosql->ExecNoneQuery($sql);

//如果商家用酒钱来支付，同时账号里面减去消费完的酒钱
$jqs=floatval($jiuqian);
if($jqs != 0){
$go=$dosql->GetOne("select * from memberuser where Id='$mid'");
$jq=floatval($go['JiuQian']) - $jqs;
// echo $jq;
$sql ="UPDATE `memberuser` SET JiuQian='$jq'  WHERE Id='$mid'";
$dosql->ExecNoneQuery($sql);
}
}
//同时更新商品的销量 ，购买几件在原来的数目上加上目前购买的商品数量 
$dosql->Execute("SELECT * FROM `ordercommodity` WHERE OrderId='$orderid'");
while($r=$dosql->GetArray()){
$CommodityId=$r['CommodityId'];  //获取商品Id
$shuliang=$r['Quantity'];
$show=$dosql->GetOne("SELECT * FROM `commodity` WHERE Id='$CommodityId'");	
$sours=$show["Num"];
$num=$shuliang + $sours;
//更新商品的销量
$sql ="UPDATE `commodity` SET Num='$num'  WHERE Id='$CommodityId'";
$dosql->ExecNoneQuery($sql);
}
}
?>
