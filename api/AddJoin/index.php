<?php
    /**
	 * 添加收藏接口：Addjoin
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
     *
     * @param array $Data 数据
     *
     * @return string  我要加盟   AddJoin
     *
     *commodityid :商品id   userid:会员id
     */

require_once('../../include/config.inc.php');

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$type = empty($type) ? 'ztd' : $type;
$Data = array();
	$sql = "INSERT INTO `join` (joinname,type,creattime,joinaddress,joinmessage,joinphone) VALUES ('$joinname','$type','$Version','$joinaddress','$joinmessage','$joinphone')";
	$dosql->ExecNoneQuery($sql);


    $row = $dosql->GetOne("SELECT * FROM `join` WHERE creattime='$Version'");
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
$Descriptor = '数据查询为空';
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
