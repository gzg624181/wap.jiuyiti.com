<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2015 phpMyWind.com
update: 2014-5-22 21:58:57
person: Feng
**************************
*/

echo "<td height='62' align='center' ></td>";
echo "<td  align='center' ></td>";
echo "<td  align='center' ></td>";
echo "<td  align='center' ></td>";
echo "<td colspan='2' align='center'>";
$dosql->Execute("SELECT Images,Title,CommodityId FROM ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
while($row=$dosql->GetArray()){
$id=$row['CommodityId'];
echo "<img title='".$row['Title']."' src='../".$row['Images']."' style='border-radius:3px;width:90px;height:60px;padding:5px;'>";
}
echo "</td>";
echo "<td  align='center' ></td>";
echo "<td align='center' ></td>";
echo "<td align='center' ></a>
</td>";


?>
