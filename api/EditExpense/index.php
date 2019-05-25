<?php
    /**  
	 * 链接地址：EditExpense
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
     * @return string   修改消费记录接口
     *           
     * 提供返回参数账号  usnumber :会员账号  number:数量  commodity:商户id  money:金额  commercial:商户id
     */
require_once('../../include/config.inc.php');

/*$usnumber = isset($usnumber) ? $usnumber : '' ;
$number = isset($number) ? $number : '' ;
$commodity = isset($commodity) ? $commodity : '' ;
$money = isset($money) ? $money : '' ;
$commercial = isset($commercial) ? $commercial : '' ;*/

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();


	
	//修改消费记录接口
	$sql = "UPDATE `expense` SET Number='$number', Commodity='$commodity', Money='$money', Commercial='$commercial' WHERE Usnumber='$usnumber'";
	$dosql->ExecNoneQuery($sql);
	

    $row = $dosql->GetOne("SELECT * FROM `expense` WHERE Usnumber='$usnumber'");
	if(is_array($row)){
    $State = 1;
    $Descriptor = '数据查询成功';
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
	$Descriptor = '获取数据失败';
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