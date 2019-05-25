<?php
    /**
	 * 链接地址：CollectList
	 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param integer $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
     *            
     * @return string  查询浏览记录接口
     */
	 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$dosql->Execute("SELECT * FROM `collect` where UserId='$userid' order by CreatTime desc");
if($dosql->GetTotalRow()>0){

$i=0;
while($i<$dosql->GetTotalRow())
{  
    $row = $dosql->GetArray();
	$Data[$i]=$row;
	$CommodityId=$row['CommodityId'];		
    $show = $dosql->GetOne("SELECT Id,Title,Explains,Images,NewPrice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,RecommendIndex,CommentNumber,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian FROM `commodity` WHERE Id='$CommodityId'");	
	
    $commodity[]=$show;
	$i++;
}
$State = 1;
$Descriptor = '数据查询成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'commodity'=>$commodity,
                'Data' => $Data
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