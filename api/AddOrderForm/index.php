<?php
    /**  
	 * 链接地址：AddOrderForm
	 *
     * 下面直接来连接操作数据库进而得到json串
     * 
     * 按json方式输出通信数据
     * 
     * @param unknown $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *     
	 * @param string $Version  操作时间
	       
     * @param array $Data 数据
     *            
     * @return string  订单生成接口
     *           
     * @会员订单生成接口 提供返回参数  商品id和商品数量列表   用户名userid   购买状态 State ,提供经纬度 $lat $lng
     *number :订单号
     quantity:数量  
     userid:下单人  电话号码13618613798
     state:订单状态
     */
require_once('../../include/config.inc.php');
$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();

$posttime=substr($Version,0,10);
date_default_timezone_set("PRC");                //设置时区
$city= getcposition();    //城市
$province=getcposition_prov();//省份 
$orderid=date('YmdHis') . rand(1000,9999);      //订单号
$arr=stripslashes($commodityinfo);              //去除对象里面的斜杠
$str=json_decode($arr,true);
// 向数据库里面导入商品订单生成接口 
// state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
    $id= rand(100000000,999999999);               //订单id
	$tiquma=str_shuffle(substr($orderid,-6));    //订单提取码的后面6位，并且将顺序随机排列
    //判断是否是注册的会员，
	$r=$dosql->GetOne("select * from memberuser where Account='$userid'");  
	if(is_array($r)){
	$sql = "INSERT INTO `orderform` (Id, OrderId, UserId, CreatTime,posttime,State,tiquma,prov,city) VALUES ('$id', '$orderid','$userid','$Version','$posttime','$state','$tiquma','$province','$city')";
	$dosql->ExecNoneQuery($sql);
	//订单生成完毕之后，更新购物车列表里面的数量，订单
	for ($i = 0; $i < count($str); $i++) {
		$CommodityId = $str[$i]['CommodityId'];  //商品Id
		$Quantity     = $str[$i]['Quantity'];     //商品数量
		//购买时候修改购买的数量,更改订单号
		$r=$dosql->GetOne("select * from memberuser where Account='$userid'");
		$ids=$r['Id'];
		$sql ="UPDATE `shoppingcart` SET Orderid='$orderid', CommodityNumber='$Quantity' WHERE `CommodityId`='$CommodityId' and UserId='$ids'";
		$dosql->ExecNoneQuery($sql);
	
	// 向商家的数据库里面添加购买的记录

		$sql = "INSERT INTO `ordercommodity` (OrderId, CommodityId, Quantity, CreatTime,posttime) VALUES ('$orderid', '$CommodityId','$Quantity','$Version','$posttime')";
		$dosql->ExecNoneQuery($sql);
    }
	
	
	}
    $row = $dosql->GetOne("SELECT * FROM `orderform` WHERE Id='$id'");
	if(is_array($row)){
$State = 1;
$Descriptor = '数据查询成功！';
$Data[]=$row;	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,
				//'Commodityinfo'=>$arr
                 );
echo phpver($result);

}else{

$State = 0;
$Descriptor = '数据查询失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}

//lat 纬度值
//lng 经度值
function getcposition(){
$ak ="94z0AESTh67HCS6zb9w0MX2tG1hG11jN";
global $lat;
global $lng;
$url="http://api.map.baidu.com/geocoder/v2/?ak=".$ak."&location=".$lat.",".$lng."&output=json&pois=1";
    $res1 = file_get_contents($url);
    $res1 = json_decode($res1,true);
 
// print_r($res1);
   if ($res1[ "status"]==0){
	  // $province=$res1['result']['addressComponent']['province'];
	   $city=$res1['result']['addressComponent']['city'];
        return $city;
    }else{
        return "未知";
    } 
}

function getcposition_prov(){
$ak ="94z0AESTh67HCS6zb9w0MX2tG1hG11jN";
global $lat;
global $lng;
$url="http://api.map.baidu.com/geocoder/v2/?ak=".$ak."&location=".$lat.",".$lng."&output=json&pois=1";
    $res1 = file_get_contents($url);
    $res1 = json_decode($res1,true);
 
// print_r($res1);
   if ($res1[ "status"]==0){
	   $province=$res1['result']['addressComponent']['province'];
	  // $city=$res1['result']['addressComponent']['city'];
        return $province;
    }else{
        return "未知";
    } 
}
?>