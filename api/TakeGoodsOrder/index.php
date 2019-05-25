<?php
    /**  
	 * 链接地址：TakeGoods
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
     * @return string
     *           
     * @提货接口  仅提供提取码 tiquma  商户账号commercial
	 
	  查询出订单里面的是否有这些产品
     */
	 
require_once('../../include/config.inc.php');
$Version=date("Y-m-d H:i:s");
 
   //paymenttype 付款类型（1.酒钱 2.现金 3.混合支付）
   
  //state订单状态订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )

$r=$dosql->GetOne("select * from orderform where tiquma='$tiquma'");
if(is_array($r)){
$orderid=$r['OrderId']; 
$dosql->Execute("select Title,Images,NewPrice,shprice,yuyue,picurl2,Quantity,OldPrice,JiuQian,Colour,Standard,yuyue,Pinpai,CommodityClass from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
while($row = $dosql->GetArray()){
  $Data[]=$row;                                     
}
$State = 1;
$Descriptor = '数据查询成功！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'Data' =>$Data
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据查询失败!';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version
        );
echo phpver($result);
}
?>