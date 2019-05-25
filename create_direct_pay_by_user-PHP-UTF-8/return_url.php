<?php
/* *
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
require_once("../include/config.inc.php");
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码

	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//交易金额
	$total_fee = $_GET['total_fee'];

	//支付的酒钱 （用支付宝支付的话，则支付的酒钱为零，分为两种模式payment：0购买商品 1补货）
	$jiuqian=0;

	//支付类型   (0,支付宝支付 1,微信支付)
	$paytype=0;

	//购买方式
	$payment = $_SESSION['payment'];

	//快递金额
	$kdmoney = $_SESSION['kdmoney'];

    //补货订单号
	$orderids = $_SESSION['orderids'];

	if($payment==0){
	$get_name="OrderPay_Client_Pc";
    $arr = file_get_contents(stripslashes($cfg_website."api/".$get_name."/index.php?payamount=".$total_fee."&jiuqian=".$jiuqian."&orderid=".$out_trade_no."&paytype=".$paytype));  //去除对象里面的斜杠
    $srr = json_decode($arr,true);
	if($srr['State']==1)
	{
    $url=$cfg_website."order-1-1.html";
	header("location:$url");
	}
	}elseif($payment==1){
	//购物成功之后，删除购物临时列表里面的数据
    $dosql->QueryNone("DELETE FROM `pmw_lsshoppingcart` WHERE orderid='$orderid'");

    //支付宝支付，即支付方式 $paymenttype="2";
	 //更新订单的预约状态,付款状态，支付状态
	$sql ="UPDATE `orderform_commercial` SET PayAmount='$total_fee', State=1, PaymentType='2',PayJiuQian='$jiuqian',paytype=0,dingdantype=2,PayKdMoney=$kdmoney WHERE OrderId='$orderid'";
	$dosql->ExecNoneQuery($sql);
	//同时更新商品的销量 ，购买几件在原来的数目上加上目前购买的商品数量
	$dosql->Execute("SELECT * FROM `ordercommodity` WHERE OrderId='$orderid'");
	while($r=$dosql->GetArray()){
	$CommodityId=$r['CommodityId'];  //获取商品Id
	$shuliang=$r['Quantity'];
	$show=$dosql->GetOne("SELECT * FROM `commodity` WHERE Id='$CommodityId'");
	$sours=$show["Num"];
	$num=$shuliang + $sours;
	//更新商品的销量
	$sql ="UPDATE `commodity` SET Num='$num'  WHERE Id='$CommodityId'";
	$dosql->ExecNoneQuery($sql);
	}
	if($orderids!=1)
	$dosql->QueryNone("UPDATE `pmw_lsshoppingcart` SET tag=1  WHERE OrderId='$orderids'");
	}

    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		    //判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
    else {
    echo "trade_status=".$_GET['trade_status'];
    }



	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>支付宝即时到账交易接口</title>
	</head>
    <body>
    </body>
</html>
