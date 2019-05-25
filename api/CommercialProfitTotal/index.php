<?php
    /**
	 * 链接地址：CommercialProfitTotal
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
     * @查询商户收益统计，提供商户账号commercial： types(1,2) 筛选日期：1 开始时间 $sj_first  结束时间 $sj_last

	 * 快速查看 ：2 分为三种情况

	   see    ①只看今天 ②最近七天 ③最近30天

	 eg:http://wap.jiuyiti.zrcase.com/api/CommercialProfitTotal/?commercial=admin&types=2&see=3

	 * {"State":1,"Descriptor":"数据查询成功！","Version":"2017-08-03 10:55:11","Data":{"Num":4,"Sum":27}}
     */
require_once('../../include/config.inc.php');

$State = 0;
$sum=0;
$id="me";
$ids="we";
$Descriptor = '';
$Data = array();
$cmd = array();
$Version=date("Y-m-d H:i:s");

//今日提单的数量
$sj=substr($Version,0,10);

if($types==1){
$dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and pickUpTime >='$sj_first' and pickUpTime <= '$sj_last' order by pickUpTime desc",$id);
}elseif($types==2){
	//只看今天的数据
	if($see==1){
$dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and pickUpTime ='$sj' order by pickUpTime desc",$id);
   //最近七天的数据
    }elseif($see==2){
$sj_fi=strtotime("-1 week");
$sj_first=date("Y-m-d",$sj_fi);
$dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and pickUpTime >='$sj_first' and pickUpTime <= '$sj' order by pickUpTime desc",$id);
	}elseif($see==3){
    //最近30天的数据
$sj_fi=strtotime("-1 month");
$sj_first=date("Y-m-d",$sj_fi);
$dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and pickUpTime >='$sj_first' and pickUpTime <= '$sj' order by pickUpTime desc",$id);
	}

}

$num=$dosql->GetTotalRow($id);   //提取了多少单  $num

if($num>0){

 // for($i=0;$i<$num;$i++){
	// $r=$dosql->GetArray($id);
	// $arr[]=$r['jiuQian'];
 // }
 // foreach($arr as $val){
	 // $sum+=$val;             //获得的酒钱总数
 // }


for($m=0;$m<$num;$m++){
$row = $dosql->GetArray($id);
$cmd[$m]=$row;
$orderid=$row['orderId'];//一个订单号对应着多件商品
$sum+=$row['jiuQian'];


$dosql->Execute("select sum(SJJiuQian) as JiuQian, Title,SJJiuQian,Images,NewPrice,shprice,yuyue,Quantity,OldPrice,Colour,Standard,yuyue,Pinpai,CommodityClass,picurl2 from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$ids);
for($j=0;$j<$dosql->GetTotalRow($ids);$j++) {
  $show = $dosql->GetArray($ids);
  $cmd[$m]["Commodity"][$j]=$show;

                                      }
}


$Data=array('Num' => $num,'SUM'=>$sum,'CMD'=>$cmd);
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
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				        'Version' => $Version,
                'Data' => $Data,
        );
echo phpver($result);
}

?>
