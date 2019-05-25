<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('admin');

/*
**************************
(C)2010-2018 phpMyWind.com
update: 2018-01-23 10:46:30
person: Gang
**************************
*/


//初始化参数
$tbname = '#@__activelist';
$gourl  = 'active.php';
$action = isset($action) ? $action : '';


//添加活动
if($action == 'add')
{
	$sql = "INSERT INTO `$tbname` (title, introduction, content, xieyi, daima, play, firsttime, endtime) VALUES ('$title', '$introduction', '$content', '$xieyi', '$daima', '$play', '$firsttime', '$endtime')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}


//修改活动列表
else if($action == 'update')
{
	if(strpos($content,$cfg_weburl) !== false){
    //包含
	$contents=$content;
	}else{
	//不包含
	$a="/uploads";
	$b=$cfg_weburl."/uploads";
    $contents=str_replace($a,$b,$content);
	}
	$sql = "UPDATE `$tbname` SET title='$title', introduction='$introduction', content='$contents', xieyi='$xieyi',daima='$daima', play=$play, firsttime='$firsttime',endtime='$endtime',orderid=$orderid WHERE id=$id";

	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}


//修改管理员审核状态
else if($action == 'check')
{

	if($play == 1)
		$sql = "UPDATE `$tbname` SET play=0 WHERE `id`=$id";
	if($play == 0)
		$sql = "UPDATE `$tbname` SET play=1 WHERE `id`=$id";


	if($dosql->ExecNoneQuery($sql))
	{
    	header("location:$gourl");
		exit();
	}
}


//删除商户活动
else if($action == 'del3')
{

	if($dosql->ExecNoneQuery("DELETE FROM `$tbname` WHERE `id`=$id"))
	{
    	header("location:$gourl");
		exit();
	}
}
//删除商户活动
else if($action == 'del4')
{
    $tbname="pmw_signup";
	if($dosql->ExecNoneQuery("DELETE FROM `$tbname` WHERE `id`=$id"))
	{
        $gourls="activecommercial.php?daima=".$daima."&firsttime=".$firsttime."&endtime=".$endtime;
    	header("location:$gourls");
		exit();
	}
}
//保存操作
else if($action == 'saverule')
{
	$gourl="rule.php?daima=".$daima;
	$tbnames = '#@__rule';
	if($rulenameadd != '')
	{
		$dosql->ExecNoneQuery("INSERT INTO `$tbnames` (rulename, rulefirst, ruleend, rulemoney,ruletubiao,orderid,daima) VALUES ('$rulenameadd', '$rulefirstadd', '$ruleendadd', '$rulemoneyadd','$ruletubiaoadd','$orderidadd',$daima)");
	}

	if(isset($id))
	{
		$ids = count($id);
		for($i=0; $i<$ids; $i++)
		{
			$dosql->ExecNoneQuery("UPDATE `$tbnames` SET rulename='$rulename[$i]', rulefirst='$rulefirst[$i]', ruleend='$ruleend[$i]', ruletubiao='$ruletubiao[$i]', rulemoney='$rulemoney[$i]',  orderid='$orderid[$i]' WHERE id=$id[$i]");
		}
	}

    header("location:$gourl");
	exit();
}
//删除活动规则
else if($action == 'del5')
{
    $tbname="#@__rule";
	if($dosql->ExecNoneQuery("DELETE FROM `$tbname` WHERE `id`=$id"))
	{
        $gourls="rule.php?daima=".$daima;
    	header("location:$gourls");
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
