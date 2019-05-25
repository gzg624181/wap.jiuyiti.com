<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 17:16:14
person: Feng
**************************
*/


//初始化参数
$tbname = 'memberuser';
$gourl  = 'member.php';


//引入操作类
require_once(ADMIN_INC.'/action.product.class.php');


//添加会员
if($action == 'add')
{
	$prov="湖北省";
	$city="武汉市";
	$getcost=date("m");
	$randtjm=rand(100000,999999);
	$bilv=$cfg_bilv_huiyuan;
	$appid=$cfg_appid;  //微信小程序id
	$secret=$cfg_appsecret; //小程序秘钥
	$xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
	$erweima_name=date("Ymdhis");
	$url="uploads/erweima/".$erweima_name.".png";
	$save_path="../".$url;         //生成成功之后的二维码地址
	$access_token=get_access_token($appid,$secret);
	$erweima= save_erweima($access_token,$xiaochengxu_path,$save_path,$url,$randtjm);
  //生成带用户头像的二维码
	$base64_img = base64EncodeImage("../".$erweima);

	$new_file = base64EncodeImagetodata("../".$picurl);

	//将用户头像图片变圆形
	$avatar = file_get_contents($new_file);
	$logo   = yuanImg($avatar);//返回的是图片数据流
	//微信小程序二维码与头像结合
	$sharePic = qrcodeWithLogo($base64_img,$logo);

	//删除第一次生成的二维码
	unlink("../".$erweima);

	//将结合之后的图像保存到本地
	$erweima=base64_to_imagecontent($sharePic);

	$sql = "INSERT INTO `$tbname` (Id,prov,city,Alias, getcost, Recommand,bilv,erweima, Phone, Account, CreatTime, Image, JiuQian, devicetype,orderid) VALUES ('$Id', '$prov','$city', '$Alias', '$getcost', '$randtjm', '$bilv', '$erweima','$Phone', '$Account', '$CreatTime', '$picurl','$JiuQian',1, '$orderid')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}
//添加商品分类
elseif($action == 'fenlei_add')
{
    $tbname = '#@__fenlei';
	$creatime    =  date("Y-m-d h:i:s",time());
	$sql = "INSERT INTO `$tbname` (fenlei,creatime) VALUES ('$fenlei', '$creatime')";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="fenlei_add.php";
		header("location:$gourl");
		exit();
	}
}

