<?php
    /**
	 * 链接地址：TakeGoods
	 *
     * 下面直接来连接操作数据库进而得到json串
     *
     * 按json方式输出通信数据
     *
     * @param unknown $State    状态码
     *
     * @param string $Descriptor  提示信息
     *
	   * @param string $Version    操作时间
     * @param array $Data       数据
     *
     * @return string
     *
     * @提货接口  仅提供提取码 tiquma  商户账号commercial
	   * 需要用到的字段列表（订单号：orderid  商户账号：commercial    会员账号：account  商家的酒钱 jiuqian_business 会员酒钱 jiuqian_user ）
     */

require_once('../../include/config.inc.php');

   //paymenttype 付款类型（1.酒钱 2.现金 3.混合支付）

   //state订单状态订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )

$State = 0;
$sum_price=0;
$jiuqian_user=0;
$jiuqian_business=0;
$Descriptor = '';
$Data = array();
$new_xhs=array();
$year=date("Y",time());//获取当前的年份
$month=date("m",time());//获取当前的月份
$Version=date("Y-m-d H:i:s",time());
$youxiaoqi=date("Y-m-d",strtotime("+".$cfg_month." month",time()));  //优惠券的有效期
/*   提取商品的时候执行以下操作：  */
//  1.将提取的记录保存到表中去，同时更改订单状态
//  2.向商户账号中添加赠送的酒钱
//  3.向会员账号里面添加赠送的酒钱,如果用的是酒钱支付的话，就减去消费完的酒钱
//  4.提取完成之后从商家库存里面减去被提取的商品数量
//  5.向会员账号里面添加赠送的购物券，每次使用只能使用一张（24小时之内只能使用一次）
    //根据购买金额推送发送优惠券面值
	// 100以内返利10元优惠券
	// 100-250 之间返20元优惠券
	// 250-350 之间返100元优惠券
	// 350-600 之间返200元优惠券
  // 600-1000  以上返300元优惠券
$show=$dosql->GetOne("SELECT * FROM `orderform` WHERE tiquma='$tiquma'");
$k=$dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
$CommercialSite=$k['CommercialSite'];
//查询订单里面的下单人,
$account=$show['UserId'];
$address=$show['address'];
$dingdantype=$show['dingdantype'];
//当订单状态是预约订单的时候
if($dingdantype==1){
	if($address!=$CommercialSite){
$State = 2;
$Descriptor = '商品库存不足，提取失败!';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				        'Version' => $Version
        );
echo phpver($result);
	}else{
//查询出购买产品的id
$orderid=$show['OrderId'];
//这个订单里面的所有的商品
$one=1;
$two=2;
$xhs=array();



$dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$one);
while($row=$dosql->GetArray($one)){
	$price[]=$row['Quantity']*$row['NewPrice'];
	$jiuqian[]=$row['Quantity']*$row['JiuQian'];
	$sjjiuqian[]=$row['Quantity']*$row['SJJiuQian'];
  $xhs[]=$row['CommodityId'];	 //商品id
}

$dosql->Execute("SELECT * FROM commoditystock,commodity where commoditystock.CommodityId=commodity.Id and commoditystock.CommercialUser='$commercial'",$two);
while($rows=$dosql->GetArray($two)){
    $new_xhs[]=$rows['CommodityId'];
}

//商品的总价格
foreach($price as $val){
	$sum_price += $val;
}
//会员酒钱
foreach($jiuqian as $val){
	$jiuqian_user += $val;
}
//商家酒钱
foreach($sjjiuqian as $val){
	$jiuqian_business += $val;
}

$a=$xhs;
$b=$new_xhs;

$flag = 1;
foreach ($a as $va) {
  if (in_array($va, $b)) {
    continue;
  }else {
    $flag = 0;
    break;
  }
}



