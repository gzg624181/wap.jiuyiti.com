<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message');

/*
**************************
(C)2017-2018 phpMyWind.com
update: 2018-03-05 17:22:45
person: Gang
**************************
*/


//初始化参数
$tbname = 'commercialuser';
$gourl  = 'business.php';



//引入操作类
require_once(ADMIN_INC.'/action.product.class.php');

//添加新的商户
if($action == 'add')
{

	//判断是否有已经存在的账号
	$s=$dosql->GetOne("select * from commercialuser where Commercial='$Commercial'");
	if(is_array($s)){
	ShowMsg('账号已存在，请重新添加新的账号！','-1');
	exit();
	}

	$recommand=rand(100000,999999); //随机生成6位数的推荐码
	//判断随机生成的验证码是否已经存在，如果存在则重新生成新的推荐码
	$r=$dosql->GetOne("select * from commercialuser where Recommand='$recommand'");
	if(is_array($r)){
	$recommand=rand(100000,999999);
	}

	$password=md5(md5($PassWord));

	$qqLng=get_qqjingwei($Lat,$Lng)->lng;
	$qqLat=get_qqjingwei($Lat,$Lng)->lat;

	$sql = "INSERT INTO `$tbname` (Id,Commercial, PassWord, CommercialImg, CommercialName, Linkman, CommercialSite, Phone, Lng, Lat,QqLng,QqLat, JiuQian, NickName,sex,orderid,CreatTime,online,Recommand,username,fenlei) VALUES ('$Id','$Commercial', '$password', '$picurl', '$CommercialName', '$Linkman', '$CommercialSite', '$Phone', '$Lng', '$Lat','$qqLng', '$qqLat', '$JiuQian', '$NickName', '$sex', '$orderid', '$CreatTime','$online','$recommand','$username','$fenlei')";
	$dosql->ExecNoneQuery($sql);

	 $appid=$cfg_appid;  //微信小程序id
	 $secret=$cfg_appsecret; //小程序秘钥
	 $xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
	 $erweima_name=date("Ymdhis");
	 $url="uploads/erweima/".$erweima_name.".png";
	 $save_path="../".$url;         //生成成功之后的二维码地址
	 $Recommands=$recommand;


    $bilv=$cfg_bilv;
    $erweima= save_erweima(get_access_token($appid,$secret),$xiaochengxu_path,$save_path,$url);
    $base64_img = base64EncodeImage("../".$erweima);


    $new_file = base64EncodeImagetodata("../".$picurl);


		//将用户头像图片变圆形
		$avatar = file_get_contents($new_file);
		$logo   = yuanImg($avatar);//返回的是图片数据流
		//微信小程序二维码与头像结合
		$sharePic = qrcodeWithLogo($base64_img,$logo);

		//删除第一次生成的二维码
		unlink("../".$erweima);

		//将结合之后的图像保存到本地
		$erweima=base64_to_imagecontent($sharePic);



		$sql = "UPDATE $tbname SET bilv='$bilv',erweima='$erweima' where Recommand='$recommand'";
		if($dosql->ExecNoneQuery($sql))
		{
			header("location:$gourl");
			include("api/Api_GetCommercialById.php");      //添加会员之后，更新单个会员缓存
			exit();
		}

}
//修改商家信息
else if($action == 'update')
{


	$qqLng=get_qqjingwei($Lat,$Lng)->lng;
	$qqLat=get_qqjingwei($Lat,$Lng)->lat;

	if($PassWord!=""){
  $PassWord=md5(md5($PassWord));
	$sql = "UPDATE `$tbname` SET  CommercialImg='$picurl',online='online', PassWord='$PassWord', CommercialName='$CommercialName', Linkman='$Linkman', CommercialSite='$CommercialSite', Phone='$Phone', Lng='$Lng', Lat='$Lat',QqLng='$qqLng', QqLat='$qqLat',NickName='$NickName',JiuQian='$JiuQian', Sex='$sex', Lat='$Lat',online='$online',fenlei='$fenlei' WHERE Id='$id'";
	}else{
	$sql = "UPDATE `$tbname` SET  CommercialImg='$picurl',online='online',CommercialName='$CommercialName', Linkman='$Linkman', CommercialSite='$CommercialSite', Phone='$Phone', Lng='$Lng', Lat='$Lat',QqLng='$qqLng', QqLat='$qqLat',NickName='$NickName',JiuQian='$JiuQian', Sex='$sex', Lat='$Lat',online='$online',username='$username',fenlei='$fenlei' WHERE Id='$id'";
	}
  $dosql->ExecNoneQuery($sql);
	$appid=$cfg_appid;  //微信小程序id
	$secret=$cfg_appsecret; //小程序秘钥
	$xiaochengxu_path="pages/home/home";  //默认扫码之后进入的页面
	$erweima_name=date("Ymdhis");
	$url="uploads/erweima/".$erweima_name.".png";
	$save_path="../".$url;         //生成成功之后的二维码地址
	$Recommands=$recommand;


	 $bilv=$cfg_bilv;
	 $erweima= save_erweima(get_access_token($appid,$secret),$xiaochengxu_path,$save_path,$url);
	 $base64_img = base64EncodeImage("../".$erweima);


	 $new_file = base64EncodeImagetodata("../".$picurl);


	 //将用户头像图片变圆形
	 $avatar = file_get_contents($new_file);
	 $logo   = yuanImg($avatar);//返回的是图片数据流
	 //微信小程序二维码与头像结合
	 $sharePic = qrcodeWithLogo($base64_img,$logo);

	 //删除第一次生成的二维码
	 unlink("../".$erweima);

	 //将结合之后的图像保存到本地
	 $erweima=base64_to_imagecontent($sharePic);

	 $sql = "UPDATE $tbname SET erweima='$erweima' where Id='$id'";
	if($dosql->ExecNoneQuery($sql))
	{
	 //	header("location:$gourl");
	    include("api/Api_GetCommercialById.php");      //修改会员之后，更新单个会员缓存
	    echo "<script>window.history.go(-1); </script>";
		exit();
	}
}
elseif($action=="update_cache"){                           //更新商户所有的单个缓存
	$sql="select * from `$tbname`";
	$dosql->Execute($sql);
	$i=0;
   while($i<$dosql->GetTotalRow())
    {
	$date[$i]=$row = $dosql->GetArray();

	$cachename=$row['Id'];
	GetCache($date[$i],$cachename);	                     //更新所有的单个商户的缓存数据
	$i++;
	}

	ShowMsg("缓存数据更新成功",$gourl);
}
//删除订单信息
else if($action == 'fax_del')
{

	$sql = "delete from pickuplist WHERE id='$id'";

	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}
