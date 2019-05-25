<?php


require_once(dirname(__FILE__).'/inc/config.inc.php');
  /*   $appid="wx828a39df41ab348d";  //微信小程序id
	 $secret="b4b2de71cbd3286478a511eb087f577e"; //小程序秘钥
	 $xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
	 $erweima_name=date("Ymdhis");
	 $url="uploads/images/".$erweima_name.".png";
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
    $post_url = "https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=".$access_token;
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


<a  title="关注微信" onmouseover="javascript:showImg('a1');" onmouseout="javascript:hideImg('a1');">
<img src="template/images/logoiHover.png">
</a>

<script type="text/javascript">
function showImg(imgid){ document.getElementById(imgid).style.display = "block"; }
function hideImg(imgid){ document.getElementById(imgid).style.display = "none"; }
</script>

echo address('111.175.49.84');
function address($ip){
  $ipContent   =  file_get_contents(stripslashes("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip));  //
		$jsonAddress = json_decode($ipContent,true);
		if($jsonAddress['code']==0){
      return $jsonAddress['data']['country']."-".$jsonAddress['data']['region']."-".$jsonAddress['data']['city'];
    }else{
      return "地址未知";
    }
}
*/
function getImageinfo($url)
   {
       $result = array(
           'width'=>'',
           'height'=>'',
           'size'=>'',
       );
       $imageInfo = getimagesize($url);
       $result['width']=$imageInfo[0];
       $result['height']=$imageInfo[1];

       $headerInfo = get_headers($url,true);
       $result['size']=$headerInfo['Content-Length'];

       return $result;
   }
   function yuanImg($picture) {
       $src_img = imagecreatefromstring($picture);
       $w   = imagesx($src_img);
       $h   = imagesy($src_img);
       $w   = min($w, $h);
       $h   = $w;
       $img = imagecreatetruecolor($w, $h);
       //这一句一定要有
       imagesavealpha($img, true);
       //拾取一个完全透明的颜色,最后一个参数127为全透明
       $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
       imagefill($img, 0, 0, $bg);
       $r   = $w / 2; //圆半径
       $y_x = $r; //圆心X坐标
       $y_y = $r; //圆心Y坐标
       for ($x = 0; $x < $w; $x++) {
           for ($y = 0; $y < $h; $y++) {
               $rgbColor = imagecolorat($src_img, $x, $y);
               if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                   imagesetpixel($img, $x, $y, $rgbColor);
               }
           }
       }
       /**
        * 如果想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
        * 并且去掉缓存区函数
        */
       //获取输出缓存，否则imagepng会把图片输出到浏览器
       ob_start();
       imagepng ( $img );
       imagedestroy($img);
       $contents =  ob_get_contents();
       ob_end_clean();
       return $contents;
   }

   $QR = 'https://wx.qlogo.cn/mmopen/vi_32/r5h3Ks3kqljHh8POFmxQNia1mmy17M5vMjT9UIzk8nWDz3AgOwHjxTzhEHznXhzOlRSlnkcgZFKALOWKVszfCZg/132';

  $logo='20180831071913.png';

   $QR   = imagecreatefromstring ($QR);
   $logo = imagecreatefromstring ($logo);

   echo $QR;
   echo "<Hr>";
   echo $logo;
?>