//修改会员信息
else if($action == 'update')
{
  if(!isset($UserName)) $UserName = '';
	if(!isset($Phone)) $Phone = '';
	if(!isset($Alias)) $Alias = '';
	if(!isset($Age)) $Age = '';
	if(!isset($picurl)) $picurl = '';
	if(!isset($Sex)) $Sex = '';
	if(!isset($IdNumber)) $IdNumber = '';

			$sql = "UPDATE `$tbname` SET ";
			if($JiuQian != '')
			{
				$sql .= "UserName='$UserName', Phone='$Phone', Alias='$Alias', Age='$Age', Image='$picurl', Sex='$Sex', IdNumber='$IdNumber', JiuQian='$JiuQian' WHERE Id='$id'";
			}else{
				$sql .= "UserName='$UserName', Phone='$Phone', Alias='$Alias', Age='$Age', Image='$picurl', Sex='$Sex', IdNumber='$IdNumber' WHERE Id='$id'";
			}
			$dosql->ExecNoneQuery($sql);

			$bilv=$cfg_bilv_huiyuan;
			$appid=$cfg_appid;  //微信小程序id
			$secret=$cfg_appsecret; //小程序秘钥
			$xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
			$erweima_name=date("Ymdhis");
			$url="uploads/erweima/".$erweima_name.".png";
			$save_path="../".$url;         //生成成功之后的二维码地址
			$access_token=get_access_token($appid,$secret);
			$erweima= save_erweima($access_token,$xiaochengxu_path,$save_path,$url,$randtjm);
		  $base64_img = base64EncodeImage("../".$erweima);

			if(strpos($picurl,'uploads')===false){ //网络地址头像
				$avatar = file_get_contents($picurl);
      }else{
		    $new_file = base64EncodeImagetodata("../".$picurl);
				//将用户头像图片变圆形
				$avatar = file_get_contents($new_file);
		  }

		 $logo   = yuanImg($avatar);//返回的是图片数据流
		 //微信小程序二维码与头像结合
		 $sharePic = qrcodeWithLogo($base64_img,$logo);

		 //删除第一次生成的二维码
		 unlink("../".$erweima);

		 //将结合之后的图像保存到本地
		 $erweima=base64_to_imagecontent($sharePic);

		 $sql = "UPDATE $tbname SET erweima='$erweima' where Id='$id'";

			if($dosql->ExecNoneQuery($sql))
			{
				include("api/Api_GetMemberUserInfo.php");      //修改会员信息之后，更新会员缓存
				header("location:$gourl");
				exit();
			}
}elseif($action=="update_cache"){                           //更新所有单个的会员缓存数据
	$sql="select * from `$tbname`";
	$dosql->Execute($sql);
	$i=0;
   while($i<$dosql->GetTotalRow())
    {
	$date[$i]=$row = $dosql->GetArray();

	$cachename=$row['Account'];
	GetCache($date[$i],$cachename);	                      //更新所有的会员商品的缓存数据
	$i++;
	}

	ShowMsg("缓存数据更新成功",$gourl);
}
//删除商品类型类型
elseif($action == 'del4')
{
	$tbname = '#@__fenlei';
	$sql = "delete from `$tbname` where id=$id";

	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="fenlei_add.php";
		header("location:$gourl");
		exit();
	}
}


