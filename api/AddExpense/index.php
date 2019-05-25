<?php
    /**  
     *      链接地址：AddExpense
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
     *     
     * @param array $Data 数据
     *            
     * @return string 
     *           
     * @添加消费记录接口 提供返回参数账号
     * usnumber :会员账号  number:数量  commodity:商户id  money:金额  commercial:商户id
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


	
	//添加消费记录接口
    $id= getrandomstring(20); 
    $orderid= GetOrderID('expense'); //排序
    $sql = "INSERT INTO `expense` (Id,Usnumber,CreateTime,Number,Commodity,Money,Commercial,orderid) VALUES ('$id','$usnumber', '$Version', '$number', '$commodity','$money','$commercial','$orderid')";
   $dosql->ExecNoneQuery($sql);
	

    $row = $dosql->GetOne("SELECT * FROM `expense` WHERE Usnumber='$usnumber'");
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