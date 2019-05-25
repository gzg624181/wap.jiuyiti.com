<?php
    /**  
	 * 链接地址：CommercialSignUp
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
     * @return string    提供参数：
	 
	 *  ①.商家账号： commercial  
	 *  ②.支付金额:  money  
	 *  ③.支付类型:  type (1. 支付宝支付 2. 微信支付 3. 酒钱支付 )
     *  ④.是否支付成功： pay(1.成功 0.失败)   
     *  ⑤.活动代码：     daima 
     *  ⑥.报名是否成功 result (1.成功 0.失败)  
	 
     * @商户报名活动接口 提供返回参数账号
	 *
     *申请提现
     */
require_once('../../include/config.inc.php');

@date_default_timezone_set("PRC");  //设置时区


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();


	//判断是否有这个商家,存在则进行以下操作
	$r = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
	$recommand=$r['Recommand'];
	if(is_array($r)){
	//申请报名成功支付之后，则向数据库中添加报名的资料（默认活动代码1）
	
	$s=$dosql->GetOne("select * from `pmw_signup` where zhanghu='$commercial' and daima='$daima'");
	if(!is_array($s)){

	$sql = "INSERT INTO `pmw_signup` (zhanghu,recommand, money, type, pay, daima, result, baomingtime) VALUES ('$commercial', '$recommand','$money', '$type', '$pay','$daima','$result','$Version')";
	$dosql->ExecNoneQuery($sql);
	
	}
	}
    $row = $dosql->GetOne("SELECT * FROM `pmw_signup` WHERE zhanghu='$commercial' and daima='$daima'");
	
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
$Descriptor = '数据添加失败!';	
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