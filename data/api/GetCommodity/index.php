<?php
    /**
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param unknown $status 状态码
     *            
     * @param string $message  提示信息
     *           
     * @param array $data 数据
     *            
     * @return string
     */
	 
header("Content-type: text/html; charset=utf-8");
//require_once('../../include/config.inc.php');
require_once(dirname(__FILE__).'/../../../include/config.inc.php');
require_once 'Response.php';
$status = false;
$msg = '0';
$data = array();
$createtime=date("Y-m-d h:i:s");

$dosql->Execute("SELECT * FROM `commodity` WHERE del='0'");
if($dosql->GetTotalRow()<0){
$status = true;
$msg = '获取数据成功';
$i=0;
while($i<$dosql->GetTotalRow())
{
	$data[$i]=$row = $dosql->GetArray();
	$i++;
}

echo Response::json($status,$msg,$data,$createtime);
}else{
echo Response::json($status,$msg,$data,$createtime);
}



?>