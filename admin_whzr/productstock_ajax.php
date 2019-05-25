<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2017 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'commoditystock';
$gourl  = 'businessshow.php?Commercial='.$Commercial;


//引入操作类
require_once(ADMIN_INC.'/action.class.php');


//修改库存
 if($action == 'update')
{
	$sql = "UPDATE `$tbname` SET Stock='$Stock' WHERE id='$id'";
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
