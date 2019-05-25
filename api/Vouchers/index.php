<?php
    /**
	   * 链接地址：Vouchers
	   *
     * 下面直接来连接操作数据库进而得到json串
     *
     * @param unknown $State 状态码
     *
     * @param string $Descriptor  提示信息
     *
     * @param array $Data 数据
     *
     * @return string  查询所有购物券信息 0未使用购物券   1使用了购物券
     */

require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$dosql->Execute("SELECT coupons.money, coupons.logo,coupons.type, coupons.Commodityid,coupons.usetime,couponslist.id, couponslist.state, couponslist.creatime,commercialuser.CommercialName, commercialuser.CommercialSite
FROM coupons
LEFT JOIN couponslist ON coupons.id = couponslist.gid
LEFT JOIN commercialuser ON coupons.Commodityid = commercialuser.Id where couponslist.account='$account'order by coupons.orderid desc");

if($dosql->GetTotalRow()>0){
$i=0;
while($i<$dosql->GetTotalRow())
{
    $row = $dosql->GetArray();
	$Data[$i]=$row;
	if($Data[$i]['Commodityid']=="0"){
	   $Data[$i]['CommercialName']="通用优惠券";
	   $Data[$i]['CommercialSite']="所有店铺通用";
	}
	$i++;
}
$State = 1;
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
