<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');
IsModelPriv('infolist');

//初始化参数
$tbname = 'commoditystock';
$gourl  = 'businessshow.php';
$add_time=date("Y-m-d");
$Commercial  = isset($Commercial)  ? $Commercial  : '';
$array=explode(",",$Id);
 //print_r($array);
	$sql=$dosql->Execute("select * from `$tbname` where CommercialUser='$Commercial'");
	while($row = $dosql->GetArray())
	   {
	 $i[]=$row['CommodityId'];	
	   }
 //	print_r($i);
 //	echo "<Br>";
foreach ($array as $key=>$v1) {
  echo $key."=>". $v1."<br />";
foreach($i as $key2=>$v2){
if($v1==$v2){
  unset($array[$key]);//删除$a数组同值元素
  unset($i[$key2]);//删除$b数组同值元素
}
}
}
 //print_r($array);

	
	for($j=0;$j<count($array);$j++){
	$sql = "INSERT INTO `$tbname` (CommodityId,CommercialUser,add_time) VALUES ('$array[$j]', '$Commercial','$add_time')";
	$dosql->ExecNoneQuery($sql);
	}
	header("location:$gourl");
	exit();	


?>