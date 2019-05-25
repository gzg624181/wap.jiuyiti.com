<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 17:11:51
person: Feng
**************************
*/


//初始化参数
$tbname = '#@__banner';
$gourl  = 'business_banner_list.php';
$action = isset($action) ? $action : '';


//引入操作类
require_once(ADMIN_INC.'/action.class.php');


//保存操作
if($action == 'add')
{
	

	$dosql->ExecNoneQuery("INSERT INTO `$tbname` (lnkname, lnklink, lnkico) VALUES ('$lnkname', '$lnklink', '$picurl')");

    header("location:$gourl");
	exit();
}
//修改商家信息
else if($action == 'update')
{

	$sql = "UPDATE `$tbname` SET lnkname='$lnkname',lnklink='$lnklink', lnkico='$picurl' WHERE id=$id";
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
