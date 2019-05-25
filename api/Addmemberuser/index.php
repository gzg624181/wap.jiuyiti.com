<?php
    /**  
	 * 链接地址：Addmemberuser  会员注册账号,如果做活动的话则发送短信广告
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
     * 提供返回参数账号，  密码 password  账号account
     */
require_once("../../include/config.inc.php");
$password = md5(md5($password)) ;

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();


	
	//向数据库里面导入注册信息
/*    $id= getrandomstring(20); */
	$id=rand(1000000000,9999999999);
	$sql = "INSERT INTO `memberuser` (Id, Account,Alias, Password, CreatTime) VALUES ('$id', '$account', '$alias','$password', '$Version')";
	$dosql->ExecNoneQuery($sql);
	
$row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$account'");
if(is_array($row)){
	//是否开启发送短信服务
	/*
	①.在活动截止日期之内
	*/
	//获得当前时间
	$now=strtotime(date('Y-m-d',time()));
	//获得截止时间
	$endtime=strtotime($cfg_deadtime);
	$diff=$endtime-$now;
	if($diff>=0){      //在活动截止日期之内
	 //	注册成功之后发送短信  
	$jiuqian= $cfg_jiuqian;                    //注册赠送的酒钱
	$data['Account'] = $cfg_message_id;          //短信接口ID
	$data['Pwd'] 	 = $cfg_message_pwd;         //短信接口密码
	$data['Content'] = $jiuqian;                 //发送的短信内容
	$data['Mobile']	 = $account;                 //接收短信的号码
	$data['TemplateId']	 = $cfg_message_activity;   //短信模板ID
	$data['SignId']	 = $cfg_message_signid;       //签名Id 
	$url="http://api.feige.ee/SmsService/Template";	
	$res=post($url,$data);
	
	$dosql->ExecNoneQuery("UPDATE `memberuser` SET `JiuQian`='$jiuqian' WHERE `Account`='$account'");
	}   
	
	$State = 1;
	$Descriptor = '注册成功！';	
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
$Descriptor = '注册失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}

function post($url, $data, $proxy = null, $timeout = 20) {
$curl = curl_init();  
curl_setopt($curl, CURLOPT_URL, $url);    
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); //在HTTP请求中包含一个"User-Agent: "头的字符串。        
curl_setopt($curl, CURLOPT_HEADER, 0); //启用时会将头文件的信息作为数据流输出。   
curl_setopt($curl, CURLOPT_POST, true); //发送一个常规的Post请求  
curl_setopt($curl,  CURLOPT_POSTFIELDS, $data);//Post提交的数据包  
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用CURLOPT_MAXREDIRS可以限定递归返回的数量。     
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //文件流形式         
curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); //设置cURL允许执行的最长秒数。   
$content = curl_exec($curl);  
curl_close($curl);  
unset($curl);
return $content; 
}
?>