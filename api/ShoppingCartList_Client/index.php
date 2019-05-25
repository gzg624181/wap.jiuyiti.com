<?php
    /**
	 * 链接地址：ShoppingCartList_Client
	 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param unknown $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
     *            
     * @return string  查询购物车列表接口 提供userid
     */
	
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Commodity=array();
$Version=date("Y-m-d H:i:s");
// $start=$count * $pagesize;


$dosql->Execute(" SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'");
if($dosql->GetTotalRow()>0){
$i=0;
while($i<$dosql->GetTotalRow())
{
	$Data[$i]=$row = $dosql->GetArray();
	$i++;
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
} elseif($dosql->GetTotalRow()==0){
$State = 0;
$Descriptor = '数据查询为空！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                 );
echo phpver($result);			 
}else{
$State = -1;
$Descriptor = '数据查询失败!';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
        );
echo phpver($result);
}
?>