<?php
    /**  
	 * 链接地址：PushMessage
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
     * 向后台申请推送消息到用户  标题：title   内容：msg  账号:account  类型：msgType
     */
require_once('../../include/config.inc.php');

// $title = isset($title) ? $title : '' ;
// $msg = isset($msg) ? $msg : '' ;
// $account = isset($account) ? $account : '' ;
// $msgType = isset($msgType) ? $msgType : '' ;

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();


	
	//像数据库里面导入注册信息
    $id= getrandomstring(20); 
//	$orderid= GetOrderID('pushmessage'); //排序
	$sql = "INSERT INTO `pushmessage` (MessageId, Message, Account, Title, CreatTime) VALUES ('$id', '$msg', '$account', '$msgType', '$Version')";
	$dosql->ExecNoneQuery($sql);
	

    $row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$account'");
	if(is_array($row)){
$State = 1;
$Descriptor = '数据查询成功！';	
$Data[]=$row;
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