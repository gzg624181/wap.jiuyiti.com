<?php
    /**  
	 * 链接地址：CommercialUserInfo
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
     * @根据 查询用户信息接口  commercial 商户账号
     */
	 
require_once('../../include/config.inc.php');


$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$row = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
$Id=$row['Id'];
$file = "../../cache/".$Id.".txt";  
$msg = Readf($file);  
$Data = unserialize($msg); 
if(count($Data)>0){
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