<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2017 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'shuoming';
$gourl  = 'shuoming.php';


//引入操作类
require_once(ADMIN_INC.'/action.class.php');


//修改说明内容
if($action == 'update'){   

	$sql = "UPDATE `$tbname` SET title='$title',content='$Details',posttime='$CreatTime' WHERE id=1";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}elseif($action == 'update_gonggao'){   

	$sql = "UPDATE `$tbname` SET title='$title',content='$Details',posttime='$CreatTime' WHERE id=2";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl  = 'gonggao.php';
		header("location:$gourl");
		exit();
	}
}
elseif($action == 'upapp_update'){   
    $tbname = 'upapp';
    $gourl  = 'upapp.php';
	$sql = "UPDATE `$tbname` SET appName='$appName',url='$picurl',version='$version',picurl='$picurl1',lianjie='$lianjie' WHERE id=1";
	if($dosql->ExecNoneQuery($sql))
	{
	ShowMsg('更新成功!',$gourl);
	exit();
	}
}
elseif($action == 'gd_update'){   
    $tbname = 'gd';
    $gourl  = 'gd.php';
	$sql = "UPDATE `$tbname` SET picurl='$picurl',jztime='$jztime',play='$play' WHERE id=1";
	if($dosql->ExecNoneQuery($sql))
	{   
    ShowMsg('更新成功!',$gourl);
	exit();
	}
}
elseif($action == 'business_update'){   
    $tbname = 'upapp';
    $gourl  = 'business_app.php';
	$sql = "UPDATE `$tbname` SET appName='$appName',url='$picurl',version='$version',picurl='$picurl1',lianjie='$lianjie' WHERE id=2";
	if($dosql->ExecNoneQuery($sql))
	{
	ShowMsg('更新成功!',$gourl);
	exit();
	}
}
elseif($action == 'update_recommendactivities'){   
    $gourl  = 'recommendactivities.php';
	$sql = "UPDATE `$tbname` SET title='$title',content='$content',picurl='$picurl',picurl1='$picurl1',posttime='$CreatTime' WHERE id=3";
	if($dosql->ExecNoneQuery($sql))
	{
	ShowMsg('更新成功!',$gourl);
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
