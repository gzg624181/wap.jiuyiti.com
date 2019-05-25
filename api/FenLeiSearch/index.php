<?php
    /**
	 * 链接地址：FenLeiSearch
	 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param unknown $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
	 * 
	 * 传递两个值  商家分类的关键字  $fenlei   当前用户的经纬度 $lat (纬度) $lng （经度值）
     *            
     * @return string  商品类别列表接口,按照距离来排序
     */
	 
require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$minimum=3000; 
//百度经纬度 
//$lat=114.416943;
//$lng=30.496697;
$one=1;
$two=2;
  /*
    ①.查询附近的点
    ②.根据商家的类别查询进行排序
  */
$dosql->ExecNoneQuery("truncate linshi"); 
  if($fenlei!="附近"){//根据条件查询
    $dosql->Execute("SELECT Id,Lng,Lat,QqLng,QqLat,fenlei FROM `commercialuser` where fenlei='$fenlei' order by orderid ",$one); 
	while($row=$dosql->GetArray($one)){
	 if(is_array($row)){
	 $pid=$row['Id']; //商户id
	 $lat1=$row['QqLng'];
	 $lng1=$row['QqLat'];
	 $type=$row['fenlei'];
	 $juli=getDistance($lat,$lng,$lat1,$lng1);
	 $sql = "INSERT INTO linshi(pid,juli,type)VALUES('$pid','$juli','$type')";	
	 $dosql->ExecNoneQuery($sql);
	 }
	 $dosql->Execute("SELECT a.juli,b.* FROM `linshi` a inner join commercialuser b on a.pid=b.Id  where a.juli<=$minimum and a.type='$fenlei' order by juli asc limit 10",$two);
	}
   }elseif($fenlei=="附近"){   //查询附近的商家
    $y = $minimum / 110852; //纬度的范围
    $x = $minimum / (111320*cos($lat)); //经度的范围   
	$dosql->Execute("SELECT Id,Lng,Lat,fenlei,QqLng,QqLat FROM `commercialuser` where QqLat >= ($lat-$y) and QqLat <= ($lat+$y) and QqLng >= ($lng-$x) and QqLng <= ($lng+$x) order by orderid asc limit 20 ",$one); 
    while($row=$dosql->GetArray($one)){
	 $pid=$row['Id']; //商户id
	 $lat1=$row['QqLat'];
	 $lng1=$row['QqLng'];
	 $type=$row['fenlei'];
	 $juli=getDistance($lat,$lng,$lat1,$lng1);
	 $sql = "INSERT INTO linshi(pid,juli,type)VALUES('$pid','$juli','$type')";	
	 $dosql->ExecNoneQuery($sql);
     }
	 
	 $dosql->Execute("SELECT a.juli,b.* FROM `linshi` a inner join commercialuser b on a.pid=b.Id where a.juli<=$minimum",$two);
	 
	 if($dosql->GetTotalRow($two)!=0){
		$dosql->Execute("SELECT a.juli,b.* FROM `linshi` a inner join commercialuser b on a.pid=b.Id where a.juli<=$minimum order by juli asc limit 10",$two); 
	 }else{
		$dosql->Execute("SELECT a.juli,b.* FROM `linshi` a inner join commercialuser b on a.pid=b.Id where a.juli>$minimum order by juli asc limit 10",$two); 	  
	 }
}
  

     


if($dosql->GetTotalRow($two)>0){
$i=0;
while($i<$dosql->GetTotalRow($two))
{
	$row=$dosql->GetArray($two);
	$Data[$i]=$row;
	$i++;
}
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

function getDistance($lat1, $lng1, $lat2, $lng2) 
{ 
$earthRadius = 6367000; //approximate radius of earth in meters 
 
/* 
Convert these degrees to radians 
to work with the formula 
*/
 
$lat1 = ($lat1 * pi() ) / 180; 
$lng1 = ($lng1 * pi() ) / 180; 
 
$lat2 = ($lat2 * pi() ) / 180; 
$lng2 = ($lng2 * pi() ) / 180; 
 
/* 
Using the 
Haversine formula 
 
http://en.wikipedia.org/wiki/Haversine_formula 
 
calculate the distance 
*/
 
$calcLongitude = $lng2 - $lng1; 
$calcLatitude = $lat2 - $lat1; 
$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2); 
$stepTwo = 2 * asin(min(1, sqrt($stepOne))); 
$calculatedDistance = $earthRadius * $stepTwo; 
 
return round($calculatedDistance); 
} 
?>