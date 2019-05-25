<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');
if($id=="0"){   //当传过来的值为0的时候，显示通用优惠券
echo "通用优惠券";
}else{
$row=$dosql->GetOne("SELECT * FROM `commercialuser` where Id='$id'");
$address=$row['CommercialSite'];
echo $address;
}
?>