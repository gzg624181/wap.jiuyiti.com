<?php
    /**  
	 * 链接地址：VerifyAccount
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
     * @检查账号是否注册 提供返回参数账号，手机号：account
     */
	 
require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();

$row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE `Account`='$account'");
if(is_array($row)){
$State = 1;
$Descriptor = '此用户已被注册！';	
$Data[]=$row;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $json = preg_replace_callback("#\\\u([0-9a-f]{4})#i", function ($matches) {
        return iconv('UCS-2BE', 'UTF-8', pack('H4', $matches[1]));
    }, json_encode($result));
	echo $json;
} else {
    $json = json_encode($result, JSON_UNESCAPED_UNICODE);
	echo $json;
}
}else{

$State = 0;
$Descriptor = '此用户未被注册!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $json = preg_replace_callback("#\\\u([0-9a-f]{4})#i", function ($matches) {
        return iconv('UCS-2BE', 'UTF-8', pack('H4', $matches[1]));
    }, json_encode($result));
	echo $json;
} else {
    $json = json_encode($result, JSON_UNESCAPED_UNICODE);
	echo $json;
}
}
?>