//修改商品分类
else if($action == 'fenlei_update')
{
	$dosql->ExecNoneQuery("UPDATE `#@__fenlei` SET `fenlei`='$fenlei' WHERE `id`='$id'");
	ShowMsg('分类修改成功！','fenlei_add.php');
	exit();
}
//发放注册的奖励
else if($action == 'sendreg')
{
     //当注册的会员数量比较多时，则会发生Update更新断开
     $year=date("Y");
	 $month=date("m");  //获取当前的月份
	 $gettime=date("Y-m-d h:i:s");
	 /*
	 ①.去除本月注册的会员，不需要给他添加酒钱
	 ②.给会员添加酒钱的同时，次数添加一次
	 ③.当添加的次数等于12次的时候，则不再添加，同时发送短信提示，我们赠送的120酒钱全部赠送完毕。
	 ④.当本次发放的次数发放完毕之后，则本次不添加
	 ⑤.发送完毕之后，发送短信提示，
	 */
	 foreach($checkid as $k=>$id){
	 $row = $dosql->GetOne("SELECT * FROM `memberuser`  where  month <> '$month' and times <> '12' and Id='$id'");
	 if(is_array($row) && $row['getcost']!=$month){
	 $times=$row['times'];    //会员账号里面赠送酒钱的次数
     $jiuqian=$row['JiuQian'];//会员账号里面目前拥有的酒钱
	 $Account=$row['Account'];//接收短信的号码
	 $alias=$row['Alias'];    //会员昵称
	 $number=$times+1;
     $lastjiuqian=$jiuqian+$cfg_jiuqian; // 添加赠送的酒钱之后的账户的酒钱,更改账户的酒钱
	 //向会员发送短信通知
	 $jiuqians= $cfg_jiuqian;                     //注册赠送的酒钱
	 $data['Account'] = $cfg_message_id;          //短信接口ID
	 $data['Pwd'] 	  = $cfg_message_pwd;         //短信接口密码
	 $data['Content'] = $alias.'||'.$jiuqians;    //发送的短信内容
	 $data['Mobile']  = $Account;                 //接收短信的号码
	 if($number==12){ //当赠送次数达到12次的时候，发送短信内容通知不一样
	 $data['TemplateId']	 = $cfg_sendstop;//短信模板ID
	 }else{
	 $data['TemplateId']	 = $cfg_senreg;//短信模板ID
	 }
	 $data['SignId']	 = $cfg_message_signid;       //签名Id
	 $url="http://api.feige.ee/SmsService/Template";
	 $res=post($url,$data);

	 $datas= json_decode($res,true);
	 $Code= $datas["Code"];
	 //echo "<br>";！
	 $Message= $datas["Message"];
	 //echo $Message;

	   if($Code == 0 && $Message=="OK")
	   { //当短信发送成功的时候，则更改用户里面的酒钱
	   $dosql->ExecNoneQuery("UPDATE `memberuser` SET `JiuQian`='$lastjiuqian',times='$number',getcost=$month WHERE `Id`='$id'");
	   //同时添加奖励记录
	   $dosql->ExecNoneQuery("INSERT INTO `pmw_sendjiuqjian` (account,year,month,gettime,money,message) VALUES ('$Account', '$year','$month','$gettime','$cfg_jiuqian',1)");
	   }
	 }
	 }
	 //当全部发放完毕之后，记录此次添加记录的年月，做好记录
	 $tbnames = '#@__jilucishu';
	 $r=$dosql->GetOne("SELECT * FROM $tbnames  where year='$year' and month='$month'");
	 if(!is_array($r)){
	 $sql = "INSERT INTO `$tbnames` (year,month,posttime,money) VALUES ('$year','$month','$gettime','$cfg_jiuqian')";
	 $dosql->ExecNoneQuery($sql);
	 }

	$msg="会员注册".$year."-".$month."月返现".$cfg_jiuqian."元酒钱现已发放完毕！";
	ShowMsg($msg,'member.php');
	exit();


}
//删除推荐会员
else if($action == 'del2_tuijian')
{
	$tbname = 'recommand';
	$sql = "delete  from `$tbname` where id=$id";
	$dosql->ExecNoneQuery($sql);

	$s = $dosql->GetOne("select num from `#@__active` where recommand='$recommand' and year='$year' and month='$month'");

	$nums =intval($s['num'])-1;

	$dosql->ExecNoneQuery("UPDATE `#@__active` SET num=$nums where recommand='$recommand' and year='$year' and month='$month'");

	$gourls="recommandtj_xiangqing.php?year=".$year."&month=".$month."&commercial=".$commercial;
	ShowMsg('推荐会员删除成功！',$gourls);
	exit();

}
//发放推荐奖励
else if($action == 'sendall')
{
	//print_r($checkid);
	foreach($checkid as $k=>$id){
	$r = $dosql->GetOne("SELECT * FROM `#@__active` where id=$id");
	$recommand=$r['recommand'];
	$num=$r['num'];
	$year=$r['year'];
	$month=$r['month'];
	$s = $dosql->GetOne(" SELECT * from commercialuser where Recommand='$recommand' ");
	if(is_array($s)){
	$jiuqian=$s['JiuQian'];
	if($jiuqian==""){
		$jiuqian=0;
	}
	}else{
	$jiuqian=0;
	}

	//根据推荐的人数的多少来进行匹配，从而给商家账号添加相对应的酒钱奖励
	$dosql->Execute("SELECT * from `#@__rule` where daima=1");
	while($row=$dosql->GetArray()){
	$rulefirst=$row['rulefirst']; //推荐起始人数
	$ruleend=$row['ruleend'];    //推荐截至时间
	if($num >= $rulefirst && $num<$ruleend){
	$money=$row['rulemoney'];
														}
	}
	$lastjiuqian=$jiuqian+$money;  //向商家的账号里面添加奖励的酒钱
	$dosql->ExecNoneQuery("UPDATE commercialuser SET `JiuQian`='$lastjiuqian' WHERE Recommand='$recommand'");

	//同时更改推荐奖励表里面的商户的发放记录，(0,未发放，1,已经发放)
	$dosql->ExecNoneQuery("UPDATE `#@__active` SET checkplay=1 WHERE id=$id");

	//同时添加奖励的记录表
	$tablename="#@__reward";
	$gettime=date("Y-m-d H:i:s");
	$sql = "INSERT INTO $tablename (tjm,money,num,year,month,gettime) VALUES ('$recommand', '$money', $num ,'$year','$month','$gettime')";
	$dosql->ExecNoneQuery($sql);
	}
	ShowMsg('推荐奖励发放成功！','recommandtj_month.php?year='.$year.'&month='.$month);
	exit();
}
//发放单个推荐奖励
else if($action == 'sendnone')
{

	$r = $dosql->GetOne("SELECT * FROM `#@__active` where id=$id");
	$recommand=$r['recommand'];
	$num=$r['num'];
	$year=$r['year'];
	$month=$r['month'];
	$thismonth=date("m");
	if($thismonth==$month){
	ShowMsg('推荐发放不能在当月结算！','recommandtj_month.php?year='.$year.'&month='.$month);
	}else{
	$s = $dosql->GetOne(" SELECT * from commercialuser where Recommand='$recommand' ");
	if(is_array($s)){
	$jiuqian=$s['JiuQian'];
	if($jiuqian==""){
		$jiuqian=0;
	}
	}else{
	$jiuqian=0;
	}

	//根据推荐的人数的多少来进行匹配，从而给商家账号添加相对应的酒钱奖励
	$dosql->Execute("SELECT * from `#@__rule` where daima=1");
	while($row=$dosql->GetArray()){
	$rulefirst=$row['rulefirst']; //推荐起始人数
	$ruleend=$row['ruleend'];    //推荐截至时间
	if($num >= $rulefirst && $num<$ruleend){
	$money=$row['rulemoney'];
														}
	}
	$lastjiuqian=$jiuqian+$money;  //向商家的账号里面添加奖励的酒钱
	$dosql->ExecNoneQuery("UPDATE commercialuser SET `JiuQian`='$lastjiuqian' WHERE Recommand='$recommand'");

	//同时更改推荐奖励表里面的商户的发放记录，(0,未发放，1,已经发放)
	$dosql->ExecNoneQuery("UPDATE `#@__active` SET checkplay=1 WHERE id=$id");

	//同时添加奖励的记录表
	$tablename="#@__reward";
	$gettime=date("Y-m-d H:i:s");
	$sql = "INSERT INTO $tablename (tjm,money,num,year,month,gettime) VALUES ('$recommand', '$money', $num ,'$year','$month','$gettime')";
	$dosql->ExecNoneQuery($sql);

	ShowMsg('推荐奖励发放成功！','recommandtj_month.php?year='.$year.'&month='.$month);
	exit();
	}
}
//无条件返回
else
{
    header("location:$gourl");
	exit();
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

	//第一步获取token
	$appid=$cfg_appid;  //微信小程序id
	$secret=$cfg_appsecret; //小程序秘钥
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

function base64EncodeImagetodata ($image_file) {
	$base64_image = '';
	$image_info = getimagesize($image_file);
	$image_data = fread(fopen($image_file, 'r'), filesize($image_file));
	$base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
	return $base64_image;
}

//PHP将Base64格式图片转为图片格式并保存

 function base64_to_imagecontent($base64){
	 //匹配出图片的格式
	 if (strstr(base64_encode($base64),",")){
		$image = explode(',',base64_encode($base64));
		$base64 = $image[1];
		$img = base64_decode($base64);
		$erweima_name=date("Ymdhis");
		$path="uploads/erweima/"."new_".$erweima_name.".png";
		$url="../".$path;
		file_put_contents($url, $img);//返回的是字节数
		return $path;
		}else{
		$img = base64_decode(base64_encode($base64));
		$erweima_name=date("Ymdhis");
		$path="uploads/erweima/"."new_".$erweima_name.".png";
		$url="../".$path;
		file_put_contents($url, $img);//返回的是字节数
		return $path;
		}
 }
?>
