<?php
    /**  
	 * 链接地址：ForgetPwd  更改用戶密碼
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
     * @会员注册账号 提供返回参数账号，  手机号码 account 验证码，captcha   新密碼password
     */
require_once("../../include/config.inc.php");

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");


$r=$dosql->GetOne("select * from yzm where phone='$account'");
if(is_array($r)){
$content=$r['code'];         //验证码
$start_time=$r['start_time'];  //提交开始时间
$num=$r['num'];  //
//$start_time 开始时间戳
//$Version 结束时间戳
//计算天数
$secs = strtotime($Version)-strtotime($start_time);

 //更改用户密码,同时在180s之内提交更改数据,1天之内发送验证码不超过15次
 if($content==$captcha && $num<15 && $secs <180 )	{ 
	$pwd=md5(md5($password));
	$sql = "UPDATE `memberuser` SET Password='$pwd' where Account='$account'";
	$dosql->ExecNoneQuery($sql); 
	$State = 1;
    $Descriptor = '密码更改成功！';
	$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version
               );
	
echo phpver($result);
	
              }else{
$State = 0;
$Descriptor = '密码更改失败!';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,	
        );
echo phpver($result); 	 
}			   
 	
}
 



?>