<?php
    /**  
     * 添加收藏接口：Addcollect
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
     * @return string  添加评论接口   Addcomment
     *           
     *commodityid :商品id   userid:会员id  
     */

require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();


	
	//像数据库里面导入添加收藏接口
        $id= getrandomstring(20); 
	$orderid= GetOrderID('collect'); //排序
	$r=$dosql->GetOne("SELECT * FROM collect where CommodityId='$commodityid' and UserId='$userid'");
	//如果收藏列表为空，则添加收藏的商品
	if(!is_array($r)){
	$sql = "INSERT INTO `collect` (Id, CommodityId,UserId,CreatTime,Orderid) VALUES ('$id', '$commodityid', '$userid', '$Version','$orderid')";
	$dosql->ExecNoneQuery($sql);
	$row = $dosql->GetOne("SELECT * FROM `collect` WHERE CommodityId='$commodityid' and UserId='$userid'");
	if(is_array($row)){
$State = 1;
$Descriptor = '添加数据成功！';	
$Data[]=$row;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
		'Version' => $Version,
                'Data' => $Data,	
                 );
echo phpver($result);
          }else{
$State = 0;
$Descriptor = '数据添加失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
		'Version' => $Version,
                'Data' => $Data,	
                );
echo phpver($result);
}
}else{
$State = 2;
$Descriptor = '商品已经收藏!';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
		'Version' => $Version,
        );
echo phpver($result);
}
?>