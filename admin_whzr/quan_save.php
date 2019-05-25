<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'coupons';
$gourl  = 'quan.php';



//引入操作类
require_once(ADMIN_INC.'/action.class.php');


if($action == 'add')
{


     $dosql->Execute("select * from money");
	while($row=$dosql->GetArray()){
	$money=$row['number'];
	$fanwei=$row['fanwei'];
	$r=$dosql->GetOne("select * from `$tbname` where money='$money' and Commodityid='$name' and type=1");
	if(!is_array($r)){
	$orderid= GetOrderID('coupons');
	$sql = "INSERT INTO `$tbname` (money,date,logo,Commodityid, orderid,usetime,type,fanwei,play) VALUES ('$money','$date', '$picurl', '$name', '$orderid','$usetime',1,'$fanwei',1)";
    $dosql->ExecNoneQuery($sql);
	}
	}
	$sql = "UPDATE commercialuser SET defaults=1 WHERE Id='$name'";
	$dosql->ExecNoneQuery($sql);
	$gourl_back="def.php?Commercial=".$Commercial;
	header("location:$gourl_back");
	exit();

}
//生成最新系统默认优惠券的金额
elseif($action == 'quan_update')
{
    $dosql->Execute("select * from money");
	while($row=$dosql->GetArray()){
	$money=$row['number'];
	$fanwei=$row['fanwei'];
	$sql = "UPDATE coupons SET money='$money',usetime='$usetime' WHERE fanwei='$fanwei' and Commodityid='$id'";
    $dosql->ExecNoneQuery($sql);
	}
	$gourl_back="def.php?Commercial=".$Commercial;
	ShowMsg("默认优惠券更新成功！",$gourl_back);
	//header("location:$gourl_back");
	exit();

}
else if($action == 'xianjin_add')
{


    $dosql->Execute("select * from money");
	while($row=$dosql->GetArray()){
	$money=$row['number'];
	$fanwei=$row['fanwei'];
	$r=$dosql->GetOne("select * from `$tbname` where money='$money' and Commodityid='$name' and type=2");
	if(!is_array($r)){
	$orderid= GetOrderID('coupons');
	$sql = "INSERT INTO `$tbname` (money,date,logo,Commodityid, orderid,usetime,type,play,fanwei) VALUES ('$money','$date', '$logo', '$name', '$orderid','$usetime',2,0,'$fanwei')";
    $dosql->ExecNoneQuery($sql);
	}
	}
	$sql = "UPDATE commercialuser SET zdy=0 WHERE Id='$name'";
	$dosql->ExecNoneQuery($sql);
	$gourl_back="xianjin.php?Commercial=".$Commercial;
	header("location:$gourl_back");
	exit();

}
//添加会员购物券
else if($action == 'quan_addlist')
{
    //购物券id
	$r=$dosql->GetOne("select * from coupons where money='$money' and Commodityid='$commercial'");
	$gid=$r['id'];

	 if($commercial=="0"){
	 $Commercials=0;
   $dosql->ExecNoneQuery("update coupons set type=3 where id=$gid");
	 }else{
	$s=$dosql->GetOne("select * from commercialuser where Id='$commercial'");
	$Commercials=$s['Commercial']; //商户账号
	 }

  $tbname = 'couponslist';
	$youxiaoqi=date("Y-m-d",strtotime("+".$cfg_month." month",time()));
	$gettime=date("Y-m-d h:i:s",time());
	$sql = "INSERT INTO `$tbname` (gid,account,commercial,creatime,num,money, state,notice,gettime) VALUES ('$gid','$account', '$Commercials', '$youxiaoqi', 1,'$money',0,0,'$gettime')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}
//修改商家信息
else if($action == 'update')
{

	$sql = "UPDATE `$tbname` SET money='$money',logo='$picurl', orderid='$orderid',fanwei='$fanwei',usetime='$usetime',play=$play WHERE id=$id";
	if($dosql->ExecNoneQuery($sql))
	{
        if($type==2){
        $gourl="xianjin.php?Commercial=".$Commercial;
		}else{
		$gourl="def.php?Commercial=".$Commercial;
		}
		header("location:$gourl");
		exit();
	}
}
//删除已经使用过的优惠券
else if($action == 'del3')
{

	$sql = "delete from couponslist WHERE id=$id";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="quanshow.php?account=".$account;
		header("location:$gourl");
		exit();
	}
}
//删除商家优惠券的类型
else if($action == 'del4')
{

	$sql = "delete from coupons WHERE id=$id";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="quan_list.php?id=".$gid;
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
