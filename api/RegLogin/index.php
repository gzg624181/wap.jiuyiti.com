<?php
    /**
	 * 链接地址：RegLogin   登陆或者注册操作
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
     * @会员注册账号 提供返回参数账号， 手机号码 phone  执行操作的类型classify（1登陆 0注册）验证码：captcha
	   *安卓手机端的CID  clientid  devicetype [0] 安卓  [2] ios [1] 小程序  获取的微信的昵称alias 显示在网站里面去
	   *如果是注册操作的话则显示推荐码 recommand type

     */
require_once("../../include/config.inc.php");

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$year=date("Y",time());//获取当前的年份
$month=date("m",time());//获取当前的月份
$Data = "";
     $appid="wx828a39df41ab348d";  //微信小程序id
	 $secret="b4b2de71cbd3286478a511eb087f577e"; //小程序秘钥
	 $xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
	 $erweima_name=date("Ymdhis");
	 $url="uploads/erweima/".$erweima_name.".png";
	 $save_path="../../".$url;         //生成成功之后的二维码地址


$randnumber=rand(100000000,999999999);//随机数
$r=$dosql->GetOne("select * from yzm where phone='$phone'");
$content=$r['code'];                                //验证码
$start_time=$r['start_time'];                       //提交开始时间
$num=$r['num'];                                     //发送验证码的次数
$secs = strtotime($Version)-strtotime($start_time); //计算提交的时间差
//登陆操作{①.不发送活动短信 ②.不注册新的账号 ③.直接登陆操作 }
if($classify==1){
 //填写验证码,匹配验证码的正确性，同时在120s之内提交数据,1天之内发送验证码不超过15次
    if($content==$captcha && $num<15 && $secs <120 ){
	//安卓手机端的CID  clientid  默认游客 100000 devicetype [0] 安卓  [2] ios [1] 小程序  苹果端和安卓端发送新的cid码，微信小程序不需要这个clientid
	if($phone!=100000){
		//执行安卓端登陆操作
		if(isset($clientid)){  //假如存在clientid的值，则执行
		  if($devicetype==0){
		  $ip= getClientIp();
      $city= getcposition_city($ip);  //登陆城市
		  $province= getcposition_prov($ip);//登陆省份
	      $sql = "UPDATE `memberuser` SET clientid='$clientid', devicetype ='$devicetype',prov='$province',city='$city' WHERE Account='$phone'";
	      $dosql->ExecNoneQuery($sql);
		  //登陆之后生成会员的个人缓存文件
		   $row=$dosql->GetOne("SELECT * FROM `memberuser` where Account='$phone'");
		   $cachedate[]=$row;
		   $cachename=$phone;  //会员缓存的名称直接用用户的手机号码
		   GetCache($cachedate,$cachename);
		  }
		}else{
		//执行小程序端登陆操作
          if($devicetype==1){
	       $ip= getClientIp();
         $city= getcposition_city($ip);  //登陆城市
		     $province= getcposition_prov($ip);//登陆省份
	       $sql = "UPDATE `memberuser` SET devicetype ='$devicetype',prov='$province',city='$city' WHERE Account='$phone'";
	       $dosql->ExecNoneQuery($sql);
		   //登陆之后生成会员的个人缓存文件
		   $row=$dosql->GetOne("SELECT * FROM `memberuser` where Account='$phone'");
		   $cachedate[]=$row;
		   $cachename=$phone;  //会员缓存的名称直接用用户的手机号码
		   GetCache($cachedate,$cachename);
		   }
		}
	//更新随机数，登陆成功之后通过判断随机数，证明是否登陆
	$sql = "UPDATE `randnumber` SET number = $randnumber,posttime='$Version' WHERE phone='$phone'";
	$dosql->ExecNoneQuery($sql);
	}

	$r=$dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$phone'");
	$Data[]=$r;
    $State = 1;
    $Descriptor = '登陆成功！';

	$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
        				'Version' => $Version,
        				'Randnumber'=>$randnumber,
        				'Data'=>$Data
               );
    echo phpver($result);
    }else{
	  $State = 0;
    $Descriptor = '登陆失败！';
    $result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
			        	'Version' => $Version,
              );
    echo phpver($result);
	}
}elseif($classify==0){
 //注册操作
 //填写验证码,匹配验证码的正确性，同时在120s之内提交数据,1天之内发送验证码不超过15次
    if($content==$captcha && $num<15 && $secs <120 )	{
	//向数据库里面导入注册信息
	if($phone!=100000){  //当不是游客登陆的时候
	if(isset($clientid)){  //安卓注册操作
	  if($devicetype==0){
	   $idg=rand(1000000000,9999999999);
	   $ip= getClientIp();
       $city= getcposition_city($ip);  //登陆城市
	   $province= getcposition_prov($ip);//登陆省份

	   $randtjm=rand(100000,999999); //随机生成6位数的推荐码
	  //判断随机生成的验证码是否已经存在，如果存在则重新生成新的推荐码
	   $r=$dosql->GetOne("select * from memberuser where Recommand='$randtjm'");
	   if(is_array($r)){
	   $randtjm=rand(100000,999999);
	   }
	   $s=$dosql->GetOne("select * from memberuser where Account='$phone'");
	   if(!is_array($s)){
	   $getcost=date("m");  //获取当前的月份
	   $sql = "INSERT INTO `memberuser`
    (Id, Account,Alias,Phone,CreatTime,clientid,devicetype,prov,city,Recommand,getcost,Image) VALUES ('$idg', '$phone', '$alias','$phone','$Version','$clientid','$devicetype','$province','$city',$randtjm,'$getcost','$image')";
	   $dosql->ExecNoneQuery($sql);
	   //登陆之后生成会员的个人缓存文件
	   $row=$dosql->GetOne("SELECT * FROM `memberuser` where Account='$phone'");
	   $cachedate[]=$row;
     $cachename=$phone;
     //会员缓存的名称直接用用户的手机号码
	   GetCache($cachedate,$cachename);
	   }

	   //生成个人二维码
	   $bilv=$cfg_bilv_huiyuan;
	   $tbname_shangjia = 'memberuser';
	   $access_token=get_access_token($appid,$secret);

     $erweima= save_erweima($access_token,$xiaochengxu_path,$save_path,$url,$randtjm);
     $base64_img = base64EncodeImage("../../".$erweima);

     //请求用户头像
     $img_file = curlRequest($image);
     $img_content= base64_encode($img_file);
     $new_file = "../../uploads/erweima/".$phone.".png";
     file_put_contents($new_file, base64_decode($img_content));


     //将用户头像图片变圆形
     $avatar = file_get_contents($image);
     $logo   = yuanImg($avatar);//返回的是图片数据流

     //微信小程序二维码与头像结合
     $sharePic = qrcodeWithLogo($base64_img,$logo);

     //删除第一次生成的二维码
     unlink("../../".$erweima);

     //将结合之后的图像保存到本地

     $erweima=base64_to_imagecontent($sharePic);



	   $sql = "UPDATE $tbname_shangjia SET bilv='$bilv',erweima='$erweima' where Recommand='$randtjm'";
	   $dosql->ExecNoneQuery($sql);

	     //添加推荐码记录，同时给推荐的商家的酒钱加1酒钱,更新会员的推荐人的记录
	if(isset($recommand) && $recommand!='' && $type==1){
	   $sql = "INSERT INTO `recommand` (account,tjm,rec_time,type,year,month) VALUES ('$phone', '$recommand','$Version',1,'$year','$month')";
	   $dosql->ExecNoneQuery($sql);
	   //将新添加的用户的被推荐人推荐码和用户类型更改
	   $dosql->ExecNoneQuery("UPDATE `memberuser` SET `Yaoqingma`='$recommand',classes='$type' WHERE `Recommand`='$randtjm'");



       //计算商家原来剩余的酒钱数目
	   $r=$dosql->GetOne("select * from commercialuser where Recommand='$recommand'");
	   if(is_array($r)){
		  $jiuqians=$r['JiuQian'];
		  if($jiuqians==""){
			  $jiuqian=1;
		  }else{
			$jiuqian=$r['JiuQian']+1;
		  }
	    //将商家账号里面的酒钱加上1，更新商户的酒钱
	   $dosql->ExecNoneQuery("UPDATE `commercialuser` SET `JiuQian`='$jiuqian' WHERE `Recommand`='$recommand'");
	   }
	   /*如果开启了商户推荐排行活动，则执行以下操作
	    * ①.计算商家推荐的会员人数，并且计算出总的推荐人数
		* ②.计算商家推荐的会员的购买记录，并且计算出总的数目
		*
	    */
		if($cfg_rank=="Y"){
		 	//判断商户在本月之内统计的推荐会员注册的人数
			$year=date("Y");//获取当前的年份
			$month=date("m");//获取当前的月份
			$r=$dosql->GetOne("select * from `pmw_active` where daima='0' and recommand='$recommand' and year='$year' and month='$month'");

		    if(is_array($r)){
			    $num=$r['num']+1;
			    $postdate=date("Y-m-d",time());
				$dosql->ExecNoneQuery("UPDATE `pmw_active` SET `num`=$num,postdate='$postdate' where daima='0' and recommand='$recommand' and year='$year' and month='$month'");
			      }else{
				$postdate=date("Y-m-d",time());
				$sql = "INSERT INTO `pmw_active` (recommand,num,year,month,postdate) VALUES ('$recommand',1,'$year','$month','$postdate')";
	            $dosql->ExecNoneQuery($sql);
			}
		 }

	}
	   //添加推荐码记录，同时给推荐的会员的酒钱加1酒钱,更新会员的推荐人的记录
	   if(isset($recommand) && $recommand!='' && $type==0){
	   $sql = "INSERT INTO `recommand` (account,tjm,rec_time,type,year,month) VALUES ('$phone', '$recommand','$Version',0,'$year','$month')";
	   $dosql->ExecNoneQuery($sql);

	  $dosql->ExecNoneQuery("UPDATE `memberuser` SET `Yaoqingma`='$recommand',classes='$type' WHERE `Recommand`='$randtjm'");

	   $r=$dosql->GetOne("select * from memberuser where Recommand='$recommand'");
	   if(is_array($r)){
			$jiuqian=$r['JiuQian']+1;

	    //将会员账号里面的酒钱加上1，更新会员的酒钱
	   $dosql->ExecNoneQuery("UPDATE `memberuser` SET `JiuQian`='$jiuqian' WHERE `Recommand`='$recommand'");
	   }
	   }
	}
	}else{
	//小程序注册操作
	if($devicetype==1){
	   $ids=rand(1000000000,9999999999);
	   $ip= getClientIp();
       $city= getcposition_city($ip);  //登陆城市
	   $province= getcposition_prov($ip);//登陆省份
	   $randtjm=rand(100000,999999); //随机生成6位数的推荐码
	  //判断随机生成的验证码是否已经存在，如果存在则重新生成新的推荐码
	   $r=$dosql->GetOne("select * from memberuser where Recommand='$randtjm'");
	   if(is_array($r)){
	   $randtjm=rand(100000,999999);
	   }
	   $s=$dosql->GetOne("select * from memberuser where Account='$phone'");
	   if(!is_array($s)){
	   $getcost=date("m");  //获取当前的月份
	   $sql = "INSERT INTO `memberuser` (Id, Account,Alias,Phone,CreatTime,devicetype,prov,city,Recommand,getcost,Image) VALUES ('$ids', '$phone', '$alias','$phone','$Version','$devicetype','$province','$city',$randtjm,'$getcost','$image')";
	   $dosql->ExecNoneQuery($sql);
	  //登陆之后生成会员的个人缓存文件
	   $row=$dosql->GetOne("SELECT * FROM `memberuser` where Account='$phone'");
	   $cachedate[]=$row;
       $cachename=$phone;  //会员缓存的名称直接用用户的手机号码
	   GetCache($cachedate,$cachename);
	   }
	   //生成个人二维码
	   $bilv=$cfg_bilv_huiyuan;
	   $tbname_shangjia = 'memberuser';
	   $access_token=get_access_token($appid,$secret);
     $erweima= save_erweima($access_token,$xiaochengxu_path,$save_path,$url,$randtjm);
     $base64_img = base64EncodeImage("../../".$erweima);

     //请求用户头像
     $img_file = curlRequest($image);
     $img_content= base64_encode($img_file);
     $new_file = "../../uploads/erweima/".$phone.".png";
     file_put_contents($new_file, base64_decode($img_content));


     //将用户头像图片变圆形
     $avatar = file_get_contents($image);
     $logo   = yuanImg($avatar);//返回的是图片数据流

     //微信小程序二维码与头像结合
     $sharePic = qrcodeWithLogo($base64_img,$logo);

     //将结合之后的图像保存到本地

     //删除第一次生成的二维码
     unlink("../../".$erweima);

     $erweima=base64_to_imagecontent($sharePic);



	   $sql = "UPDATE $tbname_shangjia SET bilv='$bilv',erweima='$erweima' where Recommand='$randtjm'";
	   $dosql->ExecNoneQuery($sql);

	    //添加推荐码记录，同时给推荐的商家的酒钱加1酒钱,更新会员的推荐人的记录
	   if(isset($recommand) && $recommand!='' && $type==1){
	  $sql = "INSERT INTO `recommand` (account,tjm,rec_time,type,year,month) VALUES ('$phone', '$recommand','$Version',1,'$year','$month')";

	   $dosql->ExecNoneQuery($sql);
	   $dosql->ExecNoneQuery("UPDATE `memberuser` SET `Yaoqingma`='$recommand',classes='$type' WHERE `Recommand`='$randtjm'");

	   $r=$dosql->GetOne("select * from commercialuser where Recommand='$recommand'");
	    if(is_array($r)){
		  $jiuqians=$r['JiuQian'];
		  if($jiuqians==""){
			  $jiuqian=1;
		  }else{
			$jiuqian=$r['JiuQian']+1;
		   }
	    //将商家账号里面的酒钱加上1，更新商户的酒钱
	   $dosql->ExecNoneQuery("UPDATE `commercialuser` SET `JiuQian`='$jiuqian' WHERE `Recommand`='$recommand'");
	    }
	   /*如果开启了商户推荐排行活动，则执行以下操作
	    * ①.计算商家推荐的会员人数，并且计算出总的推荐人数
		* ②.计算商家推荐的会员的购买记录，并且计算出总的数目
		*
	    */
		if($cfg_rank=="Y"){
		 	//判断商户在本月之内统计的推荐会员注册的人数
			$year=date("Y",time());//获取当前的年份
			$month=date("m",time());//获取当前的月份
			$r=$dosql->GetOne("select * from `pmw_active` where daima='0' and recommand='$recommand' and year='$year' and month='$month'");
		    if(is_array($r)){
			    $num=$r['num']+1;
			    $postdate=date("Y-m-d",time());
				$dosql->ExecNoneQuery("UPDATE `pmw_active` SET `num`=$num,postdate='$postdate' where daima='0' and recommand='$recommand' and year='$year' and month='$month'");
			      }else{
				$postdate=date("Y-m-d",time());
				$sql = "INSERT INTO `pmw_active` (recommand,num,year,month,postdate) VALUES ('$recommand',1,'$year','$month','$postdate')";
	            $dosql->ExecNoneQuery($sql);
			}
		}

	}
	   //添加推荐码记录，同时给推荐的会员的酒钱加1酒钱,更新会员的推荐人的记录
	   if(isset($recommand) && $recommand!='' && $type==0){
	   $sql = "INSERT INTO `recommand` (account,tjm,rec_time,type,year,month) VALUES ('$phone', '$recommand','$Version',0,'$year','$month')";
	   $dosql->ExecNoneQuery($sql);
	   $dosql->ExecNoneQuery("UPDATE `memberuser` SET `Yaoqingma`='$recommand',classes='$type' WHERE `Recommand`='$randtjm'");

	   $r=$dosql->GetOne("select * from memberuser where Recommand='$recommand'");
	   if(is_array($r)){
			$jiuqian=$r['JiuQian']+1;

	    //将会员账号里面的酒钱加上1，更新会员的酒钱
	   $dosql->ExecNoneQuery("UPDATE `memberuser` SET `JiuQian`='$jiuqian' WHERE `Recommand`='$recommand'");
	   }
	   }
	}
	}
	$sql = "INSERT INTO `randnumber` (phone,number,posttime) VALUES ('$phone', '$randnumber','$Version')";
	$dosql->ExecNoneQuery($sql);
	}
	//开启发送活动短信服务{①.在活动截止日期之内 ②.注册成功之后发送短信 }
	//获得当前时间
	$now=strtotime(date('Y-m-d',time()));
	//获得截止时间
	$endtime=strtotime($cfg_deadtime);
	$diff=$endtime-$now;
	$jiuqian= $cfg_jiuqian;
	if($diff>=0){                              //在活动截止日期之内
	$jiuqian= $cfg_jiuqian;                    //注册赠送的酒钱
	$data['Account'] = $cfg_message_id;          //短信接口ID
	$data['Pwd'] 	 = $cfg_message_pwd;         //短信接口密码
	$data['Content'] = $jiuqian;                 //发送的短信内容
	$data['Mobile']	 = $phone;                 //接收短信的号码
	$data['TemplateId']	 = $cfg_message_activity;//短信模板ID
	$data['SignId']	 = $cfg_message_signid;       //签名Id
	$url="http://api.feige.ee/SmsService/Template";
	$res=post($url,$data);
	//注册成功之后，向会员表中添加赠送的酒钱的次数
	$dosql->ExecNoneQuery("UPDATE `memberuser` SET `JiuQian`='$jiuqian',times=1 WHERE `Account`='$phone'");
	}
	 $sql = "INSERT INTO `pmw_sendjiuqjian` (account,year,month,gettime,money,message) VALUES ('$phone', '$year','$month','$Version','$jiuqian',1)";
	 $dosql->ExecNoneQuery($sql);
	$r=$dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$phone'");
	$Data[]=$r;
    $State = 1;
    $Descriptor = '登陆成功！';
	$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
        				'Version' => $Version,
        				'Randnumber'=>$randnumber,
        				'Data'=>$Data
               );
    echo phpver($result);
    }else{
	  $State = 0;
    $Descriptor = '登陆失败！';
    $result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				        'Version' => $Version,
              );
    echo phpver($result);
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