//删除商家推荐购买记录
else if($action =='sjtj_del')
{

	$sql = "delete from recommandlist WHERE id='$id'";

	if($dosql->ExecNoneQuery($sql))
	{
        $gourls="tuijian_getting.php?Recommand=".$Recommand;
		header("location:$gourls");
		exit();
	}
}
//删除商家推荐记录
else if($action =='sjtjlb_del')
{

	$sql = "delete from recommand WHERE id='$id'";

	if($dosql->ExecNoneQuery($sql))
	{
        $gourls="recommand.php?Commercial=".$Commercial."&Recommand=".$Recommand;
		header("location:$gourls");
		exit();
	}
}
//无条件返回
else
{
    header("location:$gourl");
	exit();
}
//获取腾讯地图的经纬度(将百度的地图转化为腾讯的经纬度)
 function get_qqjingwei($Lat,$Lng)
 {
	 $key="ET7BZ-557WF-GZZJB-NM7HP-WRDZ5-Y3BZO";  //密钥
	 $type=3; //baidu经纬度
	 $get_url="http://apis.map.qq.com/ws/coord/v1/translate?locations=".$Lat.",".$Lng."&type=".$type."&key=".$key;
	 $content=file_get_contents($get_url);
	 $content_json = json_decode($content);
	 /*
	 状态码:
	 0为正常,
			 310请求参数信息有误，
			 311key格式错误,
			 306请求有护持信息请检查字符串,
			 110请求来源未被授权
	 */
	 $status=$content_json->status;  //状态码
	 if($status==0){
		 $jingwei= $content_json->locations;
		 return $jingwei[0];
	 }
 }

 /*******************************  下面是功能函数 **********************************/
 /**
 * curl方法
 * @param $url 请求url
 * @param $data 传送数据，有数据时使用post传递
 * @param type 为2时,设置json传递
 */

 //第一步获取token
