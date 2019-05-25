<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');
if($status==0){
  $changestatus=1;
 $playstatus="<i style='color:#179545;cursor:pointer' class='fa fa-check'></i>";
}elseif($status==1){
  $changestatus=0;
  $playstatus="<i style='color:red;cursor:pointer' class='fa fa-close'></i>";
}
$sql = "UPDATE `pmw_comment` SET status=$changestatus WHERE Id=$id";
$dosql->ExecNoneQuery($sql);
echo $playstatus;
?>
