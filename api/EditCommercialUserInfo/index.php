<?php
    /**  
	 * 链接地址：EditCommercialUserInfo
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
     * @修改会员信息 提供返回参数账号 CommercialSite   Linkman Phone
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();
    
	 if(isset($CommercialSite) || isset($Linkman) || isset($Phone)){  //商户地址
	$sql = "UPDATE `commercialuser` SET  CommercialSite='$CommercialSite',Linkman='$Linkman',Phone='$Phone' WHERE `Commercial`='$commercial'";
	$dosql->ExecNoneQuery($sql);
    }
	//修改商户信息之后，同时更新商户的缓存
    $row=$dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
	$date[]=$row;
	$cachename=$row['Id'];
	GetCache($date,$cachename); 
	
$file = "../../cache/".$cachename.".txt";  
$msg = Readf($file);  
$Data = unserialize($msg); 
if(count($Data)>0){
$State = 1;
$Descriptor = '修改成功！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '修改失败!';	
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