if($flag){
if($show['State']==1){  //判断账号是否付款
$sj=substr($Version,0,10);
//添加提取订单列表
$sql = "INSERT INTO `pickuplist` (Commercial, orderId, pickUpTime, jiuQian,year,month) VALUES ('$commercial','$orderid', '$sj', '$jiuqian_business','$year','$month')";
$dosql->ExecNoneQuery($sql);



//添加商户的酒钱
$rs = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
//$jiuqian_business 会员购买商品返回的酒钱
$JiuQian= intval($jiuqian_business) + intval($rs['JiuQian']); //向账号中添加会员的酒钱
$sql ="UPDATE `commercialuser` SET JiuQian='$JiuQian' WHERE `Commercial`='$commercial'";
$dosql->ExecNoneQuery($sql);


//Account  会员的账号
$g = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$account'");
//$jiuqian_user 会员购买商品返回的酒钱
$JiuQian=intval($jiuqian_user)+intval($g['JiuQian']);  //向账号中添加会员的酒钱
$sql ="UPDATE `memberuser` SET JiuQian='$JiuQian' WHERE `Account`='$account'";
$dosql->ExecNoneQuery($sql);

//判断会员是否有推荐人，如果有的话就按照提成比例返酒钱给推荐人
if($g['Yaoqingma']!="" && $g['classes']!=""){
$recommand=$g['Yaoqingma']; //推荐人的邀请码
$classes=$g['classes'];  //推荐人的类型
if($classes==0){         //推荐人是会员
$table="memberuser";
$type=0;                 //推荐人是商户
}elseif($classes==1){
$table="commercialuser";
$type=1;
}
        $kk = $dosql->GetOne("SELECT * FROM $table WHERE Recommand='$recommand'");	//查询推荐人账号里面的酒钱
		$bilvs=$kk['bilv'];
		$bilv=floatval($kk['bilv'] /100);
		$fanjiuqian=intval(intval($sum_price) * $bilv);
		$jiuqian=intval($kk['JiuQian'])+ $fanjiuqian;
    $dosql->ExecNoneQuery("UPDATE $table SET JiuQian='$jiuqian' WHERE Recommand='$recommand'");
		//将推荐记录保存到数据库中来
		$dosql->ExecNoneQuery("INSERT INTO `recommandlist`(account,tjm,money,bilv, sum_money,posttime,type) VALUES ('$account','$recommand', '$sum_price', '$bilvs', '$fanjiuqian','$Version','$type')");

		/*
		区域管理者提成分为四种情况
		①.是商家推荐的会员，并且会员提货在推荐人那里提货
		②.是商家推荐的会员，不在推荐的商家那里提货
		③.不是商家推荐的会员，但是在商家那里提货
		④.不是商家推荐的会员，不在商家那里提货
		*/
		//①.会员提取商品之后，区域管理者获取提成,推荐人是商户，并且在商家那里提货（商家推荐提成+商家酒钱比率）*区域管理者提成
		if($type==1){  //推荐人是商户的时候，邀请码和商户的推荐码相同
		$sj = $dosql->GetOne("SELECT * FROM commercialuser WHERE Commercial='$commercial'");
		$sj_bilv=$sj['bilv'];         //商户的推荐比率
		$usernames=$sj['username'];   //商户的代理账号
		$shanghurecommand=$sj['Recommand'];  //商户的推荐码
		if($recommand==$shanghurecommand){   //邀请码和商户推荐码相等
		$quyugl=intval(intval($sum_price) * ($cfg_sjmoney+$sj_bilv)/10000 * floatval($cfg_qygl));  //区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                  }
		}else{   //邀请码和商户推荐码不相等
		$quyugl=intval(intval($sum_price) * ($cfg_sjmoney)/10000 * floatval($cfg_qygl));  //区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                  }
		}
		}elseif($type==0){  //推荐人是会员的情况，区域管理员提成只有酒钱提成
	    $sj = $dosql->GetOne("SELECT * FROM commercialuser WHERE Commercial='$commercial'");
		$usernames=$sj['username'];   //商户的代理账号
        $quyugl=intval(intval($sum_price) * ($cfg_sjmoney)/10000 * floatval($cfg_qygl));  //区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                  }
		}

}else{   //当商家没有推荐人的时候
		$sj = $dosql->GetOne("SELECT * FROM commercialuser WHERE Commercial='$commercial'");	//查询商户的提现比率
		$usernames=$sj['username'];  //商户的代理
		$quyugl=intval(intval($sum_price) * ($cfg_sjmoney)/10000 * floatval($cfg_qygl));//       区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                   }
}



//提取完成之后从商家库存里面减去被提取的商品数量，同时添加分店的销量
$dosql->Execute("select * from ordercommodity a inner join commoditystock b on a.CommodityId=b.CommodityId where b.CommercialUser='$commercial' and a.OrderId='$orderid'");
while($row=$dosql->GetArray()){
	$kucun=$row['Stock'] - $row['Quantity'];   //提取完成之后的商品库存
	$commodityId=$row['CommodityId'];
	$warn=$row['Warn'];                        //设置的库存警告
	$salenum=$row['salenum'];                  //本件商品的销量
	$salenum_after=$salenum+$row['Quantity'];
	$jinggao=0;
	if($warn>$kucun){
	$jinggao=1;
	$sql ="UPDATE `commoditystock` SET Stock='$kucun',jinggao=$jinggao,salenum='$salenum_after' WHERE `CommodityId`='$commodityId' and CommercialUser='$commercial'";
    $dosql->ExecNoneQuery($sql);
	}else{
	$sql ="UPDATE `commoditystock` SET Stock='$kucun',salenum='$salenum_after' WHERE `CommodityId`='$commodityId' and CommercialUser='$commercial'";
    $dosql->ExecNoneQuery($sql);
	}
	//将所有同一个id的商品的销量进行统计
		$r=$dosql->GetOne("select * from commodity where Id='$commodityId'");
    $Nums=$r['Num']+$row['Quantity'];
    $sql ="UPDATE `commodity` SET Num='$Nums' WHERE `Id`='$commodityId'";
    $dosql->ExecNoneQuery($sql);
		/*②.更新商品的月销量（添加到表commodity_month_nums中）
		 *  判断表中当年当月是否有这个商品：
		 *  1》如果有则进行更新商品的销量
     *  2》如果没有，则往表中添加当年当月的商品
		 */
		$thisyear=date("Y",time());
		$thismonth=date("m",time());
		$c=$dosql->GetOne("select * from commodity_month_nums where commodityid_id='$commodityId' and year=$thisyear and month=$thismonth");
		if(is_array($c)){
			$changenums=$c['month_nums']+$row['Quantity'];
			$dosql->ExecNoneQuery("update commodity_month_nums set month_nums=$changenums where commodityid_id='$commodityId'");
		}else{
			$month_nums=$row['Quantity'];
			$dosql->ExecNoneQuery("insert into commodity_month_nums(commodityid_id,year,month,month_nums) values ('$commodityId',$thisyear,$thismonth,$month_nums)");
		}
}

//更改订单列表里面的商品状态，更改为已提取,地址更改掉
$s = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
$address=$s['CommercialSite'];
$sql ="UPDATE `orderform` SET State='8',Commercial='$commercial',TakeTime='$Version',TakeAddress='$address' WHERE `OrderId`='$orderid'";
$dosql->ExecNoneQuery($sql);


// 会员将商品提取之后，根据所购买的商品的价值，赠送购物券  gid   购物券id
// 通过判断商品的价值 $sum_price  来赠送购物券
/*优惠卷：   0 - 100    10元
             100-200    15元
             200-300    23元
             300-500    38元
             500-800    50元
             800-1200   100元
             1200- 以上 200元
*/
// 100以内返利10元优惠券
$s = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
//$jiuqian_business 会员购买商品返回的酒钱
$defaults=$s['defaults'];
$zdy=$s['zdy'];

if($defaults==1 && $zdy==0)	{
if($sum_price >0 && $sum_price<=100){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='0 - 100' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 100-200 之间返15元优惠券
elseif($sum_price >100 && $sum_price<=200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='100-200' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 200-300 之间返23元优惠券
elseif($sum_price >200 && $sum_price<=300){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='200-300' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 300-500 之间返38元优惠券
elseif($sum_price >300 && $sum_price<=500){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='300-500' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 500-800 之间返50元优惠券
elseif($sum_price >500 && $sum_price<=800){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='500-800' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 800-1200 之间返100元优惠券
elseif($sum_price >800 && $sum_price<=1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='800-1200' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 1200 之间返200元优惠券
elseif($sum_price >1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='1200- 以上' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}



if($gid!=0){
$gettime=date("Y-m-d H:i:s",time());
$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}elseif($defaults==0 && $zdy==1){
// 100以内返利优惠券
if($sum_price >0 && $sum_price<=100){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial'   and fanwei='0 - 100' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 100-200 之间返优惠券
elseif($sum_price >100 && $sum_price<=200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='100-200' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 200-300 之间返23元优惠券
elseif($sum_price >200 && $sum_price<=300){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='200-300' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 300-500 之间返38元优惠券
elseif($sum_price >300 && $sum_price<=500){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='300-500' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 500-800 之间返50元优惠券
elseif($sum_price >500 && $sum_price<=800){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='500-800' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 800-1200 之间返100元优惠券
elseif($sum_price >800 && $sum_price<=1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='800-1200' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 1200 之间返200元优惠券
elseif($sum_price >1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='1200- 以上' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}elseif($defaults==1 && $zdy==1){
if($sum_price >0 && $sum_price<=100){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='0 - 100'  and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >100 && $sum_price<=200){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='100-200'  and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
// 200-300 之间返23元优惠券
elseif($sum_price >200 && $sum_price<=300){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='200-300'  and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());

		$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >300 && $sum_price<=500){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='300-500' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());

		$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >500 && $sum_price<=800){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='500-800' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());

		$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >800 && $sum_price<=1200){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='800-1200' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >1200){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='1200- 以上' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}


}

$State = 1;
$Descriptor = '数据查询成功！';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据查询失败!';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version
        );
echo phpver($result);
}
}else{
$State = 2;
$Descriptor = '商品库存不足，提取失败!';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version
        );
echo phpver($result);
	}
	}
}elseif($dingdantype==0){   //自提订单
//查询出购买产品的id
$orderid=$show['OrderId'];
//这个订单里面的所有的商品
$one=1;
$two=2;
$xhs=array();



$dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$one);
while($row=$dosql->GetArray($one)){
	$price[]=$row['Quantity']*$row['NewPrice'];
	$jiuqian[]=$row['Quantity']*$row['JiuQian'];
	$sjjiuqian[]=$row['Quantity']*$row['SJJiuQian'];
    $xhs[]=$row['CommodityId'];	 //商品id
}

$dosql->Execute("SELECT * FROM commoditystock,commodity where commoditystock.CommodityId=commodity.Id and commoditystock.CommercialUser='$commercial'",$two);
while($rows=$dosql->GetArray($two)){
    $new_xhs[]=$rows['CommodityId'];
}

//商品的总价格
foreach($price as $val){
	$sum_price += $val;
}
//会员酒钱
foreach($jiuqian as $val){
	$jiuqian_user += $val;
}
//商家酒钱
foreach($sjjiuqian as $val){
	$jiuqian_business += $val;
}

$a=$xhs;
$b=$new_xhs;

$flag = 1;
foreach ($a as $va) {
  if (in_array($va, $b)) {
    continue;
  }else {
    $flag = 0;
    break;
  }
}



if($flag){
if($show['State']==1){  //判断账号是否付款
$sj=substr($Version,0,10);
//添加提取订单列表
$sql = "INSERT INTO `pickuplist` (Commercial, orderId, pickUpTime, jiuQian,year,month) VALUES ('$commercial','$orderid', '$sj', '$jiuqian_business','$year','$month')";
$dosql->ExecNoneQuery($sql);



//添加商户的酒钱
$rs = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
//$jiuqian_business 会员购买商品返回的酒钱
$JiuQian= intval($jiuqian_business) + intval($rs['JiuQian']); //向账号中添加会员的酒钱
$sql ="UPDATE `commercialuser` SET JiuQian='$JiuQian' WHERE `Commercial`='$commercial'";
$dosql->ExecNoneQuery($sql);


//Account  会员的账号
$g = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$account'");
//$jiuqian_user 会员购买商品返回的酒钱
$JiuQian=intval($jiuqian_user)+intval($g['JiuQian']);  //向账号中添加会员的酒钱
$sql ="UPDATE `memberuser` SET JiuQian='$JiuQian' WHERE `Account`='$account'";
$dosql->ExecNoneQuery($sql);

//判断会员是否有推荐人，如果有的话就按照提成比例返酒钱给推荐人
if($g['Yaoqingma']!="" && $g['classes']!=""){
$recommand=$g['Yaoqingma']; //推荐人的邀请码
$classes=$g['classes'];  //推荐人的类型
if($classes==0){         //推荐人是会员
$table="memberuser";
$type=0;                 //推荐人是商户
}elseif($classes==1){
$table="commercialuser";
$type=1;
}
        $kk = $dosql->GetOne("SELECT * FROM $table WHERE Recommand='$recommand'");	//查询推荐人账号里面的酒钱
		$bilvs=$kk['bilv'];
		$bilv=floatval($kk['bilv'] /100);
		$fanjiuqian=intval(intval($sum_price) * $bilv);
		$jiuqian=intval($kk['JiuQian'])+ $fanjiuqian;
        $dosql->ExecNoneQuery("UPDATE $table SET JiuQian='$jiuqian' WHERE Recommand='$recommand'");
		//将提现记录保存到数据库中来
		$dosql->ExecNoneQuery("INSERT INTO `recommandlist`(account,tjm,money,bilv, sum_money,posttime,type) VALUES ('$account','$recommand', '$sum_price', '$bilvs', '$fanjiuqian','$Version','$type')");

		/*
		区域管理者提成分为四种情况
		①.是商家推荐的会员，并且会员提货在推荐人那里提货
		②.是商家推荐的会员，不在推荐的商家那里提货
		③.不是商家推荐的会员，但是在商家那里提货
		④.不是商家推荐的会员，不在商家那里提货
		*/
		//①.会员提取商品之后，区域管理者获取提成,推荐人是商户，并且在商家那里提货（商家推荐提成+商家酒钱比率）*区域管理者提成
		if($type==1){  //推荐人是商户的时候，邀请码和商户的推荐码相同
		$sj = $dosql->GetOne("SELECT * FROM commercialuser WHERE Commercial='$commercial'");
		$sj_bilv=$sj['bilv'];         //商户的推荐比率
		$usernames=$sj['username'];   //商户的代理账号
		$shanghurecommand=$sj['Recommand'];  //商户的推荐码
		if($recommand==$shanghurecommand){   //邀请码和商户推荐码相等
		$quyugl=intval(intval($sum_price) * ($cfg_sjmoney+$sj_bilv)/10000 * $cfg_qygl);  //区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                  }
		}else{   //邀请码和商户推荐码不相等
		$quyugl=intval(intval($sum_price) * ($cfg_sjmoney)/10000 * $cfg_qygl);  //区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                  }
		}
		}elseif($type==0){  //推荐人是会员的情况，区域管理员提成只有酒钱提成
	    $sj = $dosql->GetOne("SELECT * FROM commercialuser WHERE Commercial='$commercial'");
		$usernames=$sj['username'];   //商户的代理账号
        $quyugl=intval(intval($sum_price) * ($cfg_sjmoney)/10000 * $cfg_qygl);  //区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                  }
		}

}else{   //当商家没有推荐人的时候
		$sj = $dosql->GetOne("SELECT * FROM commercialuser WHERE Commercial='$commercial'");	//查询商户的提现比率
		$usernames=$sj['username'];  //商户的代理
		$quyugl=intval(intval($sum_price) * ($cfg_sjmoney)/10000 * $cfg_qygl);  //       区域管理员得到的提成酒钱
        if($usernames!=""){
		$qy = $dosql->GetOne("SELECT * FROM pmw_admin WHERE username='$usernames'");	//查询区域管理员的酒钱
		$shangjiajiuqian=$qy['jiuqian']+$quyugl;
		$dosql->ExecNoneQuery("UPDATE pmw_admin SET jiuqian='$shangjiajiuqian' WHERE username='$usernames'");
		                   }
}




//提取完成之后从商家库存里面减去被提取的商品数量，同时添加分店的销量
$dosql->Execute("select * from ordercommodity a inner join commoditystock b on a.CommodityId=b.CommodityId where b.CommercialUser='$commercial' and a.OrderId='$orderid'");
while($row=$dosql->GetArray()){
	$kucun=$row['Stock'] - $row['Quantity'];   //提取完成之后的商品库存
	$commodityId=$row['CommodityId'];          //商品id
	$warn=$row['Warn'];                        //设置的库存警告
	$salenum=$row['salenum'];                  //本件商品原来的销量
	$salenum_after=$salenum+$row['Quantity'];  //添加最新的商品销量
	$jinggao=0;
	if($warn>$kucun){
	$jinggao=1;
	$sql ="UPDATE `commoditystock` SET Stock='$kucun',jinggao=$jinggao,salenum='$salenum_after' WHERE `CommodityId`='$commodityId' and CommercialUser='$commercial'";
    $dosql->ExecNoneQuery($sql);
	}else{
	$sql ="UPDATE `commoditystock` SET Stock='$kucun',salenum='$salenum_after' WHERE `CommodityId`='$commodityId' and CommercialUser='$commercial'";
    $dosql->ExecNoneQuery($sql);
	}
	//将所有同一个id的商品的销量进行统计
	$r=$dosql->GetOne("select * from commodity where Id='$commodityId'");
	  //①.更新商品的销量
    $Nums=$r['Num']+$row['Quantity'];
    $sql ="UPDATE `commodity` SET Num='$Nums' WHERE `Id`='$commodityId'";
    $dosql->ExecNoneQuery($sql);
		/*②.更新商品的月销量（添加到表commodity_month_nums中）
		 *  判断表中当年当月是否有这个商品：
		 *  1》如果有则进行更新商品的销量
     *  2》如果没有，则往表中添加当年当月的商品
		 */
		 $thisyear=date("Y",time());
		 $thismonth=date("m",time());
		 $c=$dosql->GetOne("select * from commodity_month_nums where commodityid_id='$commodityId' and year=$thisyear and month=$thismonth");
		 if(is_array($c)){
			 $changenums=$c['month_nums']+$row['Quantity'];
			 $dosql->ExecNoneQuery("update commodity_month_nums set month_nums=$changenums  where commodityid_id='$commodityId'");
		 }else{
			 $month_nums=$row['Quantity'];
			 $dosql->ExecNoneQuery("insert into commodity_month_nums(commodityid_id,year,month,month_nums) values ('$commodityId',$thisyear,$thismonth,$month_nums)");
		 }

}

//更改订单列表里面的商品状态，更改为已提取,地址更改掉
$s = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
$address=$s['CommercialSite'];
$sql ="UPDATE `orderform` SET State='8',Commercial='$commercial',TakeTime='$Version',TakeAddress='$address' WHERE `OrderId`='$orderid'";
$dosql->ExecNoneQuery($sql);


// 会员将商品提取之后，根据所购买的商品的价值，赠送购物券  gid   购物券id
// 通过判断商品的价值 $sum_price  来赠送购物券
/*优惠卷：   0 - 100    10元
             100-200  15元
             200-300  23元
             300-500  38元
             500-800  50元
             800-1200 100元
             1200- 以上 200元
*/
// 100以内返利10元优惠券
$s = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
//$jiuqian_business 会员购买商品返回的酒钱
$defaults=$s['defaults'];
$zdy=$s['zdy'];

if($defaults==1 && $zdy==0)	{
if($sum_price >0 && $sum_price<=100){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='0 - 100' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 100-200 之间返15元优惠券
elseif($sum_price >100 && $sum_price<=200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='100-200' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 200-300 之间返23元优惠券
elseif($sum_price >200 && $sum_price<=300){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='200-300' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 300-500 之间返38元优惠券
elseif($sum_price >300 && $sum_price<=500){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='300-500' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 500-800 之间返50元优惠券
elseif($sum_price >500 && $sum_price<=800){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='500-800' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 800-1200 之间返100元优惠券
elseif($sum_price >800 && $sum_price<=1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='800-1200' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 1200 之间返200元优惠券
elseif($sum_price >1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='1200- 以上' and a.type=1 and b.defaults=1 and b.zdy=0");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}



if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";

$dosql->ExecNoneQuery($sql);
}
}elseif($defaults==0 && $zdy==1){
// 100以内返利优惠券
if($sum_price >0 && $sum_price<=100){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial'   and fanwei='0 - 100' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 100-200 之间返优惠券
elseif($sum_price >100 && $sum_price<=200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='100-200' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 200-300 之间返23元优惠券
elseif($sum_price >200 && $sum_price<=300){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='200-300' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 300-500 之间返38元优惠券
elseif($sum_price >300 && $sum_price<=500){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='300-500' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 500-800 之间返50元优惠券
elseif($sum_price >500 && $sum_price<=800){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='500-800' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 800-1200 之间返100元优惠券
elseif($sum_price >800 && $sum_price<=1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='800-1200' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
// 1200 之间返200元优惠券
elseif($sum_price >1200){
$shows=$dosql->GetOne("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='1200- 以上' and a.type=2 and b.defaults=0 and b.zdy=1");
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
}
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";

$dosql->ExecNoneQuery($sql);
}
}elseif($defaults==1 && $zdy==1){
if($sum_price >0 && $sum_price<=100){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='0 - 100'  and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >100 && $sum_price<=200){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='100-200'  and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
// 200-300 之间返23元优惠券
elseif($sum_price >200 && $sum_price<=300){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='200-300'  and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >300 && $sum_price<=500){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='300-500' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >500 && $sum_price<=800){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='500-800' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >800 && $sum_price<=1200){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='800-1200' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
elseif($sum_price >1200){
$dosql->Execute("select * from coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$commercial' and fanwei='1200- 以上' and b.defaults=1 and b.zdy=1");
while($shows = $dosql->GetArray()){
if(is_array($shows)){
$gid=$shows['id'];
}else{
$gid=0;
}
$money=$shows['money'];
if($gid!=0){
	$gettime=date("Y-m-d H:i:s",time());
	$sql = "INSERT INTO `couponslist` (`gid`, `account`, `commercial`, `creatime`, `num`, `money`, `gettime`) VALUES ( '$gid', '$account', '$commercial', '$youxiaoqi', '1', '$money', '$gettime')";
$dosql->ExecNoneQuery($sql);
}
}
}
}

$State = 1;
$Descriptor = '数据查询成功！';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据查询失败!';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version
        );
echo phpver($result);
}
}else{
$State = 2;
$Descriptor = '商品库存不足，提取失败!';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version
        );
echo phpver($result);
	}
}



?>
