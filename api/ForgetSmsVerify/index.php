<?php
    /**  
	 * 链接地址：ForgetSmsVerify  获取短信验证码接口
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
     * @会员注册账号 提供返回参数账号，  手机号码 phone 
     */
require_once("../../include/config.inc.php");

$content=rand(100000,999999);
$data['Account'] = $cfg_message_id;       //短信接口ID
$data['Pwd'] 	 = $cfg_message_pwd;      //短信接口密码
$data['Content'] = $content;              //发送的短信内容
$data['Mobile']	 = $phone;                //接收短信的号码
$data['TemplateId']	 = $cfg_message_forgetid;  //短信模板ID
$data['SignId']	 = $cfg_message_signid;     //签名Id 

$url="http://api.feige.ee/SmsService/Template";

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = "";

$res=post($url,$data);
$datas= json_decode($res,true);
$Code= $datas["Code"];
//echo "<br>";
$Message= $datas["Message"];
//echo $Message;
if($Code == 0 && $Message=="OK"){
//判断验证码发送成功的时候
$start_time=date("Y-m-d H:i:s");
$date=date("Y-m-d");
$s=$dosql->GetOne("select * from yzm where phone='$phone'");
if(is_array($s)){
$r = $dosql->GetOne("SELECT MAX(num) AS `num` FROM `yzm` where phone='$phone' and date='$date'");
if(is_array($r)){
$num = (empty($r['num']) ? 1 : ($r['num'] + 1));
}else{
$num=1;		
}
$sql = "UPDATE yzm SET code='$content',start_time='$start_time',num='$num',date='$date' where phone='$phone'";
$dosql->ExecNoneQuery($sql);
}else{
$sql = "INSERT INTO `yzm` (phone,code,start_time,num,date) VALUES ('$phone','$content','$start_time',1,'$date')";
$dosql->ExecNoneQuery($sql);
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