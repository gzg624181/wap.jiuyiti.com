<?php
    /**
	 * 链接地址：YuYueOrder
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
     * @会员购买的商品在指定的商家那里拿货的商品列表 提供type 用户名称userid
     */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$id="me";
$ids="we";
//
if($type==1){
 //未提取（已付款 state=1）
$dosql->Execute("SELECT * FROM `orderform` a inner join commercialuser b on a.address=b.CommercialSite where  b.Commercial='$userid' and a.State='1' order by a.CreatTime desc",$id);
}elseif($type==8){
 //已提取
$dosql->Execute("SELECT *  FROM `orderform` a inner join commercialuser b on a.address=b.CommercialSite where  b.Commercial='$userid' and a.State='8' order by a.CreatTime desc",$id);
}

if($dosql->GetTotalRow($id)>0){
	// 两张表联合查询
for($i=0;$i<$dosql->GetTotalRow($id);$i++){
$row = $dosql->GetArray($id);
$Data[$i]=$row;
$orderid=$row['OrderId'];//一个订单号对应着多件商品
$dosql->Execute("select b.Title,b.Images,b.picarr,b.picurl2,b.NewPrice,b.shprice,b.yuyue,a.Quantity,b.OldPrice,b.JiuQian,b.Colour,b.Pinpai,b.CommodityClass,b.Standard,b.yuyue,b.Pinpai,b.CommodityClass,b.Id from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid' and a.tag=0",$ids);
$num=$dosql->GetTotalRow($ids);
for($j=0;$j<$dosql->GetTotalRow($ids);$j++) {
  $r = $dosql->GetArray($ids);
  $Data[$i]["Commodity"][$j]=$r;
}
}


// foreach ($Data as $key=>$value)
// {
//   if(!isset($Data[$key]['Commodity']))
//     unset($Data[$key]);
// }

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
