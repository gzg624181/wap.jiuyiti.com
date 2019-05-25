<?php
    /**  
	 * 链接地址：ChangeCommercialInfo
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
     * @修改用户信息
	  提供返回参数账号
	   商户账号：Commercial     昵称： NickName       商户名称：CommercialName
       性别：Sex               生日：BirthDate        密码：password          商户名称：CommercialSite
     */
require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();

    if(isset($commercialname)){
	//修改商户名称
	$sql = "UPDATE `commercialuser` SET  CommercialName='$commercialname' WHERE `Commercial`='$commercial'";
	$dosql->ExecNoneQuery($sql);
     }elseif(isset($commercialsite)){
    //修改商户地址
	$sql = "UPDATE `commercialuser` SET  CommercialSite='$commercialsite' WHERE Commercial='$commercial'";
	$dosql->ExecNoneQuery($sql);
    }elseif(isset($nickname)){
    //修改昵称
	$sql = "UPDATE `commercialuser` SET  NickName='$nickname' WHERE Commercial='$commercial'";
	$dosql->ExecNoneQuery($sql);
    }elseif(isset($sex)){
    //修改性别
	$sql = "UPDATE `commercialuser` SET  Sex='$sex' WHERE Commercial='$commercial'";
	$dosql->ExecNoneQuery($sql);
    }elseif(isset($birthdate)){
    //修改出生日期
	$sql = "UPDATE `commercialuser` SET  BirthDate='$birthdate' WHERE Commercial='$commercial'";
	$dosql->ExecNoneQuery($sql);
	}elseif(isset($password)){
    //修改密码
	$password = isset($password) ? md5(md5($password)) : '' ;
	$sql = "UPDATE `commercialuser` SET  PassWord='$password' WHERE Commercial='$commercial'";
	$dosql->ExecNoneQuery($sql);
    }
	//修改头像
	elseif(isset($commercialImg)){
	$sql = "UPDATE `commercialuser` SET  CommercialImg='$commercialImg' WHERE Commercial='$commercial'";
	$dosql->ExecNoneQuery($sql);
		 }
$row = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
if(is_array($row)){
$State = 1;
$Descriptor = '数据修改成功！';	
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
$Descriptor = '数据修改失败!';	
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