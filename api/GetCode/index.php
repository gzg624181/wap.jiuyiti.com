<?php
    /**  
	 * 链接地址：ReadCode
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
     * @获取商品详情  购物券id
     */
	 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

//0失败，1成功，2.已使用 3.已过期
//判断是否存在这个商户
//$id=8;
$r=$dosql->GetOne("select * from couponslist where id=$id");
//print_r($r);
if(is_array($r)){
	if($r['state']==1){
        $Data[]=$r;
  	    $State = 1;
        $Descriptor = '数据扫码成功！';  
        $result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'Data' => $Data
                 );
        echo phpver($result);
        }else{
$State = 2;
$Descriptor = '数据扫码失败!';	
$Data[]=$r;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'Data' => $Data
        );
echo phpver($result);
}
}else{
$State = 0;
$Descriptor = '数据获取失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'Data' => $Data
        );
echo phpver($result);		
}
?>
