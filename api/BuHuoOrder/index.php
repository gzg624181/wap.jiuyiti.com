<?php
    /**  
	 * 链接地址：BuHuoOrder  ，补货完成的接口
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
     * @会员购买的商品在指定的商家那里拿货的商品列表 提供订单号码  OrderId
     */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$id="me";
$ids="we";

$dosql->Execute("SELECT * FROM `orderform_commercial` where  Userid='$userid' and ordertype=2 and State=1 order by CreatTime desc",$id); 


if($dosql->GetTotalRow($id)>0){
	// 两张表联合查询	
for($i=0;$i<$dosql->GetTotalRow($id);$i++){
$row = $dosql->GetArray($id);
$Data[$i]=$row;
$orderid=$row['OrderId'];//一个订单号对应着多件商品

$dosql->Execute("select b.Title,b.Images,b.picarr,b.picurl2,b.shprice,b.yuyue,a.Quantity,b.OldPrice,b.JiuQian,b.Colour,b.Pinpai,b.CommodityClass,b.Standard,b.yuyue,b.Pinpai,b.CommodityClass,b.Id from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$ids);
for($j=0;$j<$dosql->GetTotalRow($ids);$j++) { 
  $r = $dosql->GetArray($ids);
  $Data[$i]["Commodity"][$j]=$r;
                                         } 
}
$State = 1;
$Descriptor = '数据查询成功！';	
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