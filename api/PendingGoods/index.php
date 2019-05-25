<?php
    /**  
	 * 链接地址：PendingGoods 待提取商品
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
     * @查询所有商品 不需要提供返回参数账号
     */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d h:i:s");

$dosql->Execute("SELECT OrderId FROM `orderform` WHERE State='1' and Userid='$userid'");

if($dosql->GetTotalRow()>0){
$i=0;
while($i<$dosql->GetTotalRow())
{
	$Data[$i]=$row = $dosql->GetArray();
	$orderid=$row['OrderId'];
	$show=$dosql->GetOne("SELECT * FROM `ordercommodity` WHERE OrderId='$orderid' ORDER BY CreatTime DESC LIMIT 0,1");
	$id=$show['CommodityId'];
	$r=$dosql->GetOne("SELECT Images FROM `commodity` WHERE Id='$id'");
	$Image[]=$r;
	$i++;
}
$State = 1;
$Descriptor = '数据查询成功！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,
				'Image'=>$Image
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