<?php
    /**
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param unknown $status 状态码
     *            
     * @param string $message  提示信息
     *           
     * @param array $data 数据
     *            
     * @return string
     */
	 
header("Content-type: text/html; charset=utf-8");
require_once(dirname(__FILE__).'/../../../include/config.inc.php');
require_once 'Response.php';
$status = false;
$msg = '获取数据失败';
$data = array();
$createtime=date("Y-m-d h:i:s");
// Id,UserName, Alias, Age, Sex, Phone, IdNumber, Account, Password, Image, Balance,CreatTime,orderid
if(isset($data)){
	$status = true;
    $msg = '获取数据成功';
    $data = array();
	$json=$_POST['data'];
	$data=json_decode($json,true);
	
	$Id= getrandomstring(20);                          //ID
	$UserName=$UserName ? $data['object']['UserName']:'';   //姓名
	$Alias=$Alias ? $data['object']['Alias']:'';            //昵称
	$Age=$Age ? $data['object']['Age']:'';                  //年龄
	$Sex=$Sex ? $data['object']['Sex']:'';                  //性别
	$Phone=$Phone ? $data['object']['Phone']:'';            //手机
	$IdNumber=$IdNumber ? $data['object']['IdNumber']:'';   //身份证号
	$Account=$Account ? $data['object']['Account']:'';      //账号
	$Password=$Password ? $data['object']['Password']:'';   //密码
	$Balance=$Balance ? $data['object']['Balance']:'';       //余额
	$regTime=$regTime ? $data['object']['CreatTime']:'';    //创建时间
	$orderid= GetOrderID('memberuser');                      //排序
	echo Response::json($status,$msg,$data,$createtime);
	}else{
     $value = array(
              $status,
              $msg,
     );
echo Response::json($status,$msg,$data,$createtime);
}



?>