function getcposition_city($ip){
    $ak ="94z0AESTh67HCS6zb9w0MX2tG1hG11jN";
    $res1 = file_get_contents("http://api.map.baidu.com/location/ip?ip=".$ip."&ak=".$ak);
    $res1 = json_decode($res1,true);

// print_r($res1);
   if ($res1[ "status"]==0){
	   $city=$res1['content']['address_detail']['city'];
        return $city;
    }else{
        return "未知";
    }

}
function getcposition_prov($ip){
    $ak ="94z0AESTh67HCS6zb9w0MX2tG1hG11jN";
    $res1 = file_get_contents("http://api.map.baidu.com/location/ip?ip=".$ip."&ak=".$ak);
    $res1 = json_decode($res1,true);

// print_r($res1);
   if ($res1[ "status"]==0){
	   $province=$res1['content']['address_detail']['province'];
        return $province;
    }else{
        return "未知";
    }

}
function getClientIp() {
    $ip = 'unknown';
    $unknown = 'unknown';
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
        // 使用透明代理、欺骗性代理的情况
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
        // 没有代理、使用普通匿名代理和高匿代理的情况
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // 处理多层代理的情况
    if (strpos($ip, ',') !== false) {
        // 输出第一个IP
        $ip = reset(explode(',', $ip));
    }
    return $ip;
}

	//第一步获取token
