<?php
    /**
	 * 链接地址：GetorderList_Client
	 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param integer $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
     *            
     * @return string  查询商户已经购买的商品列表
     */
	 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$id="me";
$ids="we";

 //已付款，未提取的订单
$dosql->Execute("SELECT * FROM `orderform_commercial` where  UserId='$userid' and State='1' order by CreatTime desc",$id); 
if($dosql->GetTotalRow($id)>0){
	// 两张表联合查询
	/* b ordercommodity 商品订单列表
	   c commodity     商品详情
	*/	
for($i=0;$i<$dosql->GetTotalRow($id);$i++){
$row = $dosql->GetArray($id);
$Data[$i]=$row;
$orderid=$row['OrderId'];//一个订单号对应着多件商品

$dosql->Execute("select Title,Images,picurl2,NewPrice,yuyue,Quantity,OldPrice,JiuQian,Colour,Standard,Pinpai,CommodityClass from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$ids);
for($j=0;$j<$dosql->GetTotalRow($ids);$j++) { 
  $r = $dosql->GetArray($ids);
  $Data[$i]["Commodity"][$j]=$r;
                                         } 
}

$State = 1;
$Descriptor = '数据查询成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data
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