<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2017 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'orderform';
$gourl  = 'allorder.php';


//引入操作类
require_once(ADMIN_INC.'/action.product.class.php');

//发送快递信息的步骤
/*
  ①.更新用户的物流订单信息
  ②.更新快递订单的订单号
  ③.发送快递短信到用户的手机号码
*/
if($action == 'kd_state')
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
	$dosql->ExecNoneQuery("UPDATE `orderform` SET kd_state=1,State=8,duanxin=1,kd_exp='$kd_exp',kd_number='$kd_number',TakeTime='$taketime' WHERE `OrderId`='$orderid'");
	//同时将会员的酒钱和推荐的人的酒钱添加到会员和推荐人的账号里面去

	// 一.userid  会员的账号，
	$g = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$userid'");
	//$jiuqian_user 会员购买商品返回的酒钱
	$JiuQian=intval($huiyuanjiuqian)+intval($g['JiuQian']);  //向账号中添加会员的酒钱
	$sql ="UPDATE `memberuser` SET JiuQian='$JiuQian' WHERE `Account`='$userid'";
	$dosql->ExecNoneQuery($sql);

	//判断会员是否有推荐人，如果有的话就按照提成比例返酒钱给推荐人
	if($g['Yaoqingma']!="" && $g['classes']!=""){
	$recommand=$g['Yaoqingma']; //推荐人的邀请码
	$classes=$g['classes'];  //推荐人的类型
	if($classes==0){         //推荐人是会员
	$table="memberuser";
	$type=0;                 //推荐人是商户
	}elseif($classes==1){
	$table="commercialuser";
	$type=1;
	}
  $kk = $dosql->GetOne("SELECT * FROM $table WHERE Recommand='$recommand'");	//查询推荐人账号里面的酒钱
	$bilvs=$kk['bilv'];
	$bilv=floatval($kk['bilv'] /100);
	$fanjiuqian=intval(intval($sum_price) * $bilv);
	$jiuqian=intval($kk['JiuQian'])+ $fanjiuqian;
    $dosql->ExecNoneQuery("UPDATE $table SET JiuQian='$jiuqian' WHERE Recommand='$recommand'");
		//将推荐消费记录保存到数据库中来
	$Version=date("Y-m-d H:i:s");
	$dosql->ExecNoneQuery("INSERT INTO `recommandlist`(account,tjm,money,bilv, sum_money,posttime,type)
	VALUES ('$userid','$recommand', '$sum_price', '$bilvs', '$fanjiuqian','$Version','$type')");
	}
	//快递商品发货之后，添加当月的快递商品销量
	$dosql->Execute("select * from ordercommodity where OrderId='$orderid'");
	while($rows=$dosql->GetArray()){
   $commodityId=$rows['CommodityId'];  //商品id
	 $quantity=$rows['Quantity'];        //商品购买的件数
	 $thisyear=date("Y",time());
 	 $thismonth=date("m",time());
 	 $c=$dosql->GetOne("select * from commodity_month_nums where commodityid_id='$commodityId' and year=$thisyear and month=$thismonth");
 	 if(is_array($c)){
 		 $changenums=$c['month_nums']+$quantity;
 		 $dosql->ExecNoneQuery("update commodity_month_nums set month_nums=$changenums  where commodityid_id='$commodityId'");
		 //添加商品表的总销量
		 $k=$dosql->GetOne("select * from commodity where Id='$commodityId'");
		 if(is_array($k)){
			 $changeNum= $k['Num']+$quantity;  //添加购买的商品销量
			 $dosql->ExecNoneQuery("update commodity set Num=$changeNum where Id='$commodityId'");
		 }

 	 }else{
 		 $month_nums=$quantity;  //商品购买件数
 		 $dosql->ExecNoneQuery("insert into commodity_month_nums(commodityid_id,year,month,month_nums) values ('$commodityId',$thisyear,$thismonth,$month_nums)");
		 //添加商品表的总销量
		 $k=$dosql->GetOne("select * from commodity where Id='$commodityId'");
		 if(is_array($k)){
			 $changeNum= $k['Num']+$quantity;  //添加购买的商品销量
			 $dosql->ExecNoneQuery("update commodity set Num=$changeNum where Id='$commodityId'");
		 }
 	 }
	}
	$gourls="express.php?userid=".$userid."&orderid=".$orderid;
	ShowMsg('快递短信发送成功！',$gourls);
	exit();
	}else{
    $gourls="express.php?userid=".$userid."&orderid=".$orderid;
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
	$dosql->ExecNoneQuery("UPDATE `orderform` SET sjkd_state=1,sjkd_duanxin=1,sjkd_exp='$sjkd_exp',sjkd_number='$sjkd_number' WHERE `OrderId`='$orderid'");
	$gourls="sj_express.php?address=".$address."&orderid=".$orderid;
	ShowMsg('快递短信发送成功！',$gourls);
	exit();
	}else{
	$gourls="sj_express.php?address=".$address."&orderid=".$orderid;
	ShowMsg('快递短信发送失败，请重新发送！',$gourls);
	}
}else if($action == 'savediscout')
{
	$gourl="discout_sh.php";
	$tbnames = '#@__discout';
	if($rulenameadd != '')
	{
		$dosql->ExecNoneQuery("INSERT INTO `$tbnames` (rulename, rulefirst, ruleend, rulemoney,ruletubiao,orderid) VALUES ('$rulenameadd', '$rulefirstadd', '$ruleendadd', '$rulemoneyadd','$ruletubiaoadd','$orderidadd')");
	}

	if(isset($id))
	{
		$ids = count($id);
		for($i=0; $i<$ids; $i++)
		{
			$dosql->ExecNoneQuery("UPDATE `$tbnames` SET rulename='$rulename[$i]', rulefirst='$rulefirst[$i]', ruleend='$ruleend[$i]', ruletubiao='$ruletubiao[$i]', rulemoney='$rulemoney[$i]',  orderid='$orderid[$i]' WHERE id=$id[$i]");
		}
	}

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
?>
