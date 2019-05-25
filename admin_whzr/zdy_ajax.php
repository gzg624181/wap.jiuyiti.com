<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');
$id=$_GET['Id'];
$zdys=$_GET['zdys'];
if($zdys==1){//不启用
$sql = "UPDATE `commercialuser` SET zdy=0 WHERE Id='$id'";
$dosql->ExecNoneQuery($sql);
echo "<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
$sql = "UPDATE `coupons` SET play=0 WHERE Commodityid='$id' and type=2";
$dosql->ExecNoneQuery($sql);
}elseif($zdys==0){//启用
$sql = "UPDATE `commercialuser` SET zdy=1 WHERE Id='$id'";
$dosql->ExecNoneQuery($sql);
echo "<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";	
$sql = "UPDATE `coupons` SET play=1 WHERE Commodityid='$id' and type=2";
$dosql->ExecNoneQuery($sql);
}

?>