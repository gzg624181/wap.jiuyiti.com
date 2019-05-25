<?php
  //获取微信access_token
  //请求url地址
  require_once('../../include/config.inc.php');
$appid=$cfg_appid;
$appsecret=$cfg_appsecret;
// $appid='wx828a39df41ab348d';
// $appsecret='b4b2de71cbd3286478a511eb087f577e';
// $cfg_template_id='FWXW4F7PdvRJNRI1ZZCF6owmnXASCOs1V77OZHDcMPM';
   $ACCESS_TOKEN= get_access_token($appid,$appsecret);
   $openid='oqGb90JK8NvAb1tmWmI5Rf9Fw10g';
   $template_id=$cfg_pay_templates;
   $prepay_id='wx2018'.rand(100000,999999);
   $tpl_name='太阳之光单一庄园珍藏梅洛干红葡萄酒';
   $tpl_type='微信支付';
   $tpl_money='172.00';
   $tpl_state='待提取';
   $tpl_time='2018-08-30 15:19:23';
//模板消息请求URL,点对点发送
   $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=".$ACCESS_TOKEN;
   $data=getDataArray($openid,$template_id,$prepay_id,$tpl_name,$tpl_type,$tpl_money,$tpl_state,$tpl_time);
  // print_r($data);
    $json_data = json_encode($data);//转化成json数组让微信可以接收
    $res = https_request($url, urldecode($json_data));//请求开始
    $res = json_decode($res, true);
     print_r($res);
    // if ($res['errcode'] == 0 && $res['errcode'] == "ok") {
    //    echo "发送成功！<br/>";
    // }


 //获取微信access_token
 function get_access_token($appid,$appsecret){
 $arr = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret);  //去除对象里面的斜杠
 $result = json_decode($arr, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
 //print_r($result);
 $access_token = $result['access_token'];
 return $access_token;
 //echo $ACCESS_TOKEN;
 }

//获取发送数据数组
function getDataArray($openid,$template_id,$prepay_id,$tpl_name,$tpl_type,$tpl_money,$tpl_state,$tpl_time)
{
    $data = array(
        'touser' => $openid, //要发送给用户的openid
        'template_id' => $template_id,//改成自己的模板id，在微信后台模板消息里查看
        'page' => 'pages/index/index', //自己网站链接url
        'emphasis_keyword'=>'keyword3.DATA',        //模板需要放大的关键字
        "form_id"		=>$prepay_id,   	//表单提交场景下，事件带上的 formId；支付场景下，为本次支付的 prepay_id
        'data' => array(
                'keyword1' => array(       //商品名称
                'value' => $tpl_name,
                'color' => "#000"
            ),
               'keyword2' => array(       //支付方式
                'value' => $tpl_type,
                'color' => "#000"
            ),
            'keyword3' => array(          //支付金额
                'value' => $tpl_money,
                'color' => "#000"
            ),
            'keyword4' => array(          //订单状态
                'value' => $tpl_state,
                'color' => "#000"
            ),
            'keyword5' => array(         //支付时间
                'value' => $tpl_time,
                'color' => "#000"
            )
        )
    );
    return $data;
}


//curl请求函数，微信都是通过该函数请求
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>
