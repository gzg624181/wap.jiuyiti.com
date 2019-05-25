<?php
    require_once(dirname(__FILE__).'/inc/config.order.inc.php');
    // $account="13618613798";
    // $alias="Echo";
	// $time="2017-11-30";
	// $address="湖北武汉保利花园";
	//初始化参数
	$tbname = 'pickupmoney';
	$gourl  = 'money.php';
	$Version=date("Y-m-d H:i:s");
	$CreatTime=$Version;         //通知时间
	$posttime=substr($CreatTime,0,10);
	$applytimes=substr($applytime,0,10);  //申请的年月日
	if($types==1){
		$types="管理员";
		$row = $dosql->GetOne("select phone from  `pmw_admin` where username='$commercial'");
	    $account=$row['phone'];
	}else{
		$types="商户";
		$row = $dosql->GetOne("select Phone from  `commercialuser` where Commercial='$commercial'");
	    $account=$row['Phone']; 
	}
	
	$data['Account'] = $cfg_message_id;          //短信接口ID
	$data['Pwd'] 	 = $cfg_message_pwd;         //短信接口密码
    $data['Content'] = $types.'||'.$commercial.'||'.$applytimes.'||'.$money; //发送的短信内容
	$data['Mobile']	 = $account;                  //接收短信的号码
	$data['TemplateId']	 = $cfg_sendtxmessage;    //发送提现短信提醒模板ID
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
$dosql->ExecNoneQuery("UPDATE `$tbname` SET  send=1,CreatTime='$CreatTime',posttime=$posttime where Commercial='$commercial' and ApplyTime='$applytime' and State=1");
ShowMsg('短信发送成功！','money.php');
exit();  
}else{
ShowMsg('短信发送失败，请重新发送！','money.php');	
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