function get_access_token($appid,$secret) {
    $get_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
    $content = file_get_contents($get_url);
    $content_json = json_decode($content);
    $access_token = $content_json->access_token;
    $expires_in = $content_json->expires_in;
    return $access_token;
}

function save_erweima($access_token,$xiaochengxu_path,$save_path,$url,$randtjm) {
    $post_url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=$access_token";
    $width = '430';
	//前面是推荐码，商户端是1，客户端是0
	$scene=$randtjm.",0";
    $post_data='{"page":"'.$xiaochengxu_path.'","width":'.$width.',"scene":"'.$scene.'"}';
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $post_data
        )
    );
    $context = stream_context_create($opts);
    $result = file_get_contents($post_url, false, $context);
    $file_path = $save_path;
    $bytes = file_put_contents($file_path, $result);
    return $url;
}
/*******************************  下面是功能函数 **********************************/
/**
* curl方法
* @param $url 请求url
* @param $data 传送数据，有数据时使用post传递
* @param type 为2时,设置json传递
*/
function curlRequest($url,$data = null , $type = 1){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        if($type == 2){
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array('Content-Type: application/json','Content-Length: ' . strlen($data)));
        }
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
/**
 * 在二维码的中间区域镶嵌图片
 * @param $QR 二维码数据流。比如file_get_contents(imageurl)返回的东东,或者微信给返回的东东
 * @param $logo 中间显示图片的数据流。比如file_get_contents(imageurl)返回的东东
 * @return  返回图片数据流
 */
 function qrcodeWithLogo($QR,$logo){
    $QR   = imagecreatefromstring ($QR);
    $logo = imagecreatefromstring ($logo);
    $QR_width    = imagesx ( $QR );//二维码图片宽度
    $QR_height   = imagesy ( $QR );//二维码图片高度
    $logo_width  = imagesx ( $logo );//logo图片宽度
    $logo_height = imagesy ( $logo );//logo图片高度
    $logo_qr_width  = $QR_width / 2.2;//组合之后logo的宽度(占二维码的1/2.2)
    $scale  = $logo_width / $logo_qr_width;//logo的宽度缩放比(本身宽度/组合后的宽度)
    $logo_qr_height = $logo_height / $scale;//组合之后logo的高度
    $from_width = ($QR_width - $logo_qr_width) / 2;//组合之后logo左上角所在坐标点
    /**
     * 重新组合图片并调整大小
     * imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
    */
    imagecopyresampled ( $QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height );
    /**
     * 如果想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
     * 并且去掉缓存区函数
     */
    //获取输出缓存，否则imagepng会把图片输出到浏览器
    ob_start();
    imagepng ( $QR );
    imagedestroy($QR);
    imagedestroy($logo);
    $contents =  ob_get_contents();
    ob_end_clean();
    return $contents;
}
/**
 * 剪切图片为圆形
 * @param  $picture 图片数据流 比如file_get_contents(imageurl)返回的东东
 * @return 图片数据流
 */
