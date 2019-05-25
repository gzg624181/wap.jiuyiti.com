<?php
//require_once(dirname(__FILE__).'/inc/config.inc.php');
/*
    $appid="wx828a39df41ab348d";  //微信小程序id
	 $secret="b4b2de71cbd3286478a511eb087f577e"; //小程序秘钥
	 $xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
	 $erweima_name="111111111111";
	 $url="uploads/erweima/".$erweima_name.".png";
	 $save_path=$url;         //生成成功之后的二维码地址
	 $randtjm=rand(100000,999999);
     $access_token=get_access_token($appid,$secret);
     $erweima= save_erweima($access_token,$xiaochengxu_path,$save_path,$url,$randtjm);

echo $erweima;
	//第一步获取token
function get_access_token($appid,$secret) {
    $get_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
    $content = file_get_contents($get_url);
    $content_json = json_decode($content);
    $access_token = $content_json->access_token;
    $expires_in = $content_json->expires_in;
    return $access_token;
}

function save_erweima($access_token,$xiaochengxu_path,$save_path,$url,$randtjm) {
    $post_url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=$access_token";
    $width = '430';
	//前面是推荐码，商户端是1，客户端是0
	$scene=$randtjm.",0";
    $post_data='{"page":"'.$xiaochengxu_path.'","width":'.$width.',"scene":"'.$scene.'"}';
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $post_data
        )
    );
    $context = stream_context_create($opts);
    $result = file_get_contents($post_url, false, $context);
    $file_path = $save_path;
    $bytes = file_put_contents($file_path, $result);
    return $url;
}
echo date("Y",time());
echo "<hr>";
echo date("m",time());
echo "<hr>";
$winename="1000以上";
$price_arr=explode("-",$winename);
if(is_array($price_arr)){
  echo "yes";
}else{
  echo "no";
}
echo "<hr>";
header("Content-type:text/html;charset=utf-8");
$str = '1000以上';
if(strpos($str,'以上')===false){
    echo '不存在！';
}else{
    echo '存在！';
}

$price_arr=explode('以上',$str);
$first_area=$price_arr[0];
echo $first_area;

*/
$arr = json_decode(file_get_contents("log.txt"));
$prepay_id=$arr['package'];
echo $prepay_id;
?>
