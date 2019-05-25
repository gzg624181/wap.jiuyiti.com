<?php
    /**  
	 * 链接地址：EditOrderForm
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
     * @return string  订单生成接口 AddOrderForm
     *           
     * @修改会员订单生成接口 提供返回参数账号
	 *
     *number :订单号   quantity:数量  invoice:是否需要发票 userid:下单人 remark:备注 paymenttype:付款状态 state:订单状态
	 
     */
require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();


	
	//修改会员订单
	$sql = "UPDATE `orderform` SET commercial='$commercial', Invoice='$invoice', UserId='$userid', Remark='$remark', PaymentType='$paymenttype', State='$state' WHERE `Id`='$id'";
	$dosql->ExecNoneQuery($sql);

    $row = $dosql->GetOne("SELECT * FROM `orderform` WHERE Id='$id'");
	if(is_array($row)){
$State = 1;
$Descriptor = '订单修改成功！';	
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
$Descriptor = '订单修改失败!';	
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