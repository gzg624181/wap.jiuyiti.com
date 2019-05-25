<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'pickupmoney';
$gourl  = 'money.php';



//引入操作类
require_once(ADMIN_INC.'/action.class.php');
$Version=date("Y-m-d H:i:s");
$posttime=date("Y-m-d");
//修改提现
if($action == 'update')
{

	$sql = "UPDATE `$tbname` SET  State=1,CreatTime='$Version',posttime='$posttime' WHERE id='$id'";

	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}elseif($action == 'del5')
{

	$sql = "delete from `$tbname` WHERE id='$id'";

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
