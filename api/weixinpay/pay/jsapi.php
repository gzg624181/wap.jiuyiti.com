<?php

require_once('../../../include/config.inc.php');

$dodosql=$dosql;
$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();
$form =array();
$posttime=substr($Version,0,10);
date_default_timezone_set("PRC");                //设置时区
$city= getcposition();    //城市
$province=getcposition_prov();//省份
if($orderid==-1){
$orderid=date('YmdHis') . rand(1000,9999);      //订单号
$arr=stripslashes($commodityinfo);
$str=json_decode($arr,true);
// 向数据库里面导入商品订单生成接口
// state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
    $id= rand(100000000,999999999);               //订单id
	$tiquma=str_shuffle(substr($orderid,-6));    //订单提取码的后面6位，并且将顺序随机排列
    //判断是否是注册的会员，
	$r=$dodosql->GetOne("select * from memberuser where Account='$userid'");
	if(is_array($r)){
		//生成订单
		$sql = "INSERT INTO `orderform` (Id, OrderId, UserId, CreatTime,posttime,State,tiquma) VALUES ('$id', '$orderid','$userid','$Version','$posttime','$state','$tiquma')";
		$dodosql->ExecNoneQuery($sql);
		//订单生成完毕之后，更新购物车列表里面的数量，订单
		for ($i = 0; $i < count($str); $i++) {
			$CommodityId = $str[$i]['CommodityId'];  //商品Id
			$Quantity     = $str[$i]['Quantity'];     //商品数量
			//购买时候修改购买的数量,更新购物车里面订单的状态
			$r=$dodosql->GetOne("select * from memberuser where Account='$userid'");
			$ids=$r['Id'];
			$sql ="UPDATE `shoppingcart` SET Orderid='$orderid', CommodityNumber='$Quantity' WHERE `CommodityId`='$CommodityId' and UserId='$ids'";
			$dodosql->ExecNoneQuery($sql);

		// 向商家的数据库里面添加购买的记录
			$sql = "INSERT INTO `ordercommodity` (OrderId, CommodityId, Quantity, CreatTime,posttime) VALUES ('$orderid', '$CommodityId','$Quantity','$Version','$posttime')";
			$dodosql->ExecNoneQuery($sql);
		}
	$pay=$payamount * 100;   //商品的总金额

	//更新订单的酒钱和现金数目
	$sql ="UPDATE `orderform` SET PayAmount='$payamount',PayJiuQian='$jiuqian',prov='$province',city='$city' WHERE OrderId='$orderid'";
	$dodosql->ExecNoneQuery($sql);

	//向数据库里面导入预约信息或者快递信息
	if(isset($address) && $address!=""){ //预约订单
	$sql ="UPDATE `orderform` SET address='$address',time='$time',dingdantype=1 where OrderId='$orderid'";
	}elseif(isset($kd_name) && $kd_name!=""){
	$Commercial="kd_admin";
	$sql ="UPDATE `orderform` SET dingdantype=2,Commercial='$Commercial',kd_name='$kd_name',kd_phone='$kd_phone',kd_area='$kd_area',kd_street='$kd_street',kd_address='$kd_address' where OrderId='$orderid'";
	$dosql->ExecNoneQuery($sql);
	$r=$dosql->GetOne("SELECT UserId from orderform where OrderId='$orderid'");
	$userid=$r['UserId'];
	//更新用户的收货信息
	$sql ="UPDATE `memberuser` SET kd_name='$kd_name',kd_phone='$kd_phone',kd_area='$kd_area',kd_street='$kd_street',kd_address='$kd_address' where Account='$userid'";
  $dosql->ExecNoneQuery($sql);
	}

	//获取订单详情
	$rows = $dodosql->GetOne("SELECT * FROM `orderform` WHERE OrderId='$orderid'");
	if(is_array($rows)){
		$form[]=$rows;
	}
	}
}else{
	$pay=$payamount * 100;   //商品的总金额
	//更新订单的酒钱和现金数目
	$sql ="UPDATE `orderform` SET PayAmount='$payamount',PayJiuQian='$jiuqian',prov='$province',city='$city' WHERE OrderId='$orderid'";
	$dodosql->ExecNoneQuery($sql);
	//向数据库里面导入预约信息或者快递信息
	if(isset($address) && $address!=""){
	$sql ="UPDATE `orderform` SET address='$address',time='$time',dingdantype=1  where OrderId='$orderid'";
	}elseif(isset($kd_name) && $kd_name!=""){
	$Commercial="kd_admin";
	$sql ="UPDATE `orderform` SET dingdantype=2,Commercial='$Commercial',dingdantype=2,kd_name='$kd_name',kd_phone='$kd_phone',kd_area='$kd_area',kd_street='$kd_street',kd_address='$kd_address'  where OrderId='$orderid'";
	$dosql->ExecNoneQuery($sql);
	$r=$dosql->GetOne("SELECT UserId from orderform where OrderId='$orderid'");
	$userid=$r['UserId'];
	//更新用户的收货信息
	$sql ="UPDATE `memberuser` SET kd_name='$kd_name',kd_phone='$kd_phone',kd_area='$kd_area',kd_street='$kd_street',kd_address='$kd_address' where Account='$userid'";
  $dosql->ExecNoneQuery($sql);
	}

	$rows = $dodosql->GetOne("SELECT * FROM `orderform` WHERE OrderId='$orderid'");
	if(is_array($rows)){
		$form[]=$rows;
	}
//	echo $orderid;
	$orderid = $orderid."a";
//	echo $orderid;
}


ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);


