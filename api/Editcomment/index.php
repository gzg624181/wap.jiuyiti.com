<?php
    /**  
	 * 链接地址：Editcomment
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
     * @return string  修改评论接口 Editcomment
     *           
     * @修改评论接口 提供返回参数账号
	 *
     *Id :Id   CommodityId:商品id  Content:评论内容  UserId:会员id  UserName:会员名称   ContentType:状态
	 
     */
require_once('../../include/config.inc.php');

/*$Id = isset($Id) ? $Id : '' ;
$CommodityId = isset($CommodityId) ? $CommodityId : '' ;
$Content = isset($Content) ? $Content : '' ;
$UserId = isset($UserId) ? $UserId : '' ;
$UserName = isset($UserName) ? $UserName : '' ;
$ContentType = isset($ContentType) ? $ContentType : '' ;*/

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();


	
	//修改会员订单
	$sql = "UPDATE `comment` SET CommodityId='$CommodityId', Content='$Content', UserId='$UserId', UserName='$UserName', ContentType='$ContentType' WHERE `Id`='$Id'";
	$dosql->ExecNoneQuery($sql);
	

    $row = $dosql->GetOne("SELECT * FROM `comment` WHERE Id='$Id'");
	if(is_array($row)){
    $State = 1;
    $Descriptor = '数据修改成功';
    $Data[]=$row;                 
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $json = preg_replace_callback("#\\\u([0-9a-f]{4})#i", function ($matches) {
        return iconv('UCS-2BE', 'UTF-8', pack('H4', $matches[1]));
        }, json_encode($result));
	echo $json;
} else {
    $json = json_encode($result, JSON_UNESCAPED_UNICODE);
	echo $json;
}
}else{
    $State = 0;
	$Descriptor = '数据修改失败';
    $value = array(
    $State,
    $Descriptor,
	$Version,
	$Data=array()
     );
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $json = preg_replace_callback("#\\\u([0-9a-f]{4})#i", function ($matches) {
        return iconv('UCS-2BE', 'UTF-8', pack('H4', $matches[1]));
        }, json_encode($result));
	echo $json;
} else {
    $json = json_encode($result, JSON_UNESCAPED_UNICODE);
	echo $json;
}
}
?>