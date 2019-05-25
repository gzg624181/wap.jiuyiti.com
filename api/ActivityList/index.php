<?php
    /**
	 * 链接地址：ActivityList
	 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param unknown $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
     *            
     * @return string  查询活动列表
     */
	 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$dosql->Execute("SELECT * FROM `commodity` where gd=1 and del='0'");
if($dosql->GetTotalRow()>0){
$i=0;
while($i<$dosql->GetTotalRow())
{
	$Data[$i]=$row = $dosql->GetArray();
	$i++;
}
$State = 1;
$Descriptor = '数据查询成功';	
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