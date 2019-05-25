<?php
    /**  
	 * 链接地址：Deltshoppingcart
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
     * @return string  删除购物车 Deltshoppingcart
     *           
     * @删除购物车 提供返回参数账号
	 *
     *id :id 提供删除的id
	 
     */
	 
require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$row = $dosql->GetOne("SELECT * FROM `shoppingcart` WHERE Id='$id'");
if(is_array($row)){
$dosql->QueryNone("DELETE FROM `shoppingcart` WHERE Id='$id'");	
$State = 1;
$Data[]=$row;
$Descriptor = '数据删除成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据删除失败!';	
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