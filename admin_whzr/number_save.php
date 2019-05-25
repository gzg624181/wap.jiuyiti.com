<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'money';
$gourl  = 'number.php';



//引入操作类
require_once(ADMIN_INC.'/action.class.php');

if($action == 'add')
{    
	$sql = "INSERT INTO `$tbname` (number,creatime) VALUES ('$money','$creatime')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}
//修改
else if($action == 'update')
{
	$sql = "UPDATE `$tbname` SET number=$money,fanwei='$fanwei' WHERE id=$id";
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
