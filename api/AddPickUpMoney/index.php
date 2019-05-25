<?php
    /**  
	 * 链接地址：AddPickUpMoney
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
     * @return string  订单生成接口 AddPickUpMoney
     *           
     * @会员订单生成接口 提供返回参数账号
	 *
     *申请提现
     */ 
require_once('../../include/config.inc.php');

@date_default_timezone_set("PRC");  //设置时区


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();
$year=date("Y");//获取当前的年份
$month=date("m");//获取当前的月份
$one=1;


	//判断是否有这个会员
	$r = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
	if(is_array($r)){
	//申请提现之后，从商家账户中减去提现的金额
	$dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and year='$year' and month='$month'",$one);
	$num=$dosql->GetTotalRow($one);
	if($num>0){
	$r=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
	if(floatval($r['JiuQian'])>=floatval($applymonery)){
	$jiuqian=floatval($r['JiuQian'])-floatval($applymonery);
	$sql = "UPDATE `commercialuser` SET  JiuQian='$jiuqian' WHERE `Commercial`='$commercial'";
    $dosql->ExecNoneQuery($sql);
	$sql = "INSERT INTO `pickupmoney` (Commercial, RealName, BankName, BankNo,ApplyTime,ApplyMonery) VALUES ('$commercial', '$realname', '$bankname', '$bankno','$applytime','$applymonery')";
	$dosql->ExecNoneQuery($sql);
	}
	}
	}
    $row = $dosql->GetOne("SELECT * FROM `pickupmoney` WHERE ApplyTime='$applytime' and Commercial='$commercial'");
	
	if(is_array($row)){
$State = 1;
$Descriptor = '数据添加成功！';	
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
$Descriptor = '商户本月本自提点最少有一单提单!';	
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