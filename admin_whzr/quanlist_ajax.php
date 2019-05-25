<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');
//$id='0';
echo "<select name='money' id='money' class='input'  style='width:286px;'>";
$dosql->Execute("SELECT * FROM `coupons` where Commodityid='$id'");
while($row = $dosql->GetArray()){
$money=$row['money'];
//echo $money;
echo"<option value='".$money."'>".$money."</option>";
}
echo "</select>";
?>
