<?php

// $data['name']	 = $_GET['name'];
// $data['Pwd'] 	 = $_GET['Pwd'];
// $data['args']  	 = $_GET['args'];




$url="http://管理台配置推送地址?name=admin&pwd=12345&args=13800210021#@#content1#@#2013-08-21 21:20:11#@#008123#@#13971167656#@#content2#@#2013-08-21 21:20:30#@#008456";

$res=post($url,$data=array());

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