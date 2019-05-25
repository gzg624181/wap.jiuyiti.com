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
     * @预约功能 提供返回参数账号，
   	 *  预约地点：address   预约时间：time     订单号 orderid   用户 userid
	   *  如果填写了快递信息 ，则需要提供 收货人：kd_name  联系电话：kd_phone  所在地区：kd_area   街道：kd_street  详细地址：kd_address
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();




	if(isset($kd_name) && $kd_name!=""){
	$Commercial="kd_admin";
	$sql ="UPDATE `orderform` SET dingdantype=2,Commercial='$Commercial', where OrderId='$orderid',kd_name='$kd_name',kd_phone='$kd_phone',kd_area='$kd_area',kd_street='$kd_street',kd_address='$kd_address' and UserId='$userid'";
	$dosql->ExecNoneQuery($sql);
	//更新用户的收货信息
	$sql ="UPDATE `memberuser` SET kd_name='$kd_name',kd_phone='$kd_phone',kd_area='$kd_area',kd_street='$kd_street',kd_address='$kd_address' where Account='$userid'";
  $dosql->ExecNoneQuery($sql);
	}


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
