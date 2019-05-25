<?php
    /**  
     * 链接地址：EditCommerPwd   修改商户账号密码
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
     * @会员注册账号 提供返回参数账号，  老密码 oldpassword   重复密码 confirmpassword 新密码 password  用户账号 commercial
     */
require_once("../../include/config.inc.php");

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");


$r=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
if(is_array($r)){
$PassWord=$r['PassWord'];            //原始密码
$oldpassword=md5(md5($oldpassword));  //传过来的原密码

 //如果原始密码和
 if($PassWord==$oldpassword){ 
 
    if($password==$confirmpassword){
	$pwd=md5(md5($password));
	$sql = "UPDATE `commercialuser` SET Password='$pwd' where Commercial='$commercial'";
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
$State = 2;
$Descriptor = '两次密码输入不一致!';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,	
        );
echo phpver($result); 	
	}
              }else{
$State = 0;
$Descriptor = '原始密码错误!';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,	
        );
echo phpver($result); 	 
}			   
 	
}
 



?>