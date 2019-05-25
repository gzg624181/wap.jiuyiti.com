<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

//会员管理
//检测用户是否存在
if($action == 'checkuser')
{

	$r = $dosql->GetOne("SELECT `Commercial` FROM `commercialuser` WHERE Commercial='$Commercial'");

	if(!is_array($r))
		echo '<span class="reok">可以使用</span>';
	else
		echo '<span class="renok">用户名已存在</span>';
	exit();
}


 ?>
