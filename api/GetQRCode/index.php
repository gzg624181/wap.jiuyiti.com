<?php 

//引入phpqrcode库文件

include('phpqrcode.php'); 
require_once('../../include/config.inc.php');
// 提供的数据 购物券id


// 二维码数据 
//$money=50;
//对应的商家id
//过期时间（暂时没使用）
//用户账号（控制今天使用优惠券的次数）

$row=$dosql->GetOne("select * from couponslist where id='$id'");
if(is_array($row)){
if($row['state']==0){
//对应的商家   
$commercial=$row['commercial'];
//购物券价值
$money=$row['money'];
//过期时间
$sj="2027-08-28";
//用户账号
$account=$row['account'];
$ids=$row['id'];
//二维码详情
// 商户账号.购物券价值.过期时间.用户账号.优惠券id
$data = $commercial."#".$money."#".$sj."#".$account."#".$ids; 
// 生成的文件名 

$filename = 'erweima.png'; 

// 纠错级别：L、M、Q、H 

$errorCorrectionLevel = 'L';  

// 点的大小：1到10 

$matrixPointSize = 4;  

//创建一个二维码文件 

QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

//输入二维码到浏览器

// QRcode::png($data); 
$url="api/GetQRCode/erweima.png";
$Data=array("url"=>$url);
}
$State = 1;
$Descriptor = '数据查询成功';	
$Version=date("Y-m-d H:i:s");
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data
                 );
echo phpver($result);
}else{
	$State = 1;
$Descriptor = '数据查询失败';	
$Version=date("Y-m-d H:i:s");
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                 );
	
}
?>