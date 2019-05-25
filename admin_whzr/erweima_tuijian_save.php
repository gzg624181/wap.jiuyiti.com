<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname="memberuser";
$gourl="erweima_tuijian.php?Account=".$Account;



//引入操作类
require_once(ADMIN_INC.'/action.class.php');


//生成二维码
if($action == 'huiyuan_add')
{    
  
	 $appid=$cfg_appid;  //微信小程序id
	 $secret=$cfg_secret; //小程序秘钥
	 $xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
	 $erweima_name=date("Ymdhis");
	 $url="uploads/erweima/".$erweima_name.".png";
	 $save_path="../".$url;         //生成成功之后的二维码地址
	 $Recommands=$Recommand;
	 
	//第一步获取token
function get_access_token($appid,$secret) {
    $get_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
    $content = file_get_contents($get_url);
    $content_json = json_decode($content);
    $access_token = $content_json->access_token;
    $expires_in = $content_json->expires_in;
    return $access_token;
}

$access_token=get_access_token($appid,$secret);
//第二步获取二维码并保存
function save_erweima($access_token,$xiaochengxu_path,$save_path,$url) {
    $post_url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=$access_token";
    $width = '430';
	global $Recommands;
	//前面是推荐码，商户端是1，客户端是0
	$scene=$Recommands.",0";
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

$erweima= save_erweima(get_access_token($appid,$secret),$xiaochengxu_path,$save_path,$url);
	$sql = "UPDATE $tbname SET bilv='$bilv',erweima='$erweima' where Account='$Account'";
	$dosql->ExecNoneQuery($sql);
	header("location:$gourl");
	exit();
    
}
//修改二维码信息
else if($action == 'huiyuan_update')
{
    $tbname="memberuser";
	$sql = "UPDATE $tbname SET bilv='$bilv' where Account='$Account'";
	if($dosql->ExecNoneQuery($sql))
	{   
        header("location:$gourl");
	    exit();
	}
}

//无条件返回
else
{
    header("location:$gourl");
	exit();
}
?>
