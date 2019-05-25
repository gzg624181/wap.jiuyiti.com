<?php
    /**  
	 * 链接地址：SearchCommodity
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
     * @根据条件搜索商品，提供condition条件 不为空则为模糊查询（根据标题或者商品详细说明来查询）
     */
	 
require_once('../../include/config.inc.php');

// $condition = isset($condition) ? $condition : '' ;
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d h:i:s");
$dosql->Execute("SELECT * FROM `commodity` WHERE Title like '%$condition%' or Particular like '%$condition%'");
if($dosql->GetTotalRow()>0){
$State = 1;
$Descriptor = '数据查询成功';
$i=0;
while($i<$dosql->GetTotalRow())
{
	$Data[$i]=$row = $dosql->GetArray();
	$i++;
}

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
	$Descriptor = '数据查询失败';
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