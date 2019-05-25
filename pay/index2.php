<?php
include('Base.php');
include 'phpqrcode/phpqrcode.php';

class WeiXinPay2 extends Base
{
    //调用统一下单API，后去二维码支付链接，模式二的有效時間只有2个小时
    public function getQrUrl($pid,$fee){
      $params = array(
        'appid'=> self::APPID,
         'mch_id'=> self::MCHID,
         'nonce_str'=>md5(time()),
         'body'=> ' 酒易提订单-'.$pid,
         'out_trade_no'=> $pid,
         'total_fee'=> $fee * 100,
         'spbill_create_ip'=>$_SERVER['SERVER_ADDR'],
         'notify_url'=> self::NOTIFY,
         'trade_type'=>'NATIVE',
         'product_id'=>$pid
      );
      $arr=  $this->unifiedorder($params);
      return $arr['code_url'];
    }
}

$obj = new WeiXinPay2();

$qrurl = $obj->getQrUrl($_GET['pid'],$_GET['fee']);


 //2.生成二维码
QRcode::png($qrurl);

$obj->logs('log.txt', '0');
 ?>
