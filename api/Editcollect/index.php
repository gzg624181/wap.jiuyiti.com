<?php
    /**  
	 * 修改收藏接口：Editcollect
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
     *id :id   commodityid:商品id  userid:会员id 
     */
require_once('../../include/config.inc.php');

/*$id = isset($id) ? $id : '' ;
$commodityid = isset($commodityid) ? $commodityid : '' ;
$userid = isset($userid) ? $userid : '' ;*/

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();

	//修改收藏接口
	$sql = "UPDATE `collect` SET CommodityId='$commodityid', UserId='$userid' WHERE `Id`='$id'";
	$dosql->ExecNoneQuery($sql);
    $row = $dosql->GetOne("SELECT *  from  `collect` WHERE Id='$id'");
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