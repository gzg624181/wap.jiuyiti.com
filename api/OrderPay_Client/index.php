<?php
    /**
	 * 链接地址：OrderPay_Client
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
     * @删除购物车 提供返回参数账号
	 现金支付payamount
	 酒钱jiuqian
	 订单号orderid
	 快递费用 kdmoney
	 支付方式(paytype:0.支付宝支付 1.微信支付)
     商户账号：userid

     */

require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");


  //购物成功之后，更新购物的状态，支付的金钱数目   （付款状态，订单状态）

  //state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )

  //换购单：用酒钱购买的商品，订单状态用换购单来标识
  //已退款：购买了商品，但是没有过来提货，可以申请退款，在后台直接申请退款！
  //paymenttype 付款状态（1已付，为空未付）

  $row=$dosql->GetOne("select * from orderform_commercial where OrderId='$orderid'");
  $userid=$row['UserId'];

   //购物成功之后，删除购物列表里面的数据
$dosql->QueryNone("DELETE FROM `shoppingcart` WHERE Orderid='$orderid'");


	//更新商品订单里面的酒钱，支付的金额，订单状态,支付类型
	//支付类型分为三种：
	//①. 1.酒钱支付
	//②. 2.现金支付
	//③. 3.混合支付
 if(floatval($payamount)==0){    //酒钱支付
	 $paymenttype="1";
 }elseif(floatval($jiuqian)==0){ //现金支付
	 $paymenttype="2";
 }else{  //混合支付
	 $paymenttype="3";
 }

  //添加完订单表，商品订单表之后，目前订单的类型全部是快递订单2

   //更新订单的预约状态,付款状态，支付状态
$sql ="UPDATE `orderform_commercial` SET PayAmount='$payamount', State=1, PaymentType='$paymenttype',PayJiuQian='$jiuqian',paytype='$paytype',dingdantype=2,PayKdMoney=$kdmoney WHERE OrderId='$orderid'";
$dosql->ExecNoneQuery($sql);

//如果商家用酒钱来支付，同时账号里面减去消费完的酒钱
$jqs=floatval($jiuqian);
if($jqs != 0){
$go=$dosql->GetOne("select * from commercialuser where Commercial='$userid'");
$jq=floatval($go['JiuQian']) - $jqs;
// echo $jq;
$sql ="UPDATE `commercialuser` SET JiuQian='$jq'  WHERE Commercial='$userid'";
$dosql->ExecNoneQuery($sql);
}


//同时更新商品的销量 ，购买几件在原来的数目上加上目前购买的商品数量
/*
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

$r=$dosql->GetOne("select * from orderform_commercial where OrderId='$orderid'");
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
