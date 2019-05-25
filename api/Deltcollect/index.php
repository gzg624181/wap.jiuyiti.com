<?php
    /**  
	 * 链接地址：Deltcollect
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
     * @return string  删除收藏 Deltcollect
     *           
     * @删除收藏 提供返回参数账号
	 *
     *id :id 提供删除的id
	 
     */
require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();
    
	$row = $dosql->GetOne("SELECT * FROM `collect` WHERE Id='$id'");
    //执行一个不返回结果的SQL语句，如update,delete,insert等。 
	if(is_array($row)){
	$dosql->QueryNone("DELETE FROM `collect` WHERE Id='$id'");	
$State = 1;
$Descriptor = '数据删除成功！';	
$Data[]=$row;
$result = array     (
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