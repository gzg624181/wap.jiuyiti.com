<?php
    /**  
     * 链接地址：Commodityyujing（查詢商户预警）
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
     * @获取商品详情  商户账号：commercialuser
     */
	 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$id=0;
$dosql->Execute("SELECT Title,Images,NewPrice,shprice,yuyue,OldPrice,JiuQian,Colour,Standard,yuyue,Stock,Warn from commoditystock a inner join commodity b on a.CommodityId=b.Id where a.CommercialUser='$commercialuser' and Warn > Stock",$id);
if($dosql->GetTotalRow($id)>0){

for($i=0;$i<$dosql->GetTotalRow($id);$i++)
{
    $row = $dosql->GetArray($id);
    $Data[$i]=$row;
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
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
		'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}
?>