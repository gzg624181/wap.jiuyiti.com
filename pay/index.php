<?php
include('./Base.php');
include './phpqrcode/phpqrcode.php';

class WxPay extends Base
{

   //获取构建二维码的URL地址
   public function getQRurl($oid){
       $params = array(
           'appid'             => self::APPID,
           'mch_id'            => self::MCHID,
           'product_id' 	     => $oid,
           'time_stamp' 	     => time(),
           'nonce_str' 	       => md5(time())
       );
    return 'weixin://wxpay/bizpayurl?' . $this->arrToUrl($this->setSign($params));
   }
}
$obj=new WxPay();
if(isset($_GET['pid'])){
QRcode::png($obj->getQRurl($_GET['pid']));
$obj->logs('log.txt','0');
}


 ?>
