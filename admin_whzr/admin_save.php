<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('admin');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-30 10:46:30
person: Feng
**************************
*/


//初始化参数
$tbname = '#@__admin';
$gourl  = 'admin.php';
$action = isset($action) ? $action : '';


//添加管理员
if($action == 'add')
{

	//只有超级管理员才有权创建超级管理员
	if($cfg_adminlevel > 1 and $levelname == 1)
	{
		ShowMsg('非法的操作，不能创建超级管理员！', '-1');
		exit();
	}


/*	//判断用户名是否合法
	if(preg_match("/[^0-9a-zA-Z_@!\.-]/",$username) ||
	   preg_match("/[^0-9a-zA-Z_@!\.-]/",$password))
	{
		ShowMsg('用户名或密码非法！请使用[0-9a-zA-Z_@!.-]内的字符！', '-1');
		exit();
	}
*/

	//判断用户名是否存在
	if($dosql->GetOne("SELECT `id` FROM `$tbname` WHERE `username`='$username'"))
	{
		ShowMsg('用户名已存在！', '-1');
		exit();
	}
 
     //获取用户省份
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_prov'");
	// print_r($row);
	 $live_provs=$row['dataname'];
	//获取用户城市
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_city'");
     $live_citys=$row['dataname']; 

	$password  = md5(md5($password));
	$loginip   = '127.0.0.1';
	$logintime = time();

	$sql = "INSERT INTO `$tbname` (username, password, nickname, question, answer, levelname, checkadmin, loginip, logintime,live_prov,prov,live_city,city,phone) VALUES ('$username', '$password', '$nickname', '$question', '$answer', '$levelname', '$checkadmin', '$loginip', '$logintime','$live_provs','$live_prov','$live_citys','$live_city','$phone')";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}


//修改管理员
else if($action == 'update')
{

	//创始人账号不允许更改状态
	if($id == 1 and ($checkadmin != 'true' or $levelname != '1'))
	{
		ShowMsg('抱歉，不能更改创始账号状态！','-1');
		exit();
	}


	//只有超级管理员才有权修改超级管理员
	if($cfg_adminlevel > 1 and $levelname == 1)
	{
		ShowMsg('非法的操作，不能修改为超级管理员！', '-1');
		exit();
	}


	if($password == '')
	{
	//获取商品省份
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_prov'");
	// print_r($row);
	 $live_provs=$row['dataname'];
	//获取商品城市
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_city'");
     $live_citys=$row['dataname'];
	 if($level==1){
		$sql = "UPDATE `$tbname` SET nickname='$nickname',jiuqian='$jiuqian', question='$question', answer='$answer', levelname='$levelname', checkadmin='$checkadmin',live_prov='$live_provs',live_city='$live_citys',prov='$live_prov',city='$live_city',phone='$phone' WHERE `id`=$id";
	 }else{
		$sql = "UPDATE `$tbname` SET question='$question', jiuqian='$jiuqian', answer='$answer', levelname='$levelname',live_prov='$live_provs',live_city='$live_citys',prov='$live_prov',city='$live_city' WHERE `id`=$id"; 
	 }
	}
	else
	{
		$oldpwd   = md5(md5($oldpwd));
		$password = md5(md5($password));

		$r = $dosql->GetOne("SELECT `password` FROM `#@__admin` WHERE `id`=$id");
		if($r['password'] != $oldpwd)
		{
			ShowMsg('抱歉，旧密码错误！','-1');
			exit();
		}
		
    //获取商品省份
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_prov'");
	// print_r($row);
	 $live_provs=$row['dataname'];
	//获取商品城市
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_city'");
     $live_citys=$row['dataname'];
	if($level==1){
	$sql = "UPDATE `$tbname` SET password='$password', nickname='$nickname', question='$question', answer='$answer', levelname='$levelname', checkadmin='$checkadmin',live_prov='$live_provs',live_city='$live_citys',prov='$live_prov',city='$live_city',phone='$phone' WHERE id=$id";
	}else{
	$sql = "UPDATE `$tbname` SET password='$password',question='$question', answer='$answer', levelname='$levelname',live_prov='$live_provs',live_city='$live_citys',prov='$live_prov',city='$live_city' WHERE id=$id";		
	}
	}

	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}


//修改管理员审核状态
else if($action == 'check')
{

	if($id == 1)
	{
		ShowMsg('抱歉，不能更改创始账号状态！','-1');
		exit();
	}


	if($checkadmin == 'true')
		$sql = "UPDATE `$tbname` SET checkadmin='false' WHERE `id`=$id";
	if($checkadmin == 'false')
		$sql = "UPDATE `$tbname` SET checkadmin='true' WHERE `id`=$id";


	if($dosql->ExecNoneQuery($sql))
	{
    	header("location:$gourl");
		exit();
	}
}


//删除管理员
else if($action == 'del')
{
	if($id == 1)
	{
		ShowMsg('抱歉，不能删除创始账号！','-1');
		exit();
	}

	if($dosql->ExecNoneQuery("DELETE FROM `$tbname` WHERE `id`=$id"))
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
