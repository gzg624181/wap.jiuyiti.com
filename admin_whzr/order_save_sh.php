<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2017 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'orderform_commercial';
$gourl  = 'allorder_sh.php';


//引入操作类
require_once(ADMIN_INC.'/action.product.class.php');

//发送快递信息的步骤
/*
  ①.更新用户的物流订单信息
  ②.更新快递订单的订单号
  ③.发送快递短信到用户的手机号码
*/
if($action == 'kd_state_sh')
{    //更改快递订单状态为1，表示已经发送快递，同时更新快递订单的物流信息

	$data['Account'] = $cfg_message_id;          //短信接口ID
	$data['Pwd'] 	 = $cfg_message_pwd;         //短信接口密码
    $data['Content'] = $alias.'||'.$creattime.'||'.$kd_exp.'||'.$kd_number; //发送的短信内容
	$data['Mobile']	 = $kd_phone;                  //接收短信的号码
	$data['TemplateId']	 = $cfg_kdmessage;      //发送寄件短信模板id
	$data['SignId']	 = $cfg_message_signid;       //签名Id 
	$url="http://api.feige.ee/SmsService/Template";	
	$res=post($url,$data);

	$datas= json_decode($res,true);
	$Code= $datas["Code"];
	//echo "<br>";！ 
	$Message= $datas["Message"];
	//echo $Message;
	if($Code == 0 && $Message=="OK"){
	//判断验证码发送成功的时候,更改发送短信的状态
	$taketime=date("Y-m-d H:i:s");
	$dosql->ExecNoneQuery("UPDATE `orderform_commercial` SET kd_state=1,State=8,duanxin=1,kd_exp='$kd_exp',kd_number='$kd_number',TakeTime='$taketime' WHERE `OrderId`='$orderid'");
	

	$gourls="express_sh.php?userid=".$userid."&orderid=".$orderid;
	ShowMsg('快递短信发送成功！',$gourls);
	exit();  
	}else{
    $gourls="express_sh.php?userid=".$userid."&orderid=".$orderid;
	ShowMsg('快递短信发送失败，请重新发送！',$gourls);	
	}
}elseif($action == 'sjkd_state')
{    //更改快递订单状态为1，表示已经发送快递，同时更新快递订单的物流信息

	$data['Account'] = $cfg_message_id;          //短信接口ID
	$data['Pwd'] 	 = $cfg_message_pwd;         //短信接口密码
    $data['Content'] = $alias.'||'.$creattime.'||'.$sjkd_exp.'||'.$sjkd_number; //发送的短信内容
	$data['Mobile']	 = $sjkd_phone;                  //接收短信的号码
	$data['TemplateId']	 = $cfg_sjkdmessage;      //发送寄件短信模板id
	$data['SignId']	 = $cfg_message_signid;       //签名Id 
	$url="http://api.feige.ee/SmsService/Template";	
	$res=post($url,$data);

	$datas= json_decode($res,true);
	$Code= $datas["Code"];
	//echo "<br>";！ 
	$Message= $datas["Message"];
	//echo $Message;
	if($Code == 0 && $Message=="OK"){
	//判断验证码发送成功的时候,更改发送短信的状态
	$taketime=date("Y-m-d H:i:s");
	$dosql->ExecNoneQuery("UPDATE `orderform_commercial` SET sjkd_state=1,sjkd_duanxin=1,sjkd_exp='$sjkd_exp',sjkd_number='$sjkd_number' WHERE `OrderId`='$orderid'");
	$gourls="sj_express.php?address=".$address."&orderid=".$orderid;
	ShowMsg('快递短信发送成功！',$gourls);
	exit();  
	}else{
	$gourls="sj_express.php?address=".$address."&orderid=".$orderid;
	ShowMsg('快递短信发送失败，请重新发送！',$gourls);	
	}
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
