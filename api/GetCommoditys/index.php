<?php
    /**  
	 * 链接地址：GetCommodity
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
     * @return string
     *           
     * @查询所有商品 不需要提供返回参数账号
     */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
//$lat="30.50575984134286";
//$lng="114.42417699999987";
/*
$city= getcposition();
// echo $city;
 $ids=1;
 $two=2;
 $dosql->Execute("select * from `commodity` WHERE del='0' and live_city='$city'",$ids);
 $rows = $dosql->GetArray($ids);
 if(is_array($rows)){
	if($classtype=='all'){ 
 $dosql->Execute("SELECT Id,Title,Explains,Images,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,picurl2,picarr,RecommendIndex,CommentNumber,Grade,ActivityType,Num,Details ,canshu,Pinpai,Types,shprice,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,yuyue,summary FROM `commodity` WHERE del='0' and live_city='$city'  order by orderid desc",$two);
	}else{
	$dosql->Execute("SELECT Id,Title,Explains,Images,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,picurl2,picarr,RecommendIndex,CommentNumber,Grade,ActivityType,Num,Details ,canshu,Pinpai,Types,shprice,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,yuyue,summary FROM `commodity` WHERE del='0' and live_city='$city' and CommodityClass='$classtype'  order by orderid desc",$two);	
	}
 }else{
 $citys="武汉市 ";//查询所有的商品
 if($classtype=='all'){
 $dosql->Execute("SELECT Id,Title,Explains,Images,Details,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,picurl2,picarr,RecommendIndex,CommentNumber,Grade,ActivityType,Num,Details ,canshu,Pinpai,Types,shprice,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,yuyue,summary FROM `commodity` WHERE del='0' and live_city='$citys' order by orderid desc",$two);	 
 }else{
 $dosql->Execute("SELECT Id,Title,Explains,Images,Details,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,picurl2,picarr,RecommendIndex,CommentNumber,Grade,ActivityType,Num,Details ,canshu,Pinpai,Types,shprice,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,yuyue,summary FROM `commodity` WHERE del='0' and live_city='$citys' and CommodityClass='$classtype' order by orderid desc",$two);		 
 }
 }
 if($dosql->GetTotalRow($two)>0){
*/
if($classtype=="all"){
$file = "../../cache/GetCommodity.txt";     //所有商品的缓存数据
}else{
$file = "../../cache/".$classtype.".txt";   //单个分类的商品缓存	
}
$msg = Readf($file);  
$Data = unserialize($msg); 
if(count($Data)>0){
$State = 1;
$Descriptor = '数据查询成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
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
        return "武汉市";
    } 
	
}


?>