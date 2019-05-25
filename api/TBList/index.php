<?php 
    /**  
	 * 链接地址：TBList
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
     * @ 提吧接口
	 * 
	 * @传入参数：①.订单编号orderid  ②.订单类型dingdantype(1,预约 0,现提)
     */
require_once('../../include/config.inc.php');
error_reporting(0);
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
//将所有的商户的点全部显示出来,预约订单只显示预约的地址，如果预约单没有提前填写地址的话会提前将地址填上，地图上面只会显示一个预约的地址,预约订单需要将orderid提供出来
if($dingdantype==1){

$one=1;
$two=2;
$new_xhs=array();
$xhs=array();
$dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$one);
//这个预约订单里面的所有的商品
while($row=$dosql->GetArray($one)){
    $xhs[]=$row['CommodityId'];	 //商品id集合
}

$show=$dosql->GetOne("select a.Commercial,b.address from commercialuser a inner join orderform b on a.CommercialSite=b.address where b.OrderId='$orderid'");
//查询订单里面的下单人,
$commercial=$show['Commercial'];
$address=$show['address'];
$dosql->Execute("SELECT * FROM commoditystock,commodity where commoditystock.CommodityId=commodity.Id and commoditystock.CommercialUser='$commercial'",$two);
///商家库存的商品列表
while($rows=$dosql->GetArray($two)){
    $new_xhs[]=$rows['CommodityId'];	
}
$a=$xhs;
$b=$new_xhs;

$c = array_diff($a, $b);
//print_r($c);
$flag = empty($c)?1 : 0;
if ($flag) {
  $dis=1;
}else {
  $dis=0;
}
//当购买的商品列表在商家的库存表里面的时候，
$num="";
foreach($xhs as $valid){
	$s=$dosql->GetOne("select Stock,Quantity from ordercommodity a inner join commoditystock b on a.CommodityId=b.CommodityId where a.OrderId='$orderid' and b.CommodityId='$valid' and b.CommercialUser='$commercial'");  
	 $num .= ($s['Stock']-$s['Quantity']).",";   //判断商家的库存数量是否大于或者等于购买的商品列表的数量
  }
 if(strpos($num,"-")!==false){
	$shu=0;    //表示购买的商品列表的数量大于库存的数量                 (商品库存不足)
 }else{
	$shu=1;    //表示购买的商品列表的数量小于或者等于库存的数量    (表示有货)
 }
if($dis==1  && $shu==1){
  //当购买的商品列表的数量小于或者等于商家的库存的时候，地图里面的商品点才会显示出来
$show=$dosql->GetOne("SELECT Lng,Lat,QqLng,QqLat,CommercialName,CommercialSite,Phone,Linkman,CommercialImg FROM commercialuser a inner join orderform b on a.CommercialSite=b.address where a.online=1 and b.address='$address'");
if(is_array($show)){
$Data[]=$show;
if(empty($Data))
{
$State = 2;
$Descriptor = '暂时没有所预约的点！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
			//	'NUM' => $num,
			//	'XHS' => $xhs,
                'Data' => $Data
                 );				 
echo phpver($result);			
}else{
$State = 1;
$Descriptor = '数据查询成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
			//	'NUM' => $num,
			//	'XHS' => $xhs,
                'Data' => $Data
                 );				 
echo phpver($result);		
}
}else{
$State = 0;
$Descriptor = '数据查询失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
			//	'NUM' => $num,
			//	'XHS' => $xhs,
                'Data' => $Data,	
        );
echo phpver($result);		
}
}else{
$State = 0;
$Descriptor = '数据查询失败,库存不足!';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
			//	'XHS' => $xhs,
		    //	'NUM' => $num, 
        );
echo phpver($result);			
}
	
}else{
	
$one=1;
$two=2;
$three=3;
$new_xhs=array();
$xhs=array();
$c=array();
$dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$one);
//这个现提订单里面的所有的商品
while($row=$dosql->GetArray($one)){
    $xhs[]=$row['CommodityId'];	 //订单商品id集合
}
			$dosql->Execute("select * from commercialuser where online=1",$three);
			if($dosql->GetTotalRow($three)>0){
			for($i=0;$i<$dosql->GetTotalRow($three);$i++){
				$shell=$dosql->GetArray($three);
				$commercial=$shell['Commercial'];
				$dosql->Execute("SELECT * FROM commoditystock where  CommercialUser='$commercial'",$two);
			//商家库存的商品列表
			while($rows=$dosql->GetArray($two)){
				$new_xhs[$i][]=$rows['CommodityId'];	  //库存商品id集合	
			}
            //匹配对比数据操作

			$c = array_diff($xhs, $new_xhs[$i]);
			$flag = empty($c)?1 : 0;
			if ($flag) {
			  $dis=1;     //商品存在
			}else {
			  $dis=0;    //商品不存在
			}	
            $is[]=$dis;  //对比结构数组集合
		  //当购买的商品列表在商家的库存表里面的时候，
			$nums="";
			foreach($xhs as $valid){
				$s=$dosql->GetOne("select Stock,Quantity from ordercommodity a inner join commoditystock b on a.CommodityId=b.CommodityId where a.OrderId='$orderid' and b.CommodityId='$valid' and b.CommercialUser='$commercial'");  
				if(is_array($s)){
				 $nums .= ($s['Stock']-$s['Quantity']).",";   //判断商家的库存数量是否大于或者等于购买的商品列表的数量
				}
			  }
			 if(strpos($nums,"-")!==false){
				$shu=0;    //表示购买的商品列表的数量大于库存的数量                 (商品库存不足)
			 }else{
				$shu=1;    //表示购买的商品列表的数量小于或者等于库存的数量    (表示有货)
			 }
		
			if($dis==1 && $shu==1){    //当购买的商品有，并且库存足够的情况下，在地图上面显示这家店的地址
		   $show=$dosql->GetOne("SELECT Id,Lng,Lat,QqLng,QqLat,CommercialName,CommercialSite,Phone,Linkman,CommercialImg,Commercial FROM `commercialuser` where online=1 and Commercial='$commercial'");	
		   $Data[]=$show;
			}
}
if(empty($Data)){
$State = 3;
$Descriptor = '没有可供选择的自提点，建议将订单转变为预约订单！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
			//	'XHS' => $xhs,
			//	'NEW_XHS' => $new_xhs,
            //   'IS' => $is,
				'ORDER' => $orderid
                 );
echo phpver($result);	
}else{
$State = 1;
$Descriptor = '数据查询成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
			//	'XHS' => $xhs,
			//	'NEW_XHS' => $new_xhs,
            //   'IS' => $is,
				'Data' => $Data
                 );
echo phpver($result);
}
}else{
$State = 0;
$Descriptor = '数据查询失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
			//	'XHS' => $xhs,
			//	'NEW_XHS' => $new_xhs,
            //    'IS' => $is,
			//	'Data' => $Data
        );
echo phpver($result);
}

}	


?>
