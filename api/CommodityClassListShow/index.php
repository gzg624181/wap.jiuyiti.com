<?php
    /**
	 * 链接地址：CommodityClassListShow

     * 下面直接来连接操作数据库进而得到json串
     *
     * @param unknown $State 状态码
     *
     * @param string $Descriptor  提示信息
     *
     * @param array $Data 数据
     *
     * @return string  商品类别列表接口
     */

require_once('../../include/config.inc.php');
$id  = isset($id)  ? $id  : 18;
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$first=0;
$second=1;
$three=2;
$four=3;
$five=4;
$Hotpinpai="";
$Leixing="";
$Country="";
$Price_area="";

$dosql->Execute("SELECT id,classname,picurl FROM `pmw_maintype` where parentid=$id and checkinfo='true'",$first);
if($dosql->GetTotalRow($first)>0){

for($i=0;$i<$dosql->GetTotalRow($first);$i++){
			$row=$dosql->GetArray($first);
		    $arr[$i]=$row;
			}
$pid=$arr[0]["id"]; //获取热门品牌
$dosql->Execute("SELECT id,classname,picurl FROM `pmw_maintype` where parentid=$pid and parentstr like '%$pid%' and checkinfo='true'",$second);
$i=0;
while($i<$dosql->GetTotalRow($second))
{
	$row=$dosql->GetArray($second);
	$Hotpinpai[$i]=$row;
	$i++;
}

$lid=$arr[1]["id"];//获取所有的类型的数据
$dosql->Execute("SELECT id,classname,picurl FROM `pmw_maintype` where parentid=$lid and parentstr like '%$lid%' and checkinfo='true'",$three);
$i=0;
while($i<$dosql->GetTotalRow($three))
{
	$row=$dosql->GetArray($three);
	$Leixing[$i]=$row;
	$i++;
}

$cid=$arr[2]["id"]; //获取所有的国家的数据
$dosql->Execute("SELECT id,classname,picurl FROM `pmw_maintype` where parentid=$cid and parentstr like '%$cid%' and checkinfo='true'",$four);
$i=0;
while($i<$dosql->GetTotalRow($four))
{
	$row=$dosql->GetArray($four);
	$Country[$i]=$row;
	$i++;
}

$aid=$arr[3]["id"]; //获取价格区间
$dosql->Execute("SELECT id,classname,picurl FROM `pmw_maintype` where parentid=$aid and parentstr like '%$aid%' and checkinfo='true'",$five);
$i=0;
while($i<$dosql->GetTotalRow($five))
{
	$row=$dosql->GetArray($five);
	$Price_area[$i]=$row;
	$i++;
}

$arrs=array(
      array("name"=>"hotpinpai","chinesename"=>"热门品牌"),
	 		array("name"=>"leixing","chinesename"=>"类型"),
	    array("name"=>"country","chinesename"=>"国家"),
			array("name"=>"pricearea","chinesename"=>"价格区间")
);
foreach($arrs as $v=>$k){
   $Type[$v]=$k;
}

$Data = array(
        "hotpinpai"=>$Hotpinpai,
				"leixing"=>$Leixing,
				"country"=>$Country,
				"pricearea"=>$Price_area
);
$State = 1;
$Descriptor = '数据查询成功';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version,
								'Id'=>$id,
								'Type'=>$Type,
                'Data' => $Data,
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据查询失败!';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version,
								'Id'=>$id,
        );
echo phpver($result);
}

?>
