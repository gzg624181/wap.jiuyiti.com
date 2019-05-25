<?php
    /**
     * 链接地址：orderList_Client
     * 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param integer $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
     *            
     * @return string  查询用户已经购买的商品列表
     */
	 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$id="me";
$ids="we";
if($type==1){
 //未提取（已付款 state=1）
$dosql->Execute("SELECT a.OrderId,a.State,a.PaymentType,a.kd_exp,a.kd_number,a.dingdantype,b.CommercialSite,a.State,b.kd_name,b.kd_phone,b.kd_area,b.kd_address  FROM orderform_commercial a inner join commercialuser b on a.Userid=b.Commercial where  b.Commercial='$userid' and a.State='1' or a.State='8' order by a.CreatTime desc",$id); 
}elseif($type==2){
 //已提取 
$dosql->Execute("SELECT a.OrderId,a.State,a.PaymentType,a.kd_exp,a.kd_number,a.dingdantype,b.CommercialSite,a.State,b.kd_name,b.kd_phone,b.kd_area,b.kd_address  FROM orderform_commercial a inner join commercialuser b on a.Userid=b.Commercial where  b.Commercial='$userid' and a.State='8' order by a.CreatTime desc",$id); 
}elseif($type==3){
 //未付款
$dosql->Execute("SELECT a.OrderId,a.State,a.PaymentType,a.kd_exp,a.kd_number,a.dingdantype,b.CommercialSite,a.State,b.kd_name,b.kd_phone,b.kd_area,b.kd_address  FROM orderform_commercial a inner join commercialuser b on a.Userid=b.Commercial where  b.Commercial='$userid' and a.State='5' order by a.CreatTime desc",$id); 	
}

if($dosql->GetTotalRow($id)>0){
	// 两张表联合查询
	/* b ordercommodity 商品订单列表
	   c commodity     商品详情
	*/	
for($i=0;$i<$dosql->GetTotalRow($id);$i++){
$row = $dosql->GetArray($id);
$Data[$i]=$row;
$orderid=$row['OrderId'];//一个订单号对应着多件商品
/*酒品种分类1.白酒 18.红酒 39.洋酒 56.啤酒 72.酒具 */
$dosql->Execute("select b.Title,b.Images,b.picarr,b.picurl2,b.NewPrice,b.shprice,b.yuyue,a.Quantity,b.OldPrice,b.JiuQian,b.Colour,b.Pinpai,b.CommodityClass,b.Standard,b.yuyue,b.Pinpai,b.CommodityClass,b.Id from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$ids);
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