<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-22 21:58:57
person: Feng
**************************
*/

     echo "<td height='64' align='right' >订单产品图片：</td>";
     echo "<td colspan='10'>";
     echo "<ul id='picarr_area'>";
$dosql->Execute("SELECT Images FROM ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
	while($row=$dosql->GetArray()){
	
	 echo "<li style='float: left;margin-left: 20px;margin-top: 5px;' rel='".$row['Images']."'>";
     echo "<img src='../".$row['Images']."' width='150' height='120'>";
     echo "</li>";					
	}
     echo "</ul>";
     echo "</td>";	
		


?>
