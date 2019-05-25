<?php
require_once('../../../include/config.inc.php');
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';


//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);


class PayNotifyCallBack extends WxPayNotify
{

	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
       return true;
		}
	   return false;
	}

	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();

		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		 //根据 $data["out_trade_no"]  订单号 更新订单状态
         //执行更新
    $orderid=$data["out_trade_no"];
	if(strpos($orderid,"a") !== false) {
		$orderid = rtrim($orderid,"a");
	}
   include('./conn.php');
     // 从表中提取信息的sql语句，更改购物的状态

  //  $strsql="UPDATE `orderform` SET State='1' WHERE OrderId='$orderid'";
    // 执行sql查询
 //   mysql_db_query($mysql_database, $strsql, $conn);


	mysql_select_db($mysql_database);
	$sqls="SELECT * FROM `shoppingcart` WHERE Orderid='$orderid'";
	$re=mysql_query($sqls,$conn);
	while($rows=mysql_fetch_array($re)){
	if(is_array($rows)){
	$us[]=$rows;
    }
	                               }
 	$mid=$us[0]['UserId'];

	if(is_array($us)){
//购物成功之后，删除购物列表里面的数据
   $sqld="DELETE FROM `shoppingcart` WHERE Orderid='$orderid'";
    // 执行sql查询
   mysql_db_query($mysql_database, $sqld, $conn);
  //购物成功之后，更新购物的状态，支付的金钱数目   （付款状态，订单状态）

  //state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )

  //换购单：用酒钱购买的商品，订单状态用换购单来标识
  //已退款：购买了商品，但是没有过来提货，可以申请退款，在后台直接申请退款！

  //更新商品订单里面的酒钱，支付的金额，订单状态,支付类型
	//支付类型分为三种：
	//①. 1.酒钱支付
	//②. 2.现金支付
	//③. 3.混合支付
$sqlf = "SELECT * FROM `orderform` WHERE Orderid='$orderid'";  //Sql语句
$ref = mysql_fetch_assoc(mysql_db_query($mysql_database, $sqlf, $conn));
$dt=$ref['dingdantype'];
$payamount=$ref['PayAmount']; //支付的现金
$jiuqian=$ref['PayJiuQian'];    //支付的酒钱
 if(floatval($payamount)>=0 && floatval($payamount)<=0){   //酒钱支付
	 $paymenttype="1";
 }elseif(floatval($jiuqian)>=0 && floatval($jiuqian)<=0){ //现金支付
	 $paymenttype="2";
 }else{  //混合支付
	 $paymenttype="3";
 }

		$sqlg="UPDATE `orderform` SET State='1', PaymentType='$paymenttype',paytype=1 WHERE OrderId='$orderid'";
		// 执行sql查询
		mysql_db_query($mysql_database, $sqlg, $conn);

		//微信发送支付成功模板消息
 	   include('sendmessage.php');

    //如果商家用酒钱来支付，同时账号里面减去消费完的酒钱
$jqs=floatval($jiuqian);
if($jqs != 0){
$sqlh = "select * from memberuser where Id='$mid'";  //Sql语句
$go = mysql_fetch_assoc(mysql_db_query($mysql_database, $sqlh, $conn));
$jq=floatval($go['JiuQian']) - $jqs;
// echo $jq;
$sqli="UPDATE `memberuser` SET JiuQian='$jq'  WHERE Id='$mid'";
    // 执行sql查询
mysql_db_query($mysql_database, $sqli, $conn);
}

//同时更新商品的销量 ，购买几件在原来的数目上加上目前购买的商品数量

mysql_select_db($mysql_database);
$sqlj="SELECT * FROM `ordercommodity` WHERE OrderId='$orderid'";
$res=mysql_query($sqlj,$conn);
while($r=mysql_fetch_array($res)){
$CommodityId=$r['CommodityId'];  //获取商品Id
$shuliang=$r['Quantity'];
$sqlk = "SELECT * FROM `commodity` WHERE Id='$CommodityId'";  //Sql语句
$show = mysql_fetch_assoc(mysql_db_query($mysql_database, $sqlk, $conn));
$sours=$show["Num"];
//file_put_contents('openid.txt',$show);
$num=$shuliang + $sours;
//更新商品的销量
$sqll="UPDATE `commodity` SET Num='$num'  WHERE Id='$CommodityId'";
    // 执行sql查询
mysql_db_query($mysql_database, $sqll, $conn);
}

}
	return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
