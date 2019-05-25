<?php
    /**
	 * 链接地址：contactus
	 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param integer $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
     *            
     * @return string  联系我们接口
     */
	 
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d h:i:s");
if($cfg_lng !="" or $cfg_lat !=""){	
$State = 1;
$Descriptor = '数据查询成功';
$Data= array(
       'Tel'=>$cfg_hotline,
	   'Address'=>$cfg_address,
	   'QQ'=>$cfg_qq,
	   'Website'=>$cfg_website,
	   'Lng'=>$cfg_lng,
	   'Lat'=>$cfg_lat,
           );	
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