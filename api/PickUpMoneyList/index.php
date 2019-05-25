<?php
    /**  
	 * 链接地址：PickUpMoneyList
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
     * @提现记录 
	   提供返回参数账号
	 *  商户账号：Commercial  开始时间 $start   结束时间$end
	 */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

if(isset($start) && $start !="" && isset($end) && $end !=""){
$dosql->Execute("SELECT * FROM `pickupmoney` WHERE Commercial='$commercial' and ApplyTime >='$start' and ApplyTime <= '$end'");
}else{
$dosql->Execute("SELECT * FROM `pickupmoney` WHERE Commercial='$commercial'");	
}
if($dosql->GetTotalRow()>0){
while($row = $dosql->GetArray())
{
	$Data[]=$row;
}
$State = 1;
$Descriptor = '数据查询成功！';	
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