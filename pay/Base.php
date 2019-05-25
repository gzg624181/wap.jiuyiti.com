<?php

class Base
{
  const APPID='wx828a39df41ab348d';
  const MCHID='1486783092';
  const KEY='rhQYxtuPUeVo40cg3DZ202BdInpppz0q';
  const UOURL = 'https://api.mch.weixin.qq.com/pay/unifiedorder'; //无需更改 统一下单API地址
  const NOTIFY = 'http://wap.jiuyiti.zrcase.com/pay/notify.php';   //支付通知地址需要更改成你自己服务器的地址


  function __construct(){

   }
    //获取签名
  public function getSign($arr){
    //去除数组的空值
    array_filter($arr);
    if(isset($arr['sign'])){
      unset($arr['sign']);
    }
    //排序
    ksort($arr);
    //组装字符串
   $str= $this->arrToUrl($arr)."&key=".self::KEY;
    //使用md5加密,并且转换成大写
   return strtoupper(md5($str));
  }

    //检验签名
  public function CheckSign($arr){
      //生成新签名
      $sign=$this->getSign($arr);
      //和数组中原始签名比较
      if($sign==$arr['sign']){
        return true;
      }else{
        return false;
       }
    }

   //数组转URL字符，不带key值
  public function arrToUrl($arr){
    //URLEncode就是将URL中特殊部分进行编码。URLDecoder就是对特殊部分进行解码。
   return   urldecode(http_build_query($arr));
  }

 //获取带签名的数组
  public function setSign($arr){
    $arr['sign']=$this->getSign($arr);
    return $arr;
  }

  //记录到文件
  public  function logs($file,$data){
      $data = is_array($data) ? print_r($data,true) : $data;
      file_put_contents('./logs/' .$file, $data);
  }

  public function getPost(){
      return file_get_contents('php://input');
  }

  //XML文件转数组
  public function XmlToArr($xml)
  {
      if($xml == '') return '';
      libxml_disable_entity_loader(true);
      $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
      return $arr;
  }

  //数组转XML
  public function ArrToXml($arr)
  {
      if(!is_array($arr) || count($arr) == 0) return '';

      $xml = "<xml>";
      foreach ($arr as $key=>$val)
      {
              if (is_numeric($val)){
                      $xml.="<".$key.">".$val."</".$key.">";
              }else{
                      $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
              }
      }
      $xml.="</xml>";
      return $xml;
  }

  //post 字符串到接口
  public function postStr($url,$postfields){
      $ch = curl_init();
      $params[CURLOPT_URL] = $url;    //请求url地址
      $params[CURLOPT_HEADER] = false; //是否返回响应头信息
      $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
      $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
      $params[CURLOPT_POST] = true;
      $params[CURLOPT_SSL_VERIFYPEER] = false;//禁用证书校验
      $params[CURLOPT_SSL_VERIFYHOST] = false;
      $params[CURLOPT_POSTFIELDS] = $postfields;
      curl_setopt_array($ch, $params); //传入curl参数
      $content = curl_exec($ch); //执行
      curl_close($ch); //关闭连接
      return $content;
  }

  //统一下单
  public function unifiedorder($params){
      //获取到带签名的数组
      $params = $this->setSign($params);
      //数组转xml
      $xml = $this->ArrToXml($params);
      //发送数据到统一下单API地址
      $data = $this->postStr(self::UOURL, $xml);
      $arr = $this->XmlToArr($data);
      if($arr['result_code'] == 'SUCCESS' && $arr['return_code'] == 'SUCCESS'){
          return $arr;
      }else{
          $this->logs('error.txt', $data);
          return false;
      }
  }

}


 ?>
