<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2017 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'activitys';
$gourl  = 'promotion.php';


//引入操作类
require_once(ADMIN_INC.'/action.class.php');

//添加活动
if($action == 'add')
{

	$sql = "INSERT INTO `$tbname` (ActivityId,Image, Url, orderid, CreatTime) VALUES ('$ActivityId','$picurl', '$Url', '$orderid', '$CreatTime')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}

//修改活动列表
else if($action == 'update')
{
	$sql = "UPDATE `$tbname` SET Image='$picurl', Url='$Url' ,orderid='$orderid' WHERE id=$id";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}
//无条件返回
else
{
    header("location:$gourl");
	exit();
}
?>
