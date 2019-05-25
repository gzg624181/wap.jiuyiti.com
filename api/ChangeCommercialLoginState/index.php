<?php
    /**  
	 * 链接地址：ChangeCommercialLoginState
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
     * @修改会员信息 Editmemberuser 
	 
	  提供返回参数账号
	  
	   登录状态：LoginState     商户账号：commercial
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();


	
	//修改商户会员是否登陆上线，0未上线 1上线
	
	if($online==0){ 
	$sql = "UPDATE `commercialuser` SET  online=1 WHERE `Commercial`='$commercial'";
	}elseif($online==1){
	$sql = "UPDATE `commercialuser` SET  online=0 WHERE `Commercial`='$commercial'";		
	}
	$dosql->ExecNoneQuery($sql);

    $row = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
	if(is_array($row)){
    $State = 1;
    $Descriptor = '数据查询成功！';	
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