<?php
    /**  
	 * 链接地址：editUserJiuQian
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
     * @return string   账号：account 酒钱：jiuQian  
     *           
     * @根据 更新用户酒钱
     */
	 
require_once('../../include/config.inc.php');

/*$account = isset($account) ? $account : '' ;
$jiuQian = isset($jiuQian) ? $jiuQian : '' ;*/

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d h:i:s");
$r = $dosql->GetOne("SELECT * FROM `memberuser` WHERE  `Account`='$account'");
$jiuqians=$r['JiuQian'] - $jiuqian;
$sql ="UPDATE `memberuser` SET JiuQian='$jiuqians' WHERE `Account`='$account'";
$dosql->ExecNoneQuery($sql);
	
$row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$account'");
	if(is_array($row)){
$State = 1;
$Data[]=$row;  
$Descriptor = '酒钱更新数据成功';	
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
$Descriptor = '酒钱更新失败!';	
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