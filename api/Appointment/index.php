<?php
    /**
	 * 链接地址：Appointment
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
     * @预约功能 提供返回参数账号，提货地点：address   预约时间：time  订单号 orderid   用户 userid
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();



	//向数据库里面导入预约信息
	$sql ="UPDATE `orderform` SET address='$address',time='$time',dingdantype=1 where OrderId='$orderid' and UserId='$userid'";
	$dosql->ExecNoneQuery($sql);


$row = $dosql->GetOne("SELECT * FROM `orderform` where OrderId='$orderid' and UserId='$userid'");
if(is_array($row)){
$State = 1;
$Descriptor = '预约成功！';
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
$Descriptor = '预约失败!';
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
