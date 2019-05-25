<?php
include('./Base.php');
include('http://wap.jiuyiti.zrcase.com/include/config.inc.php');
class Notify extends Base
{
   public function __construct(){
     parent::__construct();
     //获取微信服务器提交过来的通知数据
     $xml=$this->getPost();
     //将xml格式的数据转换为数组

     $arr=$this->XmlToArr($xml);
     //验证签名

     if($this->CheckSign($arr)){
       //验证订单金额,
       if($this->checkPrice($arr)){
      //更新订单状态
          $orderid=$arr['out_trade_no'];
          $mysql_server_name="localhost"; //数据库服务器名称
          $mysql_username="jiuyiti_wap"; // 连接数据库用户名
          $mysql_password="jiuyiti_wap@)!7%1*"; // 连接数据库密码
          $mysql_database="jiuyiti_wap"; // 数据库的名字
          $conn=mysql_connect($mysql_server_name, $mysql_username,$mysql_password);
          $sqlg="UPDATE `orderform_commercial` SET State='1',logs=2,paytype=1,PaymentType=2 WHERE OrderId='$orderid'";
          mysql_db_query($mysql_database, $sqlg, $conn);
          //$this->logs('log.txt','2');


         $parms=array(
           'return_code'=>'SUCCESS',
           'result_code'=>'OK'
         );
         echo $this->ArrToXml($parms);
       }

     }

   }

   //校验订单金额 根据订单号$arr['out_trade_no'] 在商户系统内查询订单金额 并和$arr['total_fee']做比较
   public function checkPrice($arr){
       if($arr['return_code'] == 'SUCCESS' && $arr['result_code'] == 'SUCCESS'){
            $orderid=$arr['out_trade_no'];
            $mysql_server_name="localhost"; //数据库服务器名称
            $mysql_username="jiuyiti_wap"; // 连接数据库用户名
            $mysql_password="jiuyiti_wap@)!7%1*"; // 连接数据库密码
            $mysql_database="jiuyiti_wap"; // 数据库的名字
            $conn=mysql_connect($mysql_server_name, $mysql_username,$mysql_password);
            $sqlf = "SELECT PayAmount,PayKdMoney FROM `orderform_commercial` WHERE OrderId='$orderid'";  //Sql语句
            $r = mysql_fetch_assoc(mysql_db_query($mysql_database, $sqlf, $conn));
            $PayWeiXin=($r['PayAmount']+$r['PayKdMoney'])*100;
            $this->logs('error.txt',$PayWeiXin);
           if($arr['total_fee'] == $PayWeiXin){ //生产环境需要根据订单号在数据库中查询金额
               return true;
           }else{
               $this->logs('log.txt', '订单金额不匹配!微信支付系统提交过来的金额为' . $arr['total_fee']);
           }
       }else{
               $this->logs('log.txt', '通知状态有误!');
       }
   }

}

new Notify();

 ?>
