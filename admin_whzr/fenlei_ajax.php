<?php 
require_once(dirname(__FILE__).'/inc/config.inc.php');
$id=$_GET['id'];
$play=$_GET['play'];
if($play==1){
$sql = "UPDATE `pmw_fenlei` SET play=0 WHERE id='$id'";
}else{
$sql = "UPDATE `pmw_fenlei` SET play=1 WHERE id='$id'";	
}
$dosql->ExecNoneQuery($sql);
header("Location:fenlei_add.php");
exit;
?>