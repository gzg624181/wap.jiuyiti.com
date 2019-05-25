<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';

//模式一
/**
 * 流程：
 * 1、组装包含支付信息的url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
 * 5、支付完成之后，微信服务器会通知支付成功
 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$notify = new NativePay();
$url1 = $notify->GetPrePayUrl("123456789");

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$id=$_GET['id'];
$get_name="GetOrder_Client";
$userid=$_SESSION['commercial'];
$arr = file_get_contents(stripslashes("http://wap.jiuyiti.zrcase.com/api/".$get_name."/index.php?id=".$id));  //去除对象里面的斜杠
$str = json_decode($arr,true);
$ssr=$str['Data'];
$pay=($ssr[0]['PayAmount']+$ssr[0]['PayJiuQian']+$ssr[0]['PayKdMoney']) * 100;
$orderid=$srr[0]['OrderId'];
$product_id=$srr[0]['Id'];
$miaoshu="酒易提订单".$orderid;
$input = new WxPayUnifiedOrder();
$input->SetBody($miaoshu);
$input->SetAttach("酒易提");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee($pay);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("酒易提");
$input->SetNotify_url("https://wap.jiuyiti.zrcase.com/api/weixinpay/pay/notify_url.php");    //通知地址
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($product_id);
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>微信支付样例-退款</title>
</head>
<body>


	<img src="https://wap.jiuyiti.zrcase.com/templates/default/images/WePayLogo.png" style="display:block; margin:0px auto; margin-top:23px;margin-bottom:6px;" width="180px;"/>
	<img alt="模式二扫码支付" src="https://wap.jiuyiti.zrcase.com/api/weixinpay/example/qrcode.php?data=<?php echo urlencode($url2);?>" style="width:150px;height:150px;"/>
  <script>
  function ajaxstatus(){
    $.post("https://wap.jiuyiti.zrcase.com",[orderid:<?php echo $orderid;?>],function (data){
    if(data.status==1){  //订单状态为1表示支付成功
      window.location.href="http://www.baidu.com";
    }
    });
  }
  setInterval("ajaxstatus()",3000);
  </script>
	<div style="margin-left: 10px;margin-top: 14px;color:#556B2F;font-size:12px;font-weight: bolder;">请打开微信扫一扫</div>
</body>
</html>
