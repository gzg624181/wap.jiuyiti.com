<?php
    /**
	 * 链接地址：CommoditySearch

     * 下面直接来连接操作数据库进而得到json串
     *
     * @param unknown $State 状态码
     *
     * @param string $Descriptor  提示信息
     *
     * @param array $Data 数据
	 *
	 * 获取商品名称$id, 销量$num，综合排序$order，按照价格 $price  style 1 关键字 搜索  0分类搜索
     *
     * @return string
     */

require_once('../../include/config.inc.php');
$title  = isset($title)  ? $title  : "";          //商品名称关键字

$order  = isset($order)  ? $order  : "";       //综合排序按照最新的放在前面$order=0 否则 $order=1;
$num  = isset($num)  ? $num  : "";             //按照销量    销量从多到少 $num=1 销量从少到多 $num=0;
$price  = isset($price)  ? $price  : "";       //按照价格     价格从高到低 $price=1 价格从低到高 $price=0;

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
	if($style==1){
	$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2  FROM `commodity` where  Title LIKE '%$title%' and del='0'");
	}elseif($style==0){
	 if(!isset($CommodityClassid)){
			if($type=="order"){
							if($sort==1){
							$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and Pinpai='$title' or Types='$title' or Country='$title'  order by CreatTime asc");

							}elseif($sort==0){
							$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0'  and Pinpai='$title' or Types='$title' or Country='$title'   order by CreatTime desc");
							}
			}elseif($type=="num"){
							if($sort==1){
						    $dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and Pinpai='$title' or Types='$title' or Country='$title'   order by ABS(`Num`)  desc");

							}elseif($sort==0){
							$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2  FROM `commodity` where del='0'  and Pinpai='$title' or Types='$title' or Country='$title'   order by ABS(`Num`) asc");
							}
			}elseif($type=="price"){
						  if($sort==1){
							$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2  FROM `commodity` where del='0'  and Pinpai='$title' or Types='$title' or Country='$title'   order by ABS(`NewPrice`)  desc");

							}elseif($sort==0){
							$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2  FROM `commodity` where del='0' and Pinpai='$title' or Types='$title' or Country='$title'    order by ABS(`NewPrice`)  asc");
							}
			 }
		}else{
			//当从价格区间里面的链接点击进来的时候
			if($type=="order"){
							if($sort==1){
								if(strpos($title,'以上')===false){ //不包含
								  $price_arr=explode("-",$title);
									$first_area=$price_arr[0];
									$last_area=$price_arr[1];
                  $dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and $last_area > NewPrice  order by CreatTime desc");
								}else{ //包含
									$price_arr=explode('以上',$title);
									$first_area=$price_arr[0];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area order by CreatTime desc");
								}
							}elseif($sort==0){

								if(strpos($title,'以上')===false){ //不包含
									$price_arr=explode("-",$title);
									$first_area=$price_arr[0];
									$last_area=$price_arr[1];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and $last_area > NewPrice  order by CreatTime asc");
								}else{ //包含
									$price_arr=explode('以上',$title);
									$first_area=$price_arr[0];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area order by CreatTime asc");
								}

							}
			}elseif($type=="num"){
							if($sort==1){

								if(strpos($title,'以上')===false){ //不包含
									$price_arr=explode("-",$title);
									$first_area=$price_arr[0];
									$last_area=$price_arr[1];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and $last_area > NewPrice  order by ABS(`Num`)  desc");
								}else{ //包含
									$price_arr=explode('以上',$title);
									$first_area=$price_arr[0];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area order by ABS(`Num`)   desc");
								}

							}elseif($sort==0){
								if(strpos($title,'以上')===false){ //不包含
									$price_arr=explode("-",$title);
									$first_area=$price_arr[0];
									$last_area=$price_arr[1];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and $last_area > NewPrice  order by ABS(`Num`)  asc");
								}else{ //包含
									$price_arr=explode('以上',$title);
									$first_area=$price_arr[0];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area order by ABS(`Num`)   asc");
								}
							}
			}elseif($type=="price"){
							if($sort==1){

								if(strpos($title,'以上')===false){ //不包含
									$price_arr=explode("-",$title);
									$first_area=$price_arr[0];
									$last_area=$price_arr[1];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and $last_area > NewPrice  order by ABS(`NewPrice`)  desc");
								}else{ //包含
									$price_arr=explode('以上',$title);
									$first_area=$price_arr[0];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area order by ABS(`NewPrice`)   desc");
								}

							}elseif($sort==0){
								if(strpos($title,'以上')===false){ //不包含
									$price_arr=explode("-",$title);
									$first_area=$price_arr[0];
									$last_area=$price_arr[1];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area and $last_area > NewPrice  order by ABS(`NewPrice`)  asc");
								}else{ //包含
									$price_arr=explode('以上',$title);
									$first_area=$price_arr[0];
									$dosql->Execute("SELECT Id,Title,Explains,Images,shprice,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,Num,yuyue,picurl2 FROM `commodity` where del='0' and CommodityClass='$CommodityClassid' and  NewPrice >= $first_area order by ABS(`NewPrice`)   asc");
								}
							}
			 }
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
if($type=="num"){
//按照付款时间降序排序
$paytime = array();
foreach ($Data as $user) {
		$paytime[] = $user['month_nums'];
}
if($sort==1){
array_multisort($paytime, SORT_DESC, $Data);
}elseif($sort==0){
array_multisort($paytime, SORT_ASC, $Data);
}
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
