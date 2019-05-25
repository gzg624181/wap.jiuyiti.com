<?php
    /**  
     * 链接地址：Addbrowsing
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
     * @添加浏览记录接口   提供返回参数账号
	 *
     *commodityid :商品id   userid: 会员id
     添加评论接口   
     */

require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();


	
	//像数据库里面导入评论接口 
        $id= getrandomstring(20); 
	$orderid= GetOrderID('browsing'); //排序
	$sql = "INSERT INTO `browsing` (Id, CommodityId, UserId, CreatTime,Orderid) VALUES ('$id', '$commodityid', '$userid', '$Version','$orderid')";
	$dosql->ExecNoneQuery($sql);
	
        $row = $dosql->GetOne("SELECT * FROM `browsing` WHERE Id='$id'");
	if(is_array($row)){
		
$State = 1;
$Descriptor = '数据添加成功！';	
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
?>