<?php
    /**
	 * 链接地址：OrderPay
	 *
     * 下面直接来连接操作数据库进而得到json串
     *
     * 按json方式输出通信数据
     *
     * @param unknown $State 状态码
     *
     * @param string $Descriptor  提示信息
     *
	 * @param string $Version  操作时间

     * @param array $Data 数据
     *
     * @return string  购买成功后删除购物记录
     *
     * @删除购物车 提供返回参数账号  payamount 现金支付  jiuqian 酒钱 订单号orderid  快递费用 kdmoney
	 *
     *id :返回购物orderid

     */

require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
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

  //paymenttype 付款状态（1已付，为空未付）

  /* 判断app端传送过来的商品价格是否被更改过   */
$sum_price=0;
$dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
while($row=$dosql->GetArray()){
	$price[]=$row['Quantity']*$row['NewPrice'];   //商品价格
}

foreach($price as $val){
	$sum_price += $val;
}
$sum_prices=$sum_price+$kdmoney;
$sum_jiuqian=floatval($payamount)+floatval($jiuqian);
if($sum_jiuqian==$sum_prices){
	//更新商品订单里面的酒钱，支付的金额，订单状态,支付类型
	//支付类型分为三种：
	//①. 1.酒钱支付
	//②. 2.现金支付
	//③. 3.混合支付
 if(floatval($payamount)==0){    //酒钱支付
	 $paymenttype="1";
 }elseif(floatval($jiuqian)==0){ //现金支付
	 $paymenttype="2";
 }else{                          //混合支付
	 $paymenttype="3";
 }

 //添加完订单表，商品订单表之后，通过订单查询向数据库中插入是否是预约还是现提订单的字段  1.预约  0.现提  2.快递
	$dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
    while($r=$dosql->GetArray()){
	$dingdan[]=$r['yuyue'];
     }
    if(in_array(1,$dingdan)){   //如果订单里面有预约订单则订单类型显示为预约订单
	$dingdantype=1;
    }else{
	$dingdantype=0;
    }
   //判断出是哪种订单之后，更新订单的预约状态,付款状态，支付状态
   $sql ="UPDATE `orderform` SET PayAmount='$payamount', State='1', PaymentType='$paymenttype',PayJiuQian='$jiuqian',paytype='$paytype',dingdantype='$dingdantype' WHERE OrderId='$orderid'";
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
/* 商品销量已经在提取商品的时候处理完毕
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
*/
}

$r=$dosql->GetOne("select * from orderform where OrderId='$orderid'");
if(is_array($r)){
$State = 1;
$Data[]=$r;
$Descriptor = '数据查询成功';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version,
                'Data' => $Data,
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据查询失败!';
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version,
                'Data' => $Data,
        );
echo phpver($result);
}
?>
