<?php
    /**  
     * 添加收藏接口：AddDevice
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
     * @return string  更新手机端的CID码
     *           
     * 手机端的CID clientid  account: 默认游客 100000 devicetype [0] 安卓  [1] ios  苹果端和安卓端发送新的cid码，微信小程序不需要这个接口
     */

require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
    
	if($account!=100000){
	$row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$account'");
	if(is_array($row)){
	$sql = "UPDATE `memberuser` SET clientid='$clientid', devicetype = $devicetype WHERE Account='$account'";
	$dosql->ExecNoneQuery($sql);	
	}	
$State = 1;
$Descriptor = '数据查询成功！';
$result = array (
                                'State' => $State,
				'Descriptor' => $Descriptor,
				'Version' => $Version
                 );
echo phpver($result);		
	}else{	
$State = 0;
$Descriptor = '数据查询失败';	
$result = array (
                                'State' => $State,
				'Descriptor' => $Descriptor,
				'Version' => $Version
        );
echo phpver($result);
}		


?>