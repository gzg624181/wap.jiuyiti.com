<?php
    /**  
	 * 链接地址：ServiceSound  推荐排行
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
     * @查询是快递订单的服务提醒 提供下单人账号 
     */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$two=2;


$dosql->Execute("SELECT * FROM ordercommodity,orderform,commodity where ordercommodity.OrderId=orderform.OrderId and ordercommodity.CommodityId=commodity.id and orderform.UserId='$userid' and orderform.dingdantype=2 order by orderform.CreatTime desc limit 0,2 ",$two);
$num=$dosql->GetTotalRow($two);
if($num>0){
$i=0;
while($i<$dosql->GetTotalRow($two))
{   $row = $dosql->GetArray($two);

	$Data[$i]=$row;

	$i++;
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