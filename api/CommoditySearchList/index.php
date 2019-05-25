<?php
    /**
	 * 链接地址：CommoditySearchList

     * 下面直接来连接操作数据库进而得到json串
     *
     * @param unknown $State 状态码
     *
     * @param string $Descriptor  提示信息
     *
     * @param array $Data 数据
	   *
	   * 传递两个值 $id  获取酒品类别$id, 品牌，类型，国家,价格区间的其中一个进行搜索
     * CommodityClassid(酒品分类)
     * @return string  商品类别列表接口 获取酒品类别$id, 品牌，类型，国家，价格区间 的其中一个进行搜索
     */

require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
/*if($classid==0){
$dosql->Execute("SELECT Id,picarr,picurl2,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue  FROM `commodity` where  Pinpai='$winename' and del='0'");

}*/if($classid==0){
$dosql->Execute("SELECT Id,picarr,picurl2,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue  FROM `commodity` where  Types='$winename'  and del='0'");

}elseif($classid==1){
$dosql->Execute("SELECT Id,picarr,picurl2,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue  FROM `commodity` where  Country='$winename'  and del='0'");

}elseif($classid==2){
if(strpos($winename,'以上')===false){
	$price_arr=explode("-",$winename);
	$first_area=$price_arr[0];
	$last_area=$price_arr[1];
	$dosql->Execute("SELECT Id,picarr,picurl2,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue  FROM `commodity` where CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and $last_area > NewPrice and del='0'");
}else{
	$price_arr=explode('以上',$winename);
	$first_area=$price_arr[0];
	$dosql->Execute("SELECT Id,picarr,picurl2,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue  FROM `commodity` where CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and del='0'");
}
}
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
