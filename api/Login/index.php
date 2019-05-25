
<?php
    /**  
	 * 链接地址：Login
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
     * @会员登录接口 提供返回参数账号，手机号：account   密码 password
     */ 
require_once("../../include/config.inc.php");
  
$password = isset($password) ? md5(md5("$password")) : '' ;

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();

$row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE `Account`='$account' and Password='$password'");
if(is_array($row)){
$sql = "UPDATE memberuser SET devicetype=$devicetype  WHERE `Account`='$account' and Password='$password'";
$dosql->ExecNoneQuery($sql);	
$rows = $dosql->GetOne("SELECT * FROM `memberuser` WHERE `Account`='$account' and Password='$password'");
$State = 1;
$Descriptor = '登录成功！';	
$Data[]=$rows;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '账号或密码错误!';	
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