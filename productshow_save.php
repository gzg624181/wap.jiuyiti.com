<?php
 require_once(dirname(__FILE__).'/include/config.inc.php');
if($action=="add")
{
/*提供参数
     *commodityid :商品id   commoditynumber:商品数量    userid:会员id
	 *   *需要做好判断1.加入购物车的商品，首先判断目前的购物车里面是否有这种商品，如果有的话就直接在原来的基础上加上现在需要购买的商                品商量
	 *            2.如果购物车里面没有这种商品，则在购物车清单里面加入这种商品的列表
	 *            3.用户购买完毕之后，不管是否购买成功，清空购物清单里面的商品列表
     */
	$id= getrandomstring(20);   //购物车Id
	$Version=date("Y-m-d h:i:s");
    $r = $dosql->GetOne("SELECT * FROM `shoppingcart` WHERE CommodityId='$commodityid' and UserId='$userid'");
	if(is_array($r)){
		$setnumber=$r['CommodityNumber'];  //计算目前购物车里面的商品数量
		$number=$commoditynumber+$setnumber;
	    $sql ="UPDATE `shoppingcart` SET CommodityNumber='$number',Id='$id' WHERE CommodityId='$commodityid' and UserId='$userid'";
        $dosql->ExecNoneQuery($sql);
	header("Location: shoppingcart-1-1.html");
		}else{
	$sql = "INSERT INTO `shoppingcart` (Id, CommodityId, CommodityNumber, UserId, CreatTime) VALUES ('$id', '$commodityid','$commoditynumber', '$userid', '$Version')";
	$dosql->ExecNoneQuery($sql);
	header("Location: shoppingcart-1-1.html");
		}

}elseif($action=="del")
{
	$dosql->QueryNone("DELETE FROM `shoppingcart` WHERE Id='$id'");
	header("Location: shoppingcart-1-1.html");

}elseif($action=="del_orderid")
{
	$sql="DELETE FROM `orderform_commercial` WHERE OrderId='$orderid'";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="order-1-1.html";
		header("location:$gourl");
		exit();
	}
}elseif($action=="del_pickuplist")
{
	$sql="DELETE FROM `pickuplist` WHERE orderId='$orderid'";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="order-2-1.html";
		header("location:$gourl");
		exit();
	}
}
elseif($action=="add_getlist")
{

	 /*提供参数
     *commodityid :商品id   commoditynumber:商品数量    userid:会员id
	 *   *需要做好判断1.加入购物车的商品，首先判断目前的购物车里面是否有这种商品，如果有的话就直接在原来的基础上加上现在需要购买的商                品商量
	 *            2.如果购物车里面没有这种商品，则在购物车清单里面加入这种商品的列表
	 *            3.用户购买完毕之后，不管是否购买成功，清空购物清单里面的商品列表
     */
	$Version=date("Y-m-d h:i:s");
	$id= getrandomstring(20);   //购物车Id
    $r = $dosql->GetOne("SELECT * FROM `shoppingcart` WHERE CommodityId='$commodityid' and UserId='$userid'");
	if(is_array($r)){
		$setnumber=$r['CommodityNumber'];  //计算目前购物车里面的商品数量
		$number=$commoditynumber+$setnumber;
	    $sql ="UPDATE `shoppingcart` SET CommodityNumber='$number',Id='$id' WHERE CommodityId='$commodityid' and UserId='$userid'";
        $dosql->ExecNoneQuery($sql);
		header("Location: getlist-1-1.html");
		}else{
	$sql = "INSERT INTO `shoppingcart` (Id, CommodityId, CommodityNumber, UserId, CreatTime) VALUES ('$id', '$commodityid','$commoditynumber', '$userid', '$Version')";
	$dosql->ExecNoneQuery($sql);
	    header("Location: getlist-1-1.html");
		}
}elseif($action=="update_commercialuser")
{
	$sql = "UPDATE `commercialuser` SET  CommercialSite='$CommercialSite',Linkman='$Linkman',Phone='$Phone' WHERE `Commercial`='$commercial'";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourl="basic-1-1.html";
		header("location:$gourl");
		exit();
	}

}elseif($action=="update_commerpwd")
{
$r=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
if(is_array($r)){
$PassWord=$r['PassWord'];            //原始密码
$oldpassword=md5(md5($oldpassword));  //传过来的原密码
 //如果原始密码和
 if($PassWord!=$oldpassword){
 ShowMsg('原始密码错误！','basic-2-1.html');
 }else{
	 if($password!=$confirmpassword){
	 ShowMsg('两次密码输入不一致！','basic-2-1.html');
	 }else{
	 $pwd=md5(md5($password));
	 $sql = "UPDATE `commercialuser` SET Password='$pwd' where Commercial='$commercial'";
	 if($dosql->ExecNoneQuery($sql))
	{
		ShowMsg('密码修改成功！','basic-2-1.html');
	}
	}
 }
 }
}elseif($action=="get_pay")
{
	if($get_address=="000"){
	ShowMsg('请先添加收货地址！',-1);
	}else{
	/*
	*提供参数
	 *①.商户账号: commercial
	 *②.购买状态: State(1, 待提取 2, 返利单  3, 换购单 4, 已失效 5, 待付款 6, 待评价 7, 以退款 8, 以提取 )
	 *③.订单类型: ordertype(1.进货 2.补货)
	 *④.付款方式：paytype(0支付宝支付 1微信支付)
	 *⑤.购物车里面的商品信息 commodityinfo
	 *⑥.购买状态：state (5待付款)
	 */
	//生成订单

	$dosql->Execute(" SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'");
	while($row=$dosql->GetArray()){
	$ssstr[]=$row;
    }
	$commodityinfos=array();
	foreach($ssstr as $k=>$v){
	$commodityinfos[$k]=array('CommodityId'=>$v['CommodityId'],'Quantity'=>$v['CommodityNumber']);
	}
	$commodityinfo=json_encode($commodityinfos);  //购买的商品列表
	//$commercial=$_SESSION['commercial'];          //商户账号
	$state=5;                                     //购买的订单付款状态
	$ordertype=1;                                 //(1.进货 2.补货)
	$paytype=0;                                   //(0支付宝支付 1微信支付)



$Version=date("Y-m-d H:i:s");
$posttime=substr($Version,0,10);
date_default_timezone_set("PRC");                //设置时区

$orderid=date('YmdHis') . rand(1000,9999);      //订单号
$arr=stripslashes($commodityinfo);              //去除对象里面的斜杠
$str=json_decode($arr,true);
// 向数据库里面导入商品订单生成接口
// state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
    $id= rand(100000000,999999999);               //订单id
	$tiquma=str_shuffle(substr($orderid,-6));    //订单提取码的后面6位，并且将顺序随机排列
    //判断是否是注册的商户，是注册的会员的话则生成订单
	$r=$dosql->GetOne("select Id from commercialuser where Commercial='$commercial'");
	if(is_array($r)){
	//生成订单
	if(isset($payamount) && $payamount!="" && $kdmoney!=""){
	$sql = "INSERT INTO `orderform_commercial` (Id, OrderId, UserId, PayAmount,CreatTime,posttime,State,tiquma,ordertype,paytype,PayKdMoney) VALUES ('$id', '$orderid','$commercial','$payamount','$Version','$posttime','$state','$tiquma',$ordertype,$paytype,$kdmoney)";
	}else{
	$sql = "INSERT INTO `orderform_commercial` (Id, OrderId, UserId, CreatTime,posttime,State,tiquma,ordertype,paytype) VALUES ('$id', '$orderid','$commercial','$Version','$posttime','$state','$tiquma',$ordertype,$paytype)";
	}
	$dosql->ExecNoneQuery($sql);
	//订单生成完毕之后，更新购物车列表里面的数量，订单
	for ($i = 0; $i < count($str); $i++) {
		$CommodityId = $str[$i]['CommodityId'];  //商品Id
		$Quantity    = $str[$i]['Quantity'];     //商品数量
		//购买时候修改购买的数量,更改订单号
		$r=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
		$ids=$r['Id'];
		$sql ="UPDATE `shoppingcart` SET Orderid='$orderid', CommodityNumber='$Quantity' WHERE `CommodityId`='$CommodityId' and UserId='$ids'";
		$dosql->ExecNoneQuery($sql);
		if($ordertype==2){
		$OrderId_Old    = $str[$i]['OrderId'];     //商品补货的时候才有orderid
	    //如果是补货的话则讲补货的商品的id作为标签，已经补过的货品则不显示
		$sql ="UPDATE `ordercommodity` SET tag=1  WHERE Orderid='$OrderId_Old' and `CommodityId`='$CommodityId'";
		$dosql->ExecNoneQuery($sql);
		}
	// 向商家的数据库里面添加购买的记录
		$sql = "INSERT INTO `ordercommodity` (OrderId, CommodityId, Quantity, CreatTime,posttime) VALUES ('$orderid', '$CommodityId','$Quantity','$Version','$posttime')";
		$dosql->ExecNoneQuery($sql);
    }
	}
	//echo $orderid;
	$row = $dosql->GetOne("SELECT * FROM `orderform_commercial` WHERE OrderId='$orderid'");
	if(is_array($row)){
	$id_commercaial=$row['Id'];
	echo $id_commercaial;
	header("location:pay-1-".$id_commercaial."-1.html");
	}
  }
}elseif($action=="get_payshoppingcart")  //商家补货
{
	if($get_address=="000"){
	ShowMsg('请先添加收货地址！',-1);
	}else{
	/*
	*提供参数
	 *①.商户账号: commercial
	 *②.购买状态: State(1, 待提取 2, 返利单  3, 换购单 4, 已失效 5, 待付款 6, 待评价 7, 以退款 8, 以提取 )
	 *③.订单类型: ordertype(1.进货 2.补货)
	 *④.付款方式：paytype(0支付宝支付 1微信支付)
	 *⑤.购物车里面的商品信息 commodityinfo
	 *⑥.购买状态：state (5待付款)
	 */
	//生成订单

	$dosql->Execute("SELECT * FROM `commodity` a inner join pmw_lsshoppingcart b on a.Id=b.spid WHERE b.orderid='$orderids'");
	while($row=$dosql->GetArray()){
	$ssstr[]=$row;
    }
	$commodityinfos=array();
	foreach($ssstr as $k=>$v){
	$commodityinfos[$k]=array('CommodityId'=>$v['spid'],'Quantity'=>$v['sl']);
	}
	$commodityinfo=json_encode($commodityinfos);  //购买的商品列表
	//$commercial=$_SESSION['commercial'];          //商户账号
	$state=5;                                     //购买的订单付款状态
	$ordertype=2;                                 //(1.进货 2.补货)
	$paytype=0;                                   //(0支付宝支付 1微信支付)



$Version=date("Y-m-d H:i:s");
$posttime=substr($Version,0,10);
date_default_timezone_set("PRC");                //设置时区

$orderid=date('YmdHis') . rand(1000,9999);      //订单号
$arr=stripslashes($commodityinfo);              //去除对象里面的斜杠
$str=json_decode($arr,true);
// 向数据库里面导入商品订单生成接口
// state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
    $id= rand(100000000,999999999);               //订单id
	$tiquma=str_shuffle(substr($orderid,-6));    //订单提取码的后面6位，并且将顺序随机排列
    //判断是否是注册的商户，是注册的商户的话则生成订单
	$r=$dosql->GetOne("select Id from commercialuser where Commercial='$commercial'");
	if(is_array($r)){
	//生成订单
	if(isset($payamount) && $payamount!="" && $kdmoney!=""){
	$sql = "INSERT INTO `orderform_commercial` (Id, OrderId, UserId, PayAmount,CreatTime,posttime,State,tiquma,ordertype,paytype,PayKdMoney) VALUES ('$id', '$orderid','$commercial','$payamount','$Version','$posttime','$state','$tiquma',$ordertype,$paytype,$kdmoney)";
	}else{
	$sql = "INSERT INTO `orderform_commercial` (Id, OrderId, UserId, CreatTime,posttime,State,tiquma,ordertype,paytype) VALUES ('$id', '$orderid','$commercial','$Version','$posttime','$state','$tiquma',$ordertype,$paytype)";
	}
	$dosql->ExecNoneQuery($sql);
	//订单生成完毕之后，更新购物车列表里面的数量，订单
	for ($i = 0; $i < count($str); $i++) {
		$CommodityId = $str[$i]['CommodityId'];  //商品Id
		$Quantity    = $str[$i]['Quantity'];     //商品数量

		$OrderId_Old    = $orderids;     //商品补货的时候才有orderid
	    //如果是补货的话则讲补货的商品的id作为标签，已经补过的货品则不显示
		$sql ="UPDATE `ordercommodity` SET tag=1  WHERE Orderid='$OrderId_Old' and `CommodityId`='$CommodityId'";
		$dosql->ExecNoneQuery($sql);

	// 向商家的数据库里面添加购买的记录
		$sql = "INSERT INTO `ordercommodity` (OrderId, CommodityId, Quantity, CreatTime,posttime) VALUES ('$orderid', '$CommodityId','$Quantity','$Version','$posttime')";
		$dosql->ExecNoneQuery($sql);
    }
	}
	//echo $orderid;
	$row = $dosql->GetOne("SELECT * FROM `orderform_commercial` WHERE OrderId='$orderid'");
	if(is_array($row)){
	$id_commercaial=$row['Id'];
	//echo $id_commercaial;
	header("location:pay-".$orderids."-".$id_commercaial."-1.html");
	}
  }
}
elseif($action=="numadd")  //添加购物车的数量
{

	//修改购物车接口
	$sql = "UPDATE `shoppingcart` SET CommodityId='$commodityid', CommodityNumber='$commoditynumber', UserId='$userid' WHERE `Id`='$id'";
	$dosql->ExecNoneQuery($sql);

	$dosql->Execute(" SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'");
	while($row=$dosql->GetArray()){
	$strs[]=$row;
    $num[] = floatval($row['CommodityNumber']);//商品数量
	$sums[]= $row['shprice'] * $row['CommodityNumber'];	 //商品总价格
    }

	$numer="";
	foreach($num as $key => $va)
	{
	$numer += $va;
	}

	$sumer="";
	foreach($sums as $key => $item)
	{
	$sumer+=$item;
	}

	echo "<span class='hidden-xs'>共 <span class='cart-goodnum' style='font-family: Verdana, Geneva, sans-serif;font-weight: bold;'>";
	echo $numer;
	echo "</span> 件商品， </span>合计 :
	<span class='total-val red-600' style='font-family: Verdana, Geneva, sans-serif;font-weight: bold;'>";
	echo sprintf("%.2f",$sumer);
	echo "</span>元";
}elseif($action=="addshoppingcart")  //添加购物车的数量
{

	//修改购物车接口
	$sql = "UPDATE `pmw_lsshoppingcart` SET sl='$commoditynumber' WHERE `orderid`='$orderid' and spid='$commodityid'";
	$dosql->ExecNoneQuery($sql);
	$ss=1;
	$dosql->Execute(" SELECT * FROM `pmw_lsshoppingcart` where orderid='$orderid'",$ss);
	while($rows=$dosql->GetArray($ss)){
	$strs[]=$rows;
    $num[] = floatval($rows['sl']);//商品数量
	$sums[]= $rows['price'] * $rows['sl'];	 //商品总价格
    }
	$numer="";
	foreach($num as $key => $va)
	{
	$numer += $va;
	}

	$sumer="";
	foreach($sums as $key => $item)
	{
	$sumer+=$item;
	}

	//echo $numer;
	echo "<span class='hidden-xs'>共 <span class='cart-goodnum' style='font-family: Verdana, Geneva, sans-serif;font-weight: bold;'>";
	echo $numer;
	echo "</span> 件商品， </span>合计 :
	<span class='total-val red-600' style='font-family: Verdana, Geneva, sans-serif;font-weight: bold;'>";
	echo sprintf("%.2f",$sumer);
	echo "</span>元";
}
elseif($action == 'getarea')
{

	//初始化参数
	$datagroup = isset($datagroup) ? $datagroup     : '';
	$level     = isset($level)     ? intval($level) : '';
	$v         = isset($areaval)   ? $areaval       : '0';


	$str = '<option value="-1">--</option>';
	$sql = "SELECT * FROM `#@__cascadedata` WHERE `level`=$level And ";

	if($v == 0)
		$sql .= "datagroup='$datagroup'";
	else if($v % 500 == 0)
		$sql .= "`datagroup`='$datagroup' AND `datavalue`>'$v' AND `datavalue`<'".($v + 500)."'";
	else
		$sql .= "`datavalue` LIKE '$v.%%%' AND `datagroup`='$datagroup'";

	$sql .= " ORDER BY orderid ASC, datavalue ASC";

	$dosql->Execute($sql);
	while($row = $dosql->GetArray())
	{
		$str .= '<option value="'.$row['datavalue'].'">'.$row['dataname'].'</option>';
	}

	if($str == '') $str .= '<option value="-1">--</option>';
	echo $str;
	exit();
}elseif($action == 'apply_money')
{
	$year=date("Y");//获取当前的年份
	$month=date("m");//获取当前的月份
	$one=1;
    //判断是否有这个会员
	$r = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
	if(is_array($r)){
	if($applymonery % 10 != 0){
	ShowMsg('提现金额必须为10的倍数！','basic-3-1.html');
	}
	//申请提现之后，从商家账户中减去提现的金额
	// $dosql->Execute("SELECT * FROM `pickuplist` WHERE Commercial='$commercial' and year='$year' and month='$month'",$one);
	// $num=$dosql->GetTotalRow($one);
	// if($num>0){
	$r=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
	if(floatval($r['JiuQian'])>=floatval($applymonery)){
	$jiuqian=floatval($r['JiuQian'])-floatval($applymonery);
	$sql = "UPDATE `commercialuser` SET  JiuQian='$jiuqian' WHERE `Commercial`='$commercial'";
    $dosql->ExecNoneQuery($sql);
	$sql = "INSERT INTO `pickupmoney` (Commercial, RealName, BankName, BankNo,ApplyTime,ApplyMonery) VALUES ('$commercial', '$realname', '$bankname', '$bankno','$applytime','$applymonery')";
	$dosql->ExecNoneQuery($sql);
	ShowMsg('申请提现成功！','basic-3-1.html');
	}
	//}
	}
}elseif($action == 'add_business')
{
   if($Linkman==""){
   ShowMsg('联系人不能为空！','-1');
   exit;
 }elseif($Phone==""){
   ShowMsg('联系电话不能为空！','-1');
   exit;
 }elseif($CommercialSite==""){
   ShowMsg('联系地址不能为空！','-1');
   exit;
 }
  $tbname="join";
	$sql = "INSERT INTO `$tbname` (type,joinname, joinaddress, joinmessage, joinphone,CreatTime) VALUES ('ztd','$Linkman','$CommercialSite','$joinmessage','$Phone','$CreatTime' )";
	$dosql->ExecNoneQuery($sql);
  ShowMsg('注冊成功，請等待审核！',$cfg_weburl);

}elseif($action=='saomapay'){
  $r=$dosql->GetOne("select logs from  orderform_commercial where OrderId='$orderid'");
  echo $r['logs'];
}

?>