function yuanImg($picture) {
    $src_img = imagecreatefromstring($picture);
    $w   = imagesx($src_img);
    $h   = imagesy($src_img);
    $w   = min($w, $h);
    $h   = $w;
    $img = imagecreatetruecolor($w, $h);
    //这一句一定要有
    imagesavealpha($img, true);
    //拾取一个完全透明的颜色,最后一个参数127为全透明
    $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
    imagefill($img, 0, 0, $bg);
    $r   = $w / 2; //圆半径
    $y_x = $r; //圆心X坐标
    $y_y = $r; //圆心Y坐标
    for ($x = 0; $x < $w; $x++) {
        for ($y = 0; $y < $h; $y++) {
            $rgbColor = imagecolorat($src_img, $x, $y);
            if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                imagesetpixel($img, $x, $y, $rgbColor);
            }
        }
    }
    /**
     * 如果想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
     * 并且去掉缓存区函数
     */
    //获取输出缓存，否则imagepng会把图片输出到浏览器
    ob_start();
    imagepng ( $img );
    imagedestroy($img);
    $contents =  ob_get_contents();
    ob_end_clean();
    return $contents;
}

//使用PHP对图片进行base64解码输出
function base64EncodeImage ($image_file) {
  $base64_image = '';
  $image_info = getimagesize($image_file);
  $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
  $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
  return $image_data;
}

//PHP将Base64格式图片转为图片格式并保存
/**
 * PHP将Base64格式图片转为图片格式并保存
 * @author 我是超人  * @param  $base64_content 要保存的Base64
 * @param  string $path    本地路径
 */
 function base64_to_imagecontent($base64){
   //匹配出图片的格式
   if (strstr(base64_encode($base64),",")){
    $image = explode(',',base64_encode($base64));
    $base64 = $image[1];
    $img = base64_decode($base64);
    $erweima_name=date("Ymdhis");
    $path="uploads/erweima/"."new_".$erweima_name.".png";
    $url="../../".$path;
    file_put_contents($url, $img);//返回的是字节数
    return $path;
    }else{
    $img = base64_decode(base64_encode($base64));
    $erweima_name=date("Ymdhis");
    $path="uploads/erweima/"."new_".$erweima_name.".png";
    $url="../../".$path;
    file_put_contents($url, $img);//返回的是字节数
    return $path;
    }
 }

?>
