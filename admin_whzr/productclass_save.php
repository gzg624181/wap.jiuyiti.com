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

//添加商品
if($action == 'add')
{
	$sql = "INSERT INTO `$tbname` (ClassName,CreatTime) VALUES ('$ClassName','$CreatTime')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}

//设置库存
else if($action == 'update_new')
{
	if($Stock>=$Warn){
	$jinggao=0;	  //0不警告
    }else{
	$jinggao=1;	  //1警告
	}
	$one=1;
	$two=2; 
	//这个店铺的所有的商品列表，更新库存里面的商品数量，警告数量，
	$sql = "UPDATE `$tbname` SET Stock='$Stock',Warn='$Warn',jinggao='$jinggao' WHERE id='$id'";
	$dosql->ExecNoneQuery($sql);
	//第一次添加商品补货的记录
	$tbname = 'stock_record';
	$add_time=date("Y-m-d,h:i:s");
	$sql = "INSERT INTO `$tbname` (pid,name,num,add_time) VALUES ('$CommodityId','$Commercial','$Stock','$add_time')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}
//修改库存
else if($action == 'update_old')
{
	$sum_stock=$Stock+$newadd;
	if($sum_stock>=$Warn){
	$jinggao=0;	  //0不警告
    }else{
	$jinggao=1;	  //1警告
	}
	$sql = "UPDATE `$tbname` SET Stock='$sum_stock',Warn='$Warn',jinggao='$jinggao' WHERE id='$id'";
	$dosql->ExecNoneQuery($sql);
	$tbname = 'stock_record';
	$add_time=date("Y-m-d,h:i:s");
	$r=$dosql->GetOne("SELECT * FROM `commodity` where Id='$CommodityId'");
	$title=$r["Title"];
	$sql = "INSERT INTO `$tbname` (pid,name,num,title,add_time) VALUES ('$CommodityId','$Commercial','$newadd','$title','$add_time')";
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