function get_access_token($appid,$secret) {
		$get_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		$content = file_get_contents($get_url);
		$content_json = json_decode($content);
		$access_token = $content_json->access_token;
		$expires_in = $content_json->expires_in;
		return $access_token;
}
//第二步获取二维码并保存
function save_erweima($access_token,$xiaochengxu_path,$save_path,$url) {
    $post_url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=$access_token";
    $width = '430';
		global $Recommands;
		//前面是推荐码，商户端是1，客户端是0
		$scene=$Recommands.",1";
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
 function curlRequest($url,$data = null , $type = 1){
     $curl = curl_init();
     curl_setopt($curl, CURLOPT_URL, $url);
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
     if (!empty($data)){
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         if($type == 2){
             curl_setopt($curl, CURLOPT_HTTPHEADER,
                 array('Content-Type: application/json','Content-Length: ' . strlen($data)));
         }
     }
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
     $output = curl_exec($curl);
     curl_close($curl);
     return $output;
 }
 /**
  * 在二维码的中间区域镶嵌图片
  * @param $QR 二维码数据流。比如file_get_contents(imageurl)返回的东东,或者微信给返回的东东
  * @param $logo 中间显示图片的数据流。比如file_get_contents(imageurl)返回的东东
  * @return  返回图片数据流
  */
  function qrcodeWithLogo($QR,$logo){
     $QR   = imagecreatefromstring ($QR);
     $logo = imagecreatefromstring ($logo);
     $QR_width    = imagesx ( $QR );//二维码图片宽度
     $QR_height   = imagesy ( $QR );//二维码图片高度
     $logo_width  = imagesx ( $logo );//logo图片宽度
     $logo_height = imagesy ( $logo );//logo图片高度
     $logo_qr_width  = $QR_width / 2.2;//组合之后logo的宽度(占二维码的1/2.2)
     $scale  = $logo_width / $logo_qr_width;//logo的宽度缩放比(本身宽度/组合后的宽度)
     $logo_qr_height = $logo_height / $scale;//组合之后logo的高度
     $from_width = ($QR_width - $logo_qr_width) / 2;//组合之后logo左上角所在坐标点
     /**
      * 重新组合图片并调整大小
      * imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
     */
     imagecopyresampled ( $QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height );
     /**
      * 如果想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
      * 并且去掉缓存区函数
      */
     //获取输出缓存，否则imagepng会把图片输出到浏览器
     ob_start();
     imagepng ( $QR );
     imagedestroy($QR);
     imagedestroy($logo);
     $contents =  ob_get_contents();
     ob_end_clean();
     return $contents;
 }
 /**
  * 剪切图片为圆形
  * @param  $picture 图片数据流 比如file_get_contents(imageurl)返回的东东
  * @return 图片数据流
  */
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

 //使用PHP对图片进行base64解码输出
 function base64EncodeImage ($image_file) {
   $base64_image = '';
   $image_info = getimagesize($image_file);
   $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
   $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
   return $image_data;
 }

 function base64EncodeImagetodata ($image_file) {
   $base64_image = '';
   $image_info = getimagesize($image_file);
   $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
   $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
   return $base64_image;
 }

 //PHP将Base64格式图片转为图片格式并保存
 /**
  * PHP将Base64格式图片转为图片格式并保存
  * @author 我是超人  * @param  $base64_content 要保存的Base64
  * @param  string $path    本地路径
  */
  function base64_to_imagecontent($base64){
    //匹配出图片的格式
    if (strstr(base64_encode($base64),",")){
     $image = explode(',',base64_encode($base64));
     $base64 = $image[1];
     $img = base64_decode($base64);
     $erweima_name=date("Ymdhis");
     $path="uploads/erweima/"."new_".$erweima_name.".png";
     $url="../".$path;
     file_put_contents($url, $img);//返回的是字节数
     return $path;
     }else{
     $img = base64_decode(base64_encode($base64));
     $erweima_name=date("Ymdhis");
     $path="uploads/erweima/"."new_".$erweima_name.".png";
     $url="../".$path;
     file_put_contents($url, $img);//返回的是字节数
     return $path;
     }
  }
?>
