<?php
    /**  
     * 链接地址：CommercialUserLogin
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
     * @会员登录  提供返回参数账号，商户账号：commercial   密码 password  商户手机端的CID clientid
     */
	 
require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();
$password = isset($password) ? md5(md5($password)) : '' ;

$r = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial' and PassWord='$password'");
if(is_array($r)){
if(isset($clientid)){
$sql = "UPDATE `commercialuser` SET clientid='$clientid' WHERE Commercial='$commercial' and PassWord='$password'";
$dosql->ExecNoneQuery($sql);	
}	
$State = 1;
$Descriptor = '数据获取成功！';	
$Data[]=$r;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data	
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据获取失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data
        );
echo phpver($result);
}
?>