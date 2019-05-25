<?php
    /**  
	 * 链接地址：CommercialTodayProfit  商户端首页（今日提单，本月收益）
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
     * @查询商户今日提单，今日商家酒钱收益    提供商户账号 commercial
     */
	 
require_once('../../include/config.inc.php');

$State = 0;
$sum=0;
$Descriptor = '';
$Data = array();
$cmd = array();
$Version=date("Y-m-d H:i:s");
$id="me";
$ids="we";
$cid="to";
$gid="ro";
//今日提单的数量
$sj=substr($Version,0,10);
//$sj="2017-12-25";
$dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and pickUpTime='$sj'",$id);  //今日提单数量
$num=$dosql->GetTotalRow($id);

//本月收益总和
 $sj_first=date("Y-m-01");
 $dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and pickUpTime >='$sj_first' and pickUpTime <= '$sj'",$ids);	
 $nums=$dosql->GetTotalRow($ids);
 
 if($nums > 0){
	 

 for($i=0;$i<$nums;$i++){
	 $r=$dosql->GetArray($ids);
	 $arr[]=$r['jiuQian'];
 }
 foreach($arr as $val){	
	 $sum+=$val;
 }

 
 //今日提单的列表
$dosql->Execute("SELECT * FROM `pickuplist`  WHERE Commercial='$commercial' and pickUpTime='$sj'",$cid);

	// 两张表联合查询
	/* b ordercommodity 商品订单列表
	   c commodity     商品详情
	*/	
for($m=0;$m<$dosql->GetTotalRow($cid);$m++){
$row = $dosql->GetArray($cid);
$cmd[$m]=$row;
$orderid=$row['orderId'];//一个订单号对应着多件商品

$dosql->Execute("select Title,Images,NewPrice,yuyue,Quantity,OldPrice,JiuQian,Colour,Standard,yuyue from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$gid);
for($j=0;$j<$dosql->GetTotalRow($gid);$j++) { 
  $show = $dosql->GetArray($gid);
  $cmd[$m]["Commodity"][$j]=$show;
                                         } 
} 

 
$Data=array('Num' => $num,'Sum' => $sum,'CMD' => $cmd);
$State = 1;
$Descriptor = '数据查询成功！';	
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
$Data=array('Num' =>0,'Sum' =>0);
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}

?>