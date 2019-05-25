<?php
    /**  
	 * Gd
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
     * @根据商户id查询商品
     */
	 
require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$row = $dosql->GetOne("SELECT * FROM `gd` WHERE id=1");
$play=$row['play'];  //1显示 0,不显示
$now=strtotime(date('Y-m-d h:i:s',time()));	 //获得当前时间
	//获得截止时间
$endtime=strtotime($row['jztime']);
$diff=$endtime-$now;

if($play==1 && $diff>=0){
$State = 1;
$Data[]=$row;
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