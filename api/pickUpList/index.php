<?php
    /**  
	 * 链接地址：pickUpList 查询提货记录
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
     * @修改会员信息 Editmemberuser 
	   提供返回参数账号
	 *  商户账号：Commercial
	 */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$id=0;
$ids=1;

$dosql->Execute("SELECT orderId,pickUpTime FROM `pickuplist` WHERE Commercial='$commercial' order by id desc",$id);
if($dosql->GetTotalRow($id)>0){	
for($i=0;$i<$dosql->GetTotalRow($id);$i++){
$row = $dosql->GetArray($id);
$Data[$i]=$row;
$orderid=$row['orderId'];//一个订单号对应着多件商品

$dosql->Execute("select Title,Images,NewPrice,yuyue,Quantity,OldPrice,CommodityId,shprice,JiuQian,Colour,Standard,yuyue,Quantity,Pinpai,Types,CommodityClass,picurl2 from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$ids);
for($j=0;$j<$dosql->GetTotalRow($ids);$j++) { 
  $r = $dosql->GetArray($ids);
  $Data[$i]["Commodity"][$j]=$r;
                                         } 
}
$State = 1;
$Descriptor = '数据查询成功！';	
$Data[]=$row;
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