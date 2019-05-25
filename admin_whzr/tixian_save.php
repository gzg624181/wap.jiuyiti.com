<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 17:16:14
person: Feng
**************************
*/


//初始化参数
$tbname = 'pickupmoney';
$gourl  = 'admin.php';


//引入操作类
require_once(ADMIN_INC.'/action.class.php');


//添加
if($action == 'add')
{
	
	if($leibie==0){
	$sql = "INSERT INTO `bank` (Commercial, RealName, BankName, BankNo) VALUES   ('$Commercial', '$RealName', '$BankName', '$BankNo')";
	$dosql->ExecNoneQuery($sql);
	}else{
	$sql = "UPDATE `bank` SET  RealName='$RealName',BankName='$BankName',BankNo='$BankNo' WHERE `Commercial`='$Commercial'";
    $dosql->ExecNoneQuery($sql);	
	}

//判断是否有这个区域管理员
	$r = $dosql->GetOne("SELECT * FROM `pmw_admin` WHERE username='$Commercial'");
	if(is_array($r)){
	//申请提现之后，从商家账户中减去提现的金额
	$r = $dosql->GetOne("SELECT * FROM `pmw_admin` WHERE username='$Commercial'");
	if(floatval($r['jiuqian'])>=floatval($ApplyMonery)){
	$jiuqian=floatval($r['jiuqian'])-floatval($ApplyMonery);
	$sql = "UPDATE `pmw_admin` SET  jiuqian='$jiuqian' WHERE `username`='$Commercial'";
    $dosql->ExecNoneQuery($sql);
	$sql = "INSERT INTO `pickupmoney` (Commercial, RealName, BankName, BankNo,ApplyTime,ApplyMonery,types) VALUES ('$Commercial', '$RealName', '$BankName', '$BankNo','$ApplyTime','$ApplyMonery',1)";
	if($dosql->ExecNoneQuery($sql))
	{
		$url="tixian_baobiao.php?nickname=".$RealName."&username=".$Commercial."&applytime=".$ApplyTime;
		ShowMsg('提现申请成功，请等待管理员审核！',$url);
		exit();
	}
	}else{
		$url="tixian.php?nickname=".$RealName."&username=".$Commercial;
		ShowMsg('提现金额不能大于账号现有酒钱！',$url);
		}
	}
	
	
}
//添加商品分类
elseif($action == 'fenlei_add')
{
    $tbname = '#@__fenlei';
	$creatime    =  date("Y-m-d h:i:s",time());
	$sql = "INSERT INTO `$tbname` (fenlei,creatime) VALUES ('$fenlei', '$creatime')";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="fenlei_add.php";
		header("location:$gourl");
		exit();
	}
}

//修改会员信息
else if($action == 'update')
{
    if(!isset($UserName)) $UserName = '';
	if(!isset($Phone)) $Phone = '';
	if(!isset($Alias)) $Alias = '';
	if(!isset($Age)) $Age = '';
	if(!isset($picurl)) $picurl = '';
	if(!isset($Sex)) $Sex = '';
	if(!isset($IdNumber)) $IdNumber = '';
	$sql = "UPDATE `$tbname` SET ";
	if($JiuQian != '')
	{
		$sql .= "UserName='$UserName', Phone='$Phone', Alias='$Alias', Age='$Age', Image='$picurl', Sex='$Sex', IdNumber='$IdNumber', JiuQian='$JiuQian' WHERE Id='$id'";
	}else{
		$sql .= "UserName='$UserName', Phone='$Phone', Alias='$Alias', Age='$Age', Image='$picurl', Sex='$Sex', IdNumber='$IdNumber' WHERE Id='$id'";
		
		}
	


	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}
//删除商品类型类型
elseif($action == 'del4')
{
	$tbname = '#@__fenlei';
	$sql = "delete from `$tbname` where id=$id";
	
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="fenlei_add.php";
		header("location:$gourl");
		exit();
	}
}


//修改商品分类
else if($action == 'fenlei_update')
{
	$dosql->ExecNoneQuery("UPDATE `#@__fenlei` SET `fenlei`='$fenlei' WHERE `id`='$id'");
	ShowMsg('分类修改成功！','fenlei_add.php');
	exit();
}


//无条件返回
else
{
    header("location:$gourl");
	exit();
}
?>
