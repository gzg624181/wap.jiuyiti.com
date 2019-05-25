<?php


$data['Account'] = "13618613798";
$data['Pwd'] 	 = "93f3d182a920c6cabb1078e03";
$data['Content'] = "123456";
$data['Mobile']	 = "13618613798";
$data['SignId']	 = "32064";

/*$data['Account'] = $_POST['Account']="13618613798";
$data['Pwd'] 	 = $_POST['Pwd']="93f3d182a920c6cabb1078e03";
$data['Content'] = $_POST['Content']="【玖易提】您的验证码为：1234，2分钟内有效，请尽快验证。如非本人操作，请忽略本短信。";
$data['Mobile']	 = $_POST['Mobile']="13618613798";
$data['SignId']	 = $_POST['SignId']="32064";
*/


$url="http://api.feige.ee/SmsService/Send";

$res=post($url,$data);

echo $res;exit;

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