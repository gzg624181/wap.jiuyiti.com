<?php
    /**  
	 * 链接地址：IsAccount   通过填写的电话号码判断是否执行登陆或者注册操作
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
     * @会员注册账号 提供写入参数账号，  手机号码 phone 
     */
require_once("../../include/config.inc.php");


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = "";

$s=$dosql->GetOne("select Account from memberuser where Account='$phone'");
if(is_array($s)){
//当填写的号码存在时，则执行登陆操作
$State = 1;
$Descriptor = '手机号码查询成功，请执行登陆操作!';	
$classify=1;      //值为1说明进行登陆操作
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'phone'   => $phone,
                'classify' => $classify		
        );
echo phpver($result);
}else{
//当填写的号码不存在时，则执行注册操作	
$State = 0;
$Descriptor = '手机号码查询失败，请执行注册操作!';	
$classify=0;      //值为0说明进行注册操作
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'phone'   => $phone,
                'classify' => $classify				
        );
echo phpver($result); 	
}
?>