//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();
//file_put_contents('openid.txt', $openId);
//更新用户的openid
$dodosql->ExecNoneQuery("UPDATE `memberuser` SET openid='$openId' where Account='$userid'");

//②、统一下单
$miaoshu="酒易提订单".$orderid;
$input = new WxPayUnifiedOrder();
$input->SetBody($miaoshu);   //商品描述
$input->SetAttach("酒易提");    //附加数据
$input->SetOut_trade_no($orderid);                             //系统生成商户订单号
$input->SetTotal_fee($pay);                                      //订单总金额，单位为分
$input->SetTime_start(date("YmdHis"));                        //交易起始时间
$input->SetTime_expire(date("YmdHis", time() + 600));         //交易结束时间
$input->SetGoods_tag("酒易提");                                //商品标记
$input->SetNotify_url("https://wap.jiuyiti.zrcase.com/api/weixinpay/pay/notify.php");    //通知地址
$input->SetTrade_type("JSAPI");                              //交易类型
$input->SetOpenid($openId);                                 //用户标识
$order = WxPayApi::unifiedOrder($input);
$jsApiParameters = $tools->GetJsApiParameters($order);
$results = print_r($jsApiParameters, true);
file_put_contents('log.txt', $results);
printf_info($order,$form);


//获取共享收货地址js函数参数
//$editAddress = $tools->GetEditAddressParameters();
//打印输出数组信息

function printf_info($data,$form)
{
$State = 1;
$Descriptor = '数据查询成功！';
$Data[]=$data;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
                'Data' => $Data,
				        'FORM'=>$form
                 );
echo phpver($result);
}
//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
//lat 纬度值
//lng 经度值
function getcposition(){
$ak ="94z0AESTh67HCS6zb9w0MX2tG1hG11jN";
global $lat;
global $lng;
$url="http://api.map.baidu.com/geocoder/v2/?ak=".$ak."&location=".$lat.",".$lng."&output=json&pois=1";
    $res1 = file_get_contents($url);
    $res1 = json_decode($res1,true);

// print_r($res1);
   if ($res1[ "status"]==0){
	  // $province=$res1['result']['addressComponent']['province'];
	   $city=$res1['result']['addressComponent']['city'];
        return $city;
    }else{
        return "未知";
    }
}

function getcposition_prov(){
$ak ="94z0AESTh67HCS6zb9w0MX2tG1hG11jN";
global $lat;
global $lng;
$url="http://api.map.baidu.com/geocoder/v2/?ak=".$ak."&location=".$lat.",".$lng."&output=json&pois=1";
    $res1 = file_get_contents($url);
    $res1 = json_decode($res1,true);

// print_r($res1);
   if ($res1[ "status"]==0){
	   $province=$res1['result']['addressComponent']['province'];
	  // $city=$res1['result']['addressComponent']['city'];
        return $province;
    }else{
        return "未知";
    }
}
?>
