<?php
    /**
	 * 链接地址：search
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
     * @根据商户id查询商品，提供搜索关键字 keyword
     */

require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$row = $dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,picurl2,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue FROM `commodity` WHERE Title like '%$keyword%' and del='0' ");
if($dosql->GetTotalRow()>0){
  $i=0;
  $thisyear=date("Y",time());
  $thismonth=date("m",time());
  while($i<$dosql->GetTotalRow())
  {
  	$row=$dosql->GetArray();
  	$commodityid_id=$row['Id'];
  	$Data[$i]=$row;
  	$r=$dosql->GetOne("select * from commodity_month_nums where commodityid_id='$commodityid_id' and year=$thisyear and month=$thismonth");
  	if(is_array($r)){
  		$Data[$i]['month_nums']=$r['month_nums_last'];
  	}else{
  		$Data[$i]['month_nums']=0;
  	}
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

?>
